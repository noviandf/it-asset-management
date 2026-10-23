<?php

namespace App\Controllers;
use App\Models\CatatanItModel;

class CatatanIt extends BaseController
{
    protected $catatanItModel;

    public function __construct()
    {
        $this->catatanItModel = new CatatanItModel();
    }

    public function index()
    {
        $data['catatan_it'] = $this->catatanItModel->findAll();
        return view('catatan_it/index', $data);
    }

    public function create()
    {
        return view('catatan_it/create');
    }

    public function store()
    {
        $this->catatanItModel->save([
            'nama_pc'       => $this->request->getPost('nama_pc'),
            'ip_address'    => $this->request->getPost('ip_address'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'anydesk_id'    => $this->request->getPost('anydesk_id'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'tanggal_catat' => date('Y-m-d') // Otomatis tanggal hari ini
        ]);

        session()->setFlashdata('success', 'Data PC berhasil disimpan.');
        return redirect()->to('/catatanit');
    }
    
    // Jangan lupa sesuaikan juga method update($id) mirip seperti di atas  

    public function edit($id)
    {
        $data['catatan'] = $this->catatanItModel->find($id);
        return view('catatan_it/edit', $data);
    }

  public function update($id)
    {
        // Pastikan key array di sebelah kiri SAMA PERSIS dengan allowedFields di Model
        $data = [
            'nama_pc'       => $this->request->getPost('nama_pc'),
            'ip_address'    => $this->request->getPost('ip_address'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'anydesk_id'    => $this->request->getPost('anydesk_id'), // Perbaikan: Gunakan anydesk_id
            'tanggal_catat' => $this->request->getPost('tanggal_catat'),
            'keterangan'    => $this->request->getPost('keterangan'),
            // Battery health & free space DIHAPUS dari sini
        ];

        if ($this->catatanItModel->update($id, $data)) {
            session()->setFlashdata('success', 'Catatan IT berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui catatan IT.');
        }

        return redirect()->to('/catatanit');
    }

    public function delete($id)
    {
        if ($this->catatanItModel->delete($id)) {
            session()->setFlashdata('success', 'Catatan IT berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus catatan IT.');
        }
        return redirect()->to('/catatanit');
    }
}
