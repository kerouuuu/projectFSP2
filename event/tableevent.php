<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

include '../paging.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$events_per_page = 5;
$offset = ($page - 1) * $events_per_page;

$total_events_result = $mysqli->query("SELECT COUNT(*) AS total FROM event");
$total_events_row = $total_events_result->fetch_assoc();
$total_events = $total_events_row['total'];
$total_pages = ceil($total_events / $events_per_page);

$query = "SELECT e.idevent, e.name, e.date, e.description, GROUP_CONCAT(t.name SEPARATOR ', ') AS teams FROM event e LEFT JOIN event_teams et ON e.idevent = et.idevent LEFT JOIN team t ON et.idteam = t.idteam GROUP BY e.idevent LIMIT $events_per_page OFFSET $offset";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>
<body>
    <h1>Daftar Event</h1>

    <a href="insertevent.php"><button>Tambah Event</button></a>
    <a href="team_eventmanage.php"><button>Tambah Team</button></a>
    <br><br>

    <table>
        <tr>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Team</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["teams"] ?: 'Tidak ada tim'; ?></td>
                    <td>
                        <a href='editevent.php?id=<?php echo $row['idevent']; ?>'>Ubah</a> | 
                        <a href='deleteevent_process.php?id=<?php echo $row['idevent']; ?>'>Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan='5'>Tidak ada data event yang tersedia</td></tr>
        <?php endif; ?>
    </table>

    <br>
    <?= table_paging($page, $total_pages) ?>
    <br>
    <a href="../formadmin.php"> <<< Kembali ke form Admin</a>

</body>
</html>
