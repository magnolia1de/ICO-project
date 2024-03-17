<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $pwd = $_POST["password"];
    $class = $_POST["class"];
    $admin = isset($_POST["admin"]) ? $_POST["admin"] : false;
    $teacher = isset($_POST["teacher"]) ? $_POST["teacher"] : false;
    $nickname = $_POST["nickname"];

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO users (name, surname, pwd, class_id, admin, teacher, nickname) VALUES
        (?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$name, $surname, $pwd, $class, $admin, $teacher, $nickname]);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
    exit();
}