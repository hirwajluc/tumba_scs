<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcadYear;
use App\Models\Card;
use App\Models\Department;
use App\Models\StaffDepartment;
use App\Models\Option;
use App\Models\Position;
use App\Models\Role;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Title;
use App\Models\User;

class MainController extends BaseController
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
            return view('admin/home', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to generate Username from Firstname and Lastname
     */
    
    public function generate_username($firstname, $lastname){
        $lnwords = explode(" ", strval($lastname));
        $lnacronym = "";
    
        foreach ($lnwords as $w) {
          $lnacronym .= strtolower(substr($w, 0, 1));
        }
        //echo $lnacronym;
        $fnnew = str_replace(['\'', ' '], '',strtolower(strval($firstname)));
        return $lnacronym.$fnnew;
    }

    /**
     * Function to generate Username from Firstname and Lastname
     */
    public function randomPassword() {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * Function to display a new student form
     */
    public function newStudentForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New Student";
            $data['pageName'] = "Register Student";
            //$data['dept'] = $dpt_data->findAll();
            return view('admin/studentNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    public function newStaffForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $tit_data = new Title();
        $stfDpt_data = new StaffDepartment();
        $pst_data = new Position();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New Staff";
            $data['pageName'] = "Register Staff";
            $data['tit'] = $tit_data->findAll();
            $data['stfDept'] = $stfDpt_data->findAll();
            $data['pst'] = $pst_data->findAll();
            return view('admin/staffNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to display a new user form
     */
    public function newUserForm()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $role_data = new Role();
        $title_data = new Title();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New User";
            $data['pageName'] = "Register User";
            $data['roles'] = $role_data->findAll();
            $data['titles'] = $title_data->findAll();
            return view('admin/userNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to display a new card form
     */
    public function newCardForm($regno='')
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New Card";
            $data['pageName'] = "Student Card";
            $acdy = new AcadYear();
            $data['acadYear'] = $acdy->findAll();
            return view('admin/cardNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to update a card status
     */
    public function changeCardStatus($action, $cardId, $std_id)
    {
        /**
         * Card activation
         * for actions (0:Desactivate, 1:ReActivate, 2:Upgrade)
         */
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            //echo $action, $cardId, $std_id;
            $data['pageTitle'] = "Card status";
            $data['pageName'] = "Student Card";
            $acdy = new AcadYear();
            $cards = new Card();

            if ($action == 0) {
                $crd_data = [
                    'crd_status' => 'not active'
                ];
                $cards->update($cardId, $crd_data);
                $session->setFlashdata('success', 'Card Desactivated Successfully');
                return redirect()->to(base_url('/admin/stdInfo/'.$std_id));
            } elseif ($action == 1) {
                $crd_data = [
                    'crd_status' => 'active'
                ];
                $cards->update($cardId, $crd_data);
                $session->setFlashdata('success', 'Card Activated Successfully');
                return redirect()->to(base_url('/admin/stdInfo/'.$std_id));
            } elseif ($action == 2) {
                $acd_data = $acdy->where('acd_status','active')->first();
                $crd_data = [
                    'crd_acad_year' => $acd_data->acd_id,
                    'crd_status' => 'active'
                ];
                $cards->update($cardId, $crd_data);
                $session->setFlashdata('success', 'Card Upgraded Successfully');
                return redirect()->to(base_url('/admin/stdInfo/'.$std_id));
            }
            //return view('admin/cardNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save student card data
     */
    public function saveStudentCard()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Saving Card...";
            $data['pageName'] = "Student Card";

            $card = new Card();
            $acdy = new AcadYear();
            $data['acadYear'] = $acdy->findAll();
            helper(['form', 'url']);
            $rules = [
                'regno' => [
                    'label' => 'Registration Number',
                    'rules' => 'required'
                ],
                'id' => [
                    'label' => 'Student',
                    'rules' => 'required|is_unique[scs_cards.crd_student]',
                    'errors' => [
                        'is_unique' => 'This {field} owns a card, swap it if lost.',
                        'required' => 'The {field} identification is required.'
                    ]
                ],
                'card' => [
                    'label' => 'Card Number',
                    'rules' => 'required|is_unique[scs_cards.crd_tag_code]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'ac_year' => [
                    'label' => 'Academic Year',
                    'rules' => 'required'
                ]
            ];
            $error = $this->validate($rules);

            if (!$error) {
                $data['error'] = $this->validator;
                $data['id'] = $this->request->getVar('id');
                $data['regno'] = $this->request->getVar('regno');
                $data['card'] = $this->request->getVar('card');
                $data['ac_year'] = $this->request->getVar('ac_year');
                return view('/admin/cardNew', $data);
            } else {
                $acd_status = $acdy->where('acd_id', $this->request->getPost('ac_year'))
                                   ->first()
                                   ->acd_status;
                $crd_status = ($acd_status == 'active') ? '$acd_status' : 'expired';
                $crdData = [
                    'crd_tag_code' => $this->request->getPost('card'),
                    'crd_student' => $this->request->getPost('id'),
                    'crd_acad_year' => $this->request->getPost('ac_year'),
                    'crd_status' => $crd_status
                ];
                $card->insert($crdData);
                $session->setFlashdata('success', $this->request->getPost('card'));
                return redirect()->to(base_url('/admin/stdCard'));
            }
            //return view('admin/cardNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to retrieve all students data and display them
     */
    public function viewStudents(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $students = new Student();
            $data['students'] = $students->join('scs_options','opt_id = std_option')
                                        ->join('scs_departments', 'dpt_id = opt_department')
                                        ->findAll();
            $data['pageTitle'] = "Tumba-SCS | View Students";
            $data['pageName'] = "Students List";
            return view('admin/studentView', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to retrieve all Staff Departments data and display them
     */
    public function viewStfDepartments(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $stfDepartments = new StaffDepartment();
            $data['stfDepartments'] = $stfDepartments->findAll();
            $data['pageTitle'] = "Tumba-SCS | View Staff Departments";
            $data['pageName'] = "Staff Departments List";
            return view('admin/staffDepartmentList', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to retrieve all staffs data and display them
     */
    public function viewStaffs(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $staffs = new Staff();
            $data['staffs'] = $staffs->join('scs_positions','pst_id = stf_position')
                                    ->join('scs_staff_departments', 'sdp_id = stf_department')
                                    ->join('scs_titles', 'tit_id = stf_title')
                                    ->findAll();
            $data['pageTitle'] = "Tumba-SCS | View Staffs";
            $data['pageName'] = "Staffs List";
            return view('admin/staffView', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to retrieve all users data and display them
     */
    public function viewUsers()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $user = new User();
            $data['users'] = $user->join('scs_roles', 'rol_id = usr_role')
                                ->join('scs_titles', 'tit_id = usr_title')
                                ->findAll();
            $data['pageTitle'] = "Tumba-SCS | View Users";
            $data['pageName'] = "Users List";
            return view('admin/userView', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to retrieve a single student info
     */
    public function getStudentInfo($std_id){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $stdId= $std_id;
            $student = new Student();
            $data['student'] = $student->where('std_id', $stdId)
                                        ->join('scs_options','opt_id = std_option')
                                        ->join('scs_departments', 'dpt_id = opt_department')
                                        ->first();
            $data['pageTitle'] = "Tumba-SCS | Student";
            $data['pageName'] = "Student Info";
            return view('admin/studentInfo', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to display new Department form
     */
    public function newDepartmentForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New Department";
            $data['pageName'] = "Register Department";
            return view('admin/departmentNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to display new Staff Department form
     */
    public function newStaffDepartmentForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {


            $data['pageTitle'] = "Tumba-SCS | New Staff Department";
            $data['pageName'] = "Register Staff Department";
            return view('admin/staffDepartmentNew', $data);
                
        }else{
        $session->destroy();
        return view('auths/login');
        }
    }

    /**
     * Function to save Department data
     */
    public function saveDepartment(){
        $data['pageTitle'] = "Tumba-SCS | New Department";
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
    /**
     * Function to save Staff Department data
     */
    public function saveStaffDepartment(){
        $data['pageTitle'] = "Tumba-SCS | New Staff Department";
        $data['pageName'] = "Register Staff Department";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $depart = new StaffDepartment();
            helper(['form', 'url']);
            $rules = [
                'sdp_name' => [
                    'label' => 'Department name',
                    'rules' => 'required|min_length[5]|alpha_numeric_space|is_unique[scs_staff_departments.sdp_name]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ]
            ];
            $error = $this->validate($rules);

            if (!$error) {
                $data['error'] = $this->validator;
                $data['sdp_name'] = $this->request->getVar('sdp_name');
                $data['sdp_desc'] = $this->request->getVar('sdp_desc');
                return view('admin/staffDepartmentNew', $data);
            } else {
                if ($this->request->getPost('sdp_desc')) {
                    $dptData = [
                        'sdp_name' => $this->request->getPost('sdp_name'),
                        'sdp_desc' => $this->request->getPost('sdp_desc')
                    ];
                } else {
                    $dptData = [
                        'sdp_name' => $this->request->getPost('sdp_name')
                    ];
                }
                
                $depart->insert($dptData);
                $session->setFlashdata('success', $this->request->getPost('sdp_name'));
                
                return $this->response->redirect(route_to('staffDepartment.new'));
            }
        }else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to display new option form
     */
    public function newOptionForm(){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | New Option";
            $data['pageName'] = "Register Option";
            $data['dept'] = $dpt_data->findAll();
            return view('admin/optionNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to display student edit form
     */
    public function editStudent($std_id = 0){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        $opt_data = new Option();
        $student = new Student();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Student";
            $data['pageName'] = "Edit Student Info";
            if($std_id == 0):
                return redirect()->to(base_url('/admin/allStd'));
            else:
                helper(['form', 'url']);
                $image = \Config\Services::image();
                $data['dept'] = $dpt_data->findAll();
                $data['opt'] = $opt_data->findAll();
                $data['student'] = $student->where('std_id', $std_id)
                                        ->join('scs_options','opt_id = std_option')
                                        ->join('scs_departments', 'dpt_id = opt_department')
                                        ->first();
                $data['std_id'] = $std_id;
                return view('admin/studentEdit', $data);
            endif;            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }


 /*    public function editStaff($stf_id)
    {
        $data['pageTitle'] = "Tumba-SCS | Staff";
        $data['pageName'] = "Edit Staff";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $staff = new Staff();

        if ($id) {
            
            $data['staffs'] = $staff->where('stf_id', $stf_id);
            return view('admin/staffEdit', $data);
        } else {
            $session->destroy();
            return view('auths/login');
        }
    } */
    /**
     * Function to display staff edit form
     */
     public function editStaff($stf_id = 0){
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $stfDpt_data = new StaffDepartment();
        $tit_data = new Title();
        $pst_data = new position();
        $staff_data = new Staff();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Staff";
            $data['pageName'] = "Edit Staff Info";
             if($stf_id == 0):
                return redirect()->to(base_url('/admin/allStf'));
            else: 
                helper(['form', 'url']);
                $image = \Config\Services::image();


                $data['stfDept'] = $stfDpt_data->findAll();
                $data['tit'] = $tit_data->findAll();
                $data['pst'] = $pst_data->findAll();
                $data['staffs'] = $staff_data->where('stf_id', $stf_id)
                                        ->join('scs_positions','pst_id = stf_position')
                                        ->join('scs_staff_departments', 'sdp_id = stf_department')
                                        ->join('scs_titles', 'tit_id = stf_title')
                                        ->first();
                $data['stf_id'] = $stf_id;
                
                return view('admin/staffEdit', $data);
             endif;             
        } else{
            $session->destroy();
            return view('auths/login');
        }
    } 


    
    /**
     * Function to display User edit form
     */
    public function editUser($usr_id = 0)
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $rol_data = new Role();
        $tit_data = new Title();
        $user = new User();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | User";
            $data['pageName'] = "Edit User Info";
            if($usr_id == 0):
                return redirect()->to(base_url('/admin/users'));
            else:
                helper(['form', 'url']);
                $image = \Config\Services::image();
                $data['roles'] = $rol_data->findAll();
                $data['titles'] = $tit_data->findAll();
                $data['user_data'] = $user->where('usr_id', $usr_id)
                                        ->join('scs_roles','rol_id = usr_role')
                                        ->join('scs_titles', 'tit_id = usr_title')
                                        ->first();
                $data['usr_id'] = $usr_id;
                return view('admin/userEdit', $data);
            endif;            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save Student data
     */
    public function saveStudent()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        $opt_data = new Option();
        $student = new Student();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Saving Student";
            $data['pageName'] = "Register Student";
            helper(['form', 'url']);
            $image = \Config\Services::image();
            $data['dept'] = $dpt_data->findAll();

            $rules = [
                
            ];
            $validation = $this->validate([
                'firstname' => [
                    'label' => 'Student Firstname',
                    'rules' => 'required|min_length[3]'
                ],
                'lastname' => [
                    'label' => 'Student Lastname',
                    'rules' => 'required|min_length[3]'
                ],
                'regno' => [
                    'label' => 'Registration Number',
                    'rules' => 'required|min_length[9]|alpha_numeric_space|is_unique[scs_students.std_regno]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'email' => [
                    'label' => 'Student Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_students.std_email]|valid_email',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'phone' => [
                    'label' => 'Student Phone',
                    'rules' => 'required|min_length[10]'
                ],
                'department' => [
                    'label' => 'Student Department',
                    'rules' => 'required'
                ],
                'option' => [
                    'label' => 'Student Option',
                    'rules' => 'required'
                ],
                'gender' => [
                    'label' => 'Student Gender',
                    'rules' => 'required'
                ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required'
                ],
                'photo' => [
                    'label' => 'Student Phonto',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        //. '|max_size[userfile,100]'
                        //. '|max_dims[userfile,1024,768]',
                ]
            ]);
            if (!$validation) {
                $data['opt'] = $opt_data->where('opt_department', $this->request->getPost('department'))->findAll();
                $data ['errors'] = $this->validator;
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['regno'] = $this->request->getPost('regno');
                $data ['email'] = $this->request->getPost('email');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                $data ['department'] = $this->request->getPost('department');
                $data ['option'] = $this->request->getPost('option');
                $data ['level'] = $this->request->getPost('level');
                $data ['gender'] = $this->request->getPost('gender');
                //$session->setFlashdata('fail', 'Not Upladed');
                return view('admin/studentNew', $data);
            }
    
            $file = $this->request->getFile('photo');
             
    
            if ($file->hasMoved() == null) {
                $uploadPath = FCPATH . 'uploads/students/';

                // Make sure the upload directory exists
                if (! is_dir($uploadPath))
                {
                    mkdir($uploadPath, 0777, true);
                }

                $newName = $this->request->getPost('regno').'_profile.'.$file->getExtension() ;
                $stdData = [
                    'std_option' => $this->request->getPost('option'),
                    'std_regno' => $this->request->getPost('regno'),
                    'std_firstname' => $this->request->getPost('firstname'),
                    'std_lastname' => $this->request->getPost('lastname'),
                    'std_gender' => $this->request->getPost('gender'),
                    'std_picture' => 'uploads/students/'.$newName,
                    'std_level' => $this->request->getPost('level'),
                    'std_status' => 'active',
                    'std_email' => $this->request->getPost('email'),
                    'std_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'))
                ];
                
                if($image->withFile($file)
                        ->fit(500,500, 'center')
                        ->save($uploadPath. $newName, 90)
                    ){
                    $student->save($stdData);
                    $names = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');
                    $session->setFlashdata('success', $names);
        
                    return view('admin/studentNew', $data);
                } else{
                    $session->setFlashdata('fail', 'Registration failed, try again!');
        
                    return view('admin/studentNew', $data);
                }
    
                //$data = ['uploaded_flleinfo' => new File($filepath)];
                
            }
            $data = ['errors' => 'The file has already been moved.'];
    
            //return view('upload_form', $data);
            return view('admin/studentNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to save Staff data
     */
    public function saveStaff()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        $staff = new Staff();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Saving Staff";
            $data['pageName'] = "Register Staff";
            helper(['form', 'url']);
            $image = \Config\Services::image();
            $data['staff'] = $dpt_data->findAll();

             $rules = [
                
            ];

           
            
            $validation = $this->validate([
                'firstname' => [
                    'label' => 'Staff Firstname',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
               
                 ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'email' => [
                    'label' => 'Staff Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_staffs.stf_email]|valid_email',
                    'errors' => [
                        'is_unique' => 'The {field} already exists',
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'emp_id' => [
                    'label' => 'Employee ID',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'The {field} should not be empty',
                        'is_unique' => 'The {field} already exists',
                    ]
                ],
                'phone' => [
                    'label' => 'Staff Phone',
                    'rules' => 'required|min_length[10]|is_unique[scs_staffs.stf_phone]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists',
                        'min_length[10]' => 'Phone might be 10 digits',
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'title' => [
                    'label' => 'Staff Title',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'position' => [
                    'label' => 'Staff Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'department' => [
                    'label' => 'Staff Department',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],

                'photo' => [
                    'label' => 'Staff Photo',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[photo,4096]',
 
                        'errors' => [
                            'uploaded[photo]' => 'No {field} photo selected',
                            
                           'is_image[photo]' => 'It is not an image file',  
                            'max_size[photo,4096]' => 'The select file is larger thn 4096kb',
                            'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]' => 'The selected file is not an',
                            'max_dims[photo,1024,768]' => 'The file is larger than required one',
                        ]
                ],
                
            ]);
            
            
            if (!$validation) {
                $data ['errors'] = $this->validator;
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['gender'] = $this->request->getPost('gender');
                $data ['email'] = $this->request->getPost('email');
                $data ['emp_id'] = $this->request->getPost('emp_id');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                $data ['title'] = $this->request->getPost('title');
                $data ['position'] = $this->request->getPost('positon');
                $data ['department'] = $this->request->getPost('department');
                $data ['photo'] = $this->request->getPost('photo');
                $session->setFlashdata('fail', 'Not Upladed');
                return view('admin/StaffNew', $data);
            } 
    
            $file = $this->request->getFile('photo');
             
    
            if ($file->hasMoved() == null) {
                $uploadPath = FCPATH . 'uploads/staff/';

                // Make sure the upload directory exists
                if (! is_dir($uploadPath))
                {
                    mkdir($uploadPath, 0777, true);
                }

                $newName = $this->request->getPost('emp_id').'_profile.'.$file->getExtension() ;
                $stfData = [
                    'stf_title' => $this->request->getPost('title'),
                    'stf_firstname' => $this->request->getPost('firstname'),
                    'stf_lastname' => $this->request->getPost('lastname'),
                    'stf_gender' => $this->request->getPost('gender'),
                    'stf_email' => $this->request->getPost('email'),
                    'stf_department' => $this->request->getPost('department'),
                    'stf_position' => $this->request->getPost('position'),
                    'stf_emp_id' => $this->request->getPost('emp_id'),
                    'stf_status' => 'Active',
                    'stf_picture' => 'uploads/staff/'.$newName,
                    'stf_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'))
                ];
                
                if($image->withFile($file)
                        ->fit(500,500, 'center')
                        ->save($uploadPath. $newName, 90)
                    ){
                    $staff->save($stfData);
                    $names = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');
                    $session->setFlashdata('success', $names);
        
                    //return view('admin/staffView', $data);
                    return redirect()->to(base_url('/admin/allStd'));
                } else{
                    $session->setFlashdata('fail', 'Registration failed, try again!');
                    
                    return view('admin/staffNew', $data);
                }
    
                //$data = ['uploaded_flleinfo' => new File($filepath)];
                
            }
            $data = ['errors' => 'The file has already been moved.'];
    
            //return view('upload_form', $data);
            return view('admin/staffNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to Update Staff data
     */
    public function UpdateStaff()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $stf_data = new Staff();
        $staff = new Staff();
        if ($id) {
            $stf_id = $this->request->getPost('stf_id');
            $data['pageTitle'] = "Tumba-SCS | Updating Staff";
            $data['pageName'] = "Update Staff";
            helper(['form', 'url']);
            $image = \Config\Services::image();
            $data['staff'] = $stf_data->findAll();

             $rules = [
                
            ];

           
            
            $validation = $this->validate([
                'firstname' => [
                    'label' => 'Staff Firstname',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
               
                 ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'email' => [
                    'label' => 'Staff Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_staffs.stf_email, stf_id, {stf_id}]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists',
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'emp_id' => [
                    'label' => 'Employee ID',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'The {field} should not be empty',
                        'is_unique' => 'The {field} already exists',
                    ]
                ],
                'phone' => [
                    'label' => 'Staff Phone',
                    'rules' => 'required|min_length[10]|is_unique[scs_staffs.stf_phone]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists',
                        'min_length[10]' => 'Phone might be 10 digits',
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'title' => [
                    'label' => 'Staff Title',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'position' => [
                    'label' => 'Staff Position',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],
                'department' => [
                    'label' => 'Staff Department',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'The {field} should not be empty'
                    ]
                ],

                'photo' => [
                    'label' => 'Staff Photo',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[photo,4096]',
 
                        'errors' => [
                            'require' => 'No {field} photo selected',
                            
                           'is_image[photo]' => 'It is not an image file',  
                            'max_size[photo,4096]' => 'The select file is larger thn 4096kb',
                            'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]' => 'The selected file is not an',
                            'max_dims[photo,1024,768]' => 'The file is larger than required one',
                        ]
                ],
                
            ]);
            
            
            if (!$validation) {
                $data ['errors'] = $this->validator;
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['gender'] = $this->request->getPost('gender');
                $data ['email'] = $this->request->getPost('email');
                $data ['emp_id'] = $this->request->getPost('emp_id');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                $data ['title'] = $this->request->getPost('title');
                $data ['position'] = $this->request->getPost('positon');
                $data ['department'] = $this->request->getPost('department');
                $data ['photo'] = $this->request->getPost('photo');
                $session->setFlashdata('fail', 'Not Upladed');
                //return view('admin/StaffEdit', $data);
            } 
            
            $file = $this->request->getFile('photo');
            
            
            if ($file->hasMoved() == null) {
                $uploadPath = FCPATH . 'uploads/staff/';
                
                // Make sure the upload directory exists
                if (! is_dir($uploadPath))
                {
                    mkdir($uploadPath, 0777, true);
                }
                
                $newName = $this->request->getPost('emp_id').'_profile.'.$file->getExtension() ;
                $stfData = [
                    'stf_title' => $this->request->getPost('title'),
                    'stf_firstname' => $this->request->getPost('firstname'),
                    'stf_lastname' => $this->request->getPost('lastname'),
                    'stf_gender' => $this->request->getPost('gender'),
                    'stf_email' => $this->request->getPost('email'),
                    'stf_department' => $this->request->getPost('department'),
                    'stf_position' => $this->request->getPost('position'),
                    'stf_emp_id' => $this->request->getPost('emp_id'),
                    'stf_status' => 'Active',
                    'stf_picture' => 'uploads/staff/'.$newName,
                    'stf_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'))
                ];
                
                if($image->withFile($file)
                ->fit(500,500, 'center')
                ->save($uploadPath. $newName, 90)
                ){
                    //$staff->update($stfData);
                    $staff->update($stf_id, $stfData);
                    $fullnames = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');
                    $session->setFlashdata('success', $fullnames);
                    
                    return $this->response->redirect(route_to('staff.list'));
                    //return view('admin/staffNew', $data);
                } else{
                    $session->setFlashdata('fail', 'Updating failed, try again!');
                    //return $this->response->redirect(route_to('staff.edit'));
                    return view('admin/staffEdit', $data);
                    //return view('admin/staffEdit', $data);
                }
    
                //$data = ['uploaded_flleinfo' => new File($filepath)];
                
            }
            $data = ['errors' => 'The file has already been moved.'];
    
            //return view('upload_form', $data);
            return view('admin/staffEdit', $data);

        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save User data
     */
    public function saveUser()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $role_data = new Role();
        $title_data = new Title();
        $user = new User();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Saving User";
            $data['pageName'] = "Register User";
            helper(['form', 'url']);
            $image = \Config\Services::image();
            $data['roles'] = $role_data->findAll();
            $data['titles'] = $title_data->findAll();

            $validation = $this->validate([
                'firstname' => [
                    'label' => 'User Firstname',
                    'rules' => 'required|min_length[3]'
                ],
                'lastname' => [
                    'label' => 'User Lastname',
                    'rules' => 'required|min_length[3]'
                ],
                'role' => [
                    'label' => 'User Role',
                    'rules' => 'required'
                ],
                'title' => [
                    'label' => 'User Title',
                    'rules' => 'required'
                ],
                'gender' => [
                    'label' => 'User Gender',
                    'rules' => 'required'
                ],
                'email' => [
                    'label' => 'User Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_users.usr_email]|valid_email',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'phone' => [
                    'label' => 'User Phone',
                    'rules' => 'required|min_length[10]'
                ],
                'photo' => [
                    'label' => 'User Phonto',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        //. '|max_size[userfile,100]'
                        //. '|max_dims[userfile,1024,768]',
                ]
            ]);
            if (!$validation) {
                $data ['errors'] = $this->validator;
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['role'] = $this->request->getPost('role');
                $data ['title'] = $this->request->getPost('title');
                $data ['gender'] = $this->request->getPost('gender');
                $data ['email'] = $this->request->getPost('email');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                return view('admin/userNew', $data);
            }
    
            $file = $this->request->getFile('photo');
             
    
            if ($file->hasMoved() == null) {
                $uploadPath = FCPATH . 'uploads/users/';

                // Make sure the upload directory exists
                if (! is_dir($uploadPath))
                {
                    mkdir($uploadPath, 0777, true);
                }

                $newName = 'user_'.$file->getRandomName();
                $username = $this->generate_username($this->request->getPost('firstname'), $this->request->getPost('lastname'));
                $password = $this->randomPassword();
                $stdData = [
                    'usr_role' => $this->request->getPost('role'),
                    'usr_firstname' => $this->request->getPost('firstname'),
                    'usr_lastname' => $this->request->getPost('lastname'),
                    'usr_gender' => $this->request->getPost('gender'),
                    'usr_picture' => 'uploads/users/'.$newName,
                    'usr_email' => $this->request->getPost('email'),
                    'usr_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone')),
                    'usr_username' => $username,
                    'usr_password' => $password,
                    'usr_title' => $this->request->getPost('title'),
                    'usr_status' => 'active'
                ];
                
                if($image->withFile($file)
                        ->fit(500,500, 'center')
                        ->save($uploadPath. $newName, 90)
                    ){
                    $user->save($stdData);
                    $names = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');
                    $session->setFlashdata('success', $names);
        
                    return view('admin/userNew', $data);
                } else{
                    $session->setFlashdata('fail', 'Registration failed, try again!');
        
                    return view('admin/userNew', $data);
                }
    
                //$data = ['uploaded_flleinfo' => new File($filepath)];
                
            }
            $data = ['errors' => 'The file has already been moved.'];
    
            //return view('upload_form', $data);
            return view('admin/userNew', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save new Student data
     */
    public function updateStudent()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $dpt_data = new Department();
        $opt_data = new Option();
        $student = new Student();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Updating Student";
            $data['pageName'] = "Edit Student";
            helper(['form', 'url', 'file']);
            
            $data['dept'] = $dpt_data->findAll();
            $std_id = $this->request->getPost('std_id');
            $studentData = $student->where('std_id', $std_id)
                                    ->join('scs_options','opt_id = std_option')
                                    ->join('scs_departments', 'dpt_id = opt_department')
                                    ->first();
            $rules = [
                'firstname' => [
                    'label' => 'Student Firstname',
                    'rules' => 'required|min_length[3]'
                ],
                'lastname' => [
                    'label' => 'Student Lastname',
                    'rules' => 'required|min_length[3]'
                ],
                'regno' => [
                    'label' => 'Registration Number',
                    'rules' => 'required|min_length[9]|alpha_numeric_space|is_unique[scs_students.std_regno,std_id,{std_id}]',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'email' => [
                    'label' => 'Student Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_students.std_email,std_id,{std_id}]|valid_email',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'phone' => [
                    'label' => 'Student Phone',
                    'rules' => 'required|min_length[10]'
                ],
                'department' => [
                    'label' => 'Student Department',
                    'rules' => 'required'
                ],
                'option' => [
                    'label' => 'Student Option',
                    'rules' => 'required'
                ],
                'gender' => [
                    'label' => 'Student Gender',
                    'rules' => 'required'
                ],
                'level' => [
                    'label' => 'Level',
                    'rules' => 'required'
                ]
            ];
            if (file_exists($this->request->getFile('photo')) != null) {
                $rules['photo'] = [
                    'label' => 'Student Photo',
                    'rules' => 'uploaded[photo]'
                    . '|is_image[photo]'
                    . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    //. '|max_size[userfile,100]'
                    //. '|max_dims[userfile,1024,768]',))
                ];
            }
            $validation = $this->validate($rules);
            
            if (!$validation) {
                $data['dept'] = $dpt_data->findAll();
                //$data['opt'] = $opt_data->findAll();
                $data['opt'] = $opt_data->where('opt_department', $this->request->getPost('department'))->findAll();
                $data['student'] = $studentData;
                $data ['errors'] = $this->validator;
                $data ['std_id'] = $this->request->getPost('std_id');
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['regno'] = $this->request->getPost('regno');
                $data ['email'] = $this->request->getPost('email');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                $data ['department'] = $this->request->getPost('department');
                $data ['option'] = $this->request->getPost('option');
                $data ['level'] = $this->request->getPost('level');
                $data ['gender'] = $this->request->getPost('gender');
                //$session->setFlashdata('fail', 'Not Upladed');
                return view('admin/studentEdit', $data);
            }
    
            $file = $this->request->getFile('photo');
            $stdData = [
                'std_option' => $this->request->getPost('option'),
                'std_regno' => $this->request->getPost('regno'),
                'std_firstname' => $this->request->getPost('firstname'),
                'std_lastname' => $this->request->getPost('lastname'),
                'std_gender' => $this->request->getPost('gender'),
                'std_level' => $this->request->getPost('level'),
                'std_status' => 'active',
                'std_email' => $this->request->getPost('email'),
                'std_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'))
            ];
            $names = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');

            if (file_exists($this->request->getFile('photo')) != null) {
                
                $image = \Config\Services::image();
                //$files  = new FileCollection();
                //$files->removeFile(FCPATH .'uploads/students/'.$this->request->getPost('regno').'_profile.'.$file->getExtension());
                
                if (file_exists(FCPATH.$studentData->std_picture) != null) {
                    unlink(FCPATH.$studentData->std_picture);
                }

                if (! $file->hasMoved()) {
                    $uploadPath = FCPATH . 'uploads/students/';
    
                    $newName = $this->request->getPost('regno').'_profile.'.$file->getExtension() ;
                    $stdData['std_picture'] = 'uploads/students/'.$newName;
                    
                    if($image->withFile($file)
                            ->fit(500,500, 'center')
                            ->save($uploadPath. $newName, 90)
                        ){
                        $student->update($std_id, $stdData);
                        $session->setFlashdata('success', $names);
            
                        return redirect()->to(base_url('/admin/allStd'));
                    } else{
                        $session->setFlashdata('fail', 'Edit failed, try again!');
            
                        return view('admin/studentEdit', $data);
                    }
                    
                }
            } else {
                $student->update($std_id, $stdData);
                $session->setFlashdata('success', $names);
                return redirect()->to(base_url('/admin/allStd'));
            }
            
             
    
            
            $data = ['errors' => 'The file has already been moved.'];
            return view('admin/studentEdit', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save new User data
     */
    public function updateUser()
    {
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $rol_data = new Role();
        $tit_data = new Title();
        $user = new User();
        if ($id) {
            $data['pageTitle'] = "Tumba-SCS | Updating User";
            $data['pageName'] = "Edit User";
            helper(['form', 'url', 'file']);
            
            $data['roles'] = $rol_data->findAll();
            $data['titles'] = $tit_data->findAll();
            $usr_id = $this->request->getPost('usr_id');
            $userData = $user->where('usr_id', $usr_id)
                                    ->join('scs_roles','rol_id = usr_role')
                                    ->join('scs_titles', 'tit_id = usr_title')
                                    ->first();
            $rules = [
                'firstname' => [
                    'label' => 'User Firstname',
                    'rules' => 'required|min_length[3]'
                ],
                'lastname' => [
                    'label' => 'User Lastname',
                    'rules' => 'required|min_length[3]'
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|min_length[4]'
                ],
                'role' => [
                    'label' => 'User Role',
                    'rules' => 'required'
                ],
                'title' => [
                    'label' => 'User Title',
                    'rules' => 'required'
                ],
                'gender' => [
                    'label' => 'User Gender',
                    'rules' => 'required'
                ],
                'email' => [
                    'label' => 'User Email',
                    'rules' => 'required|min_length[9]|is_unique[scs_users.usr_email,usr_id,{usr_id}]|valid_email',
                    'errors' => [
                        'is_unique' => 'The {field} already exists'
                    ]
                ],
                'phone' => [
                    'label' => 'User Phone',
                    'rules' => 'required|min_length[10]'
                ],
                'photo' => [
                    'label' => 'User Phonto',
                    'rules' => 'uploaded[photo]'
                        . '|is_image[photo]'
                        . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        //. '|max_size[userfile,100]'
                        //. '|max_dims[userfile,1024,768]',
                ]
            ];
            if (file_exists($this->request->getFile('photo')) != null) {
                $rules['photo'] = [
                    'label' => 'Student Photo',
                    'rules' => 'uploaded[photo]'
                    . '|is_image[photo]'
                    . '|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    //. '|max_size[userfile,100]'
                    //. '|max_dims[userfile,1024,768]',))
                ];
            }
            $validation = $this->validate($rules);
            
            if (!$validation) {
                $data['user_data'] = $userData;
                $data ['errors'] = $this->validator;
                $data ['std_id'] = $this->request->getPost('std_id');
                $data ['firstname'] = $this->request->getPost('firstname');
                $data ['lastname'] = $this->request->getPost('lastname');
                $data ['regno'] = $this->request->getPost('regno');
                $data ['email'] = $this->request->getPost('email');
                $data ['phone'] = str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'));
                $data ['department'] = $this->request->getPost('department');
                $data ['option'] = $this->request->getPost('option');
                $data ['level'] = $this->request->getPost('level');
                $data ['gender'] = $this->request->getPost('gender');
                //$session->setFlashdata('fail', 'Not Upladed');
                return view('admin/studentEdit', $data);
            }
    
            $file = $this->request->getFile('photo');
            $stdData = [
                'std_option' => $this->request->getPost('option'),
                'std_regno' => $this->request->getPost('regno'),
                'std_firstname' => $this->request->getPost('firstname'),
                'std_lastname' => $this->request->getPost('lastname'),
                'std_gender' => $this->request->getPost('gender'),
                'std_level' => $this->request->getPost('level'),
                'std_status' => 'active',
                'std_email' => $this->request->getPost('email'),
                'std_phone' => str_replace(['(',')',' ','-'], '',$this->request->getPost('phone'))
            ];
            $names = $this->request->getPost('firstname').' '.$this->request->getPost('lastname');

            if (file_exists($this->request->getFile('photo')) != null) {
                
                $image = \Config\Services::image();
                //$files  = new FileCollection();
                //$files->removeFile(FCPATH .'uploads/students/'.$this->request->getPost('regno').'_profile.'.$file->getExtension());
                
                if (file_exists(FCPATH.$studentData->std_picture) != null) {
                    unlink(FCPATH.$studentData->std_picture);
                }

                if (! $file->hasMoved()) {
                    $uploadPath = FCPATH . 'uploads/students/';
    
                    $newName = $this->request->getPost('regno').'_profile.'.$file->getExtension() ;
                    $stdData['std_picture'] = 'uploads/students/'.$newName;
                    
                    if($image->withFile($file)
                            ->fit(500,500, 'center')
                            ->save($uploadPath. $newName, 90)
                        ){
                        $student->update($std_id, $stdData);
                        $session->setFlashdata('success', $names);
            
                        return redirect()->to(base_url('/admin/allStd'));
                    } else{
                        $session->setFlashdata('fail', 'Edit failed, try again!');
            
                        return view('admin/studentEdit', $data);
                    }
                    
                }
            } else {
                $student->update($std_id, $stdData);
                $session->setFlashdata('success', $names);
                return redirect()->to(base_url('/admin/allStd'));
            }
            
             
    
            
            $data = ['errors' => 'The file has already been moved.'];
            return view('admin/studentEdit', $data);
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save Option data
     */
    public function saveOption(){
        $data['pageTitle'] = "Tumba-SCS | New Option";
        $data['pageName'] = "Register Option";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $depart = new Department();
            $data['dept'] = $depart->findAll();
            $option = new Option();
            helper(['form', 'url']);
            $validation = $this->validate($option->validationRules);
            

            if (!$validation) {
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

    /**
     * Function to return option data as JSON
     */
    public function getOptionJson()
    {
        $option = new Option();
        $id = $this->request->getPost('id');
        $optionData = $option->where('opt_department', $id)->findAll();
        echo json_encode($optionData);
    }

    /**
     * Function to return a student data as JSON
     */
    public function getStudentJson()
    {
        $student = new Student();
        $regno = $this->request->getPost('regno');
        $studentData = $student->where('std_regno', $regno)
                               ->join('scs_options', 'opt_id = std_option')
                               ->join('scs_departments', 'dpt_id = opt_department')
                               ->first();
        echo json_encode($studentData);
    }

    /**
     * Function to retrieve all departments
     */
    public function listDepartments()
    {
        $data['pageTitle'] = "Tumba-SCS | Departments";
        $data['pageName'] = "Registered Departments";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $department = new Department();

        if ($id) {
            $data['departs'] = $department->findAll();
            return view('admin/departmentList', $data);
        } else {
            $session->destroy();
            return view('auths/login');
        }
        
    }

    /**
     * Function to display a department edit form
     */
    public function editDepartment($dpt_id)
    {
        $data['pageTitle'] = "Tumba-SCS | Department";
        $data['pageName'] = "Edit Departments";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $department = new Department();

        if ($id) {
            $data['departs'] = $department->where('dpt_id', $dpt_id)->first();
            return view('admin/departmentEdit', $data);
        } else {
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to display a staff department edit form
     */
    public function editStaffDepartment($sdp_id)
    {
        $data['pageTitle'] = "Tumba-SCS | Staff Department";
        $data['pageName'] = "Edit Staff Departments";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        $stfDepartment = new StaffDepartment();

        if ($id) {
            $data['stfDeparts'] = $stfDepartment->where('sdp_id', $sdp_id)->first();
            return view('admin/staffDepartmentEdit', $data);
        } else {
            $session->destroy();
            return view('auths/login');
        }
    }

    /**
     * Function to save updated department data
     */
    public function updateDepartment()
    {
        $data['pageTitle'] = "Tumba-SCS | Department";
        $data['pageName'] = "Update Department";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $dpt_id = $this->request->getPost('dpt_id');
            $depart = new Department();
            helper(['form', 'url']);
            $rules = [
                'code' => 'required|min_length[2]|alpha_numeric_space|is_unique[scs_departments.dpt_code, dpt_id, {dpt_id}]',
                'name' => 'required|min_length[4]|alpha_numeric_space|is_unique[scs_departments.dpt_name, dpt_id, {dpt_id}]'
            ];
            $error = $this->validate($rules);
    
            if (!$error) {
                $data['error'] = $this->validator;
                $data['dpt_id'] = $this->request->getVar('dpt_id');
                $data['dpt_code'] = $this->request->getVar('code');
                $data['dpt_name'] = $this->request->getVar('name');
                return view('admin/departmentEdit', $data);
            } else {
                $dptData = [
                    'dpt_code' => $this->request->getPost('code'),
                    'dpt_name' => $this->request->getPost('name')
                ];
                $depart->update($dpt_id, $dptData);
                $session->setFlashdata('success', $this->request->getPost('code'));
                return redirect()->to(base_url('/admin/dptList'));
            }
            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
    /**
     * Function to save updated staff departments data
     */
    public function updateStaffDepartment()
    {
        $data['pageTitle'] = "Tumba-SCS | Staff Departments";
        $data['pageName'] = "Update Staff Department";
        $session = \Config\Services::session();
        $id = $session->get('userID');
        if ($id) {
            $stfDpt_id = $this->request->getPost('sdp_id');
            $staffDepart = new StaffDepartment();
/*          helper(['form', 'url']);
            $rules = [
                'code' => 'required|min_length[2]|alpha_numeric_space|is_unique[scs_departments.dpt_code, dpt_id, {dpt_id}]',
                'name' => 'required|min_length[4]|alpha_numeric_space|is_unique[scs_departments.dpt_name, dpt_id, {dpt_id}]'
            ];
            $error = $this->validate($rules);
    
            if (!$error) {
                $data['error'] = $this->validator;
                $data['dpt_id'] = $this->request->getVar('dpt_id');
                $data['dpt_code'] = $this->request->getVar('code');
                $data['dpt_name'] = $this->request->getVar('name');
                return view('admin/departmentEdit', $data);
            } else { */

                $stfDptData = [
                    'sdp_name' => $this->request->getPost('sdp_name'),
                    'sdp_desc' => $this->request->getPost('sdp_desc')
                ];
                $staffDepart->update($stfDpt_id, $stfDptData);
                $session->setFlashdata('success', $this->request->getPost('sdp_name'));
                return $this->response->redirect(route_to('stfDepartmentList.list'));
                //return redirect()->to(base_url('/admin/stfDptList'));
            //}
            
        } else{
            $session->destroy();
            return view('auths/login');
        }
    }
}
