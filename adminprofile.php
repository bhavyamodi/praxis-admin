<?php
 include("security.php");
include('includes/header.php'); 
include('includes/navbar.php'); 
$user=$_SESSION['admin_name'];
$query = "select * from admin where admin_name = '$user' ";
$run_query = mysqli_query($connection, $query);
$row = mysqli_fetch_array($run_query);
// print_r($row);
$id = $row['admin_id'];

            $select_query = "select * from admin";
            $select_query_run =  mysqli_query($connection, $select_query);
            $res = mysqli_fetch_array($select_query_run);

      if(isset($_POST['submit'])){
              $email = $_POST['email'];
              $mobile = $_POST['mobile'];

              $insertquery = "UPDATE `admin` SET `admin_email`='$email', `admin_mobile`='$mobile' WHERE admin_id = $id ";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("data updated");
                </script>
                <?php
              }else{
                die("Connection failed: " . mysqli_error($connection));
                ?>
                <script>
                  alert("data not updated");
                </script>
                <?php
              }
      }


$select1 = "select * from admin";
$query1 = mysqli_query($connection, $select1);
$data = mysqli_fetch_assoc($query1);

$oldpwd = $data['admin_password'];

if(isset($_POST['save'])){
  $current = $_POST['current'];
  $new = $_POST['new'];
  $confirm = $_POST['confirm'];

    if($current == $oldpwd){
      if($new == $confirm){
        $update = "update admin set admin_password = '$new' where admin_id = $id";
        $query_update = mysqli_query($connection, $update);
             if($query){
               echo "Your password changed successfully";
             }else{
               echo "Your password do not match";
             }

      }else{
        echo "you entered wrong password";
      }

    }else{
      echo "your password does not match";
    }
}


    ?>

<!-- Begin Page Content -->


  <!-- Content Row -->
 
<div class="row">
<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Update Profile <?php 
             echo $res['admin_name']; ?> </h6>
        </div>
   <div class="card-body">
   <form action="" method="post" class="form">
      <div class="form-group ">
      </div>
      <div class="form-group">
             <label for="email" class="text-white">Email</label>
             <input name="email" type="email" class="form-control" id="inputPassword2" placeholder="New Email" required>
      </div>
      <div class="form-group">
             <label for="Number" class="text-white">Mobile</label>
             <input name="mobile" type="number" class="form-control" id="inputPassword2" placeholder="New Number" required>
      </div>

             <input type="submit" value="Update" name="submit" class="btn btn-primary">
   </form>
   </div>
  </div>
</div>


  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
       <form method="post" action="">
        <div class="form-group">
        <label>Current Password</label>
        <input type="password" name="current" class="form-control">
        </div>
        <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new" class="form-control">
        </div>
        <div class="form-group ">
        <label>Confirm Password</label>
        <input type="password" name="confirm" class="form-control">
        </div>
        <input type="submit" value="change password" name="save" class="btn btn-primary">


         
       </form>
      </div>
    </div>

  </div>


</div>



   <?php
include('includes/scripts.php');
include('includes/footer.php');
?>