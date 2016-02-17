<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:56
 */

namespace BureauVa\WordpressGuzzle\Tests;
use BureauVa\WordpressGuzzle\Transaction\Transaction;
use BureauVa\WordpressGuzzle\Repository\Post as PostRepository;


/**
 * Class TransitionTest
 * @package MaciekPaprocki\WordpressGuzzle
 */

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    public function testTransaction(){
        $transaction = new Transaction();
        $transaction->addPromise('posts',(new PostRepository())->findOneById(1));
        $data = $transaction->unwrap();
        $this->assertTrue(true);
    }

}