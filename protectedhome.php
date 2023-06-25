<?php 
session_start();
include "conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['mail'])) {

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>protected-home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="protectedhome.css">

</head>
<body>
    <h1>Hello, <?php echo $_SESSION['mail']; ?></h1>
     <a href="profile.php">update profile</a><br>
     <a href="account.php">change password</a><br>
     <a href="holiday.php">public holiday</a><br>
     <a href="logout.php">Logout</a><br>
</body>
</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>