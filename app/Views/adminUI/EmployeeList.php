<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?= view('layout/adminNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- 🔥 CALL YOUR REUSABLE TABLE -->
        <?= view('layout/Table', [
            'title' => 'Employee List',

            'columns' => ['First Name', 'Last Name', 'Username'],
            'fields' => ['first_name', 'last_name', 'username'],

            'data' => $employees,

            'actions' => ['edit', 'delete']
        ]) ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>