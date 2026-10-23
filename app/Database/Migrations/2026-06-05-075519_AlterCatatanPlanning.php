<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCatatanPlanning extends Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['PENDING', 'IN SUBMISSION', 'IN PROGRESS', 'DONE', 'CANCELED'],
                'default' => 'PENDING',
            ],
            'pic' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'status'
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'tanggal'
            ]
        ];

        $this->forge->modifyColumn('catatan_planning', ['status' => $fields['status']]);
        $this->forge->addColumn('catatan_planning', [
            'tanggal_selesai' => $fields['tanggal_selesai'],
            'pic' => $fields['pic']
        ]);
    }

    public function down()
    {
        // Revert status enum back to original
        $this->forge->modifyColumn('catatan_planning', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['PENDING', 'IN SUBMISSION', 'DONE', 'CANCELED'],
                'default' => 'PENDING',
            ]
        ]);
        
        $this->forge->dropColumn('catatan_planning', ['tanggal_selesai', 'pic']);
    }
}
