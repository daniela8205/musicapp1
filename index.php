<?php
    session_start();
    $server_name = 'localhost';
    $user_name = 'root';
    $user_pass = '';
    $database_name = 'music_user';
    $con = mysqli_connect($server_name, $user_name, $user_pass, $database_name);    
    $msg = false;
    if (isset($_POST['user_name'])) {
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $query = "select * from user where user = '".$user_name."' AND password = '".$user_password."' limit 1";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==1) {
            header('Location: welcome.php');
        } else {
            $msg = "Inccorect Password";
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Music App</title>
</head>
<body>
    <header>
        <div class="left_bx1">
            <div class="content">
                <form method="post">
                    <h3>Вхід</h3>
                    <div class="card">
                        <label for="name">Логін</label>
                        <input type="text" name="user_name" placeholder="Enter Your Username..." required>
                    </div>
                    <div class="card">
                        <label for="password">Пароль</label>
                        <input type="password" name="user_password" placeholder="Enter Your Password..." required>
                    </div>
                    <input type="submit" value="Login" class="submit">
                    <div class="check">
                        <input type="checkbox" name="" id=""><span>Запам'ятати мене</span>
                    </div>
                    <p>У вас ще немає аккаунта? <a href="signup.php">Зареєструватися</a></p>
                </form>
            </div>
        </div>
        <div class="right_bx1">
            <img src="login.png" alt="">
            <!-- <h3>Inccorect Password</h3> -->
            <?php
            echo('<h3>'.$msg.'</h3>');
            ?>
        </div>
    </header>
</body>
</html>