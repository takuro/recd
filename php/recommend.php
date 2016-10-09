<?php

require_once 'init.php';
require_once 'response.php';
require_once 'validate.php';
require_once 'database.php';
require_once 'member.php';
require_once 'user.php';

class Recommend {
  
  private $db = null;

  function __construct() {
    $this->db = new Database();
  }

  public function get_recommend_member($user_id) {
    $member = new Member();
    $user = new User();

    // get my score
    $my_score = $this->get_score($user_id);
    if (empty($my_score)) {
      return null;
    }

    // get other user score
    $other_score = array();
    $all_user = $user->find_all();
    foreach ($all_user as $u) {
      if (intval($u["id"]) === $user_id) {
        continue;
      }

      $tmp_score = $this->get_score(intval($u["id"]));
      if (empty($tmp_score)) {
        continue;
      }

      $other_score[(string)$u["id"]] = $tmp_score;
    }

    $member_list = array();
    $sim_list = array();
    $previous_other_user_id = null;
    foreach ($other_score as $id => $list) {

      $tmp_sim = $this->pearson($my_score, $list);

      if ($tmp_sim <= 0) {
        continue;
      }

      foreach ($list as $member_name => $score) {
        if (array_key_exists($member_name, $my_score)) {
          continue;
        }

        if (empty($member_list[$member_name])) {
          $member_list[$member_name] = 0;
        }

        $member_list[$member_name] += ($score * $tmp_sim);

        if (empty($sim_list[$member_name])) {
          $sim_list[$member_name] = 0;
        }
        $sim_list[$member_name] += $tmp_sim;
      }
    }

    $member_rank = array();
    foreach($member_list as $name => $score) {
      $member_rank[$name] = ($score / $sim_list[$name]);
    }

    if (empty($member_rank)) {
      return null;
    }

    arsort($member_rank);
    $recommend_member_name = key(array_slice($member_rank, 0, 1));
    $work = $member->find_by_member_name_with_project($recommend_member_name);

    $recommend_member["name"] = $recommend_member_name;
    $recommend_member["work"] = $work;
    return $recommend_member;
  }

  // -- private line --

  private function get_score($user_id) {
    $member = new Member();
    $tmp_score = $member->get_rate_with_member_name($user_id);
    if (empty($tmp_score)) {
      return null;
    }

    $r = array();
    foreach ($tmp_score as $m) {
      $r[(string)$m["name"]] = intval($m["rate"]);
    }

    return $r;
  }

  private function pearson($user1s_score, $user2s_score) {
    // $user1s_score = {
    //   "member_name" => score,
    //   "member_name" => score,
    //   "member_name" => score,
    //      :
    // }

    $common_member = array();

    foreach ($user1s_score as $p1_name => $p1_score) {
      if (array_key_exists($p1_name, $user2s_score)) {
        array_push($common_member, $p1_name);
      }
    }

    if (empty($common_member)) {
      return 0;
    }

    $score1 = 0;
    $score2 = 0;
    $score1_sq = 0;
    $score2_sq = 0;
    $p_sum = 0;
    foreach($common_member as $name) {
      $score1 += intval($user1s_score[$name]);
      $score2 += intval($user2s_score[$name]);

      $score1_sq += pow(intval($user1s_score[$name]), 2);
      $score2_sq += pow(intval($user2s_score[$name]), 2);

      $p_sum += intval($user1s_score[$name]) * intval($user2s_score[$name]);
    }

    // calc pearson
    $num = $p_sum - ($score1 * $score2 / count($common_member));
    $den = sqrt(($score1_sq - pow($score1, 2) / count($common_member))
              * ($score2_sq - pow($score2, 2) / count($common_member)));

    if ($den == 0) {
      return 0;
    }

    $r = $num / $den;

    return $r;

  }

}

?>
