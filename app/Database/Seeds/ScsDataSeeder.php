<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ScsDataSeeder extends Seeder
{
    public function run()
    {
        // Seed roles data
        $roleData = [
            'rol_name' => 'admin'
        ];

        $this->db->table('scs_roles')->insert($roleData);

        //Seed Titles Data
        $titleData = [
            'tit_full' => 'Mister',
            'tit_short' => 'Mr.'
        ];

        $this->db->table('scs_titles')->insert($titleData);

        // Seed user data
        $userData = [
            'usr_role' => 1,
            'usr_firstname' => 'System',
            'usr_lastname' => 'Admin',
            'usr_gender' => 'Male',
            'usr_email' => 'byonkuru@gmail.com',
            'usr_phone' => '+250783821750',
            'usr_username' => 'admin',
            'usr_password' => 'admin@123',
            'usr_title' => 1,
            'usr_status' => 'active'
        ];
        
        $this->db->table('scs_users')->insert($userData);
    }
}
