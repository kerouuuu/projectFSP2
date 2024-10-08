<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$id = $_POST['id'];
$idteam = $_POST['idteam'];
$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$query = "UPDATE achievement SET idteam = ?, name = ?, date = ?, description = ? WHERE idachievement = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("isssi", $idteam, $name, $date, $description, $id);

if ($stmt->execute()) {
    header("Location: tableachievement.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
