<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'member') {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team_id = $_POST['team_id'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO join_proposals (user_id, team_id, status) VALUES (?, ?, 'waiting')";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $user_id, $team_id);

    if ($stmt->execute()) {
        echo "Join request submitted.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form method="POST" action="">
    <select name="team_id">
        <?php
        // Fetch available teams
        $teams_query = "SELECT * FROM teams";
        $teams_result = $mysqli->query($teams_query);

        while ($team = $teams_result->fetch_assoc()) {
            echo "<option value='{$team['id']}'>{$team['team_name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Join Team</button>
</form>
