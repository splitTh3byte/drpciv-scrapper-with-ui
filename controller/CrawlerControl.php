<?php

$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (!isset($_SESSION['loggedin'])) {
    header('Location: /drpciv/index.php?page=login');
    exit;
} else {

    if ($_GET['state'] == 1) {

        $script = "/usr/bin/php /var/www/drpciv.codeflow.ro/public_html/drpciv/drpciv-scrapper/take.php > /dev/null   2>&1 & echo $!;";
        $pid = exec($script, $output);

        $stmt = $link->prepare("INSERT INTO `drpciv`.`pids`(`pids`) VALUES(?)");
        $stmt->bind_param('s', $pid);
        $stmt->execute();
        $stmt->close();

        header('Location: /drpciv/index.php?page=dashboard');
        exit;
    } else {

        $query = "SELECT `pids` from `drpciv`.`pids` where 1";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $killId = "kill -9 " . $row['pids'];
            exec($killId);
            $query="DELETE FROM `drpciv`.`pids` where `pids`=".$row['pids'];
            $result=mysqli_query($link,$query);
        }
        header('Location: /drpciv/index.php?page=dashboard');

    }
}
