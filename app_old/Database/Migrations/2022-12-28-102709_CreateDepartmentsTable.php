<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        // $fields = [
        //     'dpt_id' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'dpt_code' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 20,
        //         'unique' => true
        //     ],
        //     'dpt_name' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 20,
        //         'unique' => true
        //     ]
        // ];

        // $this->forge->addField($fields);
        // $this->forge->addKey('dpt_id', true);
        // $this->forge->createTable('scs_departments');
        $this->db->query("
            CREATE TABLE `scs_departments` (
            `dpt_id` INT NOT NULL AUTO_INCREMENT,
            `dpt_code` varchar(20) NOT NULL UNIQUE,
            `dpt_name` varchar(255) NOT NULL UNIQUE,
            `dpt_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `dpt_updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`dpt_id`)
        );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('scs_departments');
    }
}
