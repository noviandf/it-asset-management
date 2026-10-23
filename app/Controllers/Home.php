<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $data = [
            'total_pc' => $db->table('catatan_it')->countAllResults(),
            'total_issues' => $db->table('catatan_kerusakan')->where('status_perbaikan !=', 'diperbaiki')->countAllResults(),
            'total_planning' => $db->table('catatan_planning')->where('status', 'PENDING')->orWhere('status', 'IN SUBMISSION')->countAllResults(),
            'total_assets' => $db->table('barang')->selectSum('stok_agent')->selectSum('stok_management')->selectSum('stok_server')->get()->getRowArray()
        ];
        
        $data['total_assets_count'] = ($data['total_assets']['stok_agent'] ?? 0) + ($data['total_assets']['stok_management'] ?? 0) + ($data['total_assets']['stok_server'] ?? 0);

        // Fetch chart data (Aset IT by condition)
        $data['chart_aset_kondisi'] = $db->table('aset_it')
                                         ->select('kondisi_aset, COUNT(*) as total')
                                         ->groupBy('kondisi_aset')
                                         ->get()->getResultArray();

        // Fetch recent mutation logs
        $data['recent_logs'] = $db->table('log_mutasi_barang')
                                  ->select('log_mutasi_barang.created_at as tanggal, COALESCE(aset_it.no_aktiva, barang.nama_barang) as no_aktiva, log_mutasi_barang.jenis_mutasi as status, log_mutasi_barang.keterangan')
                                  ->join('aset_it', "aset_it.id = log_mutasi_barang.barang_id AND log_mutasi_barang.entitas = 'aset_it'", 'left')
                                  ->join('barang', "barang.id = log_mutasi_barang.barang_id AND log_mutasi_barang.entitas = 'barang'", 'left')
                                  ->orderBy('log_mutasi_barang.created_at', 'DESC')
                                  ->limit(5)
                                  ->get()->getResultArray();

        return view('dashboard/index', $data);
    }
}
