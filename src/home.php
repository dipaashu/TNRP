<?php
include 'noteOperation.php';
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$userId = $_SESSION['user'];
$noteOps = new NoteOperations($conn);

// Handle create note request
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['notes'];
    $noteOps->createNote($userId, $title, $content);
}

// Handle update note request
if (isset($_POST['update'])) {
    $noteId = $_POST['noteid'];
    $title = $_POST['title'];
    $content = $_POST['notes'];
    $noteOps->updateNote($noteId, $userId, $title, $content);
}

// Handle delete note request
if (isset($_GET['delete'])) {
    $noteId = $_GET['delete'];
    $noteOps->deleteNote($noteId, $userId);
    header('Location: home.php'); // Prevent form resubmission
}

$notes = $noteOps->readNotes($userId);
?>


<!DOCTYPE html>
<html>
<head>
    <title>My Notes</title>
    <meta name="description" content="A repository system for notes">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.png" />
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anta&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">

</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="index.php">Home</a></li>
            <a href="./index.php"><img id="logo" src="./img/logo.png" alt="Logo"></a>
        </ul>
    </nav>
    <div class="create-note">
        <h2>My Notes</h2>
        <form class="add" method="post">
            <div class="create"><input type="text" name="title" placeholder="Title" required></div>
            <div class="create"><textarea name="notes" placeholder="Write your note here..." required></textarea></div>
            <div class="create"><input id="create-submit" type="submit" name="create" value="Create"></div>
        </form>
    </div>
    <div>
        <table id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sl. No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <th scope='row'><?= htmlspecialchars($note['noteid']) ?></th>
                        <td><?= htmlspecialchars($note['title']) ?></td>
                        <td><?= htmlspecialchars($note['notes']) ?></td>
                        <td>Actions</td>
                    </tr>";
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>
</html>