<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
    <?= view('layout/adminNav') ?>
<div style="margin-left: 250px;" class="p-4">

        <!-- Welcome -->
        <h3 class="mb-4">Welcome,
            <?= esc($username) ?>
        </h3>

        <!-- CARDS -->
        <div class="row g-3">

            <div class="col-md-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h6>Total Clients</h6>
                        <h3>10</h3>
                        <i class="bi bi-people fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h6>Total Bills</h6>
                        <h3>25</h3>
                        <i class="bi bi-receipt fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-dark bg-warning shadow">
                    <div class="card-body">
                        <h6>Total Revenue</h6>
                        <h3>₱50,000</h3>
                        <i class="bi bi-cash-stack fs-2"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h6>Audit Logs</h6>
                        <h3>12</h3>
                        <i class="bi bi-clock-history fs-2"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="card mt-4 shadow">
            <div class="card-header">
                <h5>Recent Bills</h5>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Client</th>
                            <th>Meter</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan Dela Cruz</td>
                            <td>12345</td>
                            <td>₱2,500</td>
                            <td>2026-04-20</td>
                        </tr>
                        <tr>
                            <td>Maria Santos</td>
                            <td>67890</td>
                            <td>₱1,800</td>
                            <td>2026-04-19</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>