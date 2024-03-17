<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Admin</title>
</head>
<body>
    
    <h3>Tworzenie uczniów</h3>
    <form action="includes/formhandler.inc.php" method="post">
        <input type="text" name="name" placeholder="Imie">
        <input type="text" name="surname" placeholder="Nazwisko">
        <input type="password" name="password" placeholder="Hasło">
        <select name="class">
            <?php
                require_once "includes/dbh.inc.php";
                $query = "SELECT * FROM class_group;";
                $stmt = $pdo->query($query);
                $classes = $stmt->fetchAll();
                foreach ($classes as $class) {
                    echo "<option value='" . $class["id"] . "'>" . $class["name"] . "</option>";
                }
            ?>
        </select>
        <input type="checkbox" name="admin" placeholder="admin" default="false">
        <input type="checkbox" name="teacher" placeholder="teacher" default="false">
        <input type="text" name="nickname" placeholder="Login">
        <button type="submit" name="submit">Twórz</button>
    </form>

    <h3>Tworzenie klas</h3>
    <form action="includes/formhandler.inc.php" method="post">
        <input type="text" name="name" placeholder="NazwaKlasy">
        <button type="submit" name="submit">Twórz</button>
    </form>
</body>
</html>