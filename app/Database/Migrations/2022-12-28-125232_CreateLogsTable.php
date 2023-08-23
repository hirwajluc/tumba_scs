<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_logs` (
                `log_id` INT NOT NULL AUTO_INCREMENT,
                `log_gate_user` INT NOT NULL,
                `log_card` INT NOT NULL,
                `log_items` varchar(255),
                `log_acad_year` INT NOT NULL,
                `log_status` varchar(25) NOT NULL,
                `log_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `log_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY (`log_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_logs');
    }
}
