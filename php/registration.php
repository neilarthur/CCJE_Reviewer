<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Albert+Sans&family=Fira+Sans&family=Inter:wght@200&family=Libre+Baskerville&family=Mingzat&family=Montserrat:ital,wght@0,400;0,500;1,400&family=Roboto+Condensed:ital,wght@0,700;1,400&family=Russo+One&family=Source+Sans+Pro&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
	<!-- Box Icons -->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- System Logo -->
	<link rel="icon" href="../assets/pics/system-ico.ico">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>


	<style type="text/css">

		.container .card{
		    height:580px;
		    width:1000px;
		    background-color:#fff;
		    position:relative;
		    box-shadow:0 15px 30px rgba(0,0,0,0.1);
		    font-family: 'Poppins', sans-serif;
		    border-radius:20px;
		}
		.container .card .form{
		    width:100%;
		    height:100%;
		    display:flex;
		}
		.container .card .left-side{
		    width:35%;
		    background-color:#8C0000;
		    height:100%;
		    border-top-left-radius:20px;
		    border-bottom-left-radius:20px;
		    padding:20px 30px;
		    box-sizing:border-box;

		}
		/*left-side-start*/
		.left-heading{
		    color:#fff;
		   
		}
		.steps-content{
		    margin-top:20px;
		    color:#fff;
		}
		.steps-content p{
		    font-size:12px;
		    margin-top:15px;
		}
		.progress-bar{
		    list-style:none;
		    /*color:#fff;*/
		    margin-top:30px;
		    font-size:13px;
		    font-weight:700;
		    counter-reset:container 0;
		}
		.progress-bar li{
		      position:relative;
		      margin-left:40px;
		      margin-top:50px;
		      counter-increment:container 1;
		      color:#ffffff;
		      font-size: 15px;
		}
		.progress-bar li::before{
		    content:counter(container);
		    line-height:25px;
		    text-align:center;
		    position:absolute;
		    height:25px;
		    width:25px;
		    border:1px solid #ffffff;
		    border-radius:50%;
		    left:-40px;
		    top:-5px;
		    z-index:10;
		    background-color:#8C0000;

		     
		}


		.progress-bar li::after{
		    content: '';
		    position: absolute;
		    height: 90px;
		    width: 2px;
		    background-color:
		    z-index: 1;
		    left: -27px;
		    top: -70px;
		    background-color: #C5C5C5;
		}


		.progress-bar li.active::after{
		    background-color: #fff;

		}

		.progress-bar li:first-child:after{
		  display:none;  
		}

		/*.progress-bar li:last-child:after{*/
		/*  display:none;  */
		/*}*/
		.progress-bar li.active::before{
		    color:#fff;
		    border:1px solid #fff;
		}
		.progress-bar li.active{
		    color:#fff;
		}
		.d-none{
		   display:none;   
		}

		/*left-side-end*/
		.container .card .right-side{
		    width:65%;
		    background-color:#fff;
		    height:100%;
		  border-radius:20px;
		}
		/*right-side-start*/
		.main{
		    display:none;
		}
		.active{
		    display:block;
		}
		.main{
		    padding:40px;
		}
		.main small{
		    display:flex;
		    justify-content:center;
		    align-items:center;
		    margin-top:2px;
		    height:30px;
		    width:30px;
		    background-color:#ccc;
		    border-radius:50%;
		    color:yellow;
		    font-size:19px;
		}
		.text{
		    margin-top:20px;
		}
		.congrats{
		    text-align:center;
		}
		.text p{
		    margin-top:10px;
		    font-size:13px;
		    font-weight:700;
		    color:#cbced4;
		}
		.input-text{
		    margin:30px 0;
		     display:flex;
		    gap:20px;
		}

		.input-text .input-div{
		    width:100%;
		    position:relative;
		    
		}



		input[type="text"]{
		    width:100%;
		    height:40px;
		    border:none;
		    outline:0;
		    border-radius:5px;
		    border:1px solid #cbced4;
		    gap:20px;
		    box-sizing:border-box;
		    padding:0px 10px;
		}
		input[type="file"]{
		    width:100%;
		    height:40px;
		    border:none;
		    outline:0;
		    border-radius:5px;
		    border:1px solid #cbced4;
		    gap:20px;
		    box-sizing:border-box;
		    padding:0px 10px;
		}
		input[type="number"]{
		    width:100%;
		    height:40px;
		    border:none;
		    outline:0;
		    border-radius:5px;
		    border:1px solid #cbced4;
		    gap:20px;
		    box-sizing:border-box;
		    padding:0px 10px;
		}
		input[type="password"]{
		    width:100%;
		    height:40px;
		    border:none;
		    outline:0;
		    border-radius:5px;
		    border:1px solid #cbced4;
		    gap:20px;
		    box-sizing:border-box;
		    padding:0px 10px;
		}
		select{
		    width:100%;
		    height:40px;
		    border:none;
		    outline:0;
		    border-radius:5px;
		    gap:20px;
		    box-sizing:border-box;
		    padding:0px 10px;
		}
		.input-text .input-div span{
		    position:absolute;
		    top:10px;
		    left:10px;
		    font-size:20px;
		    transition:all 0.5s;
		}
		.input-div input:focus ~ span,.input-div input:valid ~ span  {
		    top:-15px;
		    left:6px;
		    font-size:20px;
		    font-weight:600; 
		}

		.input-div span{
		    top:-15px;
		    left:6px;
		    font-size:20px;
		}
		.buttons button{
		    height:40px;
		    width:100px;
		    border:none;
		    border-radius:5px;
		    background-color:#8C0000;
		    font-size:15px;
		    font-weight: bold;
		    color:#fff;
		    cursor:pointer;
		}
		.button_space{
		    display:flex;
		    gap:20px;
		    
		}
		.button_space button:nth-child(1){
		    background-color:#fff;
		    color:#000;
		    border:1px solid#000;
		}
		.user_card{
		    margin-top:20px;
		    margin-bottom:40px;
		    height:200px;
		    width:100%;
		    border:1px solid #c7d3d9;
		    border-radius:10px;
		    display:flex;
		    overflow:hidden;
		    position:relative;
		    box-sizing:border-box;
		}
		.user_card span{
		    height:80px;
		    width:100%;
		    background-color:#dfeeff;
		}
		.circle{
		    position:absolute;
		    top:40px;
		    left:60px;
		}
		.circle span{
		    height:70px;
		    width:70px;
		    background-color:#fff;
		    display:flex;
		    justify-content:center;
		    align-items:center;
		    border:2px solid #fff;
		    border-radius:50%;
		}
		.circle span img{
		    width:100%;
		    height:100%;
		    border-radius:50%;
		    object-fit:cover;
		}
		.social{
		    display:flex;
		    position:absolute;
		    top:100px;
		    right:10px;
		}
		.social span{
		    height:30px;
		    width:30px;
		    border-radius:7px;
		    background-color:#fff;
		    border:1px solid #cbd6dc;
		    display:flex;
		    justify-content:center;
		    align-items:center;
		    margin-left:10px;
		    color:#cbd6dc;

		}
		.social span i{
		        cursor:pointer;
		}
		.heart{
		    color:red !important;
		}
		.share{
		        color:red !important;
		}
		.user_name{
		    position:absolute;
		    top:110px;
		    margin:10px;
		    padding:0 30px;
		    display:flex;
		    flex-direction:column;
		    width:100%;
		    
		} 
		.user_name h3{
		    color:#4c5b68;
		}
		.detail{
		    /*margin-top:10px;*/
		   display:flex;
		   justify-content:space-between;
		   margin-right:50px;
		}
		.detail p{
		    font-size:12px;
		    font-weight:700;

		}
		.detail p a{
		    text-decoration:none;
		    color:blue;
		}


		.checkmark__circle {
		  stroke-dasharray: 166;
		  stroke-dashoffset: 166;
		  stroke-width: 2;
		  stroke-miterlimit: 10;
		  stroke: #7ac142;
		  fill: none;
		  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
		}

		.checkmark {
		  width: 56px;
		  height: 56px;
		  border-radius: 50%;
		  display: block;
		  stroke-width: 2;
		  stroke: #fff;
		  stroke-miterlimit: 10;
		  margin: 10% auto;
		  box-shadow: inset 0px 0px 0px #7ac142;
		  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
		}

		.checkmark__check {
		  transform-origin: 50% 50%;
		  stroke-dasharray: 48;
		  stroke-dashoffset: 48;
		  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
		}

		@keyframes stroke {
		  100% {
		    stroke-dashoffset: 0;
		  }
		}
		@keyframes scale {
		  0%, 100% {
		    transform: none;
		  }
		  50% {
		    transform: scale3d(1.1, 1.1, 1);
		  }
		}
		@keyframes fill {
		  100% {
		    box-shadow: inset 0px 0px 0px 30px #7ac142;
		  }
		}

		.warning{
		    border:1px solid red !important;
		}


		/*right-side-end*/
		@media (max-width:750px) {
		    .container{
		        height:scroll;
		       
		        
		    }
		    .container .card {
		        max-width: 350px;
		        height:auto !important;
		        margin:30px 0;
		    }
		    .container .card .right-side {
		     width:100%;
		            
		    }
		     .input-text{
		         display:block;
		     }
		     
		     .input-text .input-div{
		  margin-top:20px;
		    
		}

		    .container .card .left-side {
		           
		     display: none;
		    }
		}
	</style>
</head>
<body  style="background-color: #f5f5f5;">
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
				<div class="d-grid gap-2 d-md-auto justify-content-md-end me-4 ">
					<a class="btn text-white text-capitalize" href="index.php" style="background-color: #8C0000;">Log In<i class="fas fa-sign-in-alt ms-1"></i></a>
				</div>
			</div>
		</div>
	</nav>
	<div class="container d-flex justify-content-center py-3">
		<div class="card">
			<form class="form" action="function_registration.php" method="POST"  enctype="multipart/form-data">
				<div class="left-side">
					<div class="left-heading">
						<h3>Registration</h3>
					</div>
					<div class="steps-content">
						<h3>Step <span class="step-number">1</span></h3>
	                    <p class="step-number-content active"></p>
	                    <p class="step-number-content d-none"></p>
	                    <p class="step-number-content d-none"></p>
	                    <p class="step-number-content d-none"></p>
	                </div>
	                <ul class="progress-bar">
	                	<li class="active">Personal Information</li>
	                	<li>Account Information</li>
	                	<li>Image</li>
	                	<li>Finish</li>
	                </ul>
	            </div>
	            <div class="right-side">
	            	<div class="main active">
	            		<div class="text">
	            			<h2 class="fw-bold" style="color: #8C0000;">Your Personal Information</h2>
	            		</div>
	            		<div class="input-text">
	            			<div class="row">
	            				<div class="col-sm-4">
	            					<div class="input-div">
	            						<label class="fieldlabels ms-2">First name</label>
	            						<input type="text" required require name="f_name"  id="user_name" placeholder="First Name" class="text-capitalize">
	            					</div>
	            				</div>
	            				<div class="col-sm-4">
	            					<div class="input-div">
	            						<label class="fieldlabels ms-2">Middle name</label> 
			                            <input type="text" require required name="m_name" placeholder="Middle Name" class="text-capitalize">
			                        </div>
	            				</div>
	            				<div class="col-sm-4">
	            					<div class="input-div">
	            						<label class="fieldlabels ms-2">Last name</label>
			                            <input type="text" required require name="l_name" placeholder="Last Name" class="text-capitalize">
			                        </div>
	            				</div>
	            			</div>
	            		</div>
	                    <div class="input-text">
	                    	<div class="input-div">
	                        	<label class="fieldlabels ms-2">Year & Section:</label>
	                            <select class="form-select  custom-select" required require name="section" value="">
	                        		<option selected value=""></option>
	                        		<option value="4A">4A</option>
	                        		<option value="4B">4B</option>
	                        		<option value="4C">4C</option>
	                        	</select>
	                        </div>
	                        <div class="input-div">
	                            <label class="fieldlabels ms-2">Gender</label>
	                        	 <div class="form-group">
	                            	<select class="form-select" required require name="gender" value="">
	                            		<option selected value=""></option>
	                            		<option value="Male">Male</option>
	                            		<option value="Female">Female</option>
	                            	</select>
								</div>
	                        </div>
	                        <div class="input-div">
	                        	<label class="fieldlabels ms-2">Mobile number</label>
	                            <input type="number" required require placeholder="09*********" name="contact_no">
	                        </div>
	                    </div>
	                    <div class="input-text">
	                         <div class="input-div">
	                            <label class="fieldlabels ms-2">Date of Birth</label>
	                        	 <div class="form-group">
	                        	 	<input type="date" name="date_birth" required require class="form-control">
								</div>
	                        </div>
	                        <div class="input-div">
	                            <label class="fieldlabels ms-2">Age</label>
	                        	 <div class="form-group">
	                        	 	<input type="number" name="age" required require>
								</div>
	                        </div>
	                    </div>
	                    <div class="input-text">
	                    	<div class="input-div">
	                    		<label class="fieldlabels ms-2" >Address</label>
	                            <textarea type="text" rows="2" name="address" class="form-control" require></textarea>
	                    	</div>
	                    </div>
	                    <div class="buttons d-flex justify-content-end">
	                        <button class="next_button">Next</button>
	                    </div>
                	</div>
                	<div class="main">
                		<div class="text">
                			<h2 class="fw-bold" style="color: #8C0000;">Account Information</h2>
                		</div>
	                    <div class="input-text">
	                        <div class="input-div">
	                        	<label class="fieldlabels ms-2">Email Address</label>
	                            <input type="text" required require name="email_ad" placeholder="User.e12@gmail.com">
	                        </div>
	                    </div>
	                    <div class="input-text">
	                        <div class="input-div">
	                        	<label class="fieldlabels ms-2">ID Number:</label>
	                            <input type="number" required require placeholder="019*****" name="u_name">
	                        </div>
	                    </div>
                        <div class="input-div">
                            <label class="fieldlabels ms-2">Password</label>
                            <div class="input-group">
                            	<input type="password" required require name="pass_word" id="id_password" class="form-control">
                            	<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></span>
                            </div>
                        </div>
                        <div class="input-div mt-4">
                            <label class="fieldlabels ms-2">Confirm Password</label>
                            <div class="input-group">
                            	<input type="password" required require name="conf_pass" id="confirm_password" class="form-control">
                            	<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePass" style="margin-left: -30px; cursor: pointer;"></i></span>
                            </div>
                        </div>
	                   
	                    <div class="buttons button_space mt-4">
	                        <button class="back_button">Back</button>
	                        <button class="next_button">Next</button>
	                    </div>
	                </div>
	                <div class="main">
	                	<div class="text">
                        <h2 class="fw-bold" style="color: #8C0000;">Image Upload</h2>
                    </div>
                    <div class="mb-5 mt-3">
                    	<div class="d-flex justify-content-center">
                    		<img src="../assets/pics/tempo.png" id="img" alt="preview" class="rounded-circle mb-2 text-center" width="250px;" height="250px;">
                    	</div>
                    	<label class="fieldlabels ms-2 fs-5 d-flex justify-content-center">Upload your Photo:</label>
                    	<div class="col-sm-8 mx-auto mt-3">
                    		<input type="file" name="image" id="fileimg" require required="" accept=".jpg, .jpeg, .png">
                    	</div>
                    </div>
                    <div class="buttons button_space">
                        <button class="back_button">Back</button>
                        <button type="submit" class="next_button" name="register">Submit</button>
                    </div>
                 </div>
                 <div class="main">
                     <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                         <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                    <div class="text congrats">
                        <h2>Congratulations!</h2>
                        <p class="fs-5"> Mr./Mrs <span class="shown_name"></span> your account has succefully created.</p>
                    </div>
                 </div>
              </div>
          </form>
      </div>
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
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	

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
<script type="text/javascript">
	fileimg.onchange = evt => {
		const [file] = fileimg.files;
		if (file) {
			img.src = URL.createObjectURL(file);

		}
	}
</script>
<script type="text/javascript">
	const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script type="text/javascript">
  const togglePass = document.querySelector('#togglePass');
  const pass = document.querySelector('#confirm_password');

  togglePass.addEventListener('click', function (e) {
    // toggle the type attribute
    const set = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', set);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script type="text/javascript">
	var next_click=document.querySelectorAll(".next_button");
var main_form=document.querySelectorAll(".main");
var step_list = document.querySelectorAll(".progress-bar li");
var num = document.querySelector(".step-number");
let formnumber=0;

next_click.forEach(function(next_click_form){
    next_click_form.addEventListener('click',function(){
        if(!validateform()){
            return false
        }
       formnumber++;
       updateform();
       progress_forward();
       contentchange();
    });
}); 

var back_click=document.querySelectorAll(".back_button");
back_click.forEach(function(back_click_form){
    back_click_form.addEventListener('click',function(){
       formnumber--;
       updateform();
       progress_backward();
       contentchange();
    });
});

var username=document.querySelector("#user_name");
var shownname=document.querySelector(".shown_name");
 

var submit_click=document.querySelectorAll(".submit_button");
submit_click.forEach(function(submit_click_form){
    submit_click_form.addEventListener('click',function(){
       shownname.innerHTML= username.value;
       formnumber++;
       updateform(); 
    });
});

var heart=document.querySelector(".fa-heart");
heart.addEventListener('click',function(){
   heart.classList.toggle('heart');
});


var share=document.querySelector(".fa-share-alt");
share.addEventListener('click',function(){
   share.classList.toggle('share');
});

 

function updateform(){
    main_form.forEach(function(mainform_number){
        mainform_number.classList.remove('active');
    })
    main_form[formnumber].classList.add('active');
} 
 
function progress_forward(){
    // step_list.forEach(list => {
        
    //     list.classList.remove('active');
         
    // }); 
    
     
    num.innerHTML = formnumber+1;
    step_list[formnumber].classList.add('active');
}  

function progress_backward(){
    var form_num = formnumber+1;
    step_list[form_num].classList.remove('active');
    num.innerHTML = form_num;
} 
 
var step_num_content=document.querySelectorAll(".step-number-content");

 function contentchange(){
     step_num_content.forEach(function(content){
        content.classList.remove('active'); 
        content.classList.add('d-none');
     }); 
     step_num_content[formnumber].classList.add('active');
 } 
 
 
function validateform(){
    validate=true;
    var validate_inputs=document.querySelectorAll(".main.active input");
    validate_inputs.forEach(function(vaildate_input){
        vaildate_input.classList.remove('warning');
        if(vaildate_input.hasAttribute('require')){
            if(vaildate_input.value.length==0){
                validate=false;
                vaildate_input.classList.add('warning');
            }
        }
    });
    return validate;

    validate=true;
    var validate_inputs=document.querySelectorAll(".main.active textarea");
    validate_inputs.forEach(function(vaildate_input){
        vaildate_input.classList.remove('warning');
        if(vaildate_input.hasAttribute('require')){
            if(vaildate_input.value.length==0){
                validate=false;
                vaildate_input.classList.add('warning');
            }
        }
    });
    return validate;
}
</script>

<?php 
#add accounts
if (isset($_GET['registersucc'])) {
	echo ' <script> swal("Registration completed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/registration.php");
	</script>';
}
elseif (isset($_GET['adderror'])) {
	echo ' <script> swal("Registration has failed!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/registration.php");
	</script>';
}
elseif (isset($_GET['passerror'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/registration.php");
	</script>';
}
?> 

</html>