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
            /* neutral (no green) */
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

        <!-- HEADER (no icon) -->
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

                        <!-- SEARCH -->
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
                                        <td>
                                            <input type="radio" name="selectedClient">
                                        </td>
                                        <td><?= esc($row['full_name']) ?></td>
                                        <td><?= esc($row['meter_number']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- BILLING FORM -->
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-white fw-semibold">
                        Billing Calculator
                    </div>

                    <div class="card-body">

                        <!-- CLIENT -->
                        <div class="mb-3">
                            <label class="form-label">Client</label>
                            <input type="text" id="clientName" class="form-control" disabled>
                        </div>

                        <!-- METER -->
                        <div class="mb-3">
                            <label class="form-label">Meter</label>
                            <input type="text" id="clientMeter" class="form-control" disabled>
                        </div>

                        <!-- KW -->
                        <div class="mb-3">
                            <label class="form-label">Consumption (kWh)</label>
                            <input type="number" id="kwInput" class="form-control" placeholder="Enter kWh"
                                oninput="computeBill()">
                        </div>

                        <!-- DUE DATE -->
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

                        <!-- BUTTON -->
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

            computedTotal = total;
            document.getElementById("totalBill").innerText = total.toFixed(2);
        }

        function saveBill(event) {
            if (!selectedClient) {
                alert("Please select a client.");
                return;
            }

            const kw = parseFloat(document.getElementById("kwInput").value);
            const dueDate = document.getElementById("dueDateInput").value;

            if (!kw || kw <= 0) {
                alert("Enter valid consumption.");
                return;
            }

            if (!dueDate) {
                alert("Select due date.");
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
                        alert("Bill saved successfully!");
                        document.getElementById("kwInput").value = "";
                        document.getElementById("totalBill").innerText = "0.00";
                    } else {
                        alert("Failed to save.");
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.innerText = "Save Bill";
                    alert("Server error.");
                });
        }

        window.onload = function () {
            const d = new Date();
            d.setDate(d.getDate() + 7);
            document.getElementById("dueDateInput").value =
                d.toISOString().split("T")[0];
        };
    </script>

</body>

</html>