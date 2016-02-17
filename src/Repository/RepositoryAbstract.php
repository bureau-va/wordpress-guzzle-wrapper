<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 10:46
 */

namespace BureauVa\WordpressGuzzle\Repository;

use GuzzleHttp\Promise\Promise;


/**
 * Class AbstractRepository
 * @package MaciekPaprocki\WordpressGuzzle
 */
Abstract class RepositoryAbstract implements RepositoryInterface
{
    protected $client;

    /**
     * let us keep reference to our client
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Let us set our client reference taken from transaction
     * @param $client
     * @return RepositoryAbstract
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param $data
     * @return string
     */
    public function createRequestQuery($data)
    {
        if (empty($data))
            return '';

        return http_build_query([
            'filter' => $data
        ]);
    }

    /**
     * @param $address
     * @param null|array|object $parameters
     * @return Promise
     */
    public function createPromise($address, $parameters = null)
    {

        $encodedParam = $this->createRequestQuery($parameters);
        $query = $encodedParam ? '?' . $encodedParam : '';
        return $this->client->getAsync($address . $query);
    }

}