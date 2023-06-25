<?php
session_start();
include "conn.php";

if (!isset($_SESSION['id']) || !isset($_SESSION['mail'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated profile data
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $city = $_POST['city'];

    // Update the user's profile in the database
    $sql = "UPDATE users SET fullname = '$fullname', city = '$city' WHERE mail = '$email'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to protected-home.php or dashboard
        header("Location: protectedhome.php");
        exit();
    } else {
        // Handle error if user data not found
        // ...
    }
}

// Fetch user's current data from the database
$email = $_SESSION['mail'];
$sql = "SELECT fullname, city FROM users WHERE mail = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $current_fullname = $row["fullname"];
    $current_city = $row["city"];
} else {
    // Handle error if user data not found
    // ...
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
    <h1>Update Profile</h1>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo isset($current_fullname) ? $current_fullname : ''; ?>" required><br>

        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?php echo isset($current_city) ? $current_city : ''; ?>" required><br>

        <input type="submit" value="Update Profile">
    </form>
</body>

</html>
