<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'scs_students';
    protected $primaryKey       = 'std_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['std_option', 'std_regno', 'std_firstname', 'std_lastname', 'std_gender', 'std_picture', 'std_level', 'std_status', 'std_email', 'std_phone', 'std_created_at', 'std_updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'std_created_at';
    protected $updatedField  = 'std_updated_at';
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
    public function cardStatus($std_id)
    {
        $card = new Card();
        $cardData = $card->where('crd_student', $std_id)->first();
        if ($cardData) {
            return $cardData->crd_status;
        } else{
            return 'No card';
        }
    }
}
