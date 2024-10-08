<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idevent = $_POST['idevent'];
$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$query = "UPDATE event SET name = ?, date = ?, description = ? WHERE idevent = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sssi", $name, $date, $description, $idevent);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tableevent.php");
exit();
?>
