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

        <!-- CARD WRAPPER -->
        <div class="card shadow border-0 rounded-3">
            <div class="card-body">

                <!--  SEARCH BAR
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Search employee...">
                </div>

                <!-- TABLE -->
                <?= view('layout/Table', [
                    'columns' => ['First Name', 'Last Name', 'Username'],
                    'fields' => ['first_name', 'last_name', 'username'],
                    'data' => $employees,
                    'actions' => ['edit', 'delete']
                ]) ?>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>