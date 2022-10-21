<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='student') {
    header("location: ../php/index.php");
    exit;
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Preboard Examination</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- Exam timer-->
	<link rel="stylesheet" type="text/css" href="../TimeCircles-master/inc/TimeCircles.css">
</head>
<body style="background-color: rgb(229, 229, 229);">
<!-- Main Content -->
<div class="container py-4">
	<div class="row">
		<div class="col-lg-12 align-self-center">
			<div class="card mt-3" style="background-color: #8C0000;">
				<div class="card-body">
					<h2 class="text-white fw-bold text-uppercase">Area of Examination: Criminal Jurisprudence</h2>
				</div>
			</div>
		</div>
	</div>
	<form action="check_exam.php" id="form2" method="POST">
		<div class="row">
			<div class="row-justify-content-end">
				<div class="col-lg-12">
					<div class="card mt-3">
						<div class="card-body mx-auto">
							<?php

							$code = $_GET['code'];

							$said = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE access_code='$code'");

							$bench = mysqli_fetch_assoc($said);
							?>
							<div id="exam_timer" data-timer="<?php echo $bench['time_limit']; ?>" style="width: 100%; height :150px; "></div>
						</div>
					</div>
				</div>
			</div>

			<div id="get_data"></div>
		</div>
		

		<!-- submit button -->
		<input type="submit" value="submit" class="btn btn-success mx-5 d-flex text-uppercase btn-lg">
	</form>
</div>
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="../TimeCircles-master/inc/TimeCircles.js"></script>
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
  
  $('#exam_timer').TimeCircles({
    time:{
      Days:{
        show:false
      } 
    }
  });

  setInterval(function(){

    var remaining_second = $('#exam_timer').TimeCircles().getTime();
    if (remaining_second < 1) 
    {
      clearTimeout(tm);
      document.getElementById('form2').submit();
    }

    var tm = setTimeout(function(){setInterval()},1000)
  },2000);


</script>

<script type="text/javascript">
	function fetch_data(page){
		$.ajax({
			url: "pagination.php?code=<?php echo $_GET['code']; ?>&acc_id=<?php echo $_GET['acc_id']; ?>",
			method: "POST",
			data:{
				page:page
			},
			success:function(data){
				$("#get_data").html(data);

			}
		});
	}

	fetch_data();

	$(document).on("click",".page-item",function(){
		var page = $(this).attr("id");
		fetch_data(page);
	})
</script>
</html>