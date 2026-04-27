<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <?= view('layout/employeeNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- Welcome -->
        <div class="mb-4">
            <h3>Welcome, <?= esc(
                session()->get('full_name')
                ?: trim((session()->get('first_name') ?? '') . ' ' . (session()->get('last_name') ?? ''))
                ?: explode('@', session()->get('username'))[0]
            ) ?></h3>
            <p class="text-muted">Billing Dashboard</p>

        </div>

        <!-- SUMMARY CARDS -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-cash-stack display-5 text-danger"></i>
                        <h4 class="mt-3">₱ <?= number_format($totalUnpaid, 2) ?></h4>
                        <p class="text-muted">Total Billing</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-receipt display-5 text-primary"></i>
                        <h4 class="mt-3"><?= count($bills) ?></h4>
                        <p class="text-muted">Total Bills</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-lightning-charge display-5 text-warning"></i>
                        <h4 class="mt-3">
                            <?= isset($latestBill['units_consumed']) ? number_format($latestBill['units_consumed'], 2) : 0 ?>
                        </h4>
                        <p class="text-muted">Latest Units Used</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- LATEST BILL ALERT -->
        <?php if ($latestBill): ?>
            <div class="alert alert-warning shadow-sm">
                <strong>Latest Bill:</strong>
                ₱ <?= number_format($latestBill['subtotal'], 2) ?> |
                Due: <?= $latestBill['due_date'] ?>
            </div>
        <?php endif; ?>

        <!-- ACTION BUTTONS -->
        <div class="mb-4">
            <a href="/billingHistory" class="btn btn-primary me-2">
                <i class="bi bi-file-earmark-text"></i> View Billing History
            </a>

            <a href="/computeBilling" class="btn btn-success">
                <i class="bi bi-calculator"></i> Compute Billing
            </a>
        </div>

        <!-- RECENT BILLS TABLE -->
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="mb-3">Recent Bills</h5>

                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Units</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach (array_slice($bills, 0, 5) as $bill): ?>
                            <tr>
                                <td><?= $bill['full_name'] ?></td>
                                <td>₱ <?= number_format($bill['subtotal'], 2) ?></td>
                                <td><?= number_format($bill['units_consumed'], 2) ?></td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <?= $bill['due_date'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>