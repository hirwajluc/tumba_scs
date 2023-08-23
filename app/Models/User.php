<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'scs_users';
    protected $primaryKey       = 'usr_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['usr_role','usr_firstname','usr_lastname','usr_gender','usr_picture','usr_email','usr_phone','usr_username','usr_password','usr_title','usr_status','usr_created_at','usr_updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'usr_created_at';
    protected $updatedField  = 'usr_updated_at';
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

    //function to get card tag number
    public function getCardNumber($user_id)
    {
        $reader = new Reader();
        $card = new TempCard();
        $reader_data = $reader->where('rdr_user', $user_id)->first();
        if ($reader_data):
            # code...
            $card_data = $card->where('tcd_reader', $reader_data->rdr_id)->first();
            if($card_data):
                return $card_data->tcd_tag;
            else:
                return 'Tap Card to get number...';
            endif;
        else:
            # code...
            return 'No Card Reader Found!';
        endif;
        
    }
}
