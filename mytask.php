<?php
session_start();
include 'action/connection.php'; //koneksi ke database

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silahkan Login Terlebih Dahulu"); window.location.href = "index.php";</script>';
    exit();
}

$user_id = $_SESSION['user']['id'];

// Fetch tasks
$tasks = $conn->query("SELECT tasks.*, users.username FROM tasks JOIN users ON tasks.user_id = users.id WHERE tasks.user_id = '$user_id' ORDER BY tasks.created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="website icon" type="css" href="image/th.jpeg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        //pencarian
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#taskTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">
    <h1 class="text-center">My Tasks</h1>
    <div class="form-group">
        <input type="text" id="search" class="form-control" placeholder="Search tasks...">
    </div>
    <div class="text-center">
        <select id="sortOptions" class="form-control">
            <option value="all">Semua</option>
            <option value="completed">Selesai</option>
            <option value="sortDate">Berdasarkan Tanggal</option>
            <option value="sortAlpha">Berdasarkan Abjad</option>
        </select>
    </div>
    <script>
        // mengurutkan berdasarkan tanggal
        $(document).ready(function(){
            $("#sortOptions").on("change", function() {
                var selectedOption = $(this).val();
                if (selectedOption === "sortDate") {
                    var rows = $("#taskTable tr").get();
                    rows.sort(function(a, b) {
                        var keyA = new Date($(a).data("date"));
                        var keyB = new Date($(b).data("date"));
                        return keyA < keyB ? -1 : keyA > keyB ? 1 : 0;
                    });
                    $.each(rows, function(index, row) {
                        $("#taskTable").append(row);
                    });
                } else if (selectedOption === "sortAlpha") { //mengurutkan berdasarkan abjad
                    var rows = $("#taskTable tr").get();
                    rows.sort(function(a, b) {
                        var keyA = $(a).data("task").toLowerCase();
                        var keyB = $(b).data("task").toLowerCase();
                        return keyA < keyB ? -1 : keyA > keyB ? 1 : 0;
                    });
                    $.each(rows, function(index, row) {
                        $("#taskTable").append(row);
                    });
                } else if (selectedOption === "completed") {
                    $("#taskTable tr").filter(function() {
                        $(this).toggle($(this).find('td:eq(2)').text().toLowerCase() === 'selesai');
                    });
                } else {
                    $("#taskTable tr").show();
                }
            });
        });
    </script>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Username</th>
                <th>Tugas</th>
                <th>Status</th>
                <th>Ditambahkan Pada</th>
            </tr>
        </thead>
        <tbody id="taskTable">
            <?php while ($task = $tasks->fetch_assoc()): ?>
                <tr data-task="<?php echo htmlspecialchars($task['task']); ?>" data-date="<?php echo $task['created_at']; ?>">
                    <td><?php echo htmlspecialchars($task['username']); ?></td>
                    <td><?php echo htmlspecialchars($task['task']); ?></td>
                    <td><?php echo $task['completed'] ? 'Selesai' : 'Belum Selesai'; ?></td>
                    <td><?php echo $task['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>