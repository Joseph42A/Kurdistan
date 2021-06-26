<?php

require_once 'dbh.inc.php';

$title = $content = $author = $filename = '';
// listen for the click to start
$msg = "";
if (isset($_POST['creat-post'])) {
    // get the datas
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $order = $_POST['order'];

    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $author = mysqli_real_escape_string($conn, $author);

    require_once 'function.inc.php';

    if (!($order == 0)) {
        // creating ainin post

        // error handlers (empty)
        if (isEmpty($title) || isEmpty($content) || isEmpty($author)) {
            header("Location:../setting.php?error=emptypostfield&content=" . $content . "&title=" . $title . "&author=" . $author);
            exit();
        }
        // The content should be more than 100 letter
        if (strlen($content) < 100 || strlen($content) == null) {
            header("Location:../setting.php?error=lesscontentlength&content=" . $content . "&title=" . $title . "&author=" . $author);
            exit();
        }
        // image uploader
        $filename = $_FILES["uploadfile"]["name"];
        //The temp location
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "";

        // Extra things about the file(image)
        $fileSize = $_FILES["uploadfile"]["size"];
        $fileError = $_FILES["uploadfile"]["error"];
        $fileType = $_FILES["file"]["type"];

        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        // Allowed file to upload
        $allowed = array('jpg', 'jpeg', 'png');
        // Use this to set the state if the image is set or not
        $state = 0;
        // set state
        if (empty($filename)) {
            $state = 0;
            $filename = 'No image selected!';
        } else {
            // Check if this file is in our allowed files
            if (in_array($fileActualExt, $allowed)) {
                // Check if we do not have any error ( === 0)
                if ($fileError === 0) {
                    // Check for the size
                    if ($fileSize < 2900000) {
                        // Create new name for the file(Unique name)
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $filename = $fileNameNew;
                        // Specify the folder
                        $folder = "../uploads/" . $fileNameNew;
                        // Means show the image we uploaded
                        $state = 1;
                        // Now let's move the uploaded image into the folder: image
                        move_uploaded_file($tempname, $folder);
                    } else {
                        header("Location:../setting.php?error=errorfilesize&content=" . $content . "&title=" . $title . "&author=" . $author);
                        exit();
                    }
                } else {
                    header("Location:../setting.php?error=errorupload&content=" . $content . "&title=" . $title . "&author=" . $author);
                    exit();
                }
            } else {
                header("Location:../setting.php?error=errorfiletype&content=" . $content . "&title=" . $title . "&author=" . $author);
                exit();
            }
        }
        //then go ahead and creat post
        createPost($conn, $title, $content, $author, $order, $filename, $state);
    } else {
        header("Location:../setting.php?error=noorderselect&content=" . $content . "&title=" . $title . "&author=" . $author);
        exit();
    }
}

//noorderselect
