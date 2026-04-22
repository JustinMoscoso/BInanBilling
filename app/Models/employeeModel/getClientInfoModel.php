<?php

namespace App\Models\employeeModel;

use CodeIgniter\Model;

class getClientInfoModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'client_id';

    protected $allowedFields = [
        'full_name',
        'address',
        'meter_number',
        'created_at'
    ];
}