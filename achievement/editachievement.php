<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$id = $_GET['id'];
$query = "SELECT * FROM achievement WHERE idachievement = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Edit Achievement</h2>

    <form action="editachievement_process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="name">Nama Achievement:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="idteam">Team:</label>
        <select name="idteam" id="idteam" required>
            <?php
            $result = $mysqli->query("SELECT * FROM team");
            while ($team = $result->fetch_assoc()) {
                echo "<option value='" . $team['idteam'] . "'" . ($team['idteam'] == $row['idteam'] ? ' selected' : '') . ">" . $team['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="date">Tanggal:</label>
        <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required><?php echo $row['description']; ?></textarea><br><br>

        <input type="submit" value="Update Achievement">
    </form>
</body>
</html>
