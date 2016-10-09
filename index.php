<?php
  require_once 'php/init.php';
  require_once 'php/passport.php';
  require_once 'php/global_html_header.php';
?>

<main class="mdl-layout__content mdl-color--grey-100">

  <div id="project-history">
    <h4 class="description-header">参加したプロジェクト</h4>
    <div class="mdl-grid">

      <?php
        if (!is_null($my_project)) {
          foreach($my_project as $p) {
      ?>
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title work-name">
                <h2 class="mdl-card__title-text"><?php echo $p['name']; ?></h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                <?php echo nl2br($p['description']); ?>
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Read More</a>
              </div>
            </div>
      <?php
          }
        }
      ?>

      <a href="add_project.php"
         class="add-button mdl-card mdl-color-text--grey-500 mdl-shadow--2dp 
                mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop mdl-button mdl-js-button mdl-js-ripple-effect">+</a>

    </div>
  </div>

  <div id="member-history">
    <h4 class="description-header">いっしょに働いたメンバ</h4>
    <div class="mdl-grid">

      <?php
        if (!is_null($my_project)) {
          foreach($my_project as $p) {
            foreach($p['members'] as $id => $m) {
              $rate = $member->get_rate($session->get_user_id(), $id);
              if (empty($rate)) {
                $rate = 0;
              } else {
                $rate = intval($rate['rate']);
              }

      ?>
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop mdl-color-text--grey-700">
              <div class="mdl-card__title member-name">
                <h2 class="mdl-card__title-text">
                  <?php echo $m['name']; ?> さん
                </h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                "<?php echo $p['name']; ?>" で一緒でした。
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <div class="mdl-card__title">
                  <span class="mdl-card__title-text mdl-color-text--grey-600">
                    この人の評価
                  </span>
                </div>
                <form action="" method="POST">
                  <p>
                  <input class="mdl-slider mdl-js-slider" type="range" name="input-rate" id="input-rate" min="0" max="4" value="<?php echo $rate; ?>" step="1" />
                    <input type="hidden" name="input-rate-member-id" id="input-rate-member-id" value="<?php echo $id ?>" />
                  </p>
                  <p><input type="submit" name="submit-rate" value="評価する" class="mdl-button mdl-js-button" /></p>
                </form>
              </div>
            </div>
      <?php
            }
          }
        }
      ?>


    </div>
  </div>

</main>

<?php
  require_once 'php/global_html_footer.php'
?>
