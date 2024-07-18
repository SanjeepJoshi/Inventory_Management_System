<?php
session_start();

if (isset($_POST['submit'])) {
    include('database/connection.php');

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verify hashed password
            if (password_verify($password, $row['password'])) {
                $_SESSION["un"] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                // Incorrect password
                echo '<script>
                window.location.href ="index.php"; 
                alert("Login failed !!!! Please enter correct email and password");
                </script>';
                exit();
            }
        } else {
            // User not found
            echo '<script>
            window.location.href ="index.php"; 
            alert("Login failed !!!! Please enter correct email and password");
            </script>';
            exit();
        }

        $stmt->close();
        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <style>

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            position: relative;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body id="login">
    <div class="container">
        <div class="loginheader">
            <h1>Inventory Management System of Laxmi Hardware and Paint Shop</h1>
        </div>
        <div class="loginbody" id="form">
            <form action="" onsubmit="return isValid()" method="POST" name="loginForm">
                <div class="logininputcontainer">
                    <label for="username">Username</label>
                    <input type="text" placeholder="USERNAME" name="username" maxlength="20" autocomplete="off">
                </div>
                <div class="logininputcontainer">
                    <label for="password">Password</label>
                    <input type="password" placeholder="PASSWORD" name="password" maxlength="20" autocomplete="off">
                </div>
                <div class="loginbuttoncontainer">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form> -->


    
    <script>
        function isValid() {
            var user = document.forms["loginForm"]["username"].value;
            var pass = document.forms["loginForm"]["password"].value;
            if (user === "" && pass === "") {
                alert("Username and password are empty!!!");
                return false;
            }
            if (user === "") {
                alert("Username is empty!!!");
                return false;
            }
            if (pass === "") {
                alert("Password is empty!!!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
<?php

?>
