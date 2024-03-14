<?php
<<<<<<< HEAD
include 'noteOperation.php';
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
// else {
//     header("Location: login.php");
// }


// Check if user is logged in
// if (!isset($_SESSION['user'])) {
//     header('Location: login.php');
//     exit();
// }

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

=======
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
else {
    header("Location: login.php");
}
?>
>>>>>>> 8024406df4231eaa76056a739a2e637f0f038936
<!DOCTYPE html>
<html>
<head>
    <title>My Notes</title>
</head>
<body>
    <h2>My Notes</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="notes" placeholder="Write your note here..." required></textarea>
        <button type="submit" name="create">Create Note</button>
    </form>

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