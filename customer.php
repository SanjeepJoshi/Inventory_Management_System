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
$search = $_POST['search'] ?? ''; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .cbutton a{
            color: #009879;
            font-size: 18px; 
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%);
            text-decoration: none;
        }
        .btn a {
            color: #fff; 
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <h1 align="center">List of Customer's Details</h1>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="cusentry.php">Add Customer</a></button>
        <form method="POST" class="form-inline mb-4">
            <input class="form-control mr-sm-2" type="search" placeholder="Search by Name" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($search) {
                    $query = "SELECT * FROM customer WHERE NAME LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
                } else {
                    $query = "SELECT * FROM customer";
                }
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ADDRESS']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['MOBILE']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['BALANCE']) . "</td>";
                    echo "<td>
                        <button class='btn btn-primary'><a href='cupdate.php?id=" . htmlspecialchars($row['ID']) . "'>Edit</a></button>
                        <button class='btn btn-danger'><a href='cdelete.php?cusdeleteid=" . htmlspecialchars($row['ID']) . "'>Delete</a></button>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <button class="cbutton"><a href="dashboard.php">Back</a></button>
</body>
</html>
