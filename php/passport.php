<?php

require_once 'init.php';
require_once 'response.php';
require_once 'user.php';
require_once 'session.php';
require_once 'project.php';
require_once 'member.php';

$response = new Response();
$session = new Session();
$self = $_SERVER['SCRIPT_FILENAME'];
$my_project = null;

if (!empty($_GET['session'])){

  if ($_GET['session'] === 'logout') {
    // log out
    $session->logout();
    $response->call('go_to_login_form');
  } else {
    $response->call('go_to_login_form');
  }

} else if (!empty($_POST['login'])) {

  // from login form
  $user = new User();
  $user->login($_POST);

} else if (!empty($_POST['signup'])) {

  if (ALLOW_NEW_USER) {
    // from sign up form
    $user = new User();
    $user->signup($_POST);
  } else {
    $response->call('go_to_login_form');
  }

} else if ($session->has_session()) {

  // This user authenticated.
  if ($self === APP_ROOT.'/index.php') {
    // from index
    $project = new Project();
    $my_project = $project->find_by_created_user_id_with_member($session->get_user_id());

    $member = new Member();

    if (!empty($_POST['submit-rate'])) {
      $member = new Member();
      $member->set_rate($_POST, $session);
      $response->call('go_to_index_with_id', 'member-history');
    }
  } else if ($self === APP_ROOT.'/add_project.php') {
    // from add_project

    if (!empty($_POST['add-project-submit'])) {
      $project = new Project();
      $project->add($_POST, $session);
      $response->call('go_to_index');
    }
  } else {
    $response->call('go_to_index');
  }

} else if ($self === APP_ROOT.'/login.php') {

  // from login page
} else {

  // undefined
  $response->call('go_to_login_form');

}

return;

?>
