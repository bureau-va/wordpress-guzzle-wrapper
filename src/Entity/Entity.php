<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 11:27.
 */
namespace BureauVa\WordpressGuzzle\Entity;

/**
 * Class Entity.
 */
abstract class Entity implements \ArrayAccess
{
    protected $internaleCounter = 0;

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->{$this->internaleCounter} = $value;
            ++$this->internaleCounter;
        } else {
            $this->{$offset} = $value;
        }
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }

    /**
     * @param $offset
     */
    public function offsetGet($offset)
    {
        return isset($this->{$offset}) ? $this->{$offset} : null;
    }
}
