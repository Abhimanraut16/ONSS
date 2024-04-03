<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = "delete from tblnotes where ID=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'manage-notes.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONSS || Manage Notes</title>
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


            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Manage Notes</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>

                                    <th scope="col">Subject</th>
                                    <th scope="col">Notes Title</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $ocasuid = $_SESSION['ocasuid'];
                                    $sql = "SELECT * from tblnotes where UserID=:ocasuid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':ocasuid', $ocasuid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {               ?>
                                            <td><?php echo htmlentities($cnt); ?></td>

                                            <td><?php echo htmlentities($row->Subject); ?></td>
                                            <td><?php echo htmlentities($row->NotesTitle); ?></td>
                                            <td><?php echo htmlentities($row->CreationDate); ?></td>

                                            <td><a class="btn btn-sm btn-primary" href="edit-notes.php?editid=<?php echo htmlentities($row->ID); ?>">Edit</a> <a class="btn btn-sm btn-primary" href="manage-notes.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');">Delete</a></td>
                                </tr><?php $cnt = $cnt + 1;
                                        }
                                    } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


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