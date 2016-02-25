<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 23/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 17:38.
 */
namespace BureauVa\WordpressGuzzle;

use GuzzleHttp\Promise\Promise;

/**
 * Class Pool.
 */
class Pool
{
    /**
     * @var array
     */
    private $promises = [];
    /**
     * @var array
     */
    private $transformers = [];

    /**
     * Awaits all the requests.
     *
     * @return mixed
     */
    public function unwrap()
    {
        $promises = $this->getPromises();
        if (empty($promises)) {
            return [];
        }
        foreach($promises as $key => $promise){
            $promises[$key] = $this->attachTransforms($promise);
        }

        return \GuzzleHttp\Promise\unwrap($promises);
    }

    /**
     * @param $query
     *
     * @return $this
     */
    public function addPromise($key, Promise $query)
    {

        $this->promises[$key] = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getPromises()
    {
        return $this->promises;
    }

    /**
     * @param array $promises
     */
    public function setPromises($promises)
    {
        $this->promises = $promises;

        return $this;
    }

    /**
     * @return array
     */
    public function getTransformers()
    {
        return $this->transformers;
    }

    /**
     * @param array $transformers
     */
    public function setTransformers($transformers)
    {
        $this->transformers = $transformers;

        return $this;
    }

    /**
     * Adds another transformer to collection of transformers.
     *
     * @param callable $transformer
     *
     * @return $this
     */
    public function addTransformer(callable $transformer)
    {
        $this->transformers[] = $transformer;

        return $this;
    }

    /**
     * @param Promise $promise
     */
    public function attachTransforms(Promise $promise)
    {
        $transformers = $this->transformers;

        return $promise->then(function ($res) use ($transformers) {

            $data = \json_decode((string)$res->getBody());

            if ($data instanceof \stdClass) {
                foreach ($transformers as $transformer) {
                    $data = \call_user_func($transformer, $data);
                }
            } elseif (is_array($data)) {
                foreach ($data as $key => $val) {
                    foreach ($transformers as $transformer) {
                        $data[$key] = \call_user_func($transformer, $val);
                    }
                }
            }

            return $data;
        });
    }

}
