<?php

namespace Controller;

use Controller\BaseController;

class HomeController extends BaseController
{
    public function list()
    {
        $this->render("home.php");
    }
    public function serviceDuGite()
    {
        $this->render("serviceDuGite.php");
    }
}
