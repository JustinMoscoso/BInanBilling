<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?= view('layout/employeeNav') ?>

    <div class="container py-5">

        <!-- Welcome -->
        <div class="mb-4">
            <h3>Welcome,
                <?= session()->get('username') ?>
            </h3>
            <p class="text-muted">Dashboard</p>
        </div>

        <!-- 🔷 Cards -->
        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text display-5 text-primary"></i>
                        <h5 class="mt-3">My Bills</h5>
                        <p class="text-muted">View your billing records</p>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-clock-history display-5 text-success"></i>
                        <h5 class="mt-3">Usage History</h5>
                        <p class="text-muted">Track your consumption</p>
                        <a href="#" class="btn btn-success btn-sm">View</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-person display-5 text-warning"></i>
                        <h5 class="mt-3">Profile</h5>
                        <p class="text-muted">Update your information</p>
                        <a href="#" class="btn btn-warning btn-sm text-white">Edit</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- 🔷 Table Section (Example) -->
        <div class="card mt-5 shadow-sm border-0">
            <div class="card-body">

                <h5 class="mb-3">Recent Activity</h5>

                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>April 21, 2026</td>
                            <td>Logged in</td>
                            <td><span class="badge bg-success">Success</span></td>
                        </tr>
                        <tr>
                            <td>April 20, 2026</td>
                            <td>Viewed bills</td>
                            <td><span class="badge bg-primary">Info</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>