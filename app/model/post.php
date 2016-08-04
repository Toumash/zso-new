<?php

namespace app\model;


class Post
{
    private $id;
    private $content;
    private $name;
    private $section;
    private $pictureFile;
    private $pictureId;
    private $tags;

    public static function from($data)
    {
        if (empty($data)) {
            return null;
        }
        $post = (new Post())
            ->setId($data['PostId'])
            ->setContent($data['Content'])
            ->setName($data['Name'])
            ->setSection($data['Section'])
            ->setTags($data['Tags']);
        return $post;
    }

    public static function withPictureFrom($data)
    {
        if (empty($data)) {
            return null;
        }
        $post = (new Post())
            ->setId($data['PostId'])
            ->setContent($data['Content'])
            ->setName($data['Name'])
            ->setSection($data['Section'])
            ->setPictureFile($data['files.Name'])
            ->setPictureId($data['Picture'])
            ->setTags($data['Tags']);
        return $post;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     * @return Post
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param mixed $pictureFile
     * @return Post
     */
    public function setPictureFile($pictureFile)
    {
        $this->pictureFile = $pictureFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureId()
    {
        return $this->pictureId;
    }

    /**
     * @param mixed $pictureId
     * @return Post
     */
    public function setPictureId($pictureId)
    {
        $this->pictureId = $pictureId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Post
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param mixed $section
     * @return Post
     */
    public function setSection($section)
    {
        $this->section = $section;
        return $this;
    }
}