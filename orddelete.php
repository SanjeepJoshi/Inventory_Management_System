<?php 
include 'database/connection.php';
if(isset($_GET['orddeleteid'])){
    $id=$_GET['orddeleteid'];
    $sql="delete from orderr where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:sale.php");
exit;

?>