<?php
date_default_timezone_set('Asia/Jakarta');
require_once "apps/config.php";

$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);

$created = "";
$uid = "";
$nama = "";
$division = "";
$alamat = "";
$saldo = "";

$created_err = "";
$uid_err = "";
$nama_err = "";
$division_err = "";
$alamat_err = "";
$topup_err = "";
$saldo_err = "";

// Fungsi untuk format Rupiah
function formatRupiah($number)
{
    return 'Rp ' . number_format($number, 0, ',', '.');
}

// Check if UID is already in the database
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['uid'])) {
    $uid = trim($_GET['uid']);

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

    $stmt = $pdo->prepare("SELECT nama, division, alamat, saldo FROM data_karyawan WHERE uid = :uid");
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();

    if ($row = $stmt->fetch()) {
        $nama = $row["nama"];
        $division = $row["division"];
        $alamat = $row["alamat"];
        $saldo = $row["saldo"];
    } else {
        echo '<script language="javascript" type="text/javascript"> 
                alert("Silahkan registrasi dulu");
                window.location.replace("register.php");
              </script>';
        exit();
    }
    unset($stmt);
    unset($pdo);
}

// Update saldo if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = trim($_POST["uid"]);
    $topup = trim($_POST["topup"]);

    if ($topup < 5000) {
        $topup_err = "Top up minimum adalah 5000";
    } else {
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

        // Ambil saldo lama
        $stmt = $pdo->prepare("SELECT saldo FROM data_karyawan WHERE uid = :uid");
        $stmt->bindParam(':uid', $uid);
        $stmt->execute();
        $row = $stmt->fetch();
        $saldo_lama = $row['saldo'];

        // Hitung saldo baru
        $new_saldo = $saldo_lama + $topup;

        // Update saldo di database
        $stmt = $pdo->prepare("UPDATE data_karyawan SET saldo = :saldo WHERE uid = :uid");
        $stmt->bindParam(':saldo', $new_saldo);
        $stmt->bindParam(':uid', $uid);

        if ($stmt->execute()) {
            echo '<script language="javascript" type="text/javascript"> 
                    alert("Saldo berhasil diupdate");
                    window.location.replace("index.php");
                  </script>';
            exit();
        } else {
            echo "Gagal memperbarui saldo";
        }

        unset($stmt);
        unset($pdo);
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
    <title>Warebox - Top Up Saldo</title>
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
                            window.location.href = window.location.pathname + "?uid=" + data;
                        }
                    }
                });
            }, 1000);
        });

        function showModal() {
            var topupAmount = $('input[name="topup"]').val();
            $('#modalTopupAmount').text(topupAmount);
            $('#confirmModal').modal('show');
        }

        function confirmTopUp() {
            $('#topupForm').submit();
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow m-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top Up Saldo</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form id="topupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" placeholder="Belum ada card" readonly>
                            <span class="help-block text-danger"><?php echo $nama_err; ?></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="uid">UID</label>
                                <input type="text" name="uid" id="getUID" class="form-control" value="<?php echo $uid; ?>" placeholder="Tap Card Anda" readonly>
                                <span class="help-block text-danger"><?php echo $uid_err; ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="division">Jenis Kelamin</label>
                                <input type="text" name="division" class="form-control" value="<?php echo $division; ?>" readonly>
                                <span class="help-block text-danger"><?php echo $division_err; ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Belum ada card" readonly><?php echo $alamat; ?></textarea>
                            <span class="help-block text-danger"><?php echo $alamat_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="saldo">Saldo Sekarang</label>
                            <?php
                            if (!empty($uid)) {
                                // Jika UID tidak kosong, tampilkan saldo
                            ?>
                                <input type="text" name="saldo" class="form-control" value="<?php echo formatRupiah($saldo); ?>" readonly>
                            <?php } else {
                                // Jika UID kosong, tampilkan pesan default
                            ?>
                                <input type="text" name="saldo" class="form-control" value="Belum ada card yang ditap" readonly>
                            <?php } ?>
                            <span class="help-block text-danger"><?php echo $saldo_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="topup">Jumlah Top Up <small>(Minimum Top Up Rp. 5000)</small></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="topup" class="form-control" placeholder="Masukkan Jumlah Top Up" min="5000" required>
                            </div>
                            <span class="help-block text-danger"><?php echo $topup_err; ?></span>
                        </div>

                        <hr>
                        <div class="row justify-content-end">
                            <button type="button" class="btn btn-success" onclick="showModal()">Top Up</button> &nbsp;
                            <a href="index.php" class="btn btn-primary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="confirmModalLabel">Pembayaran Top Up Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-3">Silahkan lakukan pembayaran melalui dompet digital Anda</p>
                    <div class="bg-success text-white rounded-10 px-4 py-2" style="font-size: 24px;">
                        <strong id="modalTopupAmount">Rp. <span id="formattedSaldo">0</span></strong>
                    </div>
                    <div class="mt-5">
                        <img src="assets/images/qris.PNG" alt="QR Code" style="max-width: 250px;">
                    </div>
                    <p class="mt-3">Setelah melakukan pembayaran, tekan tombol di bawah untuk konfirmasi</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-lg btn-success py-3 px-5 rounded-pill" onclick="confirmTopUp()">Konfirmasi Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to format saldo into currency format
        function formatRupiah(amount) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            return formatter.format(amount);
        }

        // Update modalTopupAmount with formatted saldo
        var saldo = <?php echo $saldo; ?>;
        document.getElementById('formattedSaldo').innerText = formatRupiah(saldo);
    </script>


    <script src="src/vendor/jquery/jquery.min.js"></script>
    <script src="src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/sb-admin-2.min.js"></script>
</body>

</html>