<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 18/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:12
 */

namespace BureauVa\WordpressGuzzle\Helper;

/**
 * Class StringHelper
 * @package MaciekPaprocki\WordpressGuzzle
 */

class StringHelper
{
    /**
     * converts to camel case. Shamefully stolen from
     * @param $str
     * @param array $noStrip
     * @return mixed|string
     */
    public static function camelCase($str)
    {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^\w\d]+/', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
    }
}
