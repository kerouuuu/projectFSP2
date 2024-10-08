<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$name = $_POST['name'];
$description = $_POST['description'];

$query = "INSERT INTO game (name, description) VALUES (?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $name, $description);

if ($stmt->execute()) {
    echo "Game berhasil ditambahkan.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

header("Location: tablegame.php");
exit();
?>
