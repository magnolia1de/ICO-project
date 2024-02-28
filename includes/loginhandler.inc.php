<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nickname = $_GET["nickname"];
    $pwd = $_GET["password"];

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM users WHERE nickname = $nickname AND WHERE pwd = $pwd;";

        $stmt = $pdo->prepare($query);

        $stmt->execute($query);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../main.php");
    exit();
}