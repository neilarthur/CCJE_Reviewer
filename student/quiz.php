<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='student') {
    header("location: ../php/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null;
        }

    </script>
    <title>Quiz</title>
    <!-- Boostrap 5.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <!-- Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../TimeCircles-master/inc/TimeCircles.css">
    <!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
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

        .dp .dropdown-toggle::after {
            content: none;
        }

        .dp .dropdown-list {
            left: -90px;
        }

        .navbar .breadcrumb li a {
            color: #8C0000;
        }

    </style>
</head>

<body style="background-color: rgb(229, 229, 229);" onload="timeout()">
    <div class="header text-uppercase hd ">
        <div class="container-fluid py-3">
            <img src="../assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2">
            <h3 class="text-white mt-3 ms-4">Automated Licensure Examination Reviewer </h3>
            <span class="text-white text-center dep">College of Criminal Justice and Education</span>
        </div>
    </div>
    <!-- Top navbar-->
    <nav id="navbar-top" class="navbar navbar-expand-lg navbar-light fw-bold">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-4" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-2">
                    <li class="nav-item text-uppercase">
                        <a class="nav-link disabled" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link disabled " href="take_quiz.php">Take Quiz</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link disabled" href="take_preboard.php">Pre-boad Exam</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link disabled " href="#">Results</a>
                    </li>
                </ul>
                <div class="flex-shrink-0 text-center">
                    <div class="dropdown dp mx-2">
                        <a class="text-reset dropdown-toggle text-decoration-none" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg mx-1"></i>
                            <div id="count_wrapper">

                            </div>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
                            <h6 class="dropdown-header text-dark ">Notifications</h6>
                            <div style="overflow-y: auto; white-space: nowrap; height: auto; max-height: 300px;" class="bg-white">
                                <div id="wrapper">

                                </div>
                            </div>
                            <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All Notifications</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 dropdown pe-5 text-center">
                    <button class="btn  dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php

                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                     while ($rows = mysqli_fetch_assoc($query_row)) {
                  echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;"> '.$_SESSION["first_name"].'</span>';
                  ?>
                        <?php }

                ?>

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item disabled" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
                        <li><a class="dropdown-item disabled" href="change_password.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column border-0 bg-warning">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="icon-box mt-2">
                        <i class="fas fa-exclamation-circle fa-6x text-dark"></i>
                    </div>
                </div>
                <div class="modal-body flex-column">
                    <p class="fs-5 modal-title mt-3 text-center">The action are you going to perform is irrevesible. Please confirm!</p>
                    <p class="fs-5 mt-2 text-center">Are you sure that you want to logout?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0 mb-2">
                    <form action="../php/logout_students.php" class="hide" method="POST" class="text-center">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
                        <input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
                        <button type="submit" class="btn btn-success mx-2 px-5 pb-2 rounded-pill">YES</button>
                        <button type="button" class="btn btn-danger mx-2 px-5 pb-2 rounded-pill" data-bs-dismiss="modal">NO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Main Content-->
    <div class="container py-4">
        <div class="col-lg-12">
            <div class="card mb-2">
                <?php

              $ids = $_GET['id'];

              $row = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$ids'");

              while ($show = mysqli_fetch_assoc($row)) { ?>


                <div class="card-header" style="background-color: rgb(43, 43, 43);">
                    <p class="h1 fw-bold text-uppercase text-white"> <?php echo $show['quiz_title']; ?></p>
                    <p class="h4  text-uppercase text-white"><?php echo $show['subject_name']; ?></p>
                </div>
                <div class="card-body m-2 ">
                    <p class=" h4 text-dark fw-bold"> <?php echo $show['description']; ?> </p>
                </div>
            </div>
            <?php }  ?>
        </div>
        <form action="check.php" id="form1" method="POST">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-2" id="timer">
                        <div class="card-body mx-auto">
                            <div class="justify-content-center" id="exam_timer" data-timer="<?php echo $_GET['limit']; ?>" style="height: 100px; width: 100%;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <?php

          $sad = $_GET['base'];


          $c = 0;
          $number = 1;
          $display = mysqli_query($sqlcon,"SELECT * FROM choose_question,test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND (choose_question.test_id = student_choice.test_id) AND (student_choice.test_id = '$ids')");

          while ($shows = mysqli_fetch_assoc($display)) {  ?>

                <div class="col-lg-12">
                    <div class="card mb-2">
                        <div class="card-body m-2">
                            <div class="card">
                                <div class="card-body" style="background-color: rgb(219, 235, 247);">
                                    <div class="table-reponsive">
                                        <table class="align-middle mb-0 table table-borderless" id="quesTab">
                                            <thead class="mb-4">
                                                <tr>

                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 17px;">
                                                <tr>
                                                    <th>
                                                        <b><span><?php echo $number.". &nbsp;". $shows['questions_title']; ?></span></b>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="A" required> A. <?php echo $shows['option_a']; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="B" required> B. <?php echo $shows['option_b']; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="C" required> C. <?php echo $shows['option_c']; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="D" required> D. <?php echo $shows['option_d']; ?></span></td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="update_question_id[]" value="<?php echo $shows['question_id']; ?>">
                                                    <input type="hidden" name="update_id" value="<?php echo $_GET['id']; ?>">
                                                    <input type="hidden" name="update_acc_id" value="<?php echo $_SESSION['acc_id'] ?>">
                                                    <input type="hidden" name="total_quest" value="<?php echo $sad; ?>">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $number++; } ?>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <?php

            $ter = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$ids'");

            while ($ger = mysqli_fetch_assoc($ter)) { ?>

                <input type="hidden" name="subjectas" value="<?php echo $ger['subject_name']; ?>">

                <?php
            }
            ?>
                <input type="submit" value="submit" class="btn btn-success rounded  mx-2 px-5 pb-2 text-uppercase btn-lg">
            </div>
            <label id="resulted"></label>
            <label id="error"></label>
        </form>
    </div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../TimeCircles-master/inc/TimeCircles.js"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar-top').classList.add('fixed-top');
                document.getElementById('timer').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar-top').classList.remove('fixed-top');
                document.getElementById('timer').classList.remove('fixed-top'); // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });

</script>

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
    $(document).ready(function() {
        $("#navbarDropdownMenuLink").on("click", function() {
            $.ajax({
                url: "view_student_notif.php",
                success: function(comers) {
                    console.log(comers);
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
        xhttp.open("GET", "notif_num.php", true);
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
        xhttp.open("GET", "notif_wrapper.php", true);
        xhttp.send();
    }
    setInterval(function() {
        load();
        // 1sec
    }, 100);

    window.onload = load;

</script>

</html>
