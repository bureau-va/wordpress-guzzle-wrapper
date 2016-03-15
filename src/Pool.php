<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 23/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 17:38.
 */
namespace BureauVa\WordpressGuzzle;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Pool.
 */
class Pool
{
    /**
     * @var array
     */
    private $queries = [];
    /**
     * @var array
     */
    private $promises = [];
    /**
     * @var array
     */
    private $transformers = [];
    /**
     * @var CachePool
     */
    private $cachePool = null;
    /**
     * @var Client
     */
    protected $client = null;

    /**
     * let us keep reference to our client.
     *
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Awaits all the requests attaching callbacks before.
     *
     * @return mixed
     */
    public function unwrap()
    {
        $promises = $this->flushPromises();
        if (empty($promises)) {
            return [];
        }
        foreach ($promises as $key => $promise) {
            $promises[$key] = $this->attachTransforms($promise);
        }

        return \GuzzleHttp\Promise\unwrap($promises);
    }

    /**
     * @param $query
     *
     * @return $this
     */
    public function addQuery($key, $query)
    {
        $this->queries[$key] = $query;

        return $this;
    }

    /**
     *
     * @param Promise $promise
     */
    public function addPromise(Promise $promise)
    {
        $this->promises[] = $promise;
    }

    /**
     * @return array
     */
    private function flushPromises()
    {
        foreach ($this->queries as $key => $query) {
            var_dump((string)$query);
            $this->promises[$key] = $this->client->getAsync((string)$query);
            unset($this->queries[$key]);
        }

        return $this->promises;
    }

    /**
     * @return array
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * Adds another transformer to collection of transformers.
     *
     * @param callable $transformer
     *
     * @return $this
     */
    public function addTransformer(callable $transformer)
    {
        $this->transformers[] = $transformer;

        return $this;
    }

    /**
     * @param Promise $promise
     */
    public function attachTransforms(Promise $req)
    {
        $transformers = $this->getTransformers();

        return $req->then(function ($res) use ($transformers) {

            $data = \json_decode((string)$res->getBody());

            if (is_object($data)) {
                foreach ($transformers as $transformer) {
                    $data = \call_user_func($transformer, $data);
                }
            } elseif (is_array($data)) {
                foreach ($data as $key => $val) {
                    foreach ($transformers as $transformer) {
                        $data[$key] = \call_user_func($transformer, $val);
                    }
                }
            }

            return $data;
        }, function (RequestException $e) {

            echo $e->getMessage() . $e->getRequest()->getUri().PHP_EOL;
        });
    }

    /**
     *
     */
    public function getCachePool()
    {
        return $this->cachePool;
    }

    /**
     * @param null $cachePool
     */
    public function setCachePool($cachePool)
    {
        $this->cachePool = $cachePool;

        return $this;
    }

    /**
     * Let us set our client reference taken from transaction.
     *
     * @param $client
     *
     * @return RepositoryAbstract
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
