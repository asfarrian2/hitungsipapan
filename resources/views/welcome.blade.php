<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Hitung SIPAPAN</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Fitur SIPAPAN Perhitungan PAP" name="keywords">
        <meta content="Cek dan Hitung Pajak Air Permukaan Perusahaan Anda Secara Otomatis Disini" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="/wp/lib/animate/animate.min.css" rel="stylesheet">
        <link href="/wp/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="/wp/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/wp/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/wp/css/style.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="/wp/img/logoutama.png">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-warning" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-fluid header position-relative overflow-hidden p-0">
            <nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.html" class="navbar-brand p-0">
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                    <img src="/wp/img/logoutama.png" height="10000px" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.html" class="nav-item nav-link">HOME</a>
                    </div>
                    <!-- <a href="#" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a> -->
                    <button id="myBtn" class="btn btn-warning rounded-pill text-white py-2 px-4">MASUK</button>
                </div>
            </nav>
 <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Silahkan Login</h4>
        <button type="button" class="btn-close close" data-bs-dismiss="modal"></button>
      </div>
      <form action="/proses_login_wp" method="post">
      @csrf
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" required="required" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
            <input type="password" name="password" class="form-control" required="required" id="message-text"></input>
          </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">LOGIN</button>
      </div>
      </form>
    </div>
  </div>
</div>
            <div class="hero-header overflow-hidden px-5">
                <div class="rotate-img">
                    <img src="/wp/img/sty-1.png" class="img-fluid w-100" alt="">
                    <div class="rotate-sty-2"></div>
                </div>
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">HITUNG SIPAPAN</h1>
                        <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">Cek dan Hitung Pajak Air Permukaan Perusahaan Anda Secara Otomatis Disini</p>
                        <a href="/auth_wp" class="btn btn-warning rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">HITUNG PAP SEKARANG</a>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <img src="/wp/img/hero-img-1.png" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
            </div>
            <!-- Hero Header End -->
        </div>
        <!-- Navbar & Hero End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-white"><i class="fas fa-copyright text-light me-2"></i>2024 BAPENDA PROVINSI KALIMANTAN SELATAN</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a> -->


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/wp/lib/wow/wow.min.js"></script>
    <script src="/wp/lib/easing/easing.min.js"></script>
    <script src="/wp/lib/waypoints/waypoints.min.js"></script>
    <script src="/wp/lib/counterup/counterup.min.js"></script>
    <script src="/wp/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/wp/lib/lightbox/js/lightbox.min.js"></script>
    <!-- Template Javascript -->
    <script src="/wp/js/main.js"></script>

    <script>
        // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

    </script>

    </body>

</html>
