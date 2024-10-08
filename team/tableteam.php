<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

include '../paging.php';

$teams_per_page = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {$page = (int)$_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $teams_per_page;

$total_teams_query = "SELECT COUNT(*) AS total FROM team";
$total_teams_result = $mysqli->query($total_teams_query);
$total_teams_row = $total_teams_result->fetch_assoc();
$total_teams = $total_teams_row['total'];

$total_pages = ceil($total_teams / $teams_per_page);

$query = "SELECT team.idteam, team.name AS namateam, game.name AS namagame FROM team LEFT JOIN game ON team.idgame = game.idgame LIMIT $teams_per_page OFFSET $offset";

$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>
<body>
    <h1>Daftar Team</h1>

    <div class="add-button">
        <a href="insertteam.php">
            <button>Tambah Team </button>
        </a>
    </div>
    <br>

    <table>
        <tr>
            <th>Nama Team</th>
            <th>Game</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($row["namateam"]) . "</td>";
                echo "<td>" . ($row["namagame"]) . "</td>";
                echo "<td>";
                echo "<a href='editteam.php?id=" . $row['idteam'] . "'>Ubah</a> | ";
                echo "<a href='deleteteam_process.php?id=" . $row['idteam'] . "'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data tim yang tersedia</td></tr>";
        }
        ?>
    </table>

    <br><br>
    <?= table_paging($page, $total_pages) ?>
    <br><br>
    <a href="../formadmin.php"> <<< Kembali ke form Admin</a>

</body>
</html>
