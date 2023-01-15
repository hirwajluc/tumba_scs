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
                `pst_name` INT NOT NULL UNIQUE,
                `pst_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL UNIQUE,
                `pst_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL UNIQUE,
                PRIMARY KEY (`pst_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_positions');
    }
}
