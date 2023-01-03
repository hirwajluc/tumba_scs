<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffDepartmentsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_staff_departments` (
                `sdp_id` INT NOT NULL AUTO_INCREMENT,
                `sdp_name` varchar(255) NOT NULL UNIQUE,
                `sdp_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL UNIQUE,
                `sdp_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL UNIQUE,
                PRIMARY KEY (`sdp_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_staff_departments');
    }
}
