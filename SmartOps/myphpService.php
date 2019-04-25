<?php
	//session_start(); W:\www\CDB\myphpService.php
	//include('php_con/includes/db.ini.php');
/* We first connect to our database 
	$connection = mysqli_connect($dbhost,$user,$password,$database,$port);*/
	echo "Started";
	$connection = mysqli_connect("localhost","root","1234","cdberp");

	/* Capture connection error if any */
	if (mysqli_connect_errno($connection)) {
		echo "Failed to connect to DataBase: " . mysqli_connect_error();
	}else {
		/* Declare an array containing our data points */
		$data_points = array();

		/* Usual SQL Queries */
		$query = "select (select scat_discr_2 from scat_02 where cat_code = '1014' and scat_code_2 = misf.timeStamp) as timeStamp,misf.myData1 from (select mis.scat_code_2 as timeStamp,mis.cnt as myData1 from(select c.scat_code_2, count(*) as cnt from cdb_helpdesk c where c.cat_code = '1014' and date(c.enterDateTime) >= '2017-10-20' group by c.scat_code_2)	 mis order by  mis.cnt desc ) misf limit 5";
		echo $query;
		$result = mysqli_query($connection, $query);
		if (!$result) {
			printf("Error: %s\n", mysqli_error($connection));
			exit();
		}
		while($row = mysqli_fetch_array($result)){        
			/* Push the results in our array */
			$point = array("ts" =>  $row['timeStamp'] ,"d1" =>  $row['myData1']);
			array_push($data_points, $point);
		}

		/* Encode this array in JSON form */
		echo json_encode($data_points, JSON_NUMERIC_CHECK);
	}
	mysqli_close($connection);
?>
