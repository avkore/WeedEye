<?php

@include 'config.php';

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$orderId = $_GET["id"];

$orderInfoQuery = "SELECT * FROM orders WHERE order_id=$orderId";
$result = mysqli_query($conn, $orderInfoQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $date = $row["date"];
    $name = $row["FirstName"];
    $surname = $row["LastName"];
    $address = $row["Address"];
    $totalPrice = $row["price"];
    $shipping = $row["Shipping"];
    if ($shipping == "Same Day - 6₾") {
        $shipping = 6;
    } elseif ($shipping == "Same Day - 8₾") {
        $shipping = 8;
    }
    else{
        $shipping = 0;
    }

    $total = $shipping + $totalPrice;

    // Extract and parse the products from the 'products' column
    $productsString = $row['products'];
    $productsArray = explode(', ', $productsString);

    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);

    $dompdf->setPaper("A4", "portrait");

    $html = file_get_contents("InvoiceTemplate.php");

    // Generate the product list and calculate total cost
    list($productList, $productCost) = generateProductListAndCost($productsArray, $conn);

    // Replace placeholders in the template with dynamic data, including the product list and cost
    $html = str_replace(
        ["{{ invoiceId }}", "{{ date }}", "{{ name }}", "{{ address }}", "{{ productCost }}", "{{ shipping }}", "{{ total }}", "{{ productList }}"],
        [$orderId, $date, $name . " " . $surname, $address, $productCost, $shipping, $total, $productList],
        $html
    );

    $dompdf->loadHtml($html);
    $dompdf->render();

    $dompdf->stream("invoice.pdf", ["Attachment" => 0]);
    exit;
}

function generateProductListAndCost($productsArray, $conn)
{
    $productList = '<table style="margin-top: 50px;"><thead><tr><th style="left: -0; ">Product</th><th>Quantity</th><th>Price</th></tr></thead><tbody>';
    $productCost = 0;

    foreach ($productsArray as $productEntry) {
        list($quantity, $productName) = explode('x ', $productEntry, 2); // Split quantity and product name

        // Fetch the price for the product from the database
        $productPriceQuery = "SELECT price FROM products WHERE name = '$productName'";
        $priceResult = mysqli_query($conn, $productPriceQuery);
        $row = mysqli_fetch_assoc($priceResult);
        $price = $row['price'];

        $productList .= '<tr>';
        $productList .= '<td style="text-align: center">' . $productName . '</td>';
        $productList .= '<td style="text-align: center">' . $quantity . 'x</td>';
        $productList .= '<td style="text-align: center">' . $price . '$</td>';
        $productList .= '</tr>';

        // Calculate the product cost
        $productCost += ($price * (int)$quantity);
    }

    $productList .= '</tbody></table>';

    return [$productList, $productCost];
}
