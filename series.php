<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lilo&Stitch"; // Update if your database name is different

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch series data
$sql = "SELECT series_id, title, seasons, description, image_path FROM Series";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series - Lilo & Stitch</title>
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
            <a class="nav-link active" href="./series.php">Series</a>
            <a class="nav-link" href="./comics.php">Comics</a>
            <a class="nav-link" href="./videoGame.php">Video Games</a>
        </nav>
    </header>

    <main class="main series">
        <div class="container">
        <?php if ($result->num_rows > 0) { ?>
            <ul class="series-list container">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li class="series-item">
                        <a class="series-item-link" href="seriesDetails.php?id=<?php echo $row['series_id']; ?>">
                            <img src="<?php echo htmlspecialchars($row['image_path']); ?>" 
                                 alt="Cover for <?php echo htmlspecialchars($row['title']); ?>" 
                                 class="series-item-img">
                            <div class="series-wrapper-desc">
                                <h3 class="series-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                                <h4 class="series-seasons">Seasons: <?php echo $row['seasons']; ?></h4>
                                <p class="series-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { 
            echo "<p>No series found.</p>";
        } ?>

        <?php $conn->close(); ?>

        <img class="footer-series-img"  src="./img/series-footer.png" alt="Series Footer Image">
        </div>
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



