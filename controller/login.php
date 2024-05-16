<?php


$db = Database::getInstance();
$link = $db->getConnection();
$obj = new websitePanel($link, TABLE);

if (isset($_SESSION['loggedin'])) {
    header('Location: https://drpciv.codeflow.ro/drpciv/index.php?page=dashboard');
    exit;
}


if (!isset($_POST['username'], $_POST['password'])) {
    require __DIR__ . '/../view/login.php';
} else {

    $stmt = $link->prepare("SELECT id, password FROM `drpciv`.`users` WHERE `username` = ?");
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header("Location: https://drpciv.codeflow.ro/drpciv/index.php?page=dashboard");
        } else {
            // Incorrect password
            header("Location: https://drpciv.codeflow.ro/drpciv/index.php?page=401");
        }
    } else {
        // Incorrect username
        header("Location: https://drpciv.codeflow.ro/drpciv/index.php?page=401");
    }

    $stmt->close();
}
?>
