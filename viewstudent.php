<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];


$query1 = "SELECT * FROM course WHERE course_id= $id";
$run1 = mysqli_query($connection,$query1);
$res1 = mysqli_fetch_array($run1);

?>

<div class="container">
  <div class="row">
    <?php 

    $query = "SELECT * FROM subject WHERE class_id = $id";
    $query_run = mysqli_query($connection, $query);
    $check_course = mysqli_num_rows($query_run)>0;
    if($check_course){
      while($row = mysqli_fetch_array($query_run)){
         $topic_id = $row['subject_id'];
        $topic = "SELECT * FROM class_teacher where subject_id = $topic_id ";
         $topic_run = mysqli_query($connection, $topic);
         $row1 = mysqli_fetch_array($topic_run);
         $teacher_id = $row1['teacher_id'];
         $topic1 = "SELECT * FROM teacher where teacher_id = $teacher_id ";
         $topic1_run = mysqli_query($connection, $topic1);
        ?>
      <div class="col-md-3">
      <div class="card text-center p-3 my-3">
        <h4 clas="card-title">
          <?php echo $row['subject_name']; ?>  
          </h4>
        <p class="card-text">
            <?php foreach($topic1_run as $topic1_row){ echo $topic1_row['teacher_name'];} ?>             
        </p>
      </div>
      
    </div>
    <?php
      }
    }

    ?>
    
    
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">

                    
                    <h4 class="card-title">List of Students</h4><br>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>No.</th>
                            <th>Student Name</th>
                            <th>View</th>
                            </tr>
                          </thead>
                          <tbody>
                        	 <?php  
                              $select_query = "select * from student where class_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                              $count=1;
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                  <td><?php echo $count; ?></td>
                                <td><?php echo $res['student_name']; ?></td>
                                <td><button class="btn btn-outline-primary">View</button></td>
                              <?php
                              $count=$count+1;
                              } ?>
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