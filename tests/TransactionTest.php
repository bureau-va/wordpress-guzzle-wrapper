<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:56
 */

namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Transaction\Transaction;
use GuzzleHttp\Client;
use BureauVa\WordpressGuzzle\Repository\Post as PostRepo;


/**
 * Class TransitionTest
 * @package MaciekPaprocki\WordpressGuzzle
 */
class TransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing main usage
     */
    public function testTransaction()
    {

        $client = new Client([
            'base_uri' => 'http://ec2-54-229-0-236.eu-west-1.compute.amazonaws.com/admin/wp-json/',

        ]);
        $transaction = new Transaction();
        $repository = new PostRepo();
        $repository->setClient($client);
        $transaction
            ->addPromise('test1', $repository->findOneById(1))
            ->addPromise('test2', $repository->findByIds([1]));

        $data = $transaction->unwrap();

        $this->assertArrayHasKey('test1', $data);
        $this->assertEquals(1, $data['test1']->id);

        $this->assertArrayHasKey('test2', $data);
        $this->assertEquals(1, $data['test2'][0]->id);

    }

}