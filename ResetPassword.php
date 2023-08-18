<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<body class="bg-image">

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->


    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <div class="card p-5 shadow-lg">
                    <h3 class="text-center">Reset Pasasword</h3>
                    <?php
                    include('config.php');

                    function function_alert($msg)
                    {
                        echo "<script type='text/javascript'>alert('$msg');</script>";
                    }


                    if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"] == "reset") && !isset($_POST["action"])) {
                        $key = $_GET["key"];
                        $email = $_GET["email"];
                        $curDate = date("Y-m-d H:i:s");

                        $query = mysqli_query($conn, "SELECT * FROM password_reset_temp WHERE TempPass='$key' AND email='$email'");
                        $row = mysqli_num_rows($query);

                        $error = "";
                        if ($row == "") {
                            $msg = "Invalid Link. The link is invalid/expired. Either you did not copy the correct link from the email, or you have already used the key in which case it is deactivated.";
                            function_alert($msg);
                        } else {
                            $row = mysqli_fetch_assoc($query);
                            $expDate = $row['expDate'];
                            if ($expDate >= $curDate) {
                    ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="username">Password</label>
                                        <input type="password" name="pass1" class="form-control" id="Email" placeholder="Enter password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input type="password" name="pass2" class="form-control" id="password" placeholder="Enter password" required>
                                    </div>


                                    <button type="submit" name="submit" class="btn-lg btn-primary btn-block">Reset Password</button>
                                    <div>
                                    <a class="small" href="Login.php">Already Have an account? Log In!</a>
                                    </div>
                                </form>
                    <?php
                            } else {
                                $error = "Link Expired. The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).";
                                function_alert($msg);
                            }
                        }
                        if ($error != "") {
                            echo "<div class='error'>" . $error . "</div><br />";
                        }
                    } // isset email key validate end


                    if (isset($_POST["submit"])) {
                        $error = "";
                        $pass1 = mysqli_real_escape_string($conn, $_POST["pass1"]);
                        $pass2 = mysqli_real_escape_string($conn, $_POST["pass2"]);
                        $email = $_GET["email"];
                        $curDate = date("Y-m-d H:i:s");
                        if ($pass1 != $pass2) {
                            $error = "Password do not match, both password should be same";
                            function_alert($error);
                        }
                         else {
                            $pass1 = md5($pass1);
                            mysqli_query($conn, "UPDATE users SET password='$pass1' WHERE email='$email'");
                            mysqli_query($conn, "DELETE FROM `password_reset_temp` WHERE email='$email'");

                            $msg = "Congratulations! Your password has been updated successfully.";
                            function_alert($msg);
                            echo ("<script>location.href='Login.php'</script>");
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- scripts -->
    <?php
    include('parts/script.php');
    ?>

</body>

<script>
    function errorOff() {
        var img = document.getElementById("formError");
        if (img.style.display = "block") {
            img.style.display = "none"
        } else {
            img.style.display = "none"
        }
    }
</script>

</html>