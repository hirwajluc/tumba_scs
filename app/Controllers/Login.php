<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        return view('auths/login');
    }
    public function authenticate(){
        helper(['form', 'url']);
        $error = $this->validate([
            'username' => 'required|min_length[3]|valid_email',
            'password' => 'required|min_length[3]'
        ]);
        if (!$error) {
            $data['error'] = $this->validator;
            $data['username'] = $this->request->getVar('username');
            $data['password'] = $this->request->getVar('password');
            return view('auths/login', $data);

        } else{
            // $crudModel = new CrudModel();
            // $crudModel -> save([
            //     'name' => $this->request->getVar('name'),
            //     'email' => $this->request->getVar('email'),
            //     'gender' => $this->request->getVar('gender')
            // ]);
            $session = \Config\Services::session();
            $session -> setFlashdata('success', 'Logged in Successfully');
            return $this->response->redirect(route_to('admin.home'));
        }
    }
}
