<?php

namespace App\Controllers;
use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data['barang'] = $this->barangModel->findAll();
        return view('barang/index', $data);
    }

    public function store()
{
    // Pastikan nama input di form (view) juga sudah sesuai dengan getPost ini
    $this->barangModel->save([
        'nama_barang'     => $this->request->getPost('nama_barang'),
        'kategori'        => $this->request->getPost('kategori'),
        // Ambil data stok per ruangan
        'stok_agent'      => $this->request->getPost('stok_agent'),
        'stok_management' => $this->request->getPost('stok_management'),
        'stok_server'     => $this->request->getPost('stok_server'),
        'backup'          => $this->request->getPost('backup'),
        'rusak'           => $this->request->getPost('rusak'),
    ]);

    session()->setFlashdata('success', 'Barang berhasil ditambahkan.');
    return redirect()->to('/barang');
}

public function update($id)
{
    $this->barangModel->update($id, [
        'nama_barang'     => $this->request->getPost('nama_barang'),
        'kategori'        => $this->request->getPost('kategori'),
        // Update data stok per ruangan
        'stok_agent'      => $this->request->getPost('stok_agent'),
        'stok_management' => $this->request->getPost('stok_management'),
        'stok_server'     => $this->request->getPost('stok_server'),
        'backup'          => $this->request->getPost('backup'),
        'rusak'           => $this->request->getPost('rusak'),
    ]);

    session()->setFlashdata('success', 'Barang berhasil diperbarui.');
    return redirect()->to('/barang');
}

    public function create()
    {
        return view('barang/create');
    }

    public function edit($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('barang/edit', $data);
    }

    public function delete($id)
    {
        $delete = $this->barangModel->delete($id);

        if ($delete) {
            session()->setFlashdata('success', 'Barang berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus barang.');
        }

        return redirect()->to('/barang');
    }
}
