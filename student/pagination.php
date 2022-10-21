<?php

include_once '../php/conn.php';


$limit = 5;

$page = 0;

$output = "";

if (isset($_POST['page'])) {

	$page = $_POST['page'];

}
else{

	$page = 1;
}

$start_from = ($page - 1) * $limit;


$number = $start_from + 1;

$burst = $_GET['acc_id'];

$code = $_GET['code'];

$query_limit = "SELECT * FROM tbl_pre_question,tbl_pre_choose_quest,test_question WHERE (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND (tbl_pre_question.access_code = '$code') AND (tbl_pre_choose_quest.question_id = test_question.question_id) LIMIT $start_from, $limit ";

$result_limit = mysqli_query($sqlcon,$query_limit);

while ($rows = mysqli_fetch_array($result_limit)) {

	$output.='
			<div class="col-lg-12">
				<div class="card mt-3">
					<div class="card-body table-reponsive">
						<table class="table table-borderless">
						<tbody class="fs-5">
							<tr>
								<th>
									<b><span class="fs-5">'.$number.'.'.$rows['questions_title'].'</span></b>
								</th>
							</tr>

							<tr>
								<td><span><input class="form-check-input pl-4 ms-5 my.checkbox " type="radio" name="examcheck['.$rows['question_id'].']" id="rd1" value="A"> A. '.$rows['option_a'].'</span></td>
							</tr>

							<tr>
								<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck['.$rows['question_id'].']" id="rd2" value="B"> B.'.$rows['option_b'].'</span></td>
							</tr>

							<tr>
								<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck['.$rows['question_id'].']" id="rd2" value="C"> C.'.$rows['option_c'].'</span></td>
							</tr>

							<tr>
								<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck['.$rows['question_id'].']" id="rd2" value="D"> D.'.$rows['option_d'].'</span></td>
							</tr>
						</tbody>

							<input type="hidden" name="pre_exam_id" value="'.$rows['pre_exam_id'].'">
							<input type="hidden" name="update_pre_question" value="'.$code.'">
							<input type="hidden" name="sub_acc_id" value="'.$burst.'">
							<input type="hidden" name="total_quest" value="'. $rows['total_question'].'">

					</table>
				</div>
			</div>
		</div>
	';

$number ++;
}

//Pagination Code

$query = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question,tbl_pre_choose_quest,test_question WHERE (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND (tbl_pre_question.access_code = '$code') AND (tbl_pre_choose_quest.question_id = test_question.question_id) ");

$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records / $limit);

$output .='<ul class="Pagination">';

if ($page > 1) {
	
	$previous = $page - 1;

	$output .='<li class="page-item" id="1"><span class="page-link">First Page</span></li>';

	$output .='<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

for ($i=0; $i <=$total_pages; $i++) { 

	$active_class = "";

	if ($i == $page) {
		
		$active_class = "active";
	}

	$output .='<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link">'.$i.'</span></li>';


}

if ($page < $total_pages) {

	$page ++;

	$output .='<li class="page-item" id="'.$page.'"><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>';

	$output .='<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
}

$output .='</ul>';

echo $output;

?>