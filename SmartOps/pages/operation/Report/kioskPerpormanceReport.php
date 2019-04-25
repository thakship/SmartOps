<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk Perpormance Report
Purpose			: To viwe Perpormance Report
Author			: Madushan Wikramaarachchi
Date & Time		: 09.20 A.M 19/11/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/r/003";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
  include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
  
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Courier Day Receive  Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
 
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskPerpormanceReport.php?DispName=Kiosk%20Perpormance%20Report','conectpage');
}
function pageRef(){
   http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskPerpormanceReport.php?DispName=Kiosk%20Perpormance%20Report','conectpage');
}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<label style="font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 42px; font-weight: bold;">Pending Requests Status - as of <?php echo date('d-M-Y')?>   </label><br />
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;">
       <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Pending SR</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&lt;1 day</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&gt;2 - 3 days</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&gt;3 days</span></td>
        </tr>
        <?php
            $sql_pending_app = "SELECT ch.`cat_code` AS Cat_Code, 
                                			(SELECT `cat_discr` FROM `cat_states` WHERE `cat_code` = ch.`cat_code` and `car_state` = 1) AS Category, 
                                			IFNULL(`asing_by`, '-') AS User_ID, 
                                			IFNULL((SELECT `userID` FROM `user` WHERE `userName` = `asing_by`),'Un Assigned') as User_Name, 
                                			count(*) AS Num_Issues ,
                                			ifnull((SELECT count(*) AS Num_Issues 
                                					FROM `cdb_helpdesk` AS c1				
                                					WHERE c1.`cmb_code` = '5001' AND
                                								c1.`cat_code` = '1014' AND
                                								c1.ssb_app_number = '' AND (DATEDIFF(date(NOW()) , date(c1.`enterDateTime`)) <2) AND c1.`asing_by` = ch.`asing_by`
                                					group by c1.`cat_code`,c1.`asing_by`  
                                					order by c1.`cat_code`),0) AS cou_1,
                                			ifnull((SELECT count(*) AS Num_Issues 
                                					FROM `cdb_helpdesk` AS c2				
                                					WHERE c2.`cmb_code` = '5001' AND
                                								c2.`cat_code` = '1014' AND
                                								c2.ssb_app_number = '' AND 
                                								(DATEDIFF(date(NOW()) , date(c2.`enterDateTime`)) >=2) AND 
                                								(DATEDIFF(date(NOW()) , date(c2.`enterDateTime`)) <=3) AND 
                                								c2.`asing_by` = ch.`asing_by`
                                					group by c2.`cat_code`,c2.`asing_by`  
                                					order by c2.`cat_code`),0) AS cou_2,
                                			ifnull((SELECT count(*) AS Num_Issues 
                                					FROM `cdb_helpdesk` AS c3				
                                					WHERE c3.`cmb_code` = '5001' AND
                                								c3.`cat_code` = '1014' AND
                                								c3.ssb_app_number = '' AND 
                                								(DATEDIFF(date(NOW()) , date(c3.`enterDateTime`)) >3) AND 
                                								c3.`asing_by` = ch.`asing_by`
                                					group by c3.`cat_code`,c3.`asing_by`  
                                					order by c3.`cat_code`),0) AS cou_3
                                FROM `cdb_helpdesk` ch
                                WHERE ch.`cmb_code` = '5001' AND
                                 ch.`cat_code` = '1014' AND
                                			ch.ssb_app_number = ''
                                 group by ch.`cat_code`,ch.`asing_by` order by ch.`cat_code`;";
            $que__pending_app = mysqli_query($conn,$sql_pending_app);
            $x = 1;
            $COU_P = 0;
            while($res__pending_app = mysqli_fetch_array($que__pending_app)){
                $COU_P = $COU_P + $res__pending_app[4];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res__pending_app[2]."</span></td>";
                echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$res__pending_app[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$res__pending_app[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res__pending_app[5]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res__pending_app[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res__pending_app[7]."</span></td>";
                echo "</tr>";
                $x++;
            }
        ?>
<tr>
<td colspan="3"><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Pending Requests</label></td>
<td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'><?php echo $COU_P; ?></span></td>
<td  colspan="3">&nbsp;</td>
</tr>        
</table><br />
<hr /><br />
<label style="font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 42px; font-weight: bold;">Completed Requests Status - <?php echo date('01-M-Y')." to ".date('d-M-Y') ?></label><br />
<table border="1" cellpadding="0" cellspacing="0" id="myTable1"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;">
       <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Completed SR</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&lt;1 day</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&gt;2 - 3 days</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">&gt;3 days</span></td>
        </tr>
        <?php
            $sql_complid = "SELECT MIS.CATCODE,
                                   (SELECT `cat_discr` FROM `cat_states`  WHERE `cat_states`.`cat_code` = MIS.CATCODE and `car_state` = 1) AS CATCODE_DESC, 
                        		   MIS.USERID,
                                   IFNULL((SELECT `userID` FROM `user` WHERE `userName` = MIS.USERID),'Un Assigned') as USERNAME,
                                   COUNT(*) AS COMPLETED_FILES,
                                   (SELECT COUNT(*)
                        			FROM `cdb_helpdesk` AS ch ,cdb_help_note AS chn
                        			WHERE ch.helpid = chn.helpid 
                        				/*AND ch.`cmb_code` = '5001'*/ 
                        				AND ch.`cat_code` = '1014' 
                        				AND ch.ssb_app_number != ''
                        				AND ch.`asing_by`  = MIS.USERID
                        				AND chn.note_discr LIKE 'Application Created%' 
                        				AND DATE(chn.enterDateTime) >= DATE_FORMAT(NOW() ,'%Y-%m-01')
                        				AND DATEDIFF(date(chn.enterDateTime) , date(ch.enterDateTime)) <= 1) AS COU_1,
                        			(SELECT COUNT(*)
                        			FROM `cdb_helpdesk` AS ch ,cdb_help_note AS chn
                        			WHERE ch.helpid = chn.helpid 
                        				/*AND ch.`cmb_code` = '5001'*/ 
                        				AND ch.`cat_code` = '1014' 
                        				AND ch.ssb_app_number != ''
                        				AND ch.`asing_by`  = MIS.USERID
                        				AND chn.note_discr LIKE 'Application Created%' 
                        				AND DATE(chn.enterDateTime) >= DATE_FORMAT(NOW() ,'%Y-%m-01')
                        				AND DATEDIFF(date(chn.enterDateTime) , date(ch.enterDateTime)) between 2 AND 3 ) AS COU_2,
                        			(SELECT COUNT(*)
                        			FROM `cdb_helpdesk` AS ch ,cdb_help_note AS chn
                        			WHERE ch.helpid = chn.helpid 
                        				/*AND ch.`cmb_code` = '5001'*/ 
                        				AND ch.`cat_code` = '1014' 
                        				AND ch.ssb_app_number != ''
                        				AND ch.`asing_by`  = MIS.USERID
                        				AND chn.note_discr LIKE 'Application Created%' 
                        				AND DATE(chn.enterDateTime) >= DATE_FORMAT(NOW() ,'%Y-%m-01')
                        				AND DATEDIFF(date(chn.enterDateTime) , date(ch.enterDateTime)) > 3 ) AS COU_3
                            FROM (
                            SELECT ch.`cat_code` AS CATCODE, 
                            			IFNULL(`asing_by`, '-') AS USERID,
                            		  DATE(ch.enterDateTime) AS ENTERED_DATE,
                            			DATE(chn.enterDateTime) AS CLOSED_DATE,
                            		  DATEDIFF(date(chn.enterDateTime) , date(ch.enterDateTime)) AS AGE,
                            		  (TIME_TO_SEC(chn.enterDateTime) - TIME_TO_SEC(ch.enterDateTime))/60 AS TIMEDIF
                            FROM `cdb_helpdesk` AS ch ,cdb_help_note AS chn
                            WHERE ch.helpid = chn.helpid 
                              /*AND ch.`cmb_code` = '5001'*/ 
                              AND ch.`cat_code` = '1014' 
                            	AND ch.ssb_app_number != ''
                              AND chn.note_discr LIKE 'Application Created%' 
                              AND DATE(chn.enterDateTime) >= DATE_FORMAT(NOW() ,'%Y-%m-01')
                            ) AS MIS
                            GROUP  BY MIS.CATCODE,MIS.USERID
                            ";
            $que_complid = mysqli_query($conn,$sql_complid);
            $y = 1;
            $COU_C = 0;
            while($res_complid = mysqli_fetch_array($que_complid)){
                $COU_C = $COU_C + $res_complid[4];
                echo "<tr>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$y."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$res_complid[2]."</span></td>";
                echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$res_complid[3]."</span></td>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$res_complid[4]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_complid[5]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_complid[6]."</span></td>";
                echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$res_complid[7]."</span></td>";
                echo "</tr>";
                $y++;
            }
            
        ?>
<tr>
<td  colspan="3"><label style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'>Completed Requests</label></td>
<td style='width:60px;text-align: right;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight: bold;'><span style='margin-right: 5px;'><?php echo $COU_C; ?></span></td>
<td  colspan="3">&nbsp;</td>
</tr>
</table>
<br />

</form>
</body>
</html>
