<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$music_folder = "audio/";
$query = "SELECT * FROM add_music";
$result = mysqli_query($conn, $query);
$songs = array();
while ($row = mysqli_fetch_assoc($result)) {
  $music_file = $music_folder . $row['music'];
  $song = array(
    "id" => $row['id'],
    "songName" => $row['name'] . "<br><div class='subtitle'>" . $row['author'] . "</div>",
    "poster" => "img/music/" . $row['icon'],
    "musicSrc" => $music_file
  );
  array_push($songs, $song);
}
echo json_encode($songs);
mysqli_close($conn);
?>