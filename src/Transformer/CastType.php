<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 18/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:10.
 */
namespace BureauVa\WordpressGuzzle\Transformer;

use BureauVa\WordpressGuzzle\Helper\StringHelper;

/**
 * Class CastType.
 */
class CastType
{
    public $typeName = 'type';
    public $mappings = [];

    public function __construct($typeName = 'type')
    {
        $this->typeName = $typeName;
    }

    /**
     * @param $ob
     * @param string $typeName
     *
     * @return mixed
     */
    public function castType($ob, $typeName = null)
    {
        if (!$typeName) {
            $typeName = $this->typeName;
        }

        if ($ob instanceof \stdClass
            && isset($ob->{$typeName})
            && $this->hasMapping($ob->{$typeName})
        ) {
            $className = $this->getMapping($ob->{$typeName});

            $newOb = new $className();
            foreach ($ob as $key => $val) {
                $newOb->{StringHelper::noFirstCamelCase($key)} = $val;
            }

            return $newOb;
        }

        return $ob;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasMapping($key)
    {
        return isset($this->mappings[$key]);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getMapping($key)
    {
        return $this->mappings[$key];
    }

    /**
     * @return array
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * @param array $mappings
     */
    public function setMappings($mappings)
    {
        $this->mappings = $mappings;

        return $this;
    }
}
