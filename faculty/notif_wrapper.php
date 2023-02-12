<?php
session_start();
require_once '../php/conn.php';

 $record = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");

 $response = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND tbl_pre_question.prepared_by = '{$_SESSION['acc_id']}'");

while ($raw = mysqli_fetch_array($record)) { ?>
	<a class="dropdown-item d-flex align-items-center" href="notification.php">
		<div class="me-4">
            <?php
            $pic = $raw['image_size'];
            echo '<div class="fa-stack fa-1x">
                                    <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                    </div> ';
             ?>
			
        </div>
        <div class="">
            <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['created'])); ?></div>
            <span class="f6">
            	<?php

                if ($raw['gender'] == 'Male') {
                    
                    echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small> <small>".$raw['feedback']."</small>";
                }
                elseif($raw['gender']== 'Female') {

                    echo " Ma'am ".$raw['first_name']." ".$raw['last_name']." ".$raw['feedback'].".";
                }
                ?>
            </span>
        </div>
    </a>
<?php } ?>

<?php

while ($res= mysqli_fetch_array($response)) { ?>

<a class="dropdown-item d-flex align-items-center" href="notification.php">
        <div class="me-4">
            <?php
            $pic = $res['image_size'];
            echo '<div class="fa-stack fa-1x">
                                    <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                    </div> ';
             ?>
            
        </div>
        <div class="">
            <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($res['date_created'])); ?></div>
            <span class="f6">
                <?php

                if ($res['gender'] == 'Male') {
                    
                    echo " <small class='fw-bold'>Sir ".$res['first_name']." ".$res['last_name']." </small> <small>".$res['response_sender']."</small>";
                }
                elseif($res['gender']== 'Female') {

                    echo " Ma'am ".$res['first_name']." ".$res['last_name']." ".$res['response_sender'].".";
                }
                ?>
            </span>
        </div>
    </a>    
<?php }
 ?>