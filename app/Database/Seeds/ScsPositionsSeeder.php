<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ScsPositionsSeeder  extends Seeder
{
    public function run()
    {

        //Seed Positions Data
        $positionsData = [
            [
                'pst_name' => 'Principal'
            ],

            [
                'pst_name' => 'DPAT'
            ],
            [
                'pst_name' => 'DAS'
            ],
            [
                'pst_name' => 'Assistant Lecturer'
            ],
            [
                'pst_name' => 'Lecturer'
            ],
            [
                'pst_name' => 'Lab Technician'
            ],

        ];

        $this->db->table('scs_positions')->insertBatch($positionsData);
    }
}
