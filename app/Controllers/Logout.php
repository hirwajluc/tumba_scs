<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('userId')):
            $session->remove('userId');
            $session->destroy();
            return $this->response->redirect(route_to('login'));
        else:
            $session->destroy();
            return $this->response->redirect(route_to('login'));
        endif;
    }
}
