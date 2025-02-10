<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("location: ../login.php");
    exit();
}

// Retrieve the user ID from the session
$userId = $_SESSION["user"]; // This is now the actual user ID

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
    echo "User not found. Query: " . $stmt->error;
    exit();
}

// Fetch stock data from the correct table
$stmt = $conn->prepare("SELECT item, SUM(stock) as total_stock FROM item_stocks GROUP BY item");
$stmt->execute();
$result = $stmt->get_result();
$items = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $items[] = $row['item']; // Item name
    $counts[] = $row['total_stock']; // Total stock quantity
}

include '../functions/function.php';
include '../nav/header_nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <h1 style="text-align: center;">Welcome, <?php echo htmlspecialchars($user["first_name"]); ?>!</h1>

    <!-- Add the canvas for the chart -->
    <canvas id="stockChart" width="400" height="200"></canvas>

    <script>
    // Pass the PHP data to JavaScript
    var items = <?php echo json_encode($items); ?>;
    var counts = <?php echo json_encode($counts); ?>;

    // Create the chart
    var ctx = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: items,  // Item names
            datasets: [{
                label: 'Stock Count',
                data: counts,  // Count of each item
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</div>
</body>
</html>
