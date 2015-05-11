<?php
//     // Create connection
//     $con=mysqli_connect("127.0.0.1","root","jwf1293","test");

    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mxOxo74S79';

    try {
      $dbh = new PDO("mysql:host=$hostname;dbname=user_data", $username, $password);
      /*** echo a message saying we have connected ***/
      //echo 'Connected to database<br />';
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      $sql = "INSERT INTO `users` (`device_id`, `user_email`, `user_name`, `user_id`) VALUES ('" . $_REQUEST['deviceId'] . "', '" . $_REQUEST['userEmail'] . "', '" . $_REQUEST['userName'] ."', '" . $_REQUEST['userId'] ."')";


      $count = $dbh->exec($sql);

      $id = $dbh->lastInsertId();



       if(!$count){
         echo '{"code":"failure", "result": 0}';
       }else{
       /*** echo the number of affected rows ***/
            $newSql = "SELECT * FROM users WHERE id='$id'";
            $stmt = $dbh->query($newSql);
            $obj = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo '{"code":"success", "result": ' . json_encode($obj[0]) . '}';
       }

      /*** close the database connection ***/
      $dbh = null;
    }
    catch(PDOException $e)
    {
      echo '{"code":"failure", "result": ' . $e->getMessage() . '}';
    }

  ?>