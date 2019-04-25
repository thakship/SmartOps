<?php
    //.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
//***************************************************************************************************************************************
    
    if(isset($_REQUEST['getKISCompteFromDate']) && isset($_REQUEST['getKISCompteToDate']) && isset($_REQUEST['getScat02'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_Report($_REQUEST['getKISCompteFromDate'],$_REQUEST['getKISCompteToDate'],$_REQUEST['getScat02']);
    }
	
    //************************** get function for Close report*****************************************************
   if(isset($_REQUEST['getKISCompteFromDateHou']) && isset($_REQUEST['getKISCompteToDateHou']) && isset($_REQUEST['getScat02Hou'])){
        //echo $_REQUEST['getKISCompteFromDate']."--".$_REQUEST['getKISCompteToDate'];
        getGried_For_completed_ReportHou($_REQUEST['getKISCompteFromDateHou'],$_REQUEST['getKISCompteToDateHou'],$_REQUEST['getScat02Hou']);
    }
    
    function getGried_For_completed_Report($getKISCompteFromDate,$getKISCompteToDate,$getScat02){
        $conn = DatabaseConnection();
        //echo $getScat02;
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
                        AND ch.scat_code_2 = '".$getScat02."'
						AND DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) <= 1) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
                         AND ch.scat_code_2 = '".$getScat02."'
						AND DATEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) between 2 AND 3 ) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
                         AND ch.scat_code_2 = '".$getScat02."'
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
                    AND ch.scat_code_2 = '".$getScat02."'
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
    
    function getGried_For_completed_ReportHou($getKISCompteFromDate,$getKISCompteToDate,$getScat02){
        $conn = DatabaseConnection();
        //echo $getScat02;
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
                        AND ch.scat_code_2 = '".$getScat02."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) <= '01:00:00'  ) AS COU_1,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' 
						AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
                         AND ch.scat_code_2 = '".$getScat02."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) between '01:00:01' AND '01:30:00' ) AS COU_2,
			(SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
                         AND ch.scat_code_2 = '".$getScat02."'
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) between '01:30:01' AND '02:00:00' ) AS COU_3,
          (SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
                         AND ch.scat_code_2 = '".$getScat02."'
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) between '02:00:01' AND '02:30:00' ) AS COU_4,
            (SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
                         AND ch.scat_code_2 = '".$getScat02."'
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) between '02:30:01' AND '03:00:00' ) AS COU_5,
           (SELECT COUNT(*)
					FROM `cdb_helpdesk` AS ch 
					WHERE ch.`cat_code` = '1014' 
						AND ch.ssb_app_number != ''
						AND ch.`asing_by`  = MIS.USERID
                         AND ch.scat_code_2 = '".$getScat02."'
						AND DATE(ch.appcrdate) >= '".$getKISCompteFromDate."' AND DATE(ch.appcrdate) <= '".$getKISCompteToDate."'
						AND TIMEDIFF(ch.appcrdate , ch.enterDateTime) >= '03:00:01' ) AS COU_6
FROM (SELECT ch.`cat_code` AS CATCODE, 
						 IFNULL(`asing_by`, '-') AS USERID,
						 DATE(ch.enterDateTime) AS ENTERED_DATE,
						 DATE(ch.appcrdate) AS CLOSED_DATE,
						 TIMEDIFF(date(ch.appcrdate) , date(ch.enterDateTime)) AS AGE,
						(TIME_TO_SEC(ch.appcrdate) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
			 FROM `cdb_helpdesk` AS ch
			 WHERE ch.`cat_code` = '1014' 
                    AND ch.scat_code_2 = '".$getScat02."'
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
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>1 Hrs</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>1 1/2 Hrs</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>2 Hrs</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>2 1/2 Hrs</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>3 Hrs</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'> &gt;3 Hrs</span></td>
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
                echo "<td style='width:50px;text-align: right;background:#EDFF8A''><span style='margin-right: 5px;'>".$res_select[5]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#F7D73A;'><span style='margin-right: 5px;'>".$res_select[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;background:#ffcc80;'><span style='margin-right: 5px;'>".$res_select[7]."</span></td>";
                 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[8]."</span></td>";
                  echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[9]."</span></td>";
                   echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_select[10]."</span></td>";
                echo "</tr>";
                $y++;
        }
        echo "<tr>
                <td  colspan='3'><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
                <td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'>".$COU_C."</span></td>
                <td  colspan='6'>&nbsp;</td>
            </tr>";
        echo "</table>";
    }
?>