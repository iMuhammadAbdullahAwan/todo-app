<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do App</title>

    <!-- Bootstrap + SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6366f1, #60a5fa);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-custom {
            background-color: #4f46e5;
            color: white;
            transition: all 0.2s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #4338ca;
        }

        .task-row:hover {
            background-color: #f3f4f6;
        }

        .navbar .btn {
            margin-left: 0.5rem;
        }

        @media (max-width: 576px) {
            .navbar .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .navbar .navbar-text {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/tasks">📝 To-Do App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <div class="navbar-nav align-items-center">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <span class="navbar-text text-white me-2">
                            👋 <?= esc(session()->get('username')) ?>
                        </span>
                        <a href="/logout" class="btn btn-sm btn-outline-light">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="btn btn-sm btn-outline-light me-2">Login</a>
                        <a href="/register" class="btn btn-sm btn-custom">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTAINER -->
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= esc(session()->getFlashdata('success')) ?>',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= esc(session()->getFlashdata('error')) ?>',
                    timer: 2500,
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <!-- JS Includes -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>