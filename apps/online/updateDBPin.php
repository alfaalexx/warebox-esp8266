<?php
require 'database.php';

if (!empty($_POST)) {
    $pin = $_POST['pin'];

    // Check if ID 0 already exists
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql_check = "SELECT COUNT(*) AS count FROM statusled WHERE ID = 0";
    $q_check = $pdo->query($sql_check);
    $row = $q_check->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] > 0) {
        // ID 0 exists, update the existing record
        $sql_update = "UPDATE statusled SET pin = ? WHERE ID = 0";
        $q_update = $pdo->prepare($sql_update);
        $q_update->execute(array($pin));
    } else {
        // ID 0 does not exist, insert a new record
        $sql_insert = "INSERT INTO statusled (ID, pin) VALUES (0, ?)";
        $q_insert = $pdo->prepare($sql_insert);
        $q_insert->execute(array($pin));
    }

    Database::disconnect();
    header("Location: ../user_index.php");
}
?>
