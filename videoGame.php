<?php 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Lilo&Stitch"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Fetch video games from database
$sql = "SELECT game_id, title, platform, description, link FROM VideoGames"; 
$result = $conn->query($sql); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Games - Lilo & Stitch</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wdth,wght@75..125,300..700&display=swap"
      rel="stylesheet"
    />
</head>
<body>

<header class="header">
    <nav class="navigation container">
        <a class="nav-link" href="./index.html">Home</a>
        <a class="nav-link" href="./films.php">Films</a>
        <a class="nav-link" href="./series.php">Series</a>
        <a class="nav-link" href="./comics.php">Comics</a>
        <a class="nav-link active" href="./videoGames.php">Video Games</a>
    </nav>
</header>

<main class="main container comics">

<div class="container wrapper-game">
<?php if ($result->num_rows > 0) { ?>
        <ul class="games-list">
            <?php while($row = $result->fetch_assoc()) { ?>
                <li class="games-item">
                    <div class="games-info">
                        <h3 class="games-title"><?php echo $row["title"]; ?></h3>
                        <p class="games-platform"><strong>Platform:</strong> <?php echo $row["platform"]; ?></p>
                        <p class="games-desc"><?php echo $row["description"]; ?></p>
                        <a href="<?php echo $row["link"]; ?>" target="_blank" class="games-link">Play Now</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } else { 
        echo "<p>No video games found.</p>"; 
    } ?>

    <?php $conn->close(); ?>
    <img class="video-game-img" src="./img/video-game-page.png" alt="Lilo & Stitch on the ourple bike">

</div>
<div class="online-game container">
  <h3 class="online-game-title">Play NOW</h3>
<iframe  src="https://www.retrogames.cc/embed/19478-disney-s-lilo-stitch-u-mode7.html" width="100%" height="600" frameborder="no" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" scrolling="no"></iframe>
</div>
    <img class="footer-img-game" src="./img/footer-video-game-page.png" alt="Stitch">
</main>

<footer class="footer">
      <h3 class="footer-title">Ohana Means Family</h3>

      <nav class="footer-nav container">
            <a class="nav-footer-link" href="./index.html">Home</a>
            <a class="nav-footer-link" href="./films.php">Films</a>
            <a class="nav-footer-link" href="./series.php">Series</a>
            <a class="nav-footer-link" href="./comics.php">Comics</a>
            <a class="nav-footer-link" href="./videoGame.php">Video Games</a>
        </nav>

      <p class="footer-desc">
        Join us in the adventure of friendship, fun, and Stitch-tastic stories!
      </p>

      <ul class="footer-list">
        <li class="footer-item">
          <h3 class="fotter-item-text">About Disney</h3>
          <a
            href="https://en.wikipedia.org/wiki/Portal:Disney"
            class="footer-item-link"
            target="_blank"
            >Click hero for additional information</a
          >
        </li>
        <li class="footer-item">
          <h3 class="fotter-item-text">Lilo & Stitch FanDom</h3>
          <a
            href="https://disney.fandom.com/wiki/Lilo_%26_Stitch"
            class="footer-item-link"
            target="_blank"
            >Click here</a
          >
        </li>
        <li class="footer-item">
          <h3 class="fotter-item-text">Lilo & Stitch Gallery</h3>
          <a
            href="https://disney.fandom.com/wiki/Lilo_%26_Stitch/Gallery"
            class="footer-item-link"
            target="_blank"
            >Click here to see more photo</a
          >
        </li>
      </ul>

      <p style="font-size: 12px; margin-top: 25px; text-align: center;">
        &copy; 2025 Stitch Kids Club. All Rights Reserved.
      </p>
    </footer>

</body>
</html>
