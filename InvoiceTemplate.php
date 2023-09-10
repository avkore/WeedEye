<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">
    <style>
        table {
            width: 100%;
        }
    </style>
</head>

<body>

    <img src="assets/img/LogoFull.png" width="230" height="180" style="margin-left: -50px; margin-top:-50px">

    <h1 style="text-align: center;">Invoice #{{ invoiceId }}</h1>
    <p>Date: {{ date }}</p>
    <p>Name: {{ name }}</p>
    <p>Address: {{ address }}</p>

    {{ productList }} <!-- Placeholder for the dynamically generated product list -->

    <footer>
        <div class="line">--------------------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
        <div class="footer">
            <p>Product Cost: <span>{{ productCost }}$</span></p>
            <p>Shipping: <span>{{ shipping }}$</span></p>
            <h3>Total Price: <span>{{ total }}$</span></h3>
        </div>
    </footer>

</body>

</html>
