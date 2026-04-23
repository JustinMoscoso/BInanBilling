<?php

namespace App\Controllers\UserController;

use App\Controllers\BaseController;
use App\Models\employeeModel\ClientBillModel;

class computeBillsController extends BaseController
{
    protected $billModel;

    public function __construct()
    {
        $this->billModel = new ClientBillModel(); // ✅ FIXED casing
    }

    public function billComputation()
    {
        $data = $this->request->getJSON(true);

        // ✅ GET EMPLOYEE FROM SESSION
        $employeeId = session()->get('user_id');

        if (!$employeeId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not logged in'
            ]);
        }

        // ✅ VALIDATE INPUT
        if (
            !$data ||
            !isset($data['client_id'], $data['billing_date'], $data['due_date'], $data['total_amount'])
        ) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input data',
                'received' => $data
            ]);
        }

        // ✅ INSERT INTO bills TABLE
        $billId = $this->billModel->insert([
            'client_id' => $data['client_id'],
            'computed_by' => $employeeId,
            'billing_date' => $data['billing_date'],
            'due_date' => $data['due_date'],
            'total_amount' => $data['total_amount'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (!$billId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->billModel->errors(),
                'db_error' => $this->billModel->db->error()
            ]);
        }

        // ✅ INSERT INTO bill_details TABLE
        $db = \Config\Database::connect();

        $units = $data['units'] ?? 0; // make sure frontend sends this
        $rate = 0;

        // 🔥 SAME LOGIC AS YOUR JS (important!)
        if ($units <= 200) {
            $rate = 10;
        } elseif ($units <= 500) {
            $rate = 13;
        } else {
            $rate = 15;
        }

        $db->table('bill_details')->insert([
            'bill_id' => $billId,
            'units_consumed' => $units,
            'rate_per_unit' => $rate,
            'subtotal' => $data['total_amount']
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'bill_id' => $billId
        ]);
    }
}