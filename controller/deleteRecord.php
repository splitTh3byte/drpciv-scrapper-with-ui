<?php
$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
} else {

    if (isset($_POST)) {

        $id=$_POST['recordId'];
        $stmt = $link->prepare("DELETE FROM `drpciv`.`data` where `id`=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        header('Location: /drpciv/index.php?page=dashboard');
    }
}