<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nickname = $_GET["nickname"];
    $pwd = $_GET["password"];

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM users WHERE nickname = :nickname AND pwd = :pwd";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();

        $pdo = null;
        $stmt = null;

        function cookieName($length) {
            $uid = random_bytes($length);
            $uid = base64_encode($uid);
            $uid = str_replace(["+", "/", "="], "", $uid);
            $uid = substr($uid, 0, $length);
            return $uid;
        }

        setcookie(cookieName(30), $nickname, time() + 60*60*24);
        //coocies (sessionid, setcookie, czastrwania, uid)
        //tabela do dodania do bazy danych (przechowuje cookies)

        // header("Location: ../student.php");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../main.php");
    exit();
}
?>
