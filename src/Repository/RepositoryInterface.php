<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:24.
 */
namespace BureauVa\WordpressGuzzle\Repository;

use GuzzleHttp\Client;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface
{
    /**
     * @param $promise
     */
    public function setClient(Client $client);
    public function getClient();
}
