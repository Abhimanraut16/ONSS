<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {

    $fname = $_POST['name'];
    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $sql = "update tbluser set FullName=:name,MobileNumber=:mobilenumber,Email=:email where ID=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    $query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Profile has been updated")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONSS || Profile</title>
    <link rel="stylesheet" href="./scss/sidabar/sidebar.css">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white p-0">

        <?php include_once('includes/sidebar.php'); ?>


        <!-- Content Start -->
        <div class="content">
            <?php include_once('includes/header.php'); ?>


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User Profile</h6>
                            <form method="post">
                                <?php
                                $uid = $_SESSION['ocasuid'];
                                $sql = "SELECT * from tbluser where ID=:uid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {               ?>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $row->FullName; ?>" required='true'>

                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $row->Email; ?>" required='true'>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row->MobileNumber; ?>" required='true' maxlength='10' readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Registration Date</label>
                                            <input type="text" class="form-control" id="email2" name="" value="<?php echo $row->RegDate; ?>" readonly="true">
                                        </div>

                                <?php $cnt = $cnt + 1;
                                    }
                                } ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>






                </div>
            </div>
            <!-- Form End -->


            <?php include_once('includes/footer.php'); ?>
        </div>
        <!-- Content End -->


        <?php include_once('includes/back-totop.php'); ?>
    </div>

    <!-- JavaScript Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>