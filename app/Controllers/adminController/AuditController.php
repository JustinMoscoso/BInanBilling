<?php

namespace App\Controllers\adminController;

use App\Controllers\BaseController;

class AuditController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('audit_logs a');

        // ✅ JOIN users table to get username
        $builder->select('a.*, u.username');
        $builder->join('users u', 'u.user_id = a.user_id', 'left');

        // ✅ FILTERS
        $action = $this->request->getGet('action');
        $table = $this->request->getGet('table');

        if ($action) {
            $builder->where('a.action', $action);
        }

        if ($table) {
            $builder->where('a.target_table', $table);
        }

        // ✅ ORDER
        $builder->orderBy('a.created_at', 'DESC');

        $data['logs'] = $builder->get()->getResultArray();

        return view('adminUI/auditLogs', $data);
    }
}