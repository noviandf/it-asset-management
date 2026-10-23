<?php

namespace App\Controllers;
use App\Models\LogMutasiModel;

class LogMutasi extends BaseController
{
    protected $logMutasiModel;

    public function __construct()
    {
        $this->logMutasiModel = new LogMutasiModel();
    }

    public function index()
    {
        $builder = $this->logMutasiModel->builder();
        $builder->select('log_mutasi_barang.*, COALESCE(aset_it.no_aktiva, barang.nama_barang) as referensi, COALESCE(aset_it.nama_aset, barang.kategori) as deskripsi, users.username');
        $builder->join('aset_it', "aset_it.id = log_mutasi_barang.barang_id AND log_mutasi_barang.entitas = 'aset_it'", 'left');
        $builder->join('barang', "barang.id = log_mutasi_barang.barang_id AND log_mutasi_barang.entitas = 'barang'", 'left');
        $builder->join('users', 'users.id = log_mutasi_barang.user_id', 'left');
        $builder->orderBy('log_mutasi_barang.created_at', 'DESC');
        
        $data['logs'] = $builder->get()->getResultArray();
        return view('log_mutasi/index', $data);
    }
}
