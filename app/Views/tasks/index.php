<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-custom p-4 shadow">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📋 My Tasks</h2>
        <a href="/tasks/create" class="btn btn-success">
            ➕ Add Task
        </a>
    </div>

    <form action="/tasks" method="get" class="mb-3 d-flex justify-content-end">
        <select name="status" class="form-select w-auto" onchange="this.form.submit()">
            <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
        </select>
    </form>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($tasks) > 0): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['title']) ?></td>
                        <td>
                            <?php
                            $category = array_filter($categories, fn($c) => $c['id'] === $task['category_id']);
                            echo esc(array_values($category)[0]['name'] ?? 'N/A');
                            ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : 'warning' ?>">
                                <?= ucfirst($task['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-outline-primary">✏️ Edit</a>

                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $task['id'] ?>)">
                                    🗑️ Delete
                                </button>

                                <a href="/tasks/toggle/<?= $task['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                    🔁 Toggle
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- SweetAlert delete confirmation -->
<script>
    function confirmDelete(taskId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This task will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/tasks/delete/${taskId}`;
            }
        });
    }
</script>

<?= $this->endSection() ?>