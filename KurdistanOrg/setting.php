<?php
 
require_once 'header.php';
require_once 'includes/visitors.inc.php';
require_once 'includes/function.inc.php';

?>


<?php if(isset($_SESSION['useruid'])){  ?>
<!-- Create post form -->
<div class="post" style="z-index: 1;position:relative">

    <div class="post-row">
        <div class="post-col-img left-col ">
            <div class="post-img-container">
                <img src="assets/images/createPost.svg" alt="login image">
            </div>
        </div>

        <div class="post-col right-col">
            <div class="post-text-container">


                <h1>دروستکردنی <span class="post">پۆست</span></h1>
                <form action="includes/create.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="title">بابەت</label><br>
                    <p class='tooltip-fake'> ئاگاداربە: تەنیا 19 پیت دەردەکەون لەکاتی دانان لە زانستگە</p>

                    <?php
                    if (isset($_GET['title'])) {
                        $title = $_GET['title'];
                        echo "
                        <input type='text' name='title' value=' $title '><br>
                        ";
                    } else {
                        echo '
                        <input type="text" name="title" ><br>
                        ';
                    }
                    ?>

                    <label for="content">ناوەڕۆک</label> <br>
                    <p class='tooltip-fake'> ئاگاداربە: تەنیا 80 پیت دەردەکەون لەکاتی دانان لە زانستگە</p>

                    <?php
                    if (isset($_GET['content'])) {
                        $content = $_GET['content'];
                        echo '
                        <textarea name="content" rows="20">' . $content . ' </textarea><br>
                        ';
                    } else {
                        echo '
                        <textarea name="content" rows="20"></textarea><br>
                        ';
                    }
                    ?>

                    <label for="file-upload" class="custom-file-upload">
                        وێنەیەک هەڵبژێرە
                        <img src="assets/images/cloud.svg" style="color: orange;">
                    </label>
                    <input id="file-upload" type="file" name="uploadfile" /><br>
                    <label for="author">دانەر</label><br>

                    <?php
                    if (isset($_GET['author'])) {
                        $author = $_GET['author'];
                        echo "
                        <input type='text' name='author' value='$author'>
                        ";
                    } else {
                        echo '
                        <input type="text" name="author">
                        ';
                    }
                    ?>

                    <br>
                    <select class="post-type" name="order" id="type">
                        <option default>جۆری پۆست</option>
                        <option value="1">ئایینی</option>
                        <option value="2">کۆمەڵایەتی</option>
                        <option value="3">زانستی</option>
                    </select>
                    <button type="submit" name="creat-post" class="post-type">بڵاوکردنەوە</button>
                </form>
            </div>
        </div>
    </div>
</div>

 
<?php if($_SESSION['adminaccessebility'] !== 3 ){  ?>
<!-- create admin form -->
<div class="post" style="z-index: 1;position:relative">
    <div class="post-row">
        <div class="post-col-img anim-label-simple-fade-out">
            <div class="post-img-container">
                <img src="assets/images/createAdmin.svg" alt="login image">
            </div>
        </div>
        <div class="post-col anim-label-simple-fade-out">
            <div class="post-text-container">
                <h1>دروستکردنی <span class="post">ئادمینی نوێ</span></h1>
                <form action="includes/signup.inc.php" method="POST"  >

                    <label for="adminName">ناوی ئادمین</label><br>

                    <?php
                    if (isset($_GET['name'])) {
                        $name = $_GET['name'];
                        $name = htmlspecialchars($name);
                        echo "
                        <input type='text' name='adminName' value=' $name '><br>
                        ";
                    } else {
                        echo '
                        <input type="text" name="adminName" ><br>
                        ';
                    }
                    ?>

                    <!-- <input type="text" name="adminName"><br> -->

                    <label for="adminEmail">ئیمەیلی ئادمین</label><br>

                    <?php
                    if (isset($_GET['email'])) {
                        
                        $email = $_GET['email'];
                        echo "
                        <input type='text' name='adminEmail' value=' $email '><br>
                        ";
                    } else {
                        echo '
                        <input type="text" name="adminEmail" ><br>
                        ';
                    }
                    ?>
                    <!-- <input type="text" name="adminEmail"><br> -->

                    <label for="adminPwd">پاسوۆردی ئادمین</label><br>
                    <input type="password" name="pwd"><br>

                    <label for="author">پلەی ئادمین</label><br>
                    <select class="post-type-admin" name="order-admin" id="type">
                        <option value="2">گشتی</option>
                        <option value="3">لاوەکی</option>
                    </select>
                    <br>


                    <button type="submit" name="creat-admin" class="post-type">دروستکردن </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete admin form -->
<div class="post" id="anchor-name" style="z-index: 1;position:relative">
    <div class="post-row">
        <div class="post-col-img anim-label-simple-fade-out">
            <div class="post-img-container">
                <img src="assets/images/deleteAdmin.svg" alt="login image">
            </div>
        </div>
        <div class="post-col anim-label-simple-fade-out">
            <div class="post-text-container">
                <h1 class="deleteAdmin">سڕینەوەی <span style="color: red;"> ئادمین</span></h1>
                <form action="includes/delete.inc.php" method="POST">


                    <label for="adminName">ناوی ئادمین</label><br>
                    <input type="text" name="adminName"><br>


                    <label for="adminEmail">ئیمەیلی ئادمین</label><br>
                    <input type="text" name="adminEmail"><br>

                    <label for="author">پلەی ئادمین</label><br>

                    <select class="post-type-admin" name="order-admin" id="type">
                       
                       <?php if($_SESSION['adminaccessebility'] == 1) { ?>
                        <option value="0" hidden>جۆری ئادمین</option>
                        <option value="2">گشتی</option>
                        <option value="3">لاوەکی</option>
                        <?php }else if($_SESSION['adminaccessebility'] == 2){  ?>
                            <option value="3">لاوەکی</option>
                        <?php } ?>
                    </select>

                    <br>
                    <button type="submit" name="delete-admin" class="deleteAdmin-btn btn-hov">سڕینەوەی ئادمین</button>

                   
                </form>
            </div>
        </div>

        <p class="bg-info w-100 text-center align-text-bottom" style="color: black;">Total Visitor: <?php echo getRows('visitors') ?> </p>

    </div>
</div>
<?php } ?>


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
            <?php
            if ($_GET['error'] == 'errorfiletype') { ?>
                <li style="direction: rtl; text-align:right">
                    ببورە جۆری فایلەکەت هەڵەیە </li>
                    <li style="direction: rtl; text-align:right">
                    دەبێت جۆری فایلەکەت png, jpeg بێت </li>
                 
            <?php } ?>

            <?php
            if ($_GET['error'] == 'errorupload') { ?>
                <li style="direction: rtl; text-align:right">
                     کێشەیەک لە دانانی وێنە هەیە </li>
                    
            <?php } ?>
            <?php
            if ($_GET['error'] == 'errorfilesize') { ?>
                <li style="direction: rtl; text-align:right">
                     ببورە قەبارەی فایلەکەت گەورەیە </li>
                     <li style="direction: rtl; text-align:right">
                     قەبارە دەبێت زیاتر نەبێت لە<span>2MB</span> </li>
            <?php } ?>


            <!-- Error handlers for Creating admins -->
            <?php
            if ($_GET['error'] == 'emptyadminfields') { ?>
                <li style="direction: rtl; text-align:right">
                     تکایە بۆشاییەکان پڕبکەوە </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'invaliduid') { ?>
                <li style="direction: rtl; text-align:right">
                     ناوی ئەدمین ڕاستبکەوە </li>
                     <li style="direction: rtl; text-align:right">
                     تەنیا <span>پیت، ژمارە، بۆشایی ڕێگەپێدراوە</span> </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'invalidemail') { ?>
                <li style="direction: rtl; text-align:right">
                     تکایە ئیمەیل بەڕێکی داخل بکە</li>
                     <li style="direction: rtl; text-align:right">
                       example@gmail.com</li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'lesspwdlength') { ?>
                <li style="direction: rtl; text-align:right">
                  پێویستە درێژی ووشەی نهێنی زیاتر بێت لە 8 پیت </li>
                      
            <?php } ?>
            <?php
            if ($_GET['error'] == 'uidexist') { ?>
                <li style="direction: rtl; text-align:right">
                  ئەم ئادمینە پێشتر تۆمارکراوە </li>
                  <li style="direction: rtl; text-align:right">
                  ناتوانی دوو ئادمین بە هەمان ناو یان ئیمەیل دروستبکەیت </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'adminType') { ?>
                <li style="direction: rtl; text-align:right">
                  تکایە جۆری ئادمینەکەت دیاریبکە </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'uidnotexist') { ?>
                <li style="direction: rtl; text-align:right">
                  ئەم ئادمینە تۆمارنەکراوە </li>
            <?php } ?>
        </div>
    </div>

<?php } ?>


<!-- Popup for success admin creation -->
<?php if (isset($_REQUEST['info'])) { ?>

<div class="cover-page ">
    <div class="post-alert access ">
        <?php if ($_GET['info'] == 'admincreatedsuccessfully') {  ?>
            <li style="direction: rtl; text-align:right">
                دروستکردنی ئادمین سەرکەوتووبوو </li>
        <?php } ?>

        <?php if ($_GET['info'] == 'admindeletedsuccessfuly') {  ?>
            <li style="direction: rtl; text-align:right">
                سڕینەوەی ئادمین سەرکەوتووبوو </li>
        <?php } ?>
       
    </div>
</div>

<?php } ?>
<?php
require_once 'footer.php';

?>

<?php }else{  ?>
  <h2 class="snwr">Warning!Just admins can see the setting page!</h2>
<?php }?>

 