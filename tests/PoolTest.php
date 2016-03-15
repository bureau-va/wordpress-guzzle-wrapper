<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:56.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Pool;
use BureauVa\WordpressGuzzle\Query\Post;
use BureauVa\WordpressGuzzle\Transformer\CastType;
use GuzzleHttp\Client;
use BureauVa\WordpressGuzzle\Query\Post as PostQuery;
use BureauVa\WordpressGuzzle\Entity\Post as PostEntity;

/**
 * Class PoolTest.
 */
class PoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing main usage.
     */
    public function __construct()
    {
    }

    /**
     * Creates reusable pools.
     *
     * @return Pool
     */
    public function getPool()
    {
        $client = new Client([
            'base_uri' => 'http://ec2-54-229-0-236.eu-west-1.compute.amazonaws.com/admin/wp-json/',
        ]);
        $pool = new Pool();
        $pool->setClient($client);

        return $pool;
    }

    /**
     * Test main pool function responsible for all the rest logic
     */
    public function testSimplePoolUnwrap()
    {
        //Setting base Buzzle client
        $pool = $this->getPool();
        $this->assertEquals([], $pool->unwrap());

        $typeCaster = new CastType('type');
        $typeCaster->setMappings(array(
            'post' => PostEntity::class,
        ));
        $pool->addTransformer(array($typeCaster, 'castType'));


        $q1 = new PostQuery();
        $q1->whereId(1);

        $q2 = new PostQuery();
        $q2->whereIds([1]);
        $pool
            ->addQuery('test1', $q1)
            ->addQuery('test2', $q2);

        $data = $pool->unwrap();

        $this->assertArrayHasKey('test1', $data);
        $this->assertInstanceOf(PostEntity::class, $data['test1']);
        $this->assertEquals(1, $data['test1']->id);

        $this->assertArrayHasKey('test2', $data);
        $this->assertInstanceOf(PostEntity::class, $data['test2'][0]);
        $this->assertEquals(1, $data['test2'][0]->id);
        $this->assertEquals(1, $data['test2'][0]['id']);
    }
}
