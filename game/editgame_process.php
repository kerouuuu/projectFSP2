<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idgame = $_POST['idgame'];
$name = $_POST['name'];
$description = $_POST['description'];

$query = "UPDATE game SET name = ?, description = ? WHERE idgame = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $name, $description, $idgame);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tablegame.php");
exit();
?>
