<?php
// Start the session
session_start();

// Dummy saldo for demonstration
$saldo = 50000; // Example saldo, you should fetch this from your database or session

// Redirect to login if not logged in
if (!isset($_SESSION['alamat'])) {
  header("location: ../login.php");
  exit;
}

// Check if $_SESSION['nama'] is set, if not set a default value or handle accordingly
$welcome_message = "Selamat Datang";
if (isset($_SESSION['nama'])) {
  $welcome_message .= ", " . $_SESSION['nama'];
} else {
  $welcome_message .= ", Pengguna";
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

  <title>WareBox - Locker Digital</title>

  <!-- Custom fonts for this template-->
  <link href="../src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../src/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="../src/vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="../src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../src/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../src/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../src/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../src/js/demo/chart-area-demo.js"></script>
  <script src="../src/js/demo/chart-pie-demo.js"></script>

  <style>
    .modal-dialog-centered {
      display: flex;
      align-items: center;
    }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'partial_sidebar_user.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'partial_topbar_user.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Selamat Datang</h1>

            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">
            <!-- Locker Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div id="cardLocker1" class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Locker 1</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Booking Locker</div>
                    </div>
                    <div class="col-auto">
                      <i id="lockerIcon1" class="fas fa-lock fa-2x text-gray-300" onclick="showPaymentModal('Locker 1', 'cardLocker1')"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
              </div>
              <!-- Card Body -->
            </div>
          </div>

          <!-- Pie Chart -->

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
            </div>

            <div class="col-lg-6 mb-4">
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Warebox</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="confirmModalLabel">Pembayaran Loker Online</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p class="mb-3">Silahkan lakukan pembayaran melalui dompet digital Anda</p>
          <div class="bg-success text-white rounded-10 px-4 py-2" style="font-size: 24px;">
            <strong id="modalTopupAmount">Rp. 2000</strong>
          </div>
          <div class="mt-5">
            <img src="../assets/images/qris.PNG" alt="QR Code" style="max-width: 250px;">
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
    // Function to handle top up confirmation
    function confirmTopUp() {
      // Implement your logic here for top up confirmation
      alert('Pembayaran berhasil! Locker telah dibuka.');

      // Simulate updating server status (you should implement actual server-side logic here)
      // For demo purposes, we'll just update the locker status on the client side
      var lockerIcon = document.getElementById('lockerIcon1');
      var cardLocker = document.getElementById('cardLocker1');

      // Change icon and card border color
      lockerIcon.classList.remove('fa-lock');
      lockerIcon.classList.add('fa-unlock');
      cardLocker.classList.remove('border-left-warning');
      cardLocker.classList.add('border-left-success');

      // Change "Book Now" text to "Pasang Sandi Locker"
      var bookNowText = cardLocker.querySelector('.h5');
      bookNowText.textContent = 'Pasang Sandi Locker';

      // Navigate to the sandi.php page
      cardLocker.addEventListener('click', function() {
        window.location.href = 'online/input_pin.php';
      });

      // Hide the modal
      $('#confirmModal').modal('hide');
    }

    // Function to show payment modal and pass locker details
    function showPaymentModal(lockerName, cardId) {
      // Show the payment modal
      $('#confirmModal').modal('show');
    }
  </script>


</body>

</html>