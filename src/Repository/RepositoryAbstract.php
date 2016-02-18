<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 10:46
 */

namespace BureauVa\WordpressGuzzle\Repository;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Response;

/**
 * Class AbstractRepository
 * @package MaciekPaprocki\WordpressGuzzle
 */
abstract class RepositoryAbstract implements RepositoryInterface
{
    protected $client;
    protected $reducers = ['BureauVa\\WordpressGuzzle\\Reducer\\CastType::castType'];

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
        if (empty($data)) {
            return '';
        }

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
        $reducers = $this->getReducers();
        return $this->client->requestAsync('GET', $address . $query)
            ->then(function (Response $res) use ($reducers) {

                $data = \json_decode((string)$res->getBody());

                if ($data instanceof \stdClass) {
                    foreach ($reducers as $reducer) {
                        $data = \call_user_func($reducer, $data);
                    }
                } elseif (is_array($data)) {
                    foreach ($data as $key => $val) {
                        foreach ($reducers as $reducer) {
                            $data[$key] = \call_user_func($reducer, $val);
                        }
                    }
                }

                return $data;
            }, function () {
                echo 'error';
            });
    }

    /**
     * @return array
     */
    public function getReducers()
    {
        return $this->reducers;
    }

    /**
     * @param $reducers
     * @return $this
     */
    public function setReducers($reducers)
    {
        $this->reducers = $reducers;
        return $this;
    }

    /**
     * @param $reducer
     * @return $this
     */
    public function addReducer($reducer)
    {
        $this->reducers[] = $reducer;
        return $this;
    }
}
