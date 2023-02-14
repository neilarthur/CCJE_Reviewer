<?php 
session_start();
require_once '../php/conn.php';

$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id='{$_SESSION['acc_id']}'");

while ($row =mysqli_fetch_assoc($acc)) {
    if ($row['section']=='4C') {

         $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4C') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4C')  ORDER BY notif_id DESC ");

         $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

         $count = mysqli_num_rows($record);
         $counted = mysqli_num_rows($respo);
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
                            <div class='fw-bold fs-6'>No notifications  yet</div>
                            <p class='small text-gray-500' >When you get notifications, <br>they'll show up here</p>

                        </div>
                    </a>";
         }
       while ($raw = mysqli_fetch_assoc($record)) { ?>
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
                <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                <span class="f6">
                    <?php

                    if ($raw['gender'] == 'Male') {
                        
                         echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                    }
                    elseif($raw['gender']== 'Female') {

                        echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                    }
                    ?>
                </span>
            </div>
        </a>
<?php } ?> 

<?php   
while ($raw = mysqli_fetch_assoc($respo)) { ?>
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
                <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                <span class="f6">
                    <?php

                    if ($raw['gender'] == 'Male') {
                        
                         echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    elseif($raw['gender']== 'Female') {

                        echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    ?>
                </span>
            </div>
        </a>
 <?php }       

    }elseif ($row['section']=='4B') {
        
        $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4B') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4B') ORDER BY notif_id DESC ");

         $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

        $count = mysqli_num_rows($record);
         $counted = mysqli_num_rows($respo);
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
                            <div class='fw-bold fs-6'>No notifications  yet</div>
                            <p class='small text-gray-500' >When you get notifications, <br>they'll show up here</p>

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
                    <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                    <span class="f6">
                        <?php

                        if ($raw['gender'] == 'Male') {
                            
                             echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                        }
                        elseif($raw['gender']== 'Female') {

                             echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                        }
                        ?>
                    </span>
                </div>
            </a>
        <?php } 
        while ($raw = mysqli_fetch_assoc($respo)) { ?>
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
                <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                <span class="f6">
                    <?php

                    if ($raw['gender'] == 'Male') {
                        
                         echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    elseif($raw['gender']== 'Female') {

                        echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    ?>
                </span>
            </div>
        </a> 
   <?php }

    }elseif ($row['section']=='4A') {
           $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4A') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4A') ORDER BY notif_id DESC ");

           $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

         $count = mysqli_num_rows($record);
         $counted = mysqli_num_rows($respo);
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
                            <div class='fw-bold fs-6'>No notifications  yet</div>
                            <p class='small text-gray-500' >When you get notifications, <br>they'll show up here</p>

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
                    <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                    <span class="f6">
                        <?php

                        if ($raw['gender'] == 'Male') {
                            
                             echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                        }
                        elseif($raw['gender']== 'Female') {

                             echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['action'].".</small>";
                        }
                        ?>
                    </span>
                </div>
            </a>
    <?php
    while ($raw = mysqli_fetch_assoc($respo)) { ?>
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
                <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($raw['date_created'])); ?></div>
                <span class="f6">
                    <?php

                    if ($raw['gender'] == 'Male') {
                        
                         echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    elseif($raw['gender']== 'Female') {

                        echo " <small class='fw-bold'>Ma'am ".$raw['first_name']." ".$raw['last_name']." </small><small>".$raw['response_sender'].".</small>";
                    }
                    ?>
                </span>
            </div>
        </a> 
    <?php }

         }

    }
}
?>
