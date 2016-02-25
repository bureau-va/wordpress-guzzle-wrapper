<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 25/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:32.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Entity\Post;

/**
 * Class EntityTest.
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests if array access implemented properly
     * Completely useless if not that I managed to implement it wrong first time.
     */
    public function testArrayAccess()
    {
        $entity = new Post();
        $entity['test'] = 'test';
        $this->assertEquals('test', $entity->test);
        $this->assertEquals('test', $entity['test']);
        $this->assertEquals(true, isset($entity['test']));
        $this->assertEquals(true, isset($entity->test));
        unset($entity['test']);
        $this->assertEquals(false, isset($entity->test));
    }
}
