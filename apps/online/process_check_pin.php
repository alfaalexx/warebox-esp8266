<?php
require 'database.php';

if (!empty($_POST['pin'])) {
    $pin = $_POST['pin'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM statusled WHERE pin = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($pin));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        // PIN benar, update 'Stat' menjadi 1
        $sqlUpdate = "UPDATE statusled SET Stat = 1 WHERE pin = ?";
        $qUpdate = $pdo->prepare($sqlUpdate);
        $qUpdate->execute(array($pin));

        echo "<script>alert('PIN is correct. Locker is opened successfully.');</script>";

        // Tunggu 12 detik kemudian set 'Stat' kembali ke 0
        sleep(12);
        $sqlReset = "UPDATE statusled SET Stat = 0 WHERE pin = ?";
        $qReset = $pdo->prepare($sqlReset);
        $qReset->execute(array($pin));

    } else {
        // PIN salah
        echo "<script>alert('Incorrect PIN. Please try again.');</script>";
    }

    Database::disconnect();
}

// Redirect back to the check PIN page after showing the alert
echo "<script>window.location.replace('check_pin.php');</script>";
?>
