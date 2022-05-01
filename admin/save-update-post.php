<?php
include 'config.php';
if(empty($_FILES['new_image']['name'])){
    $file_name=$_POST['old_image'];
}else{
    $errors=array();
    $file_name=$_FILES['new_image']['name'];
    $file_size=$_FILES['new_image']['size'];
    $file_temp=$_FILES['new_image']['tmp_name'];
    $file_type=$_FILES['new_image']['type'];
    $a=explode('.',$file_name);
    $file_ext=end($a);

    $extension=array("jpeg","jpg","png");
    if(in_array($file_ext,$extension)===false){
        $errors[]="This extension file not allowed";

    }
    if($file_size>2097152){
        $errors[]="File size must be 2mb or lower";
    }
    
    if(empty($errors)==true){
        move_uploaded_file($file_temp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }
}
$title=$_POST['post_title'];
$post_desc=$_POST['postdesc'];
$category=$_POST['category'];
$id=$_POST['post_id'];


$sql="UPDATE post SET title='$title', description='$post_desc',category='$category' 
      WHERE post_id='$id'";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location: $hostname/admin/post.php");

}
else{
    echo 'query failed';
}


?>