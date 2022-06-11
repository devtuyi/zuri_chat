<?php
class chatClass {
  public static function getRestChatLines() {
    $arr = array();
    $line = new stdClass;
    if(!file_exists("../storage/chats.csv")) {
      $handle = fopen("../storage/chats.csv", "w");
      fclose($handle);
    }
    if(($handle = fopen("../storage/chats.csv", "r")) !== FALSE) {
      fseek($handle, $_SESSION["lastID"]);
      $arr[] = array("data", true);
      while(($data = fgetcsv($handle)) !== FALSE) {
        $_SESSION["lastID"] = ftell($handle);
        $line->username = $data[0];
        $line->user_name = $data[1];
        $line->chattime = $data[2];
        $line->chattext = $data[3];
        $arr[] = json_encode($line);
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
}
?>