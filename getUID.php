<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UIDresult = $_POST["UIDresult"];
        $Write = "<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
        file_put_contents('UIDContainer.php', $Write);
    }

    include 'UIDContainer.php';
?>
