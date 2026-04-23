<?php

namespace App\Controllers;

use App\Models\UserModel;

class Authentication extends BaseController
{
    public function index()
    {
        return view('authentication/loginPage');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return redirect()->back()->with('error', 'Username and password are required');
        }

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Wrong password');
        }

        // ✅ SET SESSION
        $session->set([
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'role_id' => $user['role_id'],
            'logged_in' => true
        ]);

        // ✅ REDIRECT BASED ON ROLE
        switch ($user['role_id']) {
            case 1:
                return redirect()->to('/dashboard');
            case 2:
                return redirect()->to('/employeeDashboard');
            default:
                return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}