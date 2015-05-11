<?php

    $hostname = '127.0.0.1';
    $user = 'root';
    $password = 'mxOxo74S79';

    try{
      $dbh = new PDO("mysql:host=$hostname;dbname=user_data", $user, $password);
      /*** echo a message saying we have connected ***/
      //echo 'Connected to database';

      $sql = "SELECT * FROM users WHERE device_id='" . $_REQUEST["deviceId"] . "'";

      /*** fetch into an PDOStatement object ***/
      $stmt = $dbh->query($sql);

      /*** echo number of columns ***/
      $obj = $stmt->fetchAll(PDO::FETCH_OBJ);

      if(isset($obj[0])){
        echo '{"code":"success", "object": ' . json_encode($obj[0]) . '}';
      }else{echo '{"code":"noMatch"}';}

      /** close connection **/
      $dbh = null;
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  ?>