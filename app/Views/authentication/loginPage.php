<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url("<?= base_url('img/imageBack.jpg') ?>") no-repeat center center;
            background-size: cover;
            position: relative;
        }

        /* DARK OVERLAY */
        .bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(15, 23, 42, 0.85),
                    rgba(15, 23, 42, 0.75));
        }

        .login-wrapper {
            height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* CARD */
        .login-card {
            width: 800px;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            background: #f8fafc;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }

        /* LEFT FORM */
        .login-form {
            width: 50%;
            padding: 40px;
        }

        .login-form h4 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        /* INPUT */
        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: none;
        }

        /* BUTTON */
        .btn-login {
            background: #1e293b;
            /* dark slate */
            color: white;
            border-radius: 8px;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.25s;
        }

        .btn-login:hover {
            background: #334155;
            /* lighter dark on hover */
            transform: translateY(-1px);
        }

        /* RIGHT IMAGE */
        .login-image {
            width: 50%;
            background: url("<?= base_url('img/imageBack.jpg') ?>") center/cover;
            position: relative;
        }

        .login-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        /* ICON */
        .toggle-icon {
            cursor: pointer;
            color: #666;
        }
    </style>
</head>

<body>

    <!-- OVERLAY -->
    <div class="bg-overlay"></div>

    <div class="d-flex justify-content-center align-items-center login-wrapper">

        <div class="login-card">

            <!-- LEFT -->
            <div class="login-form">

                <h4>Login</h4>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <div class="position-relative">
                            <input type="password" id="passwordInput" name="password" class="form-control pe-5"
                                required>

                            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-icon"
                                id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mt-3">
                        Login
                    </button>

                </form>

            </div>

            <!-- RIGHT -->
            <div class="login-image"></div>

        </div>

    </div>

    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('passwordInput');

        toggle.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;

            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>