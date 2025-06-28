<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card auth-card p-4">
            <h2 class="text-center mb-4">Register</h2>
            <form action="/register" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
                    <?php if (isset($validation) && $validation->hasError('username')): ?>
                        <div class="text-danger"><?= $validation->getError('username') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>">
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="text-danger"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                        <div class="text-danger"><?= $validation->getError('confirm_password') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-custom w-100">Register</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="/login">Login</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>