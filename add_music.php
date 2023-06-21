<?php
$server_name = 'localhost';
$user_name = 'root';
$user_pass = '';
$database_name = 'music';
$conn = mysqli_connect($server_name, $user_name, $user_pass, $database_name);
if (isset($_POST['music_name'])) {
    $music_name = $_POST['music_name'];
    $music_author = $_POST['author'];
    if (!empty($music_name) && !empty($music_author)) {  
        $icon_name = "";
        if ($_FILES["icon"]["error"] == 0) {
            $icon_name = $_FILES["icon"]["name"];
            move_uploaded_file($_FILES["icon"]["tmp_name"], "img/music/" . $icon_name);
        }
        $music_file_name = "";
        if ($_FILES["music"]["error"] == 0) {
            $music_file_name = $_FILES["music"]["name"];
            move_uploaded_file($_FILES["music"]["tmp_name"], "audio/" . $music_file_name);
        }
        $query = "INSERT INTO add_music (name, author, icon, music) 
                  VALUES ('$music_name', '$music_author', '$icon_name', '$music_file_name')";
        mysqli_query($conn, $query);
        header("Location: welcome.php");   
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
        <div class="addmusic">
            <div class="content">
            <a href="welcome.php">< Back</a>
            <h3>Додати музику</h3>
            <form method="post" enctype="multipart/form-data">
            <div class="card">
                <label for="music_name">Назва аудіо</label>
                <input type="text" id="music_name" name="music_name" placeholder="Enter Your Music Name..." required>
            </div>
            <div class="card">
                <label for="author">Автор</label>
                <input type="text" id="author" name="author" placeholder="Enter Your Author..." required>
            </div>
            <div class="card">
                <label for="music_icon">Постер аудіо</label>
                <input type="file" id="icon" accept=".jpg, .jpeg, .png, .gif" name="icon" required>
            </div>
            <div class="card">
                <label for="music">Файл аудіо</label>
                <input type="file" id="music" name="music" accept="audio/mpeg, audio/ogg, audio/wav">
            </div>  
                <input type="submit" value="Додати музику" class="submit" id="submit">
            </form>
            </div>
        </div>
    </header>
</body>
</html>