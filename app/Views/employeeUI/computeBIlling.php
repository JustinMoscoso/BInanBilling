<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Compute Billing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }

        .total-box {
            font-size: 2rem;
            font-weight: bold;
            color: #212529;
        }

        .client-row:hover {
            background-color: #f1f3f5;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?= view('layout/EmployeeNav') ?>

    <div style="margin-left: 300px;" class="p-4">

        <!-- ALERT -->
        <div id="alertBox"></div>

        <div class="mb-4">
            <h3 class="fw-bold">Compute Billing</h3>
            <p class="text-muted">Select a client and calculate electricity usage.</p>
        </div>

        <div class="row g-4">

            <!-- CLIENT LIST -->
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-white fw-semibold">
                        Clients
                    </div>

                    <div class="card-body p-0">
                        <div class="p-3">
                            <input type="text" class="form-control" placeholder="Search client...">
                        </div>

                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Meter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $row): ?>
                                    <tr class="client-row" onclick='selectClient(<?= json_encode($row) ?>)'>
                                        <td><input type="radio" name="selectedClient"></td>
                                        <td><?= esc($row['full_name']) ?></td>
                                        <td><?= esc($row['meter_number']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BILLING -->
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-white fw-semibold">
                        Billing Calculator
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Client</label>
                            <input type="text" id="clientName" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meter</label>
                            <input type="text" id="clientMeter" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Consumption (kWh)</label>
                            <input type="number" id="kwInput" class="form-control" placeholder="Enter kWh"
                                oninput="computeBill()">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date" id="dueDateInput" class="form-control" min="<?= date('Y-m-d') ?>">
                        </div>

                        <hr>

                        <!-- TOTAL -->
                        <div class="text-center mb-3">
                            <div class="text-muted">Total Bill</div>
                            <div class="total-box">
                                ₱<span id="totalBill">0.00</span>
                            </div>
                        </div>

                        <!-- 🔥 BREAKDOWN TABLE -->
                        <h6 class="fw-semibold mb-3">Computation Breakdown</h6>

                        <div class="table-responsive mb-3">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Range (kWh)</th>
                                        <th>Rate</th>
                                        <th>Units Used</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>0 - 200</td>
                                        <td>₱10</td>
                                        <td id="tier1Units">0</td>
                                        <td>₱<span id="tier1Total">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>201 - 500</td>
                                        <td>₱13</td>
                                        <td id="tier2Units">0</td>
                                        <td>₱<span id="tier2Total">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>500+</td>
                                        <td>₱15</td>
                                        <td id="tier3Units">0</td>
                                        <td>₱<span id="tier3Total">0.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button class="btn btn-dark w-100" onclick="saveBill(event)">
                            Save Bill
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let selectedClient = null;
        let computedTotal = 0;

        function selectClient(client) {
            selectedClient = client;

            document.getElementById("clientName").value = client.full_name;
            document.getElementById("clientMeter").value = client.meter_number;

            document.getElementById("kwInput").value = "";
            document.getElementById("totalBill").innerText = "0.00";

            // reset table
            document.getElementById("tier1Units").innerText = 0;
            document.getElementById("tier2Units").innerText = 0;
            document.getElementById("tier3Units").innerText = 0;

            document.getElementById("tier1Total").innerText = "0.00";
            document.getElementById("tier2Total").innerText = "0.00";
            document.getElementById("tier3Total").innerText = "0.00";
        }

        function computeBill() {
            const kw = parseFloat(document.getElementById("kwInput").value) || 0;

            let tier1 = 0, tier2 = 0, tier3 = 0;

            if (kw <= 200) {
                tier1 = kw;
            } else if (kw <= 500) {
                tier1 = 200;
                tier2 = kw - 200;
            } else {
                tier1 = 200;
                tier2 = 300;
                tier3 = kw - 500;
            }

            const t1 = tier1 * 10;
            const t2 = tier2 * 13;
            const t3 = tier3 * 15;

            const total = t1 + t2 + t3;

            document.getElementById("tier1Units").innerText = tier1;
            document.getElementById("tier2Units").innerText = tier2;
            document.getElementById("tier3Units").innerText = tier3;

            document.getElementById("tier1Total").innerText = t1.toFixed(2);
            document.getElementById("tier2Total").innerText = t2.toFixed(2);
            document.getElementById("tier3Total").innerText = t3.toFixed(2);

            computedTotal = total;
            document.getElementById("totalBill").innerText = total.toFixed(2);
        }

        function showAlert(message, type) {
            const alertBox = document.getElementById("alertBox");

            alertBox.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            setTimeout(() => {
                alertBox.innerHTML = "";
            }, 3000);
        }

        function saveBill(event) {
            if (!selectedClient) {
                showAlert("Please select a client.", "warning");
                return;
            }

            const kw = parseFloat(document.getElementById("kwInput").value);
            const dueDate = document.getElementById("dueDateInput").value;

            if (!kw || kw <= 0) {
                showAlert("Enter valid consumption.", "warning");
                return;
            }

            if (!dueDate) {
                showAlert("Select due date.", "warning");
                return;
            }

            const btn = event.target;
            btn.disabled = true;
            btn.innerText = "Saving...";

            fetch("<?= base_url('compute_bill') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    client_id: selectedClient.client_id,
                    billing_date: new Date().toISOString().split("T")[0],
                    due_date: dueDate,
                    total_amount: computedTotal,
                    units: kw
                })
            })
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    btn.innerText = "Save Bill";

                    if (data.status === "success") {
                        showAlert("Bill saved successfully!", "success");

                        document.getElementById("kwInput").value = "";
                        document.getElementById("totalBill").innerText = "0.00";

                    } else if (data.status === "exists") {
                        showAlert("This client already has a bill for this month.", "warning");

                    } else {
                        showAlert("Failed to save.", "danger");
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.innerText = "Save Bill";
                    showAlert("Server error.", "danger");
                });
        }

        window.onload = function () {
            const d = new Date();
            d.setDate(d.getDate() + 7);
            document.getElementById("dueDateInput").value =
                d.toISOString().split("T")[0];
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>