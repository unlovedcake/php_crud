<?php

// Retrieve form data from the session if available
$username = $_SESSION['form_data']['username'] ?? '';
$password = $_SESSION['form_data']['password'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    .center {
        margin: auto;
        width: 60%;
        border: 1px solid #f5f5f5;
        padding: 10px;
    }

    .form {
        margin: auto;
        width: 60%;

        padding: 10px;
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
</style>

<body>

    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>
    <div class="center container mt-5">
        <div class="row form">
            <div class="col-md-12 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Register</h3>
                        <?php
                        // Display error message if it exists
                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']); // Clear the error message after displaying it
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="name">User Name:</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <i class="fas fa-eye eye-icon field-icon" id="togglePassword" onclick="togglePassword()"></i>

                            </div>



                            <button type="submit" class="btn btn-primary">Register</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var toggleIcon = document.getElementById('togglePassword');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>