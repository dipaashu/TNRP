<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>NoteGit Sign up</title>
        <meta name="description" content="A repository system for notes">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.png" />
        <link rel="stylesheet" href="./css/nav.css">
        <link rel="stylesheet" href="./css/default.css">
        <link rel="stylesheet" href="./css/lsform.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- navbar  -->
        <nav class="navbar">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Home</a></li>
                <a href="./index.php"><img id="logo" src="./img/logo.png" alt="Logo"></a>
            </ul>
        </nav>
        <!-- sign up form  -->
        <form action="signup.php" method="post">
        <div class="login">
        <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div style='color:red;'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div style='color:#eebbc3;'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
            <h1>Sign up</h1>
            <form action="signup.php">
                <div class="input"><input type="text" name="fullname" id="name"     placeholder="Full name"></div>
                <div class="input"><input type="email" name="email" id="email"  placeholder="Email"></div>
                <div class="input"><input type="password" name="password" id="password"     placeholder="Password"></div>
                <div class="input"><input type="password" name="repeat_password" id="cpass"   placeholder="Confirm password"></div>
                <div class="input"><input type="submit" name="submit" value="Create account"></div>
            </form>
            <div class="links">
                <a href="./index.php">Go to home page</a>
                <a href="./login.php">Already have an account</a>
            </div>
        </div>
        </form>

    </body>
</html>