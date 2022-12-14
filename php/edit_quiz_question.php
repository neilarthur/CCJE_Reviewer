<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='faculty') {
    header("location: ../php/index.php");
    exit;
}

$sup_run = "SELECT DISTINCT subject_name, question_id FROM test_question order by question_id asc";

$resulted = mysqli_query($sqlcon, $sup_run);

$supp = "<select class='form-control mb-3' name='subjects' id='laid'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($resulted)) {
    $supp .= "<option value=".$crow['question_id'].">".$crow['subject_name']."</option>";
  }

$supp .= "</select>";

$lay_run = "SELECT DISTINCT level_difficulty, question_id FROM test_question order by question_id asc";

$results = mysqli_query($sqlcon, $lay_run);

$suppd = "<select class='form-control mb-3' name='level_difficulty'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($results)) {
    $suppd .= "<option value='".$crow['question_id']."'>".$crow['level_difficulty']."</option>";
  }

$suppd .= "</select>";

?>

<!--- eto value='".$crow['question_id']."' sa line 22 -->
<!DOCTYPE html>
<html>
<head>
	<title>Test Form</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- Bootstrap CSS -->
	<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
	<style>
       .dp .dropdown-toggle::after {
            content: none;
        }
    </style>
</head>
<body style="background-color: rgb(229, 229, 229);">
	<div class="sidebar close">
		<div class="logo-details">
			<i class="fas fa-fingerprint"></i><span class="logo_name">CCJE Reviewer</span>
		</div>
		<hr style="color:rgb(255, 255, 255);">
		<ul class="nav-links fw-bolder">
			<li class="navigation-list-item">
				<a href="../faculty/dashboard.php">
					<i class="fas fa-tachometer-alt"></i>
					<span class="link_name">Dashboard</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/dashboard.php">Dashboard</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/testbank.php">
					<i class="fas fa-list-ol"></i>
					<span class="link_name">Test Bank</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/testbank.php">Test Bank</a></li>
				</ul>
			</li>
			<li>
			<li class="navigation-list-item">
				<a href="../faculty/testyourself.php">
					<i class="fas fa-sticky-note"></i>
					<span class="link_name">Manage Test</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/testyourself.php">Manage Test</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/preboard.php">
					<i class="fas fa-list-alt"></i>
					<span class="link_name">Pre-Board Examination</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/preboard.php">Pre-Board Examination</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/examresults.php">
					<i class="fas fa-poll"></i>
					<span class="link_name">Exam Results</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/examresults.php">Exam Results</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/accounts_manage.php">
					<i class='bx bxs-user-account bx-sm' ></i>
					<span class="link_name">Accounts</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/accounts_manage.php">Accounts</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/log-history.php">
					<i class="fas fa-history"></i>
					<span class="link_name">Log History</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/log-history.php">Logs History</a></li>
				</ul>
			</li>
			<li class="navigation-list">
				<div class="profile-details">
					 <?php

                      $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                      while ($rows = mysqli_fetch_assoc($query_row)) { 
                      	echo ' 
                     	<div class="profile-content">
                     	   <img class="rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" alt="profileImg">
					    </div>';

                      	?>
					   
						<?php }

                        ?>
						<div class="name-job">
							<div class="profile_name"><a class="profile text-warning"href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
							<div class="job"><?php echo $_SESSION["role"];?></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<section class="home-section float-start" >
			<div class="home-content d-flex justify-content-between" style="background: white;">
				<button style="border-style: none; background: white;">
					<i class='bx bx-menu' ></i>
				</button>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                        <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger">1</span>
		                    </a>
		                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
		                          <h6 class="dropdown-header text-dark ">Notifications</h6>
		                          <a class="dropdown-item d-flex align-items-center" href="#">
		                              <div class="me-4">
		                                   <div class="fa-stack fa-1x">
		                                    <i class="fa fa-circle fa-stack-2x ms-2"></i>
		                                    <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
		                                  </div> 
		                              </div>
		                              <div class="fw-bold">
		                                  <div class="small text-gray-500">September 16, 2022</div>
		                                  <span class="font-weight-bold">Sir pagcaliwagan added an exam</span>
		                              </div>
		                          </a>
		                          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
		                      </div>
		                </div>
		                <div class="dropdown me-3">
		                    <button class="btn  dropdown-toggle border border-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		                    <?php

		                        $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
		                         while ($rows = mysqli_fetch_assoc($query_row)) {
		                      echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"></span>';
		                      ?>
		                   <?php }

		                    ?>
		                    </button>
		                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		                        <li><a class="dropdown-item" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
		                        <li><a class="dropdown-item" href="#"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
		                        <li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
		                    </ul>
		                </div>
		            </form>
		        </div>
				<!-- Main Content-->
				<div class="col py-3 overflow-auto">
					<div class="container-fluid ">
						<form action="function.php" method="POST" onsubmit="return validate_question()">
							<div class="row">
								<div class="col-lg-3 ">
									<div class="card">
										<div class="card-body">
										<h4 class="fw-bold mb-3 text-uppercase" >Test Information</h4>
											<div class="mb-3">
												<label  class="form-label">Subject Exam</label>
												<div class="form-group">

													<select class="form-select" name="subjects" id="subjects">
														<option selected value="Criminal Jurisprudence">Criminal Jurisprudence</option>
														<option value="Law Enforcement">Law Enforcement</option>
														<option value="Criminalistics">Criminalistics</option>
														<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
														<option value="Criminal Sociology">Criminal Sociology</option>
														<option value="Correctional Administration">Correctional Administration</option>
													</select>
												</div>
											</div>
											<!--- filter -->
											<div class="mb-3">
												<label class="form-label">Level of Difficulty</label>
												<div class="input-group">
													<select class="form-control custom-select mb-3  difficult" name="difficult" id="difficult">
														<option selected value="Easy">Easy</option>
														<option  value="Moderate">Moderate</option>
														<option value="Hard">Hard</option>
													</select>
													<input type="hidden" name="hidden_exam" id="hidden_exam" />
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">Number of Questions</label>
												<div class="input-group">
													<select class="form-select" name="t_question" id="total_questions" disabled>

													<?php
													$sig = mysqli_query($sqlcon,"SELECT * FROM choose_question");

													while ($row = mysqli_fetch_assoc($sig)) {
													 	
													 	$sow = $row['total_quest'];	
													 	$tow = $row['question_prev'];
													 	$total = $sow - $tow; ?>

													 <option selected=""><?php echo $total; ?></option>

													<?php
													 } 
													?>

													</select>
													<span class="input-group-text">Out of</span>
													<select class="form-select" name="t_question" id="total_questions" disabled>

														<?php 
														$tot = mysqli_query($sqlcon,"SELECT * FROM choose_question");

														while ($sid = mysqli_fetch_assoc($tot)) {

														 ?>
															<option selected=""><?php echo $sid["total_quest"] ?></option>
													
														<?php
														}
													    ?>
														
													</select>
												</div>
											</div>
											<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="card">
										<div class="card-body">
											<h4 class="fw-bold text-uppercase mb-3">Question's</h4>
											<div class="d-grid gap-2 d-md-flex justify-content-md-end ">

												<button type="submit" name="create" class="btn btn-success px-3 pb-2 text-white"><i class="fas fa-save me-2"></i>Save Changes</button>
												<button class="btn btn-secondary px-3 pb-2 text-white backbtn"><i class="fas fa-times me-2"></i>Cancel</button> 

												<input type="hidden" name="test" value="<?php echo $_GET['id']; ?>">
											</div>
											<hr>
											<div id="fetchs" class="table-responsive" >
												<table class="align-middle mb-0 table table-borderless table-light table-hover" id="student">
												    <thead>
												      <tr>
												      	<th scope="col" hidden="">No#</th>
												        <th scope="col">Select</th>
												        <th scope="col">Subjects</th>
												        <th scope="col">Difficulty</th>
												        <th scope="col">Question</th>
												        <th scope="col">Correct Answer</th>
												        
												      </tr>
												    </thead>
												    <tbody>
												      <?php 

												     
												      $Slow = mysqli_query($sqlcon,"SELECT * FROM test_question");
												      while ($row = mysqli_fetch_assoc($Slow)) {

												        $_SESSION['exam'] = $row['question_id']; ?>
												      <tr>
												       <td hidden=""><?php echo $row['question_id']?></td>

												       <td><input type="checkbox" class="checkbox" name="chkl[]" id="question_id<?php echo $row['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $row['question_id']; ?>"></td>
												       <td><?php echo $row['subject_name'] ?> </td>
												       <td><?php echo $row['level_difficulty'] ?></td>
												       <td>
												       	  <b><?php echo $row['questions_title'] ?></b><br>
												       	  <span class="pl-4 text-success ms-4">A. <?php echo $row['option_a'] ?></span><br>
												       	  <span class="pl-4 text-success ms-4">B. <?php echo $row["option_b"] ?></span><br>
												       	  <span class="pl-4 text-success ms-4">C. <?php echo $row["option_c"] ?></span><br>
												       	  <span class="pl-4 text-success ms-4">D. <?php echo $row["option_d"] ?></span><br>
												       </td>
												       <td class="text-success fw-bold"><?php echo $row["correct_ans"] ?></td>
												     </tr>

												   <?php } ?>
												    </tbody>
											  </table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<!-- Logout Modal-->
		    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header border-0">
		                    <h5 class="modal-title"></h5>
		                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		                </div>
		                <div class="modal-body align-items-center">
		                    <h5 class="fw-bold"><i class="fas fa-exclamation-triangle alert alert-danger me-2"></i>Do you really wish to leave or log out?</h5>
		                </div>
		                <div class="modal-footer border-0">
		                    <form action="../php/logout_faculty.php" class="hide" method="POST">
		                    	<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
								<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
								<div>
									<button type="submit" class="btn btn-success">YES</button>
									<button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">NO</button>
								</div>
							</form>
		                </div>
		            </div>
		        </div>
		    </div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#student').DataTable({
			paging: true
		});
	});
</script>



<script>
let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
</script>

<script type="text/javascript">

  // var of select input difficult

  // var of select input subject


 
  $('select').on('change', function() {
    var name = this.name;
    var difficult;
    var subjects;

       // alert(  name);



       if (name=="difficult") {
          difficult = this.value;
          subjects = $("#subjects").val();
       }else if (name=="subjects") {
          difficult =$("#difficult").val();
          subjects =  this.value;

       }else{
        return false;
       }
      

      $.ajax({    //create an ajax request to load_page.php
      type:"POST",
      url: "fetchhub.php",             
      dataType: "text",   //expect html to be returned  
      data:{difficult:difficult,subjects:subjects},               
      success: function(data){     
      $("#fetchs").hide();    
      $("#fetchs").fadeIn();             
      $("#fetchs").html(data); 
        // alert(data);

      }

      });


  });

</script>
<script type="text/javascript">
$(".backbtn").on("click", function(e){
  e.preventDefault();
  window.history.back();
});

</script>

<!--end -->
</html>