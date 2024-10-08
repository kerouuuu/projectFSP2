<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idteam = $_GET['id'];

$query = "SELECT * FROM team WHERE idteam = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $idteam);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$game_query = "SELECT * FROM game";
$game_result = $mysqli->query($game_query);

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
    <h2>Edit Team</h2>

    <form action="editteam_process.php" method="POST">
        <input type="hidden" name="idteam" value="<?php echo $row['idteam']; ?>">

        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="game">Game:</label>
        <select name="game" id="game" required>
            <?php
            while ($game_row = $game_result->fetch_assoc()) {
                $selected = $game_row['idgame'] == $row['idgame'] ? 'selected' : '';
                echo "<option value='" . $game_row['idgame'] . "' $selected>" . $game_row['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
