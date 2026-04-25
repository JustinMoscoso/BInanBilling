<?php

namespace App\Controllers\adminController;

use App\Controllers\BaseController;
use App\Models\BillingModel;

class billingHistoryController extends BaseController
{
    public function index()
    {
        $billingModel = new BillingModel();

        $data['billing'] = $billingModel->getBillingHistory();

        return view('employeeUI/billingHistory', $data);
    }
}