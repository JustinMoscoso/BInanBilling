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
    </style>
</head>

<body>

    <?= view('layout/EmployeeNav') ?>

    <div class="container py-5">

        <h3 class="fw-bold mb-4">⚡ Compute Electrical Bill</h3>

        <div class="row g-4">

            <!-- CLIENTS -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>👥 Clients</h5>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
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
                                    <td><?= esc($row['meter_number']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- BILLING -->
            <div class="col-md-6">
                <div class="card bg-dark text-light p-4">

                    <h5>⚡ Billing Calculator</h5>

                    <p><strong>Client:</strong> <span id="clientName">Select a client</span></p>
                    <p><strong>Meter:</strong> <span id="clientMeter">-</span></p>

                    <!-- KW INPUT -->
                    <div class="mb-3">
                        <label>Consumption (KW)</label>
                        <input type="number" id="kwInput" class="form-control" oninput="computeBill()">
                    </div>

                    <!-- 📅 DUE DATE -->
                    <div class="mb-3">
                        <label>Due Date</label>
                        <input type="date" id="dueDateInput" class="form-control" min="<?= date('Y-m-d') ?>">
                    </div>

                    <hr>

                    <h6>Total Bill</h6>
                    <h2>₱<span id="totalBill">0.00</span></h2>

                    <!-- SAVE BUTTON -->
                    <button class="btn btn-success w-100 mt-3" onclick="saveBill(event)">
                        💾 Save Bill
                    </button>

                </div>
            </div>

        </div>
    </div>

    <script>
        let selectedClient = null;
        let computedTotal = 0;

        function selectClient(client) {
            selectedClient = client;

            document.getElementById("clientName").innerText = client.full_name;
            document.getElementById("clientMeter").innerText = client.meter_number;

            document.getElementById("kwInput").value = "";
            document.getElementById("totalBill").innerText = "0.00";
        }

        // ⚡ COMPUTE BILL
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

        // 💾 SAVE BILL
        function saveBill(event) {
            // ✅ Check client
            if (!selectedClient) {
                alert("Please select a client.");
                return;
            }

            const kw = parseFloat(document.getElementById("kwInput").value);
            const dueDate = document.getElementById("dueDateInput").value;

            // ✅ Validate inputs
            if (!kw || kw <= 0) {
                alert("Enter valid consumption (KW).");
                return;
            }

            if (!dueDate) {
                alert("Please select a due date.");
                return;
            }

            // ✅ Button loading state
            const btn = event.target;
            btn.disabled = true;
            btn.innerText = "Saving...";

            fetch("<?= base_url('compute-bill') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    client_id: selectedClient.client_id,
                    billing_date: new Date().toISOString().split("T")[0],
                    due_date: dueDate,
                    total_amount: computedTotal,
                    units: parseFloat(document.getElementById("kwInput").value) // ✅ ADD THIS
                })
            })
                .then(async res => {
                    // 🔥 Handle non-JSON responses safely
                    let data;
                    try {
                        data = await res.json();
                    } catch {
                        throw new Error("Invalid server response");
                    }
                    return data;
                })
                .then(data => {
                    btn.disabled = false;
                    btn.innerText = "💾 Save Bill";

                    if (data.status === "success") {
                        alert("✅ Bill saved successfully!");

                        // 🔄 Reset form
                        document.getElementById("kwInput").value = "";
                        document.getElementById("totalBill").innerText = "0.00";

                    } else {
                        console.log("Server error:", data);
                        alert("❌ Failed: " + JSON.stringify(data.message || data));
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);

                    btn.disabled = false;
                    btn.innerText = "💾 Save Bill";

                    alert("⚠️ Server error or invalid response.");
                });
        }

        // 📅 DEFAULT DUE DATE (+7 DAYS)
        window.onload = function () {
            const d = new Date();
            d.setDate(d.getDate() + 7);
            document.getElementById("dueDateInput").value =
                d.toISOString().split("T")[0];
        };
    </script>

</body>

</html>