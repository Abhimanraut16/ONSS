<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Notas Sharing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/SCSS/navbar/navbar.css">

</head>

<body>

    <?php include_once('includes/header.php'); ?>
    <header>
        <div class="main">
            <div class="content">
                <h1>Online Notes & <br><span>Application</span><br>System</h1>
                <p>Note taking apps are digital tools that allow you to create and store notes, ideas, and information in a variety of formats. These apps have become increasingly popular in recent years, as people look for more efficient and effective ways to capture and organize their thoughts and ideas.
                </p>
                <button class="cn"><a href="user/signup.php">JOIN US</a></button>
            </div>
            <div class="right">
                <!-- <img src="./assets/image/7.jpg" alt=""> -->
            </div>
        </div>
    </header>

    <!-- banner start -->
    <section id="slider">
        <div class="container d-flex justify-content-around py-3">
            <div class="text fs-5">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum..</div>
            <button type="button" class="btn">Contact Now!</button>
        </div>
    </section>
    <!-- banner end -->
    <script>
        AOS.init();
    </script>
</body>


</html>