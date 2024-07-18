<?php
include('database/connection.php');
session_start();
$un = $_SESSION['un'];

if (!$un) {
    header("Location:index.php");
    exit();
}

include 'navigation.php';

if (isset($_POST['submit'])) {
    $category = $_POST['pcategory'];
    $total_item = $_POST['pproduct'];
    $customer = $_POST['psname'];
    $sale_date = $_POST['sdate'];

    // Check if the total_item is greater than the quantity available
    $check_quantity_sql = "SELECT QUANTITY FROM product WHERE ID = '$category'";
    $check_quantity_result = mysqli_query($conn, $check_quantity_sql);

    if ($check_quantity_result) {
        $product = mysqli_fetch_assoc($check_quantity_result);
        $available_quantity = $product['QUANTITY'];

        if ($total_item > $available_quantity) {
            echo "<script>alert('The Total_Item should not be greater then available Product');
            
            
                window.location.href ='ordentry.php'; 
            
            
            </script>";
           
        } else {
            // Insert the sale record
            $sql = "INSERT INTO orderr (PRODUCTID, TOTAL_ITEM, CUSTOMERID, DATE) VALUES ('$category', '$total_item', '$customer', '$sale_date')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Update the product quantity
                $update_sql = "UPDATE product SET QUANTITY = QUANTITY - $total_item WHERE ID = '$category'";
                $update_result = mysqli_query($conn, $update_sql);

                if ($update_result) {
                    header('Location: sale.php');
                    exit();
                } else {
                    echo "Error updating product quantity: " . mysqli_error($conn);
                }
            } else {
                echo "Error inserting sale record: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error checking product quantity: " . mysqli_error($conn);
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport". content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <h2>Adding Sale Form</h2>
        <form method="post">
            <div class="form-group">
                <label>Product:</label>
                <select name="pcategory" class="form-control">
                    <?php
                    $cat = mysqli_query($conn, "SELECT p.ID, p.PNAME, b.BNAME FROM product AS p INNER JOIN brand AS b ON p.BRANDID = b.ID WHERE p.status = 'active'");

                    if (!$cat) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    while ($c = mysqli_fetch_assoc($cat)) {
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['PNAME']) ." (". htmlspecialchars($c['BNAME']) .")</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Total Item:</label>
                <input type="text" class="form-control" pattern="[0-9]{1,3}" maxlength="3" placeholder="Enter Total Item" name="pproduct" required>
            </div>
            <div class="form-group">
                <label>Customer:</label>
                <select name="psname" class="form-control">
                    <?php
                    $customers = mysqli_query($conn, "SELECT * FROM customer");

                    if (!$customers) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    while ($c = mysqli_fetch_assoc($customers)) {
                        echo "<option value='" . htmlspecialchars($c['ID']) . "'>" . htmlspecialchars($c['NAME']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Sale Date:</label>
                <input type="date" class="form-control" name="sdate" min="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" max="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <button class="cbutton"><a href="sale.php"> Back</a></button>
</body>
</html>

<?php
$conn->close();
?>
