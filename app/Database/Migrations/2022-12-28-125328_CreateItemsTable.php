<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_items` (
                `itm_id` INT NOT NULL AUTO_INCREMENT,
                `itm_name` varchar(255) NOT NULL,
                `itm_specification` varchar(255) NOT NULL,
                `itm_student` INT NOT NULL,
                `itm_staff` INT,
                `itm_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `itm_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`itm_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_items');
    }
}
