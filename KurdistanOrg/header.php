<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css style link -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

    <title>Kurdistan</title>
    <!-- bootstrp CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <div class="second-header">

            <div class="logo">
                <a href="#"><img src="assets/images/logo.png" width="80px" alt=""></a>
            </div>
            <a href="#" class="menu">
                <div style="margin-top: 6px;">
                    <img class="menu-holder" src="assets/images/menu.svg" alt="">
                </div>
            </a>
            <nav class="navigation">
                <ul class="nav-links">

                    <li><a href="home.php" style="text-decoration: none;">سەرەکی</a></li>
                    <li class="dropdown">
                        <a href="#" style="text-decoration: none;">زانستگە</a>
                        <div class="dropdown-content">
                            <a style="text-decoration: none;" href="aini.php">ئاینی</a>
                            <a href="komalayati.php" style="text-decoration: none;">کۆمەڵایەتی</a>
                            <a href="zansti.php" style="text-decoration: none;">زانستی</a>
                        </div>
                    </li>
                    <!-- <li><a href="setting.html">ڕێکخستنەکان</a></li> -->
                    <?php if (!isset($_SESSION['useruid'])) { ?>
                        <li><a href="login.php" style="text-decoration: none;">چوونەژوورەوە</a></li>
                        <li><a href="about.php" style="text-decoration: none;">دەربارە</a></li>
                    <?php } else {  ?>
                        <li><a href="setting.php" style="text-decoration: none;">ڕێکخستنەکان</a></li>
                        <li><a href="includes/logout.php" style="text-decoration: none;">چوونەدەرەوە</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>