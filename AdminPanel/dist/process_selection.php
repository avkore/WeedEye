<?php

@include '../../config.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../../Login.php');
}
?>

<?php
// process_selection.php

if (isset($_POST["order_id"]) && isset($_POST["status"])) {
    $orderId = $_POST["order_id"];
    $status = $_POST["status"];

    // Assuming you have already established the database connection
    // Use prepared statements to prevent SQL injection
    $query = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $status, $orderId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Status updated successfully!";
    } else {
        // Handle the database update error if any
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>
