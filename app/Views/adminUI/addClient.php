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

        <!-- PAGE HEADER -->
        <div class="mb-4">
            <h3 class="fw-bold">Add Client</h3>
            <p class="text-muted">Register a new client in the system</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- CARD -->
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">

                        <!-- SUCCESS MESSAGE -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <i class="bi bi-check-circle"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <!-- FORM -->
                        <form action="<?= site_url('addClient') ?>" method="post">

                            <!-- FULL NAME -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control" name="fullname"
                                        placeholder="Enter full name" required>
                                </div>
                            </div>

                            <!-- ADDRESS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" name="address" placeholder="Enter address"
                                        required>
                                </div>
                            </div>

                            <!-- METER NUMBER -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Meter Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-speedometer2"></i>
                                    </span>
                                    <input type="text" class="form-control" name="meter_number"
                                        placeholder="Enter meter number" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>