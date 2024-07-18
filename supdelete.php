<?php 
include 'database/connection.php';
if(isset($_GET['supdeleteid'])){
    $id=$_GET['supdeleteid'];
    $sql="delete from supplier where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:supplier.php");
exit;

?>