 <?php
// Step 1: Connect to the database
include "connect.php"; // contains $conn

// Step 2: Delete functionality
if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to refresh the page
    header("Location: students.php");
    exit;
}

// Step 3: Fetch data from students table
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Error check
if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // shows real reason
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #f2f2f2; }
        .delete-btn { color: red; cursor: pointer; }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location = "students.php?delete_id=" + id;
            }
        }
    </script>
</head>
<body>

<h2 style="text-align: center;">Student List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course']) ?></td>
                <td>
                    <span class="delete-btn" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</span>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No records found.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
