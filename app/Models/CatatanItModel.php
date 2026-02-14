<?php
namespace App\Models;
use CodeIgniter\Model;

class CatatanItModel extends Model
{
    protected $table = 'catatan_it';
    protected $primaryKey = 'id';
    // Kita fokus ke data yang dibutuhkan untuk remote
    protected $allowedFields = ['nama_pc', 'ip_address', 'lokasi', 'anydesk_id', 'keterangan', 'tanggal_catat'];
}