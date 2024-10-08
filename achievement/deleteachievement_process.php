<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$id = $_GET['id'];
$query = "DELETE FROM achievement WHERE idachievement = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
    
$stmt->close();
$mysqli->close();

header("Location: tableachievement.php");
exit();
?>
