<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:24
 */

namespace BureauVa\WordpressGuzzle\Repository;

/**
 * Interface RepositoryInterface
 * @package MaciekPaprocki\WordpressGuzzle
 */

interface RepositoryInterface
{

    /**
     * @param $promise
     * @return null
     */
    public function setClient($client);
    public function getClient();
}
