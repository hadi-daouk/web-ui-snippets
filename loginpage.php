<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $host = 'localhost';
        $dbname = 'project';
        $db_username = 'test1';
        $db_password = 'Xv00sydb/VpEC0Pg';

        $conn = mysqli_connect($host, $db_username, $db_password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header("Location: main.html");
                exit();
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "User not found. Please try again.";
            header("Location: test.php");
        }

        mysqli_close($conn);
    } else {
        $error_message = "Username and password are required.";
    }
}
if ($login_successful) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    header("Location: main.html");
    exit();
} else {
    header("Location: loginpage.html?error=incorrect_credentials");
    exit();
}

?>
