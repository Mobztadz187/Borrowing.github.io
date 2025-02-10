<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once './database/register_db.php';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user["id"];
        header("location: admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'nav/loading_spinner.php'; ?> <!-- Include the spinner with the message -->
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once("./database/register_db.php");

            // Prepare and execute query to fetch user by email
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Check if user exists and verify password
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = $user["id"]; // Store the user ID in the session

                    header("location: admin/dashboard.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not exist</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not exist</div>";
            }
        }
        ?>
        <form action="./login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email: " name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password: " name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Log In" name="submit" class="btn btn-primary">
            </div>

            <div>
                <br>
                <p>No account? Just <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>