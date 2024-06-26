<?php
session_start();
error_reporting(0);
include('user/includes/dbconnection.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <title>Online Notes Sharing System | Notes</title>

    <link rel="manifest" href="site.webmanifest">

    <!-- CSS here -->
<link rel="stylesheet" href="./assets/SCSS/navbar/navbar.css">

</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Header End -->
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Our Notes</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                            <li class="breadcrumb-item"><a href="notes.php">Notes</a></li>
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our featured Notes</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    // Formula for pagination
                    $no_of_records_per_page = 10;
                    $offset = ($pageno - 1) * $no_of_records_per_page;
                    $ret = "SELECT ID FROM tblnotes";
                    $query1 = $dbh->prepare($ret);
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                    $total_rows = $query1->rowCount();
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $sql = "SELECT tblnotes.*,tbluser.* from tblnotes join tbluser on tblnotes.UserID=tbluser.ID LIMIT $offset, $no_of_records_per_page";
                    $query = $dbh->prepare($sql);

                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {               ?>
                            <div class="col-lg-6">
                                <div class="properties properties2 mb-30">
                                    <div class="properties__card">
                                        <div class="properties__img overlay1">
                                            <a href="#"><img src="assets/img/featured2.png" width="300" height="300" alt=""></a>
                                        </div>
                                        <div class="properties__caption">
                                            <p><?php echo htmlentities($row->Subject); ?></p>
                                            <h3><?php echo htmlentities($row->NotesTitle); ?> By (<?php echo htmlentities($row->FullName); ?>)</h3>
                                            <p><?php echo htmlentities($row->NotesDecription); ?>.

                                            </p>
                                            <div class="properties__footer d-flex justify-content-between align-items-center">
                                                <div class="restaurant-name">


                                                </div>

                                            </div>
                                            <p>
                                            <table border="1">
                                                <tr>
                                                    <th width="200"><strong>File 1</strong></th>
                                                    <td colspan="3" style="text-align: center;"><a href="user/folder1/<?php echo $row->File1; ?>" width="100" height="100" target="_blank" class="btn bnt-primary">Download File</a></td>

                                                </tr>
                                                <?php if ($row->File2 == "") { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 2</strong></th>
                                                        <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>

                                                    </tr><?php } else { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 2</strong></th>
                                                        <td colspan="3" style="text-align: center;"><a href="user/folder2/<?php echo $row->File2; ?>" width="100" height="100" target="_blank" class="btn bnt-primary">Download File</a></td>

                                                    </tr> <?php } ?>
                                                <?php if ($row->File3 == "") { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 3</strong></th>
                                                        <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>

                                                    </tr><?php } else { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 3</strong></th>
                                                        <td colspan="3" style="text-align: center;"><a href="user/folder3/<?php echo $row->File3; ?>" width="100" height="100" target="_blank" class="btn bnt-primary">Download File</a></td>

                                                    </tr><?php } ?>
                                                <?php if ($row->File4 == "") { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 4</strong></th>
                                                        <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>

                                                    </tr><?php } else { ?>
                                                    <tr>
                                                        <th width="200"><strong>File 4</strong></th>
                                                        <td colspan="3" style="text-align: center;"><a href="user/folder4/<?php echo $row->File4; ?>" width="100" height="100" target="_blank" class="btn bnt-primary">Download File</a></td>

                                                    </tr><?php } ?></p>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <?php $cnt = $cnt + 1;
                        }
                    } ?>


                </div>
                <div align="left">
                    <ul class="pagination">
                        <li><a href="?pageno=1"><strong style="color:blue">First></strong></a></li>
                        <li class="<?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno - 1);
                                        } ?>"><strong style="padding-left: 10px;color: blue;">Prev></strong></a>
                        </li>
                        <li class="<?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>">
                            <a href="<?php if ($pageno >= $total_pages) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno + 1);
                                        } ?>"><strong style="padding-left: 10px;color: blue;">Next></strong></a>
                        </li>
                        <li><a href="?pageno=<?php echo $total_pages; ?>"><strong style="padding-left: 10px;color: blue;">Last</strong></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Courses area End -->


    </main>
    <?php include_once('includes/footer.php'); ?>

    <!-- Jquery, Popper, Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Jquery Mobile Menu -->







</body>

</html>