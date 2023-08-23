<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GateController extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Gate";
            $data['pageName'] = "Gate | DashBoard";
            return view('gate/home', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    
    /**
     * Function display the student/staff log page
     */
    public function logStudents()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Gate";
            $data['pageName'] = "Gate | Card-check";
            return view('gate/checkCards', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
}
