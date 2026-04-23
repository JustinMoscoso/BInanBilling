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

        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('employeeDashboard') ?>">
                <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="heigh:80px;
                width:80px;" class="rounded-pill">
            </a>
        </div>
        <hr>

        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="<?= site_url('employeeDashboard') ?>" class="nav-link fs-4 text-white">
                    <i class="bi bi-speedometer2 me-2 fs-4"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="<?= site_url('computeBilling') ?>" class="nav-link fs-4 text-white">
                    <i class="bi bi-calculator me-2 fs-4"></i> Compute Bill
                </a>
            </li>

            <li>
                <a href="#" class="nav-link text-white fs-4">
                    <i class="bi bi-receipt me-2 fs-4"></i> Billing History
                </a>
            </li>

            <li>
                <a href="#" class="nav-link text-white fs-4">
                    <i class="bi bi-clipboard-check me-2 fs-4"></i> Audit
                </a>
            </li>

        </ul>


        <hr>

        <!-- Profile -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center fs-4 text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-2 fs-4"></i>
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