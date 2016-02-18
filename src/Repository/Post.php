<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 17/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:17
 */

namespace BureauVa\WordpressGuzzle\Repository;

/**
 * Class Post
 * @package MaciekPaprocki\WordpressGuzzle
 */

class Post extends RepositoryAbstract
{
    const PATH = 'posts';
    /**
     * finds Multiple posts by array of ids
     * @param $id
     * @return null
     */
    public function findByIds($ids)
    {
        return $this->createPromise(self::PATH, ['post__in' => $ids]);
    }

    /**
     * finds post by id
     * @param $id
     * @return null
     */
    public function findOneById($id)
    {
        return $this->createPromise(self::PATH . '/' . $id);
    }
}
