<?php 
include("database/dbconfig.php");

if(isset($_POST['submit'])){
$name = $_POST['name'];

$query_insert = " insert into course (course_name) values ('$name')";

$run = mysqli_query($connection, $query_insert);
if($run){
header ("Location:courses.php");
}
else{
die("Connection failed: " . mysqli_error($connection));
}
}
?>