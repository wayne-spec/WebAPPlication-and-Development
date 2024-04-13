<?php 
$Hostel_id='';
include("../config/config.php");

if(isset($_POST['delete_Hostel'])){
	delete_Hostel();
}


function delete_Hostel(){
	global $db,$Hostel_id;
		
$Hostel_id=$_POST['Hostel_id'];

$sql="DELETE from Hostel_photo where Hostel_id='$Hostel_id'";
$query=mysqli_query($db,$sql);

if($query){
	$sql2="DELETE from review where Hostel_id='$Hostel_id'";
$query2=mysqli_query($db,$sql2);

$sql3="DELETE from add_Hostel where Hostel_id='$Hostel_id'";
$query3=mysqli_query($db,$sql3);
if($query3){
			
?>

<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
	window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <center><strong>Your Product has been deleted.</strong></center>
</div></div>


<?php

}
}}


 ?>