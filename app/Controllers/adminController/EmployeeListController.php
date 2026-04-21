<?php

namespace App\Controllers\adminController;

use App\Controllers\BaseController;
use App\Models\adminModel\GetEmployeeModel;

class EmployeeListController extends BaseController
{
    public function index()
    {
        $model = new GetEmployeeModel();

        $data['employees'] = $model->where('role_id !=', 1)->findAll();
        return view('adminUI/EmployeeList', $data);
    }
}