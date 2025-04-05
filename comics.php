<?php
require __DIR__ . '/vendor/autoload.php'; // ✅ Required for Dotenv

error_reporting(E_ALL);
ini_set('display_errors', 1);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT comic_id, title, issue_number, description, image_path, link FROM Comics";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics - Lilo & Stitch</title>
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
            <a class="nav-link active" href="./comics.php">Comics</a>
            <a class="nav-link" href="./videoGame.php">Video Games</a>
        </nav>
    </header>

    <main class="main container comics">
       
        <div class="container">
            <h2 class="main-comic-title">The most popular comics </h2>
            <p class="comic-main-text">This page is for informational purposes only. If you want to read the amazing stories of Lilo and Stitch click <a target="_blank" href="https://leagueofcomicgeeks.com/comics/series/171378/lilo-stitch">&#8594; HERE &#8592; </a> or click on the comic of your choice below</p>
        <?php if ($result->num_rows > 0) { ?>
            <ul class="comics-list">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li class="comics-item">
                        <a target="_blank" href="<?php echo $row["link"]?>">
                          <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="comics-img">
                          <div class="comics-desc">
                            <h3 class="comics-title"><?php echo $row["issue_number"] . ": " . htmlspecialchars($row["title"]); ?></h3>
                            <p class="comics-text"><?php echo htmlspecialchars($row["description"]); ?></p>
                        </div>
                        </a>
                        
                    </li>
                <?php } ?>
            </ul>
        <?php } else { echo "<p>No comics found.</p>"; } ?>
</div>
<img src="./img/footer-comic.png" alt="Lilo&Stitch" class="footer-img-comic">
    </main>

    <?php $conn->close(); ?>

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
