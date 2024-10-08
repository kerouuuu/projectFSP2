<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idteam = $_POST['idteam'];
$name = $_POST['name'];
$idgame = $_POST['game'];

$query = "UPDATE team SET name = ?, idgame = ? WHERE idteam = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $name, $idgame, $idteam);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tableteam.php");
exit();

?>
