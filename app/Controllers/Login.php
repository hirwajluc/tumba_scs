<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        return view('auths/login');
    }
    public function authenticate(){
        $session = $session = \Config\Services::session();
        helper(['form', 'url']);
        $error = $this->validate([
            'username' => 'required|min_length[3]|alpha_numeric_space',
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
            $user  = new User();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userData = $user->where('usr_username', $username)
                ->where('usr_password', $password)
                ->first();
            
            if($userData){
                
                //$session->start();
                $session_data = [
                    'userID' => $userData->usr_id,
                    'role' => $userData->usr_role,
                    'firstname' => $userData->usr_firstname,
                    'lastname' => $userData->usr_lastname
                ];
                $session->set($session_data);
                $session -> setFlashdata('success', 'Logged in Successfully');
                return $this->response->redirect(route_to('admin.home'));
            } else{
                $session -> setFlashdata('fail', 'Invalid Username or Password');
                return $this->response->redirect(route_to('login'));
            }
        }
    }
}