<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_options` (
                `opt_id` INT NOT NULL AUTO_INCREMENT,
                `opt_department` INT NOT NULL,
                `opt_code` varchar(25) NOT NULL UNIQUE,
                `opt_name` varchar(255) NOT NULL UNIQUE,
                `opt_created_at` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP,
                `opt_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`opt_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_options');
    }
}
