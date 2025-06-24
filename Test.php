 Mm<?php
$conn = mysqli_connect("localhost", "root", "", "webteam_intern");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SHOW TABLES");

while ($row = mysqli_fetch_array($result)) {
    echo $row[0] . "<br>";
}
?>
