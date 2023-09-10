<!DOCTYPE html>
<?php
include('parts/head.php');
@include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
  header('location:Login.php');
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="assets/css/profile.css">

  <!-- font awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <header>
    <nav>

      <div class="navbar-container responsive-navbar-container">
        <div class="home-btn">
          <a href="index.php">Home</a>
        </div>
        <div class="alllinks alllinks-visible">
          <a href="#" id="mainsettings" onclick="defaultContent()">Account Settings</a>
          <a href="#" id="changeBtn" onclick="passbtn()">Change Password</a>
          <a href="#" id="myOrders" onclick="myOrdersbtn()">My Orders</a>
          <a href="AdminPanel/dist/logout.php">Log Out</a>
        </div>

        <div class="burger-button">
          <i class="fa-solid fa-bars burger-btn" id="burgerBtn"></i>
          <i class="fa-solid fa-x burger-exit" id="burgerExit"></i>
        </div>
      </div>

    </nav>
  </header>

  <div class="burger-menu-container" id="BurgerContainer">
    <div class="home-btn">
      <a href="index.php">Home</a>
    </div>
    <a href="#" id="burgerMenuMainPage" onclick="defaultContent()">Account Settings</a>
    <a href="#" id="BurgerMenuPasswordPage" onclick="passbtn()">Change Password</a>
    <a href="#" id="BurgerMenuMyOrders" onclick="myOrdersbtn()">My Orders</a>
    <a href="AdminPanel/dist/logout.php">Log Out</a>
  </div>

  <section class="section">

    <div class="main-container">
      <div class="navbar-container navbar-hidden">
        <div>
          <a href="index.php">Home</a>
        </div>
        <div class="alllinks">
          <a href="#" id="mainsettings2" onclick="defaultContent()">Account Settings</a>
          <a href="#" id="changeBtn22" onclick="passbtn()">Change Password</a>
          <a href="#" id="myOrders2" onclick="myOrdersbtn()">My Orders</a>
          <a href="AdminPanel/dist/logout.php">Log Out</a>
        </div>
      </div>



      <div class="heading-container">
        <h1 class="hh1">Your Profile</h1>
      </div>

      <div class="main-content" id="mainContent">

        <div class="content1" id="content1">

          <div class="accept-container" id="acceptContainer">
            <div class="accept-text">
              <h3 class="accepth3">Are you sure you really want to <span class="accept-span">DELETE</span> account?</h3>
            </div>


            <?php
            if (isset($_POST['deleteButton'])) {
              $id = $_SESSION['id'];
              $delete = "DELETE FROM users WHERE id = $id";
              mysqli_query($conn, $delete);
              header('location:Login.php');
            }
            ?>

            <div class="accept-buttons">
              <form action="" method="post">
                <button class="yes" type="submit" name="deleteButton" id="yes">Yes</button>
                <button class="no" id="no">No</button>
              </form>

            </div>
          </div>

          <?php
          $user_id = $_SESSION['id'];
          $select = "SELECT * FROM users WHERE id=$user_id";
          $result = mysqli_query($conn, $select);
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_row($result);
            $name = $row[1];
            $phone = $row[3];
            $address = $row[4];
          }
          ?>
          <?php
          if (isset($_POST['updateInfo'])) {
            $user_id = $_SESSION['id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $sql = "UPDATE users SET name='$name' , phone='$phone' , address='$address' WHERE id=$user_id ";
            mysqli_query($conn, $sql);
          }
          ?>

          <div class="inputs">
            <form action="" method="post">
              <br> <input type="text" name="name" value="<?php echo $name ?>" placeholder="Write your name here">
              <input type="tel" name="phone" value="<?php echo $phone ?>" placeholder="Write Your Phone Number">
              <input type="text" name="address" id="username-input" autocomplete="false" placeholder="Please write your address" value="<?php echo $address ?>">
              <br><button class="btns" name="updateInfo" id="updateprofile">Update Profile</button>
            </form>

            <div class="settingbuttons">
              <button class="btns" id="deleteBtn">Delete Account</button>
            </div>

          </div>
        </div>

        <div class="content2" id="secondContent">

          <div class="inputs cont2">

            <?php
            if (isset($_POST['updatePassword'])) {

              $id = $_SESSION['id'];

              $current = md5($_POST['currentPassword']);
              $newP = md5($_POST['newPassword']);

              if ($current == $_SESSION['password']) {
                $update = "UPDATE users SET password='$newP' WHERE id=$id ";
                mysqli_query($conn, $update);
              } else {
                echo '<script>window.alert("Your Current Password is Wrong!Please try agaiin!")</script>';
              }
            }
            ?>
            <form action="" method="post">
              <br> <input type="password" name="currentPassword" autocomplete="off" placeholder="Please Type Current Password" required>
              <input type="password" name="newPassword" placeholder="New Password" min="8" required onChange="onChange()">
              <input type="password" name="newPasswordR" placeholder="Repeat Password" required onChange="onChange()">
              <br> <button class="btns" type="submit" name="updatePassword" id="submitbtnid">Submit</button>
            </form>
          </div>

        </div>

        <div class="content3 cont3" id="thridcontent">

          <div class="order-container" data-toggle="collapse" data-target="#demo">
            <div class="allorders">

              <?php
              $id = $_SESSION['id'];
              $sql = "SELECT * FROM orders WHERE user_id=$id";
              $result = mysqli_query($conn, $sql);

              while ($row = mysqli_fetch_array($result)) {
                $newString = str_replace(',', " <br> ", $row[6]);

                if ($row['status'] == 0) {
                  $status = "Pending";
                } else if ($row['status'] == 1) {
                  $status = "Finished";
                } else {
                  $status = "Current";
                }

              ?>
                <div class="order collapsible" id="orders">
                  <div>
                    <h1 class="orderh1"> Order #<?php echo $row[0]; ?> &nbsp &nbsp <span><?php echo $row[14]; ?></span>&nbsp &nbsp<span><?php echo $status; ?></span>
                  </div>
                  </h1>
                </div>


                <div class="dropdown-content content" id="demo" id="dropContent">
                  <div class="first-row">

                    <div class="prod-title">Products</div>
                    <div class="product-list">

                      <div class="product1 product">
                        <span><?php echo $newString; ?> </span>
                      </div>

                      <div class="second-row">
                        <div class="second-title">
                          <div class="link">
                            <button class="btns print-button"><a style="color:white;" href="generatePDF.php?id=<?php echo $row[0]; ?>">print</a></button>
                          </div>
                          <div class="spans">
                            <span>Shipping: <?php echo $row[8]; ?></span>
                            <span>Total Price: <?php echo $row[7]; ?>₾</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
  </section>


  <script src="assets\js\profile.js"></script>
  <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
          content.style.maxHeight = null;
        } else {
          content.style.maxHeight = content.scrollHeight + "px";
        }
      });
    }
  </script>

  <script>
    function onChange() {
      const password = document.querySelector('input[name=newPassword]');
      const confirm = document.querySelector('input[name=newPasswordR]');
      if (confirm.value === password.value) {
        confirm.setCustomValidity('');
      } else {
        confirm.setCustomValidity('Passwords do not match');
      }
    }
  </script>

</body>

</html>