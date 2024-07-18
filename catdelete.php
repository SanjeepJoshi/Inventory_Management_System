<?php 
include 'database/connection.php';
if(isset($_GET['catdeleteid'])){
    $id=$_GET['catdeleteid'];
    $sql="delete from category where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:category.php");
exit;

?>