<?php

require_once 'dbh.inc.php';
require_once 'function.inc.php';


// Listen for update the post
if (isset($_REQUEST['post-type-update'])) {
    // get the values
    $id = $_REQUEST['id'];
    $newTitle = $_REQUEST['title'];
    $newCont = $_REQUEST['content'];

    $newTitle = mysqli_escape_string($conn, $newTitle);
    $newCont = mysqli_escape_string($conn, $newCont);

    $sub = $_REQUEST['sub'];

    if (empty($newTitle) || empty($newCont)) {
        header("Location:../edit.php?error=emptypostfield&content=" . $content);
        exit();
    }



    $sql = "UPDATE $sub SET title = '$newTitle', content = '$newCont' WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: ../" . $sub . ".php?info=updated");
    // header("Location:../" . $screen . ".php?edit=success");
    exit();
}

if (isset($_REQUEST['post-type-delete'])) {
    // get the values
    $id = $_REQUEST['id'];

    $sub = $_REQUEST['sub'];
    echo $sub;

    echo $sub;
    $sql = "DELETE FROM $sub WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: ../" . $sub . ".php?info=deleted");

    exit();
}
