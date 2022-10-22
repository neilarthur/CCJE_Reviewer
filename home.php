 <!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!-- Boostrap 5.2 -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Albert+Sans&family=Fira+Sans&family=Inter:wght@200&family=Libre+Baskerville&family=Mingzat&family=Montserrat:ital,wght@0,400;0,500;1,400&family=Roboto+Condensed:ital,wght@0,700;1,400&family=Russo+One&family=Source+Sans+Pro&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
	<!-- Box Icons -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- System Logo -->
  <link rel="icon" href="assets/pics/ico.ico">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>

</head>
<body style="background-color: #f5f5f5;">
   <div class="header text-uppercase hd " >
    <div class="container-fluid py-3">
       <img src="assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2" >
       <h3 class="text-white mt-3 ms-4" >Automated Licensure Examination Reviewer </h3>
       <span class="text-white dep">College of Criminal Justice and Education</span>
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
						<a class="nav-link" aria-current="page" href="home.php">Home</a>
					</li>
          <li class="nav-item dropdown justify-content-start">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Criminology
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="php/crim.php">BS Criminology</a></li>
              <li><a class="dropdown-item" href="php/college.php">College</a></li>  
            </ul>
          </li>
					<li class="nav-item">
						<a class="nav-link " href="php/about.php">About Us</a>
					</li>
				</ul>
				<div class="d-grid gap-2 d-md-auto justify-content-md-end me-4 ">
					<a class="btn text-white text-capitalize" href="php/index.php" style="background-color: #8C0000;">Log In<i class="fas fa-sign-in-alt ms-1"></i></a>
				</div>
			</div>
		</div>
	</nav>
	<!-- Carousel -->

    <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
      <div class="carousel-inner ">
        <div class="carousel-item active" data-bs-interval="3000">
          <img src="assets/pics/1.jpg" class="d-block w-100  " alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
          <img src="assets/pics/depart.jpg" class="d-flex w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
          <img src="assets/pics/1.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span aria-hidden="true"><i class="fas fa-chevron-circle-left fa-3x"></i></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span caria-hidden="true"><i class="fas fa-chevron-circle-right fa-3x"></i></span>
      </button>
    </div>

	

	<!-- LSPU Policy-->
	<div class="con container-fluid mt-5 mb-5 ">
		<div class="row">
			<div class="col-md-4 ">
        <div class="card shadow">
          <div class="card-body mb-5">
            <h2 class=" title text-center fw-bold text-uppercase">Mission</h2>
            <p class="mt-3 lh-base">LSPU provides quality education through responsive instruction,
            distinctive research, and sustainable extension and production services for improved 
            quality of life towards nation building.</p>
          </div>
        </div>
			</div>
			<div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h2 class=" title text-center fw-bold text-uppercase">Quality Policy</h2>
            <p class="mt-3 lh-base">LSPU delivers quality education through responsive 
            instruction, distinctive research,sustainable extension, and production services. Thus,
            we are committed with continual improvement to meet applicable requirements to provide 
            quality, efficient, and effective services to the university stakeholders&#39; highest 
            level of satisfaction through an excellent management system imbued with utmost integrity,
            professionalism and innovation.</p>
          </div>
        </div>
			</div>
			<div class="col-md-4">
        <div class="card shadow">
          <div class="card-body ">
            <h2 class=" title text-center fw-bold text-uppercase">Vision</h2>
            <p class="mt-3 lh-base ">The Laguna State Polytechnic University is a center of sustainable development transforming lives and communities.</p>
          </div>
        </div>
			</div>
		</div>
	</div>

  <div class="container co">
      <div class="row mb-5">
        <div class="col-md-6">
          <div class="card p-3 shadow h-100 ">
            <div class="card-body  " >
              <div class="text-center">
                <img class="img-fluid center" alt="" id="picture" src="assets/pics/univ.png "width="500" height="500"/>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card d-flex cd shadow h-100">
            <div class="card-body">
              <h2><b>Univeristy Profile</b></h2>
              <p  class="lh-lg mb-5 fs-5">
                The Laguna State Polytechnic University (LSPU; Filipino: Pambansang 
                Pamantasang Politekniko ng Laguna) is a state university in the Province
                of Laguna, Philippines, with four regular campuses and several auxiliary 
                sites. It is currently classified as SUC Level III (CHED Memorandum Order 12,
                series of 2018).
              </p>
            </div>
          </div>
        </div>
      </div>
	</div>

	<!-- Footer -->
  <footer class="text-center text-lg-start text-white ft">
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
<script src="js/bootstrap.bundle.min.js"></script>
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
</html>