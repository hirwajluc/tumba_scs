<?php

namespace App\Models;

use CodeIgniter\Model;

class Staff extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'scs_staffs';
    protected $primaryKey       = 'stf_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['stf_title', 'stf_emp_id', 'stf_position', 'stf_firstname', 'stf_lastname', 'stf_gender', 'stf_picture', 'stf_phone', 'stf_status', 'stf_email', 'stf_department', 'stf_position', 'std_created_at', 'std_updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'stf_created_at';
    protected $updatedField  = 'stf_updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //Check whether the student has a card
    public function cardStatus($stf_id)
    {
        $card = new Card();
        $cardData = $card->where('crd_staff', $stf_id)->first();
        if ($cardData) {
            return $cardData->crd_status;
        } else{
            return 'No card';
        }
    }
}
