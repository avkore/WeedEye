<?php
@include '../../config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../Login.php');
    exit;
}

// Check if the variable and entityType parameters are present in the POST data
if (isset($_POST['variable']) && isset($_POST['entityType'])) {
    $id = $_POST['variable'];
    $entityType = $_POST['entityType'];

    // Determine which table to delete from based on entityType
    switch ($entityType) {
        case 'user':
            $sql = "DELETE FROM users WHERE id = $id";
            break;
        case 'product':
            $sql = "DELETE FROM products WHERE id = $id";
            break;
        case 'blog':
            $sql = "DELETE FROM blogs WHERE id = $id";
            break;
        case 'order':
            $sql = "DELETE FROM orders WHERE order_id = $id";
            break;
        // Add more cases if needed for other entity types
        default:
            // Handle the case if the entityType is not recognized
            break;
    }

    // Execute the DELETE query
    if (isset($sql)) {
        mysqli_query($conn, $sql);
    }
}
?>
