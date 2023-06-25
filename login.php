<!-- login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="log.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>Email</label>
        <input type="text" name="mail" placeholder="Email" value="<?php echo isset($_COOKIE['remember_mail']) ? $_COOKIE['remember_mail'] : ''; ?>"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" value="<?php echo isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : ''; ?>"><br>

        <button type="submit">Login</button>
        <input type="checkbox" id="remember" name="remember">Remember me</input>
    </form>
</body>
</html>
