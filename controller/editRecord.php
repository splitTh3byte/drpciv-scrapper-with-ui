<?php
$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
} else {

    if($_POST){

        if (isset($_POST)) {

            $id=trim(mysqli_real_escape_string($link,$_POST['recordId']));
            $nume=trim(mysqli_real_escape_string($link,$_POST['nume']));
            $prenume=trim(mysqli_real_escape_string($link,$_POST['prenume']));
            $vin=trim(mysqli_real_escape_string($link,$_POST['vin']));
            $data=trim(mysqli_real_escape_string($link,$_POST['data']));
            $category=trim(mysqli_real_escape_string($link,$_POST['categorie']));


            $stmt = $link->prepare("UPDATE `drpciv`.`data` SET `nume`=?,`prenume`=?,`vin`=?,`data`=? ,`category`=? where `id`=?");
            $stmt->bind_param('ssssii', $nume,$prenume,$vin,$data,$category,$id);
            $stmt->execute();
            $stmt->close();
            header('Location: /drpciv/index.php?page=dashboard');
        }
    }else{
        header('Location: /drpciv/index.php?page=500');
    }


}