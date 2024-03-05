<!DOCTYPE html>
<html>
    <head>
        <title>NoteGit Sign up</title>
        <meta name="description" content="A repository system for notes">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="/frontend/img/favicon.png" />
        <link rel="stylesheet" href="/frontend/css/nav.css">
        <link rel="stylesheet" href="/frontend/css/default.css">
        <link rel="stylesheet" href="/frontend/css/lsform.css">
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
                <a href="/frontend/index.php"><img id="logo" src="/frontend/img/logo.png" alt="Logo"></a>
            </ul>
        </nav>
        <!-- sign up form  -->
        <div class="login">
            <h1>Sign up</h1>
            <div class="input"><input type="text" placeholder="Full name"></div>
            <div class="input"><input type="text" placeholder="Username"></div>
            <div class="input"><input type="email" placeholder="Email"></div>
            <div class="input"><input type="password" placeholder="Password"></div>
            <div class="input"><input type="password" placeholder="Confirm password"></div>
            <div class="input"><input type="submit" value="Create account"></div>
            <div class="links">
                <a href="/frontend/index.php">Go to home page</a>
                <a href="/frontend/login.php">Already have an account</a>
            </div>
        </div>
    </body>
</html>