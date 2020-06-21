<?php

if (isset($_SESSION['notif']) && isset($_SESSION['notif_type'])) { ?>

    <div class="alert alert-<?php echo $_SESSION['notif_type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['notif']; ?>
        <button type="button" id="tombol-notif" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php } ?>