<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Pat_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'Pat_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'Pat_Gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
                'null' => false
            ],
            'Pat_Address' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'Pat_DOB' => [
                'type' => 'DATE',
                'null' => false
            ],
            'PCP_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'Pat_Phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'Pat_Email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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

        $this->forge->addPrimaryKey('Pat_ID');
        $this->forge->addForeignKey('PCP_ID', 'pcps', 'PCP_ID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('patients');
    }

    public function down()
    {
        $this->forge->dropTable('patients');
    }
}