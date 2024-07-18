
<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
}

?><?PHP
include 'database/connection.php';
include 'navigation.php';
$id=$_GET['id'];
$sql="select * from customer where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['NAME'];
$address=$row['ADDRESS'];
$mobile=$row['MOBILE'];
$balance=$row['BALANCE'];

if(isset($_POST['submit'])){

$name=$_POST['pcategory'];
$address=$_POST['pbname'];
$mobile=$_POST['pproduct'];
$balance=$_POST['ppodel'];

 if (strlen($name) > 5 && strlen($address) > 3) {
$sql="update customer set ID=$id, NAME='$name',ADDRESS='$address',MOBILE='$mobile',BALANCE='$balance'  where id=$id";
 $result=mysqli_query($conn,$sql);
 if($result){
   header('location:customer.php');

 }else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
        alert('Name and address should be greater than 5 words');
        </script> ";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Product Entry</title>
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
        <h2>Enter Customer Details</h2>
        <form method="post">
         
            <div class="form-group">
                <label> Name:</label>
                <input type="text" class="form-control"  placeholder="Enter Customer Name" name="pcategory" minlength="5" autocomplete="off" value="<?php echo"$name"; ?>"required maxlength="20">
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" maxlength="30" placeholder="Enter Customer Address" name="pbname" minlength="3" autocomplete="off" value="<?php echo"$address"; ?>"  required>
            </div>
            <div class="form-group">
                <label>Mobile No:</label>
                <input type="text" class="form-control" maxlength="10" pattern="[0-9]{10}" maxlength="10"  placeholder="Enter Mobile No" name="pproduct" autocomplete="off" value="<?php echo"$mobile"; ?>" required>
            </div>
          
            <div class="form-group">
                <label>Balance:</label>
                <input type="text" class="form-control"  maxlength="7" pattern="[0-9]{1,7}"  placeholder="Enter Balance" name="ppodel" autocomplete="off" value="<?php echo"$balance"; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>