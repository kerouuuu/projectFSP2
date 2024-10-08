<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$idgame = $_GET['id'];

$query = "DELETE FROM game WHERE idgame = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $idgame);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tablegame.php");
exit();
?>
