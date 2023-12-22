<?php if (!empty($errors)) : ?>
    <div class="error-formulaire">
        <?php foreach ($errors as $err) : ?>
            <div class="text-danger fw-bolder bg-danger-subtle border border-danger border-2 rounded-1 text-center">⚠ <?= $err ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>