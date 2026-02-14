<?php
namespace App\Models;
use CodeIgniter\Model;

class CatatanKerusakanModel extends Model
{
    protected $table = 'catatan_kerusakan';
    protected $primaryKey = 'id';
    
    // Daftar lengkap kolom yang bisa diisi
    protected $allowedFields = [
        'nama_barang', 
        'jumlah', 
        'ruang', 
        'tingkat_rusak', 
        'deskripsi_kerusakan', 
        'status_perbaikan', 
        'estimasi_biaya', 
        'tanggal_catat', 
        'tanggal_selesai', 
        'keterangan'
    ];
}