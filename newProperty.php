<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli('localhost', 'hljubuncic1', 'hljubuncic1', 'hljubuncic1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $sellerID=$_SESSION['userName'];
  $price=$_POST["price"];
  $location=$_POST["location"];
  $bedrooms=$_POST["bedrooms"];

  $img=$_FILES["image"]["name"];
  $file="img/".basename($img);

  if (!move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
    echo "Error uploading image";
  } else {
    $sql="INSERT INTO properties (sellerID, img, price, location, bedrooms) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $sellerID, $img, $price, $location, $bedrooms);
    $stmt->execute();
    header("Location: sellerDash.php");
    exit;
  }

}
$conn->close();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add a property</title>
    <link rel="stylesheet" href="newProperty.css">
  </head>
  <body>
    <div class="content">
      <div class="box form-box">
        <header> List a Property </header>
      <form action="newProperty.php" method="post" enctype="multipart/form-data">
        <div class="field input">
          <label for="image">Image: </label><input type="file" id="image" name="image" required><br><br>
          <label for="price">Price: </label><input type="number" id="price" name="price" required><br><br>
          <label for="location">Location: </label><input type="text" id="location" name="location" required><br><br>
          <label for="bedrooms">Number of Bedrooms: </label><input type="text" id="bedrooms" name="bedrooms" required><br><br>
          <div class="field input">
            <input type="submit" class="btn" value="List Property">
          </div>
        </div>
      <form>
      </div>
    </div>
  </body>
</html>
