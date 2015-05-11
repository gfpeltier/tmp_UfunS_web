<?php

    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mxOxo74S79';
	
	try{
      $dbh = new PDO("mysql:host=$hostname;dbname=user_data", $username, $password);
      /*** echo a message saying we have connected ***/
      //echo 'Connected to database';
        $mPerLat = 111000;
        $mPerLng = 89000;
        
      $lat = $_REQUEST["lat"];
      $lng = $_REQUEST["lng"];
      $radius = $_REQUEST["radius"];
        
        $NELat = $lat + ($radius/$mPerLat);
        $NELng = $lng + ($radius/$mPerLng);
        
        $SWLat = $lat - ($radius/$mPerLat);
        $SWLng = $lng - ($radius/$mPerLng);

      $sql = "SELECT * FROM gems WHERE latitude>'" . $SWLat . "' AND latitude<'" . $NELat . "' AND longitude>'" . $SWLng . "' AND longitude<'" . $NELng . "'";

      /*** fetch into an PDOStatement object ***/
      $stmt = $dbh->query($sql);

      /*** echo number of columns ***/
      $obj = $stmt->fetchAll(PDO::FETCH_OBJ);

      if(isset($obj[0])){
        echo '{"code":"success", "object": ' . json_encode($obj) . '}';
      }else{echo '{"code":"noMatch"}';}

      /** close connection **/
      $dbh = null;
    }catch(PDOException $e){
      echo $e->getMessage();
    }
?>