<?php

require_once'../php/conn.php';


require('../fpdf184/fpdf.php');



$pdf = new FPDF('P','mm','A4');

$pdf -> AddPage();

#ADD FONT 
$pdf->AddFont('OldEnglishTextMT','','OLDENGL.php');
$pdf->AddFont('BellMT','','Bell MT.php');

# header title
$pdf ->setFont('BellMT','',12);
$pdf ->Cell(190 ,7, ' Republic of the Philippines ',0,1,'C');

$pdf ->Image('../assets/pics/logo.png',30,10,-230);

$pdf ->setFont('OldEnglishTextMT','',16);
$pdf ->Cell(190 ,7, 'Laguna State Polytechnic University',0,1,'C');

$pdf ->setFont('BellMT','',12);
$pdf ->Cell(190 ,7, ' Sta Cruz, Laguna ',0,1,'C');

#end title

#CONTENT
$pdf ->setFont('Arial','B',14);
$pdf ->Cell(190 ,50, 'PREBOARD EXAMINATION RESULTS',100,100,'C');

$accounts_result3 = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question,accounts WHERE (tbl_pre_question.prepared_by =accounts.acc_id) AND (tbl_pre_question.pre_exam_id = '{$_GET['id']}')");

$area = mysqli_fetch_assoc($accounts_result3);

$pdf ->setFont('Arial','U',10);
$pdf ->Cell(190 ,10, 'AREA OF EXAMINATION :'.' '.$area['subjects'],100,100,'L');

$pdf ->setFont('Arial','U',10);
$pdf ->Cell(190 ,-10, 'Section: 4B',100,100,'C');

$pdf ->setFont('Arial','U',10);
$date = date('F j, Y');
$pdf ->Cell(180 ,10,' DATE : '.$date,100,1,'R');

$pdf ->setFont('Arial','B',10);
$pdf ->SetFillColor(224, 235, 255);
$pdf ->Cell(20,7,"ID",1,0,'C',true);
$pdf ->Cell(60,7,"FULL NAME",1,0,'C',true);
$pdf ->Cell(20,7,"SECTION",1,0,'C',true);
$pdf ->Cell(20,7,"NO.ITEMS",1,0,'C',true);
$pdf ->Cell(20,7,"SCORE",1,0,'C',true);
$pdf ->Cell(27,7,"PERCENTAGE",1,0,'C',true);
$pdf ->Cell(20,7,"REMARKS",1,1,'C',true);


$accounts_result = "SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_exam_result.pre_exam_id = '{$_GET['id']}') AND (accounts.section='4B') ORDER BY accounts.last_name ASC";

$accounts_result_query = mysqli_query($sqlcon,$accounts_result);


while ($rows = mysqli_fetch_assoc($accounts_result_query)) {


    $pdf->SetTextColor(0,0,0);
    $pdf ->setFont('Arial','',10);
    $pdf ->cell(20,7,$rows['user_id'],1,0,'C');
    $pdf ->setFont('Arial','',10);
    $pdf ->cell(60,7,$rows['last_name'].', '.$rows['first_name'].' '.$rows['middle_name'].'.',1,0,'C');
    $pdf ->cell(20,7,$rows['section'],1,0,'C');
    $pdf ->cell(20,7,$rows['attempt'],1,0,'C');
    $pdf ->cell(20,7,$rows['score'],1,0,'C');
    $pdf ->cell(27,7,$rows['score_percent'].' % ',1,0,'C');

   
    if ($rows['result']=='failed') {
        $pdf->SetTextColor(194,8,8);
        $pdf ->cell(20,7,$rows['result'],1,1,'C');
    }
    elseif ($rows['result']=='passed') {
         $pdf->SetTextColor(124,252,0);
        $pdf ->cell(20,7,$rows['result'],1,1,'C');
    }
}

$pdf->SetTextColor(0,0,0);
$pdf ->setFont('Arial','B',12);
$pdf ->Cell(165,30, 'Prepared By:',100,50,'R');
$accounts_result2 = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question,accounts WHERE (tbl_pre_question.prepared_by =accounts.acc_id) AND (tbl_pre_question.pre_exam_id = '{$_GET['id']}')");

$lows = mysqli_fetch_assoc($accounts_result2);
$pdf ->setFont('Arial','U',12);
$pdf ->Cell(173 ,-10,$lows['first_name'].' '.$lows['middle_name'].' . '.$lows['last_name'],100,100,'R');
$pdf ->setFont('Arial','U',9);
$pdf ->Cell(165 ,25,$lows['role'].' '.'Instructor',100,100,'R');


$pdf ->Output();  

?>