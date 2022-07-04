<?php

namespace App\Controllers\dashboard;

use App\models\DashboardModel;
use App\models\CourseModel;
use App\models\UsersModel;
use App\Controllers\BaseController;

class Courses extends BaseController {
        public $dashModel;
        public $courseModel;
        public $userModel;
        public $session;

        public function __construct() {
                $this->dashModel = new DashboardModel();
                $this->courseModel = new CourseModel();
                $this->userModel = new UsersModel();
                $this->session = session();          
        }

        public function index() {
              
                $userID = session()->get('logged_user');
                $data['userData'] = $this->dashModel->getLoggedUersData($userID);
                $data['courseData'] = $this->courseModel->getCoursesList();

                $data['userRole'] = $this->userModel->getUserRole($userID);

                echo view('dashboard/template/header', $data);
                echo view('dashboard/courses', $data);
        }

        public function add_Course() {
                helper('form');

                $userID = session()->get('logged_user');

                $data = [];
                $data['validation'] = null;
                $data['userData'] = $this->dashModel->getLoggedUersData($userID);
        
                if ($this->request->getMethod() == 'post') {

                        $rules = [
                        'courseTitle'=>'required',
                        'courseId'=>'required',
                        'courseLeader'=>'required',
                        
                    ];
                    
        
                    if ($this->validate($rules)) {
        
                        $activeData = null;
        
                        if ($this->request->getVar('Course_status') == 'active') {
                                $activeData = "active";
                            }else{
                                $activeData = "inactive";
                            }
        
                        $formData = [
                                'course_title'=>$this->request->getVar('courseTitle'),
                                'course_leader'=>$this->request->getVar('courseLeader'),
                                'course_desc'=>$this->request->getVar('course_desc'),
                                'course_ID'=>$this->request->getVar('courseId'),
                                'Course_status' => $activeData   
                        ];
                           
                        if ($formData) {
                            
                            $userRole = $this->userModel->getUserRole($userID);
                            
                            $checkCID = $this->courseModel->checkCID($this->request->getVar('course_ID'));
        
                        if ($userRole['role'] === 'Admin') {
                            if (!$checkCID) {
        
                                $submittedData = $this->courseModel->addCourse($formData);
        
                             if ($submittedData) {
                                $this->session->setTempdata('error', 'Course added succesfully', 3);
                                return redirect()->to('/dashboard/courses');
                             }
        
                            } else{
                                $this->session->setTempdata('error', 'Duplicate ID please enter Unique UID', 3);
                             }
        
        
                        }else{
                            $this->session->setTempdata('error', 'Access denied Contact admin!', 3);
                             return redirect()->to(current_url());
                        }
                        }  
                    } else {
                        $data['validation'] = $this->validator;
                    }
        
                    
                }
                
                echo view('dashboard/template/header', $data);
                echo view('dashboard/addCourse', $data);
            }
        
            public function delete_course($id){
            // $userID = session()->get('logged_user');
            $result=$this->courseModel->delete_course($id);


            if($result){
                return redirect()->to('/dashboard/courses');
                $this->session->setTempdata('error', 'User deleted succesfully', 3);
            }else{
                $this->session->setTempdata('error', 'Unable to delete user', 3);
            }
            }


            public function edit_course($editId){
                helper('form');
                
                $userID = session()->get('logged_user');
        
                $data = [];
                $data['validation'] = null;

                $data['courses'] = $this->courseModel->getCourseByID($editId);

     
                if ($this->request->getMethod() == 'post') {

                    $rules = [
                    'courseTitle'=>'required',
                    'courseId'=>'required',
                    'courseLeader'=>'required',
                ];
                
    
                if ($this->validate($rules)) {

                $activeData = null;

                if ($this->request->getVar('Course_status') == 'active') {
                    $activeData = "active";
                } else {
                    $activeData = "inactive";
                }

                $formData = [
                    'course_title' => $this->request->getVar('courseTitle'),
                    'course_leader' => $this->request->getVar('courseLeader'),
                    'course_desc' => $this->request->getVar('course_desc'),
                    'course_ID' => $this->request->getVar('courseId'),
                    'Course_status' => $activeData
                ];
                        
                    if ($formData) {
                        
                        $userRole = $this->userModel->getUserRole($userID);
                        
    
                    if ($userRole['role'] === 'Admin') {
                       
    
                            $submittedData = $this->courseModel->editCourse($formData,$editId);
    
                            if ($submittedData) {
                            $this->session->setTempdata('error', 'Course edited succesfully', 3);
                            return redirect()->to('/dashboard/courses');
                            }

    
    
                    }else{
                        $this->session->setTempdata('error', 'Access denied Contact admin!', 3);
                        return redirect()->to(current_url());
                    }
                    }  
                } else {
                    $data['validation'] = $this->validator;
                }
    
                
            }

            $data['userData'] = $this->dashModel->getLoggedUersData($userID);

            
            echo view('dashboard/template/header', $data);
            echo view('dashboard/editCourse', $data);
        }


    }