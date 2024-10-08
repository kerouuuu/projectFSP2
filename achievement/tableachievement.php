<?php
$mysqli = new mysqli("localhost", "root", "", "esport");

if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

include '../paging.php';

$achievements_per_page = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $achievements_per_page;

$total_achievements_query = "SELECT COUNT(*) AS total FROM achievement";
$total_achievements_result = $mysqli->query($total_achievements_query);
$total_achievements_row = $total_achievements_result->fetch_assoc();
$total_achievements = $total_achievements_row['total'];

$total_pages = ceil($total_achievements / $achievements_per_page);

$query = "SELECT achievement.idachievement, achievement.name, achievement.date, achievement.description, team.name AS teamname FROM achievement JOIN team ON achievement.idteam = team.idteam LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $achievements_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>
<body>
    <h1>Daftar Achievement</h1>
    <div class="add-button">
        <a href="insertachievement.php">
            <button>Tambah Achievement Baru</button>
        </a>
    </div>
    <br>
    <table>
        <tr>
            <th>Nama Achievement</th>
            <th>Team</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($row["name"]) . "</td>";
                echo "<td>" . ($row["teamname"]) . "</td>";
                echo "<td>" . ($row["date"]) . "</td>";
                echo "<td>" . ($row["description"]) . "</td>";
                echo "<td>";
                echo "<a href='editachievement.php?id=" . $row['idachievement'] . "'>Ubah</a> | ";
                echo "<a href='deleteachievement_process.php?id=" . $row['idachievement'] . "'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data achievement</td></tr>";
        }
        ?>
    </table>

    <br><br>
    <?= table_paging($page, $total_pages) ?>
    <br><br>
    <a href="../formadmin.php"> <<< form Admin</a>

</body>
</html>
