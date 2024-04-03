<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $emailormobnum = $_POST['emailormobnum'];
    $password = md5($_POST['password']);
    $sql = "SELECT Email,MobileNumber,Password,ID FROM tbluser WHERE (Email=:emailormobnum || MobileNumber=:emailormobnum) and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailormobnum', $emailormobnum, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['ocasuid'] = $result->ID;
        }
        $_SESSION['login'] = $_POST['emailormobnum'];

        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OCMMS || Signin</title>
</head>
<link rel="stylesheet" href="./scss/sigini/signin.css">

<body>
    <div class="wrapper">
        <form method="post">
            <h1>Sign In</h1>
            <div class="input-box">
            <input type="text" class="form-control" placeholder="Email or Mobile Number" required="true" name="emailormobnum">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
            <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="" id="">Remember me </label>
                <a href="forgot-password.php">Forgot Password</a>
            </div>
            <button type="submit" class="btn" name="login">Sign In</button>
            <div class="register-link">
                <a href="../index.php">Home Page!</a>
                <br>
                <a href="signup.php">Register</a>

            </div>


        </form>

    </div>


    <script src="js/main.js"></script>
</body>

</html>