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

if (isset($_POST['submit'])) {
    $category = $_POST['pcategory'];
    $bname = $_POST['pbname'];
    $pname = $_POST['pproduct'];
    $pmodel = $_POST['ppodel'];

  
    if (strlen($category) > 5 && strlen($bname) > 3) {
        $sql = "INSERT INTO customer (NAME, ADDRESS, MOBILE, BALANCE) VALUES ('$category', '$bname', '$pname', '$pmodel')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: customer.php');
        } else {
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
        .cbutton a{
            color: #009879;
            font-size: 18px; 
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
        <h2>Enter Customer Details</h2>
        <form method="post">
            <div class="form-group">
                <label> Name:</label>
                <input type="text" class="form-control" placeholder="Enter Customer Name" name="pcategory" required minlength="6" maxlength="30">
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" placeholder="Enter Customer Address" name="pbname" maxlength="30" required>
            </div>
            <div class="form-group">
                <label>Mobile No:</label>
                <input type="text" class="form-control" placeholder="Enter Mobile No" name="pproduct" pattern="[0-9]{10}" maxlength="10" required>
            </div>
          
            <div class="form-group">
                <label>Balance:</label>
                <input type="text" class="form-control" placeholder="Enter Balance" name="ppodel" pattern="[0-9]{1,7}" maxlength="7"   required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="customer.php">Back</a></button>
</body>
</html>
