<?php

namespace App\Models;
use CodeIgniter\Model;

class LogMutasiModel extends Model
{
    protected $table = 'log_mutasi_barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['entitas', 'barang_id', 'jenis_mutasi', 'jumlah', 'keterangan', 'user_id'];
    protected $useTimestamps = true;
    protected $updatedField  = ''; // We only need created_at for logs
}
