<?php

namespace App\Controllers;
use App\Models\CatatanKerusakanModel;

class CatatanKerusakan extends BaseController
{
    protected $catatanKerusakanModel;

    public function __construct()
    {
        $this->catatanKerusakanModel = new CatatanKerusakanModel();
    }

    public function index()
    {
        $data['catatan_kerusakan'] = $this->catatanKerusakanModel->findAll();
        return view('catatan_kerusakan/index', $data);
    }

    public function create()
    {
        return view('catatan_kerusakan/create');
    }

    public function store()
    {
        // Cek jika tanggal selesai dikosongkan
        $tglSelesai = $this->request->getPost('tanggal_selesai');
        if (empty($tglSelesai)) {
            $tglSelesai = null;
        }

        $this->catatanKerusakanModel->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'ruang'       => $this->request->getPost('ruang'),
            'tingkat_rusak' => $this->request->getPost('tingkat_rusak'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'status_perbaikan' => $this->request->getPost('status_perbaikan'),
            'estimasi_biaya' => $this->request->getPost('estimasi_biaya'),
            'tanggal_catat' => $this->request->getPost('tanggal_catat'),
            'tanggal_selesai' => $tglSelesai,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        session()->setFlashdata('success', 'Laporan kerusakan berhasil dibuat.');
        return redirect()->to('/catatankerusakan');
    }

    public function update($id)
    {
        $tglSelesai = $this->request->getPost('tanggal_selesai');
        if (empty($tglSelesai)) {
            $tglSelesai = null;
        }

        $this->catatanKerusakanModel->update($id, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah'      => $this->request->getPost('jumlah'),
            'ruang'       => $this->request->getPost('ruang'),
            'tingkat_rusak' => $this->request->getPost('tingkat_rusak'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'status_perbaikan' => $this->request->getPost('status_perbaikan'),
            'estimasi_biaya' => $this->request->getPost('estimasi_biaya'),
            'tanggal_catat' => $this->request->getPost('tanggal_catat'),
            'tanggal_selesai' => $tglSelesai,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        session()->setFlashdata('success', 'Update data kerusakan berhasil.');
        return redirect()->to('/catatankerusakan');
    }

    public function edit($id)
    {
        $data['kerusakan'] = $this->catatanKerusakanModel->find($id);
        return view('catatan_kerusakan/edit', $data);
    }

    public function delete($id)
    {
        if ($this->catatanKerusakanModel->delete($id)) {
            session()->setFlashdata('success', 'Catatan kerusakan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus catatan kerusakan.');
        }
        return redirect()->to('/catatankerusakan');
    }
}
