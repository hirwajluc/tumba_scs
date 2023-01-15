<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Option;

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

    public function newDepartmentForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Admin | New Department";
            $data['pageName'] = "Register Department";
            return view('admin/departmentNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function saveDepartment(){
        $data['pageTitle'] = "Admin | New Department";
        $data['pageName'] = "Register Department";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $depart = new Department();
            helper(['form', 'url']);
            $rules = [
                'code' => 'required|min_length[2]|alpha_numeric_space|is_unique[scs_departments.dpt_code]',
                'name' => 'required|min_length[4]|alpha_numeric_space|is_unique[scs_departments.dpt_name]'
            ];
            $error = $this->validate($rules);

            if (!$error) {
                $data['error'] = $this->validator;
                $data['dpt_code'] = $this->request->getVar('code');
                $data['dpt_name'] = $this->request->getVar('name');
                return view('admin/departmentNew', $data);
            } else {
                $dptData = [
                    'dpt_code' => $this->request->getPost('code'),
                    'dpt_name' => $this->request->getPost('name')
                ];
                $depart->insert($dptData);
                $session->setFlashdata('success', $this->request->getPost('code'));
                return redirect()->to(base_url('/admin/department'));
            }
            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function newOptionForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        if ($id) {
            $data['pageTitle'] = "Admin | New Option";
            $data['pageName'] = "Register Option";
            $data['dept'] = $dpt_data->findAll();
            return view('admin/optionNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    public function saveOption(){
        $data['pageTitle'] = "Admin | New Option";
        $data['pageName'] = "Register Option";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $depart = new Department();
            $data['dept'] = $depart->findAll();
            $option = new Option();
            helper(['form', 'url']);
            $rules = [
                'department' => 'required',
                'code' => 'required|min_length[2]|alpha_numeric_space|is_unique[scs_options.opt_code]',
                'name' => 'required|min_length[4]|alpha_numeric_space|is_unique[scs_options.opt_name]'
            ];
            $error = $this->validate($rules);

            if (!$error) {
                $data['error'] = $this->validator;
                $data['department'] = $this->request->getVar('department');
                $data['opt_code'] = $this->request->getVar('code');
                $data['opt_name'] = $this->request->getVar('name');
                return view('admin/optionNew', $data);
            } else {
                $optData = [
                    'opt_department' => $this->request->getPost('department'),
                    'opt_code' => $this->request->getPost('code'),
                    'opt_name' => $this->request->getPost('name')
                ];
                $option->insert($optData);
                $session->setFlashdata('success', $this->request->getPost('code'));
                return redirect()->to(base_url('/admin/option'));
            }
            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
}
