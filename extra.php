<?php
require_once('database/connection.php');
$query="select * from customer";
$result=mysqli_query($conn,$query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<style>
    body{
        background-color:rgba(33,179, 162, 0.4)
    }
  .content-table {
        width:;
        border-collapse: collapse;
        margin-top: 4   0px;
        margin-left: 20px;
        font-size: 0.5cm;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        background-color: #009879;
        font-weight: bold;
    }
    th {
        background-color: #f2f2f2;
    }
    .detail{
        color: #009879;
        font-size: 0.8cm;
        font-weight:bold ;
        margin-left:100px;
    }
    .cbutton{
       color:#009879;
       size: 0.4cm;
       position:fixed;
       bottom:20px;
       left: 50%;
       transform:translate(-50%);
       text-decoration:none;
    }
    
 a{
    text-decoration:none;
    color: #009879;
    display: block;
    font-size: 20px;
    padding: 0px 0px 0px 0px;
 }
 .form{
    margin-right: 200px;
    
 }
.newcus{
    color: #009879;
        font-size: 0.8cm;
        font-weight:bold ;
        margin-right:100px;
        float:right;
        margin-top:-70px ;
}

    
</style>
</head>
<body>
    <p class="detail">Details list of Customers</p>
    <p class="newcus ">Entry for new Customer</p>
    <table align="left" class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
           <tr>
           <?php
             while ($row=mysqli_fetch_assoc($result)) {
                ?>
                   <td><?php echo $row['ID']; ?></td>
                   <td><?php echo $row['NAME']; ?></td>
                   <td><?php echo $row['ADDRESS']; ?></td>
                   <td><?php echo $row['MOBILE']; ?></td>
                   <td><?php echo $row['BALANCE']; ?></td>
                   <?php $d=$row['ID'];  echo "<td>
           <button class='btn btn-primary'> <a class='text-light' href='cupdate.php? cid=".$d. "'>Edit</a></button>
           <button class='btn btn-danger'><a class='text-light' href='cdelete.php? did=".$d. "'>Delete</a></button>
          </td>"?>
             </tr>
                <?php
             }
           ?>
             
        </tbody>
    </table>
        <div class="form">

            <form action="connect.php" align="right" method="post">
                  <div class="cName">
                      <label for="cName">Name :</label>
                      <input type="text" placeholder="Enter the name" name="cname" required>
                  </div>
                  <div class="cAdress">
                      <label for="cAdress">Address :</label>
                      <input type="text" placeholder="Enter the Address" name="caddress" required>
                  </div>
                  <div class="cMobile">
                      <label for="cMobile">Mobile no :</label>
                      <input type="number" placeholder="Enter the Mobile no" name="cmobile" required>
                  </div>
                  <div class="cBalance">
                      <label for="cbalance">Balance :</label>
                      <input type="number" placeholder="Enter the Balance" name="cbalance" required>
                  </div>
                  <div class="cSubmit">
               
                <input type="submit" placeholder="Click to enter data!!">
            </div>
        </div>
          



      </form>
      <button class="cbutton"><a href="dashboard.php"> Back</a></button>
     
</body>
</html>




<?php
// include('database/connection.php');

// if ($_POST) {
    
//     $new_password = $_POST['new_password'];
//     $confirm_password = $_POST['confirm_password'];


//     // Check if new password and confirm password match
//     if ($new_password === $confirm_password) {
//         // Hash the new password
//         // $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

//         // Update the password in the database
//         $query = "UPDATE users SET password='$new_password' ";
//         if (mysqli_query($conn, $query)) {
//             echo '<script>
//             alert("Password reset successful!");
//             window.location.href = "index.php";
//             </script>';
//         } else {
//             echo '<script>
//             alert("Error updating password. Please try again.");
//             window.location.href = "index.php";
//             </script>';
//         }
//     } else {
//         echo '<script>
//         alert("Passwords do not match. Please try again.");
//         window.location.href = "index.php";
//         </script>';
//     }

//     $conn->close();
// }
// ?>
  function showForgotPasswordForm() {
            var modal = document.getElementById("forgotPasswordModal");
            modal.style.display = "block";
        }

        function closeForgotPasswordForm() {
            var modal = document.getElementById("forgotPasswordModal");
            modal.style.display = "none";
        }

        function validateForgotPasswordForm() {
            var newPassword = document.forms["forgotPasswordForm"]["new_password"].value;
            var confirmPassword = document.forms["forgotPasswordForm"]["confirm_password"].value;
            if (newPassword === "" || confirmPassword === "") {
                alert("New Password and Confirm Password fields cannot be empty!");
                return false;
            }
            if (newPassword !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }

        // Close the modal if the user clicks anywhere outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("forgotPasswordModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        <?php 
                    // include 'database/connection.php';
                    // $cat = mysqli_query($conn, "SELECT * FROM category");
                    // while($c = mysqli_fetch_array($cat)) {
                    // ?>
                    <option value="<?php echo $c['CATEGORY']; ?>"><?php echo $c['CATEGORY']; ?></option>
                    <?php } ?>  <div class="form-group">
                <label>Category:</label>
                <select name="category" class="form-control" autocomplete="off" value="<?php echo"$category"; ?>">
                    <?php 
                    include 'database/connection.php';
                    $cat = mysqli_query($conn, "SELECT * FROM category");
                    while($c = mysqli_fetch_array($cat)) {
                    ?>
                    <option value="<?php echo $c['CATEGORY']; ?>"><?php echo $c['CATEGORY']; ?></option>
                    <?php } ?>
                </select>
            </div>
              <!-- <div class="form-group">
                <label>Category:</label>
                <select name="category" class="form-control">
                  
                </select>
            </div> -->
            <button class='btn btn-primary'><a href='braupdate.php?braupdateid=" . htmlspecialchars($row['ID']) . "'>Edit</a></button>