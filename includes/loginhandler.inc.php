<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nickname = $_GET["nickname"];
    $pwd = $_GET["password"];

    try {
        require_once "dbh.inc.php";

        if (!$pdo) {
            throw new Exception("Database connection failed.");
        }

        // Check if user has a cookie and if it's expired
        if(isset($_COOKIE['user_cookie'])) {
            $cookieName = $_COOKIE['user_cookie'];

            $cookie_query = "SELECT * FROM cookies WHERE cookie_name = :cookie_name";
            $cookie_stmt = $pdo->prepare($cookie_query);
            $cookie_stmt->bindParam(':cookie_name', $cookieName);
            $cookie_stmt->execute();
            $existing_cookie = $cookie_stmt->fetch();

            if ($existing_cookie && strtotime($existing_cookie['expired_at']) > time()) {
                // Cookie exists and is not expired, redirect user to student.php
                header("Location: ../student.php");
                exit();
            } else {
                // Cookie expired or not found, generate a new one
                setcookie('user_cookie', '', time() - 3600); // Delete expired cookie
                $cookieName = cookieName(30);
                setcookie('user_cookie', $cookieName, time() + 60*60*24*7);
            }
        } else {
            // User doesn't have a cookie, generate a new one
            $cookieName = cookieName(30);
            setcookie('user_cookie', $cookieName, time() + 60*60*24*7);
        }

        // Insert cookie into database
        $query = "INSERT INTO cookies (user_id, cookie_name, cookie_value, created_at, expired_at) VALUES (:user_id, :cookie_name, :cookie_value, :created_at, :expired_at)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':cookie_name', $cookieName);
        $stmt->bindParam(':cookie_value', $nickname);
        $stmt->bindParam(':created_at', date("Y-m-d H:i:s"));
        $stmt->bindParam(':expired_at', date("Y-m-d H:i:s", strtotime("+7 day")));
        $stmt->execute();

        // Redirect user to student.php
        header("Location: ../student.php");
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../main.php");
    exit();
}

function cookieName($length) {
    $uid = random_bytes($length);
    $uid = base64_encode($uid);
    $uid = str_replace(["+", "/", "="], "", $uid);
    $uid = substr($uid, 0, $length);
    return $uid;
}
?>
