<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRelationsTable extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `scs_options` ADD CONSTRAINT `scs_options_fk0` FOREIGN KEY (`opt_department`) REFERENCES `scs_departments`(`dpt_id`);");
        $this->db->query("ALTER TABLE `scs_students` ADD CONSTRAINT `scs_students_fk0` FOREIGN KEY (`std_option`) REFERENCES `scs_options`(`opt_id`);");
        $this->db->query("ALTER TABLE `scs_staffs` ADD CONSTRAINT `scs_staffs_fk0` FOREIGN KEY (`stf_department`) REFERENCES `scs_staff_departments`(`sdp_id`);");
        $this->db->query("ALTER TABLE `scs_staffs` ADD CONSTRAINT `scs_staffs_fk1` FOREIGN KEY (`stf_position`) REFERENCES `scs_positions`(`pst_id`);");
        $this->db->query("ALTER TABLE `scs_staffs` ADD CONSTRAINT `scs_staffs_fk2` FOREIGN KEY (`stf_title`) REFERENCES `scs_titles`(`tit_id`);");
        $this->db->query("ALTER TABLE `scs_cards` ADD CONSTRAINT `scs_cards_fk0` FOREIGN KEY (`crd_staff`) REFERENCES `scs_staffs`(`stf_id`);");
        $this->db->query("ALTER TABLE `scs_cards` ADD CONSTRAINT `scs_cards_fk1` FOREIGN KEY (`crd_student`) REFERENCES `scs_students`(`std_id`);");
        $this->db->query("ALTER TABLE `scs_cards` ADD CONSTRAINT `scs_cards_fk2` FOREIGN KEY (`crd_acad_year`) REFERENCES `scs_acad_year`(`acd_id`);");
        $this->db->query("ALTER TABLE `scs_users` ADD CONSTRAINT `scs_users_fk0` FOREIGN KEY (`usr_role`) REFERENCES `scs_roles`(`rol_id`);");
        $this->db->query("ALTER TABLE `scs_users` ADD CONSTRAINT `scs_users_fk1` FOREIGN KEY (`usr_title`) REFERENCES `scs_titles`(`tit_id`);");
        $this->db->query("ALTER TABLE `scs_logs` ADD CONSTRAINT `scs_logs_fk0` FOREIGN KEY (`log_gate_user`) REFERENCES `scs_users`(`usr_id`);");
        $this->db->query("ALTER TABLE `scs_logs` ADD CONSTRAINT `scs_logs_fk1` FOREIGN KEY (`log_card`) REFERENCES `scs_cards`(`crd_id`);");
        $this->db->query("ALTER TABLE `scs_logs` ADD CONSTRAINT `scs_logs_fk2` FOREIGN KEY (`log_acad_year`) REFERENCES `scs_acad_year`(`acd_id`);");
        $this->db->query("ALTER TABLE `scs_items` ADD CONSTRAINT `scs_items_fk0` FOREIGN KEY (`itm_student`) REFERENCES `scs_students`(`std_id`);");
        $this->db->query("ALTER TABLE `scs_items` ADD CONSTRAINT `scs_items_fk1` FOREIGN KEY (`itm_staff`) REFERENCES `scs_staffs`(`stf_id`);");
    }

    public function down()
    {
        //$this->forge->dropTable('scs_guests');
    }
}
