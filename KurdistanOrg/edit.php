<?php
require_once 'header.php';
require_once 'includes/dbh.inc.php';
$sub = '';
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

<!-- Create post form -->
<div class="post" style="z-index: 1;position:relative">

    <div class="post-row">
        <div class="post-col-img left-col ">
            <div class="post-img-container">
                <img src="assets/images/read.svg" alt="login image">
            </div>
        </div>

        <div class="post-col right-col">
            <div class="post-text-container">


                <h1>دەسکاریکردنی <span class="post">پۆست</span></h1>


                <form action="includes/edit.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="title">بابەت</label><br>

                    <?php if ($post == NULL) {  ?>
                        <input type='text' name='title'><br>
                    <?php  } else {  ?>
                        <input type='text' name='title' value='<?php echo htmlspecialchars($post['title']) ?>'><br>
                    <?php } ?>



                    <label for="content">ناوەڕۆک</label> <br>

                    <?php if ($post == NULL) {  ?>
                        <textarea name="content" rows="20"></textarea><br>
                    <?php  } else {  ?>
                        <textarea name="content" rows="20"><?php echo htmlspecialchars($post['content']) ?></textarea><br>
                    <?php } ?>


                    <input type="text" name="id" value="<?php echo $post['id'] ?>" hidden>
                    <input type="text" name="sub" value="<?php echo $sub ?>" hidden>
                    <button type="submit" name="post-type-update" class="post-type-update">نوێکردنەوە</button>
                    <button type="submit" name="post-type-delete" class="post-type-delete">سڕینەوە</button>

                </form>



            </div>
        </div>
    </div>
</div>

<?php if (isset($_REQUEST['error'])) { ?>

    <div class="cover-page">

        <div class="post-alert ">
            <?php if ($_GET['error'] == 'noorderselect') {  ?>
                <li style="direction: rtl; text-align:right">
                    تکایە جۆری پۆستەکەت هەڵبژێرە </li>
            <?php }
            if ($_GET['error'] == 'emptypostfield') { ?>
                <li style="direction: rtl; text-align:right">
                    تکایە بۆشاییەکان پڕبکەوە </li>
            <?php }
            if ($_GET['error'] == 'lesscontentlength') { ?>
                <li style="direction: rtl; text-align:right">
                    ناوەڕۆک دەبێت زیاتر بێت لە 100 پیت </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'stmtfail') { ?>
                <li style="direction: rtl; text-align:right">
                    ببورە هەڵەیەک ڕوویداوە </li>
            <?php } ?>
        </div>
    </div>

<?php } ?>

<?php
require_once 'footer.php';

?>