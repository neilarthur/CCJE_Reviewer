<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='faculty') {
    header("location: ../php/index.php");
    exit;
}



$lay_run = "SELECT DISTINCT level_difficulty, question_id FROM test_question order by question_id asc";

$results = mysqli_query($sqlcon, $lay_run);

$suppd = "<select class='form-control mb-3' name='level_difficulty'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($results)) {
    $suppd .= "<option value='".$crow['question_id']."'>".$crow['level_difficulty']."</option>";
  }

$suppd .= "</select>";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Preview</title>
    <!-- Boostrap 5.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/dash.css">
    <!-- Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
    <!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
    <style>
        .dp .dropdown-toggle::after {
            content: none;
        }

        .navbar .breadcrumb li a {
            color: #8C0000;
        }

    </style>
    <style type="text/css">
        .base-timer {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .base-timer__svg {
            transform: scaleX(-1);
        }

        .base-timer__circle {
            fill: none;
            stroke: none;
        }

        .base-timer__path-elapsed {
            stroke-width: 7px;
            stroke: grey;
        }

        .base-timer__path-remaining {
            stroke-width: 7px;
            stroke-linecap: round;
            transform: rotate(90deg);
            transform-origin: center;
            transition: 1s linear all;
            fill-rule: nonzero;
            stroke: currentColor;
        }

        .base-timer__path-remaining.green {
            color: rgb(65, 184, 131);
        }

        .base-timer__path-remaining.orange {
            color: orange;
        }

        .base-timer__path-remaining.red {
            color: red;
        }

        .base-timer__label {
            position: absolute;
            width: 300px;
            height: 300px;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }

    </style>
</head>

<body style="background-color: rgb(229, 229, 229); " onload="timeout()">
    <div class="sidebar close">
        <div class="logo-details">
            <i class="fas fa-fingerprint"></i><span class="logo_name">CCJE Reviewer</span>
        </div>
        <hr style="color:rgb(255, 255, 255);">
        <ul class="nav-links fw-bolder">
            <li class="navigation-list-item">
                <a href="../faculty/dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/dashboard.php">Dashboard</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="../faculty/testbank.php">
                    <i class="fas fa-list-ol"></i>
                    <span class="link_name">Question Bank</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/testbank.php">Question Bank</a></li>
                </ul>
            </li>
            <li>
            <li class="../faculty/navigation-list-item">
                <a href="../faculty/testyourself.php">
                    <i class="fas fa-sticky-note"></i>
                    <span class="link_name">Manage Test</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/testyourself.php">Manage Test</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="../faculty/preboard.php">
                    <i class="fas fa-list-alt"></i>
                    <span class="link_name">Pre-Board Examination</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/preboard.php">Pre-Board Examination</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="../faculty/examresults.php">
                    <i class="fas fa-poll"></i>
                    <span class="link_name">Exam Results</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/examresults.php">Exam Results</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="../faculty/accounts_manage.php">
                    <i class='bx bxs-user-account bx-sm'></i>
                    <span class="link_name">Accounts</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/accounts_manage.php">Accounts</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="../faculty/log-history.php">
                    <i class="fas fa-history"></i>
                    <span class="link_name">Log History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="../faculty/log-history.php">Logs History</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-archive"></i>
                        <span class="link_name">Archived</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow drop'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Archived</a></li>
                    <li><a href="../faculty/archive_quizzes.php">Quiz & Longquiz</a></li>
                    <li><a href="../faculty/archive_exam.php">Preboard exam</a></li>
                    <li><a href="../faculty/archived_user_accounts.php">User Accounts</a></li>
                </ul>
            </li>
            <li class="navigation-list">
                <div class="profile-details">
                    <?php

                      $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                      while ($rows = mysqli_fetch_assoc($query_row)) { 
                        echo ' 
                      <div class="profile-content">
                         <img class="rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" alt="profileImg">
              </div>';


                        ?>
                    <?php }

                        ?>
                    <div class="name-job">
                        <div class="profile_name"><a class="profile text-warning" href="../faculty/profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
                        <div class="job"><?php echo $_SESSION["role"];?></div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section float-start">
        <div class="home-content d-flex justify-content-between" style="background: white;">
            <div class="d-flex">
                <button style="border-style: none; background: white; height: 60px;" class="mt-1">
                    <i class='bx bx-menu'></i>
                </button>
                <nav class="navbar navbar-expand-lg navbar-light" style="margin-top: 10px;">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../faculty/dashboard.php" style="text-decoration: none;">Home</a></li>
                                <li class="breadcrumb-item"><a href="../faculty/testyourself.php" style="text-decoration: none;">Manage Test</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Preview Quiz</li>
                            </ol>
                        </nav>
                    </div>
                </nav>
            </div>
            <form class="d-flex">
                <!--- Notification -->
                <div class="dropdown dp mt-3 me-2">
                    <a class="text-reset dropdown-toggle text-decoration-none position-relative" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg mx-2"></i>
                        <div id="count_wrapper">

                        </div>
                    </a>
                    <div class="dropdown-list bg-light dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
                        <p class="h5 dropdown-header text-dark ">Notifications</p>
                        <div style="overflow-y: auto; white-space: nowrap; height: auto; max-height: 300px;" class="bg-white">
                            <div id="wrapper">

                            </div>
                        </div>
                        <a class="dropdown-item text-center small text-gray-500" href="../faculty/notification.php">Show All Notifications</a>
                    </div>
                </div>
                <div class="dropdown mx-2">
                    <button class="btn  dropdown-toggle border border-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php

                            $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                             while ($rows = mysqli_fetch_assoc($query_row)) {
                          echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"></span>';
                          ?>
                        <?php }

                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="../faculty/profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="../faculty/change-pass.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
                    </ul>
                </div>
            </form>
        </div>
        <!-- Main Content-->
        <div class="col py-3 overflow-auto mx-2">
            <div class="container-fluid">
                <div class="col-lg-10 mx-auto">
                    <?php
               $id = $_GET['id'];

               $row = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");
               while ($show = mysqli_fetch_assoc($row)) { ?>
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(43, 43, 43);">
                            <p class="h2 fw-bold text-uppercase text-white"> <?php echo $show['quiz_title']; ?></p>
                            <p class="h5  text-uppercase text-white"><?php echo $show['subject_name']; ?></p>
                        </div>
                        <div class="card-body">
                            <p class=" h5 text-dark fw-bold"> <?php echo $show['description']; ?> </p>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <form action="preview_function.php" id="form1" method="POST">
                    <div class="col-lg-10 mx-auto">
                        <?php
                 $c = 0;
                 $ids = $_GET['id'];
                 $sac = $_GET['last'];
                 $number = 1;

                 $display = mysqli_query($sqlcon,"SELECT * FROM test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND test_id = '$ids'");

                 $dis = mysqli_query($sqlcon,"SELECT * FROM trial_preview,tbl_trial_result WHERE (trial_preview.trial_result_id = tbl_trial_result.trial_result_id) AND tbl_trial_result.trial_result_id = '$sac'");

                

                  while ($shows= mysqli_fetch_assoc($display) AND $low = mysqli_fetch_assoc($dis)) {  

                    $ans = $low['trial_ans'];
                    $core = $shows['correct_ans'];
                    $course = $shows['option_a'];
                    $base = $shows['option_b'];
                    $base4 = $shows['option_c'];
                    $vv = $shows ['option_d'];
                    ?>

                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body m-2">
                                    <div class="card">
                                        <div class="card-body" style="background-color: rgb(219, 235, 247);">
                                            <div class="table-reponsive">
                                                <table class="align-middle mb-0 table table-borderless " id="quesTab" style="font-size: 17px;">
                                                    <thead class="mb-4">
                                                        <th class="text-left pl-1 fs-5">Question:</th>
                                                    </thead>
                                                    <tbody>


                                                        <?php
                                if ($low['trial_ans']== $shows['correct_ans']) { ?>
                                                        <tr>
                                                            <th>
                                                                <b><span class="text-success"> <?php echo $number ?>.&nbsp;<?php echo $shows['questions_title']; ?> <i class="fas fa-check ms-2 fa-lg"></i></span></b>
                                                            </th>
                                                        </tr>
                                                        <?php 

                                }
                                elseif ($low['trial_ans']!= $shows['correct_ans']) { ?>
                                                        <tr>
                                                            <th>
                                                                <b><span class="text-danger"><?php echo $number.". &nbsp;". $shows['questions_title']; ?> <i class="fas fa-times text-danger ms-2 fa-lg"></i></span></b>
                                                            </th>
                                                        </tr>
                                                        <?php
                                }

                                ?>
                                                        <tr>
                                                            <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="A" <?php if($ans=='A'){ echo "checked=checked";}  ?> disabled> A. <?php echo $shows['option_a']; ?></span></td>
                                                        </tr>

                                                        <tr>
                                                            <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="B" <?php if($ans=='B'){ echo "checked=checked";}  ?> disabled> B. <?php echo $shows['option_b']; ?></span></td>
                                                        </tr>

                                                        <tr>
                                                            <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="c" <?php if($ans=='C'){ echo "checked=checked";}  ?> disabled> C. <?php echo $shows['option_c']; ?></span></td>
                                                        </tr>

                                                        <tr>
                                                            <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="D" <?php if($ans=='D'){ echo "checked=checked";}  ?> disabled> D. <?php echo $shows['option_d']; ?></span></td>
                                                        </tr>

                                                        <tr>
                                                            <td>&emsp;<span class="text-dark"><b class="me-2">Correct Answer:</b><b class="ms-1"><?php echo $shows['correct_ans']; ?>. <?php if ($core =='A') { echo $shows['option_a'];}elseif ($core =='B') { echo $shows['option_b']; }elseif ($core =='C') { echo $shows['option_c']; }elseif ($core =='D') { echo $shows['option_d'];} ?></b></span></td>
                                                        </tr>


                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                                                            <input type="hidden" name="update_acc_id" value="<?php echo $_SESSION['acc_id'] ?>">
                                                            <input type="hidden" name="total_quest" value="<?php echo $sad; ?>">
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $number++; } ?>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="../faculty/testyourself.php" class="btn btn-secondary px-3"><i class="fas fa-backward me-1"></i> BACK</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Delete Question -->
    <div class="modal fade" id="ArchiveAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column border-0">
                    <h5 class="modal-title fw-bold fs-4" id="exampleModalLabel "></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="icon-box mt-3">
                        <i class="far fa-times-circle fa-5x text-danger"></i>
                    </div>
                    <h3 class="modal-title text-align-center mt-3 fw-bold">Are you sure?</h3>
                </div>
                <form class="form" action="../php/delete_test_yourself.php" method="POST">
                    <div class="modal-body">
                        <div class="container d-flex justify-content-center">
                            <input type="hidden" name="update_id" id="delete_id">
                            <input type="hidden" name="lets" value="<?php echo $_GET['id']?>">
                            <p>Do you really want to delete these record?</p>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Yes">
                            <button type="button" class="btn btn-danger  px-5 pb-2 text-white" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column border-0 bg-danger">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="icon-box mt-2 mb-2">
                        <i class="fas fa-exclamation-circle fa-5x text-white"></i>
                    </div>
                </div>
                <div class="modal-body text-center mt-2">
                    <h4 class="fw-bold">Do you really wish to leave or log out?</h4>
                </div>
                <div class="modal-footer border-0">
                    <form action="../php/logout_faculty.php" class="hide" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
                        <input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
                        <div>
                            <button type="submit" class="btn btn-success">YES</button>
                            <button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">NO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.deletebtn').on('click', function() {

            $('#ArchiveAccount').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#delete_id').val(data[0]);
        })
    });

</script>
<script src="../TimeCircles-master/inc/TimeCircles.js"></script>
<script type="text/javascript">
    $('#exam_timer').TimeCircles({
        time: {
            Days: {
                show: false
            }
        }
    });

    setInterval(function() {

        var remaining_second = $('#exam_timer').TimeCircles().getTime();
        if (remaining_second < 1) {
            clearTimeout(tm);
            document.getElementById('form1').submit();
        }

        var tm = setTimeout(function() {
            setInterval()
        }, 1000)
    }, 2000);

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#navbarDropdownMenuLink").on("click",function(){
            $.ajax({
                url:"../faculty/readnotification.php",
                success: function(come){
                    console.log(come);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#navbarDropdownMenuLink").on("click",function(){
            $.ajax({
                url:"../faculty/readnotif.php",
                success: function(come){
                    console.log(come);
                }
            });
        });
    });
</script>
<script>
    function loadXMLDocs() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("count_wrapper").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "../faculty/notif_num.php", true);
        xhttp.send();
    }
    setInterval(function() {
        loadXMLDocs();
        // 1sec
    }, 100);

    window.onload = loadXMLDocs;

</script>
<script>
    function load() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("wrapper").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "../faculty/notif_wrapper.php", true);
        xhttp.send();
    }
    setInterval(function() {
        load();
        // 1sec
    }, 100);

    window.onload = load;

</script>
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
    var table = $('#examTab').DataTable();

</script>

</html>
