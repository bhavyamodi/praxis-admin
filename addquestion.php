<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];
$query = "SELECT * FROM topic WHERE topic_id= $id";
$run = mysqli_query($connection,$query);
$res = mysqli_fetch_array($run);
$c_id = $res['chapter_id'];
if(isset($_POST['submit'])){
    $test_id = $_POST['test_id'];
    
 $insert = "INSERT INTO test_question(test_bank_id,question_id, question, option_1, option_2, option_3, option_4, answer, solution)
       SELECT '$test_id',question_bank_id, question, option_1, option_2, option_3, option_4, answer, solution  
       FROM question_bank WHERE topic_id = $id";
  $run = mysqli_query($connection,$insert);
  if($run){
      ?>
      <script type="text/javascript">
alert("questions added successfully");
</script>
<?php
  }else{
      echo mysqli_error($connection);
  }

}
?>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
    		<div class="card">
    		<h4 class="card-title text-center p-1 my-1">Topic Name : <?php echo $res['topic_name']; ?>
    		<button type="button" class="btn btn-outline-primary btn-icon-text float-right">
        <i class="mdi mdi-upload btn-icon-prepend"></i>
        <a href="#modalLoginForm" class="smoothScroll" data-toggle="modal" data-target="#modalLoginForm">
        	<span>Assign all questions to test</span>
        </a>
    </button>
           <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <a href="addtopic.php?id=<?php echo $c_id ; ?>">
                      <span>Back</span>
                      </a>
                    </button>
        </h4>
    	    </div>
    	</div>
    	<div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">

                    
                    <h4 class="card-title">Question in <?php echo $res['topic_name']; ?>
                    
                    <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <i class="mdi mdi-upload btn-icon-prepend"></i>
                      <a href="question.php?id=<?php echo $res['topic_id']; ?>">
                      <span>Add Question</span>
                      </a>
                    </button></h4><br>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>No.</th>
                            <th>Edit</th>
                            <th>Question?</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Answer</th>
                            <th>Solution</th>
                            <th>Delete</th>

                            </tr>
                          </thead>
                          <tbody>
                        	 <?php  
                              $select_query = "select * from question_bank where topic_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                              $count = 1;
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                  <td><?echo $count ; ?></td>
                                  <td>
                                	<button type="button" class="btn btn-primary">
                                    <a href="editquestion.php?id=<?php echo $res['question_bank_id']; ?>" class="text-white">Edit</a>
                                    </button>
                                </td>
                                <td><?php echo $res['question']; ?></td>
                                <td><?php echo $res['option_1']; ?></td>
                                 <td><?php echo $res['option_2']; ?></td>
                                  <td><?php echo $res['option_3']; ?></td>
                                   <td><?php echo $res['option_4']; ?></td>
                                    <td><?php echo $res['answer']; ?></td>
                                     <td><?php echo $res['solution']; ?></td>
                                
                                <td><button class="btn btn-danger">
                                	<a href="deletequestion.php?id=<?php echo $res['question_bank_id']; ?>" class="text-white">Delete</a>
                                </button></td>
                              <?php
                              $count = $count + 1 ;
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
        <h4 class="modal-title w-100 font-weight-bold">Select Test</h4>
        
      </div>
      <div class="modal-body mx-3">
       
    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="mb-4">
          <i class="fa fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right">Test Name</label>
           <select class="form-control text-white" name="test_id">
                           <?php
                              $rs=mysqli_query($connection,"Select * from test_bank");
                              while($res=mysqli_fetch_array($rs))
                                  {
                                  if($row[0]==$test_id)
                                  {
                                  echo "<option value='$res[0]' selected>$res[1]</option>";
                                  }
                                  else
                                  {
                                  echo "<option value='$res[0]'>$res[1]</option>";
                                  }
                                }
                                  ?>
                      </select>
        </div>
        <br>
        <div class="mb-4">
            <input type="submit" name="submit" class="form-control btn btn-primary" value="SUBMIT">
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