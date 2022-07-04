<?php

namespace App\models;

use CodeIgniter\Model;
use Config\Database;

class ModuleModel extends Model {

public function getModuleList() {

    $db = Database::connect();

    $query = $db->query('select * from WUC_modules');
    $result = $query->getResult();

    if (count($result) > 0) {
            return $result;
    } else {
            return false;
    }
}

public function addModule($formData) {
        $builder = $this->db->table('modules');
        $builder->insert($formData);

        if ($this->db->affectedRows() == 1) {
             return true;
        }else{
             return false;
        }
       

    }

    public function checkMID($moduleID){
        $builder = $this->db->table('modules');
        $builder->select('module_ID');
        $builder->where('module_ID', $moduleID);
        $result = $builder->get();

        if (count($result->getResultArray()) == 1) {
                return $result->getRowArray();
        } else {
                return false;
        }
    }

    public function editModule($data, $editId){
        $builder = $this->db->table('modules');
        $builder->where('id', $editId);
        $builder->update($data);

        if ($this->db->affectedRows() == 1) {
                return true;
           }else{
                return false;
           }
       }

       public function delete_module($id) {
        $builder = $this->db->table('modules');
        $builder->delete(['id' => $id]);

        if ($this->db->affectedRows() == 1) {
             return true;
        }else{
             return false;
        }

        
    }

        public function getModuleByID($editId)
            {
                    $builder = $this->db->table('modules');
                    $builder->where('id', $editId);
                    $result = $builder->get();
    
                    if (count($result->getResultArray()) == 1) {
                            return $result->getRow();
                    } else {
                            return false;
                    }
            }

}