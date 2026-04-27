<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Employees</h3>
                <small class="text-muted">Manage all employee accounts</small>
            </div>

            <a href="/addEmployee" class="btn btn-dark">
                <i class="bi bi-person-plus"></i> Add Employee
            </a>
        </div>

        <!-- SUCCESS MESSAGE -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- CARD -->
        <div class="card shadow border-0 rounded-3">
            <div class="card-body">

                <!-- TABLE -->
                <?= view('layout/Table', [
                    'columns' => ['First Name', 'Last Name', 'Username'],
                    'fields' => ['first_name', 'last_name', 'username'],
                    'data' => $employees,
                    'actions' => ['edit', 'delete'],
                    'primaryKey' => 'user_id',
                    'deleteUrl' => 'employee/delete'
                ]) ?>

            </div>
        </div>

    </div>

    <!-- ================= EDIT MODAL ================= -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" id="editForm">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" id="edit_id">

                        <div class="mb-2">
                            <label>First Name</label>
                            <input type="text" name="first_name" id="edit_first_name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="edit_last_name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" id="edit_username" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 🔥 EDIT FUNCTION (Overrides Table default)
        function openEditModal(data) {

            document.getElementById('edit_id').value = data.user_id;
            document.getElementById('edit_first_name').value = data.first_name;
            document.getElementById('edit_last_name').value = data.last_name;
            document.getElementById('edit_username').value = data.username;

            document.getElementById('editForm').action =
                "<?= site_url('employee/update') ?>/" + data.user_id;

            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
</body>

</html>