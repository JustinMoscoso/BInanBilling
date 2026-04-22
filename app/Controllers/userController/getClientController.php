<?php
namespace App\Controllers\UserController;
use App\Controllers\BaseController;
use App\Models\employeeModel\getClientInfoModel;

class getClientController extends BaseController
{
    public function index()
    {
        $model = new getClientInfoModel();
        $data['clients'] = $model->findAll();
        return view('employeeUI/computeBilling', $data);
    }
}