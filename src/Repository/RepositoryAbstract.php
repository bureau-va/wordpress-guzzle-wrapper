<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 10:46
 */

namespace BureauVa\WordpressGuzzle\Repository;


/**
 * Class AbstractRepository
 * @package MaciekPaprocki\WordpressGuzzle
 */

Abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * Keeps reference to promise.
     * @param $promise
     */
    public function attachPromise($promise)
    {
        $this->promise = $promise;
    }

}