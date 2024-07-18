<?php 
include 'database/connection.php';
if(isset($_GET['bradeleteid'])){
    $id=$_GET['bradeleteid'];
    $sql="delete from brand where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:brand.php");

exit;

?>