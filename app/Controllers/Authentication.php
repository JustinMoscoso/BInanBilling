<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Authentication extends BaseController
{
    // ================= LOGIN PAGE =================
    public function index()
    {
        // ✅ If already logged in, redirect to correct page
        if (session()->get('logged_in')) {

            if (session()->get('role_id') == 1) {
                return redirect()->to('/dashboard');
            } elseif (session()->get('role_id') == 2) {
                return redirect()->to('/employeeDashboard');
            }
        }

        return view('authentication/loginPage');
    }

    // ================= LOGIN FUNCTION =================
    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        // ✅ Validate input
        if (!$username || !$password) {
            return redirect()->back()->with('error', 'Username and password are required');
        }

        // ✅ Find user
        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // ✅ Verify password
        if (!password_verify($password, $user['password_hash'])) {
            return redirect()->back()->with('error', 'Wrong password');
        }

        // ✅ Set session
        $session->set([
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'full_name' => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')), // ✅ FIX
            'role_id' => $user['role_id'],
            'logged_in' => true
        ]);
        // ✅ Redirect based on role
        if ($user['role_id'] == 1) {
            return redirect()->to('/dashboard');
        } elseif ($user['role_id'] == 2) {
            return redirect()->to('/employeeDashboard');
        }

        return redirect()->to('/');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
