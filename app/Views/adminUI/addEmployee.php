<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 250px;" class="p-4">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="mb-4 text-center">Add Employee/Client</h4>

                        <!-- Success Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form action="<?= site_url('addEmployee') ?>" method="post">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter username"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password"
                                    required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">
                                    Add Employee
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>