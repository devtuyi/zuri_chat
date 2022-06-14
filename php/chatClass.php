<?php
class chatClass {
  public static function getStartChatLines() {
    $arr = array();
    $line = new stdClass;
    $i = 1;
    if(($handle = fopen("../storage/chats.csv", "a+")) !== FALSE && isset($_SESSION["firstID"])) {
      fseek($handle, $_SESSION["firstID"]);
      $arr[] = array("data", true);
      while(($data = fgetcsv($handle)) !== FALSE) {
        if($i > 10) break;
        $_SESSION["lastID"] = ftell($handle);
        $line->username = $data[0];
        $line->user_name = $data[1];
        $line->chattime = $data[2];
        $line->chattext = $data[3];
        $arr[] = json_encode($line);
        $i++;
      }
    fclose($handle);
    }
    return json_encode($arr);
  }

  public static function getRestChatLines() {
    $arr = array();
    $line = new stdClass;
    $i = 1;
    if(($handle = fopen("../storage/chats.csv", "r")) !== FALSE && isset($_SESSION["lastID"])) {
      fseek($handle, $_SESSION["lastID"]);
      $arr[] = array("data", true);
      while(($data = fgetcsv($handle)) !== FALSE) {
        if($i > 10) break;
        $_SESSION["lastID"] = ftell($handle);
        $line->username = $data[0];
        $line->user_name = $data[1];
        $line->chattime = $data[2];
        $line->chattext = $data[3];
        $arr[] = json_encode($line);
        $i++;
      }
    fclose($handle);
    }
    return json_encode($arr);
  }
  public static function setChatLines($username, $user_name, $chattext) {
    $chattext = strip_tags($chattext);
    if(!empty($chattext) && ($handle = fopen("../storage/chats.csv", "a")) !== FALSE) {
        fputcsv($handle, array($username, $user_name, time(), $chattext));
        fclose($handle);
    }
  }
  public static function setOnline() {
    $options = session_get_cookie_params();
    setcookie(session_name(), session_id(), time() + 1800, $options["path"], $options["domain"], $options["secure"], $options["httponly"]);
  }
  public static function setOffline() {
    $options = session_get_cookie_params();
    setcookie(session_name(), "", time() - 1800, $options["path"], $options["domain"], $options["secure"], $options["httponly"]);
  }
}
?>
