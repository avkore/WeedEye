<?php
@include 'config.php';

session_start();

if (isset($_POST['item'])) {
    if (isset($_SESSION['id'])) {
        // User is logged in
        $user_id = $_SESSION['id'];
    } elseif (isset($_COOKIE['id'])) {
        // User has the 'id' cookie set
        $user_id = $_COOKIE['id'];
    } else {
        exit('User not logged in or cookie not set.');
    }

    $product_id = $_POST['variable'];
    $quantity = $_POST['instock'];

    $query = "SELECT * FROM card_items WHERE user_id=$user_id AND product_id=$product_id AND submited=0";
    $result = mysqli_query($conn, $query);

    if($quantity > 0){
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE card_items SET quantity=quantity+1 WHERE user_id=$user_id AND product_id=$product_id";
            mysqli_query($conn, $sql);
        } else {
            $insert = "INSERT INTO card_items(user_id, product_id) VALUES('$user_id', '$product_id')";
            mysqli_query($conn, $insert);
        }
    }
}
?>







