<?php
include "../functions/function.php";
include "../nav/header_nav.php";
include "../database/register_db.php";  

$id = "";
$item = "";
$stock = "";
$input = "";
$output = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location:../admin/dashboard.php");
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM item_stocks WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ../admin/dashboard.php");
        exit;
    }

    $item = $row["item"];
    $stock = $row["stock"];
    $input = $row["input"];
    $output = $row["output"];
} else {
    $id = $_POST["id"] ?? "";
    $item = $_POST["item"] ?? "";
    $stock = $_POST["stock"] ?? "";
    $input = $_POST["input"] ?? "";
    $output = $_POST["output"] ?? "";

    $sql = "UPDATE item_stocks SET item='$item', stock='$stock', input='$input', output='$output' WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result) {
        $success = "Item updated successfully!";
    } else {
        $error = "Error updating item: " . $conn->error;
    }
    header("location:../admin/stocks.php?message=Item edited");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update Item</title>
</head>

<body>
    <div class="col-lg-6 m-auto">
        <form method="post">
            <br><br>
            <div class="card">
                <div class="card-header bg-warning">
                    <h1 class="text-white text-center"> Update Item </h1>
                </div><br>

                <!-- Display success or error messages -->
                <?php if ($error) { echo "<p class='text-danger text-center'>$error</p>"; } ?>
                <?php if ($success) { echo "<p class='text-success text-center'>$success</p>"; } ?>

                <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

                <label> ITEM: </label>
                <input type="text" name="item" value="<?php echo $item; ?>" class="form-control"> <br>

                <label> STOCK: </label>
                <input type="number" name="stock" value="<?php echo $stock; ?>" class="form-control"> <br>

                <label> INPUT: </label>
                <input type="number" name="input" value="<?php echo $input; ?>" class="form-control"> <br>

                <label> OUTPUT: </label>
                <input type="number" name="output" value="<?php echo $output; ?>" class="form-control"> <br>

                <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="../admin/stocks.php" style="background-color: red; color: white; border-color: maroon;"> Cancel </a><br>
            </div>
        </form>
    </div>
</body>

</html>
