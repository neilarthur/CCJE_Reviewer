<?php
require_once '../php/conn.php';

$record = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty') AND (tbl_notification.action='added an exam') ");

if (mysqli_num_rows($record) == )0 {
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