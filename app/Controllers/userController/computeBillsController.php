<?php

namespace App\Controllers\UserController;

use App\Controllers\BaseController;
use App\Models\employeeModel\ClientBillModel;

class computeBillsController extends BaseController
{
    protected $billModel;

    public function __construct()
    {
        $this->billModel = new ClientBillModel();
    }

    public function billComputation()
    {
        try {
            $data = $this->request->getJSON(true);

            // ✅ GET EMPLOYEE FROM SESSION
            $employeeId = session()->get('user_id');

            if (!$employeeId) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not logged in'
                ]);
            }

            // ✅ VALIDATE INPUT (FIXED: includes units)
            if (
                !$data ||
                !isset(
                $data['client_id'],
                $data['billing_date'],
                $data['due_date'],
                $data['units'] // ✅ FIXED
            )
            ) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid input data',
                    'received' => $data
                ]);
            }

            // ✅ GET VALUES
            $clientId = $data['client_id'];
            $billingDate = $data['billing_date'];
            $dueDate = $data['due_date'];
            $units = (float) $data['units'];

            if ($units <= 0) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Units must be greater than 0'
                ]);
            }

            // 🔥 COMPUTE TOTAL IN BACKEND (DO NOT TRUST FRONTEND)
            if ($units <= 200) {
                $rate = 10;
                $total = $units * 10;
            } elseif ($units <= 500) {
                $rate = 13;
                $total = (200 * 10) + (($units - 200) * 13);
            } else {
                $rate = 15;
                $total = (200 * 10) + (300 * 13) + (($units - 500) * 15);
            }

            // ✅ INSERT INTO bills TABLE
            $billId = $this->billModel->insert([
                'client_id' => $clientId,
                'computed_by' => $employeeId,
                'billing_date' => $billingDate,
                'due_date' => $dueDate,
                'total_amount' => $total,
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

            $db->table('bill_details')->insert([
                'bill_id' => $billId,
                'units_consumed' => $units,
                'rate_per_unit' => $rate,
                'subtotal' => $total
            ]);

            return $this->response->setJSON([
                'status' => 'success',
                'bill_id' => $billId,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}