<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 03/03/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:33.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Query\Post;

/**
 * Class TestQuery.
 */
class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testIfQueries are responding with correct string.
     */
    public function testToString()
    {
        $q = new Post();
        $q->whereIds([1, 2, 3]);
        $q2 = new Post();
        $q2->whereId(1);
        $q3 = new Post();
        $q3->whereFakeField(1);

        $this->assertEquals('posts?filter%5Bpost__in%5D%5B0%5D=1&filter%5Bpost__in%5D%5B1%5D=2&filter%5Bpost__in%5D%5B2%5D=3', (string) $q);
        $this->assertEquals('posts/1', (string) $q2);
        $this->assertEquals('posts?filter%5Bfake_field%5D=1', (string) $q3);
    }
}
