<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Tambah Event</h2>
    <form action="insertevent_process.php" method="POST">
        <label for="name">Nama Event:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="date">Tanggal:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" rows="4" cols="25" required></textarea>
        <br><br>

        <input type="submit" value="Insert">
    </form>
</body>
</html>
