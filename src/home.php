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
    <?php foreach ($notes as $note): ?>
        <div>
            <h3><?= htmlspecialchars($note['title']) ?></h3>
            <p><?= htmlspecialchars($note['notes']) ?></p>
            <form method="post">
                <input type="hidden" name="noteid" value="<?= $note['noteid'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>
                <textarea name="notes" required><?= htmlspecialchars($note['notes']) ?></textarea>
                <button type="submit" name="update">Update</button>
            </form>
            <a href="?delete=<?= $note['noteid'] ?>">Delete</a>
        </div>
    <?php endforeach; ?>
</body>
</html>