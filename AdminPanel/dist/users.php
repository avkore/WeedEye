<?php

@include '../../config.php';

session_start();

if (!isset($_SESSION['id'])) {
  header('location:../../Login.php');
}


if (isset($_POST['submitU'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $pass = md5($_POST['password']);
  $email = $_POST['email'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];

  $select = " SELECT * FROM users WHERE email = '$email'";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    echo "<script type='text/javascript'>alert('A user with this email already exists');</script>";
    $error[] = 'მომხმარებელი უკვე არსებობს!';
  } else {
    $insert = "INSERT INTO users(name, email, phone, address, password) VALUES('$name', '$email', '$phone', '$address', '$pass')";
    $result1 = mysqli_query($conn, $insert);
    if ($result1) {
      echo "<script type='text/javascript'>alert('User Successfully Added');</script>";
    } else {
      echo "<script type='text/javascript'>alert('Something Went Wrong. Please Try Again!');</script>";
    }
  }
  header('location:users.php');
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
          <li>Users</li>
        </ul>
      </div>
    </section>

    <section class="section main-section">
      <div class="notification blue">
        <button class="button large blue --jb-modal" data-target="sample-modal-2" type="button">
          <span class="icon"><i class="mdi mdi-plus"></i></span>
          <h2>Add User</h2>
        </button>
      </div>
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
                  <a href='users.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </button>
              <?php else : ?>
                <button type="button" class="button">
                  <a href='users.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </button>

              <?php endif; ?>
          <?php endfor;
          endif; ?>
        </div>

      </div>
    </div>


    <div id="sample-modal-2" class="modal">
      <div class="modal-background --jb-modal-close"></div>
      <div class="modal-dialog" role="document">

        <div class="modal-card">

          <header class="modal-card-head">
            <p class="modal-card-title">Add User</p>
          </header>

          <form action="" method="post">
            <section class="modal-card-body d-flex justify-content-center">

              <input type="text" name="name" class="form-control mx-auto" placeholder="Enter Name" required>

              <input type="email" name="email" class="form-control mx-auto" placeholder="Enter Email" required>

              <input type="password" name="password" id="password" class="form-control mx-auto" placeholder="Enter password" minlength="8" required>


              <input type="tel" name="phone" class="form-control mx-auto" id="phone" placeholder="Enter Phone">

              <input type="text" name="address" class="form-control mx-auto" id="address" placeholder="Enter Address">

            </section>

            <footer class="modal-card-foot">
              <button class="button --jb-modal-close">Cancel</button>
              <button name="submitU" type="submit" class="button red --jb-modal-close">Add</button>
            </footer>

          </form>
        </div>
      </div>
    </div>






    <!-- TRY HARD -->






    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>