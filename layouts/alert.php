<?php if (isset($_GET['alert']) && $_GET['alert'] != '') : ?>
    <div id="alert-box" style="text-align: center;z-index: 9999; position: fixed; top: 0; transition: 0.5s;width: 100%;" class="alert <?php echo (isset($_GET['err']) && $_GET['err'] == 1) ? 'alert-danger' : 'alert-success'; ?>">
        <?php echo htmlspecialchars($_GET['alert']); ?>
    </div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var alertBox = document.getElementById('alert-box');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    },3000);
</script>


