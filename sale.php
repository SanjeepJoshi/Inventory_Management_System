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
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<style>
    .cbutton a{
       color:#009879;
       size: 0.4cm;
       position:fixed;
       bottom:20px;
       left: 50%;
       transform:translate(-50%);
       text-decoration:none;
    }
    .btn a {
            color: #fff; 
            text-decoration: none; 
        }
</style>
<body>
<h1 align="center">List of Sales</h1>
<div class="container">
  <button class="btn btn-primary my-5"><a class="text-light" href="ordentry.php">Add Sale</a> </button>

  <!-- Search form -->
  <form method="POST" class="form-inline mb-4">
            <input class="form-control mr-sm-2" type="search" placeholder="Search by Name" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Brand Name</th>
      <th scope="col">Product Name</th>
      <th scope="col">Total Item</th>
      <th scope="col">Customer</th>
      <th scope="col">Sale Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
 <tbody>
  <?php
                if ($search) {
                    // Query to search in the name field
                    $query = "SELECT o.ID,b.BNAME,p.PNAME,o.TOTAL_ITEM,c.NAME,o.DATE FROM orderr as o inner join product as p on p.ID=o.PRODUCTID inner join brand as b on b.ID=p.BRANDID inner join customer as c on o.CUSTOMERID=c.ID WHERE c.NAME LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
                } else {
                    // Default query to load all suppliers
                    $query = "SELECT o.ID,b.BNAME,p.PNAME,o.TOTAL_ITEM,c.NAME,o.DATE FROM orderr as o inner join product as p on p.ID=o.PRODUCTID inner join brand as b on b.ID=p.BRANDID inner join customer as c on o.CUSTOMERID=c.ID";
                }
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['BNAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PNAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['TOTAL_ITEM']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NAME']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DATE']) . "</td>";
                    echo "<td>
                        <button class='btn btn-primary'><a href='ordupdate.php?ordupdateid=" . htmlspecialchars($row['ID']) . "'>Edit</a></button>
                        <button class='btn btn-danger'><a href='orddelete.php?orddeleteid=" . htmlspecialchars($row['ID']) . "'>Delete</a></button>
                    </td>";
                    echo "</tr>";
                }
                ?>

  </tbody>
</table>
</div>
<button class="cbutton"><a href="dashboard.php"> Back</a></button>
</body>
</html>