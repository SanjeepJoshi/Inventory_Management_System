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
    $bname = $_POST['pbname'];
    $status = $_POST['pstatus'];

   
    if (strlen($bname) < 3) {
        $error = "Brand name must be at least 4 characters long.";
    } else {
     
        $checkSql = "SELECT * FROM brand WHERE BNAME = '$bname'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
        
            $error = "Brand name already exists. Please enter a different brand name.";
        } else {
           
            $sql = "INSERT INTO brand (BNAME, STATUS) VALUES ('$bname', '$status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('Location: brand.php');
            } else {
                $error = "Error inserting brand. Please try again.";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Brand Entry</title>
  
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
        .cbutton a {
            color: #009879;
            font-size: 18px;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            text-decoration: none;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Brand Details</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Brand Name:</label>
                <input type="text" class="form-control" placeholder="Enter Brand Name" name="pbname" required minlength="6">
            </div>
            <div class="form-group">
                <label>Status:</label>
                <input type="radio" name="pstatus" value="Active" required>Active
                <input type="radio" name="pstatus" value="Passive" required>Passive
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="brand.php">Back</a></button>
</body>
</html>
