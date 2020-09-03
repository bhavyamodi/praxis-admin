<?php 
include("security.php");
include("includes/header.php");
include("includes/navbar.php");
$id = $_GET['id'];

?>

<div class="container">

	<div class="row">
		<?php 

		$query = "SELECT * FROM class where inst_id = $id";
		$query_run = mysqli_query($connection, $query);
		$check_course = mysqli_num_rows($query_run)>0;
		if($check_course){
			while($row = mysqli_fetch_array($query_run)){
				?>
				<div class="col-md-3">
			<div class="card text-center p-3 my-3">
				<h4 clas="card-title">
					Class
				</h4>
				<p class="card-text">
                 <?php echo $row['class_name']; ?>					
				</p>
				<div class="row">
					 <div class="col-12">
            <button type="button" class="btn btn-inverse-success btn-icon">
                    <a href="viewstudent.php?id=<?php echo $row['class_id']; ?>" class="text-white"  data-toggle="tooltip" title="View Student Details"> <i class="mdi mdi-view-headline"></i></a>
                </button>
            </div>
        </div>
			
				
			</div>
			
		</div>
		<?php
			}
		}

		?>		
	</div>
	
</div>
<!-- add course modal -->

<?php 
include("includes/footer.php");
include("includes/scripts.php");

?>