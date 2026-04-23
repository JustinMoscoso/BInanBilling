<?php

namespace App\Models\employeeModel;
use CodeIgniter\Model;

class clientBillDetailModel extends Model
{
    protected $table = 'bill_details';
    protected $primaryKey = 'detail_id';

    protected $allowedFields = [
        'detail_id',
        'bill_id',
        'units_consumed',
        'rate_per_unit',
        'subtotal',
    ];
}