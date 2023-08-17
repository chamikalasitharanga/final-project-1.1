<?php
include_once('../goid-html/config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];


    if (empty($username) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match.";
    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $email = mysqli_real_escape_string($con, $_POST['email']);
        $username = mysqli_real_escape_string($con, $_POST['username']);

        $dup_email_query = mysqli_prepare($con, "SELECT * FROM users WHERE email = ?");
        $dup_username_query = mysqli_prepare($con, "SELECT * FROM users WHERE username = ?");


        if ($dup_email_query && $dup_username_query) {
            mysqli_stmt_bind_param($dup_email_query, "s", $email);
            mysqli_stmt_bind_param($dup_username_query, "s", $username);

            $result = mysqli_query($con, "SELECT * FROM users");

            if ($result) {

                mysqli_stmt_execute($dup_email_query);
                mysqli_stmt_execute($dup_username_query);

                $dup_email_result = mysqli_stmt_get_result($dup_email_query);
                $dup_username_result = mysqli_stmt_get_result($dup_username_query);

                if (mysqli_num_rows($dup_email_result) > 0) {
                    echo "
                <script>
                    alert('Email already taken');
                </script>
            ";
                } elseif (mysqli_num_rows($dup_username_result) > 0) {
                    echo "
                <script>
                    alert('Username already taken');
                </script>
            ";
                } else {
                    echo "Registration successful!";
                }
            } else {
                echo "SQL Error";
            }

            if ($result) {
                mysqli_stmt_close($dup_email_query);
                mysqli_stmt_close($dup_username_query);
            }
        } else {
            echo "Error creating prepared statements";
        }

        mysqli_close($con);
    }
}
