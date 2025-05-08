<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePcpsTable extends Migration 
{
    public function up()
    {
        $this->forge->addField([
            'PCP_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'PCP_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'PCP_Specialty' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'PCP_Phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'PCP_Email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'PCP_Address' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('PCP_ID');
        $this->forge->createTable('pcps');
    }

    public function down()
    {
        $this->forge->dropTable('pcps');
    }
}