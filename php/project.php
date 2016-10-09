<?php

require_once 'init.php';
require_once 'response.php';
require_once 'validate.php';
require_once 'database.php';
require_once 'member.php';

class Project {

  private $db = null;

  function __construct() {
    $this->db = new Database();
  }

  public function add($data, $session) {
    if (!Validate::project_data($data)) {
      return false;
    }

    $created_user_id = $session->get_user_id();

    // add project
    $date = "datetime('now','localtime')";

    $sql = sprintf("INSERT INTO projects (created_user_id, name, description, created_at) VALUES (%d, '%s','%s',".$date.")",
                    intval($created_user_id), $this->db->escape($data['add-project-name']), $this->db->escape($data['add-project-description']));
    $add_project_result = $this->db->query($sql);

    if ($add_project_result) {
      $add_project_result = $this->find_by_name($created_user_id, $data['add-project-name']);
    } else {
      Response::fatal_error("can't add user");
      return false;
    }

    // add members
    $member_count = 0;
    $member = new Member();
    while(1) {
      $member_count += 1;
      $member_data['created_user_id'] = intval($created_user_id);
      $member_data['name'] = $data['add-project-member-'.sprintf('%02d', $member_count)];
      $member_data['description'] = '';

      $add_member_result = $member->add($member_data);

      if (is_null($add_member_result)) {
        break;
      }

      // add links
      $sql = sprintf("INSERT INTO project_member_links (projects_id, members_id, finished, created_at) VALUES (%d, %d,'no',".$date.")",
                      intval($add_project_result['id']), intval($add_member_result));
      $add_link_result = $this->db->query($sql);

    }

  }
  
  public function find_by_name($created_user_id, $name) {
    $sql = "SELECT * from projects WHERE created_user_id = ".intval($created_user_id)." AND name = '".$name."';";
    $r = $this->db->select($sql);
    return $r[0];
  }

  public function find_by_id($id) {
    $sql = "SELECT * from projects WHERE id = ".intval($id).";";
    $r = $this->db->select($sql);
    return $r[0];
  }

  public function find_by_created_user_id($id) {
    $sql = "SELECT * from projects WHERE created_user_id = ".intval($id).";";
    $r = $this->db->select($sql);
    return $r[0];
  }

  public function find_by_created_user_id_with_member($id) {
    $sql = "
      SELECT
        p.id AS project_id,
        p.name AS project_name,
        p.description AS project_description,
        m.id AS member_id,
        m.name AS member_name,
        m.description AS member_description
      FROM
        projects p,
        members m,
        project_member_links pml
      WHERE
        p.id = pml.projects_id AND
        pml.members_id = m.id AND
        p.created_user_id = ".intval($id).";";

    $r = $this->db->select($sql);

    if (empty($r)) {
      return null;
    }

    $projects = null;
    foreach($r as $p) {
      $projects[(string)$p['project_id']]['name'] = $p['project_name'];
      $projects[(string)$p['project_id']]['description'] = $p['project_description'];
      $projects[(string)$p['project_id']]['members'][(string)$p['member_id']]['name'] = $p['member_name'];
      $projects[(string)$p['project_id']]['members'][(string)$p['member_id']]['description'] = $p['member_description'];
    }

    return $projects;
  }

  public function find_all() {
    $sql = "SELECT * from projects;";
    return $this->db->select($sql);
  }

  // -- private line --

}
?>
