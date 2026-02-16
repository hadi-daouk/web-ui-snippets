

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
    <script>
      function validateForm() {
          var username = document.getElementById("username").value;
          var email = document.getElementById("email").value;
          var password = document.getElementById("password").value;

          if (username === "" || email === "" || password === "") {
              alert("All fields are required.");
              return false;
          }
          return true;
      }
  </script>
    
  
</head>
<body>
 
    <div class="ring">
        <i style="--clr:#f1faf1;"></i>
        <i style="--clr:#070707;"></i>
        <i style="--clr:#818031;"></i>
        <div class="login">
          <h2>Register</h2>
         
          <div class="inputBx">
            <form id="register" action="register.php" method="post">
            <input type="text" placeholder="username" name="username" id="username" required>
          </div>
          <div class="inputBx">
            <input type="email" name="email" placeholder="Email" name="Email" id="email" required>
          </div>
          <div class="inputBx">
            <input type="password" placeholder="Password" name="password" id="password" minlength="8">
          </div>
          <div class="inputBx">
            <input type="password" placeholder="confirmpassword" minlength="8" required>
            </div>
          <div class="inputBx">
            <input type="submit" value="register" name="register" >
        </form>
          </div>
          
    
</body>
</html>









<?php
session_start();

    $host = 'localhost';
        $dbname = 'project';
        $username = 'test1';
        $password = 'Xv00sydb/VpEC0Pg';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function isUserExists($pdo, $username, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    return $stmt->fetch();
}


function registerUser($pdo, $username, $password, $email) {
    if (isUserExists($pdo, $username, $email)) {
        $_SESSION['error_message'] = "Username or email already exists.";
        return false;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
    $success = $stmt->execute([$username, $hashed_password, $email]);

    if ($success) {
        
        header("Location: loginpage.html");
        exit; 
    } else {
        
        $_SESSION['error_message'] = "Registration failed. Please try again.";
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $new_email = $_POST['email'];

   
    if (registerUser($pdo, $new_username, $new_password, $new_email)) {
       
        header("Location: loginpage.html");
        exit; 
    }
}
if (isset($_SESSION['error_message'])) {
    echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']); 
}
?>
