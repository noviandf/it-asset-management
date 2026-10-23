<?php

namespace App\Controllers;
use App\Models\AsetItModel;
use App\Models\LogMutasiModel;

class AsetIt extends BaseController
{
    protected $asetItModel;

    public function __construct()
    {
        $this->asetItModel = new AsetItModel();
    }

    public function index()
    {
        $rooms = [
            'Ruang Agent' => 'Lt. 2', 
            'Mushola' => 'Lt. 2', 
            'Meeting Room' => 'Lt. 1', 
            'Ruang Management' => 'Lt. 1', 
            'Ruang Server' => 'Lt. 1', 
            'Lobby' => 'Lt. 1', 
            'Parkir' => 'Lt. 1', 
            'Pantry' => 'Lt. 1', 
            'Lantai 3' => 'Lt. 3',
            'Lainnya' => '-' // Untuk menampung ruangan yang tidak ada di daftar atas (misal: Gudang)
        ];

        // Optimasi: Gunakan SQL Aggregation ketimbang meload seluruh row ke RAM
        $db = \Config\Database::connect();
        $builder = $db->table('aset_it');
        $builder->select('nama_aset, kondisi_aset, ruangan, COUNT(*) as qty');
        $builder->where('nama_aset !=', '');
        $builder->where('nama_aset IS NOT NULL');
        $builder->groupBy('nama_aset, kondisi_aset, ruangan');
        $aggregatedData = $builder->get()->getResultArray();
        
        $summary = [];
        
        foreach ($aggregatedData as $row) {
            $cat = $row['nama_aset'];
            $qty = (int)$row['qty'];
            
            if (!isset($summary[$cat])) {
                $summary[$cat] = [
                    'nama_aset' => $cat,
                    'total' => 0,
                    'rusak' => 0,
                    'backup' => 0,
                    'ruangan' => []
                ];
                // Inisialisasi counter per ruangan
                foreach ($rooms as $room => $lantai) {
                    $summary[$cat]['ruangan'][$room] = 0;
                }
            }
            
            $summary[$cat]['total'] += $qty;
            
            if ($row['kondisi_aset'] === 'Rusak') {
                $summary[$cat]['rusak'] += $qty;
            } elseif ($row['kondisi_aset'] === 'Backup') {
                $summary[$cat]['backup'] += $qty;
            }
            
            $r = $row['ruangan'];
            // Jika r tidak ada di list $rooms, masukkan ke 'Lainnya'
            // Juga handle jika 'Ruang Meeting' diinput alih-alih 'Meeting Room'
            if ($r === 'Ruang Meeting') $r = 'Meeting Room';
            
            if (isset($rooms[$r])) {
                $summary[$cat]['ruangan'][$r] += $qty;
            } else {
                $summary[$cat]['ruangan']['Lainnya'] += $qty;
            }
        }
        
        $data['summary'] = $summary;
        $data['rooms'] = $rooms;
        return view('aset_it/index', $data);
    }

    public function detail()
    {
        $nama_aset = $this->request->getGet('nama_aset');
        
        if (!empty($nama_aset)) {
            $data['aset'] = $this->asetItModel->where('nama_aset', $nama_aset)->findAll();
            $data['nama_aset_filter'] = $nama_aset;
        } else {
            $data['aset'] = $this->asetItModel->findAll();
            $data['nama_aset_filter'] = 'Semua Barang';
        }
        
        return view('aset_it/detail', $data);
    }

    public function create_multiple()
    {
        return view('aset_it/create_multiple');
    }

    public function store_multiple()
    {
        // Validasi Input
        $rules = [
            'prefix_aktiva'   => 'required',
            'start_angka'     => 'required|is_natural_no_zero',
            'jumlah_generate' => 'required|is_natural_no_zero|less_than_equal_to[50]',
            'nama_aset'       => 'required',
            'kategori'        => 'required',
            'ruangan'         => 'required'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Validasi gagal. Pastikan form diisi dengan benar.');
            return redirect()->back()->withInput();
        }

        $prefix = $this->request->getPost('prefix_aktiva');
        $start_angka = (int) $this->request->getPost('start_angka');
        $jumlah_generate = (int) $this->request->getPost('jumlah_generate');

        $kategori = $this->request->getPost('kategori');
        $sub_kategori = $this->request->getPost('sub_kategori');
        $nama_aset = $this->request->getPost('nama_aset');
        $merk = $this->request->getPost('merk');
        $tipe = $this->request->getPost('tipe');
        $lantai = $this->request->getPost('lantai');
        $ruangan = $this->request->getPost('ruangan');
        $pengguna = $this->request->getPost('pengguna');
        
        $tanggal_pembelian = $this->request->getPost('tanggal_pembelian');
        if (empty($tanggal_pembelian)) $tanggal_pembelian = null;

        $vendor = $this->request->getPost('vendor');
        $masa_garansi_bulan = $this->request->getPost('masa_garansi_bulan');
        if (empty($masa_garansi_bulan)) $masa_garansi_bulan = null;

        $umur_ekonomis_bulan = (int) $this->request->getPost('umur_ekonomis_bulan');
        $harga_pembelian = (float) $this->request->getPost('harga_pembelian');
        $keterangan = $this->request->getPost('keterangan');

        $logMutasiModel = new LogMutasiModel();
        
        if (empty($prefix)) {
            $prefix = 'ASET-';
        }

        $db = \Config\Database::connect();
        $db->transStart(); // Mulai Transaksi Database

        $inserted = 0;
        for ($i = 0; $i < $jumlah_generate; $i++) {
            $current_angka = str_pad($start_angka + $i, 4, '0', STR_PAD_LEFT);
            $no_aktiva = $prefix . $current_angka;

            // Pastikan tidak duplicate
            while ($this->asetItModel->where('no_aktiva', $no_aktiva)->first()) {
                $start_angka++;
                $current_angka = str_pad($start_angka + $i, 4, '0', STR_PAD_LEFT);
                $no_aktiva = $prefix . $current_angka;
            }

            $data = [
                'no_aktiva' => $no_aktiva,
                'kategori' => $kategori,
                'sub_kategori' => $sub_kategori,
                'nama_aset' => $nama_aset,
                'merk' => $merk,
                'tipe' => $tipe,
                'serial_number' => 'Belum Diatur',
                'lantai' => $lantai,
                'ruangan' => $ruangan,
                'pengguna' => empty($pengguna) ? null : $pengguna,
                'tanggal_pembelian' => $tanggal_pembelian,
                'vendor' => $vendor,
                'masa_garansi_bulan' => $masa_garansi_bulan,
                'umur_ekonomis_bulan' => $umur_ekonomis_bulan,
                'harga_pembelian' => $harga_pembelian,
                'kondisi_aset' => 'Digunakan',
                'keterangan' => $keterangan,
            ];

            if ($this->asetItModel->save($data)) {
                $newId = $this->asetItModel->getInsertID();
                $inserted++;
                
                // Log Mutasi
                $logMutasiModel->save([
                    'entitas' => 'aset_it',
                    'barang_id' => $newId,
                    'jenis_mutasi' => 'MASUK',
                    'jumlah' => 1,
                    'keterangan' => "Input Baru ({$ruangan})",
                    'user_id' => session()->get('user_id')
                ]);
            }
        }

        $db->transComplete(); // Selesai Transaksi

        if ($db->transStatus() === false) {
            session()->setFlashdata('error', 'Gagal menambahkan aset IT karena kesalahan sistem. Tidak ada data yang disimpan.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', "Berhasil menambahkan {$inserted} aset IT.");
        return redirect()->to('/asetit');
    }
    
    public function edit($id)
    {
        $data['aset'] = $this->asetItModel->find($id);
        return view('aset_it/edit', $data);
    }

    public function update($id)
    {
        // Validasi Input
        $rules = [
            'nama_aset' => 'required',
            'kategori'  => 'required',
            'ruangan'   => 'required'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Validasi gagal. Pastikan form diisi dengan benar.');
            return redirect()->back()->withInput();
        }

        $oldData = $this->asetItModel->find($id);

        $tanggal_pembelian = $this->request->getPost('tanggal_pembelian');
        if (empty($tanggal_pembelian)) $tanggal_pembelian = null;

        $masa_garansi_bulan = $this->request->getPost('masa_garansi_bulan');
        if (empty($masa_garansi_bulan)) $masa_garansi_bulan = null;

        $data = [
            'kategori' => $this->request->getPost('kategori'),
            'sub_kategori' => $this->request->getPost('sub_kategori'),
            'nama_aset' => $this->request->getPost('nama_aset'),
            'merk' => $this->request->getPost('merk'),
            'tipe' => $this->request->getPost('tipe'),
            'serial_number' => $this->request->getPost('serial_number'),
            'lantai' => $this->request->getPost('lantai'),
            'ruangan' => $this->request->getPost('ruangan'),
            'pengguna' => empty($this->request->getPost('pengguna')) ? null : $this->request->getPost('pengguna'),
            'tanggal_pembelian' => $tanggal_pembelian,
            'vendor' => $this->request->getPost('vendor'),
            'masa_garansi_bulan' => $masa_garansi_bulan,
            'umur_ekonomis_bulan' => (int) $this->request->getPost('umur_ekonomis_bulan'),
            'harga_pembelian' => (float) $this->request->getPost('harga_pembelian'),
            'kondisi_aset' => $this->request->getPost('kondisi_aset'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $db = \Config\Database::connect();
        $db->transStart();

        if ($this->asetItModel->update($id, $data)) {
            // Cek perpindahan lokasi atau kondisi
            $logMutasiModel = new LogMutasiModel();
            
            if ($oldData['ruangan'] != $data['ruangan']) {
                $logMutasiModel->save([
                    'entitas' => 'aset_it',
                    'barang_id' => $id,
                    'jenis_mutasi' => 'PINDAH',
                    'jumlah' => 1,
                    'keterangan' => "Pindah lokasi: {$oldData['ruangan']} -> {$data['ruangan']}",
                    'user_id' => session()->get('user_id')
                ]);
            }
            if ($oldData['kondisi_aset'] != $data['kondisi_aset']) {
                $jenis = 'UPDATE';
                if ($data['kondisi_aset'] == 'Rusak') $jenis = 'RUSAK';
                if ($oldData['kondisi_aset'] == 'Rusak' && $data['kondisi_aset'] == 'Digunakan') $jenis = 'PERBAIKAN';
                
                $logMutasiModel->save([
                    'entitas' => 'aset_it',
                    'barang_id' => $id,
                    'jenis_mutasi' => $jenis,
                    'jumlah' => 1,
                    'keterangan' => "Ubah kondisi: {$oldData['kondisi_aset']} -> {$data['kondisi_aset']}",
                    'user_id' => session()->get('user_id')
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            session()->setFlashdata('error', 'Gagal memperbarui aset karena kesalahan sistem.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success', 'Aset berhasil diperbarui.');
        return redirect()->to('/asetit/detail?nama_aset=' . urlencode($data['nama_aset']));
    }

    public function bulk_delete()
    {
        $selectedIdsStr = $this->request->getPost('selected_ids');
        if (empty($selectedIdsStr)) {
            session()->setFlashdata('error', 'Tidak ada aset yang dipilih untuk dihapus.');
            return redirect()->back();
        }

        $ids = explode(',', $selectedIdsStr);
        $logMutasiModel = new LogMutasiModel();
        
        $db = \Config\Database::connect();
        $db->transStart();

        $deletedCount = 0;
        foreach ($ids as $id) {
            $id = (int)$id;
            $asset = $this->asetItModel->find($id);
            if ($asset) {
                if ($this->asetItModel->delete($id)) {
                    $deletedCount++;
                    // Cascade Delete Logs
                    $logMutasiModel->where('barang_id', $id)->where('entitas', 'aset_it')->delete();
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            session()->setFlashdata('error', 'Gagal menghapus aset karena kesalahan sistem.');
            return redirect()->back();
        }

        if ($deletedCount > 0) {
            session()->setFlashdata('success', "Berhasil menghapus {$deletedCount} aset IT secara massal.");
        } else {
            session()->setFlashdata('error', 'Gagal menghapus aset terpilih.');
        }

        return redirect()->back();
    }

    public function bulk_edit()
    {
        $selectedIdsStr = $this->request->getPost('selected_ids');
        $field = $this->request->getPost('edit_field');
        $newValue = $this->request->getPost('new_value');

        if (empty($selectedIdsStr) || empty($field)) {
            session()->setFlashdata('error', 'Pilih aset dan kolom yang ingin diubah.');
            return redirect()->back();
        }

        // List of allowed fields for safety
        $allowedToEdit = [
            'kategori', 'sub_kategori', 'lantai', 'ruangan', 'pengguna', 
            'kondisi_aset', 'masa_garansi_bulan', 'umur_ekonomis_bulan', 
            'harga_pembelian', 'vendor', 'tanggal_pembelian', 'merk', 'tipe'
        ];

        if (!in_array($field, $allowedToEdit)) {
            session()->setFlashdata('error', 'Kolom tidak diizinkan untuk diubah.');
            return redirect()->back();
        }

        $ids = explode(',', $selectedIdsStr);
        $logMutasiModel = new LogMutasiModel();

        // Type casting/formatting based on field
        if ($field === 'masa_garansi_bulan' || $field === 'umur_ekonomis_bulan') {
            $newValue = empty($newValue) ? null : (int)$newValue;
        } elseif ($field === 'harga_pembelian') {
            $newValue = (float)$newValue;
        } elseif ($field === 'tanggal_pembelian') {
            $newValue = empty($newValue) ? null : $newValue;
        } elseif ($field === 'pengguna' && empty($newValue)) {
            $newValue = null;
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $updatedCount = 0;
        foreach ($ids as $id) {
            $id = (int)$id;
            $oldData = $this->asetItModel->find($id);
            if ($oldData) {
                $dataUpdate = [
                    $field => $newValue
                ];
                
                if ($this->asetItModel->update($id, $dataUpdate)) {
                    $updatedCount++;
                    
                    // Log Mutasi if location or condition changed
                    if ($field === 'ruangan' && $oldData['ruangan'] !== $newValue) {
                        $logMutasiModel->save([
                            'barang_id' => $id,
                            'jenis_mutasi' => 'PINDAH',
                            'jumlah' => 1,
                            'keterangan' => "[Ubah Massal] Pindah lokasi: {$oldData['ruangan']} -> {$newValue}",
                            'user_id' => session()->get('user_id')
                        ]);
                    } elseif ($field === 'kondisi_aset' && $oldData['kondisi_aset'] !== $newValue) {
                        $jenis = 'UPDATE';
                        if ($newValue === 'Rusak') $jenis = 'RUSAK';
                        if ($oldData['kondisi_aset'] === 'Rusak' && $newValue === 'Digunakan') $jenis = 'PERBAIKAN';
                        
                        $logMutasiModel->save([
                            'barang_id' => $id,
                            'jenis_mutasi' => $jenis,
                            'jumlah' => 1,
                            'keterangan' => "[Ubah Massal] Ubah kondisi: {$oldData['kondisi_aset']} -> {$newValue}",
                            'user_id' => session()->get('user_id')
                        ]);
                    } else {
                        // Catat log update perubahan kolom lainnya
                        $fieldLabel = ucwords(str_replace('_', ' ', $field));
                        $oldVal = $oldData[$field] ?? 'Kosong';
                        $newVal = $newValue ?? 'Kosong';
                        $logMutasiModel->save([
                            'barang_id' => $id,
                            'jenis_mutasi' => 'UPDATE',
                            'jumlah' => 1,
                            'keterangan' => "[Ubah Massal] Ubah {$fieldLabel}: {$oldVal} -> {$newVal}",
                            'user_id' => session()->get('user_id')
                        ]);
                    }
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            session()->setFlashdata('error', 'Gagal memperbarui data karena kesalahan sistem.');
            return redirect()->back();
        }

        if ($updatedCount > 0) {
            session()->setFlashdata('success', "Berhasil memperbarui kolom '{$field}' untuk {$updatedCount} aset IT secara massal.");
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data aset terpilih.');
        }

        return redirect()->back();
    }

    public function history($id)
    {
        $aset = $this->asetItModel->find($id);
        if (!$aset) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }

        $logModel = new LogMutasiModel();
        $history = $logModel->select('created_at as tanggal, jenis_mutasi as status, keterangan')
                            ->where('barang_id', $id)
                            ->where('entitas', 'aset_it')
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

        return $this->response->setJSON(['status' => 'success', 'data' => $history]);
    }

    public function print_labels()
    {
        $idsStr = $this->request->getGet('ids');
        if (empty($idsStr)) {
            session()->setFlashdata('error', 'Tidak ada aset yang dipilih untuk dicetak.');
            return redirect()->back();
        }

        $ids = explode(',', $idsStr);
        $data['aset'] = $this->asetItModel->whereIn('id', $ids)->findAll();
        
        return view('aset_it/print_labels', $data);
    }

    public function scan($id)
    {
        $data['aset'] = $this->asetItModel->find($id);
        if (!$data['aset']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data aset tidak ditemukan.');
        }

        $logModel = new LogMutasiModel();
        $data['history'] = $logModel->where('barang_id', $id)
                                    ->where('entitas', 'aset_it')
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll();

        return view('aset_it/scan', $data);
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        if ($this->asetItModel->delete($id)) {
            // Cascade Delete Logs
            $logMutasiModel = new LogMutasiModel();
            $logMutasiModel->where('barang_id', $id)->where('entitas', 'aset_it')->delete();
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            session()->setFlashdata('error', 'Gagal menghapus aset karena kesalahan sistem.');
        } else {
            session()->setFlashdata('success', 'Aset berhasil dihapus beserta riwayatnya.');
        }
        return redirect()->back();
    }
}
