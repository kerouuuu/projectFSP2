<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$id = $_GET['id'];
$query = "SELECT * FROM event WHERE idevent = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

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
    <h2>Edit Event</h2>

    <form action="editevent_process.php" method="post">
        <input type="hidden" name="idevent" value="<?php echo $event['idevent']; ?>">
        <label for="name">Nama Event:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $event['name']; ?>"><br><br>

        <label for="date">Tanggal:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $event['date']; ?>"><br><br>

        <label for="description">Deskripsi:</label><br>
        <textarea id="description" name="description"><?php echo $event['description']; ?></textarea><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
