<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .dashboard-container {
            margin-left: 250px;
            /* match new sidebar */
            padding: 30px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .stat-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
        }

        .stat-label {
            color: #6c757d;
        }

        .recent-card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
        }
    </style>
</head>

<body>

    <?= view('layout/adminNav') ?>

    <div class="dashboard-container">

        <!-- Welcome -->
        <h3 class="mb-4">Welcome, <?= esc($username) ?></h3>

        <!-- STAT CARDS (EMPLOYEE STYLE) -->
        <div class="row g-4">

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-people text-primary stat-icon"></i>
                    <div class="stat-value"><?= $totalClients ?></div>
                    <div class="stat-label">Total Clients</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-receipt text-success stat-icon"></i>
                    <div class="stat-value"><?= $totalBills ?></div>
                    <div class="stat-label">Total Bills</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-cash text-danger stat-icon"></i>
                    <div class="stat-value">₱ <?= number_format($totalRevenue, 2) ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-clock-history text-warning stat-icon"></i>
                    <div class="stat-value"><?= count($recentBills) ?></div>
                    <div class="stat-label">Recent Bills</div>
                </div>
            </div>

        </div>

        <!-- RECENT BILLS -->
        <div class="mt-4">
            <div class="card recent-card">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Recent Bills</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table align-middle">

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
                                    <?php $isOverdue = strtotime($bill['due_date']) < time(); ?>

                                    <tr>
                                        <td><?= esc($bill['full_name']) ?></td>
                                        <td><?= esc($bill['meter_number']) ?></td>

                                        <td class="text-end">
                                            <?= number_format($bill['units_consumed'], 2) ?>
                                        </td>

                                        <td class="text-end fw-bold">
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>