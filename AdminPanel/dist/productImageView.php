<?php

@include '../../config.php';



if (isset($_GET['image_id'])) {
    
    $sql = "SELECT * FROM products WHERE id=? ";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $_GET['image_id']);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    //header("Content-type: " . $row["type"]);
    echo $row["image"];
}

?>
