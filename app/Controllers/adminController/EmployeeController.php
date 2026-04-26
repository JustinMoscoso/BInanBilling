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
        helper('audit'); // ✅ load helper

        $model = new AddEmployeeModel();

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => 2
        ];

        try {
            $model->insert($data);

            $insertId = $model->getInsertID();

            // ❗ Remove password from audit (VERY IMPORTANT)
            $auditData = $data;
            unset($auditData['password_hash']);

            // ✅ SUCCESS AUDIT
            log_audit(
                'create',
                'employees',
                $insertId,
                null,
                $auditData
            );

            return redirect()->to('/addEmployee')->with('success', 'Employee added successfully');

        } catch (\Exception $e) {

            // ❗ Also remove password here
            $auditData = $data;
            unset($auditData['password_hash']);

            // ❗ FAILED AUDIT
            log_audit(
                'create_failed',
                'employees',
                null,
                null,
                [
                    'data' => $auditData,
                    'error' => $e->getMessage()
                ]
            );

            return redirect()->back()->with('error', 'Failed to add employee!');
        }
    }
}