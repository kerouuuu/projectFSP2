<?php 
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Tambah Achievement</h2>

    <form action="insertachievement_process.php" method="POST">
        <label for="name">Nama Achievement:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="idteam">Team:</label>
        <select name="idteam" id="idteam" required>
            <?php
            $result = $mysqli->query("SELECT * FROM team");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['idteam'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="date">Tanggal:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" rows="4" cols="25" required></textarea><br><br>

        <input type="submit" value="Tambah Achievement">
    </form>
</body>
</html>
