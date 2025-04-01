<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
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

$sql = "SELECT film_id, title, release_year, description, image_path FROM Films";
$result = $conn->query($sql); 
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Films - Lilo & Stitch</title>
    <link rel="stylesheet" href="/final-project-SQL/style.css" />
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
        <a class="nav-link active" href="./films.php">Films</a>
        <a class="nav-link" href="./series.php">Series</a>
        <a class="nav-link" href="./comics.php">Comics</a>
        <a class="nav-link" href="./videoGame.php">Video Games</a>
      </nav>
      
    </header>
    <main class="main container">
        <div class="container">
            <div class="films-wrap-search">
            <p>ENTER SERAC BUTTON-FORM</p>
            <img class="films-searc-stitch" src="./img/films-search.png" alt="stitch">
            </div>
       
        <?php if ($result->num_rows > 0) { ?>
       
       <ul class="films-list container">
       <?php while($row = $result->fetch_assoc()) { ?>
<li class="films-item">
    <a class="films-link" href="watch.php?film_id=<?php echo $row["film_id"]; ?>">
<img src="<?php echo $row["image_path"]; ?>" alt="cover for <?php echo $row["title"]; ?>" class="films-item-img">
    <div class="films-wrapper-desc">
        <h3 class="films-title"><?php echo $row["title"]; ?><h4 class="films-year"><?php echo $row["release_year"]; ?></h4></h3>
        
        <p class="films-desc"><?php echo $row["description"]; ?></p>
    </div>
    </a>
</li>
        
        <?php } ?>
       </ul>
           <?php } else { 
        echo "<p>No films found.</p>"; 
    } ?>

    <?php $conn->close(); ?>
        </div>
        


  

    <img
        class="footer-films-img"
        width="300px"
        src="./img/films-footer.png"
        alt="Img for footer Films Page"
      />
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
