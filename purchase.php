<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
}

?>
<?php
include 'database/connection.php';
include 'navigation.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<style>
    .cbutton{
       color:#009879;
       size: 0.4cm;
       position:fixed;
       bottom:20px;
       left: 50%;
       transform:translate(-50%);
       text-decoration:none;
    }
</style>
<body>
<h1 align="center">List of Purchase's Detail's</h1>
<div class="container">
  <button class="btn btn-primary my-5"><a class="text-light" href="purentry.php">Add Purchase</a> </button>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Brand_Name</th>
      <th scope="col">Product</th>
    
      <th scope="col">Quantity</th>
      <th scope="col">Supplier Name</th>
      <th scope="col">Purchase Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
 <tbody>
 <tr>
           <?php
           $query="select * from purchase";
           $result=mysqli_query($conn,$query);
             while ($row=mysqli_fetch_assoc($result)) {
                 ?>
                
                   <td><?php echo $row['ID']; ?></td>
                   <td><?php echo $row['BName']; ?></td>
                   <td><?php echo $row['PRODUCT']; ?></td>
                 
                   <td><?php echo $row['QUANTITY']; ?></td>
                   <td><?php echo $row['SUPPLIER']; ?></td>
                   <td><?php echo $row['DATE']; ?></td>
                   <?php    $d=$row['ID'];   
                    echo " <td>   
           <button class='btn btn-primary'> <a class='text-light' href='purupdate.php?purupdateid=".$d."'>Edit</a></button>
           <button class='btn btn-danger'><a class='text-light' href='purdelete.php? purdeleteid=". $d ." '>Delete</a></button>
           </td> "?>
                  
             </tr>
                <?php
             }
           ?>

  </tbody>
</table>
</div>
<button class="cbutton"><a href="dashboard.php"> Back</a></button>
</body>
</html>