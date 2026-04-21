<?php

namespace App\Controllers;

use App\Models\UserModel;

class Authentication extends BaseController
{
    public function index()
    {
        return view('authentication/loginPage'); // your HTML page
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password_hash'])) {

                $session->set([
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                    'logged_in' => true
                ]);

                if ($user['role_id'] == 1) {
                    return redirect()->to('/dashboard');
                } elseif ($user['role_id'] == 2) {
                    return redirect()->to('/employeeDashboard');
                } else {
                    return redirect()->to('/');
                }

            } else {
                return redirect()->back()->with('error', 'Wrong password');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}