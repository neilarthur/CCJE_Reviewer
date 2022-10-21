<?php

session_start();

include'../php/conn.php';

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {

	$acc_id = $_POST['acc_id'];
	$status = "active";
	$fileName = $_FILES['import_file']['name'];
	$file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

	$allowed_ext = ['xls','csv','xlsx'];

	if (in_array($file_ext, $allowed_ext)) {
		
		$inputFileNamePath = $_FILES['import_file']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = "0";

		foreach ($data as $row) {
			
			if ($count >= 0) {
				
				$subject_name=$row['0'];
				$level_difficulty=$row['1'];
				$questions_title=$row['2'];
				$option_a=$row['3'];
				$option_b=$row['4'];
				$option_c=$row['5'];
				$option_d=$row['6'];
				$correct_ans=$row['7'];

				$studentQuery = "INSERT INTO test_question (subject_name,level_difficulty,questions_title,option_a,option_b,option_c,option_d,correct_ans,acc_id,status) VALUES ('$subject_name','$level_difficulty','$questions_title','$option_a','$option_b','$option_c','$option_d','$correct_ans','$acc_id','$status')";

				$result = mysqli_query($sqlcon, $studentQuery);

				$msg = true;

			}
			else{

				$count = "1";
			}
		}
		if (isset($msg)) {

			$_SESSION['message'] = "";
            header('Location: testbank.php?importsuc');
            exit(0);
		}
		else{

			$_SESSION['message'] = "";
            header('Location: testbank.php?importfail');
            exit(0);
		}
	}
	else{

		$_SESSION['message'] = "";
        header('Location: testbank.php?importinvalid');
        exit(0);
	}
}

?>