<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_students` (
                `std_id` INT NOT NULL AUTO_INCREMENT,
                `std_option` INT NOT NULL,
                `std_regno` varchar(255) NOT NULL UNIQUE,
                `std_firstname` varchar(255) NOT NULL,
                `std_lastname` varchar(255),
                `std_gender` varchar(255) NOT NULL,
                `std_picture` varchar(255),
                `std_level` varchar(255) NOT NULL,
                `std_status` varchar(255) NOT NULL,
                `std_email` varchar(255) NOT NULL,
                `std_phone` varchar(255) NOT NULL,
                `std_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `std_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`std_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_students');
    }
}
