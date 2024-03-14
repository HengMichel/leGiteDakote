<?php if (!empty($errors)) : ?>
    <div class="error-formulaire">
        <?php foreach ($errors as $err) : ?>
            <div class="alert alert-danger fw-bolder bg-danger-subtle border-2 rounded-1 text-center" role="alert">⚠ <?= $err ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>