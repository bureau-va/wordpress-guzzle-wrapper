<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:56.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Transformer\CastType;
use BureauVa\WordpressGuzzle\Query\Post as PostQuery;
use BureauVa\WordpressGuzzle\Entity\Post as PostEntity;

/**
 * Class PoolTest. Base App test.
 */
class PoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test main pool function responsible for all the rest logic.
     */
    public function testSimplePoolUnwrap()
    {
        $pool = Helper::getPool();
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

        $promise = $pool->getClient()->getAsync('posts');
        $pool->addPromise('test3', $promise);

        $data = $pool->unwrap();

        $this->assertArrayHasKey('test1', $data);
        $this->assertInstanceOf(PostEntity::class, $data['test1']);
        $this->assertEquals(1, $data['test1']->id);

        $this->assertArrayHasKey('test2', $data);
        $this->assertInstanceOf(PostEntity::class, $data['test2'][0]);
        $this->assertEquals(1, $data['test2'][0]->id);
        $this->assertEquals(1, $data['test2'][0]['id']);

        $this->assertArrayHasKey('test3', $data);
    }
}
