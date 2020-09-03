<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];

$select_query = "select * from test_bank where test_id=$id  ";
    $select_query_run =  mysqli_query($connection, $select_query);
    $res1 = mysqli_fetch_array($select_query_run);
$test_name = $res1['test_name'];
$test_idd = $res1['test_id'];

if(isset($_POST['submit'])){
  
$teacher_id = $_POST['subid'];
$date = $_POST['date'];
$positive = $_POST['positive'];
$negative = $_POST['negative'];

$query_insert = " insert into mst_test (test_bank_id,test_name,teacher_id, schedule_date,positive,negative) value ('$test_idd','$test_name','$teacher_id', '$date','$positive','$negative')";

$run = mysqli_query($connection, $query_insert);
if($run){      
 $last_id = mysqli_insert_id($connection);
       $select = "select * from mst_test where test_id=$last_id  ";
    $select_query =  mysqli_query($connection, $select);
    $res = mysqli_fetch_array($select_query);
  $idd = $res['test_name'];

       $insert = "INSERT INTO mst_question(test_id, question, option_1, option_2, option_3, option_4, answer, solution)
       SELECT '$last_id', question, option_1, option_2, option_3, option_4, answer, solution  
       FROM test_question WHERE test_bank_id = $id";
       $insert_run = mysqli_query($connection, $insert);
       if ($insert_run) {
        //S$last = mysqli_insert_id($connection);

           $loop = 0;
           //$count = 0;
           $rest = mysqli_query($connection,"SELECT * FROM mst_question where test_id = $last_id") or die(mysqli_error($connection));
           $count = mysqli_num_rows($rest);
           if($count==0){

           }
           else{
             while($row=mysqli_fetch_array($rest))
             {
               $loop = $loop + 1;
               mysqli_query($connection,"UPDATE mst_question set question_no=$loop where question_id ='$row[question_id]' ");
             }
           }


       ?>
          <script type="text/javascript">
          alert("Test Assigned successfully!");
          </script>
       <?php
       }
    else{
      echo "Connection failed: " . mysqli_error($connection);
        }
  }
}

?>

    <div class="row">
    	<div class="col-lg-12 grid-margin stretch-card">
    		<div class="card">

    			<div class="row">
    				<div class="col-lg-4 my-2">
    			<button type="button" class="btn btn-outline-primary btn-icon-text float-left">
                      <a href="#modalLoginForm" class="smoothScroll" data-toggle="modal" data-target="#modalLoginForm">
                      <span>Assign Test</span>
                      </a>
                      </button> 
                      </div> 
                      <div class="col-lg-4 my-2">
    		          <h4 class="card-title text-center">Test Name : <?php echo $res1['test_name']; ?></h4>
    		          </div>
    		          <div class="col-lg-4 my-2">
                     <form class="form-inline float-right" method="post" action="generate_pdf.php">
                      <button type="submit" id="pdf" name="btn_pdf" class="btn btn-outline-success btn-icon-text float-right"><a href="generate_pdf.php?id=<?php echo $res1['test_id']; ?>" class="text-success"><i class="mdi mdi-file-pdf" aria-hidden="true"></i>
                      View Report</a>
                      </button>
                      </form>
                      <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <a href="testbank.php">
                      <span>Back</span>
                      </a>
                    </button> 
                    </div> 
                </div>
        
    	    </div>
    	</div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
<div class="col-lg-4 col-md-4 col-sm-12 float-right">
    <center>
  	<div class="card">
  	    <h4 class="card-title">Total no of Question</h4>
  	    <?php  
  	    $sql = mysqli_query($connection,"SELECT * FROM test_question where test_bank_id = $id");
  	    $run = mysqli_num_rows($sql);
  	    ?>
  	    <p><?php echo $run; ?></p>
  	    </div> 
  	    </center>
</div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">

                    
                    <h4 class="card-title">List of Question</h4><br>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>No.</th>
                                 <th>Delete</th>
                            <th>Question</th>
                            <th>Solution</th>
                           
                            </tr>
                          </thead>
                          <tbody>
                        	 <?php  
                              $select_query = "select * from test_question where test_bank_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                              $count = 1;
                             while($res = mysqli_fetch_array($select_query_run)){   
                              ?>
                              <tr>
                                  <td><?php echo $count;?></td>
                                  <td> <button type="button" class="btn btn-inverse-danger">
                    <a href="deletetestquestion.php?id=<?php echo $res['test_question_id']; ?>" class="text-white">Delete</a>
                </button></td>
                              <td><?php echo $res['question']; ?></td>
                              <td><?php echo $res['solution']; ?></td>
                              
                              <?php
                              $count = $count +1;
                              } ?>
                              </tr>
                          </tbody>
                        </table>
                    </div>
                  </div>
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
        <h4 class="modal-title w-100 font-weight-bold">Assign Test</h4>
        
      </div>
      <div class="modal-body mx-3">
       
    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="mb-4">
        	<label data-error="wrong" data-success="right">Teacher Name</label>
                      <select class="form-control text-white" name="subid">
                           <?php
                              $rs=mysqli_query($connection,"Select * from teacher");
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
          <div class="mb-4">
          <label data-error="wrong" data-success="right">Schedule Date</label>
          <input type="date" name="date" class="form-control text-white" required>
        </div>
        <div class="mb-4">
          <label data-error="wrong" data-success="right">Positive Marks per Question</label>
          <input type="text" name="positive" class="form-control text-white" required>
        </div>
        <div class="mb-4">
          <label data-error="wrong" data-success="right">Negative Mark per Question</label>
          <input type="text" name="negative" class="form-control text-white" required>
        </div>
        <br>
        <div class="mb-4">
            <input type="submit"name="submit" class="form-control btn btn-primary" value="SUBMIT">
                  </div>
    </form>

     
    </div>
  </div>
</div>
</div>
<?php 
include("includes/footer.php");
include("includes/scripts.php");
?>