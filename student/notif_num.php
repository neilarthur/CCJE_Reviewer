<?php
session_start();
require_once '../php/conn.php';

$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id='{$_SESSION['acc_id']}'");

while ($raw =mysqli_fetch_array($acc)) {
	if ($raw['section']=='4C') {

		$notif = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,choose_question,accounts  WHERE notif_status='0'AND (tbl_notification.action='posted a quiz')  AND (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4C') AND(tbl_notification.test_id = choose_question.test_id) AND (tbl_notification.section_notif='4C') AND (stat_question='Ready')  ORDER BY notif_id DESC");
		

		$count = mysqli_num_rows($notif);

		while ($row = mysqli_fetch_array($notif)) { ?>
			<span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; ?></span>

		<?php }

	}elseif ($raw['section']=='4B') {
			$notif = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,choose_question,accounts  WHERE notif_status='0'AND (tbl_notification.action='posted a quiz')  AND (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4B')  AND (tbl_notification.section_notif='4B') AND (stat_question='Ready')  ORDER BY notif_id DESC");

		$count = mysqli_num_rows($notif);

		while ($row = mysqli_fetch_array($notif)) { ?>
			<span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; ?></span>
	<?php	}
	}
	elseif ($raw['section']=='4A') {
		$notif = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,choose_question,accounts  WHERE notif_status='0'AND (tbl_notification.action='posted a quiz')  AND (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4A')  AND (tbl_notification.section_notif='4A') AND (stat_question='Ready')  ORDER BY notif_id DESC");

		$count = mysqli_num_rows($notif);

		while ($row = mysqli_fetch_array($notif)) { ?>
			<span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; ?></span>
		<?php }
	}
}

?>