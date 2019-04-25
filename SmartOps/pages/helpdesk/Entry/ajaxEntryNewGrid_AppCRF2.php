<?php
	session_start();
    include('../../../php_con/includes/db.ini.php');
       
    $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`";       
     $vsqlAux_1 = "`cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."'";
     $vsqlAux_2 = " AND `cdb_helpdesk`.`asing_by` = '".$_REQUEST['n_userID']."'";
     $vsqlAux_3 = "`cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND ";
     $vsqlAux_4 = "";
     
     if($_REQUEST['n_userID'] == "CDBUCL" || $_REQUEST['n_userID'] == "01000393" || $_REQUEST['n_userID'] == "01001110" || $_REQUEST['n_userID'] == "01001421" ){
        $vsqlAux_1 = "`branch`.`branchName` = 'UCL'";
        $vsqlAux_2 = ""; 
        $vsqlAux_3 = "";
        $vsqlAux_4 = " AND `cdb_helpdesk`.`ssb_type` like 'File re-submitted%'";
        $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`";
     }
        
     $v_sql_det_detelsCNT = "SELECT COUNT(1),
	COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` ='  - Pending' THEN 1 END) , 
	COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` <> '  - Pending' THEN 1 END) 
	FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
							 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
								   `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
								   `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
								   `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
								   `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
								   `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
								   `cdb_helpdesk`.`cmb_code` = '5001' AND
								   `cdb_helpdesk`.`cat_code` = '1014' AND
								   `cdb_helpdesk`.`ssb_app_number` <> '' AND `cdb_helpdesk`.`IsAppValid` <> 4 AND  `cdb_helpdesk`.`IsAppValid` <> 5 AND
								   `cdb_helpdesk`.`facno` = '' AND
								   `cdb_helpdesk`.`curr_stage` = 'LSERECMD' AND
								   `cdb_helpdesk`.`taken_by` = '  - Pending' AND
								    /*9:24 AM 23/04/2018 NOT(`cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' and `cdb_helpdesk`.`assign_to` = 'SSOO') AND  */
								   `cdb_helpdesk`.`taken_by` = '  - Pending' AND
								   `cdb_helpdesk`.`assign_to` NOT IN ('SSOO','SSBI','CO') AND 
									date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
								   ORDER BY `cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;";      
 
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
		echo "<h3>Recommendation Stage - Pending | Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }
?>	
<div style="float: left;">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">GROUP</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">TOTAL</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>BRANCH</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>HO</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>UCL</span></td>					
			<td style="width:100px;text-align: right;"><span style="margin-right: 5px;">FACILITY AMOUNT</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Not Assigned</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assigned</span></td>
		</tr>

<?php	// Print the group wise pending info
	$COUNT_1 = 0; $COUNT_2 = 0; $COUNT_3 = 0;
    $TOTAL = 0; $COUNT_2_BRANCH = 0; $COUNT_2_HO = 0; $COUNT_2_UCL = 0;
	$v_sql_det_detelsGR =  "SELECT `cdb_helpdesk`.`assign_to`,
									 COUNT(`cdb_helpdesk`.`assign_to`) ,
									 SUM(`cdb_helpdesk`.`ssb_facility_amount`),
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` ='  - Pending' THEN 1 END) , 
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` <> '  - Pending' THEN 1 END),
									 COUNT(CASE WHEN `cdb_helpdesk`.`mainFileType` = 'Branch' THEN 1 END) AS Branch,	
									 COUNT(CASE WHEN `cdb_helpdesk`.`mainFileType` = 'HO' THEN 1 END) AS HO,
									 COUNT(CASE WHEN `cdb_helpdesk`.`mainFileType` = 'UCL' THEN 1 END) AS UCL										 
							 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
							 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
								   `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
								   `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
								   `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
								   `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
								   `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
								   `cdb_helpdesk`.`cmb_code` = '5001' AND
								   `cdb_helpdesk`.`cat_code` = '1014' AND
								   `cdb_helpdesk`.`ssb_app_number` <> '' AND `cdb_helpdesk`.`IsAppValid` <> 4 AND  `cdb_helpdesk`.`IsAppValid` <> 5 AND
								   `cdb_helpdesk`.`facno` = '' AND
								   `cdb_helpdesk`.`curr_stage` = 'LSERECMD' AND
								   `cdb_helpdesk`.`taken_by` = '  - Pending' AND
								   /*9:24 AM 23/04/2018 NOT(`cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' and `cdb_helpdesk`.`assign_to` = 'SSOO') AND */
								   `cdb_helpdesk`.`assign_to` NOT IN ('SSOO','SSBI','CO') AND 
									date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
								   GROUP BY `cdb_helpdesk`.`assign_to` 
								   ORDER BY `cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;";  
	 $v_que_det_detelsGR = mysqli_query($conn,$v_sql_det_detelsGR);	   
	 while($rec_det_detelsGR = mysqli_fetch_array($v_que_det_detelsGR)){
         echo "<TR><td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[0]."</span></td>";
		 echo "<td style='width:60px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[1]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[5]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[6]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[7]."</span></td>";				 
		 echo "<td style='width:100px;text-align: right;'><span style='margin-right: 2px;'>".number_format($rec_det_detelsGR[2],2)."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[3]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[4]."</span></td></TR>";
		 $COUNT_1 = $COUNT_1 + $rec_det_detelsGR[1];
		 $TOTAL = $TOTAL + $rec_det_detelsGR[2];
		 $COUNT_2 = $COUNT_2 + $rec_det_detelsGR[3];
		 $COUNT_3 = $COUNT_3 + $rec_det_detelsGR[4];
		 $COUNT_2_BRANCH = $COUNT_2_BRANCH + $rec_det_detelsGR[5];
		 $COUNT_2_HO = $COUNT_2_HO + $rec_det_detelsGR[6];
		 $COUNT_2_UCL = $COUNT_2_UCL + $rec_det_detelsGR[7];		 
	 } 
	echo "<TR><td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>Total</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_1."</span></td>";
		 echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_BRANCH."</span></td>";
		 echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_HO."</span></td>";
		 echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_UCL."</span></td>";
		 
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".number_format($TOTAL,2)."</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2."</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_3."</span></td></TR>";	 
?>
</table>
</div>
<div style="padding-left: 500px">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">ZONE</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">TOTAL</span></td>
			<td style="width:90px;text-align: right;"><span style="margin-right: 5px;">FACILITY AMOUNT</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">BRANCH</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">HO</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">UCL</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Not Assigned</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assigned</span></td>
		</tr>
<?php	// Print the group wise pending info
	$COUNT_1 = 0; $COUNT_2 = 0; $COUNT_3 = 0; $COUNT_5 = 0; $COUNT_6 = 0; $COUNT_7 = 0;
    $TOTAL = 0;
	$v_sql_det_detelsGR =  "SELECT branch.CDBZONE,
									 COUNT(`cdb_helpdesk`.`assign_to`) ,
									 SUM(`cdb_helpdesk`.`ssb_facility_amount`),
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` ='  - Pending' THEN 1 END) , 
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` <> '  - Pending' THEN 1 END) ,									 
							         COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` = '  - Pending' and `cdb_helpdesk`.`mainFileType` = 'Branch' THEN 1 END) AS Branch,	
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` = '  - Pending' and `cdb_helpdesk`.`mainFileType` = 'HO' THEN 1 END) AS HO,
									 COUNT(CASE WHEN `cdb_helpdesk`.`taken_by` = '  - Pending' and `cdb_helpdesk`.`mainFileType` = 'UCL' THEN 1 END) AS UCL		
                             FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
							 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
								   `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
								   `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
								   `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
								   `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
								   `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
								   `cdb_helpdesk`.`cmb_code` = '5001' AND
								   `cdb_helpdesk`.`cat_code` = '1014' AND
								   `cdb_helpdesk`.`ssb_app_number` <> '' AND `cdb_helpdesk`.`IsAppValid` <> 4 AND  `cdb_helpdesk`.`IsAppValid` <> 5 AND
								   `cdb_helpdesk`.`facno` = '' AND
								   `cdb_helpdesk`.`curr_stage` = 'LSERECMD' AND
								   `cdb_helpdesk`.`taken_by` = '  - Pending' AND
								    /*9:24 AM 23/04/2018 NOT(`cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' and `cdb_helpdesk`.`assign_to` = 'SSOO') AND*/
									`cdb_helpdesk`.`assign_to` NOT IN ('SSOO','SSBI','CO') AND 
									date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
								   GROUP BY branch.CDBZONE 
								   ORDER BY `cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;";  
	 $v_que_det_detelsGR = mysqli_query($conn,$v_sql_det_detelsGR);	   
	 while($rec_det_detelsGR = mysqli_fetch_array($v_que_det_detelsGR)){
         echo "<TR><td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[0]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[1]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".number_format($rec_det_detelsGR[2],2)."</span></td>";
         
		  echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[5]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[6]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[7]."</span></td>";
         
         echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[3]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[4]."</span></td></TR>";
		 $COUNT_1 = $COUNT_1 + $rec_det_detelsGR[1];
		 $TOTAL = $TOTAL + $rec_det_detelsGR[2];
		 $COUNT_2 = $COUNT_2 + $rec_det_detelsGR[3];
		 $COUNT_3 = $COUNT_3 + $rec_det_detelsGR[4];
         $COUNT_5 = $COUNT_5 + $rec_det_detelsGR[5];
         $COUNT_6 = $COUNT_6 + $rec_det_detelsGR[6];
         $COUNT_7 = $COUNT_7 + $rec_det_detelsGR[7];
	 } 
	echo "<TR><td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>Total</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_1."</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".number_format($TOTAL,2)."</span></td>";
		 
         echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_5."</span></td>";
         echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_6."</span></td>";
         echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_7."</span></td>";
         
         echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2."</span></td>";
		 echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_3."</span></td></TR>";	 
?>		
</table>
</div>		
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">LOS Creation Date</span></td>
			<td style="width:90px;text-align: left;"><span style="margin-left: 5px;">Approval</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">App Number</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">LOS</span></td>
			<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">No Of Pending</span></td>
            <!-- <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken Full</span></td>-->
			<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Since - App Cr / Add Img</span></td>
            <td style="width:50px;"></td>
        </tr>
<?php
       
 $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`";       
 $vsqlAux_1 = "`cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."'";
 $vsqlAux_2 = " AND `cdb_helpdesk`.`asing_by` = '".$_REQUEST['n_userID']."'";
 $vsqlAux_3 = "`cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND ";
 $vsqlAux_4 = "";
 if($_REQUEST['n_userID'] == "CDBUCL" || $_REQUEST['n_userID'] == "01000393" || $_REQUEST['n_userID'] == "01001110" || $_REQUEST['n_userID'] == "01001421"){
    $vsqlAux_1 = "`branch`.`branchName` = 'UCL'";
    $vsqlAux_2 = ""; 
    $vsqlAux_3 = "";
    $vsqlAux_4 = " AND `cdb_helpdesk`.`ssb_type` like 'File re-submitted%'";
    $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`";
 }
 
	   
 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                            (`cdb_helpdesk`.`enterDateTime`), 
                            `cdb_helpdesk`.`issue`,
                            `scat_02`.`scat_discr_2`, 
                            `branch`.`branchName`, 
                            `deparment`.`deparmentName`, 
                            `cdb_helpdesk`.`enterBy`, 
                            `urgency_states`.`ur_discr`, 
                            `priority_states`.`pr_discr` , 
                            `cdb_helpdesk`.`asing_by` , 
                            `cdb_helpdesk`.`cat_code` , 
                            `cdb_helpdesk`.`ssb_facility_amount` , 
                            `cdb_helpdesk`.`ssb_type`,
                            `cdb_helpdesk`.`help_discr`,
                            IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                            `cdb_helpdesk`.`ssb_app_number`,
                            `cdb_helpdesk`.`facno`,
                             datediff(date(now()),DATE(`cdb_helpdesk`.`enterDateTime`)) as agedays, 
                             `cdb_helpdesk`.`curr_stage`,
                             `cdb_helpdesk`.`assign_to`,
                             `cdb_helpdesk`.`taken_by`,
                            `cdb_helpdesk`.`lastactivityon`,
                            `cdb_helpdesk`.`appcrdate`, 
                            (select count(*) from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'P') AS PEND,
                            ROUND(time_to_sec((TIMEDIFF(`cdb_helpdesk`.`appcrdate`, `cdb_helpdesk`.`enterDateTime`))) / 60) AS FULL_TIME,
                        	CASE  (select count(*) t from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'P') 
                         		WHEN  0 then 0 
                        	else ROUND(time_to_sec((TIMEDIFF((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'V'), `cdb_helpdesk`.`enterDateTime`))) / 60)  
                           END AS FULL_TIME_AFTERVRF ,
                           ROUND(time_to_sec((TIMEDIFF(now(), `cdb_helpdesk`.`lastactivityon`))) / 60) AS ADII_UP,
						   branch.CDBZONE,
						   IFNULL((select 1  from cdb_los_sendback l where l.helpid =  `cdb_helpdesk`.`helpid` limit 1),0) AS SB,
						   `cdb_helpdesk`.mainFileType ,
                           (select scat_03.scat_discr_3 from scat_03 where scat_03.cat_code = cdb_helpdesk.cat_code and scat_03.scat_code_1 = cdb_helpdesk.scat_code_1 and scat_03.scat_code_2 = cdb_helpdesk.scat_code_2 and scat_03.scat_code_3 = cdb_helpdesk.scat_code_3)
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_helpdesk`.`scat_code_2` NOT IN ('10140108', '10140109', '10140110', '10140122', '10140130', '10140132', '10140148') AND  
       `cdb_helpdesk`.`ssb_app_number` <> '' AND `cdb_helpdesk`.`IsAppValid` <> 4 AND  `cdb_helpdesk`.`IsAppValid` <> 5 AND
       `cdb_helpdesk`.`facno` = '' AND
	   `cdb_helpdesk`.`curr_stage` = 'LSERECMD' AND
	   `cdb_helpdesk`.`taken_by` = '  - Pending' AND
	    /*cdb_helpdesk.helpid = '201892640' and  */
		/*9:24 AM 23/04/2018 NOT(`cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' and `cdb_helpdesk`.`assign_to` = 'SSOO') AND */
		`cdb_helpdesk`.`assign_to` NOT IN ('SSOO','SSBI','CO') AND 
	    date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY 27 desc"; /*`cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;*/
       // echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
  
     while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
       $sql_count_note = "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
          $v_que_count_note = mysqli_query($conn,$sql_count_note);
          while($rec_count_note =  mysqli_fetch_array($v_que_count_note)){
                $f_Col = "#000000";
                if($rec_count_note[0] != 0){
                    $f_Col = "#000000";
                }else{
                    $f_Col = "#000000";
                }  
          }
    
    
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        $index++;
        if($rec_det_detels[8]=='Highest'){
            $col = "#000000";
        }else{
            $col = "#000000";
        }
        $MyRow = "";
		$LOS_STATUS = "";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        
        /*
        if ($rec_det_detels[12] == "File re-submitted"){
           $col = "#3F12F3;";
        }
        */
        $add_img_Col = "#FFFFFF";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded"){
               $col = "#BB11F3;";
               if($rec_det_detels[26] > 15){
                    $add_img_Col = "#ff9999";
               }
           }
            
        }
        
        $colLos = "";
        /*if($rec_det_detels[19] == "SSOO"){*/
		if($rec_det_detels[28] == "1"){
           $colLos = "background-color: #b3ffb3;";
        }

        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[22]."</span></td>";
		echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[29]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]." - ".$rec_det_detels[30]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$colLos ."'><span style='margin-left: 2px;'>".$rec_det_detels[15]."</span></td>"; 
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."<BR>".$rec_det_detels[27]."</span></td>";
        
        /*Rizvi */
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]. " - [". ($rec_det_detels[21] == '0000-00-00 00:00:00' ? '' : $rec_det_detels[21]) ."] </span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
		
        /*Rizvi*/ 
		$LOS_STATUS = "";
		if($rec_det_detels[19]=='SSOO'||$rec_det_detels[19]=='SSBI'||$rec_det_detels[19]=='CO')
			$LOS_STATUS = "";
		else{
			if($rec_det_detels[18]=='LSESANC'){
				if($rec_det_detels[20]=='  - Pending')
					$LOS_STATUS = "background-color: #ff9999;";
				else
					$LOS_STATUS = "background-color: #9fff80;";
			}elseif($rec_det_detels[18]=='LSERECMD'){
				if($rec_det_detels[20]=='  - Pending')
					$LOS_STATUS = "background-color: #cc99ff;";
				else
					$LOS_STATUS = "background-color: #80dfff;";			
			}
		}   
		
        
		echo "<td style='width:40px;text-align: left;".$LOS_STATUS."' title ='".$rec_det_detels[15].chr(10).$rec_det_detels[18].chr(10).$rec_det_detels[19].chr(10).$rec_det_detels[20]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
		//echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[20]."</span></td>";
		
		/*Rizvi Added below line on 29-dec-2016 21 */
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[23]."</span></td>";
		//echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[24]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow .";background-color:".$add_img_Col."'><span style='margin-right: 2px;'>".$rec_det_detels[26]."</span></td>";
		/*End Rizvi Added below line on 29-dec-2016 */
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'>".str_pad($rec_det_detels[17], 2, '0', STR_PAD_LEFT)."</span></td>";
        
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
?>
</table>
<?php
    function getUserNameGenaral_Mob_Eml($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID`,`email`,`GSMNO` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
        while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
            return $RES_getUsreNAme[0]."&#013;".$RES_getUsreNAme[1]."&#013;".$RES_getUsreNAme[2];
        }
    }
?>