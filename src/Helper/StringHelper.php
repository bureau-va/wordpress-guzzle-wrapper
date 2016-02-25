<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 18/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:12.
 */
namespace BureauVa\WordpressGuzzle\Helper;

/**
 * Class StringHelper.
 */
class StringHelper
{
    /**
     * converts to camel case. Shamefully stolen from.
     *
     * @param $str
     * @param array $noStrip
     *
     * @return mixed|string
     */
    public static function noFirstCamelCase($str)
    {
        $str = self::camelCase($str);
        $str = lcfirst($str);

        return $str;
    }

    /**
     * @param $str
     *
     * @return mixed|string
     */
    public static function camelCase($str)
    {
        $str = strtolower($str);
        $str = preg_replace('/[^a-z0-9]+/', ' ', $str);
        $str = trim($str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $str;
    }
}
