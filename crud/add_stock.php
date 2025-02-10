<?php
include "../functions/function.php";
include "../nav/header_nav.php";
include "../database/register_db.php";

if (isset($_POST["submit"])) {
    $item = $_POST["item"];
    $stock = $_POST["stock"];
    $input = $_POST["input"];
    $output = $_POST["output"];


    $sql = "INSERT INTO item_stocks (item, stock, input, output) VALUES ('$item', '$stock', '$input', '$output')";


    $query = mysqli_query($conn, $sql);


    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    header("location:../admin/stocks.php?message=Item added");
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add New Item</title>
</head>

<body>

    <div class="container mt-5">
    <div class="card">
                <div class="card-header bg-warning">
                    <h1 class="text-white text-center"> Add Item </h1>
                </div>
        <form action="add_stock.php" method="post">
            <div class="mb-3">
                <label for="item" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="input" class="form-label">Input</label>
                <input type="number" class="form-control" id="input" name="input" required>
            </div>
            <div class="mb-3">
                <label for="output" class="form-label">Output</label>
                <input type="number" class="form-control" id="output" name="output" required>
            </div>
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
            <a href="<?php echo getStockPath(); ?>" class="btn btn-info" style="background-color: red; color: white; border-color: maroon;">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

</body>

</html>