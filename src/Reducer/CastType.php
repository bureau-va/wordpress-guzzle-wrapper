<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 18/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 15:10
 */

namespace BureauVa\WordpressGuzzle\Reducer;

use BureauVa\WordpressGuzzle\Helper\StringHelper;

/**
 * Class CastType
 * @package MaciekPaprocki\WordpressGuzzle
 */
class CastType
{
    /**
     * @param $ob
     * @param string $typeName
     * @return mixed
     */
    public static function castType($ob, $typeName = 'type')
    {
        if ($ob instanceof \stdClass
            && isset($ob->{$typeName})
            && class_exists(($className = '\\BureauVa\\WordpressGuzzle\\Entity\\' . StringHelper::camelCase($ob->{$typeName})))
        ) {
            unset($ob->{$typeName});
            $newOb = new $className();
            foreach ($ob as $key => $val) {
                $newOb->setSecure($key, $val);
            }
            return $newOb;
        }
        return $ob;
    }
}
