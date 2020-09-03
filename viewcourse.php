<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];
$query1 = "SELECT * FROM course WHERE course_id= $id";
$run1 = mysqli_query($connection,$query1);
$res1 = mysqli_fetch_array($run1);

$query = "SELECT * FROM topic WHERE course_id= $id";
$run = mysqli_query($connection,$query);
$res = mysqli_fetch_array($run);
$ids = $res['topic_id'];


?>

<div class="row">
   	<div class="col-lg-12 grid-margin stretch-card">
    		<div class="card">
    		<h4 class="card-title text-center p-1 my-1">Course Name : <?php echo $res1['course_name']; ?>
    			 <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <a href="courses.php">
                      <span>Back</span>
                      </a>
                    </button>
    		</h4>
    	    </div>
    </div>
    <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Chapters</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          	<?php

                               $select_inst = "select * from chapter where course_id=$id";
                               $select_inst_run = mysqli_query($connection, $select_inst);
                               $nums = mysqli_num_rows($select_inst_run);
                               echo $nums;
               
                            ?>
                          </h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
    </div>
    <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Topics</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          	<?php

                               $select_inst = "select * from topic where course_id=$id";
                               $select_inst_run = mysqli_query($connection, $select_inst);
                               $nums = mysqli_num_rows($select_inst_run);
                               echo $nums;
               
                            ?>
                          </h2>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
    </div>
    <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Questions</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          	<?php

                               $select_inst = "select * from question_bank where topic_id=$ids";
                               $select_inst_run = mysqli_query($connection, $select_inst);
                               $nums = mysqli_num_rows($select_inst_run);
                               echo $nums;
               
                            ?>

                          </h2>
                          <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
    </div>
</div>

<div class="row">
      <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><code>List of Chapters </code></h4>
                    <p class="card-description">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Chapter Name</th>
                          </tr>
                        </thead>
                        <tbody>
                             <?php 

                 
                  $select_cont = "select * from chapter where course_id=$id";
                  $select_cont_run =  mysqli_query($connection, $select_cont);
                  $nums = mysqli_num_rows($select_cont_run);

                  while($res = mysqli_fetch_array($select_cont_run)){
                    
                  ?>


                  <tr>
                    <td><?php echo $res['chapter_name']; ?></td>
                  </tr>

                 <?php
              }

              ?>      
                     </tbody>
                      </table>
                    </div>
                  </div>
                </div>
      </div>
      <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><code>Topics </code></h4>
                    <p class="card-description">
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover ">
                        <thead>
                          <tr>
                            <th>Chapter Name</th>
                             <th>Topic Name</th>
                             <th>View Question</th>
                          </tr>
                        </thead>
                        <tbody>
                             <?php 

                 
                  $select_cont = "select * from topic where course_id=$id";
                  $select_cont_run =  mysqli_query($connection, $select_cont);
                  $nums = mysqli_num_rows($select_cont_run);

                  while($res = mysqli_fetch_array($select_cont_run)){
                   
                    $chapter_id = $res['chapter_id'];
                    $chapter = "SELECT * FROM chapter where chapter_id = $chapter_id ";
                    $chapter_run = mysqli_query($connection, $chapter);

                                
                  ?>


                  <tr>
                  	<td><?php foreach($chapter_run as $chapter_row){ echo $chapter_row['chapter_name'];} ?></td>
                    <td><?php echo $res['topic_name']; ?></td>
                    <td>
                     <button type="button" class="btn btn-success">
                        <a href="addquestion.php?id=<?php echo $res['topic_id']; ?>" class="text-white"  data-toggle="tooltip" title="Add Question">
                        View Question
                       </a>
                     </button>
                    </td>
                  </tr>

                 <?php
              }

              ?>      
                     </tbody>
                      </table>
                    </div>
                  </div>
                </div>
      </div>
</div>

<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>