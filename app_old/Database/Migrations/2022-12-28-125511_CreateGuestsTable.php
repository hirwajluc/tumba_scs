<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuestsTable extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TABLE `scs_guests` (
                `gst_id` INT NOT NULL AUTO_INCREMENT,
                `gst_nid` varchar(255),
                `gst_firstname` varchar(255) NOT NULL,
                `gst_lastname` varchar(255),
                `gst_gender` varchar(255) NOT NULL,
                `gst_item_in` varchar(255),
                `gst_item_out` varchar(255),
                `gst_time_in` varchar(255) NOT NULL,
                `gst_time_out` varchar(255),
                PRIMARY KEY (`gst_id`)
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_guests');
    }
}
