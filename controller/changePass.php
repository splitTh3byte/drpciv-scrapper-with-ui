<?php

$db = Database::getInstance();
$link = $db->getConnection();
$obj=new websitePanel($link,TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
}

if($_POST){
    $password = $_POST['password'];
    $new_password=$_POST['new_password'];
    $hash_password = password_hash($new_password, PASSWORD_BCRYPT);


    $stmt = $link->prepare("UPDATE `drpciv`.`users` SET `password`=? where `id`=?");
    $stmt->bind_param('si', $hash_password,$_SESSION['id']);
    $stmt->execute();
    $stmt->close();
    $passwordChanged=true;
    header("Location: /drpciv/index.php?page=profile"."&changed=".$passwordChanged);

}


