<?php

require_once 'conn.php';

$users = $_POST['userid'];

$query = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$users'");
$sqlquery = mysqli_query($sqlcon,"SELECT * FROM student_choice WHERE qy_id = '$users'");

while ($low = mysqli_fetch_assoc($query) AND $bow = mysqli_fetch_assoc($sqlquery)) {

  ?>
          <form action="../php/update_test_yourself.php" method="POST">
            <div class="card border-0">
              <div class="card-body m-2">
                <div class="mb-3">
                  <label  class="form-label">Title</label>
                  <textarea type="text" class="form-control" name="title" rows="2"><?php echo $low['quiz_title'] ;?></textarea>
                </div>
                <div class="mb-3">
                  <label  class="form-label">Description</label>
                  <input type="hidden" class="form-control" name="test" value="<?php echo $users; ?>">
                  <input type="hidden" class="form-control" name="test2" value="<?php echo $bow['qy_id'] ?>">
                  <textarea type="text" class="form-control" name="description" rows="2"><?php echo $low['description'] ?></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-3 mb-3">
                    <label  class="form-label">Section</label>
                    <div class="form-group">
                      <select class="form-select" name="class_section">
                          
                          <?php

                          if ($low['section']=='4A') { ?>
                             
                          <option value="4A">4A</option>
                          <option value="4B">4B</option>
                          <option value="4C">4C</option>
                          <?php } elseif ($low['section']=='4B'){ ?>
                          <option value="4B">4B</option>
                          <option value="4A">4A</option>
                          <option value="4C">4C</option>
                        <?php } elseif ($low['section']=='4C') { ?>
                          <option value="4C">4C</option>
                          <option value="4A">4A</option>
                          <option value="4B">4B</option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4 mb-3">
                  <label  class="form-label">Type of Test</label>
                  <div class="form-group">
                    <select class="form-select" name="type_exam">
                                                    <?php

                          if ($low['type_test']=='Quiz') { ?>
                             
                          <option value="Quiz">Quiz</option>
                          <option value="LongQuiz">LongQuiz</option>
                          
                          <?php } elseif ($low['type_test']=='LongQuiz'){ ?>
                          <option value="LongQuiz">LongQuiz</option>
                          <option value="Quiz">Quiz</option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-5 mb-3">
                  <label  class="form-label">Subject Exam</label>
                  <div class="form-group">
                    <select class="form-select" name="subjects" id="subjects">
                      <option selected><?php echo $low['subject_name'] ?></option>
                      <option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
                      <option value="Law Enforcement">Law Enforcement</option>
                      <option value="Criminalistics">Criminalistics</option>
                      <option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
                      <option value="Criminal Sociology">Criminal Sociology</option>
                      <option value="Correctional Administration">Correctional Administration</option>
                    </select>
                    <input type="hidden" name="hidden_exam" id="hidden_exam" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="mb-3"><label class="form-label">Level of Difficulty</label>
                      <div class="input-group">
                        <select class="form-control custom-select mb-3  difficult" name="difficult" id="difficult">
                            <?php

                            if ($low['question_difficulty']=='Easy') { ?>
                               
                            <option value="Easy">Easy</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Hard">Hard</option>
                            
                            <?php } elseif ($low['question_difficulty']=='Moderate'){ ?>

                            <option value="Moderate">Moderate</option>
                            <option value="Hard">Hard</option>
                            <option value="Easy">Easy</option>

                          <?php } elseif ($low['question_difficulty']=='Hard'){ ?>
                            <option value="Hard">Hard</option>
                            <option value="Easy">Easy</option>
                            <option value="Moderate">Moderate</option>
                           <?php } ?>
                         </select>
                         <input type="hidden" name="hidden_country" id="hidden_country" />
                       </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Total of Questions</label>
                      <div class="form-group">
                        <select class="form-select" name="t_question" id="total_questions">
                          <option value="<?php echo $low['total_quest'] ?>" selected=""><?php echo $low['total_quest'] ?></option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                          <option value="30">30</option>
                          <option value="35">35</option>
                          <option value="40">40</option>
                          <option value="45">45</option>
                          <option value="50">50</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label class="form-label">Time Limit</label>
                      <div class="form-group">
                        <select class="form-control" name="time_limit">
                          <option selected value="<?php echo $low['time_limit'] ?>"><?php echo $low['time_limit'] /60 ?> mins</option>
                          <?php

                          if ($low['time_limit']=='600') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>

                          <?php }  elseif ($low['time_limit']=='900') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>
                          <?php } elseif ($low['time_limit']=='1200') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>

                          <?php } elseif ($low['time_limit']=='1800') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>

                          <?php } elseif ($low['time_limit']=='3600') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>

                          <?php } elseif ($low['time_limit']=='7200') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>

                          <?php } elseif ($low['time_limit']=='10800') { ?>
                          <option value="600">10 mins</option>
                          <option value="900">15 mins</option>
                          <option value="1200">20 mins</option>
                          <option value="1800">30 mins</option>
                          <option value="3600">1 hr</option>
                          <option value="7200">2 Hours</option>
                          <option value="10800">3 hours</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center border-0 mb-2">
              <input type="hidden" name="prepared_by" value="<?php echo $_GET['acc'] ?>">
              <button type="submit" name="create" class="mx-lg-3 btn btn-success px-3 pb-2 text-white"><i class="fas fa-save me-2"></i> Save Changes </button>
              <button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
            </div>
          </form>
        <?php 
        } 
        ?>
      
