<?php

class Validate {

  function __construct() {
  }

  public static function uri($uri) {
    // empty check
    if (empty($uri)) { return null; }

    // cleanup
    $uri = trim($uri);

    // is uri?
    $check = filter_var($uri, FILTER_VALIDATE_URL,
                              FILTER_FLAG_SCHEME_REQUIRED,
                              FILTER_FLAG_PATH_REQUIRED);

    if ($check === false) { return null; }

    return $uri;
  }

  public static function login_data($data) {
    // empty check
    if (empty($data)) { return false; }
    if (empty($data['uname'])) { return false; }
    if (empty($data['password'])) { return false; }

    return true;
  }

  public static function signup_data($data) {
    // empty check
    if (empty($data)) { return false; }
    if (empty($data['new-uname'])) { return false; }
    if (empty($data['new-password'])) { return false; }

    return true;
  }

  public static function member_data($data) {
    // empty check
    if (empty($data)) { return false; }
    if (empty($data['created_user_id'])) { return false; }
    if (empty($data['name'])) { return false; }

    return true;
  }

  public static function project_data($data) {
    // empty check
    if (empty($data)) { return false; }
    if (empty($data['add-project-name'])) { return false; }
    if (empty($data['add-project-description'])) { return false; }
    if (empty($data['add-project-member-01'])) { return false; }

    return true;
  }

  public static function rate_data($data) {
    // empty check
    if (empty($data)) { return false; }
    if (empty($data['input-rate'])) { return false; }
    if (empty($data['input-rate-member-id'])) { return false; }

    // numeric check
    if (intval($data['input-rate']) < 0 || intval($data['input-rate']) > 4) { 
      return false; 
    }

    return true;
  }

}

?>
