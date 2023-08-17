<?php 
    include_once('../goid-html/config/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($con,"select * from users where (username='$username' && password='$password')");

    session_start();
    if(mysqli_num_rows($result)){
        
        $_SESSION['user'] = $username;
        echo "<script>
        alert('Login succesfull');
        
        </script>";

        header('location:category.php');
        
    }else{
        echo "<script>
        alert('Incorrect username or password');
        
        </script>";
        header('location:login.php');
    }

?>