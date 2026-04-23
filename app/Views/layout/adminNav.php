<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .sidebar .nav-link {
        font-size: 18px;
        padding: 12px 15px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar .nav-link:hover {
        background-color: white !important;
        color: black !important;
        border-radius: 8px;
    }

    .sidebar .nav-link.active {
        background-color: white !important;
        color: black !important;
        border-radius: 8px;
    }

    .sidebar i {
        font-size: 20px;
    }
</style>
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white p-3 vh-100 position-fixed sidebar" style="width: 250px;">

            <h4 class="mb-3">Admin Panel</h4>
            <hr>

            <ul class="nav nav-pills flex-column mb-auto">

                <li>
                    <a href="<?= site_url('dashboard') ?>"
                        class="nav-link <?= uri_string() == 'dashboard' ? 'active' : 'text-white' ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('addEmployee') ?>"
                        class="nav-link <?= uri_string() == 'addEmployee' ? 'active' : 'text-white' ?>">
                        <i class="bi bi-person-plus-fill"></i> Manage Employee
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('employees') ?>"
                        class="nav-link <?= uri_string() == 'employees' ? 'active' : 'text-white' ?>">
                        <i class="bi bi-people-fill"></i> Employees
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('addClient') ?>"
                        class="nav-link <?= uri_string() == 'addClient' ? 'active' : 'text-white' ?>">
                        <i class="bi bi-person-badge-fill"></i> Manage Client
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-clipboard-data-fill"></i> Audit
                    </a>
                </li>

            </ul>

            <hr>

            <!-- Profile -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2"></i>
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