<?php

require_once 'includes/dbh.inc.php';
$post = '';
if (isset($_REQUEST['id'])) {

    $id = $_GET['id'];
    $sub = $_GET['sub'];
    // Get that Data from the server
    $sql = "SELECT * FROM $sub WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($query);

    $d = strtotime($post['created_at']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="view">

        <h1 class="read-title right-col"><?php echo $post['title'] ?></h1>

        <div class="read-container anim-label-simple-fade-out">
            <p style="color: gray;font-size: .7rem"><?php echo 'لەلایەن: ' . $post['created_by'] ?></p>
            <p style="margin:.5rem 0;color: gray;font-size: .7rem"><?php echo 'بەروار: ' . date('Y-m-d', $d)  ?></p>

            <br>
            <hr>
            <br>
            <div class="content-container">
                <?php echo $post['content']; ?>
            </div>
        </div>

        <button class="btn-back"><a href="javascript:history.back()">گەڕانەوە</a></button>


    </div>

    <?php
    require_once 'footer.php';
    ?>