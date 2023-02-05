<?php

require_once 'conn.php';


$userid =  $_POST['userid']; 

$say =  "SELECT * FROM accounts WHERE acc_id= '$userid'";

$results = mysqli_query($sqlcon, $say);

while ($row = mysqli_fetch_array($results)) {

	echo '
	<div class="container">
	<form class="form" method="post" action="../php/updateaccount.php"  enctype="multipart/form-data">
		<div class="col">
			<div class="row">
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
					
					

					<img src="data:image;base64,'.base64_encode($row["image_size"]).'" id="imgs" name="type" class=" rounded-circle flex justify-content-start" height="200px" width="200px" style=" object-fit: cover;"> 
					<input type="file" name="image" class="form-control mt-2" id="file_name" accept=".jpg, .jpeg, .png">
					<label for="image_browser" class="d-flex justify-content-center ps-1 mt-2 fw-bold">Attach Picture</label>'

					?>
				</div>
				<div class="col-xl-7 col-lg-6 col-md-6 col-sm-6 py-2">
					<input type="hidden" class="form-control" name="update_id" value="<?php echo $row['acc_id'] ?>">
					<label for="user-last" class="d-flex ps-1 justify-content-center fw-bold">Last Name</label>
					<input type="text" name="last_name" class="form-control text-center"value="<?php echo $row['last_name']; ?>">

					<label for="user-first" class="d-flex ps-1 justify-content-center fw-bold">First Name</label>
					<input type="text" name="first_name" class="form-control text-center" value="<?php echo $row['first_name']; ?>">

					<label for="user-middle" class="d-flex  ps-1 justify-content-center fw-bold">Middle Name</label>
					<input type="text" name="mid_name"  class="form-control text-center" value="<?php echo $row['middle_name']; ?>">
				</div>
				<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
					<label for="user-id" class="d-flex ps-1 fw-bold">Role</label>
					<input type="text" name="role" value="<?php echo $row['role']; ?>" class="form-control" readonly >
				</div>
				<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
					<label for="user-id" class="d-flex ps-1 fw-bold">ID number:</label>
					<input type="number" name="user_id" value="<?php echo $row['user_id']; ?>" class="form-control">
				</div>
				<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
					<label for="user-bday" class="d-flex ps-1 fw-bold">Birthdate</label>
					<input type="date" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>" >

				</div>
				<div class="col-xl-3 col-lg-6 col-md-12 col-sm-6 py-2">
					<label for="user-sex" class="d-flex ps-1 fw-bold">Gender</label>
					<div class="input-group">
						<select class="form-select" required="" name="gender">
							<option selected><?php echo $row['gender']; ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>
				<div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 py-2">
					<label for="user-age" class="d-flex ps-5 fw-bold">Age</label>
					<input type="number" name="age" class="form-control ps-5" value="<?php echo $row['age']; ?>">
				</div>
				<div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 py-2">
					<label for="user-section" class="d-flex ps-1 fw-bold">Assign Section</label>
					<input type="text" name="section" class="form-control" value="<?php echo $row['section']; ?>">
				</div>
				<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
					<label for="user-mobile" class="d-flex  ps-1 fw-bold">Mobile Number</label>
					<input type="number" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
					<!--empty -->
					<label for="user-email" class="d-flex ps-1 fw-bold">Email Address</label>
					<input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" class="form-control">
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
					<label for="user-add" class="d-flex ps-1 fw-bold">Address</label>
					<textarea class="form-control" name="address" rows="1"><?php echo $row['address']; ?></textarea>
				</div>
			</div>
			<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
				<label for="user-password" class="d-flex ps-1 fw-bold">Current Password</label>
				<div  class="input-group">
					<input type="password" name="c_password" class="form-control" id="Current_password" value="<?php echo $row['password']; ?>">
					<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="toggle" style="margin-left: -30px; cursor: pointer;"></i></span>
				</div>
			</div>
			<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
				<label for="user-password" class="d-flex ps-1 fw-bold">New Password</label>
				<div class="input-group">
					<input type="password" name="new_password" class="form-control" id="Password"  value="">
					<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></span>
				</div>
			</div>
			<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
				<label for="user-password" class="d-flex ps-1 fw-bold">Confirm Password</label>
				<div class="input-group">
					<input type="password" name="conf_password" class="form-control"  id="ConfirmPassword" value="">
					<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePass" style="margin-left: -30px; cursor: pointer;"></i></span>
					</div>
			</div>
			<div style="margin-top: 7px;" id="CheckPasswordMatch" class="fw-bold mb-2 ms-3"></div>
		</div>
		<div class="modal-footer border-0 d-flex justify-content-center mt-4">
			<?php 
			if ($row['role']=='students') {
				echo'<input type="hidden" name="type" value="student">';
			}
			elseif ($row['role']=='faculty') {
				echo'<input type="hidden" name="type" value="faculty">';
			}
			?>
			<button type="submit" name="save" class="btn btn-success px-4 pb-2 text-white" ><i class="fas fa-save me-1"></i> Save Changes</button>
			<button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Close</button>
		</div>
	</form>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script type="text/javascript">
 	file_name.onchange = evt => {
 		const [file] = file_name.files;
 		if (file) {
 			imgs.src = URL.createObjectURL(file);

 		}
 	}
 </script>
 <script>
$(document).ready(function () {
	$("#ConfirmPassword").on('keyup', function(){
		var password = $("#Password").val();
		var confirmPassword = $("#ConfirmPassword").val();
		if (password == confirmPassword) {
			$("#CheckPasswordMatch").html("Password match!").css("color","green");
		}
		else if (password != confirmPassword){
			$("#CheckPasswordMatch").html("Password does not match!").css("color","red");
		}
		else if (  confirmPassword == " "){
			$("#CheckPasswordMatch").html("!").css("color","red");
		}
		else if ( password == "") {
			$("#CheckPasswordMatch").html("!").css("color","red");
		}
		else {
			return false;
		}
	});
});
</script>
<script type="text/javascript">
	const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#Password');

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
  const pass = document.querySelector('#ConfirmPassword');

  togglePass.addEventListener('click', function (e) {
    // toggle the type attribute
    const set = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', set);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script type="text/javascript">
  const toggle = document.querySelector('#toggle');
  const c_password = document.querySelector('#Current_password');

  toggle.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = c_password.getAttribute('type') === 'password' ? 'text' : 'password';
    c_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>

<?php } ?>