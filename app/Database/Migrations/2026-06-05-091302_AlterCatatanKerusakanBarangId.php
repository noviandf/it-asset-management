<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCatatanKerusakanBarangId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('catatan_kerusakan', [
            'barang_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('catatan_kerusakan', 'barang_id');
    }
}
