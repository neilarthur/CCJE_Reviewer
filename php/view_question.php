<?php

require_once 'conn.php';

$userid =  $_POST['userid']; 

$say =  "SELECT * FROM test_question WHERE question_id= '$userid'";

$lay =  "SELECT * FROM accounts,test_question WHERE (accounts.acc_id=test_question.acc_id) AND question_id= '$userid'";


$results = mysqli_query($sqlcon, $say);

$resulted = mysqli_query($sqlcon, $lay);

while ($row = mysqli_fetch_assoc($results) AND $bows = mysqli_fetch_assoc($resulted)) { ?>

<form class="form" action="#" method="Post">
     <div class="modal-body">
       <div class="form-group">
         <label for="user-section">Area of Exam</label>
         <input type="hidden" class="form-control" name="update_id" value="<?php echo $row['question_id']; ?>">
         <div class="input-group mb-3">
          <select class="form-control"  name="subjected" readonly disabled="">
            <option selected ><?php echo $row['subject_name']; ?></option>
            <option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
            <option value="Law Enforcement">Law Enforcement</option>
            <option value="Criminalistics">Criminalistics</option>
            <option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
            <option value="Criminal Sociology">Criminal Sociology</option>
            <option value="Correctional Administration">Correctional Administration</option>
          </select>
       </div>
       </div>
       <label for="user-year" class="d-flex justify-content-start">Level of Difficulty</label>
       <div class="input-group mb-3">
          <select class="form-control" required="" name="level_difficulty" readonly disabled="">
            <option selected ><?php echo $row['level_difficulty'];  ?></option>
            <option value="Easy">Easy</option>
            <option value="Moderate">Moderate</option>
            <option value="Hard">Hard</option>
          </select>
       </div>
      <div class="form-group mb-3">
          <label for="name">Question</label>
          <textarea type="text" class="form-control" name="questions_title" rows="3" readonly=""><?php echo $row['questions_title'];  ?></textarea>
      </div>
      <div class="form-group mb-3">
          <label for="name">Option A</label>
          <input type="text" class="form-control" name="option_a" value="<?php echo $row['option_a'];  ?>" readonly>
      </div>
      <div class="form-group mb-3">
          <label for="name">Option B</label>
          <input type="text" class="form-control" name="option_b" value="<?php echo $row['option_b'];  ?>" readonly="">
      </div>
      <div class="form-group mb-3">
          <label for="name">Option C</label>
          <input type="text" class="form-control" name="option_c" value="<?php echo $row['option_c'];  ?>" readonly="">
      </div>
      <div class="form-group mb-3">
          <label for="name">Option D</label>
          <input type="text" class="form-control" name="option_d" value="<?php echo $row['option_d'];  ?>" readonly="">
      </div>

      <div class="form-group mb-3">
          <label for="name">Correct Answer</label>
          <div class="input-group">
            <select class="form-control"  name="correct_ans" readonly="" disabled>
              <option selected ><?php echo $row['correct_ans'];  ?></option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
            </select>
          </div>
      </div>
      <div class="form-group">
          <label for="name" hidden="">Faculty</label>
          <input type="text" class="form-control" name="acc" value="<?php echo $_GET['acc_id'];  ?>" hidden required="">
      </div>
      <div class="modal-footer border-0">
          <a type="button" class=" btn btn-danger px-4 pb-2" data-bs-dismiss="modal">Close</a>
      </div>
    </div>
 </form>

<?php } ?>