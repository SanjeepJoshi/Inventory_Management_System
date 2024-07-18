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


$id=$_GET['ordupdateid'];
$sql="select * from orderr where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$category=$row['PRODUCTID'];

// $BNamee=$row['BName'];
$bname=$row['TOTAL_ITEM'];
$pname=$row['CUSTOMERID'];
$sdate=$row['DATE'];
if(isset($_POST['submit'])){
    // $BNamee=$_POST['bname'];
$category=$_POST['pcategory'];
$bname=$_POST['pbname'];
$pname=$_POST['psname'];
$sdate=$_POST['sdate'];

// $check_quantity_sql = "SELECT QUANTITY FROM product WHERE ID = '$category'";
// $check_quantity_result = mysqli_query($conn, $check_quantity_sql);
// if ($check_quantity_result) {
//     $product = mysqli_fetch_assoc($check_quantity_result);
//     $available_quantity = $product['QUANTITY'] + $total_item; // Add previous total_item back to available quantity

//     if ($bname> $available_quantity) {
//         echo "<script>
//             alert('Error: The total items sold cannot exceed the available quantity.');
//             window.location.href = 'ordupdate.php';
//         </script>";
//     } else {
$sql="update orderr set ID=$id,PRODUCTID='$category',TOTAL_ITEM='$bname',CUSTOMERID='$pname',DATE='$sdate' where id=$id";
 $result=mysqli_query($conn,$sql);
 if($result){
     $update_sql = "UPDATE product SET QUANTITY = QUANTITY - $bname WHERE ID = '$category'  ";
    $update_result = mysqli_query($conn, $update_sql);
    if($update_result){
        header('Location: sale.php');
    } else {
        echo "Error updating product quantity: " . mysqli_error($conn);
    }
} else {
    echo "Error inserting purchase record: " . mysqli_error($conn);
}
 
 $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title></title>
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
        <h2>Sale Update</h2>
        <form method="post">
            <div class="form-group">
                <label>Product:</label>
                <select name="pcategory" class="form-control" autocomplete="off" value="<?php echo"$category"; ?>">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT p.ID,p.PNAME, b.BNAME FROM product AS p INNER JOIN brand AS b ON p.BRANDID = b.ID WHERE p.status = 'active'");
                    while($c = mysqli_fetch_array($cat)){
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['PNAME']) ." (". htmlspecialchars($c['BNAME']) . ")</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- <div class="form-group">
                <label>Brand_Name:</label>
                <select name="bname" class="form-control">
                    <?php 
                    // include 'database/connection.php';
                    // $cat = mysqli_query($conn, "SELECT * FROM brand where status='active'");
                    // while($c = mysqli_fetch_array($cat)){
                    //     echo "<option value='" . htmlspecialchars($c['BNAME']) . "'>" . htmlspecialchars($c['BNAME']) . "</option>";
                    // }
                    ?>
                </select>
            </div> -->
            <div class="form-group">
                <label>Total Item:</label>
                <input type="text" class="form-control"pattern="[0-9]{1,3}" maxlength="3"  placeholder="Enter Total Item" name="pbname" autocomplete="off" value="<?php echo"$bname"; ?>" required>
            </div>
            <div class="form-group">
                <label>Customer:</label>
                <select name="psname" class="form-control" autocomplete="off" value="<?php echo"$pname"; ?>">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT * FROM customer");
                    while($c = mysqli_fetch_array($cat)){
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['NAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Sale Date:</label>
                <input type="date" class="form-control" name="sdate" value="<?php echo"$sdate" ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>