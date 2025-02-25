<form method="POST" action="../crud/delete_all_stocks.php">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <!-- Select All checkbox -->
                    <input type="checkbox" id="selectAll">
                    <!-- Delete selected items link with icon -->
                    <a href="#" class="btn btn-link" onclick="deleteSelectedItems()">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </th>
                <th>ID</th>
                <th>Item</th>
                <th>Stock</th>
                <th>Input</th>
                <th>Output</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../database/register_db.php");
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td><input type='checkbox' name='selected_items[]' value='$row[id]'></td>
                    <td>$row[id]</td>
                    <td>$row[item]</td>
                    <td>$row[stock]</td>
                    <td>$row[input]</td>
                    <td>$row[output]</td>
                    <td>
                    <a class='btn btn-info' href='../crud/view_stock.php?id=$row[id]'>View</a>
                    <a class='btn btn-success' href='../crud/edit_stock.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger' href='../crud/delete_stock.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</form>

<script>
    // Select or deselect all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Function to delete selected items
    function deleteSelectedItems() {
        // Get all selected checkboxes
        const selectedItems = document.querySelectorAll('input[name="selected_items[]"]:checked');
        
        // If no items are selected, alert the user
        if (selectedItems.length === 0) {
            alert('No items selected for deletion.');
            return;
        }
        
        // Confirm deletion before submitting the form
        if (confirm('Are you sure you want to delete the selected items?')) {
            // Submit the form to delete the selected items
            document.querySelector('form').submit();
        }
    }
</script>
