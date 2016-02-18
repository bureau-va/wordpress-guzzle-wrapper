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
            ->addPromise('testarray1', $repository->findOneById(1))
            ->addPromise('testarray2', $repository->findByIds([1]));

        $data = $transaction->unwrap();

        $this->assertArrayHasKey('testarray1', $data);

        $this->assertArrayHasKey('testarray2', $data);


    }

}