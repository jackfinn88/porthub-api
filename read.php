<?php
/**
 * Returns the list of records.
 */
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->user) === '' || trim($request->pass) === '')
  {
    return http_response_code(400);
  }

  // Sanitize.
  $user = mysqli_real_escape_string($con, trim($request->user));
  $pass = mysqli_real_escape_string($con, trim($request->pass));

  $sql = "SELECT
  id,
  user,
  pass,
  ph_cash,
  ph_exp,
  ph_total_exp,
  ph_level,
  ph_completed,
  ph_failed,
  ph_game01_upgrade01_level,
  ph_game01_upgrade02_level,
  ph_game02_upgrade01_level,
  ph_game02_upgrade02_level,
  ph_game01_upgrade01_active,
  ph_game01_upgrade02_active,
  ph_game02_upgrade01_active,
  ph_game02_upgrade02_active,
  ph_game01_dual,
  ph_game02_dual,
  lto_equipped,
  lto_cash,
  lto_exp,
  lto_total_exp,
  lto_player_level,
  lto_player_next_level,
  lto_game_level,
  lto_sfx,
  lto_music,
  lto_difficulty
  FROM `porthub` WHERE `user` = '{$user}' AND `pass` = '{$pass}' LIMIT 1";
  
  if($result = mysqli_query($con,$sql))
  {
    http_response_code(200);

    $row = mysqli_fetch_assoc($result);

    echo json_encode($row);
  }
  else
  {
    return http_response_code(404);
  }
}
else
{
  $records = [];
  $sql = "SELECT
  id,
  user,
  pass,
  ph_cash,
  ph_exp,
  ph_total_exp,
  ph_level,
  ph_completed,
  ph_failed,
  ph_game01_upgrade01_level,
  ph_game01_upgrade02_level,
  ph_game02_upgrade01_level,
  ph_game02_upgrade02_level,
  ph_game01_upgrade01_active,
  ph_game01_upgrade02_active,
  ph_game02_upgrade01_active,
  ph_game02_upgrade02_active,
  ph_game01_dual,
  ph_game02_dual,
  lto_equipped,
  lto_cash,
  lto_exp,
  lto_total_exp,
  lto_player_level,
  lto_player_next_level,
  lto_game_level,
  lto_sfx,
  lto_music,
  lto_difficulty
  FROM `porthub`";

  if($result = mysqli_query($con,$sql))
  {
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
      $records[$i]['id']                         = $row['id'];
      $records[$i]['user']                       = $row['user'];
      $records[$i]['pass']                       = $row['pass'];
      $records[$i]['ph_cash']                    = $row['ph_cash'];
      $records[$i]['ph_exp']                     = $row['ph_exp'];
      $records[$i]['ph_total_exp']               = $row['ph_total_exp'];
      $records[$i]['ph_level']                   = $row['ph_level'];
      $records[$i]['ph_completed']               = $row['ph_completed'];
      $records[$i]['ph_failed']                  = $row['ph_failed'];
      $records[$i]['ph_game01_upgrade01_level']  = $row['ph_game01_upgrade01_level'];
      $records[$i]['ph_game01_upgrade02_level']  = $row['ph_game01_upgrade02_level'];
      $records[$i]['ph_game02_upgrade01_level']  = $row['ph_game02_upgrade01_level'];
      $records[$i]['ph_game02_upgrade02_level']  = $row['ph_game02_upgrade02_level'];
      $records[$i]['ph_game01_upgrade01_active'] = $row['ph_game01_upgrade01_active'];
      $records[$i]['ph_game01_upgrade02_active'] = $row['ph_game01_upgrade02_active'];
      $records[$i]['ph_game02_upgrade01_active'] = $row['ph_game02_upgrade01_active'];
      $records[$i]['ph_game02_upgrade02_active'] = $row['ph_game02_upgrade02_active'];
      $records[$i]['ph_game01_dual']             = $row['ph_game01_dual'];
      $records[$i]['ph_game02_dual']             = $row['ph_game02_dual'];
      $records[$i]['lto_equipped']               = $row['lto_equipped'];
      $records[$i]['lto_cash']                   = $row['lto_cash'];
      $records[$i]['lto_exp']                    = $row['lto_exp'];
      $records[$i]['lto_total_exp']              = $row['lto_total_exp'];
      $records[$i]['lto_player_level']           = $row['lto_player_level'];
      $records[$i]['lto_player_next_level']      = $row['lto_player_next_level'];
      $records[$i]['lto_game_level']             = $row['lto_game_level'];
      $records[$i]['lto_sfx']                    = $row['lto_sfx'];
      $records[$i]['lto_music']                  = $row['lto_music'];
      $records[$i]['lto_difficulty']             = $row['lto_difficulty'];
      $i++;
    }

    echo json_encode($records);
  }
  else
  {
    http_response_code(404);
  }
}

?>