<?php
include('database/connection.php');

if ($_POST) {
    
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email']; 

    // Check if new password and confirm password match
    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        
        $query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        if (mysqli_query($conn, $query)) {
            echo '<script>
            alert("Password reset successful!");
            window.location.href = "index.php";
            </script>';
        } else {
            echo '<script>
            alert("Error updating password. Please try again.");
            window.location.href = "index.php";
            </script>';
        }
    } else {
        echo '<script>
        alert("Passwords do not match. Please try again.");
        window.location.href = "index.php";
        </script>';
    }

    $conn->close();
}
?>
