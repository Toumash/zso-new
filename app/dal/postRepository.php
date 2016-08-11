<?php
namespace app\dal;


use app\model\Post;
use PDO;
use yapf\model;

class PostRepository extends model
{
    private $db;

    public function __construct()
    {
        $this->db = $this->getDatabaseConnection('default');
    }

    public function getHeaderPosts()
    {
        return $this->db->query("SELECT * FROM posts WHERE PostId>=25 AND PostId <= 27 ORDER BY PostId ASC;");
    }

    public function getLayoutFooterPosts()
    {
        return $this->db->query("SELECT Content FROM posts WHERE PostId=22 OR PostId=23 OR PostId=24;");
    }

    public function getHomePosts()
    {
        return $this->db->query("SELECT posts.Name, posts.Content, posts.Section, files.Name AS Filename FROM posts LEFT JOIN files ON posts.Picture=files.FileId WHERE Section=12 AND PostId<=21 ORDER BY posts.PostId");
    }

    public function getPostWithPicture($id)
    {
        $stmt = $this->db->prepare('SELECT posts.Name, posts.Content,posts.Tags, posts.Section, files.Name AS Filename FROM posts LEFT JOIN files ON posts.Picture=files.FileId WHERE PostId=:id LIMIT 1');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return Post::withPictureFrom($data);
    }

    public function getPost($id)
    {
        $stmt = $this->db->prepare('SELECT posts.Name, posts.Content,posts.Tags, posts.Section,  FROM posts  WHERE PostId=:id LIMIT 1');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return Post::from($data);
    }

}