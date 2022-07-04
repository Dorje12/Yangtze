<?php

namespace App\models;

use CodeIgniter\Model;
use Config\Database;

class CourseModel extends Model {

        public function getCoursesList() {

                $db = Database::connect();

                $query = $db->query('select * from WUC_courses');
                $result = $query->getResult();

                if (count($result) > 0) {
                        return $result;
                } else {
                        return false;
                }
        }

        public function addCourse($formData) {
                $builder = $this->db->table('courses');
                $builder->insert($formData);
     
                if ($this->db->affectedRows() == 1) {
                     return true;
                }else{
                     return false;
                }
     
            }

         public function checkCID($courseID) {
                $builder = $this->db->table('courses');
                $builder->select('course_ID');
                $builder->where('course_ID', $courseID);
                $result = $builder->get();

                if (count($result->getResultArray()) == 1) {
                        return $result->getRowArray();
                } else {
                        return false;
                }
        }
            
     
         public function editCourse($data, $editId){
             $builder = $this->db->table('courses');
             $builder->where('ID', $editId);
             $builder->update($data);
     
             if ($this->db->affectedRows() == 1) {
                     return true;
                }else{
                     return false;
                }
            }
     
            public function delete_course($id) {
                $builder = $this->db->table('courses');
                $builder->delete(['ID' => $id]);
     
                if ($this->db->affectedRows() == 1) {
                     return true;
                }else{
                     return false;
                }
            }

        public function getCourseByID($CUID)
        {
                $builder = $this->db->table('courses');
                $builder->where('id', $CUID);
                $result = $builder->get();

                if (count($result->getResultArray()) == 1) {
                        return $result->getRow();
                } else {
                        return false;
                }
        }
     
}