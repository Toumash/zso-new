<?php
namespace app\controller;

use app\authorized_controller;
use app\dal\GroupRepository;
use yapf\Config;
use yapf\Request;

class user_controller extends authorized_controller
{
    protected $groupRepo;

    public function __construct(GroupRepository $groupRepo = null)
    {
        parent::__construct();
        $this->groupRepo = isset($groupRepo) ? $groupRepo : new GroupRepository();
    }

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
                $returnUrl = $rq->post('returnUrl', '');
                if (empty($returnUrl)) {
                    return $this->redirect(Config::getInstance()->getDefaultController());
                }
                return $this->redirect($returnUrl);
            }
            $this->viewBag['returnUrl'] = $rq->post('returnUrl', '');
            return $this->view();
        }
        return $this->view();
    }

    public function register(Request $rq)
    {
        if ($rq->isPost()) {
            if (!$this->validateAntiForgeryToken($rq)) {
                $this->validationErrors[] = 'AntiForgeryToken invalid';
                return $this->view();
            }
            $model = (object)[
                'email' => $rq->post('email', ''),
                'password' => $rq->post('password', ''),
                're_password' => $rq->post('re-password', ''),
                'name' => trim($rq->post('name', '')),
                'surname' => trim($rq->post('surname', '')),
                'phone' => trim($rq->post('phone', '')),
                'type' => $rq->post('type', ''),
                'class' => $rq->post('class', '')
            ];

            // validation
            if (!filter_var($model->email, FILTER_VALIDATE_EMAIL))
                $this->validationErrors['email'] = 'Niepoprawny adres email';
            if ($this->userManager->emailExists($model->email))
                $this->validationErrors['email'] = 'Taki email został już użyty';
            if (empty($model->password) || strlen($model->password) < 8)
                $this->validationErrors['password'] = 'Hasło zbyt krótkie';
            if (empty($model->password) || $model->password != $model->re_password)
                $this->validationErrors['re-password'] = 'Wprowadzone hasła są różne';
            if (empty($model->name))
                $this->validationErrors['name'] = 'Prosimy wprowadzić imię';
            if (empty($model->surname))
                $this->validationErrors['surname'] = 'Prosimy wprowadzić nazwisko';

            // redirection
            if ($this->isModelValid()) {
                $confirmationCode = str_replace("+", "_", base64_encode(openssl_random_pseudo_bytes(64)));
                $userId = $this->userManager->register($model->email, $model->password, (array)$model, $confirmationCode);
                if ($userId === false) {
                    show500();
                    throw new \Exception('cannot register user :C');
                }
                $this->userManager->sendConfirmationEmail($model->email, $userId, $confirmationCode);
                return $this->redirect('user/register_success');
            }
            $this->viewBag['groups'] = $this->groupRepo->getCurrentGroups();
            return $this->view();
        }
        $this->viewBag['groups'] = $this->groupRepo->getCurrentGroups();
        return $this->view();
    }

    public function registerSuccess()
    {
        return $this->view();
    }

    public function verify(Request $rq)
    {
        $model = (object)[
            'id'=>$rq->get('id',''),
            'token'=>$rq->get('token','')
            ];
        if(!empty($model->id) && !empty($model->token)){
            $this->userManager->verify($model->id,$model->token);
            return $this->view();
        }
        return $this->content('Nieprawidłowe dane');
    }

    public function logout(Request $rq)
    {
        session_unset();
        unset($_SESSION['_user']);
        return $this->redirect('');
    }
}