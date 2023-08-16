<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ScsDataSeeder extends Seeder
{
    public function run()
    {
        // Seed roles data
        $roleData = [
            [
                'rol_name' => 'admin',
                'rol_rank' => 1
            ],
            [
                'rol_name' => 'Academic',
                'rol_rank' => 2
            ],
            [
                'rol_name' => 'Academic-Other',
                'rol_rank' => 3
            ],
            [
                'rol_name' => 'Human Resources',
                'rol_rank' => 4
            ],
            [
                'rol_name' => 'security Officer',
                'rol_rank' => 5
            ],
            [
                'rol_name' => 'gate quard',
                'rol_rank' => 6
            ]
        ];

        $this->db->table('scs_roles')->insertBatch($roleData);

        //Seed Titles Data
        $titleData = [
            [
                'tit_full' => 'Mister',
                'tit_short' => 'Mr.'
            ],
            [
                'tit_full' => 'Mistress',
                'tit_short' => 'Mrs.'
            ],
            [
                'tit_full' => 'Doctor',
                'tit_short' => 'Dr.'
            ],
            [
                'tit_full' => 'Engineer',
                'tit_short' => 'Eng.'
            ]
        ];

        $this->db->table('scs_titles')->insertBatch($titleData);

        // Seed user data
        $userData = [
            'usr_role' => 1,
            'usr_firstname' => 'System',
            'usr_lastname' => 'Admin',
            'usr_gender' => 'male',
            'usr_email' => 'byonkuru@gmail.com',
            'usr_phone' => '+250783821750',
            'usr_username' => 'admin',
            'usr_password' => 'admin@123',
            'usr_title' => 1,
            'usr_status' => 'active'
        ];
        
        $this->db->table('scs_users')->insert($userData);

        // Seed RFID Reader data
        $readerData = [
            'rdr_user' => 1,
            'rdr_location' => 'System Admin'
        ];
        
        $this->db->table('scs_readers')->insert($readerData);
    }
}
