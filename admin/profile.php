<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("location: ../login.php");
    exit();
}

// Retrieve the user ID from the session
$userId = $_SESSION["user"];

// Include the database connection
require_once("../database/register_db.php");

// Fetch user details from the database
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user is found
if (!$user) {
    echo "User not found.";
    exit();
}

$alertMessage = ''; // Initialize the alert message

// Handle form submission for profile update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update_profile'])) {
        // Update profile logic
        $firstName = trim($_POST["firstname"] ?? null);
        $lastName = trim($_POST["lastname"] ?? null);
        $email = trim($_POST["email"] ?? null);
        $password = trim($_POST["password"] ?? null);

        if ($firstName && $lastName && $email) {
            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alertMessage = "<div class='alert alert-danger'>Invalid email address.</div>";
            } else {
                if ($password) {
                    if (strlen($password) < 8) {
                        $alertMessage = "<div class='alert alert-danger'>Password must be at least 8 characters long.</div>";
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $updateStmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ? WHERE id = ?");
                        $updateStmt->bind_param("ssssi", $firstName, $lastName, $email, $hashedPassword, $userId);
                    }
                } else {
                    $updateStmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
                    $updateStmt->bind_param("sssi", $firstName, $lastName, $email, $userId);
                }

                if ($updateStmt->execute()) {
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    $alertMessage = "<div class='alert alert-success'>Profile updated successfully!</div>";
                } else {
                    $alertMessage = "<div class='alert alert-danger'>Failed to update profile. Please try again later.</div>";
                }
            }
        } else {
            $alertMessage = "<div class='alert alert-danger'>All fields are required.</div>";
        }
    } elseif (isset($_POST['delete_account'])) {
        // Delete user logic
        $deleteStmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $deleteStmt->bind_param("i", $userId);

        if ($deleteStmt->execute()) {
            session_destroy(); // Log out the user
            header("location: ../login.php");
            exit();
        } else {
            $alertMessage = "<div class='alert alert-danger'>Failed to delete account. Please try again later.</div>";
        }
    }
}

include '../functions/function.php';
include '../nav/header_nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000); // 3 seconds
            }
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 style="text-align: center;">Profile</h1>

        <!-- Display Alert Message -->
        <?php if (!empty($alertMessage)): ?>
            <?php echo $alertMessage; ?>
        <?php endif; ?>

        <form method="POST" action="profile.php">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (optional)">
            </div>
            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
            <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
</body>
</html>
