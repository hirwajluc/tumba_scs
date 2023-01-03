<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainController extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | Home";
            $data['pageName'] = "DashBoard";
            return view('admin/home', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function newStudentForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | New Student";
            $data['pageName'] = "Register Student";
            return view('admin/studentNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function viewStudents(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | View Students";
            $data['pageName'] = "Students List";
            return view('admin/studentView', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function getStudentInfo($id){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | Student";
            $data['pageName'] = "Student Info";
            return view('admin/studentInfo', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function editStudent($id){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | Student";
            $data['pageName'] = "Edit Student Info";
            return view('admin/studentEdit', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
}
