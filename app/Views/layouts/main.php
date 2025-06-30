<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do App</title>

    <!-- Bootstrap & SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4f46e5, #93c5fd);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-custom {
            background-color: #6366f1;
            color: white;
            transition: background 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #4f46e5;
        }

        .task-row:hover {
            background-color: #f3f4f6;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .navbar .btn {
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/tasks">📝 To-Do App</a>
            <div class="navbar-nav ms-auto d-flex align-items-center">
                <?php if (session()->get('isLoggedIn')): ?>
                    <span class="navbar-text text-white me-3">
                        👋 Hello, <?= esc(session()->get('username')) ?>
                    </span>
                    <a href="/tasks/create" class="btn btn-sm btn-custom">+ Add Task</a>
                    <a href="/logout" class="btn btn-sm btn-outline-light">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-sm btn-outline-light me-2">Login</a>
                    <a href="/register" class="btn btn-sm btn-custom">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Messages & Page Content -->
    <div class="container mt-5">
        <?php if (session()->getFlashdata('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= esc(session()->getFlashdata('success')) ?>',
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= esc(session()->getFlashdata('error')) ?>',
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>