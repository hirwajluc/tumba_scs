<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Department;
use App\Models\Log;
use App\Models\Option;
use DateTime;

class SecOfficer extends BaseController
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
     * The function to view gate Logs
     */
    public function viewStudentsGateLogs()
    {
        if ($this->userID) {
            # code...
            $data['pageTitle'] = "Tumba-SCS | Gate Logs";
            $data['pageName'] = "Security Officer | Gate Logs";

            $log = new Log();
            $dpt_data = new Department();

            $data['dept'] = $dpt_data->findAll();

            $data['logsData'] = $log -> join('scs_cards', 'log_card = crd_id')
                    ->join('scs_students', 'crd_student = std_id')
                    ->join('scs_acad_year', 'log_acad_year = acd_id')
                    ->join('scs_options', 'std_option = opt_id')
                    ->join('scs_departments', 'opt_department = dpt_id')
                    ->where('scs_cards.crd_staff', null)
                    ->findAll();

            return view('secOfficer/studentGateLogs', $data);
        } else {
            # code...
            $this->session->start();
            $this->session->destroy();
            return view('auths/login');
        }
    }

    public function _check_greater_then($second_date, $first_date){
    
        if ( ($first_date != "") && ($second_date != "") && (strtotime($first_date) > strtotime($second_date)) )
        {
            $this->form_validation->set_message('check_greater_then', 'Second date field should be greater than First date field!');
            return false;       
        }
        else
        {
            return true;
        }
    }
    /**
     * Function to filter students logs
     */
    public function filterStudentLogs() {
        if ($this->userID) {
            # code...
            $data['pageTitle'] = "Tumba-SCS | Gate Logs";
            $data['pageName'] = "Security Officer | Gate Logs";

            $log = new Log();
            $dpt_data = new Department();
            $opt_data = new Option();

            $data['dept'] = $dpt_data->findAll();
            $from_date = $this->request->getPost('from_date');
            $to_date= $this->request->getPost('to_date');

            $rules = [
                'from_date' => [
                    'label' => 'First Date',
                    'rules' => 'required|valid_date'
                ],
                'to_date' => [
                    'label' => 'Second Date',
                    'rules' => 'required|valid_date'
                ]
            ];
            if ($this->request->getPost('regno')) {
                $rules['regno'] = [
                    'label' => 'Registration Number',
                    'rules' => 'min_length[9]|alpha_numeric_space|is_not_unique[scs_students.std_regno]',
                    'errors' => [
                        'is_not_unique' => 'The {field} does not exist'
                    ]
                ];
            }
            if ($from_date > $to_date){
                $validator = \Config\Services::validation(); 
                $validator->setError('to_date', 'This date is before the first date');
            }
            
            $validation = $this->validate($rules);
            
            if (!$validation || isset($validator)) {
                $data ['errors'] = $this->validator;
                $data['opt'] = $opt_data->where('opt_department', $this->request->getPost('department'))->findAll();
                $data ['regno'] = $this->request->getPost('regno');
                // $data ['department'] = $this->request->getPost('department');
                // $data ['option'] = $this->request->getPost('option');
                // $data ['level'] = $this->request->getPost('level');
                $data ['from_date'] = $this->request->getPost('from_date');
                $data ['to_date'] = $this->request->getPost('to_date');
                $data['logsData'] = $log -> join('scs_cards', 'log_card = crd_id')
                    ->join('scs_students', 'crd_student = std_id')
                    ->join('scs_acad_year', 'log_acad_year = acd_id')
                    ->join('scs_options', 'std_option = opt_id')
                    ->join('scs_departments', 'opt_department = dpt_id')
                    ->where('scs_cards.crd_staff', null)
                    ->orderBy('log_updated_at', 'desc')
                    ->limit(250)
                    ->find();
                return view('secOfficer/studentGateLogs', $data);
            }

            $from_date = $this->request->getPost('from_date');
            $to_date= $this->request->getPost('to_date');

            $data ['regno'] = $this->request->getPost('regno');
            $data ['from_date'] = $this->request->getPost('from_date');
            $data ['to_date'] = $this->request->getPost('to_date');

            if ($this->request->getPost('regno')) {
                # code...
                $regno = $this->request->getPost('regno');
                $data['filtered'] = true;
                $data['logsData'] = $log -> join('scs_cards', 'log_card = crd_id')
                    ->join('scs_students', 'crd_student = std_id')
                    ->join('scs_acad_year', 'log_acad_year = acd_id')
                    ->join('scs_options', 'std_option = opt_id')
                    ->join('scs_departments', 'opt_department = dpt_id')
                    ->where('scs_cards.crd_staff', null)
                    ->where('log_created_at BETWEEN ' . "'" . $from_date . " 00:00:00'" . ' AND ' . "'" . $to_date . " 23:59:59'")
                    ->where('scs_students.std_regno', $regno)
                    ->orderBy('log_updated_at', 'desc')
                    ->findAll();
            }
            // elseif ($this->request->getPost('option')) {
            //     # code...
            //     if ($this->request->getPost('option') == 0) {
            //         # code...
            //         if ($this->request->getPost('level') == 0) {
            //             # code...
            //         } else {
            //             # code...
            //         }
                    
            //     } else {
            //         # code...
            //         if ($this->request->getPost('level') == 0) {
            //             # code...
            //         } else {
            //             # code...
            //         }
            //     }
                
            // } 
            else {
                # code...
                $data['filtered'] = true;
                $data['logsData'] = $log -> join('scs_cards', 'log_card = crd_id')
                    ->join('scs_students', 'crd_student = std_id')
                    ->join('scs_acad_year', 'log_acad_year = acd_id')
                    ->join('scs_options', 'std_option = opt_id')
                    ->join('scs_departments', 'opt_department = dpt_id')
                    ->where('scs_cards.crd_staff', null)
                    ->where('log_created_at BETWEEN ' . "'" . $from_date . " 00:00:00'" . ' AND ' . "'" . $to_date . " 23:59:59'")
                    ->orderBy('log_updated_at', 'desc')
                    ->findAll();
            }

            return view('secOfficer/studentGateLogs', $data);
        } else {
            # code...
            $this->session->start();
            $this->session->destroy();
            return view('auths/login');
        }
    }
}
