<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <h2 class="mb-4">Edit Task</h2>

    <form action="/tasks/edit/<?= $task['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= esc($task['title']) ?>">
            <?= isset($validation) ? $validation->showError('title') : '' ?>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?>>
                        <?= esc($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= isset($validation) ? $validation->showError('category_id') : '' ?>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control"><?= esc($task['description']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-custom">Update</button>
        <a href="/tasks" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>