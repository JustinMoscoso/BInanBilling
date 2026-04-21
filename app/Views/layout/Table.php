<div class="card shadow-sm">
    <div class="card-body">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><?= esc($title ?? 'Table') ?></h5>

            <?php if (isset($addUrl)): ?>
                <a href="<?= site_url($addUrl) ?>" class="btn btn-primary btn-sm">
                    + Add
                </a>
            <?php endif; ?>
        </div>

        <!-- 🔍 Search -->
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search..." onkeyup="filterTable(this)">
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="gridTable">

                <thead class="table-dark">
                    <tr>
                        <?php foreach ($columns as $col): ?>
                            <th><?= esc($col) ?></th>
                        <?php endforeach; ?>
                        <?php if (!empty($actions)): ?>
                            <th class="text-center">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>

                            <?php foreach ($fields as $field): ?>
                                <td><?= esc($row[$field]) ?></td>
                            <?php endforeach; ?>

                            <?php if (!empty($actions)): ?>
                                <td class="text-center">

                                    <?php if (in_array('edit', $actions)): ?>
                                        <button class="btn btn-sm btn-warning" onclick='openEditModal(<?= json_encode($row) ?>)'>
                                            Edit
                                        </button>
                                    <?php endif; ?>

                                    <?php if (in_array('delete', $actions)): ?>
                                        <button class="btn btn-sm btn-danger" onclick="openDeleteModal(<?= $row['user_id'] ?>)">
                                            Delete
                                        </button>
                                    <?php endif; ?>

                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

        <!-- 📄 Pagination -->
        <nav>
            <ul class="pagination justify-content-center mt-3" id="pagination"></ul>
        </nav>

    </div>
</div>

<!-- 🔥 JS -->
<script>
    let currentPage = 1;
    const rowsPerPage = 5;

    function filterTable(input) {
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll("#gridTable tbody tr");

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
        });
    }

    function paginate() {
        const rows = document.querySelectorAll("#gridTable tbody tr");
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        rows.forEach((row, index) => {
            row.style.display = (index >= (currentPage - 1) * rowsPerPage &&
                index < currentPage * rowsPerPage) ? "" : "none";
        });

        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
            </li>
        `;
        }
    }

    function goToPage(page) {
        currentPage = page;
        paginate();
    }

    document.addEventListener("DOMContentLoaded", paginate);

    function openEditModal(data) {
        alert("Edit user: " + data.username);
    }

    function openDeleteModal(id) {
        if (confirm("Delete this user?")) {
            window.location.href = "delete/" + id;
        }
    }
</script>