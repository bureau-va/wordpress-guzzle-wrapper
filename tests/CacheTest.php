<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 15/03/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:33.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Pool;
use BureauVa\WordpressGuzzle\Query\Post;

/**
 * Class CacheTest.
 */
class CacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Pool
     */
    /*public function getTestPoolWithQueries()
    {
        $pool = Helper::getPoolWithCache();
        $pool->setCacheKey('test');

        $q = new Post();
        $q->whereId(1);

        $q2 = new Post();
        $q2->whereId(1);

        return $pool->addQuery('test1', $q)
            ->addQuery('test2', $q2);
    }*/

  /*  public function testFullCache()
    {
        $pool = $this->getTestPoolWithQueries();
        $data = $pool->unwrap();

        $pool2 = $this->getTestPoolWithQueries();
        $data2 = $pool->unwrap();

        $this->assertEquals($data, $data2);
        $this->assertEquals(2, $pool->debug['executedpromises']);
        $this->assertEquals(0, $pool->debug['executedpromises']);
    }*/
}
