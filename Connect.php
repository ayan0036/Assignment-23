 <?php
$conn = mysqli_connect("localhost", "root", "", "webteam_intern");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
