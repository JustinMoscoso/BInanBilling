<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- Welcome -->
        <h3 class="mb-4">Welcome, <?= esc($username) ?></h3>

        <!-- SUMMARY CARDS -->
        <div class="row g-4">

            <div class="col-md-3">
                <div class="card bg-primary text-white shadow border-0">
                    <div class="card-body">
                        <h6>Total Clients</h6>
                        <h3><?= $totalClients ?></h3>
                        <i class="bi bi-people fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white shadow border-0">
                    <div class="card-body">
                        <h6>Total Bills</h6>
                        <h3><?= $totalBills ?></h3>
                        <i class="bi bi-receipt fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-dark shadow border-0">
                    <div class="card-body">
                        <h6>Total Revenue</h6>
                        <h3>₱ <?= number_format($totalRevenue, 2) ?></h3>
                        <i class="bi bi-cash-stack fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white shadow border-0">
                    <div class="card-body">
                        <h6>Recent Bills</h6>
                        <h3><?= count($recentBills) ?></h3>
                        <i class="bi bi-clock-history fs-2"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- ACTION BUTTONS -->
        <div class="mt-4 mb-3">
            <a href="/addClient" class="btn btn-primary me-2">
                <i class="bi bi-person-plus"></i> Add Client
            </a>

            <a href="/billingHistory" class="btn btn-success">
                <i class="bi bi-file-earmark-text"></i> View Billing
            </a>
        </div>

        <!-- RECENT BILLS TABLE -->
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Recent Bills</h5>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Client</th>
                            <th>Meter</th>
                            <th class="text-end">Units</th>
                            <th class="text-end">Amount</th>
                            <th>Billing Date</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($recentBills)): ?>
                            <?php foreach ($recentBills as $bill): ?>
                                <?php
                                $isOverdue = strtotime($bill['due_date']) < time();
                                ?>
                                <tr>
                                    <td><?= esc($bill['full_name']) ?></td>
                                    <td><?= esc($bill['meter_number']) ?></td>

                                    <td class="text-end">
                                        <?= number_format($bill['units_consumed'], 2) ?>
                                    </td>

                                    <td class="fw-bold text-success text-end">
                                        ₱ <?= number_format($bill['subtotal'], 2) ?>
                                    </td>

                                    <td><?= esc($bill['billing_date']) ?></td>

                                    <td>
                                        <span class="badge <?= $isOverdue ? 'bg-danger' : 'bg-warning text-dark' ?>">
                                            <?= esc($bill['due_date']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No billing records found
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>