<?php

@include 'config.php';
// session_start();
// if (!isset($_SESSION['id'])) {
//     header('location:Login.php');
// }
?>

<?php
$id = $_POST['variable'];
if ($_POST['product']) {
    $sql = "DELETE FROM card_items WHERE id=$id ";
    mysqli_query($conn, $sql);
}

if ($_POST['value'] && $_POST['quantity'] && $_POST['instock']) {  // value = id , inputvalue = quantity, instock
    $id = $_POST['value'];
    $quantity = $_POST['quantity'];
    $productQuantity = $_POST['instock'];
    if($quantity <= $productQuantity){
        $sql = "UPDATE card_items SET quantity=$quantity WHERE id=$id";
        mysqli_query($conn, $sql);
    }
    else{
        //do nothing for now
    }
    
}
?>