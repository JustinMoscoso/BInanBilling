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
        helper('audit');

        try {
            $data = $this->request->getJSON(true);
            $employeeId = session()->get('user_id');

            if (!$employeeId) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not logged in'
                ]);
            }

            if (
                !$data ||
                !isset(
                $data['client_id'],
                $data['billing_date'],
                $data['due_date'],
                $data['units']
            )
            ) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid input data'
                ]);
            }

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

            // 🔒 PREVENT DUPLICATE BILL (same month & year)
            $month = date('m', strtotime($billingDate));
            $year = date('Y', strtotime($billingDate));

            $existingBill = $this->billModel
                ->where('client_id', $clientId)
                ->where('MONTH(billing_date)', $month)
                ->where('YEAR(billing_date)', $year)
                ->first();

            if ($existingBill) {
                return $this->response->setJSON([
                    'status' => 'exists',
                    'message' => 'This client already has a bill for this month.'
                ]);
            }

            // 🔥 COMPUTE BILL
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

            // ✅ INSERT BILL
            $billId = $this->billModel->insert([
                'client_id' => $clientId,
                'computed_by' => $employeeId,
                'billing_date' => $billingDate,
                'due_date' => $dueDate,
                'total_amount' => $total,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$billId) {
                throw new \Exception('Failed to insert bill');
            }

            // ✅ INSERT DETAILS
            $db = \Config\Database::connect();

            $db->table('bill_details')->insert([
                'bill_id' => $billId,
                'units_consumed' => $units,
                'rate_per_unit' => $rate,
                'subtotal' => $total
            ]);

            // ✅ AUDIT SUCCESS
            log_audit(
                'create',
                'bills',
                $billId,
                null,
                [
                    'client_id' => $clientId,
                    'computed_by' => $employeeId,
                    'units' => $units,
                    'rate' => $rate,
                    'total' => $total
                ]
            );

            return $this->response->setJSON([
                'status' => 'success',
                'bill_id' => $billId,
                'total' => $total
            ]);

        } catch (\Exception $e) {

            // ❗ AUDIT FAILURE
            log_audit(
                'create_failed',
                'bills',
                null,
                null,
                [
                    'input' => $this->request->getJSON(true),
                    'error' => $e->getMessage()
                ]
            );

            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}