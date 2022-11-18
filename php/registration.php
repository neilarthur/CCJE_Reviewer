<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/registration.css">

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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
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
	<div class="container-fluid py-2">
	    <div class="row justify-content-center">
	        <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2 bg-white">
	            <div class="card px-0 pt-4 pb-0 mt-3 mb-3 m-2">
	                <h2 id="heading">Sign Up Your User Account</h2>
	                <p>Fill all form field to go to next step</p>
	                <form id="msform" action="function_registration.php" method="POST" enctype="multipart/form-data">
	                    <!-- progressbar -->
	                    <ul id="progressbar">
	                        <li class="active" id="account" style="color: #8C0000;"><strong>Account</strong></li>
	                        <li id="personal" style="color: #8C0000;"><strong>Personal</strong></li>
	                        <li id="payment" style="color: #8C0000;"><strong>Image</strong></li>
	                        <li id="confirm" style="color: #8C0000;"><strong>Finish</strong></li>

	                    </ul>
	                    <div class="progress">
	                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	                    </div> <br> <!-- fieldsets -->
	                    <fieldset>
	                        <div class="form-card">
	                            <div class="row">
	                                <div class="col-7">
	                                    <h2 class="fs-title">Account Information:</h2>


	                                </div>
	                                <div class="col-5">
	                                    <h2 class="steps">Step 1 - 4</h2>
	                                </div>
	                            </div> 
	                            <label class="fieldlabels ms-2">Email Address:</label> 
	                            <input type="email" name="email_ad" placeholder="Email address" />
	                            <label class="fieldlabels ms-2">ID No:</label>
	                            <input type="number" name="u_name" placeholder="019***" />
	                            <label class="fieldlabels ms-2">Password:</label> 
	                            <input type="password" name="pass_word" placeholder="Password" />
	                            <label class="fieldlabels ms-2">Confirm Password:</label>
	                            <input type="password" name="conf_pass" placeholder="Confirm Password" />
	                        </div>
	                        <input type="button" name="next" class="next action-button btn-btn rounded" value="Next" />
	                    </fieldset>
	                    <fieldset>
	                        <div class="form-card">
	                            <div class="row">
	                                <div class="col-7">
	                                    <h2 class="fs-title">Personal Information:</h2>
	                                </div>
	                                <div class="col-5">
	                                    <h2 class="steps">Step 2 - 4</h2>
	                                </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col-sm-4">
	                            		<label class="fieldlabels ms-2">First Name:</label>
	                                    <input type="text" name="f_name" placeholder="First Name"  class="form-control" />
	                            	</div>
	                            	<div class="col-sm-4">
	                            		<label class="fieldlabels ms-2">Middle Name:</label>
	                                    <input type="text" name="m_name" placeholder="Middle Name" class="form-control" />
	                            	</div>
	                            	<div class="col-sm-4">
	                            		 <label class="fieldlabels ms-2">Last Name: </label>
	                                     <input type="text" name="l_name" placeholder="Last Name"  class="form-control" /> 
	                            	</div>
	                            </div>
	                            <div class="row">
	                            	<div class="col-sm-5">
	                            		<label class="fieldlabels ms-2">Age</label>
	                            	 	<div class="input-group">
	                            	 		 <input type="number" name="age" class="form-control" placeholder="Age" >
	                            	 	</div>
	                            	</div>
	                            	<div class="col-sm-5">
	                            		<label class="fieldlabels ms-2">Date of Birth</label>
	                            	 	<div class="input-group">
	                            	 		 <input type="date" name="date_birth" class="form-control" placeholder="Birthdate" >
	                            	 	</div>
	                            	</div>
	                            </div>
	                            <div class="row">
		                            <div class="col-sm-4">
	                            	 	<label class="fieldlabels ms-2">Role</label>
		                            	 <div class="form-group">
			                            	<select class="form-select" required="" name="role" value="">
			                            		<option selected value="studnet">Student</option>
			                            		<option value="faculty">Faculty</option>
			                            	</select>
										</div>
		                            </div>
		                            <div class="col-sm-4">
		                            	<label class="fieldlabels ms-2">Year & Section:</label>
		                            	<div class="input-group">
		                            		<select class="form-select  custom-select" required="" name="section" value="">
			                            		<option selected value=""></option>
			                            		<option value="4A">4A</option>
			                            		<option value="4B">4B</option>
			                            		<option value="4C">4C</option>
			                            	</select>
										</div>
		                            </div>
		                            <div class="col-sm-4">
		                            	 <label class="fieldlabels ms-2">Gender</label>
		                            	 <div class="form-group">
			                            	<select class="form-select" required="" name="gender" value="">
			                            		<option selected value=""></option>
			                            		<option value="Male">Male</option>
			                            		<option value="Female">Female</option>
			                            	</select>
										</div>
		                            </div>
	                            </div>
	                            <label class="fieldlabels ms-2 mt-3">Contact No:</label>
	                            <input type="number" name="contact_no" placeholder="09***********" />
	                            <label class="fieldlabels ms-2" >Address</label>
	                            <textarea type="text" name="address" rows="2" class="form-control"></textarea>
	                        </div> 
	                        <input type="button" name="next" class="next action-button btn-btn rounded" value="Next" /> <input type="button" name="previous" class="previous action-button-previous rounded" value="Previous" />
	                    </fieldset>
	                    <fieldset>
	                        <div class="form-card">
	                            <div class="row">
	                                <div class="col-7">
	                                    <h2 class="fs-title">Image Upload:</h2>
	                                </div>
	                                <div class="col-5">
	                                    <h2 class="steps">Step 3 - 4</h2>
	                                </div>
	                            </div>
	                            <label class="fieldlabels ms-2">Upload Your Photo:</label>
	                            <input type="file" name="image" class="form-control" id="reg_img" required="" accept=".jpg, .jpeg, .png">
	                            <img src="../assets/pics/tempo.png" id="img_up" alt="preview" class="img-fluid img-thumbnail rounded-circle mb-2">
	                        </div>
	                         <input type="submit" name="register" class="next action-button btn-btn rounded" value="Next" /> <input type="button" name="previous" class="previous action-button-previous rounded" value="Previous" />
	                    </fieldset>
	                   	<fieldset>
	                        <div class="form-card">
	                            <div class="row">
	                                <div class="col-7">
	                                    <h2 class="fs-title">Finish:</h2>
	                                </div>
	                                <div class="col-5">
	                                    <h2 class="steps">Step 4 - 4</h2>
	                                </div>
	                            </div> <br><br>
	                            
	                            <div class="row justify-content-center">
	                                <div class="col-3"> <i class="fas fa-check-circle ms-3 fa-6x" style="color: #8C0000;"></i> </div>
	                            </div> <br><br>
	                            <div class="row justify-content-center">
	                                <div class="col-7 text-center">
	                                    
	                                    <?php

	                                    if (isset($_SESSION['status'])) {
	                                    	
	                                    	echo "<h5 class='purple-text text-center'>".$_SESSION['status']."</h5>";
	                                    	unset($_SESSION['status']);
	                                    }
	                                    ?>
	                                </div>
	                            </div>
	                        </div>
	                    </fieldset>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>




</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
	reg_img.onchange = evt => {
		const [file] = reg_img.files;
		if (file) {
			img_up.src = URL.createObjectURL(file);

		}
	}
</script>


<script type="text/javascript">
	$(document).ready(function(){

		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
		var current = 1;
		var steps = $("fieldset").length;

		setProgressBar(current);

		$(".next").click(function(){

		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		//Add Class Active
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		//show the next fieldset
		next_fs.show();
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
		step: function(now) {
		// for making fielset appear animation
		opacity = 1 - now;

		current_fs.css({
		'display': 'none',
		'position': 'relative'
		});
		next_fs.css({'opacity': opacity});
		},
		duration: 500
		});
		setProgressBar(++current);
		});

		$(".previous").click(function(){

		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

		//Remove class active
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

		//show the previous fieldset
		previous_fs.show();

		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
		step: function(now) {
		// for making fielset appear animation
		opacity = 1 - now;

		current_fs.css({
		'display': 'none',
		'position': 'relative'
		});
		previous_fs.css({'opacity': opacity});
		},
		duration: 500
		});
		setProgressBar(--current);
		});

		function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
		.css("width",percent+"%")
		}

		$(".submit").click(function(){
		return false;
		})

});
</script>
</html>