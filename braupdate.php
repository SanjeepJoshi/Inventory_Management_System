
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
$id=$_GET['braupdateid'];
$sql="select * from brand where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$category=$row['CATEGORY'];
$bname=$row['BNAME'];

$status=$row['STATUS'];
if(isset($_POST['submit'])){

$category=$_POST['category'];
$bname=$_POST['pbname'];

$status=$_POST['pstatus'];

$sql="update brand set ID=$id,CATEGORY='$category',BNAME='$bname',STATUS='$status'  where id=$id";
 $result=mysqli_query($conn,$sql);
 if($result){
   header('location:brand.php');

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

    <title>Brand Entry Form</title>

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
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Brand Details</h2>
        <form method="post">
          

            <div class="form-group">
                <label>Brand Name:</label>
                <input type="text" class="form-control" placeholder="Enter Brand Name" name="pbname" autocomplete="off" value="<?php echo"$bname"; ?>" maxlength="20" required>
            </div>

            <div class="form-group">
                <label>Status:</label>
                <input type="radio"  name="pstatus" value="Active" required>Active
                <input type="radio"  name="pstatus" value="Passive" required>Passive
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
