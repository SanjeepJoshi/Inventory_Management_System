
<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
}

?><?php
include 'database/connection.php';
include 'navigation.php';

if (isset($_POST['submit'])) {
    $category = $_POST['pcategory'];
    $status = $_POST['pstatus'];

   
    if (strlen($category) < 6) {
        $error = "Category must be at least 6 characters long.";
    } else {
       
        $checkSql = "SELECT * FROM category WHERE CATEGORY = '$category'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
       
            $error = "Category already exists. Please enter a different category.";
        } else {
          
            $sql = "INSERT INTO category (CATEGORY, STATUS) VALUES ('$category', '$status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('Location: category.php');
            } else {
                $error = "Error inserting category. Please try again.";
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
    <title>Category Entry</title>
   
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
        <h2>Enter Category Details</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label>Category:</label>
                <input type="text" class="form-control" placeholder="Enter Category" name="pcategory" required minlength="6">
            </div>
            <div class="form-group">
                <label>Status:</label>
                <input type="radio" name="pstatus" value="Active" required>Active
                <input type="radio" name="pstatus" value="Passive" required>Passive
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="category.php">Back</a></button>
</body>
</html>
