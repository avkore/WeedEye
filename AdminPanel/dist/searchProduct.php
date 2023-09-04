<?php
@include '../../config.php';

session_start();
?>

<?php
include('parts/head.php');
?>

<?php
if (!isset($_SESSION['id'])) {
    header('location:../../Login.php');
}
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM products WHERE id  LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%'";
} else {
    $start_from = $_POST['myVariable'];
    $limit = 10;
    $query = "SELECT * FROM products  LIMIT $start_from, $limit";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $return .= '
        <div class="card-content">
        <table>
            <thead>
            <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Image</th>
            <th>THC</th>
            <th>Height</th>
            <th>Flowering Time</th>
            <th>Genetics</th>
            <th></th>
            </tr>
          </thead>
          <tbody>';
    while ($row1 = mysqli_fetch_array($result)) {
        $description = $string = substr($row1[4], 0, 30);
        $name = $row1["name"];
        $price = $row1["price"];
        $thc = $row1["THC"];
        $height = $row1["Height"];
        $flowering = $row1['flowering_time'];
        $quantity = $row1['instock'];
        $genetics = $row1['Genetics'];
        $return .= '
        <tr>
            <td class="image-cell"> <div class="image">' . $row1["id"] . '</td></div>
            <td>' . $row1["name"] . '</td>
            <td>' . $row1["price"] . '</td>
            <td>' . $description . '</td>
            <td>' . $row1[5] . '</td>
            <td data-label="Image">
                <div id="photo-media-display"><img id="MediaImg" width="50" height="50" src="productImageView.php?image_id=' . $row1[0] . ' "></div>
            </td>
            <td>' . $row1['THC'] . '</td>
            <td>' . $row1['Height'] . '</td>
            <td>' . $row1['flowering_time'] . '</td>
            <td>' . $row1['Genetics'] . '</td>
            <td class="actions-cell">
                <div class="buttons right nowrap">
                    <button class="button small blue --jb-modal edit-product" 
                        data-target="edit-product-modal"
                        data-product-id="' . $row1[0] . '"
                        data-product-name="' . $name . '"
                        data-product-price="' . $price . '"
                        data-product-description="' . $description . '"
                        data-product-thc="' . $thc . '"
                        data-product-height="' . $height . '"
                        data-product-flowering="' . $flowering . '"
                        data-product-genetics="' . $genetics . '"
                        data-product-instock="' . $quantity . '"
                        type="button">
                        <span class="icon"><i class="mdi mdi-pencil"></i></span>
                    </button>
                    <button class="button small red --jb-modal" onclick="sendVariable(' . $row1[0] . ');" data-target="sample-modal" type="button">
                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                    </button>
                </div>
            </td>
        </tr>';
    }
    echo '</tbody>
    </table>
    </div>';
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}

?>

<div id="sample-modal" class="modal">
    <div class="modal-background --jb-modal-close"></div>
    <div class="modal-card-1">
        <header class="modal-card-head">
            <p class="modal-card-title">Delete Product</p>
        </header>
        <section class="modal-card-body">
            <p>Are Your Sure You Want to Delete This Product?</p>
        </section>
        <footer class="modal-card-foot">
            <form action="" method="post">
                <button class="button --jb-modal-close">Cancel</button>
                <button name="deleteB" id="deleteButton" type="submit" class="button red --jb-modal-close">Confirm</button>
            </form>
        </footer>
    </div>
</div>

<div id="edit-product-modal" class="modal">
    <div class="modal-background --jb-modal-close"></div>
    <div class="modal-card-1">
        <header class="modal-card-head">
            <p class="modal-card-title">Edit Product</p>
        </header>
        <section class="modal-card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="name" class="form-control mb-1" placeholder="Name" required>
                <input type="file" name="image" accept="image/png, image/gif, image/jpeg, image/jpg" multiple class="form-control mb-1" placeholder="Image" required />
                <input type="number" min="0" step=0.01 name="price" class="form-control mb-1" placeholder="Price" required>
                <input type="text" name="description" class="form-control mb-1" placeholder="Description" required>
                <input type="text" name="thc" class="form-control mb-1" placeholder="THC" required>
                <input type="text" name="height" class="form-control mb-1" placeholder="Height" required>
                <input type="text" name="fltime" class="form-control mb-1" placeholder="Flowering time" required>
                <input type="text" name="genetics" class="form-control mb-1" placeholder="Genetics" required>
                <input type="number" name="instock" min="1" class="form-control mb-1" placeholder="Quantity" required>
                <footer class="modal-card-foot">
                    <button class="button --jb-modal-close">Cancel</button>
                    <button name="submitP" id=""  type="submit" class="button red --jb-modal-close">Edit</button>
                </footer>
            </form>
        </section>
    </div>
</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>

<script>
    // Define the function that sends the variable to the server
    function sendVariable(variable, entityType) {
        $.ajax({
            type: "POST",
            url: "deleteB.php",
            data: {
                entityType: 'product',
                variable: variable
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }
</script>

<Script>
    $('.edit-product').click(function() {
        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');
        var productPrice = $(this).data('product-price');
        var productDescription = $(this).data('product-description');
        var productTHC = $(this).data('product-thc');
        var productHeight = $(this).data('product-height');
        var productFlowering = $(this).data('product-flowering');
        var productGenetics = $(this).data('product-genetics');
        var productInstock = $(this).data('product-instock');

        $('#edit-product-modal input[name="name"]').val(productName);
        $('#edit-product-modal input[name="price"]').val(productPrice);
        $('#edit-product-modal input[name="description"]').val(productDescription);
        $('#edit-product-modal input[name="thc"]').val(productTHC);
        $('#edit-product-modal input[name="height"]').val(productHeight);
        $('#edit-product-modal input[name="fltime"]').val(productFlowering);
        $('#edit-product-modal input[name="genetics"]').val(productGenetics);
        $('#edit-product-modal input[name="instock"]').val(productInstock);
    });
</Script>
