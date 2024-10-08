<?php 
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Mengambil semua event
$events_result = $mysqli->query("SELECT idevent, name FROM event");
$all_teams_result = $mysqli->query("SELECT idteam, name FROM team");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Tambah Tim untuk Event</h2>

    <form method="post" action="team_eventmanage_process.php">
        <label for="event">Pilih Event:</label>
        <select name="event_id" id="event" required>
            <option value="">-- Pilih Event --</option>
            <?php
            $events = $events_result->fetch_all(MYSQLI_ASSOC);
            foreach ($events as $event) {
                echo "<option value='{$event['idevent']}'>{$event['name']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>Pilih Tim:</label><br>
        <?php
        $teams = $all_teams_result->fetch_all(MYSQLI_ASSOC);
        foreach ($teams as $team) {
            echo "<input type='checkbox' name='team_ids[]' value='{$team['idteam']}'> {$team['name']}<br>";
        }
        ?>
        
        <br>
        <input type="submit" name="add_teams" value="Tambah Team ke Event">
    </form>
</body>
</html>
