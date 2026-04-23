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

                        <h4 class="mb-4 text-center">Add Client</h4>

                        <!-- Success Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <!-- Form -->
                        <form action="<?= site_url('addClient') ?>" method="post">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control" name="fullname" placeholder="Enter full name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter address"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Meter Number</label>
                                <input type="text" class="form-control" name="meter_number"
                                    placeholder="Enter meter number" required>
                            </div>


                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">
                                    Add Client
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