<!DOCTYPE html>
<html lang="en">
<?php
include('parts/head.php');
?>

<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = "";
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $email = $_POST['email'];
    $name = $_POST['name'];
	$registrationNumber = $_POST['registration_number'];

    $select = " SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo "<script type='text/javascript'>alert('A user with this email already exists');</script>";
        $error[] = 'მომხმარებელი უკვე არსებოს!';
    } else {
        if ($_POST['account_type'] == 'business') {
            $insert = "INSERT INTO users(name, email, password, account_type, RegistrationNumber) VALUES('$name', '$email', '$pass', 2, '$registrationNumber')";
        } else {
            // Otherwise, save the name
            $insert = "INSERT INTO users(name, email, password) VALUES('$name', '$email', '$pass')";
        }
        mysqli_query($conn, $insert);
        header('location: Login.php');
    }
}
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
                    <h2 class="text-center">Registration</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="account_type">Account Type</label>
                            <select name="account_type" class="form-control" id="account_type" required>
                                <option value="personal">Personal</option>
                                <option value="business">Business</option>
                            </select>
                        </div>
                        <div class="form-group" id="company_fields" style="display: none;">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name">
                        </div>
                        <div class="form-group" id="registration_number_fields" style="display: none;">
                            <label for="registration_number">Registration Number</label>
                            <input type="text" name="registration_number" class="form-control" id="registration_number" placeholder="Enter Registration Number">
                        </div>
                        <div class="form-group" id="name_field">
                            <label for="username">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" name="email" class="form-control" id="Email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required onChange="onChange()" minlength="8">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" id="password" placeholder="Enter password" required onChange="onChange()">
                        </div>

                        <button type="submit" name="submit" class="btn-lg btn-primary btn-block">Sign Up</button>
                        <div>
                            <a class="small" href="Login.php">Already Have an account? Log In!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function onChange() {
            const password = document.querySelector('input[name=password]');
            const confirm = document.querySelector('input[name=cpassword]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('Passwords do not match');
            }
        }

        // Add event listener to account type dropdown
        const accountTypeSelect = document.getElementById('account_type');
        const companyFields = document.getElementById('company_fields');
        const registrationNumberFields = document.getElementById('registration_number_fields');
        const nameField = document.getElementById('name_field');
		const nameInput = document.getElementById('name');

        accountTypeSelect.addEventListener('change', function () {
            if (this.value === 'business') {
                companyFields.style.display = 'block';
                registrationNumberFields.style.display = 'block';
                nameField.style.display = 'none';
				nameInput.removeAttribute('required');

            } else {
                companyFields.style.display = 'none';
                registrationNumberFields.style.display = 'none';
                nameField.style.display = 'block';
				nameInput.setAttribute('required', 'required');
            }
        });


        companyFields.style.display = 'none';
        registrationNumberFields.style.display = 'none';

    </script>

    <!-- scripts -->
    <?php
    include('parts/script.php');
    ?>
    <!-- scripts -->

</body>
</html>
