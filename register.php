<?php
if ($_POST) {
    include('database/connection.php');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        $conn->close();
    }
}
?>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin credentials for quick access
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION["un"] = $username;
        header("Location: project.php");
        exit();
    }

    // Database credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "electronic_management_system";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query securely
    $stmt = $conn->prepare("SELECT * FROM employees WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and verify password
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["un"] = $username;
            header("Location: project.php");
            exit();
        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>