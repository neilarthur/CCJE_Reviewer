<?php

session_start();

require_once '../php/conn.php';


require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['export_excel_btn'])) {


	$file_ext_name = $_POST['file_type'];

	$fileName = "student-sheet";


	$accounts_result = "SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')";

	$accounts_result_query = mysqli_query($sqlcon,$accounts_result);

	if (mysqli_num_rows($accounts_result_query) > 0) {

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Full Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Score');
        $sheet->setCellValue('E1', 'Percentage');
        $sheet->setCellValue('F1', 'Result');

        $rowCount = 2;

        foreach ($accounts_result_query as $data) {

        	$sheet->setCellValue('A'.$rowCount, $data['user_id']);
            $sheet->setCellValue('B'.$rowCount, $data['first_name'].''.$data['last_name']);
            $sheet->setCellValue('C'.$rowCount, $data['email_address']);
            $sheet->setCellValue('D'.$rowCount, $data['score']);
            $sheet->setCellValue('E'.$rowCount, $data['score_percent']);
            $sheet->setCellValue('F'.$rowCount, $data['result']);
            $rowCount++;
        }

        $writer = new Xlsx($spreadsheet);
        $final_filename = $fileName.'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

	}
	else {

		echo mysqli_error($sqlcon);
	}
}
?>