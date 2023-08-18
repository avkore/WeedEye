<?php

@include '../../config.php';

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../../Login.php');
}

?>


<html lang="en" class="">
<!-- head start -->
<?php
include('parts/head.php');
?>
<!-- head end -->

<style>
  .form-control:focus {
    padding: 10;
    outline: 0;
  }
</style>

<body>

  <div id="app">

    <!-- start nav bar -->
    <?php
    include('parts/navbar.php');
    ?>
    <!-- end nav bar -->


    <!-- aside start-->
    <?php
    include('parts/aside.php');
    ?>
    <!-- asside end -->

    <section class="is-title-bar">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
        <ul>
          <li>Admin</li>
          <li>Finished Orders</li>
        </ul>
      </div>
    </section>

    <section class="section main-section">
      <div class="notification blue">
       
      </div>
      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-format-list-checkbox"></i></span>
            Orders
          </p>
          <input type="text" name="search" id="search" placeholder="Search" class="form-control search tabindex='0'" style="margin: auto; width:500px; height:30px;" />
          <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
        <div id="result"></div>
      </div>
    </section>

    <?php
    $limit = 10;
    if (isset($_GET["page"])) {
      $page  = $_GET["page"];
    } else {
      $page = 1;
    };
    $start_from = ($page - 1) * $limit;
    //$sql = "SELECT * FROM products ASC LIMIT $start_from, $limit";  // I need to send theese 2 variables into usersSearch.php

    $count = "SELECT * from orders where status=1";

    if ($resultcount = mysqli_query($conn, $count)) {
      $total_records = mysqli_num_rows($resultcount);
      //echo $total_records;
    }

    $total_pages = ceil($total_records / $limit);   // i need this 2 variables for users.php 
    ?>

    <input type="hidden" id="myInputField" value="<?php echo $start_from  ?>">


    <div class="table-pagination">
      <div class="flex items-center justify-between">
        <div class="buttons">
          <?php
          if (!empty($total_pages)) : for ($i = 1; $i <= $total_pages; $i++) :
              if ($i == 1) : ?>

                <button type="button" class="button">
                  <a href='FinishedOrders.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </button>
              <?php else : ?>
                <button type="button" class="button">
                  <a href='FinishedOrders.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </button>

              <?php endif; ?>
          <?php endfor;
          endif; ?>
        </div>

      </div>
    </div> 

    




  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
 <script>
      $(document).ready(function() {
        load_data();


        function load_data(query) {
          var myVariable = $('#myInputField').val();
          $.ajax({
            url: "searchFinishedOrder.php",
            type: "POST",
            data: {
              myVariable: myVariable,
              query: query
            },
            success: function(data) {
              $('#result').html(data);
            }
          });
        }

        $('#search').keyup(function() {
          var search = $(this).val();
          if (search != '') {
            load_data(search);
          } else {
            load_data();
          }
        });

      });
    </script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>