<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: ./login.php");
    exit();
}
include "../functions/function.php";
include "../nav/header_nav.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="container">
    <div class="card-header bg-warning">
                    <h1 class="text-white text-center"> View Item </h1>
                </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Stock</th>
                <th>Input</th>
                <th>Output</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../database/register_db.php");
            $sql = "SELECT * FROM item_stocks";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    
                    <td>$row[id]</td>
                    <td>$row[item]</td>
                    <td>$row[stock]</td>
                    <td>$row[input]</td>
                    <td>$row[output]</td>
                </tr>
                ";
            }
            ?>
            
        </tbody>
        
    </table>


    <a href="../admin/stocks.php" class="btn btn-info" style="background-color: red; color: white; border-color: maroon;">Back</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.10/typed.min.js"></script>
    <script>
        var togglebtn = document.querySelector(".togglebtn");
        var nav = document.querySelector("#navbar");
        
        togglebtn.addEventListener("click", function () {
            this.classList.toggle("click");
            nav.classList.toggle("open");
        });
</script>
</body>

</html>