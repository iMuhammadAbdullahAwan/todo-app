<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6b7280, #d1d5db);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background: #4f46e5;
            color: white;
        }

        .btn-custom:hover {
            background: #4338ca;
        }

        .task-row:hover {
            background: #f9fafb;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/tasks">To-Do App</a>
            <div class="navbar-nav ms-auto">
                <?php if (session()->get('isLoggedIn')): ?>
                    <span class="navbar-text me-3">Welcome, <?= session()->get('username') ?></span>
                    <a href="/tasks/create" class="btn btn-custom me-2">Add Task</a>
                    <a href="/logout" class="btn btn-outline-light">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-light me-2">Login</a>
                    <a href="/register" class="btn btn-custom">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?php if (session()->getFlashdata('success')): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= session()->getFlashdata('success') ?>',
                    timer: 3000
                });
            </script>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= session()->getFlashdata('error') ?>',
                    timer: 3000
                });
            </script>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>