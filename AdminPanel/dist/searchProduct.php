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
        // if ($row1[5] > 0)
        //     $variable = 'Yes';
        // else if ($row1[5] < 0)
        //     $variable = 'No';
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

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>




<script>
    // Define the function that sends the variable to the server
    function sendVariable(variable, entityType) {
        //alert(variable);
        // Send the variable to the server using jQuery's AJAX function
        $('#deleteButton').click(function() {
            $.ajax({
                type: "POST",
                url: "deleteB.php",
                data: {
                    entityType: 'product',
                    variable: variable
                },
                success: function(response) {
                    window.location.reload();
                    // alert("Variable sent successfully: " + response);
                }
            });
        });
    }
</script>