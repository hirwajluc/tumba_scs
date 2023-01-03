<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_users` (
                `usr_id` INT NOT NULL AUTO_INCREMENT,
                `usr_role` INT NOT NULL,
                `usr_firstname` varchar(255) NOT NULL,
                `usr_lastname` varchar(255),
                `usr_gender` varchar(255) NOT NULL,
                `usr_picture` varchar(255),
                `usr_email` varchar(255),
                `usr_phone` varchar(255) NOT NULL,
                `usr_username` varchar(255) NOT NULL UNIQUE,
                `usr_password` varchar(255) NOT NULL,
                `usr_title` INT NOT NULL,
                `usr_status` varchar(25) NOT NULL,
                `usr_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `usr_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`usr_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_users');
    }
}
