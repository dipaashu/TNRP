<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
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
        <form action="./signup.php" method="post">
        <div class="login">
            <?php
            if (isset($_POST["submit"])) {
                $fname = $_POST["fname"];
                $uname = $_POST["uname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $repass = $_POST["repass"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = [];

                if (empty($fname) OR empty($uname) OR empty($email) OR empty($password) OR empty($repass)) {
                    $errors[] = "All fields are required";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email address";
                }
                if (strlen($password) < 8) {
                    $errors[] = "Password must be at least 8 characters";
                }
                if ($password!= $repass) {
                    $errors[] = "Passwords do not match";
                }

                require_once './db.php';
                $sql = "SELECT * FROM signup WHERE uname = '$uname'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    $errors[] = "Username already exists";
                }
                $sql = "SELECT * FROM signup WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    $errors[] = "Email already exists";
                }
                
                if(!empty($errors)) {
                    echo "<div class='error' style='color:#eebbc3; font-family: 'Anta', sans-serif;'>";
                    foreach ($errors as $error) {
                        echo $error . '<br>';
                    }
                    echo "</div>";

                }
                
                else {
                    $sql = "INSERT INTO signup (`fname`, `uname`, `email`, `password`) VALUES (?, ?, ? ,?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    // echo $sql;
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $fname, $uname, $email, $passwordHash);
                        // mysqli_stmt_execute($stmt);
                        echo "<p style='color:#fffffe;'>Account created successfully. <a href='./login.php' style='text-decoration:None;color:#eebbc3'>Login</a></p>";
                    }else{
                        echo ("Error: ".mysqli_error($conn));
                        die("Error: ".mysqli_error($conn));
                    }
                }
            }
            ?>
            <h1>Sign up</h1>
            <form action="signup.php">
                <div class="input"><input type="text" name="fname" id="name"     placeholder="Full name"></div>
                <div class="input"><input type="text" name="uname" id="uname"   placeholder="Username"></div>
                <div class="input"><input type="email" name="email" id="email"  placeholder="Email"></div>
                <div class="input"><input type="password" name="password" id="password"     placeholder="Password"></div>
                <div class="input"><input type="password" name="repass" id="cpass"   placeholder="Confirm password"></div>
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