<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
}

?>
<?PHP
include 'database/connection.php';
include 'navigation.php';
if(isset($_POST['submit'])){

$category=$_POST['sname'];
$bname=$_POST['smobile'];
$pname=$_POST['saddress'];

$status=$_POST['pstatus'];

  if (strlen($category) > 5 && strlen($pname) > 3) {
$sql="insert into supplier (NAME,MOBILE,ADDRESS,STATUS)
 values('$category','$bname','$pname','$status')";
 $result=mysqli_query($conn,$sql);
 if($result){
   header('location:supplier.php');
 }else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
        alert('Name and address should be valid');
        </script> ";
    }



}
?>







<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Registration Form</title>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #666;
        }
        .form-group input, .form-group select {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-primary:hover {
            background-color: #004085;
            border-color: #003566;
        }
        .cbutton a{
            color: #009879;
            font-size: 18px; /* Adjusted from 'size' to 'font-size' */
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Supplier Registration Form</h2>
        <form method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Enter name" name="sname"  maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Mobile no:</label>
                <input type="text" class="form-control" placeholder="Enter Mobile number" name="smobile"pattern="[0-9]{10}" maxlength="10"  required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" placeholder="Enter Address" maxlength="20" name="saddress" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <input type="radio"  name="pstatus" value="Active" required>Active
                <input type="radio"  name="pstatus" value="Passive" required>Passive
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="supplier.php">Back</a></button>
</body>
</html>
