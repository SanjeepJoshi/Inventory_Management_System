<?php 
include 'database/connection.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="delete from product where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:product.php");
exit;

?>