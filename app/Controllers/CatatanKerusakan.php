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
        $asetModel = new \App\Models\AsetItModel();
        $data['barang'] = $asetModel->where('kondisi_aset !=', 'Dihapus')->findAll();
        return view('catatan_kerusakan/create', $data);
    }

    public function store()
    {
        // Cek jika tanggal selesai dikosongkan
        $tglSelesai = $this->request->getPost('tanggal_selesai');
        if (empty($tglSelesai)) {
            $tglSelesai = null;
        }

        $barang_id = $this->request->getPost('barang_id');
        $nama_barang = $this->request->getPost('nama_barang');
        $jumlah = (int) $this->request->getPost('jumlah');
        $ruang = $this->request->getPost('ruang');
        $status_perbaikan = $this->request->getPost('status_perbaikan');

        if (!empty($barang_id)) {
            $asetModel = new \App\Models\AsetItModel();
            $barangInfo = $asetModel->find($barang_id);
            if ($barangInfo) {
                $nama_barang = $barangInfo['no_aktiva'] . ' - ' . $barangInfo['nama_aset'];
                
                // Automasi Stok saat buat baru (asumsinya barang jadi rusak)
                if ($status_perbaikan != 'Selesai Perbaikan') {
                    $asetModel->update($barang_id, [
                        'kondisi_aset' => 'Rusak'
                    ]);
                    // Log Mutasi
                    $logMutasiModel = new \App\Models\LogMutasiModel();
                    $logMutasiModel->save(['barang_id' => $barang_id, 'jenis_mutasi' => 'RUSAK', 'jumlah' => 1, 'keterangan' => "Auto: Laporan Kerusakan Dibuat", 'user_id' => session()->get('user_id')]);
                }
            }
        }

        $this->catatanKerusakanModel->save([
            'barang_id'   => $barang_id,
            'nama_barang' => $nama_barang,
            'jumlah'      => $jumlah,
            'ruang'       => $ruang,
            'tingkat_rusak' => $this->request->getPost('tingkat_rusak'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'status_perbaikan' => $status_perbaikan,
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

        $oldData = $this->catatanKerusakanModel->find($id);
        $barang_id = $this->request->getPost('barang_id');
        $nama_barang = $this->request->getPost('nama_barang');
        $status_perbaikan = $this->request->getPost('status_perbaikan');
        $jumlah = (int) $this->request->getPost('jumlah');

        if (!empty($barang_id)) {
            $asetModel = new \App\Models\AsetItModel();
            $barangInfo = $asetModel->find($barang_id);
            if ($barangInfo) {
                $nama_barang = $barangInfo['no_aktiva'] . ' - ' . $barangInfo['nama_aset'];
                
                // Automasi Stok saat status berubah menjadi Selesai Perbaikan
                if ($oldData['status_perbaikan'] != 'Selesai Perbaikan' && $status_perbaikan == 'Selesai Perbaikan') {
                    $asetModel->update($barang_id, [
                        'kondisi_aset' => 'Backup'
                    ]);
                    $logMutasiModel = new \App\Models\LogMutasiModel();
                    $logMutasiModel->save(['barang_id' => $barang_id, 'jenis_mutasi' => 'MASUK', 'jumlah' => 1, 'keterangan' => "Auto: Perbaikan selesai, masuk ke Backup", 'user_id' => session()->get('user_id')]);
                }
            }
        }

        $this->catatanKerusakanModel->update($id, [
            'barang_id'   => $barang_id,
            'nama_barang' => $nama_barang,
            'jumlah'      => $jumlah,
            'ruang'       => $this->request->getPost('ruang'),
            'tingkat_rusak' => $this->request->getPost('tingkat_rusak'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'status_perbaikan' => $status_perbaikan,
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
        $asetModel = new \App\Models\AsetItModel();
        $data['barang'] = $asetModel->where('kondisi_aset !=', 'Dihapus')->findAll();
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
    public function exportCsv()
    {
        $filename = 'issues_report_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $kerusakan = $this->catatanKerusakanModel->findAll();

        $file = fopen('php://output', 'w');

        $header = ['ID', 'Nama Barang', 'Jumlah', 'Ruang', 'Tingkat Rusak', 'Deskripsi Kerusakan', 'Status Perbaikan', 'Estimasi Biaya', 'Tanggal Catat', 'Tanggal Selesai', 'Keterangan'];
        fputcsv($file, $header);

        foreach ($kerusakan as $k) {
            fputcsv($file, [
                $k['id'],
                $k['nama_barang'],
                $k['jumlah'],
                $k['ruang'],
                $k['tingkat_rusak'],
                $k['deskripsi_kerusakan'],
                $k['status_perbaikan'],
                $k['estimasi_biaya'],
                $k['tanggal_catat'],
                $k['tanggal_selesai'],
                $k['keterangan']
            ]);
        }
        fclose($file);
        exit;
    }
}
