<?php
include "../database/register_db.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete the specific item
    $conn->query("DELETE FROM item_stocks WHERE id=$id");

    // Resequence the IDs to remove gaps
    $conn->query("SET @new_id = 0");
    $conn->query("UPDATE item_stocks SET id = (@new_id := @new_id + 1) ORDER BY id");
    $conn->query("ALTER TABLE item_stocks AUTO_INCREMENT = 1");
}

header("location:../admin/stocks.php?message=Item deleted");
exit;
