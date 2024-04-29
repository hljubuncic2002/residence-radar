<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli('localhost', 'hljubuncic1', 'hljubuncic1', 'hljubuncic1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("Location: login.php");
  exit;
}
$sellerID=$_SESSION["userName"];
$info = "SELECT * FROM properties WHERE sellerID = ?";
$stmt = $conn->prepare($info);
$stmt->bind_param("s", $_SESSION["userName"]);
$stmt->execute();
$result = $stmt->get_result();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="sellerDash.css">
  </head>
  <body>

    <div class="content">
      <?php while ($property=$result->fetch_assoc()): ?>
        <div class="card">
          <img src="<?php echo "img/".$property['img'];?>" width="120" height="120">
          <div class="details">
          <h3>$: <?php echo $property['price'];?></h3>
          <p>location: <?php echo $property['location'];?></p>
          <p>Number of Bedrooms: <?php echo $property['bedrooms'];?></p>
          <p>Tax: <?php echo (0.07 * $property['price']);?></p>
        </div>
      </div>
    <?php endwhile; ?>

      <a href="newProperty.php">
        <div class="card">
          <div class="lastCardText">
            <h1>+</h1>
          </div>
        </div>
      </a>
    </div>

  </body>
</html>
<?php
  $stmt->close();
  $conn->close();
?>
