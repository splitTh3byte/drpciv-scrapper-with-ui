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

        $nume = trim(mysqli_real_escape_string($link, $_POST['Addnume']));
        $prenume = trim(mysqli_real_escape_string($link, $_POST['Addprenume']));
        $vin = trim(mysqli_real_escape_string($link, $_POST['Addvin']));
        $data = trim(mysqli_real_escape_string($link, $_POST['Adddata']));
        $category = trim(mysqli_real_escape_string($link, $_POST['categorie']));


        $stmt = $link->prepare("INSERT INTO `drpciv`.`data`(`nume`,`prenume`,`vin`,`data`,`category`) values (?,?,?,?,?)");
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('ssssi', $nume, $prenume, $vin, $data,$category);
        $stmt->execute();
        $stmt->close();
        header('Location: /drpciv/index.php?page=dashboard');
    } else {
        header('Location: /drpciv/index.php?page=500');
    }
}
?>