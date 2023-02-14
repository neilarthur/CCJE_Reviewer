<?php
session_start();
require_once '../php/conn.php';

 $record = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");

 $response = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND tbl_pre_question.prepared_by = '{$_SESSION['acc_id']}'  ORDER BY tbl_res_id_ad DESC");

  $count= mysqli_num_rows($record);
  $counted = mysqli_num_rows($response);
  $total_count= $count + $counted;

  if ($total_count == 0) {
    echo "<a class='dropdown-item d-flex align-items-center' >
            <div class='me-4'>
                 <div class='fa-stack fa-1x'>
                  <i class='fa fa-circle fa-stack-2x ms-2'></i>
                  <i class='fas fa-bell-slash fa-stack-1x ms-2 text-white'></i>
                </div> 
            </div>
            <div class=''>
                <div class='fw-bold h5 ms-4'>No notifications  yet</div>
                <p class='small text-gray-500' >When you get notifications, they'll show up here</p>
            </div>
        </a>";
    } 
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
                    
                    echo " <small class='fw-bold'>".$raw['first_name']." ".$raw['last_name']." </small> <small>has a message for you</small>";
                }
                elseif($raw['gender']== 'Female') {

                    echo "<small class='fw-bold'>".$raw['first_name']." ".$raw['last_name']." </small> <small>has a message for you</small>.";
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
                    
                    echo " <small class='fw-bold'>Sir ".$res['first_name']." ".$res['last_name']." </small> <small>provided a feedback</small>
                    <p><small>regarding on ".$res['subjects']." exam that you created</small></p>";
                    
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