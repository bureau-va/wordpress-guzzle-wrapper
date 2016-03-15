<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 10:46.
 */
namespace BureauVa\WordpressGuzzle\Query;

use BureauVa\WordpressGuzzle\Helper\StringHelper as S;

/**
 * Class AbstractRepository.
 */
abstract class RepositoryAbstract
{
    public static $BASE_PATH = 'posts';

    /**
     * @return string
     */
    public function __toString()
    {
        $ar = (array) $this;

        return $this->prepareCall($ar);
    }

    /**
     * @param $ar
     *
     * @return string
     */
    private function prepareCall($ar)
    {
        if (count($ar) === 1 && isset($ar['post__in']) && is_numeric($ar['post__in'])) {
            return self::$BASE_PATH.'/'.$ar['post__in'];
        }

        return self::$BASE_PATH.'?'.http_build_query([
            'filter' => $ar,
        ]);
    }

    /**
     * @param $method
     * @param $params
     *
     * @return $this
     */
    public function __call($method, $params)
    {
        if (substr($method, 0, 5) == 'where') {
            $varName = S::camelCaseToSnakeCase(mb_substr($method, 5));

            $this->$varName = $params[0];
        }

        return $this;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function whereId($id)
    {
        $this->post__in = (int) $id;

        return $this;
    }

    /**
     * Set's.
     *
     * @param $key
     * @param $value
     */
    public function setNotFiltered($key, $value)
    {
        $this->$key = $value;

        return $this;
    }

    public function whereIds($ids)
    {
        $this->post__in = (array) $ids;

        return $this;
    }
}
