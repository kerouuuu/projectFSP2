<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idteam = $_POST['idteam'];  // Pastikan untuk menangkap idteam
$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$query = "INSERT INTO achievement (idteam, name, date, description) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("isss", $idteam, $name, $date, $description);

if ($stmt->execute()) {
    header("Location: tableachievement.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

?>
