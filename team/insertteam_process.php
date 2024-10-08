<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$name = $_POST['name'];
$idgame = $_POST['game'];

$stmt = $mysqli->prepare("INSERT INTO team (name, idgame) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $idgame);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tableteam.php");
exit();
?>