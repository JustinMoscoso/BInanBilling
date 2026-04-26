<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditModel extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'log_id';

    protected $allowedFields = [
        'user_id',
        'action',
        'target_table',
        'target_id',
        'old_data',
        'new_data',
        'ip_address',
        'created_at'
    ];
}