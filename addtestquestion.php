<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");

$select_query = "select * from question_bank";
$select_query_run =  mysqli_query($connection, $select_query);
$nums = mysqli_num_rows($select_query_run);

?>                           
<div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                    <h4 class="card-title">Question Bank
                    <form action="">
                      <button type="button" class="btn btn-outline-success float-right " name="add_multiple_data">
                      <i class="mdi mdi-tag-plus btn-icon-prepend"></i>
                      <a href="addtestquestion.php" class="text-success">
                      <span>Add Questions to test</span>
                     </a>
                    </button>
                    </form>
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                                 <th>Add to test</th>
                                 <th>No.</th>
                            <th>topic</th>
                            <th>Question?</th>
                           
                           </tr>
                          </thead>
                          <tbody>
                            <?php
                            $count =1;
                            while($res = mysqli_fetch_array($select_query_run)){
                   
                                 $topic_id = $res['topic_id'];
                                 $topic = "SELECT * FROM topic where topic_id = $topic_id ";
                                 $topic_run = mysqli_query($connection, $topic);
                            ?>
                            <tr>
                                <td><button class="btn btn-success"><a href="add.php?id=<?php echo $res['question_bank_id'] ?>" class="text-white">ADD</a></button></td>
                                <td><?php echo $count; ?></td>
                                <td><?php foreach($topic_run as $topic_row){ echo $topic_row['topic_name'];} ?></td>
                                <td><?php echo $res['question'] ?></td>
                                
                  </tr>

                 <?php
                 $count = $count +1;
              }

              ?>      

                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
	
</div>


<?php 
include("includes/footer.php");
include("includes/scripts.php");
?>