<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 25/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:32
 */

namespace BureauVa\WordpressGuzzle\Tests;
use BureauVa\WordpressGuzzle\Entity\Post;

/**
 * Class EntityTest
 * @package MaciekPaprocki\WordpressGuzzle
 */

class EntityTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayAccess(){
        $entity = new Post();
        $entity['test'] = 'test';
        $this->assertEquals('test',$entity->test);
        $this->assertEquals('test',$entity['test']);
        $this->assertEquals(true,isset($entity['test']));
        $this->assertEquals(true,isset($entity->test));
        unset($entity['test']);
        $this->assertEquals(false,isset($entity->test));

    }
}