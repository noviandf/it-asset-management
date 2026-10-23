<?php

namespace App\Models;
use CodeIgniter\Model;

class AsetItModel extends Model
{
    protected $table = 'aset_it';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'no_aktiva', 'kategori', 'sub_kategori', 'nama_aset', 'merk', 'tipe', 
        'serial_number', 'lantai', 'ruangan', 'pengguna', 'tanggal_pembelian', 
        'vendor', 'masa_garansi_bulan', 'umur_ekonomis_bulan', 'harga_pembelian', 
        'kondisi_aset', 'keterangan'
    ];
    
    protected $useTimestamps = true;
}
