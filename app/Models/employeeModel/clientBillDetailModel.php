<?php

namespace App\Models\employeeModel;
use CodeIgniter\Model;

class clientBillDetailModel extends Model
{
    protected $table = 'bill_details';
    protected $primaryKey = 'bill_id';

    protected $allowedFields = [
        'bill_id',
        'client_id',
        'computed_by',
        'billing_date',
        'due_date',
        'total_amount',
        'created_at'
    ];
}