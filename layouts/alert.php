<?php if (isset($_GET['alert'])): ?>
    <div class="alert <?php echo (isset($_GET['err']) && $_GET['err'] == 1) ? 'alert-danger' : 'alert-success'; ?>">
        <?php echo htmlspecialchars($_GET['alert']); ?>
    </div>
<?php endif; ?>


