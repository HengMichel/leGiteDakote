<?php

namespace Controller;

use Model\Session as Sess;
use Controller\BaseController;

class SecurityController extends BaseController
{
    public function form(){
        $this->render("security");

    }
}
