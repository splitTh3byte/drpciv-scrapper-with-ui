<?php

$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
} else {

    if ($_POST || $_FILES) {


        $target_dir = "uploads";
        $target_file = $_FILES["uploadFile"]["name"];

        if (stripos($target_file, '.php') || stripos($target_file, '.php5') || stripos($target_file, '.phphtm') || stripos($target_file, '.php3')) {

            header('Location: /drpciv/index.php?page=401');
            exit;
        }
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($fileType == 'csv') {
            if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], __DIR__ . '/' . "$target_dir/$target_file")) {


                $files = glob(__DIR__ . '/uploads/*.csv');

                $fileName = $files[0];


                if (isset($_POST["deleteRecords"])) {

                    $stmt = $link->prepare("TRUNCATE TABLE `drpciv`.`data`;");
                    $stmt->execute();
                    $stmt->close();

                    insertNewRecords($fileName);


                } else {
                    insertNewRecords($fileName);
                }
                header('Location: /drpciv/index.php?page=dashboard');
                exit;
            }
        } else {
            header('Location: /drpciv/index.php?page=401');
            exit;
        }
    } else {
        header('Location: /drpciv/index.php?page=401');
        exit;

    }
}

function insertNewRecords($fileName)
{
    global $link;
    $fp = fopen($fileName, 'r');
    while (!feof($fp) && $fp) {
        $line = fgetcsv($fp, null, ';');

        if ($line[0]) {
            $stmt = $link->prepare("INSERT INTO `drpciv`.`data`(`id`,`nume`,`prenume`,`VIN`,`rezervare`,`data`,`category`) VALUES (NULL ,'$line[0]','$line[1]','$line[2]',0,'$line[3]','$line[4]')");
            $stmt->execute();
        }
    }
    fclose($fp);
    unlink($fileName);
    $stmt->close();


}
