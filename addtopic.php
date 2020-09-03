<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];
$query = "SELECT * FROM chapter WHERE chapter_id= $id";
$run = mysqli_query($connection,$query);
$res = mysqli_fetch_array($run);
$c_id = $res['course_id'];



if(isset($_POST['submit'])){
$name = $_POST['name'];

$query_insert = " insert into topic (course_id, chapter_id, topic_name) values ('$c_id','$id','$name')";

$run = mysqli_query($connection, $query_insert);
if($run){
 echo '<script>alert("topic added succesfully")</script>';

}
else{
echo die("Connection failed: " . mysqli_error($connection));
}
}
?>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
          <div class="card-body">
          <h4 class="card-title">Add Topic in <?php echo $res['chapter_name']; ?>
            <button type="button" class="btn btn-primary float-right">
                                    <a href="addchapter.php?id=<?php echo $c_id; ?>" class="text-white">Back</a>
                                    </button>
          </h4>
          <div class="form-group">
           <form action="" method="post" class="wow fadeInUp" data-wow-delay="0.2s">
             <div class="mb-4">
                 <i class="fa fa-envelope prefix grey-text"></i>
                 <label data-error="wrong" data-success="right">Topic Name</label>
                 <input type="text" name="name" class="form-control text-white" required>
             </div>
             <br>
             <div class="mb-4">
                 <input type="submit"name="submit" class="form-control btn btn-primary" value="ADD">
             </div>
           </form>
         </div>
         </div>
    </div>          
  </div>
   <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Topics in <?php echo $res['chapter_name']; ?> </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                  
                            <th>Topic Name</th>
                            <th>Add Question</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php  
                              $select_query = "select * from topic where chapter_id=$id  ";
                              $select_query_run =  mysqli_query($connection, $select_query);
                              $nums = mysqli_num_rows($select_query_run);
                             while($res = mysqli_fetch_array($select_query_run))
                              { 
                              ?>
                              <tr>
                                <td><?php echo $res['topic_name']; ?></td>
                                <td>
                                   <button type="button" class="btn btn-success">
                                    <a href="addquestion.php?id=<?php echo $res['topic_id']; ?>" class="text-white"  data-toggle="tooltip" title="Add Question">
                                    Add Question
                                    </a>
                                  </button>

                                </td>

                                <td> 
                                  <button type="button" class="btn btn-danger">
                                    <a href="deletetopic.php?id=<?php echo $res['topic_id']; ?>" class="text-white"  data-toggle="tooltip" title="Delete Topic">
                                    Delete
                                    </a>
                                  </button>
                                </td>
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