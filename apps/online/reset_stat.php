<?php
require 'database.php';

if (!empty($_POST['pin'])) {
    $pin = $_POST['pin'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlUpdate = "UPDATE statusled SET Stat = 0 WHERE pin = ?";
    $qUpdate = $pdo->prepare($sqlUpdate);
    $qUpdate->execute(array($pin));

    Database::disconnect();
}
?>
