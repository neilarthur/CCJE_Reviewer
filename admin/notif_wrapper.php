<?php
require_once '../php/conn.php';
$record = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty')");

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
                    
                    echo " <small class='fw-bold'>Sir ".$raw['first_name']." ".$raw['last_name']." </small> <small>".$raw['action']."</small>";
                }
                elseif($raw['gender']== 'Female') {

                    echo " Ma'am ".$raw['first_name']." ".$raw['last_name']." ".$raw['action'].".";
                }
                ?>
            </span>
        </div>
    </a>
<?php }
 ?>