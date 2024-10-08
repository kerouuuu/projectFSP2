<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$idevent = $_GET['id'];

$query = "DELETE FROM event WHERE idevent = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $idevent);
$stmt->execute();
   
$stmt->close();
$mysqli->close();

header("Location: tableevent.php");
exit();
?>
