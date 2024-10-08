<!-- manage_achievement.php -->
<?php
include '../db.php'; // Koneksi ke database

// Query untuk mengambil tim yang ada
$teamsQuery = "SELECT idteam, name FROM team";
$teamsResult = $conn->query($teamsQuery);
?>

<h2>Tambah Achievement untuk Tim</h2>
<form action="process_achievement.php" method="post">
    <label for="idteam">Pilih Tim:</label>
    <select name="idteam" id="idteam" required>
        <?php while ($team = $teamsResult->fetch_assoc()) : ?>
            <option value="<?= $team['idteam']; ?>"><?= $team['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <label for="achievement_name">Nama Achievement:</label>
    <input type="text" name="achievement_name" id="achievement_name" required>

    <label for="achievement_date">Tanggal Achievement:</label>
    <input type="date" name="achievement_date" id="achievement_date" required>

    <label for="achievement_desc">Deskripsi Achievement:</label>
    <textarea name="achievement_desc" id="achievement_desc" required></textarea>

    <button type="submit">Tambah Achievement</button>
</form>
