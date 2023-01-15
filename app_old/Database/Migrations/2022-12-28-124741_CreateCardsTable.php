<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCardsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_cards` (
                `crd_id` INT NOT NULL AUTO_INCREMENT,
                `crd_tag_code` varchar(25) NOT NULL UNIQUE,
                `crd_staff` INT,
                `crd_student` INT,
                `crd_status` varchar(20) NOT NULL,
                `crd_expires` varchar(255) NOT NULL,
                `crd_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `crd_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`crd_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_cards');
    }
}
