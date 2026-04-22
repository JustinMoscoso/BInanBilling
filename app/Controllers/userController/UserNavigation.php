<?php

namespace App\Controllers\UserController;
use App\Controllers\BaseController;

class UserNavigation extends BaseController
{
    public function index()
    {
        return view('employeeUI/employeeDashboard');
    }

    public function billingPage()
    {
        return view('employeeUI/computeBilling');
    }
}