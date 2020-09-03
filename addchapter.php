<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];

$query1 = "SELECT * FROM course WHERE course_id= $id";
$run1 = mysqli_query($connection,$query1);
$res1 = mysqli_fetch_array($run1);


$query = "SELECT * FROM chapter WHERE course_id= $id";
$run = mysqli_query($connection,$query);
$res = mysqli_fetch_array($run);
$c_id = $res['chapter_id'];


if(isset($_POST['submit'])){
$name = $_POST['name'];

$query_insert = " insert into chapter (chapter_name, course_id) values ('$name', '$id')";

$run = mysqli_query($connection, $query_insert);
if($run){
?>
<alert>Chapter added successfully.</alert>
<?php
}
else{
echo die("Connection failed: " . mysqli_error($connection));
}
}





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
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">

                    
                    <h4 class="card-title">Chapters
                    
                    <button type="button" class="btn btn-outline-primary btn-icon-text float-right">
                      <i class="mdi mdi-upload btn-icon-prepend"></i>
                      <a href="#modalLoginForm" class="smoothScroll" data-toggle="modal" data-target="#modalLoginForm">
                      <span>Add Chapter</span>
                      </a>
                    </button></h4><br>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                            <th>Chapter Name</th>
                            <th>Topic</th>
                            <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                        	 <?php  
                              $select_query = "select * from chapter where course_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              {   
                              ?>
                              <tr>
                                <td><?php echo $res['chapter_name']; ?></td>
                                <td>
                                	<button type="button" class="btn btn-primary">
                                    <a href="addtopic.php?id=<?php echo $res['chapter_id']; ?>" class="text-white">Add Topic</a>
                                    </button>
                                </td>
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
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Topics</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Course Name</th>
                            <th>Chapter Name</th>
                            <th>Topic Name</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php  
                              $select_query = "select * from topic where course_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                              $course_id = $res['course_id'];
                              $course = "SELECT * FROM course where course_id = $course_id ";
                              $course_run = mysqli_query($connection, $course);

                              $chapter_id = $res['chapter_id'];
                              $chapter = "SELECT * FROM chapter where chapter_id = $chapter_id ";
                              $chapter_run = mysqli_query($connection, $chapter);

                              ?>
                              <tr>
                                <td><?php foreach($course_run as $course_row){ echo $course_row['course_name'];} ?></td>
                                <td><?php foreach($chapter_run as $chapter_row){ echo $chapter_row['chapter_name'];} ?></td>

                                <td><?php echo $res['topic_name']; ?></td>
                                <td><button class="btn btn-danger">
                                  <a href="deletetopic.php?id=<?php echo $res['topic_id']; ?>" class="text-white">Delete</a>
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

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title w-100 font-weight-bold">Add Course</h4>
        
      </div>
      <div class="modal-body mx-3">
       
    <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="mb-4">
          <i class="fa fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right">Course Name</label>
          <input type="text" name="name" class="form-control text-white" required>
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