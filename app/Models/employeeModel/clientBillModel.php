<?php

namespace App\Models\employeeModel;

use CodeIgniter\Model;

class clientBillModel extends Model // ✅ FIXED class name
{
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';

    protected $allowedFields = [
        'client_id',
        'computed_by',
        'billing_date',
        'due_date',
        'total_amount',
        'created_at'
    ];
}