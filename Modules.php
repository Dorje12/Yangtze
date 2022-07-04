<?php

namespace App\Controllers\dashboard;

use App\models\DashboardModel;
use App\models\ModuleModel;
use App\models\UsersModel;
use App\Controllers\BaseController;

class Modules extends BaseController {

    public $dashModel;
    public $moduleModel;
    public $userModel;
    public $session;

    public function __construct() {
        $this->dashModel = new DashboardModel();
        $this->moduleModel = new ModuleModel();
        $this->userModel = new UsersModel();
        $this->session = session();          
}

public function index() {
              
    $userID = session()->get('logged_user');
    $data['userData'] = $this->dashModel->getLoggedUersData($userID);
    $data['moduleData'] = $this->moduleModel->getModuleList();

    $data['userRole'] = $this->userModel->getUserRole($userID);

    echo view('dashboard/template/header', $data);
    echo view('dashboard/module', $data);
}

public function add_Module() {
    helper('form');

    $userID = session()->get('logged_user');

    $data = [];
    $data['validation'] = null;
    $data['userData'] = $this->dashModel->getLoggedUersData($userID);

   if ($this->request->getMethod() == 'post') {

            $rules = [
                'moduleName' => 'required',
                'moduleId' => 'required',
                'Course' => 'required',
                'moduleLeader' => 'required',
                'credit' => 'required', 
        ];
        if ($this->request->getVar('Module_status') == 'active') {
            $activeData = "active";
        }else{
            $activeData = "inactive";
        }

    $formData = [
        'module_name' => $this->request->getVar('moduleName'),
        'module_ID' => $this->request->getVar('moduleId'),
        'course' => $this->request->getVar('Course'),
        'module_leader' => $this->request->getVar('moduleLeader'),
        'credit_score' => $this->request->getVar('credit'),
        'module_status' => $activeData  
    ];
   
        if ($formData) {
                    
            $userData = $this->userModel->getUserRole($userID);
            $checkMID = $this->moduleModel->checkMID($this->request->getVar('moduleId'));

        if ($userData['role'] === 'Admin') {
            if (!$checkMID) {

                $submittedData = $this->moduleModel->addModule($formData);

             if ($submittedData) {
                $this->session->setTempdata('error', 'Module added succesfully', 3);
                return redirect()->to('/dashboard/modules');
             }

            } else{
                $this->session->setTempdata('error', 'Duplicate MID please enter Unique MID', 3);
             }


        }else{
            $this->session->setTempdata('error', 'Access denied Contact admin!', 3);
             return redirect()->to(current_url());
        }
        }  
    } else {
        $data['validation'] = $this->validator;
    }

    
    echo view('dashboard/template/header', $data);
    echo view('dashboard/addModule', $data);
}

public function edit_module($editID) {
    helper('form');

    $userID = session()->get('logged_user');

    $data = [];
    $data['validation'] = null;
    $data['module'] = $this->moduleModel->getModuleByID($editID);




    if ($this->request->getMethod() == 'post') {

            $rules = [
                'moduleName' => 'required',
                'moduleId' => 'required',
                'Course' => 'required',
                'moduleLeader' => 'required',
                'credit' => 'required',
            
        ];
        

        if ($this->validate($rules)) {

            $activeData = null;

            if ($this->request->getVar('Module_status') == 'active') {
                    $activeData = "active";
                }else{
                    $activeData = "inactive";
                }

            $formData = [
                'module_name' => $this->request->getVar('moduleName'),
                'module_id' => $this->request->getVar('moduleId'),
                'Course' => $this->request->getVar('Course'),
                'module_leader' => $this->request->getVar('moduleLeader'),
                'credit_score' => $this->request->getVar('credit'),
                'Module_status' => $activeData  
            ];
               
            if ($formData) {
                
                $userRole = $this->userModel->getUserRole($userID);
                
              

            if ($userRole['role'] === 'Admin') {
              

                    $submittedData = $this->moduleModel->editModule($formData,$editID);

                 if ($submittedData) {
                    $this->session->setTempdata('error', 'Module edited succesfully', 3);
                    return redirect()->to('/dashboard/modules');
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
    echo view('dashboard/editModule', $data);
}




public function delete_module($id){
    // $userID = session()->get('logged_user');
    $result=$this->moduleModel->delete_module($id);


    if($result){
        return redirect()->to('/dashboard/modules');
        $this->session->setTempdata('error', 'Module deleted succesfully', 3);
    }else{
        $this->session->setTempdata('error', 'Unable to delete Module', 3);
    }
    }

 }