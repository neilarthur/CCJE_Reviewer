<?php

session_start();

include_once 'conn.php'; 

if (isset($_SESSION["role"]) && $_SESSION["role"]=='admin') {
    header("location: ../admin/dashboard.php");

}
elseif (isset($_SESSION["role"]) && $_SESSION["role"]=='faculty') {
  header("location: ../faculty/dashboard.php");
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <!-- Boostrap 5.2 -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Albert+Sans&family=Fira+Sans&family=Inter:wght@200&family=Libre+Baskerville&family=Mingzat&family=Montserrat:ital,wght@0,400;0,500;1,400&family=Roboto+Condensed:ital,wght@0,700;1,400&family=Russo+One&family=Source+Sans+Pro&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- Box Icons -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- Font Awesome-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
  <!-- System Logo -->
  <link rel="icon" href="../assets/pics/system-ico.ico">
</head>
<body>
  <div class="header text-uppercase hd " >
    <div class="container-fluid py-3">
      <img src="../assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2" >
      <h3 class="text-white mt-3 ms-4" >Automated Licensure Examination Reviewer </h3>
      <span class="text-white text-center dep">College of Criminal Justice and Education</span>
    </div>
  </div>
  <nav id="navbar-top" class="navbar navbar-expand-lg navbar-light fw-bold text-uppercase">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-4" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-2">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../home.php">Home</a>
          </li>
          <li class="nav-item dropdown justify-content-start">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Criminology
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="crim.php">BS Criminology</a></li>
              <li><a class="dropdown-item" href="college.php">College</a></li>  
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="about.php">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Log In form -->
  <div class="login-form mt-3">    
    <form action="resend.php" method="post">
      <div class="avatar">
        <img src="../assets/pics/CCJE.png" alt="">
      </div>
      <h4 class="modal-title mt-3 fw-bold">User Account</h4>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
        <input type="text" name="email_address" class="form-control" placeholder="Enter email address" required="required" autocomplete="off">
      </div>
      <div class="d-grid gap-2 mt-5 ">
        <input type="submit" name="resend_email_btn" class="btn btn-primary btn-lg rounded-pill" value="Send">
      </div>
      <div class="form-group small clearfix fs-6 mt-3">
        <a href="registration.php" class="register">Don't have an account? </a>
      </div> 
    </form>
  </div>

  <!-- Footer -->
  <footer class="text-center text-lg-start text-white ft mt-3">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-between p-4" style="background-color: #8C0000;">
      <!-- Left -->
      <div class="me-5 ">
        <h5>Get connected with us on social networks:</h5>
      </div>
      <!-- Left -->
    </section>

    <!-- Section: Links  -->
    <section>
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">College of Criminal Justice and Education LSPU Santa Cruz Campus</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 90%; background-color: #7c4dff; height: 2px"/>
            <p>
              Here you can use the links and contacts to learn more about 
              the College of Criminal Justice and Education LSPU.
            </p>
          </div>
        
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Useful links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="https://www.facebook.com/groups/LSPU.CRIMINOLOGY.SCC.Official" class="text-white"><i class='bx-fw bx bxl-facebook-circle me-2'></i> Facebook: @LSPU CRIMINOLOGY SCC Official</a>
            </p>
            <p>
              <a href="#!" class="text-white"><p><i class="fas fa-envelope mr-3 me-2"></i>Email: marklito.repugia@lspu.edu.ph</a>
            </p>
          </div>
         
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3 me-2"></i>ccje.scc@lspu.edu.ph</p>
            <p><i class="fas fa-envelope mr-3 me-2"></i>marklito.repugia@lspu.edu.ph</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-3">
      © 2022 Copyright: College of Criminal Justice and Education LSPU Sta. Cruz Campus
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar-top').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar-top').classList.remove('fixed-top');
         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
}); 
</script>
 <?php 
#Login error
if (isset($_GET['loginerror'])) {
  echo ' <script> swal("Invalid Password!", " Try again", "error");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/index.php");
  </script>';
}
?>
</html>