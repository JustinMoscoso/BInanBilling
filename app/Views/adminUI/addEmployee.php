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

        <div class="mb-4">
            <h3 class="fw-bold">Add Employee</h3>
            <p class="text-muted">Create a new employee account</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">

                        <!-- Success -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <i class="bi bi-check-circle"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form id="employeeForm" action="<?= site_url('addEmployee') ?>" method="post" novalidate>

                            <!-- First Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="first_name" id="firstName"
                                        placeholder="Enter first name" required>
                                    <div class="invalid-feedback">
                                        First name is required and must contain only letters.
                                    </div>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text" class="form-control" name="last_name" id="lastName"
                                        placeholder="Enter last name" required>
                                    <div class="invalid-feedback">
                                        Last name is required and must contain only letters.
                                    </div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Enter username" required>
                                    <div class="invalid-feedback">
                                        Username must be at least 4 characters.
                                    </div>
                                </div>
                            </div>

                            <!-- Password (NO extra validation) -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter password" required>
                                </div>
                            </div>

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

    <script>
        const form = document.getElementById("employeeForm");

        form.addEventListener("submit", function (e) {
            let valid = true;

            const firstName = document.getElementById("firstName");
            const lastName = document.getElementById("lastName");
            const username = document.getElementById("username");

            const nameRegex = /^[A-Za-z]+$/;

            // First Name
            if (!firstName.value || !nameRegex.test(firstName.value)) {
                firstName.classList.add("is-invalid");
                valid = false;
            } else {
                firstName.classList.remove("is-invalid");
            }

            // Last Name
            if (!lastName.value || !nameRegex.test(lastName.value)) {
                lastName.classList.add("is-invalid");
                valid = false;
            } else {
                lastName.classList.remove("is-invalid");
            }

            // Username
            if (!username.value || username.value.length < 4) {
                username.classList.add("is-invalid");
                valid = false;
            } else {
                username.classList.remove("is-invalid");
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>