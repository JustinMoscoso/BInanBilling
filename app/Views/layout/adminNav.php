<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .sidebar {
        width: 250px;
        background-color: #212529;
    }

    .sidebar .nav-link {
        font-size: 18px;
        padding: 12px 16px;
        margin-bottom: 6px;
        transition: all 0.25s ease;
        border-radius: 8px;
    }

    .sidebar .nav-link:hover {
        background-color: white !important;
        color: black !important;
        transform: translateX(4px);
    }

    .sidebar .nav-link.active {
        background-color: white;
        color: black !important;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .sidebar i {
        font-size: 20px;
        opacity: 0.9;
    }

    .sidebar hr {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .profile-section a {
        padding: 10px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .profile-section a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="text-white p-3 vh-100 position-fixed sidebar d-flex flex-column justify-content-between">

        <!-- TOP -->
        <div>

            <!-- Logo -->
            <div class="text-center mb-4">
                <a href="<?= site_url('dashboard') ?>">
                    <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="height:75px; width:75px;"
                        class="rounded-pill shadow">
                </a>
            </div>

            <hr>

            <!-- Menu -->
            <ul class="nav nav-pills flex-column mb-auto">

                <li>
                    <a href="<?= site_url('dashboard') ?>"
                        class="nav-link text-white <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('addEmployee') ?>"
                        class="nav-link text-white <?= uri_string() == 'addEmployee' ? 'active' : '' ?>">
                        <i class="bi bi-person-plus me-2"></i> Manage Employee
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('addClient') ?>"
                        class="nav-link text-white <?= uri_string() == 'addClient' ? 'active' : '' ?>">
                        <i class="bi bi-person-badge me-2"></i> Manage Client
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('employees') ?>"
                        class="nav-link text-white <?= uri_string() == 'employees' ? 'active' : '' ?>">
                        <i class="bi bi-people me-2"></i> Employees
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('audit-logs') ?>"
                        class="nav-link text-white <?= uri_string() == 'audit-logs' ? 'active' : '' ?>">
                        <i class="bi bi-clipboard-check me-2"></i> Audit Logs
                    </a>
                </li>

            </ul>

        </div>

        <!-- BOTTOM PROFILE -->
        <div class="profile-section">
            <hr>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">

                    <i class="bi bi-person-circle me-2"></i>
                    <strong><?= session()->get('username') ?></strong>
                </a>

                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <a class="dropdown-item" href="/logout">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>