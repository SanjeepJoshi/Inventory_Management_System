<?php 
include 'database/connection.php';
if(isset($_GET['cusdeleteid'])){
    $id=$_GET['cusdeleteid'];
    $sql="delete from customer where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:customer.php");
exit;

?>