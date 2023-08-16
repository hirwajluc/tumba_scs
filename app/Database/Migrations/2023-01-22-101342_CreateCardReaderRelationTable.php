<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCardReaderRelationTable extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `scs_readers` ADD CONSTRAINT `scs_readers_fk0` FOREIGN KEY (`rdr_user`) REFERENCES `scs_users`(`usr_id`);");
        $this->db->query("ALTER TABLE `scs_temp_cards` ADD CONSTRAINT `scs_temp_cards_fk0` FOREIGN KEY (`tcd_reader`) REFERENCES `scs_readers`(`rdr_id`);");
    }

    public function down()
    {
        //$this->forge->dropTable('scs_guests');
    }
}
