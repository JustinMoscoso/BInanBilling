<?php

namespace App\Controllers\adminController;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->has('logged_in') || !$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        $data = [
            'username' => $session->get('username')
        ];

        return view('adminUI/adminDashboard', $data);
    }
}