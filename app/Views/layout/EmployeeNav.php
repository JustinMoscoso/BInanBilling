<style>
    .sidebar {
        width: 250px;
        /* slimmer */
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
                <a href="<?= site_url('employeeDashboard') ?>">
                    <img src="<?= base_url('img/logo.png') ?>" alt="Logo" style="height:75px; width:75px;"
                        class="rounded-pill shadow">
                </a>
            </div>

            <hr>

            <!-- Menu -->
            <ul class="nav nav-pills flex-column mb-auto">

                <li>
                    <a href="<?= site_url('employeeDashboard') ?>"
                        class="nav-link text-white <?= uri_string() == 'employeeDashboard' ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('computeBilling') ?>"
                        class="nav-link text-white <?= uri_string() == 'computeBilling' ? 'active' : '' ?>">
                        <i class="bi bi-calculator me-2"></i> Compute Bill
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('billingHistory') ?>"
                        class="nav-link text-white <?= uri_string() == 'billingHistory' ? 'active' : '' ?>">
                        <i class="bi bi-receipt me-2"></i> Billing History
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

                    <strong>
                        <?= esc(
                            session()->get('full_name')
                            ?: trim((session()->get('first_name') ?? '') . ' ' . (session()->get('last_name') ?? ''))
                            ?: explode('@', session()->get('username'))[0]
                        ) ?>
                    </strong>
                </a>

                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <a class="dropdown-item" href="<?= site_url('logout') ?>">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>