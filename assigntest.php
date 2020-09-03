<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");
?>

<div class="row">
   
    	 <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Institution Name</th>
                            <th>Teacher</th>
                            <th>View Test</th>
                            <th>Schedule Date</th>
                            <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                        	 <?php  
                              $select_query = "select * from mst_test";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                               $teacher_id = $res['teacher_id'];
                              $course = "SELECT * FROM teacher where teacher_id = $teacher_id ";
                              $course_run = mysqli_query($connection, $course);
                              $res1 = mysqli_fetch_array($course_run);

                              $inst_id = $res1['inst_id'];
                              $chapter = "SELECT * FROM institution where inst_id = $inst_id ";
                              $chapter_run = mysqli_query($connection, $chapter);  

                              $test_id = $res['test_bank_id'];
                              $course1 = "SELECT * FROM test_bank where test_id = $test_id ";
                              $run = mysqli_query($connection, $course1);
                             
                              ?>
                              <tr>
                              	<td><?php foreach($chapter_run as $chapter_row){ echo $chapter_row['inst_name'];} ?></td>
                                <td><?php foreach($course_run as $course_row){ echo $course_row['teacher_name'];} ?></td>
                                <td>
                                	<button type="button" class="btn btn-primary">
                                    <a href="viewassigntest.php?id=<?php echo $res['test_id']; ?>" class="text-white"><?php echo $res['test_name']; ?></a>
                                    </button>
                                </td>
                                <td><?php echo date('F d, Y', strtotime($res['schedule_date'])); ?></td>
                                <td><button class="btn btn-danger">
                                	<a href="deletechapter.php?ids=<?php echo $res['chapter_id']; ?>" class="text-white">Delete</a>
                                </button></td>
                              <?php } ?>
                              </tr>
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