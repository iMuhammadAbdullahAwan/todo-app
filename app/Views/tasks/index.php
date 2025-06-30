<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">My Tasks</h2>
        <a href="/tasks/create" class="btn btn-custom">+ Add Task</a>
    </div>

    <div class="mb-3">
        <form action="/tasks" method="get" class="d-flex">
            <select name="status" class="form-select w-auto me-2" onchange="this.form.submit()">
                <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th style="min-width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr class="task-row">
                            <td data-label="Title"><?= esc($task['title']) ?></td>
                            <td data-label="Category">
                                <?php
                                $category = array_filter($categories, fn($c) => $c['id'] === $task['category_id']);
                                echo esc(array_values($category)[0]['name'] ?? 'Uncategorized');
                                ?>
                            </td>
                            <td data-label="Status">
                                <span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($task['status']) ?>
                                </span>
                            </td>
                            <td data-label="Actions">
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $task['id'] ?>)">Delete</button>
                                    <a href="/tasks/toggle/<?= $task['id'] ?>" class="btn btn-sm btn-info text-white">Toggle</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No tasks found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete this task.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/tasks/delete/${id}`;
            }
        });
    }
</script>

<?= $this->endSection() ?>