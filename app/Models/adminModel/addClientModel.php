<?php

namespace App\Models\adminModel;

use CodeIgniter\Model;
class addClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    protected $allowedFields = [
        'full_name',
        'address',
        'meter_number'
    ];
}