<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Audit Logs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="bg-light">

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <h3 class="fw-bold mb-3">Audit Logs</h3>

        <div class="card shadow">
            <div class="card-body">

                <!-- 🔍 FILTER -->
                <form method="get" class="mb-3 d-flex gap-2">

                    <select name="action" class="form-select w-auto">
                        <option value="">All Actions</option>
                        <option value="create" <?= (request()->getGet('action') == 'create') ? 'selected' : '' ?>>Create
                        </option>
                        <option value="delete" <?= (request()->getGet('action') == 'delete') ? 'selected' : '' ?>>Delete
                        </option>
                        <option value="update" <?= (request()->getGet('action') == 'update') ? 'selected' : '' ?>>Update
                        </option>
                    </select>

                    <select name="table" class="form-select w-auto">
                        <option value="">All Tables</option>
                        <option value="employees" <?= (request()->getGet('table') == 'employees') ? 'selected' : '' ?>>
                            Employees</option>
                        <option value="bills" <?= (request()->getGet('table') == 'bills') ? 'selected' : '' ?>>Bills
                        </option>
                    </select>

                    <button class="btn btn-dark">Filter</button>
                    <a href="/audit-logs" class="btn btn-secondary">Reset</a>
                </form>

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($logs)): ?>
                                <?php foreach ($logs as $log): ?>
                                    <tr>

                                        <!-- USERNAME -->
                                        <td><?= esc($log['username'] ?? 'Unknown') ?></td>

                                        <!-- ACTION BADGE -->
                                        <td>
                                            <?php if ($log['action'] === 'create'): ?>
                                                <span class="badge bg-success">Create</span>
                                            <?php elseif ($log['action'] === 'delete'): ?>
                                                <span class="badge bg-danger">Delete</span>
                                            <?php elseif ($log['action'] === 'update'): ?>
                                                <span class="badge bg-warning text-dark">Update</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?= esc($log['action']) ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- HUMAN READABLE DESCRIPTION -->
                                        <td>
                                            <?php
                                            $username = $log['username'] ?? 'Unknown';

                                            if ($log['action'] === 'delete' && $log['target_table'] === 'employees') {
                                                $old = json_decode($log['old_data'], true);
                                                echo "<strong>$username</strong> deleted <strong>" . ($old['first_name'] ?? 'Employee') . "</strong>";
                                            } elseif ($log['action'] === 'create' && $log['target_table'] === 'bills') {
                                                $new = json_decode($log['new_data'], true);
                                                echo "<strong>$username</strong> created bill <strong>#{$log['target_id']}</strong> (Units: {$new['units']})";
                                            } elseif ($log['action'] === 'update') {
                                                echo "<strong>$username</strong> updated record <strong>#{$log['target_id']}</strong>";
                                            } else {
                                                echo "<strong>$username</strong> {$log['action']} {$log['target_table']} (#{$log['target_id']})";
                                            }
                                            ?>
                                        </td>

                                        <!-- DATE -->
                                        <td><?= $log['created_at'] ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No logs found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>