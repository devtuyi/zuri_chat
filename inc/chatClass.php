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
        // if($_COOKIE["lastID"] == 0) {
        //   $id = filesize("./storage/chats.csv");
        // } else {
        //   $id = $_COOKIE["lastID"];
        // }
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
      $time = time();
      $chattext = strip_tags($chattext);
      if(!empty($chattext) && ($handle = fopen("./storage/chats.csv", "a")) !== FALSE) {
          fputcsv($handle, [$username, $user_name, $time, $chattext]);
          fclose($handle);
      }
    }
  }
?>