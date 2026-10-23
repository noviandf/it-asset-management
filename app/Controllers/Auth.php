<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        return view('auth/login');
    }
    
   public function login()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $throttler = \Config\Services::throttler();
    if ($throttler->check('login_attempts', 5, MINUTE) === false) {
        return redirect()->back()->with('error', 'Terlalu banyak percobaan login. Silakan tunggu 1 menit.')->withInput();
    }

    $user = $this->userModel->where('username', $username)->first();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/dashboard')->with('success', 'Login berhasil');
        } else {
            return redirect()->back()->with('error', 'Password salah')->withInput();
        }
    } else {
        return redirect()->back()->with('error', 'Username tidak ditemukan')->withInput();
    }
}
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth');
    }
}
