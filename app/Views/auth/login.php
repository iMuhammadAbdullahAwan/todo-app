<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card auth-card p-4 shadow-sm rounded-4">
            <h2 class="text-center mb-4">🔐 Login</h2>
            <form action="/login" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger small"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="text-danger small"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="/register">Register</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>