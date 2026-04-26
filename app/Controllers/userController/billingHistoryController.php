<?php

namespace App\Controllers\UserController;

use App\Controllers\BaseController;
use App\Models\employeeModel\BillingModel;

class BillingHistoryController extends BaseController
{
    public function index()
    {
        $model = new BillingModel();

        $data['billing'] = $model->getBillingHistory();

        return view('employeeUI/billingHistory', $data); // ✅ FIXED
    }
}