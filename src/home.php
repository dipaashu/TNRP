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
$sno = 0;
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
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Note</h2>
            <form method="post">
                <input id="noteidedit" type="hidden" name="noteid" value="<?= $note['noteid'] ?>">
                <input id="titleedit" type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>
                <textarea id="notesedit" name="notes" required><?= htmlspecialchars($note['notes']) ?></textarea>
                <button type="submit" name="update">Update</button>
            </form>
        </div>

    </div>
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
    <br><br>
    <div class="mytable">
        <table id="myTable" >
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <th><?= $sno = $sno + 1 ?></th>
                        <td><?= htmlspecialchars($note['title']) ?></td>
                        <td><?= htmlspecialchars($note['notes']) ?></td>
                        <td><button class="edit" id="<?= htmlspecialchars($note['noteid']) ?>">Edit</button> <a id="delete" href="?delete=<?= $note['noteid'] ?>"><button>Delete</button></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script>
        edits = document.getElementsByClassName('edit'); 
        Array.from(edits).forEach((el)=>{
            el.addEventListener("click", (e)=>{
                    tr = e.target.parentNode.parentNode;
                    title = tr.getElementsByTagName("td")[0].innerText;
                    notes = tr.getElementsByTagName("td")[1].innerText;
                    titleedit.value = title;
                    notesedit.value = notes;
                    noteidedit.value = e.target.id;
                    $(".modal").css("display", "block");
                })
            })
        const modal = document.getElementById('myModal');
        span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>