<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adaptive.css">
    <title>Music App</title>
</head>
<body>
<header>
    <div class="menu_side">
        <h1>Playlist</h1>
        <div class="playlist">
            <h4 class="active"><span></span><i class="bi bi-music-note-beamed"></i> Рекомендації</h4>
        </div>
        </div>
    </div>
    <div class="song_side">
        <nav>
        <ul class="golovne_menu">
            <li><a href="#">Головна <span></span></a></li>
        </ul>
<?php
  $server_name = 'localhost';
  $user_name = 'root';
  $user_pass = '';
  $database_name = 'music';
  $conn = mysqli_connect($server_name, $user_name, $user_pass, $database_name);

  $query = "SELECT id, name, author, icon, music FROM add_music";
  $result2 = mysqli_query($conn, $query);
?>
<div class="search">
  <i class="bi bi-search"></i>
  <input id="searchInput" type="text" placeholder="Search Music...">
  <div class="search_results">
    <?php
    while ($row = mysqli_fetch_assoc($result2)) {
    ?>
      <a href="#" class="card" data-id="<?php echo $row['id']; ?>">
        <img src="img/music/<?php echo $row['icon']; ?>" alt="">
        <div class="content">
          <?php echo $row['name']; ?>
          <span><?php echo $row['author']; ?></span>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
</div>
<div class="add">
<a href="add_music.php" class="music">Додати музику</a>
<a href="add_author.php" class="author">Додати автора</a>
</div>
      <div class="user">
          <img src="img/music/user.png" alt="User">
      </div>
        </nav>
        <div class="content">
            <h1>Alan Walker</h1>
            <p>
                Алан Олав Вокер - англо-норвезький музичний продюсер і діджей. Став відомий у 2015 коли підписав контракт з MER Musikk 
                <br>
                на треки «Spectre» і «Force». Потім він підписав контракт з Sony Music Sweden, і його першим синглом став трек «Faded», 
                <br>
                випущений 4 грудня 2015 року, за участю вокалістки Ізелін Солхейм. Цей сингл незабаром став дуже популярним і посів високі місця в чартах. 
            </p>
        </div>
        <div class="popular_song">
            <div class="h4">
                <h4>Популярні пісні</h4>
                <div class="btn_s">
                    <i id="left_scroll" class="bi bi-arrow-left-short"></i>
                    <i id="right_scroll" class="bi bi-arrow-right-short"></i>
                </div>
            </div>
            <?php
               $server_name = 'localhost';
               $user_name = 'root';
               $user_pass = '';
               $database_name = 'music';
               $conn = mysqli_connect($server_name, $user_name, $user_pass, $database_name);

               $query = "SELECT name, author, icon, music FROM add_music";
               $result1 = mysqli_query($conn, $query);
            ?>
            <div class="pop_song">
                <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
                    <li class="songItem">
                        <div class="img_play">
                            <img src="img/music/<?php echo $row['icon']; ?>" alt="">
                            <i class="bi playListPlay bi-play-circle-fill" id='<?php echo strval($row['id']); ?>'></i>
                        </div>
                            <h5>
                                <?php echo $row['name']; ?><br>
                                <span><?php echo $row['author']; ?></span>
                            </h5>
                    </li>
                <?php } ?>
            </div>
            <?php
                $server_name = 'localhost';
                $user_name = 'root';
                $user_pass = '';
                $database_name = 'music';
                $conn = mysqli_connect($server_name, $user_name, $user_pass, $database_name);

                $query = "SELECT * FROM add_author";
                $result = mysqli_query($conn, $query);
            ?>
            <div class="popular_artists">
                <div class="h4">
                    <h4>Популярні артисти</h4>
                <div class="btn_s">
                    <i id="left_scrolls" class="bi bi-arrow-left-short"></i>
                    <i id="right_scrolls" class="bi bi-arrow-right-short"></i>
                </div>
            </div>
                <div class="item">
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <li>
                            <img src="img/authors/<?php echo $row['author_icon']; ?>" alt="<?php echo $row['author_name']; ?>" title="<?php echo $row['author_name']; ?>">
                        </li>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="master_play">
        <div class="wave">
            <div class="wave1"></div>
            <div class="wave1"></div>
            <div class="wave1"></div>
        </div>
        <img src="img/music/" alt="" id="poster_master_play">
        <h5 id="title"><br>
            <div class="subtitle"></div>
        </h5>
        <div class="icon">
            <i class="bi shuffle bi-music-note-beamed">next</i>
            <i class="bi bi-skip-start-fill" id="back"></i>
            <i class="bi bi-play-fill" id="masterPlay"></i>
            <i class="bi bi-skip-end-fill" id="next"></i>
        </div>
        <span id="currentStart">0:00</span>
        <div class="bar">
            <input type="range" id="seek" min="0" value="0" max="100">
            <div class="bar2" id="bar2"></div>
            <div class="dot"></div>
        </div>
        <span id="currentEnd">0:00</span>
        <div class="vol">
            <i class="bi bi-volume-down-fill" id="vol_icon"></i>
            <input type="range" id="vol" min="0" value="30" max="100">
            <div class="vol_bar"></div>
            <div class="dot" id="vol_dot"></div>
        </div>
    </div>
</header>
    <script src="app.js"></script>
</body>
</html>