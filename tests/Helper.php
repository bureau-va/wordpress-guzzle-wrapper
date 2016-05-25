<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 15/03/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:46.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Pool;
use GuzzleHttp\Client;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;

/**
 * Class Helper.
 */
class Helper
{
    const TEST_ADDRESS = 'http://ec2-54-229-0-236.eu-west-1.compute.amazonaws.com/admin/wp-json/';

    /**
     * Returns FileSystem Cache Tool for testing.
     *
     * @return FilesystemCachePool
     */
    public static function getCachePool()
    {
        $filesystemAdapter = new Local(dirname(__DIR__).'/build/cachetest/');
        $filesystem = new Filesystem($filesystemAdapter);

        return new FilesystemCachePool($filesystem);
    }

    /**
     * Creates reusable app pools.
     *
     * @return Pool
     */
    public static function getPool()
    {
        $client = new Client([
            'base_uri' => self::TEST_ADDRESS,
        ]);
        $pool = new Pool();
        $pool->setClient($client);

        return $pool;
    }

    /**
     * Returns Pool with set up cache.
     *
     * @return Pool
     */
    public static function getPoolWithCache()
    {
        $pool = self::getPool();

        return $pool->setCachePool(self::getCachePool());
    }
}
