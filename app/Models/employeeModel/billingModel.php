<?php

namespace App\Models\employeeModel;

use CodeIgniter\Model;

class BillingModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';

    public function getBillingHistory()
    {
        return $this->db->table('bills')
            ->join('clients', 'clients.client_id = bills.client_id')
            ->join('bill_details', 'bill_details.bill_id = bills.bill_id')
            ->select('
                clients.full_name,
                clients.meter_number,
                bills.billing_date,
                bills.due_date,
                MAX(bill_details.rate_per_unit) as rate_per_unit,
                SUM(bill_details.units_consumed) as units_consumed,
                SUM(bill_details.subtotal) as subtotal
            ')
            ->groupBy('bills.bill_id')
            ->orderBy('bills.billing_date', 'DESC')
            ->get()
            ->getResultArray();
    }
}