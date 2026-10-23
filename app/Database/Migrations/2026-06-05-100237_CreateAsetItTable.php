<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAsetItTable extends Migration
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
            'no_aktiva' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'sub_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nama_aset' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'merk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tipe' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'serial_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'lantai' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'ruangan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'pengguna' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tanggal_pembelian' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'vendor' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'masa_garansi_bulan' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'umur_ekonomis_bulan' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'harga_pembelian' => [
                'type' => 'DOUBLE',
                'default' => 0,
            ],
            'kondisi_aset' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'Digunakan', // Digunakan, Backup, Rusak, Dihapus
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('aset_it', true);
    }

    public function down()
    {
        $this->forge->dropTable('aset_it');
    }
}

