<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReaderTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_readers` (
                `rdr_id` INT NOT NULL AUTO_INCREMENT,
                `rdr_user` INT NOT NULL,
                `rdr_location` varchar(255) NOT NULL,
                `rdr_created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                `rdr_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`rdr_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_readers');
    }
}
