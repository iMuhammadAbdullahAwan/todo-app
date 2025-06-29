<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <h2 class="mb-4">My Tasks</h2>
    <div class="mb-3">
        <form action="/tasks" method="get" class="d-flex">
            <select name="status" class="form-select me-2" onchange="this.form.submit()">
                <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </form>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr class="task-row">
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td>
                        <?php
                        $category = array_filter($categories, fn($c) => $c['id'] === $task['category_id']);
                        echo htmlspecialchars(array_values($category)[0]['name']);
                        ?>
                    </td>
                    <td>
                        <span class="badge bg-<?= $task['status'] === 'completed' ? 'success' : 'warning' ?>">
                            <?= ucfirst($task['status']) ?>
                        </span>
                    </td>
                    <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="/tasks/delete/<%= task.id %>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    <a href="/tasks/toggle/<%= task.id %>" / class="btn btn-sm btn-info">Toggle Status</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class=" <tr>
                <td colspan=" 4" class="text-center">No tasks found.</td>
            </tr>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>