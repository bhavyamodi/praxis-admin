<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");
$id = $_GET['id'];

$select_query = "select * from question_bank where question_bank_id = $id";
            $select_query_run =  mysqli_query($connection, $select_query);
            $res = mysqli_fetch_array($select_query_run);

if(isset($_POST['submit'])){
      $test_id = $_POST['subid'];

        $insertquery = "insert into test_question(test_bank_id, question_id) values('$test_id', '$id')";
        $run_query = mysqli_query($connection, $insertquery);
          if($run_query){
              $select_query1 = "select * from mst_test where test_id=$id";
              $select_query1_run =  mysqli_query($connection, $select_query1);
               $res1 = mysqli_fetch_array($select_query1_run);

                 $que ="UPDATE test_question
    INNER JOIN
    question_bank
    ON question_id = question_bank_id
    SET test_question.question = question_bank.question,
    test_question.option_1 = question_bank.option_1,
    test_question.option_2 = question_bank.option_2,
    test_question.option_3 = question_bank.option_3,
    test_question.option_4 = question_bank.option_4,
    test_question.answer = question_bank.answer,
    test_question.solution = question_bank.solution";
              $run = mysqli_query($connection,$que);
              if($run){
                 ?>
                <script type="text/javascript">
               alert("Question added successfully!");
               location = "addtestquestion.php";
               </script>
               <?php
              }
              else{
              //  echo "Connection failed: " . mysqli_error($connection);
                 ?>
                <script type="text/javascript">
               alert("Question cannot be added !");
               </script>
               <?php
              }
               
            }else{
                ?>
                <script>
                  alert("data not updated");
                </script>
                <?php
            }
}
?>
<div class="col-lg-12 grid-margin stretch-card">
   <div class="card">
                <div class="card-body"> 
                    <h4 class="card-title">Question Bank
                    </h4><br>
                    
                   
               

             <p>
             <?php 
             echo "Question :", $res['question']; ?>
             <br>
             <?php 
             echo "solution:", $res['solution']; ?>
             </p>
             <button type="button" class="btn btn-outline-primary btn-icon-text">
                      <i class="mdi mdi-upload btn-icon-prepend"></i>
                      <a href="#modalLoginForm" class="smoothScroll" data-toggle="modal" data-target="#modalLoginForm">
                      <span>Add Question</span>
                     </a>
                    </button>
              </div>
   </div>
	
</div>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title w-100 font-weight-bold">Add Question</h4>
        
      </div>
      <div class="modal-body mx-3">
       
   <div class="card">
                  <div class="card-body">
                    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
                      <div class="mb-4">
                      <label data-error="wrong" data-success="right">Test Name</label>
                      <select class="form-control text-white" name="subid">
                           <?php
                              $rs=mysqli_query($connection,"Select * from test_bank");
                                  while($row=mysqli_fetch_array($rs))
                                  {
                                  if($row[0]==$subid)
                                  {
                                  echo "<option value='$row[0]' selected>$row[1]</option>";
                                  }
                                  else
                                  {
                                  echo "<option value='$row[0]'>$row[1]</option>";
                                  }
                                  }
                                  ?>
                      </select>
                      </div>
                     
                      <br>
                      <div class="mb-4">
                           <input type="submit"name="submit" class="form-control btn btn-primary" value="ADD QUESTION">
                                 </div>
                   </form>
                </div>
            </div>

     
    </div>
  </div>
</div>

<?php 
include("includes/footer.php");
include("includes/scripts.php");
?>