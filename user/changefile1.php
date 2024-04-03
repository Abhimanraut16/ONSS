<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['submit'])) {


    $eid = $_GET['editid'];
    $file1 = $_FILES["file1"]["name"];
    $extension1 = substr($file1, strlen($file1) - 4, strlen($file1));
    $allowed_extensions1 = array(".pdf");

    if (!in_array($extension1, $allowed_extensions1)) {
        echo "<script>alert('File has Invalid format. Only pdf format allowed');</script>";
    } else {

        $file1 = md5($file) . time() . $extension1;
        move_uploaded_file($_FILES["file1"]["tmp_name"], "folder1/" . $file1);
        $sql = "update tblnotes set File1=:file1 where ID=:eid";
        $query = $dbh->prepare($sql);

        $query->bindParam(':file1', $file1, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Notes doc file has been updated")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONSS || Update Notes File</title>
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
                            <h6 class="mb-4">Update Note File First</h6>
                            <form method="post" enctype="multipart/form-data">
                                <?php
                                $eid = $_GET['editid'];
                                $sql = "SELECT * from tblnotes where tblnotes.ID=:eid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $row) {               ?>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail2" class="form-label">Notes Title</label>
                                            <input type="text" class="form-control" name="notestitle" value="<?php echo htmlentities($row->NotesTitle); ?>" readonly='true'>


                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail2" class="form-label">View Old File1</label>
                                            <a href="folder1/<?php echo $row->File1; ?>" width="100" height="100" target="_blank"> <strong style="color: red">View Old File</strong></a>


                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail2" class="form-label">Upload New File</label>
                                            <input type="file" class="form-control" name="file1" value="" required='true'>

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