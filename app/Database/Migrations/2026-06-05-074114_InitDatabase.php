<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitDatabase extends Migration
{
    public function up()
    {
        // Table barang
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_barang'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'kategori'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'stok_agent'      => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'stok_management' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'stok_server'     => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'backup'          => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'rusak'           => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barang', true);

        // Table catatan_it
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_pc'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'lokasi'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'ip_address'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'anydesk_id'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'tanggal_catat' => ['type' => 'DATE', 'null' => true],
            'keterangan'    => ['type' => 'TEXT', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('catatan_it', true);

        // Table catatan_kerusakan
        $this->forge->addField([
            'id'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_barang'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jumlah'              => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'ruang'               => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tingkat_rusak'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'deskripsi_kerusakan' => ['type' => 'TEXT', 'null' => true],
            'status_perbaikan'    => ['type' => 'ENUM', 'constraint' => ['belum diperbaiki','diperbaiki','diajukan penggantian'], 'default' => 'belum diperbaiki'],
            'estimasi_biaya'      => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'tanggal_catat'       => ['type' => 'DATE', 'null' => true],
            'tanggal_selesai'     => ['type' => 'DATE', 'null' => true],
            'keterangan'          => ['type' => 'TEXT', 'null' => true],
            'created_at'          => ['type' => 'DATETIME', 'null' => true],
            'updated_at'          => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('catatan_kerusakan', true);

        // Table catatan_planning
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'judul'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'deskripsi'   => ['type' => 'TEXT', 'null' => true],
            'tanggal'     => ['type' => 'DATE', 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['PENDING','IN SUBMISSION','DONE','CANCELED'], 'default' => 'PENDING'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('catatan_planning', true);

        // Table users
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('barang', true);
        $this->forge->dropTable('catatan_it', true);
        $this->forge->dropTable('catatan_kerusakan', true);
        $this->forge->dropTable('catatan_planning', true);
        $this->forge->dropTable('users', true);
    }
}
   
