<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTitlesTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_titles` (
                `tit_id` INT NOT NULL AUTO_INCREMENT,
                `tit_full` varchar(255) NOT NULL UNIQUE,
                `tit_short` varchar(25) NOT NULL UNIQUE,
                `tit_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `tit_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (`tit_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_titles');
    }
}
