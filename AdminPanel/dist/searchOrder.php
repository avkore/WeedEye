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
    $query = "SELECT o.order_id, o.user_id, u.name, o.products, u.email, o.price, o.date, o.status, u.id FROM orders o JOIN users u ON o.user_id = u.id 
    WHERE (o.status=0) AND (u.name like '%" . $search . "%' OR o.order_id like '%" . $search . "%' OR u.email like '%" . $search . "%')";
} else {
    $start_from = $_POST['myVariable'];
    $limit = 10;
    $query = "SELECT * FROM orders WHERE status=0 LIMIT $start_from, $limit ";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $return .= '
        <div class="card-content">
        <table>
            <thead>
            <tr>
              <th>Id</th>
              <th>Customer Information</th>
              <th>List Of Items</th>
              <th>Total Price</th>
              <th>Shipping</th>
              <th>Payment</th>
              <th>Date</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>';
    while ($row1 = mysqli_fetch_array($result)) {
        $user_id = $row1['user_id'];
        $query3 = "SELECT * FROM orders WHERE user_id=$user_id ";
        $result3 = mysqli_query($conn, $query3);
        if (mysqli_num_rows($result3) > 0) {
            $row3 = mysqli_fetch_row($result3);
            $userName = $row3[2];
            $email = $row3[4];
            $phone = $row3[5];
            $address = $row3[12];
            $country = $row3[10];
        }

        $return .= '
		<tr>
		<td class="image-cell"> <div class="image">' . $row1["order_id"] . '</td></div>
		<td>' . 'Name: ' . $userName . '<br>  Email: ' . $email . '<br> Phone: ' . $phone . '<br> Address: ' . $address . '<br> Country: ' . $country . '</td>
		<td>' . $row1["products"] . '</td>
        <td>' . '₾' . $row1["price"] . '</td>
        <td>' . '' . $row1["Shipping"] . '</td>
        <td>' . '' . $row1["Payment"] . '</td>
        <td>' . $row1["date"] . '</td>
        <td>
            <select class="mySelect" data-order-id="' . $row1['order_id'] . '">
                <option value="0">Pending</option>
                <option value="1">Finished</option>
                <option value="2">Current</option>
            </select>
        </td>
        <td class="actions-cell">
        <div class="buttons right nowrap">
        <button class="button small red --jb-modal" onclick="sendVariable(' . $row1['order_id'] . ');" data-target="sample-modal" type="button">
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
            <p class="modal-card-title">Delete Order</p>
        </header>
        <section class="modal-card-body">
            <p>Are Your Sure You Want to Delete This Order?</p>
        </section>
        <footer class="modal-card-foot">

            <button class="button --jb-modal-close">Cancel</button>
            <button name="deleteB" id="deleteButton" type="submit" class="button red --jb-modal-close">Confirm</button>

        </footer>
    </div>
</div>

<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


<script>
    $(document).ready(function() {
        $('.mySelect').on('change', function() {
            var orderId = $(this).data('order-id');
            var status = $(this).val();
            // Send an AJAX request to the PHP script
            $.ajax({
                type: 'POST',
                url: 'process_selection.php',
                data: {
                    order_id: orderId,
                    status: status
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>



<script>
    // Define the function that sends the variable to the server
    function sendVariable(variable, entityType) {

        // Send the variable to the server using jQuery's AJAX function
        $('#deleteButton').click(function() {
            $.ajax({
                type: "POST",
                url: "deleteB.php",
                data: {
                    entityType: 'order',
                    variable: variable
                },
                success: function(response) {
                    window.location.reload();
                    // console.log("Variable sent successfully: " + response);
                }
            });
        });
    }
</script>