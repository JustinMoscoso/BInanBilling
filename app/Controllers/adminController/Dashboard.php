<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\employeeModel\BillingModel;
use App\Models\employeeModel\getClientInfoModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        // ✅ AUTH CHECK
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        // ✅ LOAD MODELS
        $billingModel = new BillingModel();
        $clientModel = new getClientInfoModel();

        // ✅ GET DATA
        $bills = $billingModel->getBillingHistory();
        $clients = $clientModel->findAll();

        // ✅ SAFE CALCULATIONS
        $totalClients = count($clients);
        $totalBills = count($bills);
        $totalRevenue = !empty($bills)
            ? array_sum(array_column($bills, 'subtotal'))
            : 0;

        // ✅ RECENT BILLS (safe)
        $recentBills = !empty($bills) ? array_slice($bills, 0, 5) : [];

        // ✅ PASS DATA
        return view('adminUI/adminDashboard', [
            'username' => $session->get('username'),
            'totalClients' => $totalClients,
            'totalBills' => $totalBills,
            'totalRevenue' => $totalRevenue,
            'recentBills' => $recentBills
        ]);
    }
}