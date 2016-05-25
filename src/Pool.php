<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 23/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 17:38.
 */
namespace BureauVa\WordpressGuzzle;

use Guzzle\Http\Message\Response;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Cache\Adapter\Common\AbstractCachePool;

/**
 * Class Pool.
 */
class Pool {
	/**
	 * @var array
	 */
	private $queries = [ ];
	/**
	 * @var array
	 */
	private $promises = [ ];
	/**
	 * @var array
	 */
	private $transformers = [ ];
	/**
	 * @var AbstractCachePool
	 */
	private $cachePool = null;
	/**
	 * @var Client
	 */
	protected $client = null;
	/**
	 * @var bool|string
	 */
	private $cacheKey = false;
	/**
	 * @var array
	 */
	private $cacheData = [ ];
	/**
	 * This will be mostly used for testing.
	 * It also gives quite good informations on life of object for debugging.
	 *
	 * @var array
	 */
	public $debug = [
		'attachedqueries'          => 0,
		'attachedpromises'         => 0,
		'executedqueries'          => 0,
		'executedpromises'         => 0, //will include also queries
		'queriesrestoredfromcache' => 0,
	];

	/**
	 * Pool constructor.
	 */
	public function __construct() {
		$this->cachePool = new Helper\EmptyCache();
	}

	/**
	 * let us keep reference to our client.
	 *
	 * @return mixed
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * Awaits all the requests attaching callbacks before.
	 *
	 * @return mixed
	 */
	public function unwrap() {
		//Deals with whole pool cache
		if ( $this->getCachePool() &&
		     $this->getCacheKey() &&
		     ( $cacheItem = $this->getCachePool()->getItem( $this->getCacheKey() ) ) &&
		     $cacheItem->isHit()
		) {
			return $cacheItem->get();
		}

		$promises = $this->flushPromises();

		if ( empty( $promises ) ) {
			return [ ];
		}

		foreach ( $promises as $key => $promise ) {
			$promises[ $key ] = $this->attachTransforms( $promise );
		}

		$res = \GuzzleHttp\Promise\unwrap( $promises );
		$res = array_merge( $this->cacheData, $res );
		//saves pool cache
		if ( $this->getCacheKey() ) {
			$cacheItem = $this->getCachePool()->getItem( $this->getCacheKey() );
			$cacheItem->set( $res );
		}
		// clearing so the pool can be reused.
		$this->promises  = [ ];
		$this->cacheData = [ ];
		$this->queries   = [ ];

		return $res;
	}

	/**
	 * @return array
	 */
	private function flushPromises() {
		foreach ( $this->queries as $key => $query ) {
			$cacheKey = $query->getCacheKey();
			// checks if cache exists for the requests. if not pass it to promise.
			if ( ! ( $cacheKey &&
			         ( $cacheItem = $this->getCachePool()->getItem( $cacheKey ) ) &&
			         $cacheItem->isHit() )
			) {
				++ $this->debug['executedqueries'];
				$this->promises[ $key ] = $this->client->getAsync( (string) $query );
			} elseif ( $cacheKey ) {
				$this->cacheData[ $key ] = $cacheItem->get();
			}

			unset( $this->queries[ $key ] );
		}

		return $this->promises;
	}

	/**
	 * @param Promise $req
	 *
	 * @return Promise Promise with attached transformers
	 */
	private function attachTransforms( Promise $req ) {
		$transformers = $this->getTransformers();

		return $req->then( function ( Response $res ) use ( $transformers ) {

			$data = \json_decode( (string) $res->getBody() );

			if ( is_object( $data ) ) {
				foreach ( $transformers as $transformer ) {
					$data = \call_user_func( $transformer, $data );
				}
			} elseif ( is_array( $data ) ) {
				foreach ( $data as $key => $val ) {
					foreach ( $transformers as $transformer ) {
						$data[ $key ] = \call_user_func( $transformer, $val );
					}
				}
			}

			return $data;
		}, function ( RequestException $e ) {

		} );
	}

	/**
	 * GETTERS AND SETTERS.
	 */
	/**
	 * @param $query
	 *
	 * @return $this
	 */
	public function addQuery( $key, $query ) {
		++ $this->debug['attachedqueries'];
		$this->queries[ $key ] = $query;

		return $this;
	}

	/**
	 * @param Promise $promise
	 */
	public function addPromise( $name, Promise $promise ) {
		++ $this->debug['attachedpromises'];
		$this->promises[ $name ] = $promise;
	}

	/**
	 * @return array
	 */
	public function getTransformers() {
		return $this->transformers;
	}

	/**
	 * Adds another transformer to collection of transformers.
	 *
	 * @param callable $transformer
	 *
	 * @return $this
	 */
	public function addTransformer( callable $transformer ) {
		$this->transformers[] = $transformer;

		return $this;
	}

	/**
	 * Cache pool getter.
	 */
	public function getCachePool() {
		return $this->cachePool;
	}

	/**
	 * @param null $cachePool
	 */
	public function setCachePool( $cachePool ) {
		$this->cachePool = $cachePool;

		return $this;
	}

	/**
	 * Let us set our client reference taken from transaction.
	 *
	 * @param $client
	 *
	 * @return Client
	 */
	public function setClient( Client $client ) {
		$this->client = $client;

		return $this;
	}

	/**
	 * @param bool|string $cacheKey
	 *
	 * @return Pool
	 */
	public function setCacheKey( $cacheKey ) {
		$this->cacheKey = $cacheKey;

		return $this;
	}

	/**
	 * Cache key getter.
	 *
	 * @return bool|string
	 */
	public function getCacheKey() {
		return $this->cacheKey;
	}
}
