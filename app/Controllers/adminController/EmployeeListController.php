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
    public function delete($id)
    {
        helper('audit');

        $model = new GetEmployeeModel();

        // Get old data before deleting
        $oldData = $model->find($id);

        try {
            $model->delete($id);

            // ❗ Remove sensitive data
            unset($oldData['password_hash']);

            // ✅ AUDIT DELETE
            log_audit(
                'delete',
                'employees',
                $id,
                $oldData,
                null
            );

            return redirect()->back()->with('success', 'Employee deleted successfully');

        } catch (\Exception $e) {

            log_audit(
                'delete_failed',
                'employees',
                $id,
                $oldData,
                ['error' => $e->getMessage()]
            );

            return redirect()->back()->with('error', 'Failed to delete employee');
        }
    }
}