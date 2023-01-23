<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcadYear;
use App\Models\Card;
use App\Models\Department;
use App\Models\Option;
use App\Models\Role;
use App\Models\Student;
use App\Models\Title;
use App\Models\User;

class AcademicController extends BaseController
{
    /**
     * The default function for the admin controller
     */

    public function index()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Home";
            $data['pageName'] = "DashBoard";
            return view('academic/home', $data);
        } else {
            $session->destroy();
            return view('auths/login');
        }
    }
}