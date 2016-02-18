<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:14
 */

namespace BureauVa\WordpressGuzzle\Transaction;

use GuzzleHttp\Promise\Promise;

/**
 * Class Transaction
 * @package MaciekPaprocki\WordpressGuzzle
 */

class Transaction
{

    public $promises = [];
    public $client = null;

    /**
     * Transaction constructor. You can pass clien
     * @param null $client
     */
    public function __construct($client = null)
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param Promise $promise
     * @return $this
     */
    public function addPromise($name, Promise $promise)
    {
        $this->promises[$name] = $promise;
        return $this;
    }

    /**
     * Awaits all the promises and returns data
     * @return array
     */
    public function unwrap()
    {
        return  \GuzzleHttp\Promise\unwrap($this->promises);
    }

    /**
     * @return null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getPromises()
    {
        return $this->promises;
    }

    /**
     * @param $promises
     */
    public function setPromises($promises)
    {
        $this->promises = $promises;
    }
}
