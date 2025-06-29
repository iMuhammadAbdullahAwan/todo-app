<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <h2 class="mb-4">Add New Task</h2>
    <form action="/tasks/create" method="post" class="form">
        <?= csrf_field() ?>
        <div class="form-group mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>">
            <?php if (isset($validation) && $validation->has_error('title')): ?>
                <div class="form-group text-danger"><?= $validation->getError('title') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="form-select" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4"><?= old('description') ?></textarea>
        </div>
        <button type="submit" class="btn btn-custom">Create Task</button>
    </form>
</div>
<?= $this->endsection() ?>