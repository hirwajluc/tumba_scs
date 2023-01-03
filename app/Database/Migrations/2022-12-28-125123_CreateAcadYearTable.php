<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAcadYearTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_acad_year` (
                `acd_id` INT NOT NULL AUTO_INCREMENT,
                `acd_year` varchar(20) NOT NULL UNIQUE,
                `acd_status` varchar(20) NOT NULL,
                `acd_started_at` varchar(255) NOT NULL,
                `acd_ended_at` varchar(255) NOT NULL,
                PRIMARY KEY (`acd_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_acad_year');
    }
}
