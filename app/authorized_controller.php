<?php
namespace app;


class authorized_controller extends \yapf\controller
{
    /**
     * @var UserAuth
     */
    protected $userManager = null;

    public function __construct()
    {
        parent::__construct();
        $this->userManager = new UserAuth();
    }
}