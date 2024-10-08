<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$idteam = $_GET['id'];

$query = "DELETE FROM team WHERE idteam = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $idteam);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tableteam.php");
exit();
?>
