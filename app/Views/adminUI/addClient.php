<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Client</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- HEADER -->
        <div class="mb-4">
            <h3 class="fw-bold">Add Client</h3>
            <p class="text-muted">Register a new client in the system</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">

                        <!-- SUCCESS -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <i class="bi bi-check-circle"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <!-- FORM -->
                        <form id="clientForm" action="<?= site_url('addClient') ?>" method="post" novalidate>

                            <!-- FULL NAME -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Client</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                        placeholder="Enter Client" required>
                                    <div class="invalid-feedback">
                                        Name must contain only letters and spaces.
                                    </div>
                                </div>
                            </div>

                            <!-- ADDRESS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter address" required>
                                    <div class="invalid-feedback">
                                        Address must be at least 5 characters.
                                    </div>
                                </div>
                            </div>

                            <!-- METER NUMBER -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Meter Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-speedometer2"></i>
                                    </span>
                                    <input type="text" class="form-control" id="meterNumber" name="meter_number"
                                        placeholder="Enter meter number" required>
                                    <div class="invalid-feedback">
                                        Meter number must be numeric.
                                    </div>
                                </div>
                            </div>

                            <!-- BUTTONS -->
                            <div class="d-flex justify-content-between">
                                <a href="/employees" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>

                                <button type="submit" class="btn btn-dark px-4">
                                    <i class="bi bi-person-plus"></i> Add Client
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        const form = document.getElementById("clientForm");

        form.addEventListener("submit", function (e) {
            let valid = true;

            const fullname = document.getElementById("fullname");
            const address = document.getElementById("address");
            const meter = document.getElementById("meterNumber");

            const nameRegex = /^[A-Za-z\s]+$/;
            const numberRegex = /^[0-9]+$/;

            // FULL NAME
            if (!fullname.value || !nameRegex.test(fullname.value)) {
                fullname.classList.add("is-invalid");
                valid = false;
            } else {
                fullname.classList.remove("is-invalid");
            }

            // ADDRESS
            if (!address.value || address.value.length < 5) {
                address.classList.add("is-invalid");
                valid = false;
            } else {
                address.classList.remove("is-invalid");
            }

            // METER NUMBER
            if (!meter.value || !numberRegex.test(meter.value)) {
                meter.classList.add("is-invalid");
                valid = false;
            } else {
                meter.classList.remove("is-invalid");
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>