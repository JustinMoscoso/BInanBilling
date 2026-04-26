<?php

use App\Models\AuditModel;

if (!function_exists('log_audit')) {
    function log_audit($action, $table, $recordId = null, $old = null, $new = null)
    {
        $auditModel = new AuditModel();

        $auditModel->save([
            'user_id' => session()->get('user_id') ?? null,
            'action' => $action,
            'target_table' => $table,
            'target_id' => $recordId,
            'old_data' => $old ? json_encode($old) : null,
            'new_data' => $new ? json_encode($new) : null,
            'ip_address' => service('request')->getIPAddress(),
        ]);
    }
}