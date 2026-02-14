<?php
namespace App\Models;
use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_barang', 'kategori', 'stok_agent', 'stok_management', 'stok_server', 'backup', 'rusak'];
}
