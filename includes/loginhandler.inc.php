<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nickname = $_GET["nickname"];
    $pwd = $_GET["password"];

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM users WHERE nickname = $nickname AND pwd = $pwd;";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        function cookieName($nickname) {
            $uid = random_bytes(16);
            $uid = base64_encode($uid);
            $uid = str_replace(["+", "/", "="], "", $uid);
            $uid = substr($uid, 0, 16);
            return $uid;
        }

        setcookie(cookieName($nickname), $nickname, time() + 60*60*24, "/");
        //dodać tabele z cookiesami i zapisywać tam nazwę ciasteczka i id użytkownika

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