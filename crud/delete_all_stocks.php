<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: ../login.php");
    exit();
}

include "../database/register_db.php";

// Check if selected items were submitted
if (isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
    // Get the selected IDs
    $ids = $_POST['selected_items'];

    // Convert the IDs array to a comma-separated string
    $ids_string = implode(',', array_map('intval', $ids));

    // Prepare the DELETE query to delete all selected items
    $sql = "DELETE FROM item_stocks WHERE id IN ($ids_string)";

    // Perform the deletion
    if ($conn->query($sql) === TRUE) {
        // Reset the auto-increment after deletion
        $conn->query("SET @new_id = 0");
        $conn->query("UPDATE item_stocks SET id = (@new_id := @new_id + 1) ORDER BY id");
        $conn->query("ALTER TABLE item_stocks AUTO_INCREMENT = 1");

        // Redirect with a success message
        header("location: ../admin/stocks.php?message=Selected items deleted successfully");
        exit;
    } else {
        // Redirect with an error message
        header("location: ../admin/stocks.php?message=Error deleting selected items");
        exit;
    }
} else {
    // Redirect if no items were selected
    header("location: ../admin/stocks.php?message=No items selected for deletion");
    exit;
}
