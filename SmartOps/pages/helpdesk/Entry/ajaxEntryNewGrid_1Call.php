<?php
	session_start();
    include('../../../php_con/includes/db.ini.php');
        
    $v_sql_det_detelsCNT = "SELECT COUNT(1),
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = date(now()) THEN 1 END) , 
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) < date(now())  THEN 1 END) , /*subdate(date(now()),1)*/
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = date(now()) AND `cdb_helpdesk`.`facno` = '' THEN 1 END) 
	FROM `cdb_helpdesk`
    WHERE `cdb_helpdesk`.`cat_code` = '1014' AND `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
	    date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) 
		AND `cdb_helpdesk`.`entry_branch` = 'UCL001' 
        and `cdb_helpdesk`.callRecOn IS NOT NULL
        and `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry AS c
											WHERE c.callstatus = 1
                                            )";
 
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;	
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
        echo "<h3>Total record(s) - UCL  : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[For the Day : ".$rec_det_detelsCNT[1]."]</font>&nbsp;&nbsp;<font style='color:blue; font-size:14px;'>[Last 30 Days : ".$rec_det_detelsCNT[2]." ]</font><img src='../../../images/ucllogo.png' height='20' width='50'></h3>";
		echo "<font style='color:Green; font-size:12px;'>Sort : Call Queue Time - Ascending - [F8 - CDB | F9 - UCL]</font>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
           <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Initiate Date</span></td>
			<td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:110px;text-align: left;"><span style="margin-left: 5px;">Facility Number</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Call Queued</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Agent</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">CIF</span></td> 
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Count</span></td> 
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
                            (`cdb_helpdesk`.`callRecOn`), 
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
                            '', /*`cdb_helpdesk`.`ssb_type`,*/
                            `cdb_helpdesk`.`help_discr`,
                            IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                            `cdb_helpdesk`.`ssb_app_number`,
                            `cdb_helpdesk`.`facno`,
                             0 as agedays, 
                             `cdb_helpdesk`.`curr_stage`,
                             `cdb_helpdesk`.`assign_to`,
                             `cdb_helpdesk`.`taken_by`,
                            IFNULL(`cdb_helpdesk`.priorCallRecOn,`cdb_helpdesk`.callRecOn), /*`cdb_helpdesk`.`lastactivityon`,*/
                            `cdb_helpdesk`.`appcrdate`, 
                            0 AS PEND,
                            0 AS FULL_TIME,
                        	0 AS FULL_TIME_AFTERVRF ,
                            0 AS ADII_UP,
                           `cdb_helpdesk`.`priorCallRecOn` AS priorCallRecOn ,
                           `cdb_helpdesk`.`cif` AS CIF ,
                           (SELECT COUNT(*) FROM callcenterinquiry AS c WHERE c.callstatus = 0 AND c.call_answered = 'NO' AND c.helpid = `cdb_helpdesk`.`helpid`) AS COUNT_CALL,
						   `cdb_helpdesk`.CallAssgined						   
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
	   `cdb_helpdesk`.`entry_branch` = 'UCL001' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
       `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry AS c
											WHERE c.callstatus = 1) 
	    AND date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) 
        AND `cdb_helpdesk`.callRecOn IS NOT NULL  
       ORDER BY `cdb_helpdesk`.`priorCallRecOn` desc , `cdb_helpdesk`.callRecOn;";
    //echo $v_sql_det_detels;
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
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        
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
        $colP = "";
        if($rec_det_detels[27]){
            $colP = "background-color: #ff8080;";
        }
        
        if($rec_det_detels[29] != 0){
            $colP = "background-color: #ffffb3;";
        }
        
        echo "<tr style='color: ".$col.";".$colP."'>";
        
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$colLos ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>"; 
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]. "". ($rec_det_detels[21] == '0000-00-00 00:00:00' ? '' : $rec_det_detels[21]) ." </span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[30]."</span></td>";		
	    echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[28]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[29]."</span></td>";
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