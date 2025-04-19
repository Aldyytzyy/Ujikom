<?php
session_start();
include 'action/connection.php'; 

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "index.php";</script>';
    exit();
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['task'])) {
        $task = $conn->real_escape_string($_POST['task']);
        
        // Cek jika tugas sudah ada
        $checkTaskSql = "SELECT * FROM tasks WHERE user_id = '$user_id' AND task = '$task'";
        $checkTaskResult = $conn->query($checkTaskSql);
        
        if ($checkTaskResult->num_rows > 0) {
            echo '<script>alert("Tugas sudah ada"); window.location.href = "task.php";</script>';
        } else {
            $conn->query("INSERT INTO tasks (user_id, task, completed) VALUES ('$user_id', '$task', 0)");
        }
    } elseif (isset($_POST['complete'])) {
        $task_id = (int)$_POST['complete'];
        $conn->query("UPDATE tasks SET completed = 1 WHERE id = '$task_id' AND user_id = '$user_id'");
    } elseif (isset($_POST['uncomplete'])) {
        $task_id = (int)$_POST['uncomplete'];
        $conn->query("UPDATE tasks SET completed = 0 WHERE id = '$task_id' AND user_id = '$user_id'");
    } elseif (isset($_POST['delete'])) {
        $task_id = (int)$_POST['delete'];
        $conn->query("DELETE FROM tasks WHERE id = '$task_id' AND user_id = '$user_id'");
    } elseif (isset($_POST['edit_id']) && isset($_POST['edit_task'])) {
        $edit_id = (int)$_POST['edit_id'];
        $edit_task = $conn->real_escape_string($_POST['edit_task']);
        $conn->query("UPDATE tasks SET task = '$edit_task' WHERE id = '$edit_id' AND user_id = '$user_id'");
    }
}

$tasks = $conn->query("SELECT * FROM tasks WHERE user_id = '$user_id'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="website icon" type="css" href="image/th.jpeg">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h1 class="text-center">To-Do List</h1>
    <form method="post" class="form-inline text-center">
        <div class="form-group">
            <input type="text" name="task" class="form-control" placeholder="New task" required>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    <ul class="list-group mt-3">
        <?php while ($task = $tasks->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <form method="post" style="display:inline;">
                    <?php if ($task['completed']): ?>
                        <input type="hidden" name="uncomplete" value="<?php echo $task['id']; ?>">
                        <button type="submit" class="btn btn-warning btn-sm">Belum</button>
                    <?php else: ?>
                        <input type="hidden" name="complete" value="<?php echo $task['id']; ?>">
                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                    <?php endif; ?>
                </form>
                <span><?php echo htmlspecialchars($task['task']); ?></span>
                <?php if ($task['completed']) echo '<span class="badge badge-success">Completed</span>'; ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="delete" value="<?php echo $task['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?php echo $task['id']; ?>">Edit</button>
            </li>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $task['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $task['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?php echo $task['id']; ?>">Edit Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <input type="hidden" name="edit_id" value="<?php echo $task['id']; ?>">
                                <div class="form-group">
                                    <label for="task">Task</label>
                                    <input type="text" name="edit_task" class="form-control" value="<?php echo htmlspecialchars($task['task']); ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>