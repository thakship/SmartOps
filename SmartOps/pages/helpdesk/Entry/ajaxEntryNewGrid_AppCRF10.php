<?php
	session_start();
    include('../../../php_con/includes/db.ini.php');
    //echo "ok";
    /*$v_sql_det_detelsCNT = "SELECT COUNT(1) FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."' AND
       `cdb_helpdesk`.`asing_by` = '".$_REQUEST['n_userID']."'
       ORDER BY `cdb_helpdesk`.`helpid`;";*/
       
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
	COUNT(CASE WHEN date(`cdb_helpdesk`.`appcrdate`) = date(now()) THEN 1 END) , 
	COUNT(CASE WHEN date(`cdb_helpdesk`.`appcrdate`) = subdate(date(now()),1) THEN 1 END) ,
	COUNT(CASE WHEN date(`cdb_helpdesk`.`appcrdate`) = date(now()) AND `cdb_helpdesk`.`facno` = '' THEN 1 END) 
	FROM `cdb_helpdesk`
 WHERE `cdb_helpdesk`.`cmb_code` = '5001' AND `cdb_helpdesk`.`cat_code` = '1014' AND `cdb_helpdesk`.`facno` = '' AND
       `cdb_helpdesk`.`ssb_app_number` <> '' AND `cdb_helpdesk`.`IsAppValid` <> 4 AND `cdb_helpdesk`.`IsAppValid` <> 5 AND
	    date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND
	   `cdb_helpdesk`.`curr_stage` = 'LSESANC' AND
	   `cdb_helpdesk`.`taken_by` <> '  - Pending' 
       ORDER BY `cdb_helpdesk`.`helpid`;";    
 
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
		echo "<h3>Sanction Stage - Assigned | Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }
?>	
<div style="float: left;">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">GROUP</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">COUNT</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>BRANCH</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>HO</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">TOTAL<BR>UCL</span></td>				
		</tr>

<?php	// Print the group wise pending info
	$TOTAL = 0; $COUNT_2_BRANCH = 0; $COUNT_2_HO = 0; $COUNT_2_UCL = 0;
	$v_sql_det_detelsGR =  "SELECT `cdb_helpdesk`.`assign_to`,
									 COUNT(`cdb_helpdesk`.`assign_to`) ,
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
								   `cdb_helpdesk`.`curr_stage` = 'LSESANC' AND
								   `cdb_helpdesk`.`taken_by` <> '  - Pending' AND
									date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
								   GROUP BY `cdb_helpdesk`.`assign_to` 
								   ORDER BY `cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;";  
	 $v_que_det_detelsGR = mysqli_query($conn,$v_sql_det_detelsGR);	   
	 while($rec_det_detelsGR = mysqli_fetch_array($v_que_det_detelsGR)){
         echo "<TR><td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[0]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[1]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[2]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[3]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR[4]."</span></td></TR>";			 
		 
		 $TOTAL = $TOTAL + $rec_det_detelsGR[1];
		 $COUNT_2_BRANCH = $COUNT_2_BRANCH + $rec_det_detelsGR[2];
		 $COUNT_2_HO = $COUNT_2_HO + $rec_det_detelsGR[3];
		 $COUNT_2_UCL = $COUNT_2_UCL + $rec_det_detelsGR[4];		 
	 } 
	echo "<TR><td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>Total</span></td>";
	echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$TOTAL."</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_BRANCH."</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_HO."</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$COUNT_2_UCL."</span></td></TR>";	 
?>
</table>
</div>
<div style="padding-left: 250px">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:70px;text-align: left;"><span style="margin-right: 5px;">USER ID</span></td>
			<td style="width:200px;text-align: left;"><span style="margin-right: 5px;">USER NAME</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">COUNT</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">BRANCH</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">HO</span></td>
			<td style="width:50px;text-align: right;"><span style="margin-right: 5px;">UCL</span></td>			
			<td style="width:100px;text-align: right;"><span style="margin-right: 5px;">SUM</span></td>
		</tr>
<?php	// Print the group wise pending info `cdb_helpdesk`.`taken_by` = '  - Pending' v
	$TOTAL = 0;  $TOTAL_HO = 0; $TOTAL_BRANCH = 0; $TOTAL_UCL = 0;
	$FACAMT = 0;
	$v_sql_det_detelsGR1 =  "SELECT replace(`cdb_helpdesk`.`taken_by`,' - Pending',''),
										    GetUserName(replace(`cdb_helpdesk`.`taken_by`,' - Pending','')),
											COUNT(`cdb_helpdesk`.`taken_by`),
											SUM(cdb_helpdesk.ssb_facility_amount)	,
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
								   `cdb_helpdesk`.`curr_stage` = 'LSESANC' AND
								   `cdb_helpdesk`.`taken_by` <> '  - Pending' AND
									date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
								   GROUP BY `cdb_helpdesk`.`taken_by`
								   ORDER BY `cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc;";  
	 $v_que_det_detelsGR1 = mysqli_query($conn,$v_sql_det_detelsGR1);	   
	 while($rec_det_detelsGR1 = mysqli_fetch_array($v_que_det_detelsGR1)){
         echo "<TR><td style='width:70px;text-align: left;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[0]."</span></td>";
		 echo "<td style='width:200px;text-align: left;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[1]."</span></td>";
		 echo "<td style='width:70px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[2]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[4]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[5]."</span></td>";
		 echo "<td style='width:50px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detelsGR1[6]."</span></td>";
		 echo "<td style='width:100px;text-align: right;'><span style='margin-right: 2px;'>".number_format($rec_det_detelsGR1[3],2)."</span></td></TR>";
		 $TOTAL = $TOTAL + $rec_det_detelsGR1[2];
		 $TOTAL_BRANCH = $TOTAL_BRANCH + $rec_det_detelsGR1[4];
		 $TOTAL_HO = $TOTAL_HO + $rec_det_detelsGR1[5];
		 $TOTAL_UCL = $TOTAL_UCL + $rec_det_detelsGR1[6];
		 $FACAMT = $FACAMT + $rec_det_detelsGR1[3];
	 } 
	echo "<TR><td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>Total</span></td>";
	echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>&nbsp;</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$TOTAL."</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$TOTAL_BRANCH."</span></td>";	
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$TOTAL_HO."</span></td>";
	echo "<td style='width:50px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".$TOTAL_UCL."</span></td>";
	echo "<td style='width:70px;text-align: right;font-weight: bold;font-size: 12px;'><span style='margin-right: 2px;'>".number_format($FACAMT,2)."</span></td></tr>";
 
?>		
</table>
</div>		
<!-- End of
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
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Sanction User</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">LOS In</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">LOS</span></td>
			<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">No Of Pending</span></td>
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken Full</span></td>-->
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
                        	else		  ROUND(time_to_sec((TIMEDIFF((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'V'), `cdb_helpdesk`.`enterDateTime`))) / 60)  
                           END AS FULL_TIME_AFTERVRF ,
                           ROUND(time_to_sec((TIMEDIFF(now(), IFNULL(`cdb_helpdesk`.wkfwid_in_time,`cdb_helpdesk`.`lastactivityon`)))) / 60) AS ADII_UP,
						   branch.CDBZONE,
						   `cdb_helpdesk`.wkfwid_in_time,
						   `cdb_helpdesk`.mainFileType,
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
	   `cdb_helpdesk`.`curr_stage` = 'LSESANC' AND
	   `cdb_helpdesk`.`taken_by` <> '  - Pending' AND
	    /*cdb_helpdesk.helpid = '201892640' and  */
	    date(`cdb_helpdesk`.`appcrdate`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY 27 desc"; /*`cdb_helpdesk`.`ssb_type`, cdb_helpdesk.lastactivityon desc ,`cdb_helpdesk`.`appcrdate` desc*/
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
        if($rec_det_detels[19] == "SSOO"){
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
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = ''><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".str_replace(" - Pending","",$rec_det_detels[20])."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = ''><span style='margin-right: 2px;'>".$rec_det_detels[28]."</span></td>";
		
		
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