<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_roles` (
                `rol_id` INT NOT NULL AUTO_INCREMENT,
                `rol_name` varchar(255) NOT NULL UNIQUE,
                `rol_rank` INT NOT NULL UNIQUE,
                `rol_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `rol_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`rol_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_roles');
    }
}
