<?PHP
include 'database/connection.php';
include 'navigation.php';
$id=$_GET['updateid'];
$sql="select * from product where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$category=$row['CATEGORYID'];
$bname=$row['BRANDID'];
$pname=$row['PNAME'];
$pmodel=$row['PMODEL'];
$quantit=$row['QUANTITY'];
$sname=$row['SUPPLIERID'];
$status=$row['STATUS'];

if(isset($_POST['submit'])){
    
    $category=$_POST['pcategory'];
    $bname=$_POST['pbname'];
    $pname=$_POST['pproduct'];
    $pmodel=$_POST['ppodel'];
    $quantit=$_POST['pquantity'];
    $sname=$_POST['psname'];
    $status=$_POST['pstatus'];
    
    if (strlen($pname) > 3 && strlen($pmodel) > 3) {
$sql="update product set ID=$id,CATEGORYID='$category',BRANDID='$bname',PNAME='$pname',PMODEL='$pmodel',QUANTITY='$quantit',
SUPPLIERID='$sname',STATUS='$status'  where id=$id";
 $result=mysqli_query($conn,$sql);
 if($result){
   header('location:product.php');

 }else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
        alert('Color Name and Product model should be valid');
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
    <title>Product Entry</title>
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
        <h2>Enter Product Details</h2>
        <form method="post">
            <!-- Category selection -->
            <div class="form-group">
                <label>Category:</label>
                <select name="pcategory" class="form-control" autocomplete="off" value="<?php echo"$category"; ?>">
                    <?php
                    $cat = mysqli_query($conn, "SELECT * FROM category where status='active'");
                    while($c = mysqli_fetch_array($cat)) {
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['CATEGORY']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Brand selection -->
            <div class="form-group">
                <label>Brand:</label>
                <select name="pbname" class="form-control" autocomplete="off" value="<?php echo"$bname"; ?>">
                    <?php
                    $brands = mysqli_query($conn, "SELECT * FROM brand where status='active'");
                    while($b = mysqli_fetch_array($brands)) {
                        echo "<option value='" . htmlspecialchars($b['ID']) . "'>" . htmlspecialchars($b['BNAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Additional fields for product details -->
            <div class="form-group">
                <label>Product Name:</label>
                <input type="text" class="form-control" placeholder="Enter Product Name" name="pproduct" autocomplete="off" maxlength="20" value="<?php echo"$pname"; ?>" required>
            </div>
            <div class="form-group">
                <label>Product Model:</label>
                <input type="text" class="form-control" placeholder="Enter Product Model" name="ppodel" required autocomplete="off" maxlength="10" value="<?php echo"$pmodel"; ?>">
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="text" class="form-control" placeholder="Enter Quantity" name="pquantity"autocomplete="off" pattern="[0-9]{1,3}" maxlength="3"  value="<?php echo"$quantit"; ?>" required>
            </div>
            <div class="form-group">
                <label>Supplier:</label>
                <select name="psname" class="form-control" autocomplete="off" value="<?php echo"$sname"; ?>">
                    <?php
                    $suppliers = mysqli_query($conn, "SELECT * FROM supplier where status='active'");
                    while($s = mysqli_fetch_array($suppliers)) {
                        echo "<option value='" . htmlspecialchars($s['ID']) . "'>" . htmlspecialchars($s['NAME']) . "</option>";
                    }
                    ?>
                </select>
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