<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idgame = $_GET['id'];

$query = "SELECT * FROM game WHERE idgame = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $idgame);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Game tidak ditemukan.");
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Edit Game</h2>

    <form action="editgame_process.php" method="POST">
        <input type="hidden" name="idgame" value="<?php echo $row['idgame']; ?>">
        
        <label for="name">Nama Game:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        <br><br>
        
        <label for="description">Deskripsi Game:</label>
        <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea>
        <br><br>

        <input type="submit" value="update">
    </form>
</body>
</html>
