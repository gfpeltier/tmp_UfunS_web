<?php
    $hostname = '127.0.0.1';
    $username = 'root';
    $password = 'mxOxo74S79';
	
	try{
      $dbh = new PDO("mysql:host=$hostname;dbname=user_data", $username, $password);
      /*** echo a message saying we have connected ***/
      //echo 'Connected to database';

      $sql = "SELECT * FROM gems WHERE user='" . $_REQUEST["uid"] . "'";

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
	/*
	$con=mysql_connect("mysql:host=$hostname;dbname=user_data", $username, $password) or
	trigger_error(mysql_error(),E_USER_ERROR);
	
	$query = "SELECT * FROM 'gems'";
	$result = mysql_query($query, $con);
	
	$set = array();
	
	$total_records = mysql_num_rows($result);
	
	if($total_records >= 1){
		while ($link = mysql_fetch_array($result), MYSQL_ASSOC)){
			$set[] = $link;
		}
	}
	echo json_encode($set);
	
	/*$radius = 'radius';
	$result = mysql_query("Select * FROM gems");
	
	$num_rows = mysql_num_rows($result);
	while($row = mysql_fetch_array($result)){
		$data[] = $row;
		if($data){
			echo (json_encode($data));
		}
	}*/
	//mysql_close($con);
	
	?>