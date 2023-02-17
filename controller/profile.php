<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
}

require __DIR__.'/../view/profile.php';
