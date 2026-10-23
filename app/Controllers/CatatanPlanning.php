<?php

namespace App\Controllers;
use App\Models\CatatanPlanningModel;

class CatatanPlanning extends BaseController
{
    protected $catatanPlanningModel;

    public function __construct()
    {
        $this->catatanPlanningModel = new CatatanPlanningModel();
    }

    public function index()
    {
        $data['catatan_planning'] = $this->catatanPlanningModel->findAll();
        return view('catatan_planning/index', $data);
    }

    public function create()
    {
        return view('catatan_planning/create');
    }

    public function store()
    {
        if ($this->catatanPlanningModel->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $this->request->getPost('status'),
            'pic' => $this->request->getPost('pic'),
        ])) {
            session()->setFlashdata('success', 'Catatan planning berhasil ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan catatan planning.');
        }
        return redirect()->to('/catatanplanning');
    }

    public function edit($id)
    {
        $data['planning'] = $this->catatanPlanningModel->find($id);
        return view('catatan_planning/edit', $data);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');
        $planning = $this->catatanPlanningModel->find($id);
        
        $tanggal_selesai = $planning['tanggal_selesai'] ?? null;
        if ($status == 'DONE' && empty($tanggal_selesai)) {
            $tanggal_selesai = date('Y-m-d');
        } elseif ($status != 'DONE') {
            $tanggal_selesai = null;
        }

        if ($this->catatanPlanningModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $status,
            'pic' => $this->request->getPost('pic'),
            'tanggal_selesai' => $tanggal_selesai
        ])) {
            session()->setFlashdata('success', 'Catatan planning berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui catatan planning.');
        }
        return redirect()->to('/catatanplanning');
    }

    public function delete($id)
    {
        if ($this->catatanPlanningModel->delete($id)) {
            session()->setFlashdata('success', 'Catatan planning berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus catatan planning.');
        }
        return redirect()->to('/catatanplanning');
    }
}
