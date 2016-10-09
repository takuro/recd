<?php
  require_once 'php/init.php';
  require_once 'php/passport.php';
  require_once 'php/global_html_header.php'
?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid">
    <div id="login-page-main" class="mdl-shadow--2dp mdl-cell mdl-cell--12-col content">
      <h1>メンバの決定をサポート</h1>
      <div class="mdl-textfield mdl-js-textfield">
        <p>独自の推薦システムでプロジェクトメンバを探します。</p>
      </div>
    </div>

    <div id="login-signup-form" class="mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--6-col content">
      <div id="login-form">
        <h2 class="mdl-card__title-text">ログイン</h2>
        <form method="POST" action="">
          <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" name="uname" id="uname" />
            <label class="mdl-textfield__label" for="uname">ユーザ名</label>
          </div>

          <div class="mdl-textfield mdl-js-textfield">
            <input type="password" name="password" id="password" class="mdl-textfield__input" />
            <label class="mdl-textfield__label" for="password">パスワード</label>
          </div>
          
          <div>
            <input type="submit" name="login" value="Login" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
          </div>

        </form>
      </div>
    </div>

    <?php if (ALLOW_NEW_USER) { ?>
    <div id="login-signup-form" class="mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--6-col content">
        <div id="signup-form">
          <h2 class="mdl-card__title-text">新規登録しますか？</h2>
          <form method="POST" action="">
            <span class="mdl-textfield mdl-js-textfield">
              <input class="mdl-textfield__input" type="text" name="new-uname" id="new-uname" />
              <label class="mdl-textfield__label" for="new-uname">ユーザ名</label>
            </span>
            <span class="mdl-textfield mdl-js-textfield">
              <input type="password" name="new-password" id="new-password" class="mdl-textfield__input" />
              <label class="mdl-textfield__label" for="new-password">パスワード</label>
            </span>
            <input type="submit" name="signup" value="Sign up for <?php echo SITE_NAME; ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
          </form>
        </div>
    </div>
    <?php } ?>

  </div>
</main>

<?php
  require_once 'php/global_html_footer.php'
?>
