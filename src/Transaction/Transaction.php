<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:14
 */

namespace BureauVa\WordpressGuzzle\Transaction;


/**
 * Class Transaction
 * @package MaciekPaprocki\WordpressGuzzle
 */

class Transaction
{

    public $promises;
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
     * @param $promise
     * @return $this
     */
    public function addPromise($name,$promise){
        $this->promises[$name] = $promise;
        return $this;
    }

    /**
     * Awaits all the promises and returns data
     *
     * @return array;
     */
    public function unwrap(){
        //TODO: implement function that unwraps all the requests
        return null;
    }
}