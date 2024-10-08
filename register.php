<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/page.css">
    <title>Register Page</title>
</head>
<body>
    <h1>Register Page</h1>
    
    <form method="POST" action="register_process.php">
        <label for="fname">First Name: </label> 
        <input type="text" name="fname" id="fname" required>
        <br><br>

        <label for="lname">Last Name: </label> 
        <input type="text" name="lname" id="lname" required>
        <br><br>

        <label for="username">Username: </label> 
        <input type="text" name="username" id="username" required>
        <br><br>

        <label for="password">Password: </label> 
        <input type="password" name="password" id="password" required>
        <br><br>

        <button type="submit">Register</button>
    </form>

    <p>sudah memiliki akun? <a href="login.php">Login here</a></p>
</body>
</html>
