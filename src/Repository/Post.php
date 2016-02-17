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
    /**
     * Post Repo constructor.
     */
    public function __construct()
    {
    }

    /**
     * finds Multiple posts by array of ids
     * @param $id
     * @return null
     */
    public function findByIds($id){
        if(is_numeric($id)){
            return $this->findOneById($id);
        }else{
            //TODO: implement actuall body of the function
            return null;
        }
    }
    /**
     * finds post by id
     * @param $id
     * @return null
     */
    public function findOneById($id){
        return null;
        //TODO: implement actuall body of the function
    }
}