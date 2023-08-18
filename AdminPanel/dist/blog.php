<?php

@include '../../config.php';

session_start();
if (!isset($_SESSION['id'])) {
  header('location:../../Login.php');
}

?>
<?php
if (isset($_POST['submitP'])) {
  // $imgData = file_get_contents($_FILES['userImage']['tmp_name']);
  $data = file_get_contents($_FILES['image']['tmp_name']);
  // print($data);
  //die;
  $name = $_POST['name'];
  $description = $_POST['description'];

  $sql2 = "INSERT into blogs(name, description, image) values(?,?,?)";
  $stmt1 = $conn->prepare($sql2);
  $stmt1->bind_param('sss', $name, $description, $data);
  $stmt1->execute();
  header('location:blog.php');
}
?>





<html lang="en" class="">
<!-- head start -->
<?php
include('parts/head.php');
?>


<style>
  .form-control:focus {
    padding: 10;
    outline: 0;
  }
</style>
<!-- head end -->

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
          <li>Blogs</li>
        </ul>
      </div>
    </section>

    <section class="section main-section">
      <div class="notification blue">
        <button class="button large blue --jb-modal" data-target="sample-modal-2" type="button">
          <span class="icon"><i class="mdi mdi-plus"></i></span>
          <h2>Add Blog</h2>
        </button>
      </div>
      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-post"></i></span>
            Blogs
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

    $count = "SELECT * from blogs";

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
                  <a href='blog.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                </button>
              <?php else : ?>
                <button type="button" class="button">
                  <a href='blog.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
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
            <p class="modal-card-title">Add Blog</p>
          </header>
          <form action="" method="post" enctype="multipart/form-data">
            <section class="modal-card-body">
              <input type="text" name="name" class="form-control mb-1" placeholder="Name" required>
              <input type="file" name="image" accept="image/png, image/gif, image/jpeg, image/jpg" multiple class="form-control mb-1" placeholder="Image" required />
              <input type="text" name="description" class="form-control mb-1" placeholder="Description" required>
            </section>
            <footer class="modal-card-foot">
              <button class="button --jb-modal-close">Cancel</button>
              <button name="submitP" type="submit" class="button red --jb-modal-close">Add</button>
            </footer>
          </form>
        </div>
      </div>
    </div>

  </div>

  <!-- Scripts below are for demo only -->


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      load_data();

      function load_data(query) {
        var myVariable = $('#myInputField').val();
        $.ajax({
          url: "searchBlog.php",
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
    


  <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script type="text/javascript" src="js/chart.sample.min.js"></script>


  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>