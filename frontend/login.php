<!DOCTYPE html>
<html>
    <head>
        <title>NoteGit Login</title>
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
        <!-- navbar -->
        <nav class="navbar">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Home</a></li>
                <a href="/frontend/index.php"><img id="logo" src="/frontend/img/logo.png" alt="Logo"></a>
            </ul>
        </nav>
        <!-- login form  -->
        <div class="login">
            <h1>Login</h1>
            <div class="input"><input type="text" placeholder="Username"></div>
            <div class="input"><input type="password" placeholder="Password"></div>
            <div class="input"><input type="submit" value="Sign in"></div>
            <div class="links">
                <a href="#">Forget Password</a>
                <a href="/frontend/signup.php">New to NoteGit</a>
            </div>

        </div>
    </body>
</html>