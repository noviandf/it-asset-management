<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->userModel->insert($data);
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'username' => $this->request->getPost('username')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/user')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user')->with('success', 'User berhasil dihapus');
    }
}
