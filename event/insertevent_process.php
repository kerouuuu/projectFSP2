<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$eventsQuery = "SELECT idevent, name FROM event";
$eventsResult = $mysqli->query($eventsQuery);

$teamsQuery = "SELECT idteam, name FROM team";
$teamsResult = $mysqli->query($teamsQuery);

$name = $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];

$query = "INSERT INTO event (name, date, description) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $name, $date, $description);
$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: tableevent.php");
exit();
?>

