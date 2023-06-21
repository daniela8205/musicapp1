<?php
$server_name = 'localhost';
$user_name = 'root';
$user_pass = '';
$database_name = 'music';
$conn = mysqli_connect($server_name, $user_name, $user_pass, $database_name);
if (isset($_POST['author_name'])) {
    $author_name = $_POST['author_name'];
    if (!empty($author_name)) {  
        $icon_name = "";
        if ($_FILES["author_icon"]["error"] == 0) {
            $icon_name = $_FILES["author_icon"]["name"];
            move_uploaded_file($_FILES["author_icon"]["tmp_name"], "img/authors/" . $icon_name);
        }
        $query = "INSERT INTO add_author (author_name, author_icon) VALUES ('$author_name', '$icon_name')";
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
            <h3>Додати автора</h3>
            <form method="post" enctype="multipart/form-data">
            <div class="card">
                <label for="author_name">Автор</label>
                <input type="text" id="author_name" name="author_name" placeholder="Enter Your Author Name..." required>
            </div>
            <div class="card">
                <label for="author_icon">Фото автора</label>
                <input type="file" id="author_icon" accept=".jpg, .jpeg, .png, .gif" name="author_icon" required>
            </div>
                <input type="submit" value="Додати автора" class="submit" id="submit">
            </form>
            </div>
        </div>
    </header>
</body>
</html>