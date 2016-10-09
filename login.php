<?php
  require_once 'php/init.php';
  require_once 'php/passport.php';
  require_once 'php/global_html_header.php'
?>

<main class="mdl-layout__content mdl-color--grey-100 login-main">
  <div class="mdl-grid">

    <div id="login-signup-form" class="mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col content">
      <div id="login-form">
        <h2 class="mdl-card__title-text">Login</h2>
        <form method="POST" action="">
          <span class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" name="uname" id="uname" />
            <label class="mdl-textfield__label" for="uname">ユーザ名</label>
          </span>

          <span class="mdl-textfield mdl-js-textfield">
            <input type="password" name="password" id="password" class="mdl-textfield__input" />
            <label class="mdl-textfield__label" for="password">パスワード</label>
          </span>
          
          <span>
            <input type="submit" name="login" value="Login" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
          </span>

        </form>
      </div>

      <?php if (ALLOW_NEW_USER) { ?>
        <div id="signup-form">
          <h2 class="mdl-card__title-text">New to <?php echo SITE_NAME; ?>?</h2>
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
      <?php } ?>
    </div>

  </div>
</main>

<?php
  require_once 'php/global_html_footer.php'
?>
