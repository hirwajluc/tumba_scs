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
        $session = \Config\Services::session();
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
            $user  = new User();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userData = $user->where('usr_username', $username)
                ->where('usr_password', $password)
                ->join('scs_roles', 'rol_id = usr_role')
                ->first();
            
            if($userData){
                if ($userData->usr_status == 'active') {
                    $session_data = [
                        'userID' => $userData->usr_id,
                        'role' => $userData->rol_rank,
                        'firstname' => $userData->usr_firstname,
                        'lastname' => $userData->usr_lastname
                    ];
                    $session->set($session_data);
                    $session -> setFlashdata('success', 'Logged in Successfully');
                    if($userData->rol_rank == 1):
                        return $this->response->redirect(route_to('admin.home'));
                    elseif($userData->rol_rank == 2):
                        return $this->response->redirect(route_to('academic.home'));
                    elseif($userData->rol_rank == 3):
                        return $this->response->redirect(route_to('acaduser.home'));
                    elseif($userData->rol_rank == 4):
                        return $this->response->redirect(route_to('hr.home'));
                    elseif($userData->rol_rank == 5):
                        return $this->response->redirect(route_to('secofficer.home'));
                    elseif($userData->rol_rank == 6):
                        return $this->response->redirect(route_to('gate.home'));
                    endif;
                } else {
                    $session -> setFlashdata('fail', 'Your account is '.$userData->usr_status. ', contact System Admin for support');
                    return $this->response->redirect(route_to('login'));
                }
            } else{
                $session -> setFlashdata('fail', 'Invalid Username or Password');
                return $this->response->redirect(route_to('login'));
            }
        }
    }
}