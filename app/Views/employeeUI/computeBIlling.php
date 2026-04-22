<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compute Billing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-weight: 600;
        }

        .rate-card {
            padding: 20px;
        }

        .rate-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .rate-badge {
            background: #000000;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 500;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .billing-card {
            background: linear-gradient(135deg, #0d6efd, #4dabf7);
            color: white;
        }

        .billing-card input {
            border-radius: 10px;
            border: none;
        }

        .billing-card h2 {
            font-size: 2.2rem;
            font-weight: bold;
        }

        .empty-state {
            text-align: center;
            padding: 20px;
            color: #888;
        }
    </style>
</head>

<body>

    <?= view('layout/EmployeeNav') ?>

    <div class="container py-5">

        <!-- HEADER -->
        <div class="mb-4">
            <h3 class="fw-bold">⚡ Compute Electrical Bill</h3>
            <p class="text-muted">Select a client and enter consumption to calculate the bill.</p>
        </div>

        <!-- MAIN ROW -->
        <div class="row g-4">

            <!-- ELECTRIC RATES -->
            <div class="col-md-3">
                <div class="card p-3 h-100">
                    <h6 class="mb-3">Electric Rates</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span>1 - 200 KW</span>
                        <span class="badge bg-dark">₱10 / KW</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>201 - 500 KW</span>
                        <span class="badge bg-dark">₱13 / KW</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>501+ KW</span>
                        <span class="badge bg-dark">₱15 / KW</span>
                    </div>
                </div>
            </div>

            <!-- CLIENTS -->
            <div class="col-md-5">
                <div class="card p-3 h-100">
                    <h5 class="mb-1">👥 Clients</h5>
                    <p class="text-muted small">Select a client to compute billing</p>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Meter</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($clients as $row): ?>
                                    <tr>
                                        <td>
                                            <input type="radio" name="selectedClient"
                                                onclick='selectClient(<?= json_encode($row) ?>)'>
                                        </td>
                                        <td><?= esc($row['full_name']) ?></td>
                                        <td><?= esc($row['address']) ?></td>
                                        <td><?= esc($row['meter_number']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BILLING -->
            <div class="col-md-4">
                <div class="card bg-dark text-light p-4 h-100">

                    <h5 class="mb-3">⚡ Billing Calculator</h5>

                    <p class="mb-1"><strong>Client:</strong> <span id="clientName">Select a client</span></p>
                    <p class="mb-3"><strong>Meter:</strong> <span id="clientMeter">-</span></p>

                    <div class="mb-3">
                        <label class="form-label">Consumption (KW)</label>
                        <input type="number" id="kwInput" class="form-control bg-dark text-light border-secondary"
                            placeholder="Enter KW" oninput="computeBill()">
                    </div>

                    <hr>

                    <h6 class="text-secondary">Total Bill</h6>
                    <h2 class="text-success fw-bold text-light">₱<span id="totalBill">0.00</span></h2>

                </div>
            </div>

        </div>

    </div>

    <script>
        let selectedClient = null;

        function selectClient(client) {
            selectedClient = client;

            document.getElementById("clientName").innerText = client.full_name;
            document.getElementById("clientMeter").innerText = client.meter_number;

            document.getElementById("kwInput").value = "";
            document.getElementById("totalBill").innerText = "0.00";
        }

        function computeBill() {
            const kw = parseFloat(document.getElementById("kwInput").value) || 0;
            let total = 0;

            if (kw <= 200) {
                total = kw * 10;
            } else if (kw <= 500) {
                total = (200 * 10) + ((kw - 200) * 13);
            } else {
                total = (200 * 10) + (300 * 13) + ((kw - 500) * 15);
            }

            document.getElementById("totalBill").innerText = total.toFixed(2);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>