<?php 
 if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h3>Login</h3>
    <form action="login.php" method="POST">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="login">Login</button>
    </form>

    <?php include "layout/footer.html"; ?>
    
</body>
</html>