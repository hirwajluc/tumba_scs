<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AcademicOther extends BaseController
{
    protected $session;
    protected $userID;

    public function __construct()
    {
        // Load the session service through dependency injection
        $this->session = \Config\Services::session();
        if (!empty($this->session->get('userID'))) {
            $this->userID = $this->session->get('userID');;
        } else{
            $this->session->destroy();
            return view('auths/login');
        }
    }

    /**
     * The default function for the admin controller
     */
    public function index()
    {
        if ($this->userID) {
            # code...
            $data['pageTitle'] = "Tumba-SCS | Home";
            $data['pageName'] = "DashBoard";
            return view('acadOther/home', $data);
        } else {
            # code...
            $this->session->start();
            $this->session->destroy();
            return view('auths/login');
        }
    }
}
