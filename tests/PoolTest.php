<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:56.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Pool;
use BureauVa\WordpressGuzzle\Repository\Post;
use BureauVa\WordpressGuzzle\Transformer\CastType;
use GuzzleHttp\Client;
use BureauVa\WordpressGuzzle\Repository\Post as PostRepo;

/**
 * Class TransitionTest.
 */
class PoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing main usage.
     */
    public function testTransaction()
    {
        $client = new Client([
            'base_uri' => 'http://ec2-54-229-0-236.eu-west-1.compute.amazonaws.com/admin/wp-json/',

        ]);
        $pool = new Pool();
        $typeCaster = new CastType('type');
        $typeCaster->setMappings(array(
            'post' => Post::class,
        ));
        $pool->addTransformer(array($typeCaster, 'castType'));
        $repository = new PostRepo($client);
        $repository->setClient($client);
        $pool
            ->addPromise('test1', $repository->findOneById(1))
            ->addPromise('test2', $repository->findByIds([1]));

        $data = $pool->unwrap();

        $this->assertArrayHasKey('test1', $data);
        $this->assertInstanceOf(Post::class, $data['test1']);
        $this->assertEquals(1, $data['test1']->id);

        $this->assertArrayHasKey('test2', $data);
        $this->assertInstanceOf(Post::class, $data['test2'][0]);
        $this->assertEquals(1, $data['test2'][0]->id);
        $this->assertEquals(1, $data['test2'][0]['id']);
    }
}
