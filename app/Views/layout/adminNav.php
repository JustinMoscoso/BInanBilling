<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .sidebar .nav-link {
        font-size: 16px;
        padding: 10px 15px;
        transition: all 0.2s ease;
    }

    .sidebar .nav-link:hover {
        background-color: white !important;
        color: black !important;
        border-radius: 8px;
    }

    .sidebar .nav-link.active {
        background-color: white;
        color: black !important;
        border-radius: 8px;
    }

    .sidebar i {
        font-size: 18px;
    }
</style>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100 position-fixed sidebar" style="width: 300px;">

        <!-- Logo (same as employee) -->
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('dashboard') ?>">
                <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="height:80px; width:80px;"
                    class="rounded-pill">
            </a>
        </div>

        <hr>

        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="<?= site_url('dashboard') ?>"
                    class="nav-link fs-5 <?= uri_string() == 'dashboard' ? 'active' : 'text-white' ?>">
                    <i class="bi bi-speedometer2 me-2 fs-5"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="<?= site_url('addEmployee') ?>"
                    class="nav-link fs-5 <?= uri_string() == 'addEmployee' ? 'active' : 'text-white' ?>">
                    <i class="bi bi-person-plus me-2 fs-5"></i> Manage Employee
                </a>
            </li>

            <li>
                <a href="<?= site_url('employees') ?>"
                    class="nav-link fs-5 <?= uri_string() == 'employees' ? 'active' : 'text-white' ?>">
                    <i class="bi bi-people me-2 fs-5"></i> Employees
                </a>
            </li>

            <li>
                <a href="<?= site_url('addClient') ?>"
                    class="nav-link fs-5 <?= uri_string() == 'addClient' ? 'active' : 'text-white' ?>">
                    <i class="bi bi-person-badge me-2 fs-5"></i> Manage Client
                </a>
            </li>

            <li>
                <a href="#" class="nav-link text-white fs-5">
                    <i class="bi bi-clipboard-check me-2 fs-5"></i> Audit
                </a>
            </li>

        </ul>

        <hr>

        <!-- Profile -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center fs-5 text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-2 fs-5"></i>
                <strong><?= session()->get('username') ?></strong>
            </a>

            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </div>

    </div>

</div>