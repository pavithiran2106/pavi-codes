<?php
session_start();
include "conn.php";

if (isset($_POST['mail']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $mail = validate($_POST['mail']);
    $password = validate($_POST['password']);
    $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

    if (empty($mail)) {
        header("Location: login.php?error=Email is required");
        exit();
    } elseif (empty($password)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE `mail`='$mail' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['mail'] = $row['mail'];
            $_SESSION['id'] = $row['id'];

            if ($remember) {
                // Set cookies to remember the user
                setcookie('remember_mail', $mail, time() + (86400 * 30), "/"); // Cookie expires in 30 days
                setcookie('remember_password', $password, time() + (86400 * 30), "/"); // Cookie expires in 30 days
            } else {
                // Clear cookies if "Remember me" is not checked
                setcookie('remember_mail', '', time() - 3600, "/");
                setcookie('remember_password', '', time() - 3600, "/");
            }

            header("Location: protectedhome.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Email or Password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
