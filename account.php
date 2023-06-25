<?php
session_start();
include "conn.php";

if (!isset($_SESSION['id']) || !isset($_SESSION['mail'])) {
    header("Location: login.php");
    exit();
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated password data
    $email = $_POST['email'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Fetch the user's current password from the database
    $sql = "SELECT `password` FROM `users` WHERE `mail` = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify the current password entered by the user
        if ($currentPassword === $storedPassword) {
            // Update the user's password in the database
            $sql = "UPDATE `users` SET `password` = '$newPassword' WHERE `mail` = '$email'";
            if ($conn->query($sql) === TRUE) {
                // Redirect back to protected-home.php or dashboard
                header("Location: protectedhome.php");
                exit();
            } else {
                $errors[] = "Failed to update the password.";
            }
        } else {
            $errors[] = "Incorrect current password.";
        }
    } else {
        $errors[] = "User data not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="account.css">
</head>
<body>
    <h1>Change Password</h1>

    <?php if (!empty($errors)) { ?>
        <div class="error">
            <?php foreach ($errors as $error) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $_SESSION['mail']; ?>" readonly><br>

        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" id="current_password" required><br>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required><br>

        <input type="submit" value="Change Password">
    </form>
</body>
</html>
