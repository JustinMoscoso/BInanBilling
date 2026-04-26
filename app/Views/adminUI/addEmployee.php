<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- Page Header -->
        <div class="mb-4">
            <h3 class="fw-bold">Add Employee</h3>
            <p class="text-muted">Create a new employee account</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Card -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">

                        <!-- Success Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <i class="bi bi-check-circle"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form action="<?= site_url('addEmployee') ?>" method="post">

                            <!-- First Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Enter first name" required>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Enter last name" required>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                                    <input type="text" class="form-control" name="username" placeholder="Enter username"
                                        required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter password" required>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="/employees" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>

                                <button type="submit" class="btn btn-dark px-4">
                                    <i class="bi bi-person-plus"></i> Add Employee
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>