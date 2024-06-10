<?php
date_default_timezone_set('Asia/Jakarta');
require_once "apps/config.php";

$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);

$created = "";
$uid = "";
$nama = "";
$division = "";
$mail = "";
$alamat = "";
$password = "";
$picture = "";

$created_err = "";
$uid_err = "";
$nama_err = "";
$division_err = "";
$mail_err = "";
$alamat_err = "";
$password_err = "";
$picture_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $created = date("Y-m-d");
    $uid = trim($_POST["uid"]);
    $nama = trim($_POST["nama"]);
    $division = trim($_POST["division"]);
    $mail = trim($_POST["mail"]);
    $alamat = trim($_POST["alamat"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $picture = "";

    $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try {
        $pdo = new PDO($dsn, $db_user, $db_password, $options);
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Something weird happened');
    }
    $stmt = $pdo->prepare("INSERT INTO data_karyawan (created,uid,nama,division,mail,alamat,password,picture) VALUES (?,?,?,?,?,?,?,?)");

    if ($stmt->execute([$created, $uid, $nama, $division, $mail, $alamat, $password, $picture])) {
        $stmt = null;
    } else {
        echo "Gagal mendaftarkan data";
    }

    $stmt = $pdo->prepare("DELETE FROM data_invalid WHERE uid = :uid");
    $stmt->bindParam(':uid', $uid);
    if ($stmt->execute()) {
        $stmt = null;
        echo '<script language="javascript" type="text/javascript"> 
                alert("Data berhasil ditambahkan atas nama ' . $nama . '");
                window.location.replace("apps/");
              </script>';
        exit();
    } else {
        echo "Gagal menghapus data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Warebox - Register</title>
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="src/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: 'getUID.php',
                    type: 'GET',
                    success: function(data) {
                        if (data !== '') {
                            $('input[name="uid"]').val(data);
                        }
                    }
                });
            }, 1000);
        });
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow m-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrasi</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" placeholder="Input Nama Anda" required>
                            <span class="help-block text-danger"><?php echo $nama_err; ?></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="uid">UID</label>
                                <input type="text" name="uid" id="getUID" class="form-control" value="<?php echo $uid; ?>" placeholder="Tap Card Anda" readonly>
                                <span class="help-block text-danger"><?php echo $uid_err; ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mail">Nomer Hp/Email</label>
                                <input type="text" name="mail" class="form-control" value="<?php echo $mail; ?>" placeholder="Input Nomer/Email" required>
                                <span class="help-block text-danger"><?php echo $mail_err; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Input Password Anda" required>
                            <span class="help-block text-danger"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="division">Jenis Kelamin</label>
                            <select class="form-control" name="division">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <span class="help-block text-danger"><?php echo $division_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Input Alamat Rumah"><?php echo $alamat; ?></textarea>
                            <span class="help-block text-danger"><?php echo $alamat_err; ?></span>
                        </div>
                        <hr>
                        <div class="row justify-content-end">
                            <input type="submit" class="btn btn-success" value="Simpan"> &nbsp;
                            <a href="index.php" class="btn btn-primary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="src/vendor/jquery/jquery.min.js"></script>
    <script src="src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/sb-admin-2.min.js"></script>
</body>

</html>