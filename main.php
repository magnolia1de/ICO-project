<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    
    <h3>Logowanie</h3>

    <form action="includes/loginhandler.inc.php" method="get">
        <input type="text" name="nickname" placeholder="login">
        <input type="password" name="password" placeholder="Hasło">
        <button type="submit" name="submit">Logowanie</button>
    </form>

</body>
</html>