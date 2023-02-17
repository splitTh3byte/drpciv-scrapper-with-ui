<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
} else {


    if ($_POST) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_BCRYPT);


        $stmt = $link->prepare("INSERT INTO `drpciv`.`users`(`username`,`password`,`email`) values (?,?,?)");
        $stmt->bind_param('sss', $username, $hash_password, $email);
        $stmt->execute();
        $stmt->close();
        header('Location: /drpciv/index.php?page=profile');
    }else{
        header('Location: /drpciv/index.php?page=500');
    }



}
?>