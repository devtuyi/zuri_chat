<?php

  class chatClass {
    public static function getRestChatLines($id) {
      if(!file_exists("./storage/chats.csv")) {
        $handle = fopen("./storage/chats.csv", "w");
        fclose($handle);
      }
      $arr = array();
      $line = new stdClass;
      if(($handle = fopen("./storage/chats.csv", "r")) !== FALSE) {
        fseek($handle, $id);
        while(($data = fgetcsv($handle)) !== FALSE) {
          if($data[2])
          $line->id = ftell($handle);
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
      if(!empty($chattext) && ($handle = fopen("./storage/chats.csv", "a")) !== FALSE) {
          fputcsv($handle, array($username, $user_name, time(), $chattext));
          fclose($handle);
      }
    }
  }
?>