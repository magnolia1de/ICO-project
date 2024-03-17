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
        <select>
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h3 {
            font-size: 24px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-top: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Dodatkowe style dla select */
        select {
            appearance: none; /* usuwa domyślny wygląd selecta */
            -webkit-appearance: none; /* dla starszych wersji Chrome i Safari */
            -moz-appearance: none; /* dla starszych wersji Firefox */
            padding-right: 30px; /* dodaje miejsce dla ikony */
            background-image: url('arrow-down.png'); /* dodaje ikonę strzałki */
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

    </style>
</body>
</html>