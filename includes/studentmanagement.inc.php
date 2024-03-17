<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post = $_POST["post"];
    $file = $_POST["file"];

    try {
        require_once "dbh.inc.php";

        // Pobierz cookie_value
        $query = "SELECT cookie_value FROM cookies WHERE created_at = (SELECT MAX(created_at) FROM cookies)";
        $stmt = $pdo->query($query);
        $nickname = $stmt->fetchColumn();

        // Wykonaj zapytanie SQL z odpowiednimi parametrami
        $query = "INSERT INTO post (username, comment_text, img) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nickname, $post, $file]);

        // Zamknij połączenie i przekieruj
        $pdo = null;
        $stmt = null;

        header("Location: ../student.php");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../student.php");
    exit();
}
