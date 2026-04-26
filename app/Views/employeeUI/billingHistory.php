<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Billing History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?= view('layout/EmployeeNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Billing History</h3>
                <small class="text-muted">View all computed bills</small>
            </div>
        </div>

        <!-- SUMMARY (OPTIONAL BUT NICE) -->
        <div class="mb-3">
            <span class="badge bg-dark fs-6">
                Total Records: <?= count($billing) ?>
            </span>
        </div>

        <!-- CARD -->
        <div class="card shadow border-0 rounded-3">
            <div class="card-body">



                <!-- TABLE -->
                <?= view('layout/Table', [

                    'title' => null, // remove default "Table" text
                
                    'columns' => [
                        'Client',
                        'Meter Number',
                        'Units Consumed',
                        'Rate Per Unit',
                        'Subtotal',
                        'Billing Date',
                        'Due Date'
                    ],

                    'fields' => [
                        'full_name',
                        'meter_number',
                        'units_consumed',
                        'rate_per_unit',
                        'subtotal',
                        'billing_date',
                        'due_date'
                    ],

                    'data' => array_map(function ($row) {
                                        $row['rate_per_unit'] = '₱ ' . number_format($row['rate_per_unit'], 2);
                                        $row['subtotal'] = '₱ ' . number_format($row['subtotal'], 2);
                                        return $row;
                                    }, $billing)

                ]) ?>

            </div>
        </div>

    </div>

</body>

</html>