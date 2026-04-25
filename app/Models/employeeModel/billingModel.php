<?php

namespace App\Models;

use CodeIgniter\Model;

class billingModel extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'id';

    public function getBillingHistory()
    {
        return $this->db->table('billing')
            ->join('clients', 'clients.id = billing.client_id')
            ->select('
                clients.full_name,
                clients.meter_number,
                billing.unit_consumed,
                billing.rate_per_unit,
                billing.total_amount,
                billing.billing_date,
                billing.due_date
            ')
            ->orderBy('billing.billing_date', 'DESC')
            ->get()
            ->getResultArray();
    }
}