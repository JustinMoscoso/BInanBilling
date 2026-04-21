<?php
namespace App\Controllers\adminController;

use App\Controllers\BaseController;
use App\Models\adminModel\AddEmployeeModel;

class EmployeeController extends BaseController
{
    public function index()
    {
        return view('adminUI/addEmployee');
    }

    public function store()
    {

        $model = new AddEmployeeModel();

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'password_hash' => $this->request->getPost('password'),
            'role_id' => 2
        ];
        $model->insert($data);
        return redirect()->to('/addEmployee')->with('success', 'Employee added successfully');
    }
}