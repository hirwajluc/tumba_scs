<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTempCardTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_temp_cards` (
                `tcd_id` INT NOT NULL AUTO_INCREMENT,
                `tcd_reader` INT NOT NULL,
                `tcd_tag` varchar(255) NOT NULL,
                `tcd_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `tcd_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`tcd_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_temp_cards');
    }
}
