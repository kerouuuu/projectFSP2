<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Tambah Game Baru</h2>

    <form action="insertgame_process.php" method="POST">
        <label for="name">Nama Game:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Deskripsi Game:</label>
        <textarea id="description" name="description" rows="4" cols="25" required></textarea><br><br>

        <input type="submit" value="Insert">
    </form>
</body>
</html>
