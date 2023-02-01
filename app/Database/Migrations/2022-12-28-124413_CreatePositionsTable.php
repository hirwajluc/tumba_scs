<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePositionsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_positions` (
                `pst_id` INT NOT NULL AUTO_INCREMENT,
                `pst_name` VARCHAR(255) NOT NULL UNIQUE,
                `pst_desc` VARCHAR(255) NOT NULL,
                `pst_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `pst_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (`pst_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_positions');
    }
}
