<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <h2 class="mb-4">Edit Task</h2>
    <form action="/tasks/edit/<?= $task['id'] ?>" method="post" class="form">
        <?= csrf_field() ?>
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="form-control" name="title" value="<?= htmlspecialchars($task['title']) ?>">
            <?php if (isset($validation) && $validation->has_error('title')): ?>
                <div class="text-danger"><?= $validation->form->getError('title') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control" class="form-select">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?> /><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4" class="form-textarea"><?= htmlspecialchars($task['description'] ?? '') ?></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-custom">Update Task</button>
    </form>
</div>
<?= $this->endSection() ?>