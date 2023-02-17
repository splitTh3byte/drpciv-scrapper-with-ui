<?php
session_start();
session_destroy();
setcookie(session_name(), session_id(), time()-3600);
// Redirect to the login page:
header('Location: /drpciv/index.php?page=login');