<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogMutasiBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'barang_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'jenis_mutasi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('log_mutasi_barang', true);
    }

    public function down()
    {
        $this->forge->dropTable('log_mutasi_barang');
    }
}

