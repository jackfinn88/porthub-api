<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if(
    trim($request->user) === ''
    ||
    trim($request->pass) === ''
    ||
    (int)$request->ph_cash < 0
    ||
    (int)$request->ph_exp < 0
    ||
    (int)$request->ph_total_exp < 0
    ||
    (int)$request->ph_level < 0
    ||
    (int)$request->ph_completed < 0
    ||
    (int)$request->ph_failed < 0
    ||
    (int)$request->ph_game01_upgrade01_level < 0
    ||
    (int)$request->ph_game01_upgrade02_level < 0
    ||
    (int)$request->ph_game02_upgrade01_level < 0
    ||
    (int)$request->ph_game02_upgrade02_level < 0
    ||
    (int)$request->ph_game01_upgrade01_active < 0
    ||
    (int)$request->ph_game01_upgrade02_active < 0
    ||
    (int)$request->ph_game02_upgrade01_active < 0
    ||
    (int)$request->ph_game02_upgrade02_active < 0
    ||
    (int)$request->ph_game01_dual < 0
    ||
    (int)$request->ph_game02_dual < 0
    ||
    trim($request->lto_equipped) === ''
    ||
    (int)$request->lto_cash < 0
    ||
    (int)$request->lto_exp < 0
    ||
    (int)$request->lto_total_exp < 0
    ||
    (int)$request->lto_player_level < 0
    ||
    (int)$request->lto_player_next_level < 0
    ||
    (int)$request->lto_game_level < 0
    ||
    (int)$request->lto_sfx < 0
    ||
    (int)$request->lto_music < 0
    ||
    (int)$request->lto_difficulty < 0
    )
  {
    return http_response_code(400);
  }

  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $user = mysqli_real_escape_string($con, trim($request->user));
  $pass = mysqli_real_escape_string($con, trim($request->pass));
  $ph_cash = mysqli_real_escape_string($con, (int)$request->ph_cash);
  $ph_exp = mysqli_real_escape_string($con, (int)$request->ph_exp);
  $ph_total_exp = mysqli_real_escape_string($con, (int)$request->ph_total_exp);
  $ph_level = mysqli_real_escape_string($con, (int)$request->ph_level);
  $ph_completed = mysqli_real_escape_string($con, (int)$request->ph_completed);
  $ph_failed = mysqli_real_escape_string($con, (int)$request->ph_failed);
  $ph_game01_upgrade01_level = mysqli_real_escape_string($con, (int)$request->ph_game01_upgrade01_level);
  $ph_game01_upgrade02_level = mysqli_real_escape_string($con, (int)$request->ph_game01_upgrade02_level);
  $ph_game02_upgrade01_level = mysqli_real_escape_string($con, (int)$request->ph_game02_upgrade01_level);
  $ph_game02_upgrade02_level = mysqli_real_escape_string($con, (int)$request->ph_game02_upgrade02_level);
  $ph_game01_upgrade01_active = mysqli_real_escape_string($con, (int)$request->ph_game01_upgrade01_active);
  $ph_game01_upgrade02_active = mysqli_real_escape_string($con, (int)$request->ph_game01_upgrade02_active);
  $ph_game02_upgrade01_active = mysqli_real_escape_string($con, (int)$request->ph_game02_upgrade01_active);
  $ph_game02_upgrade02_active = mysqli_real_escape_string($con, (int)$request->ph_game02_upgrade02_active);
  $ph_game01_dual = mysqli_real_escape_string($con, (int)$request->ph_game01_dual);
  $ph_game02_dual = mysqli_real_escape_string($con, (int)$request->ph_game02_dual);
  $lto_equipped = mysqli_real_escape_string($con, trim($request->lto_equipped));
  $lto_cash = mysqli_real_escape_string($con, (int)$request->lto_cash);
  $lto_exp = mysqli_real_escape_string($con, (int)$request->lto_exp);
  $lto_total_exp = mysqli_real_escape_string($con, (int)$request->lto_total_exp);
  $lto_player_level = mysqli_real_escape_string($con, (int)$request->lto_player_level);
  $lto_player_next_level = mysqli_real_escape_string($con, (int)$request->lto_player_next_level);
  $lto_game_level = mysqli_real_escape_string($con, (int)$request->lto_game_level);
  $lto_sfx = mysqli_real_escape_string($con, (int)$request->lto_sfx);
  $lto_music = mysqli_real_escape_string($con, (int)$request->lto_music);
  $lto_difficulty = mysqli_real_escape_string($con, (int)$request->lto_difficulty);

  // Update.
  $sql = "UPDATE `porthub` SET
    `user`='$user',
    `pass`='$pass',
    `ph_cash`='$ph_cash',
    `ph_exp`='$ph_exp',
    `ph_total_exp`='$ph_total_exp',
    `ph_level`='$ph_level',
    `ph_completed`='$ph_completed',
    `ph_failed`='$ph_failed',
    `ph_game01_upgrade01_level`='$ph_game01_upgrade01_level',
    `ph_game01_upgrade02_level`='$ph_game01_upgrade02_level',
    `ph_game02_upgrade01_level`='$ph_game02_upgrade01_level',
    `ph_game02_upgrade02_level`='$ph_game02_upgrade02_level',
    `ph_game01_upgrade01_active`='$ph_game01_upgrade01_active',
    `ph_game01_upgrade02_active`='$ph_game01_upgrade02_active',
    `ph_game02_upgrade01_active`='$ph_game02_upgrade01_active',
    `ph_game02_upgrade02_active`='$ph_game02_upgrade02_active',
    `ph_game01_dual`='$ph_game01_dual',
    `ph_game02_dual`='$ph_game02_dual',
    `lto_equipped`='$lto_equipped',
    `lto_cash`='$lto_cash',
    `lto_exp`='$lto_exp',
    `lto_total_exp`='$lto_total_exp',
    `lto_player_level`='$lto_player_level',
    `lto_player_next_level`='$lto_player_next_level',
    `lto_game_level`='$lto_game_level',
    `lto_sfx`='$lto_sfx',
    `lto_music`='$lto_music',
    `lto_difficulty`='$lto_difficulty' WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}

?>