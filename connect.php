<?php //commenting php code for database for now
session_start();
$userType = $_POST['userType'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$userName = $_POST['userName'];
$password = $_POST['password'];

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Database connection//
$conn = new mysqli('localhost', '', '', 'residence radar');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else {
    $stmt = $conn->prepare("insert into registration (userType, firstName, lastName, email, phoneNumber, userName, password) VALUES (?,?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $userType, $firstName, $lastName, $email, $phoneNumber, $userName, $passwordHash);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirmation Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="connect.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

<div class = container>
    <div class="box form-box">
        <h2> Residence Radar ◎ </h2>
        <br>

        <br>
        <h3>Welcome to Residence Radar!</h3>
        <h3>Return to the <a href ="index.html">Homepage</a> to LogIn.</h3>

    </div>
</div>
</body>
</html>
