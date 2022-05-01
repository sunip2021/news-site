<?php
if($_SESSION['role']=='0'){
    header("Location: $hostname/admin/post.php");
}
include 'config.php';
$user_id=$_POST['user_id'];
$sql="DELETE from user where user_id='$user_id'";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location: $hostname/admin/users.php");

}else{
    echo "<p style='color:red;text-align:center;margin:10px 0'>Cannot delete the user record</p>";
}

?>