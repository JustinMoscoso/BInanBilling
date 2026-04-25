<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?= view('layout/Table', [
        'title' => 'Billing History',

        'columns' => [
            'Client',
            'Meter Number',
            'Unit Consumed',
            'Rate Per Unit',
            'Total Amount',
            'Billing Date',
            'Billing Due Date'
        ],

        'fields' => [
            'full_name',
            'meter_number',
            'unit_consumed',
            'rate_per_unit',
            'total_amount', // ✅ FIXED (was total_Amount)
            'billing_date',
            'due_date'
        ],

        'data' => $billing, // ✅ FIXED
    
    ]) ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>