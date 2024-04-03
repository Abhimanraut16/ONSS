<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Email FROM tbluser WHERE Email=:email and MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update tbluser set Password=:newpassword where Email=:email and MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>alert('Your Password succesfully changed');</script>";
    } else {
        echo "<script>alert('Email id or Mobile no is invalid');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>ONSS || Forgot Password</title>
    <link rel="stylesheet" href="./scss/signup/signup.css">
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="container-cont">
            <div class="form-title">
                <a href="index.html" class="">
                    <h1 class="text-primary">Reset Password</h1>
                </a>

            </div>
            <form method="post" name="chngpwd" onSubmit="return valid();">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <input type="email" class="form-control" placeholder="Email Address" required="true" name="email">
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="user-input-box">
                    <input type="text" class="form-control" placeholder="Mobile Number" required="true" name="mobile" maxlength="10" pattern="[0-9]+">
                            <label for="floatingPassword">Mobile Number</label>
                    </div>
                    <div class="user-input-box">
                        <input type="password" name="newpassword" class="form-control" placeholder="New Password" required="true">
                        <label for="floatingInput">New Password</label>
                    </div>

                    <div class="user-input-box">
                        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required="true">
                        <label for="floatingInput">Confirm Password</label>
                    </div>
                    <div class="register">
                        <a href="signin.php">## signin</a>
                    </div>
                    <button type="submit" class="form-submit-btn" name="submit">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>