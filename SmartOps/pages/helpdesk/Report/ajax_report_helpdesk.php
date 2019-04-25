<?php
    //.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
//***************************************************************************************************************************************

    if(isset($_REQUEST['getSRclosFromDate']) && isset($_REQUEST['getSRclosToDate']) && isset($_REQUEST['getBr']) && isset($_REQUEST['getde'])){
        getGried_For_Close_Report($_REQUEST['getSRclosFromDate'],$_REQUEST['getSRclosToDate'],$_REQUEST['getBr'],$_REQUEST['getde']);  
    }
    
    if(isset($_REQUEST['getKISCompteFromDate']) && isset($_REQUEST['getKISCompteToDate'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report($_REQUEST['getKISCompteFromDate'],$_REQUEST['getKISCompteToDate']);
    }
	
	if(isset($_REQUEST['getKISCompteFromDate_HR']) && isset($_REQUEST['getKISCompteToDate_HR'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report_HR($_REQUEST['getKISCompteFromDate_HR'],$_REQUEST['getKISCompteToDate_HR']);
    }
    if(isset($_REQUEST['getKISCompteFromDate_Full']) && isset($_REQUEST['getKISCompteToDate_Full'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report_FULL($_REQUEST['getKISCompteFromDate_Full'],$_REQUEST['getKISCompteToDate_Full']);
    }
    
     if(isset($_REQUEST['getKISCompteFromDate_1Full']) && isset($_REQUEST['getKISCompteToDate_1Full'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report_1FULL($_REQUEST['getKISCompteFromDate_1Full'],$_REQUEST['getKISCompteToDate_1Full']);
    }
    
    if(isset($_REQUEST['getKISCompteFromDate_1FullCat']) && isset($_REQUEST['getKISCompteToDate_1FullCat']) && isset($_REQUEST['getgetFileTypeCat'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report_FULLCAT($_REQUEST['getKISCompteFromDate_1FullCat'],$_REQUEST['getKISCompteToDate_1FullCat'],$_REQUEST['getgetFileTypeCat']);
    }
    
    if(isset($_REQUEST['getKISCompteFromDate_UCLFull']) && isset($_REQUEST['getKISCompteToDate_UCLFull'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report_UCLFULL($_REQUEST['getKISCompteFromDate_UCLFull'],$_REQUEST['getKISCompteToDate_UCLFull']);
    }
    //************************** get function for Close report*****************************************************
    function  getGried_For_Close_Report($Fdate,$Tdate,$ipBranch,$ipDepartment){
        $conn = DatabaseConnection();
        $sql_select = "SELECT chd.`solved_by`  AS USER_ID,
                              IFNULL((SELECT `userID` FROM `user` WHERE `userName` =  chd.`solved_by`) , 'Not Assigned') AS USER_NAME,
                              COUNT(*) AS NUM_CLOSED,
                                (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`solved_by` = chd.`solved_by` AND date(ch.`solved_on`) BETWEEN '".$Fdate."' AND '".$Tdate."' and DATEDIFF(date(ch.`solved_on`) , date(ch.`enterDateTime`)) < 3) AS firstCol,
                                (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`solved_by` = chd.`solved_by` AND date(ch.`solved_on`) BETWEEN '".$Fdate."' AND '".$Tdate."' and DATEDIFF(date(ch.`solved_on`) , date(ch.`enterDateTime`)) >= 3 AND DATEDIFF(date(ch.`solved_on`) , date(ch.`enterDateTime`)) < 5) AS secCol, 
                                (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`solved_by` = chd.`solved_by` AND date(ch.`solved_on`) BETWEEN '".$Fdate."' AND '".$Tdate."' and DATEDIFF(date(ch.`solved_on`) , date(ch.`enterDateTime`)) >= 5) AS THCOL        
                        FROM `cdb_helpdesk` chd ,`deparment`
                        WHERE chd.`solved_on` is not null
                          AND chd.`cat_code` = `deparment`.`def_catCode`
                          AND `deparment`.`branchNumber` = '" . $ipBranch . "'
                          AND `deparment`.`deparmentNumber` = '" . $ipDepartment. "'
                          AND date(chd.`solved_on`) BETWEEN '".$Fdate."' AND '".$Tdate."'
                        group by chd.`solved_by`;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
                    <td style='width:500px;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Closed SR</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>1 - 3</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>4 - 5</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>&gt;5</span></td>
                </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        while($res_select = mysqli_fetch_array($que_select)){
            echo "<tr style='background-color: ".$col.";'>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$inex."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[0]."</span></td>";
            echo "<td style='width:500px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[1]."</span></td>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[3]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[4]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
            $inex++;
        }
        echo "</table>";
        
    }
    
    function getGried_For_completed_Report($getKISCompteFromDate,$getKISCompteToDate){
        $conn = DatabaseConnection();
         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) <= 1) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) between 2 AND 3 ) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) > 3 ) AS COU_3
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>&lt;1 day</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>&gt;2 - 3 days</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>&gt;3 days</span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C = $COU_C + $res_select[4];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C."</span></td>
                <td  colspan='3'>&nbsp;</td>
            </tr>";
        echo "</table>";
    }
	
	
	
	  function getGried_For_completed_Report_HR($getKISCompteFromDate,$getKISCompteToDate){
        $conn = DatabaseConnection();
         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm submissions will be treated as next day 8:30am submission - <B>Without Pending Notification</B></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
		
		/*Mr Dave need to show pending reported files sepeerately*/
		echo "<BR><BR>";
		$sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate ,  (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime))) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm additional image submissions will be treated as next day 8:30am submission - <B>With Pending Notification</B><BR><span style='margin-left: 40px;'>[Staring time will be final File Verified time]</span></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function getGried_For_completed_Report_FULL($getKISCompteFromDate,$getKISCompteToDate){
        $conn = DatabaseConnection();
         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm submissions will be treated as next day 8:30am submission - <B>Without Pending Notification</B></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
		
		/*Mr Dave need to show pending reported files sepeerately*/
		echo "<BR><BR>";
		$sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate ,  (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime))) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm additional image submissions will be treated as next day 8:30am submission - <B>With Pending Notification</B><BR><span style='margin-left: 40px;'>[Staring time will be final File Verified time]</span></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
    }
    
    
//-------------------------------------------- UCL Kiosk Completed Report UCL - Hourly New ----------------------------------------


function getGried_For_completed_Report_UCLFULL($getKISCompteFromDate,$getKISCompteToDate){
        $conn = DatabaseConnection();

         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
					   AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm submissions will be treated as next day 8:30am submission - <B>Without Pending Notification</B></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
		
		/*Mr Dave need to show pending reported files sepeerately*/
		echo "<BR><BR>";
		$sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) <= 120) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 121 AND 150) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate ,  (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  151 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) > 1440) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime))) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   and ch.scat_code_2 in ('10140108','10140109','10140110','10140122','10140130')
					   AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm additional image submissions will be treated as next day 8:30am submission - <B>With Pending Notification</B><BR><span style='margin-left: 40px;'>[Staring time will be final File Verified time]</span></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function getGried_For_completed_Report_1FULL($getKISCompteFromDate,$getKISCompteToDate){
        $conn = DatabaseConnection();
         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) <= 60) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 61 AND 90) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  121 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) > 1440) AS COU_6	,		
     	(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 91 AND 120) AS COU_14						       		
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm submissions will be treated as next day 8:30am submission - <B>Without Pending Notification</B></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
             <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        $COU_C13 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                $COU_C13 = $COU_C13 + $res_select[12];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[12]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C13.($COU_C13 > 0 ?("<HR>".ROUND($COU_C13 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                <td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
		
		/*Mr Dave need to show pending reported files sepeerately*/
		echo "<BR><BR>";
		$sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) <= 60) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 61 AND 90) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate ,  (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  121 AND 180) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  181 AND 240) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  241 AND 300) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  301 AND 1440) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) > 1440) AS COU_6		,
      (SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 91 AND 120) AS COU_14			
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime))) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm additional image submissions will be treated as next day 8:30am submission - <B>With Pending Notification</B><BR><span style='margin-left: 40px;'>[Staring time will be final File Verified time]</span></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        $COU_C13 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                $COU_C13 = $COU_C13 + $res_select[12];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[12]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C13.($COU_C13 > 0 ?("<HR>".ROUND($COU_C13 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                <td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
    }
    
    
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function getGried_For_completed_Report_FULLCAT($getKISCompteFromDate,$getKISCompteToDate,$fileType){
        $conn = DatabaseConnection();
         $sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) <= 60) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN 61 AND 90) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  91 AND 120) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  121 AND 150) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  151 AND 180) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) BETWEEN  180 AND 240) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(ch.enterDateTime) >= 16, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) > 240) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
                   AND ch.scat_code_2 = '".$fileType."'
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid not in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm submissions will be treated as next day 8:30am submission - <B>Without Pending Notification</B></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 1/2 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 4 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
		
		/*Mr Dave need to show pending reported files sepeerately*/
		echo "<BR><BR>";
		$sql_select = "SELECT MIS.CATCODE,
      (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
      MIS.USERID,
      IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
      COUNT(*) AS COMPLETED_FILES,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) <= 60) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN 61 AND 90) AS COU_12,						
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate ,  (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  91 AND 120) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  121 AND 150) AS COU_3,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  151 AND 180) AS COU_4,				
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                        AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) BETWEEN  181 AND 240) AS COU_5,	
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
                       AND ch.scat_code_2 = '".$fileType."'
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
						AND ROUND(time_to_sec((TIMEDIFF(ch.appcrdate, (if(HOUR(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) >= 16, STR_TO_DATE(concat(DATE_ADD(date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)) ,INTERVAL 1 DAY),' 08:30:00'), '%Y-%m-%d %H:%i:%s') , IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))))) / 60) > 240) AS COU_6					
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 DATEDIFF(date(ch.appcrdate) , date(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime))) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(IFNULL((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = ch.helpid and pv.P_V = 'V'),ch.enterDateTime)))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
                       AND ch.scat_code_2 = '".$fileType."'
					   AND ch.ssb_app_number != '' 
					   AND ch.helpid in (select pv.helpid from cdb_ssb_his pv where PV.helpid = ch.helpid AND pv.P_V = 'P')
					   AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."') AS MIS
GROUP  BY MIS.CATCODE,MIS.USERID;";
        //echo $sql_select;
        $que_select = mysqli_query($conn,$sql_select);
		echo "<span style='margin-left: 40px;'>After 4pm additional image submissions will be treated as next day 8:30am submission - <B>With Pending Notification</B><BR><span style='margin-left: 40px;'>[Staring time will be final File Verified time]</span></span>";
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:200;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 1/2 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 4 Hrs </span></td>
        </tr>";
        $inex = 1;
        if($inex%2 == 1){
            $col = "#F0F0F0";     
        }else{
            $col = "#FFFFFF";  
        }
        $y = 1;
        $COU_C = 0;
		$COU_C1 = 0;
		$COU_C12 = 0;
		$COU_C2 = 0;
		$COU_C3 = 0;
		$COU_C4 = 0;
		$COU_C5 = 0;
		$COU_C6 = 0;
        while($res_select = mysqli_fetch_array($que_select)){
                $COU_C  = $COU_C  + $res_select[4];
				$COU_C1 = $COU_C1 + $res_select[5];
				$COU_C12 = $COU_C12 + $res_select[6];
				$COU_C2 = $COU_C2 + $res_select[7];
				$COU_C3 = $COU_C3 + $res_select[8];
				$COU_C4 = $COU_C4 + $res_select[9];
				$COU_C5 = $COU_C5 + $res_select[10];
				$COU_C6 = $COU_C6 + $res_select[11];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[2]."</span></td>";
                echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$res_select[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;background:#EDFF8A'><span style='margin-right: 5px'>".$res_select[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
				echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
				echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[11]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C.($COU_C > 0 ?("<HR>100"):"<HR>0" )."%</span></td>
				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C1.($COU_C1 > 0 ?("<HR>".ROUND($COU_C1 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C12.($COU_C12 > 0 ?("<HR>".ROUND($COU_C12 / $COU_C * 100,0)):"<HR>0" )."%</span></td>				
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C2.($COU_C2 > 0 ?("<HR>".ROUND($COU_C2 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C3.($COU_C3 > 0 ?("<HR>".ROUND($COU_C3 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C4.($COU_C4 > 0 ?("<HR>".ROUND($COU_C4 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C5.($COU_C5 > 0 ?("<HR>".ROUND($COU_C5 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
				<td style='width:60px;text-align: right;valign: middle;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C6.($COU_C6 > 0 ?("<HR>".ROUND($COU_C6 / $COU_C * 100,0)):"<HR>0" )."%</span></td>
                
            </tr>";
        echo "</table>";
    }
    
?>