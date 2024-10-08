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
    <h2>Tambah Team Baru</h2>

    <form action="insertteam_process.php" method="POST">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="game">Game:</label>
        <select name="game" id="game" required>
            <?php

            $result = $mysqli->query("SELECT * FROM game");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['idgame'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>

        <input type="submit" value="Insert">
    </form>
</body>
</html>