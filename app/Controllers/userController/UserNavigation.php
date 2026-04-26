<?php

namespace App\Controllers\UserController;

use App\Controllers\BaseController;
use App\Models\employeeModel\BillingModel;

class UserNavigation extends BaseController
{
    public function index()
    {
        $model = new BillingModel();

        $bills = $model->getBillingHistory();

        // Summary calculations
        $totalUnpaid = array_sum(array_column($bills, 'subtotal'));
        $latestBill = $bills[0] ?? null;

        $data = [
            'bills' => $bills,
            'totalUnpaid' => $totalUnpaid,
            'latestBill' => $latestBill
        ];

        return view('employeeUI/employeeDashboard', $data);
    }
}