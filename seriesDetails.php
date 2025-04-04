<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lilo&Stitch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$series_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($series_id === 0) {
    echo "Invalid Series ID.";
    exit();
}

$sql = "SELECT * FROM Series WHERE series_id = $series_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $series = $result->fetch_assoc();
    
    // Fetch comments
    $comments_sql = "SELECT * FROM Comments WHERE series_id = $series_id";
    $comments_result = $conn->query($comments_sql);
} else {
    $series = null;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Serues - Lilo & Stitch</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wdth,wght@75..125,300..700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./styleDetails.css" />

  </head>
<body>
<header class="header">
      <nav class="navigation container">
        <a class="nav-link" href="./index.html">Home</a>
        <a class="nav-link " href="./films.php">Films</a>
        <a class="nav-link active" href="./series.php">Series</a>
        <a class="nav-link" href="./comics.php">Comics</a>
        <a class="nav-link" href="./videoGame.php">Video Games</a>
      </nav>
      
    </header>
<main>
   
 <?php if ($series): ?>
 <div class="container film-detail">
    <a href="./series.php" class="btn-back">&#8617; Go Back</a>
    <h1 class="fd-main-title"><?php echo htmlspecialchars($series['title']); ?></h1>
 <p class="fd-year"><?php echo htmlspecialchars($series['series_year']); ?></p>
 <div class="container ">
    <div class="fd-wrapper-main-desc">
    <p class="fd-desc"><?php echo htmlspecialchars($series['full_description']); ?></p>
    <div class="fd-wrapper-main-rait">
    <img class="fd-img" src="<?php echo htmlspecialchars($series['image_path']); ?>" alt="<?php echo htmlspecialchars($series['title']); ?>" /> 
    <p class="fd-raiting"> 
    <span class="fd-raiting-span">Rating: </span>
    <?php echo $series['rating'] == 0 ? '??' : htmlspecialchars($series['rating']); ?>/10 IMDb
</p>
    </div>
    </div>
    
 </div>
        </div>
    
    
 <div class="container fd-wrapper-watch">
 <h3 class="fd-video-title">Watch Trailer</h3>

     <iframe width="100%" height="600px" src="<?php echo htmlspecialchars($series['url_video']); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
     <p class="fd-video-desc">Full movie you can watch <a target="_blank" href="<?php echo htmlspecialchars($series['full_video']); ?>">&#8594; HERE &#8592;</a></p>
 </div>
    
 <div class="container fd-wrapper-comments">
  <h3 class="fd-comments-title">Comments</h3>
    <?php if ($comments_result->num_rows > 0): ?>
        <ul class="fd-list">
            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                <li class="fd-item">
                    <strong><?php echo htmlspecialchars($comment['user_name']); ?>:</strong> 
                    <?php echo htmlspecialchars($comment['comment_text']); ?>
                    <br><small><?php echo htmlspecialchars($comment['created_at']); ?></small>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="fd-item-desc">No comments yet.</p>
    <?php endif; ?>
 </div>

 <!-- Comment Form -->
 <div class="container fd-wrapper-comments">
  <h3 class="fd-leave-comments-title">Leave a Comment</h3>
    <form class="fd-form" action="submit_commentS.php" method="post">
        <input type="hidden" name="series_id" value="<?php echo $series_id; ?>">
        <label class="fd-form-label-name" for="user_name">Your Name:</label><br>
        <input class="fd-form-user-name" type="text" id="user_name" name="user_name" required><br><br>
        
        <label class="fd-form-label-user-name" for="comment_text">Your Comment:</label><br>
        <textarea class="fd-form-text-comment" id="comment_text" name="comment_text" required></textarea><br><br>
        
        <input class="fd-submit" type="submit" value="Submit">
    </form>
 </div>

    
 <?php else: ?>
    <h1>Series Not Found!</h1>
 <?php endif; ?>
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


