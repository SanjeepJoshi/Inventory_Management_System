<?php 
include 'database/connection.php';
if(isset($_GET['purdeleteid'])){
    $id=$_GET['purdeleteid'];
    $sql="delete from purchase where id=$id";
    $result=mysqli_query($conn,$sql);

}
header("location:purchase.php");
exit;

?>