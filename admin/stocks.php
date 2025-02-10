
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php");
    exit();
}
include "../functions/function.php";
include "../nav/header_nav.php";
include "../database/register_db.php";

?>

<!DOCTYPE html>
<html lang="en">
<!-- #region -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Stocks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>

    <div class="container">
    <h1 style="text-align: center;">Stocks</h1>
    <?php
    if (isset($_GET['message'])) {
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert' id='autoCloseAlert'>
                " . htmlspecialchars($_GET['message']) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
?>

        <?php
        include "../nav/product_table.php";
        ?>
        <a class="btn btn-primary" href="../crud/add_stock.php">Add New</a>
        
    </div>
    <script>
    
    setTimeout(function() {
        var alert = document.getElementById('autoCloseAlert');
        if (alert) {
            alert.remove(); // Directly remove the alert from the DOM
        }
    }, 3000);
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></script>

    </body>

</html>