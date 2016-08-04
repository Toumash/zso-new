<?php

namespace app\controller;


use app\authorized_controller;
use app\dal\PostRepository;
use yapf\Config;
use yapf\Request;

class post_controller extends authorized_controller
{
    /**
     * @var PostRepository
     */
    private $postRepo;

    public function __construct($postRepo = null)
    {
        parent::__construct();
        $this->postRepo = isset($postRepo) ? $postRepo : new PostRepository();
    }

    public function index(Request $rq)
    {
        if (($id = $rq->route('id', -1)) != -1) {
            $id = intval($id);
            if ($id === 0) {
                $this->statusCode(404);
            }
            $this->viewBag['post'] = $this->postRepo->getPostWithPicture($id);
            return $this->view();
        }
        return $this->statusCode(404);
    }

    public function edit(Request $rq)
    {
        // TODO: check rights

        if ((($id = $rq->route('id', -1)) == -1)
            && (($id = $rq->get('id', -1)) == -1)
        ) {
            return $this->statusCode(404);
        }
        $id = intval($id);
        $post = $this->postRepo->getPost($id);
        if (is_null($post)) {
            return $this->statusCode(404);
        }

        if ($rq->isPost()) {
            $width = intval($rq->post('width', 0));
            $height = intval($rq->post('height', 0));
            if (($file = $rq->file('picture', null)) != null) {
                $filename = $file['tmp_name'];
                $destination = Config::getInstance()->getUploadPath();
                $userId = $this->userManager->getSessionUser()->getId();
                // TODO : processing and adding to database
            }
        }
        $this->viewBag['post'] = $post;
        return $this->view();
    }
}