<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];

    $password = md5($_POST['password']);
    $ret = "select Email,MobileNumber from tbluser where Email=:email || MobileNumber=:mobno";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);

    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() == 0) {
        $sql = "insert into tbluser(FullName,MobileNumber,Email,Password)Values(:fname,:mobno,:email,:password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);

        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {

            echo "<script>alert('You have successfully registered with us');</script>";
            echo "<script>window.location.href ='signin.php'</script>";
        } else {

            echo "<script>alert('Something went wrong.Please try again');</script>";
        }
    } else {

        echo "<script>alert('Email-id or Mobile Number is already exist. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ONSS || Signup</title>
    <link rel="stylesheet" href="./scss/signup/signup.css">

</head>

<body>
    <!-- Sign In Start -->
    <div class="container">
        <div class="container-cont">
            <div class="form-title">
                <a href="index.html" class="">
                    <h1 class="text-primary">Sign Up</h1>
                </a>

            </div>
            <form method="post">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <input type="text" value="" name="fname" required="true" class="form-control" placeholder="Enter Name">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="user-input-box">
                        <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+" placeholder="enter Mobile number">
                        <label for="floatingPassword">Mobile Number</label>
                    </div>
                    <div class="user-input-box">
                        <input type="email" class="form-control" value="" name="email" required="true" placeholder="enter email">
                        <label for="floatingPassword">Email address</label>
                    </div>

                    <div class="user-input-box">
                        <input type="password" value="" class="form-control" name="password" required="true" placeholder="enter password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="register">
                        <a href="signin.php">Already Registered !!</a>
                    </div>

                    <button type="submit" class="form-submit-btn" name="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>