<?php
/**
 * Created by PhpStorm.
 * User: mrtou
 * Date: 04.08.2016
 * Time: 12:00
 */

namespace app\dal;


use yapf\model;

class PostRepository extends model
{
    private $db;
    /**
     * PostRepository constructor.
     */
    public function __construct()
    {
        $this->db = $this->getDatabaseConnection('default');
    }

    public function getLayoutPosts()
    {
        return $this->db->query("SELECT * FROM posts WHERE PostId>=25 AND PostId <= 27 ORDER BY PostId ASC;");
    }

    public function getLayoutFooterPosts()
    {
       return $this->db->query("SELECT Content FROM posts WHERE PostId=22 OR PostId=23 OR PostId=24;");
    }

}