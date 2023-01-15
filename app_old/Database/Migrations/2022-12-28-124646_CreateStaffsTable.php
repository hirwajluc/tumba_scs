<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_staffs` (
                `stf_id` INT NOT NULL AUTO_INCREMENT,
                `stf_department` INT NOT NULL,
                `stf_emp_id` varchar(255) NOT NULL UNIQUE,
                `stf_firstname` varchar(255) NOT NULL,
                `stf_lastname` varchar(255),
                `stf_gender` varchar(255) NOT NULL,
                `stf_picture` varchar(255),
                `stf_email` varchar(255) NOT NULL UNIQUE,
                `stf_phone` varchar(255) NOT NULL UNIQUE,
                `stf_position` INT NOT NULL,
                `stf_title` INT(255) NOT NULL,
                `stf_status` varchar(255) NOT NULL,
                `stf_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `stf_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (`stf_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_staffs');
    }
}
