<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainController extends BaseController
{
    public function index()
    {
        $data['pageTitle'] = "Admin | Home";
        $data['pageName'] = "DashBoard";
        return view('admin/home', $data);
    }

    public function newStudentForm(){
        $data['pageTitle'] = "Admin | New Student";
        $data['pageName'] = "Register Student";
        return view('admin/studentNew', $data);
    }

    public function viewStudents(){
        $data['pageTitle'] = "Admin | View Students";
        $data['pageName'] = "Students List";
        return view('admin/studentView', $data);
    }

    public function getStudentInfo($id){
        $data['pageTitle'] = "Admin | Student";
        $data['pageName'] = "Student Info";
        return view('admin/studentInfo', $data);
    }

    public function editStudent($id){
        $data['pageTitle'] = "Admin | Student";
        $data['pageName'] = "Etid Student Info";
        return view('admin/studentEdit', $data);
    }
}
