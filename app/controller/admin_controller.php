<?php

namespace app\controller;


use app\authorized_controller;
use yapf\TempData;

class admin_controller extends authorized_controller
{
    public function index(){
        // TODO: move this check to view
        if(!$this->userManager->checkRights(SET_RIGHTS_RIGHT | VERIFY_TEACHER_RIGHT  | CHANGE_USER_DATA_RIGHT)){
            TempData::set('error-message','Nie masz uprawnień aby oglądać tę stronę');
            return $this->redirect('user/login');
        }
        return $this->view();
    }
}