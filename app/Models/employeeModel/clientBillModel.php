<?php

namespace App\Models\employeeModel;

use CodeIgniter\Model;
class clinetBillModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'bill_id';

    protected $allowedFields = [
        'billing_id',
        'client_id',
        'computed_by',
        'billing_date',
        'due_date',
        'total_amount',
        'created_at'

    ];
}