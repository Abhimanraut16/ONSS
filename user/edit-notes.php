<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {


        $subject = $_POST['subject'];
        $notestitle = $_POST['notestitle'];
        $notesdesc = $_POST['notesdesc'];
        $eid = $_GET['editid'];
        $sql = "update tblnotes set Subject=:subject,NotesTitle=:notestitle,NotesDecription=:notesdesc where ID=:eid";
        $query = $dbh->prepare($sql);

        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':notestitle', $notestitle, PDO::PARAM_STR);
        $query->bindParam(':notesdesc', $notesdesc, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Notes has been updated")</script>';
        echo "<script>window.location.href ='manage-notes.php'</script>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>ONSS || Update Notes</title>
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
                                <h6 class="mb-4">Update Notes</h6>
                                <form method="post">
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


                                            <br />
                                            <div class="mb-3">
                                                <label for="exampleInputEmail2" class="form-label">Subject</label>

                                                <input type="text" class="form-control" name="subject" value="<?php echo htmlentities($row->Subject); ?>" required='true'>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail2" class="form-label">Notes Title</label>
                                                <input type="text" class="form-control" name="notestitle" value="<?php echo htmlentities($row->NotesTitle); ?>" required='true'>

                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail2" class="form-label">Notes Description</label>
                                                <textarea class="form-control" name="notesdesc" value="" required='true'><?php echo htmlentities($row->NotesDecription); ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail2" class="form-label">View File1</label>
                                                <a href="folder1/<?php echo $row->File1; ?>" target="_blank"> <strong style="color: red">View</strong></a> |
                                                <a href="changefile1.php?editid=<?php echo $row->ID; ?>"> &nbsp;<strong style="color: red" target="_blank">Edit</strong></a>

                                            </div>
                                            <?php if ($row->File2 == "") { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File2</label>
                                                    <strong style="color: red">File is not available</strong>

                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File2</label>
                                                    <a href="folder2/<?php echo $row->File2; ?>" target="_blank"> <strong style="color: red">View</strong></a> |
                                                    <a href="changefile2.php?editid=<?php echo $row->ID; ?>"> &nbsp;<strong style="color: red" target="_blank">Edit</strong></a>

                                                </div><?php } ?>
                                            <?php if ($row->File3 == "") { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File3</label>
                                                    <strong style="color: red">File is not available</strong>

                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File3</label>
                                                    <a href="folder3/<?php echo $row->File3; ?>" target="_blank"> <strong style="color: red">View</strong></a> |
                                                    <a href="changefile3.php?editid=<?php echo $row->ID; ?>" target="_blank"> &nbsp;<strong style="color: red">Edit</strong></a>

                                                </div><?php } ?>
                                            <?php if ($row->File3 == "") { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File4</label>
                                                    <strong style="color: red">File is not available</strong>

                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail2" class="form-label">View File4</label>
                                                    <a href="folder4/<?php echo $row->File4; ?>" target="_blank"> <strong style="color: red">View</strong></a> |
                                                    <a href="changefile4.php?editid=<?php echo $row->ID; ?>" target="_blank"> &nbsp;<strong style="color: red">Edit</strong></a>

                                                </div><?php } ?>
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
        <script src="lib/chart/chart.min.js"></script>
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

    </html><?php }  ?>