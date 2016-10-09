<?php

require_once 'init.php';
require_once 'response.php';
require_once 'validate.php';
require_once 'database.php';

class Member {

  private $db = null;

  function __construct() {
    $this->db = new Database();
  }

  public function add($data) {
    if (!Validate::member_data($data)) {
      return null;
    }

    // add member
    $date = "datetime('now','localtime')";

    $sql = sprintf("INSERT INTO members (created_user_id, name, description, created_at) VALUES (%d, '%s','%s',".$date.")",
                    intval($data['created_user_id']), $this->db->escape($data['name']), $this->db->escape($data['description']));
    $r = $this->db->query($sql);

    if ($r) {
      $r = $this->find_by_name($data['created_user_id'], $data['name']);
      return $r['id'];
    } else {
      Response::fatal_error("can't add user");
      return null;
    }
  }

  public function set_rate($data, $session) {
    if (!Validate::rate_data($data)) {
      return false;
    }

    // add rate
    $date = "datetime('now','localtime')";

    $sql = "INSERT OR REPLACE INTO member_rates (id, rater_id, members_id, rate, created_at) VALUES (
            (SELECT id FROM member_rates WHERE rater_id = %d AND members_id = %d), %d, %d, %d, ".$date." );";
    $uid = intval($session->get_user_id());
    $mid = intval($data['input-rate-member-id']);
    $sql = sprintf($sql, $uid, $mid, $uid, $mid, intval($data['input-rate']));
    $r = $this->db->query($sql);

    if ($r) {
      return true;
    } else {
      Response::fatal_error("can't add user");
      return false;
    }
  }

  public function get_rate($rater_id, $members_id=null) {
    $sql = "";
    if (is_null($members_id)) {
      $sql = "SELECT * from member_rates WHERE rater_id =".intval($rater_id).";";
    } else {
      $sql = "SELECT * from member_rates WHERE rater_id =".intval($rater_id)." AND members_id = ".intval($members_id).";";
    }
    $r = $this->db->select($sql);

    if (is_null($members_id)) {
      return $r;
    } else {
      if (empty($r[0])) {
        return null;
      } else {
        return $r[0];
      }
    }
  }

  public function find_by_member_name_with_project($name) {
    $sql = "
      SELECT distinct
        u.uname AS created_user,
        p.name AS project_name
      FROM
        projects p,
        members m,
        users u,
        project_member_links pml
      WHERE
        p.id = pml.projects_id AND
        pml.members_id = m.id AND
        p.created_user_id = u.id AND
        m.name = '".$name."';";

    $r = $this->db->select($sql);

    if (empty($r)) {
      return null;
    }

    return $r;
  }

  public function get_rate_with_member_name($rater_id=null, $members_id=null) {
    $sql = "SELECT m.id AS id, m.name AS name, r.rater_id AS rater_id, r.rate AS rate FROM members m, member_rates r WHERE m.id = r.members_id";
    if (!is_null($rater_id)) {
      $sql = $sql." AND r.rater_id = ".intval($rater_id);
    }
   
    if (!is_null($members_id)) {
      $sql = $sql." AND r.members_id = ".intval($members_id);
    }

    $sql .= ";";

    return $this->db->select($sql);
  }

  public function find_by_name($created_user_id=null, $name) {
    if (is_null($created_user_id)) {
      $sql = "SELECT * from members WHERE name = '".$name."';";
    } else {
      $sql = "SELECT * from members WHERE created_user_id =".intval($created_user_id)." AND name = '".$name."';";
    }
    $r = $this->db->select($sql);

    if (is_null($created_user_id)) {
      return $r;
    } else {
      return $r[0];
    }
  }

  public function find_by_id($id) {
    $sql = "SELECT * from members WHERE id = ".intval($id).";";
    $r = $this->db->select($sql);
    return $r[0];
  }

  public function find_all() {
    $sql = "SELECT * from members;";
    return $this->db->select($sql);
  }

  // -- private line --

}
?>
