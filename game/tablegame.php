<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

include '../paging.php';

$games_per_page = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $games_per_page;

$total_games_query = "SELECT COUNT(*) AS total FROM game";
$total_games_result = $mysqli->query($total_games_query);
$total_games_row = $total_games_result->fetch_assoc();
$total_games = $total_games_row['total'];

$total_pages = ceil($total_games / $games_per_page);

$query = "SELECT * FROM game LIMIT $games_per_page OFFSET $offset";
$result = $mysqli ->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>
<body>
    <h1>Daftar Game</h1>

    <div class="add-button">
        <a href="insertgame.php">
            <button>Tambah Game</button>
        </a>
    </div>
    <br>

    <table>
        <tr>
            <th>Nama Game</th>
            <th>Deskripsi</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($row["name"]) . "</td>";
                echo "<td>" . ($row["description"]) . "</td>";
                echo "<td>";
                echo "<a href='editgame.php?id=" . $row['idgame'] . "'>Ubah</a> | ";
                echo "<a href='deletegame_process.php?id=" . $row['idgame'] . "'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data game</td></tr>";
        }
        ?>
    </table>

    <br><br>
    <?= table_paging($page, $total_pages) ?>
    <br><br>
    <a href="../formadmin.php"> <<< Kembali ke form Admin</a>

</body>
</html>
