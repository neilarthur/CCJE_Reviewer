<!-- Bootstrap CSS -->
<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">

<?php


require_once 'conn.php';

$userid =  $_POST['userid'];

$view = mysqli_query($sqlcon, "SELECT * FROM test_question WHERE question_id = '$userid'");

while ($rows = mysqli_fetch_assoc($view)) { ?>

	<h4 class="d-flex ps-1 fw-bold justify-content-start">Question:</h4>
		<textarea type="text" name="last_name" class="form-control mt-3 ps-2 mb-3 bg-white" rows="3" readonly=""><?php echo $rows['questions_title']; ?></textarea> 
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option A</label>
				<textarea type="text" name="option_a" class="form-control " rows="2" readonly= ""><?php echo $rows['option_a']; ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count: <span class="fw-bold">15</span> (50%)</p>
						<div class="progress"  style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option B</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $rows['option_b']; ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count:  <span class="fw-bold">15</span> (15%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 15%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option C</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $rows['option_c']; ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count:  <span class="fw-bold">15</span> (25%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option D</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $rows['option_d']; ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count: <span class="fw-bold">15</span> (10%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 10%"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php } ?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>