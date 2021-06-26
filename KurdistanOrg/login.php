<?php
require_once 'header.php';


?>

<div class="login">
    <div class="login-row">
        <div class="login-col-img left-col">
            <div class="login-img-container">
                <img src="assets/images/login.svg" alt="login image">
            </div>
        </div>

        <div class="login-col right-col" style="z-index: -10000;">
            <div class="login-text-container">
                <h1 class="contact-title">چوونەژوورەوە</h1>
                <form action="includes/login.inc.php" method="POST">
                    <label for="name">ناو/ئیمەیل</label><br>
                    <input type="text" name="username"><br>
                    <label for="pwd">وشەی نهێنی</label> <br>
                    <input type="password" name="pwd"><br>
                    <label for="author">پلەی ئادمین</label><br>

                    <select class="post-type-admin" name="order-admin" id="type">
                        <option value="0" hidden>جۆری ئادمین</option>
                        <option value="1">سەرەکی</option>
                        <option value="2">گشتی</option>
                        <option value="3">لاوەکی</option>
                    </select>

                    <br>
                    <button type="submit" name="submit-login" class="btn-login">چوونەژوورەوە</button>
                </form>
                <div class="exclan">
                    <p>چوونەژوورەوە تەنیا بۆ ئادمینە <img src="assets/images/exclanation.svg" width="15px" alt="exclanation img"> </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (isset($_REQUEST['error'])) { ?>

    <div class="cover-page">

        <div class="post-alert ">
            <?php if ($_GET['error'] == 'empty') {  ?>
                <li style="direction: rtl; text-align:right">
                    تکایە زانیاریەکان داخل بکە </li>
            <?php }
            if ($_GET['error'] == 'pwdsmalllength') { ?>
                <li style="direction: rtl; text-align:right">
                    وشەی نهێنی دەبێت زیاتربێت لە 8 پیت </li>
            <?php }
            if ($_GET['error'] == 'usernotexist') { ?>
                <li style="direction: rtl; text-align:right">
                    ببورە زانیاریەکانت هەڵەیە </li>
                <li style="direction: rtl; text-align:right">
                    بۆ داخل بوون پەیوەندی بە ئادمینەوە بکە </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'stmtfail') { ?>
                <li style="direction: rtl; text-align:right">
                    ببورە هەڵەیەک ڕوویداوە </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'wrongpwd') { ?>
                <li style="direction: rtl; text-align:right">
                    وشەی نهێنی هەڵەیە، تکایە دووبارەی بکەوە </li>
            <?php } ?>
            <?php
            if ($_GET['error'] == 'adminType') { ?>
                <li style="direction: rtl; text-align:right">
                      تکایە جۆری ئادمینەکەت دیاریبکە </li>
            <?php } ?>
        </div>
    </div>

<?php } ?>

<?php
require_once 'footer.php';

?>