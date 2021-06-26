<?php
require_once 'header.php';
require_once 'includes/dbh.inc.php';
?>

<div class="card-group cord-containers">

  <div class="row d-flex justify-content-center">

    <?php
    $sub = 'zansti';
    $sql = "SELECT * FROM $sub ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);
    // if we have data show us
    $posts = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (mysqli_num_rows($query) > 0) {
      foreach ($posts as $post) {
        $contDisp = mb_substr($post['content'], 0, 80, 'utf-8');
        $titleTrim = mb_substr($post['title'], 0, 19, 'utf-8');
    ?>
        <div class="card p-0 col-lg-4 col-md-6  col-sm-12  anim-label-simple-fade-out">
          <?php if ($post['state'] == 1) {  ?>
            <img class="card-img-top card-img" src="uploads/<?php echo htmlspecialchars($post['filename']) ?>" alt="Card image cap">
          <?php } else { ?>
            <img class="card-img-top card-img" src="assets/images/defaultQuran.jpg" alt="Card image cap">
          <?php } ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($titleTrim) ?></h5>

            <p class="card-text"><?php echo htmlspecialchars($contDisp) ?></p>
            <p class="card-text"><small class="text-muted">لەلایەن : <?php echo htmlspecialchars($post['created_by']) ?></small></p>


            <?php if (!isset($_SESSION['useruid'])) { ?>
              <a href="view.php?id=<?php echo $post['id'] ?>&sub=<?php echo $sub ?>"> <button class="btn-small">زیاتر بخوێنەوە</button></a>
            <?php } else {  ?>
              <a href="view.php?id=<?php echo $post['id'] ?>&sub=<?php echo $sub ?>"> <button class="btn-small">زیاتر بخوێنەوە</button></a>
              <a href="edit.php?id=<?php echo $post['id'] ?>&sub=<?php echo $sub ?>"> <button class="btn-small editor">گۆڕانکاریکردن</button></a>
            <?php } ?>


          </div>
        </div>
      <?php }
    } else {  ?>
      <div style="text-align: center;color: green">
        <h5 class="anim-label-simple-fade-out">ببورە! هیچ پۆستێک بەردەست نیە</h5>
      </div>
    <?php } ?>
  </div>
</div>

<?php if (isset($_REQUEST['info'])) { ?>
  <div class="cover-page ">
    <div class="post-alert access ">
      <?php if ($_GET['info'] == 'updated') {  ?>
        <li style="direction: rtl; text-align:right">
          نوێکردنەوە سەرکەوتووبوو</li>
      <?php } ?>

      <?php if ($_GET['info'] == 'deleted') {  ?>
        <li style="direction: rtl; text-align:right">
          سڕینەوەی پۆست سەرکەوتووبوو</li>
      <?php } ?>

      <?php if ($_GET['info'] == 'postcreatedsuccefuly') {  ?>
        <li style="direction: rtl; text-align:right">
          دانانی پۆست سەرکەوتووبوو </li>
      <?php } ?>
    </div>
  </div>
<?php } ?>



<?php
require_once 'footer.php';

?>