<?php

namespace App\Models;
use CodeIgniter\Model;

class CatatanPlanningModel extends Model
{
    protected $table = 'catatan_planning';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'deskripsi', 'tanggal', 'status', 'pic', 'tanggal_selesai'];
    protected $useTimestamps = true;
}
