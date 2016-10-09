<?php
  require_once 'php/init.php';
  require_once 'php/passport.php';
  require_once 'php/recommend.php';

  $recommend = new Recommend;
  $recommend_member = $recommend->get_recommend_member($session->get_user_id());

  require_once 'php/global_html_header.php';
?>

<main class="mdl-layout__content mdl-color--grey-100">

  <div id="project-history">
    <h4 class="description-header">
      プロジェクトの登録
    </h4>
    <div class="mdl-grid">

      <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
        <div class="mdl-card__actions">
          <form method="POST" action="">

            <ul class="mdl-list">
              <div class="description-header">
                まず、プロジェクトの名前を決めます。
              </div>
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                  <input class="mdl-textfield__input" type="text" id="add-project-name" name="add-project-name" />
                  <label class="mdl-textfield__label" for="add-project-name">名前</label>
                </span>
              </li>

              <div class="description-header">
                次に、プロジェクトの概要を書きます。
              </div>
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                  <textarea class="mdl-textfield__input" type="text" rows= "3" id="add-project-description" name="add-project-description"></textarea>
                  <label class="mdl-textfield__label" for="add-project-description">概要</label>
                </span>
              </li>

              <div class="description-header">
                最後に、プロジェクトのメンバーを決めます。
              </div>
              <li class="mdl-list__item">
                <ul class="demo-list-icon mdl-list">

                  <li class="mdl-list__item">
                    <span class="member-list-icon"><i class="material-icons mdl-list__item-icon">person</i></span>
                    <span class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="add-project-member-01" name="add-project-member-01" />
                      <label class="mdl-textfield__label" for="add-project-member-01">名前</label>
                    </span>
                  </li>

                  <li class="mdl-list__item">
                    <span class="member-list-icon"><i class="material-icons mdl-list__item-icon">person</i></span>
                    <span class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="add-project-member-02" name="add-project-member-02" />
                      <label class="mdl-textfield__label" for="add-project-member-02">名前</label>
                    </span>
                  </li>

                  <li class="mdl-list__item">
                    <span class="member-list-icon"><i class="material-icons mdl-list__item-icon">person</i></span>
                    <span class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="add-project-member-03" name="add-project-member-03" />
                      <label class="mdl-textfield__label" for="add-project-member-03">名前</label>
                    </span>
                  </li>

                  <li class="mdl-list__item">
                    <span class="member-list-icon"><i class="material-icons mdl-list__item-icon">person</i></span>
                    <span id="recommend-user-area" class="mdl-list__item-primary-content mdl-textfield mdl-js-textfield">
                      <input class="mdl-textfield__input" type="text" id="add-project-member-04" name="add-project-member-04" value="" />
                    </span>
                    
                    <div id="recommend-button">
                      <a id="show-recommend-dialog" class="mdl-button mdl-js-button mdl-button--primary">
                        あなたへのおすすめ
                      </a>
                      <dialog id="recommend-dialog" class="mdl-dialog">
                        <h4 class="mdl-dialog__title">あなたへのおすすめ</h4>

                        <?php
                          
                        if (empty($recommend_member)) {
                        ?>
                          <div class="mdl-dialog__content">
                            <p>
                              すみません...おすすめできるメンバーはまだいません。
                            </p>
                          </div>
                          <div class="mdl-dialog__actions">
                            <a id="cancel-recommend-member" class="mdl-button close">閉じる</a>
                          </div>

                        <?php
                        } else {
                        ?>
                          <div class="mdl-dialog__content">
                            <p>
                              <b><?php echo $recommend_member["name"]; ?> さん</b>はどうですか？
                            </p>
                            <p>
                              <?php echo $recommend_member["work"][0]["created_user"] ?>さんの " <?php echo $recommend_member["work"][0]["project_name"] ?> " というプロジェクトなどを行っていました。
                            </p>
                          </div>
                          <div class="mdl-dialog__actions">
                            <input type="hidden" id="hidden-recommend-user-name" value="<?php echo $recommend_member["name"]; ?>" />
                            <a id="assign-recommend-member" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">アサインする</a>
                            <a id="cancel-recommend-member" class="mdl-button close">キャンセル</a>
                          </div>
                        
                        <?php
                        }
                        ?>
                      </dialog>
                    </div>
                  </li>
                </ul>

              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <input type="submit" name="add-project-submit" value="登録" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
                </span>
              </li>
            </ul>

          </form>
        </div>
      </div>

    </div>
  </div>

</main>

<?php
  require_once 'php/global_html_footer.php'
?>
