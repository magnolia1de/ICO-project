<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uczeń</title>
</head>
<body>
    <div class="taskbar">
        <h1>
            <?php
                require_once "includes/dbh.inc.php";
                $query = "SELECT cookie_value FROM cookies WHERE created_at = (SELECT MAX(created_at) FROM cookies)";
                $stmt = $pdo->query($query);
                $nickname = $stmt->fetch();
                echo $nickname["cookie_value"];
            ?>
        </h1>
        <a href="main.php"><button>Wyloguj się</button></a>
    </div>

    <div class="posts">
        <h3>Wiadomości</h3>
        <?php
            require_once "includes/dbh.inc.php";
            $query = "SELECT * FROM post;";
            $stmt = $pdo->query($query);
            $posts = $stmt->fetchAll();
            foreach ($posts as $post) {
                echo "<div class='post'>";
                echo "<h4>" . $post["username"] . "</h4>";
                echo "<p>" . $post["comment_text"] . "</p>";
                
                // Konwersja danych BLOB na format base64
                $imgData = base64_encode($post["img"]);
                // Utwórz adres URL obrazu z danymi base64
                $imgSrc = 'data:image/jpeg;base64,'.$imgData;
                
                // Wyświetl obraz
                echo "<img src='" . $imgSrc . "' alt=''>";
                echo "</div>";
            }
        ?>
    </div>


    <form action="includes/studentmanagement.inc.php" method="post">
        <input type="text" name="post" placeholder="Wpisz wiadomość">
        <input type="file" name="file">
        <button type="submit" name="submit">Wyślij</button>
    </form>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; /* tło strony */
        }

        .taskbar {
            background-color: #343a40; /* kolor belki nawigacyjnej */
            color: #ffffff; /* kolor tekstu na belce nawigacyjnej */
            padding: 10px;
            text-align: center;
        }

        .taskbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .posts {
            margin: 20px auto;
            max-width: 600px; /* maksymalna szerokość sekcji z wiadomościami */
        }

        .post {
            background-color: #ffffff; /* kolor tła pojedynczego posta */
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* cień dla posta */
        }

        .post h4 {
            margin-top: 0;
            font-size: 18px;
            color: #343a40; /* kolor nazwy użytkownika */
        }

        .post p {
            margin-bottom: 10px;
        }

        .post img {
            max-width: 100%; /* maksymalna szerokość obrazu */
            height: auto;
            border-radius: 8px; /* zaokrąglenie rogów obrazu */
        }

        form {
            margin-top: 20px;
            max-width: 600px; /* maksymalna szerokość formularza */
            margin-left: auto;
            margin-right: auto;
        }

        form input[type="text"],
        form input[type="file"],
        form button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da; /* kolor obramowania */
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: #007bff; /* kolor przycisku */
            color: #ffffff; /* kolor tekstu na przycisku */
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #0056b3; /* kolor przycisku po najechaniu myszką */
        }

    </style>
</body>
</html>