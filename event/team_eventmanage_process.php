<?php 
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_teams'])) {
    if (!empty($_POST['event_id']) && !empty($_POST['team_ids'])) {
        $event_id = $_POST['event_id'];
        
        foreach ($_POST['team_ids'] as $team_id) {
            $insert_query = "INSERT INTO event_teams (idevent, idteam) VALUES (?, ?)";
            $stmt = $mysqli->prepare($insert_query);
            $stmt->bind_param('ii', $event_id, $team_id);
            $stmt->execute();
        }
        header("Location: tableevent.php?");
        exit;
    }
}
?>