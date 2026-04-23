<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-image {
            background: url("<?= base_url('img/imageBack.jpg') ?>") no-repeat center center;
            background-size: cover;
            height: 100vh;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.5);
            height: 100%;
        }

        .login-panel {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 40px;
            width: 350px;
            border-radius: 10px;
            backdrop-filter: blur(6px);
        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            color: white;
        }

        .form-control:focus {
            background: transparent;
            box-shadow: none;
            border-color: #fff;
            color: white;
        }

        .btn-login {
            background: #dfe6e9;
            border: none;
            color: #000;
            font-weight: bold;
        }

        .btn-login:hover {
            background: #b2bec3;
        }

        .placeholder-white::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>

    <div class="bg-image">
        <div class="overlay d-flex justify-content-center align-items-center">

            <!-- LEFT LOGIN PANEL -->

            <div class="login-panel d-flex flex-column justify-content-center">

                <h2 class="mb-4">Welcome Back</h2>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('login') ?>" method="post">


                    <div class="mb-4">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="example@gmail.com"
                            class="form-control text-white placeholder-white" required>
                    </div>

                    <div class="mb-4">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="*********"
                            class="form-control text-white placeholder-white" required>
                    </div>

                    <button type="submit" class="btn btn-login w-100">Login</button>

                </form>
            </div>



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>