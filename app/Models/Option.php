<?php

namespace App\Models;

use CodeIgniter\Model;

class Option extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'scs_options';
    protected $primaryKey       = 'opt_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['opt_department', 'opt_code', 'opt_name', 'opt_created_at', 'opt_updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'opt_created_at';
    protected $updatedField  = 'opt_updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'department' => [
            'label' => 'Option Department',
            'rules' => 'required',
            'errors' => [
                'required' => 'Please select department'
            ]
        ],
        'code' => [
            'label' => 'Option Code',
            'rules' => 'required|min_length[2]|alpha_numeric_space|is_unique[scs_options.opt_code]',
            'errors' => [
                'is_unique' => 'The {field} already exists'
            ]
        ],
        'name' => [
            'label' => 'Option Name',
            'rules' => 'required|min_length[4]|alpha_numeric_space|is_unique[scs_options.opt_name]',
            'errors' => [
                'is_unique' => 'The {field} already exists'
            ]
        ]
    ];
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
}
