<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli('localhost', '', '', 'residence radar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Login logic
    $_SESSION['userName'] = $_POST["userName"];
    $input_user = $_POST["userName"];
    $input_pass = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, userName, password, userType FROM registration WHERE userName = ?");
    $stmt->bind_param("s", $input_user);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_pass = $row["password"];

        if (password_verify($input_pass, $stored_pass)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["userName"];
            $_SESSION["userType"] = $row["userType"];
            if($_SESSION["userType"] == "seller") {
              header("Location: sellerDash.php");
            } else {
              header("Location: index.html");
            }
            exit;
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel = "stylesheet" href="registration.css">
    <script defer src = "./registration.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="box form-box">
        <header>Log-In</header><br>
        <form action="login.php" method="post" onsubmit="return validForm()">
            <div class="field input">
                <label for="UName" >Username</label>
                <input type="text" placeholder="username" name="userName" id="UName">
                <span style="color:red" id="user_error"></span>
            </div>
            <div class="field input">
                <label for="PWord">Password</label>
                <input type="password" placeholder="password" name="password" id="PWord"><br>
                <span style="color:red" id="pass_error"></span>
            </div>
            <div class="field input" style="text-align:center;">
                <input type="submit" class="btn" name="submit" value="Log-In!"> <!--user will either be directed to the seller buyer or admin dashboard.-->

            </div>
            <div class="field input">
                <h4> Don't have an account? </h4>
                <input type="button" class="btn" name="Register" value="Register" onclick="location.href='registration.html';"></a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
