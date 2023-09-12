<?php
@include '../../config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../Login.php');
    exit;
}

// Check if the variable and entityType parameters are present in the POST data
if (isset($_POST['variable'])) {
    $id = $_POST['variable'];
    $blogName = $_POST['blogName'];
    $blogDescription = $_POST['blogDescription'];

    $sql = "UPDATE blogs SET name=$blogName, description=$blogDescription WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>