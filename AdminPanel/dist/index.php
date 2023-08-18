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
          <li>Dashboard</li>
        </ul>

      </div>
    </section>



    <section class="section main-section">
      <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <?php
                $sql = "SELECT COUNT(*) FROM users";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
                $count = $row[0];
                ?>
                <h3>
                  Clients
                </h3>
                <h1>
                  <?php echo $count; ?>
                </h1>
              </div>
              <span class="icon widget-icon text-green-500"><i class="mdi mdi-account-multiple mdi-48px"></i></span>
            </div>
          </div>
        </div>

        <?php
          $sql = "SELECT SUM(price) from orders WHERE status = 1 AND MONTH(date) = MONTH(CURDATE())";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_row($result);
          $sales = $row[0];
          if($sales == 0){
            $sales = 0;
          }
        ?>

        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <h3>
                  Sales
                </h3>
                <h1>
                <?php echo $sales; ?>$
                </h1>
              </div>
              <span class="icon widget-icon text-blue-500"><i class="mdi mdi-cart-outline mdi-48px"></i></span>
            </div>
          </div>
        </div>

        <?php
          $query = "SELECT SUM(price) from orders WHERE status = 1 AND MONTH(date) = MONTH(CURDATE())-1 AND YEAR(date) = YEAR(CURDATE())";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_row($result);
          $salesLastMonth = $row[0];
          if($salesLastMonth == 0){
            $performance = 0;
          }
          else{
            $performance = ($sales/$salesLastMonth)*100;
          }
          
        ?>

        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <h3>
                  Performance
                </h3>
                <h1>
                <?php echo ceil(round($performance * 100)) / 100 ?>%
                </h1>
              </div>
              <span class="icon widget-icon text-red-500"><i class="mdi mdi-finance mdi-48px"></i></span>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      load_data();


      function load_data(query) {
        var myVariable = $('#myInputField').val();
        $.ajax({
          url: "searchUser.php",
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

  <section class="section main-section">
    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
          Users
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

  $count = "SELECT * from users";

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
                <a href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
              </button>
            <?php else : ?>
              <button type="button" class="button">
                <a href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
              </button>

            <?php endif; ?>
        <?php endfor;
        endif; ?>
      </div>
    </div>
  </div>


  </div>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>




  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>