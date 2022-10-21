<?php

session_start();

require_once 'conn.php';

$id = $_SESSION['acc_id'];

$difficult = $_POST['difficult'];
$subjects = $_POST['subjects'];

$sql=mysqli_query($sqlcon,"SELECT * FROM `test_question` WHERE `acc_id`='$id' AND  `level_difficulty` LIKE '%$difficult%' AND `subject_name` LIKE '%$subjects%'");

 ?>


 <input type="text" class="form-control" name="let"hidden="" value="<?php echo $_GET['id'] ?>">
  <table id="example1" class="align-middle mb-0 table table-borderless table-striped table-hover">
    <thead>
      <tr>
        <th scope="col" hidden="">Select</th>
        <th scope="col">Subjects</th>
        <th scope="col">Question</th>
        <th scope="col">Option A</th>
        <th scope="col">Option B</th>
        <th scope="col">Option C</th>
        <th scope="col">Option D</th>
        <th scope="col">Correct Answer</th>
        <th scope="col">Difficulty</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($sql)) {

        $_SESSION['exam'] = $row['question_id']; ?>
      <tr>

       <td hidden=""><input type="checkbox" class="checkbox" name="chkl[]" id="question_id<?php echo $row['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $row['question_id']; ?>"></td>
       <td><?php echo $row['subject_name'] ?> </td>
       <td><?php echo $row['questions_title'] ?></td>
       <td><?php echo $row['option_a'] ?></td>
       <td><?php echo $row["option_b"] ?></td>
       <td><?php echo $row["option_c"] ?></td>
       <td><?php echo $row["option_d"] ?></td>
       <td><?php echo $row["correct_ans"] ?></td>
       <td><?php echo $row['level_difficulty'] ?></td>
     </tr>

   <?php } ?>
    </tbody>
  </table>


<<<<<<< HEAD


=======
>>>>>>> f372b5ee80534bf595d4ec410bb0c63d03e14a78


  



