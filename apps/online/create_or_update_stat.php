<?php
include 'database.php';

if (!empty($_POST['ID'])) {
    $id = $_POST['ID'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah data dengan ID yang diberikan sudah ada
    $sql = 'SELECT * FROM statusled WHERE ID = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        // Jika data dengan ID yang diberikan sudah ada, update 'Stat' menjadi 1
        $sqlUpdate = 'UPDATE statusled SET Stat = 1 WHERE ID = ?';
        $qUpdate = $pdo->prepare($sqlUpdate);
        $qUpdate->execute(array($id));
        $response = array('status' => 'success', 'message' => 'Stat updated to 1 for existing ID.');
    } else {
        // Jika data dengan ID yang diberikan tidak ada, buat data baru dengan 'ID' dan 'Stat' = 1
        $sqlInsert = 'INSERT INTO statusled (ID, Stat) VALUES (?, 1)';
        $qInsert = $pdo->prepare($sqlInsert);
        $qInsert->execute(array($id));
        $response = array('status' => 'success', 'message' => 'New entry created with Stat set to 1.');
    }

    Database::disconnect();
} else {
    $response = array('status' => 'error', 'message' => 'No ID provided.');
}

// Mengembalikan respons sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
 