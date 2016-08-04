<?php
namespace app\controller;

use app\authorized_controller;
use yapf\Config;
use yapf\Request;

class auth_controller extends authorized_controller
{
    public function login(Request $rq)
    {
        if ($rq->isPost()) {
            if (!$this->validateAntiForgeryToken($rq)) {
                $this->validationErrors[] = 'AntiForgeryToken invalid';
                return $this->view();
            }
            $model = (object)[
                'login' => $rq->post('login', ''),
                'password' => $rq->post('password', '')
            ];
            if (!$this->userManager->singIn($model->login, $model->password)) {
                $this->validationErrors['login'] = 'Niepoprawny login i/lub hasło';
            }
            if ($this->isModelValid()) {
                $this->redirect(Config::getInstance()->getDefaultController());
            }
            return $this->view();
        }
        return $this->view();
    }
}