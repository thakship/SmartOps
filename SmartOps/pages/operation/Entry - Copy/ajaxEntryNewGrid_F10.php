<?php
    include('../../../php_con/includes/db.ini.php');
    include('../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php');
?>
<!-- added by Madushan on 11:00 AM 16/03/2017 -->
F10 - Genaral
<?php
    $v_sql_det_detelsCNT = "SELECT COUNT(1),FORMAT(SUM(ssb_facility_amount),2) AS FACAMT 
    FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth` , `scat_02`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
        `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
        `scat_02`.scat_code_1 = '101401' AND `scat_02`.scat_code_2 = '10140115' AND
		date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."' AND
         `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
       ORDER BY `cdb_helpdesk`.`helpid`;";
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
           $v_app_count = "SELECT COUNT(1), COUNT(1) - COUNT(NULLIF(TRIM(`cdb_helpdesk`.`asing_by`), '')) ,
	     COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` like 'Pending Notified%' THEN 1 END) AS PENDING_NOTIFIED,
	     COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File re-submitted' THEN 1 END) AS FILE_RE_SUBMITTED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' THEN 1 END) AS ADD_IMG_UPLOADED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' THEN 1 END) AS FILE_VERIFIED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'Initial Submission' THEN 1 END) AS INIT_SUBMISSION,
         COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' AND TRIM(`cdb_helpdesk`.`asing_by`) = '' THEN 1 END) AS FILE_VERIFIED_P ,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' AND TRIM(`cdb_helpdesk`.`asing_by`) <> '' THEN 1 END) AS FILE_VERIFIED_PR 
		 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth` ,  `scat_02`
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
           `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
           `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND
           `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND 
           `cdb_helpdesk`.`cmb_code` = '5002' AND
            `cdb_helpdesk`.`cat_code` = '1014' AND
            `scat_02`.scat_code_1 = '101401' AND `scat_02`.scat_code_2 = '10140115' AND
			date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
           `cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."' AND
           `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
           ORDER BY `cdb_helpdesk`.`helpid`;";           
            $v_que_app_count = mysqli_query($conn,$v_app_count);
            while($rec_app_count = mysqli_fetch_array($v_que_app_count)){
                echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."&nbsp;&nbsp;&nbsp;[Amount :".$rec_det_detelsCNT[1]."]</h3> <div style='padding-left:900px;font-size:14px;'><table border='1' cellpadding='0' cellspacing='0'><tr><td style='background:#F7819F'>Supplier DO</td><td style='background:#FFFFFF'>Client DO</td></tr></table></div> ";
				// echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_app_count[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_app_count[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_app_count[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_app_count[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_app_count[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_app_count[5]." -  Not Assigned: ".$rec_app_count[7]."  -  In Progress - ".$rec_app_count[8]."]</font></h3>";

            } #F7819F
    } 

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->
<span style="background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:11px; font-weight:bold"><b>F2</b> - Cash-In-Hand , <b>F8</b> - File Verified , <b>F10</b> - QC Pending  </span>
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:110px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
			<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Facility No</span></td>
            <td style="width:190px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entered By</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assigned User</span></td>
			<!-- Start by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
			<td style="width:30px;text-align: left;"><span style="margin-left: 5px;">QC CDPU</span></td>
			<td style="width:30px;text-align: left;"><span style="margin-left: 5px;">QC SECDOCS</span></td>
			<td style="width:30px;text-align: left;"><span style="margin-left: 5px;">QC INS</span></td>
			<!-- End of added by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
            <td style="width:30px;text-align: left;"><span style="margin-left: 5px;">Chg Rec</span></td>
            <td style="width:30px;text-align: left;"><span style="margin-left: 5px;">DO Prnt</span></td>
			<td style="width:30px;text-align: left;"><span style="margin-left: 5px;">Chk List</span></td>
			<td style="width:25px;text-align: left;"><span style="margin-left: 5px;">Minutes</span></td>

            <td style="width:50px;"></td>
        </tr>
<?php

       $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , `cdb_helpdesk`.`COD_START_DATE`, `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
								   `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , `cdb_helpdesk`.`COD_FILE_PROCUSER` , `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , CONCAT( `cdb_helpdesk`.`COD_LAST_EVENT` , IF(`cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`), '') ),`cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,`cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,`cdb_helpdesk`.`taken_by`,`cdb_helpdesk`.`COD_CHG_REC_ON`,`cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,ROUND(time_to_sec((TIMEDIFF(NOW(), `cdb_helpdesk`.COD_START_DATE))) / 60),`cdb_helpdesk`.`pr_code`,
								   `cdb_helpdesk`.`QC_CDPU_ON` , `cdb_helpdesk`.`QC_SECDOCS_ON`,`cdb_helpdesk`.`QC_INS_ON`
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth` 
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `scat_02`.scat_code_1 = '101401' AND `scat_02`.scat_code_2 = '10140115' AND
	   date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."' AND
       `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
       ORDER BY `cdb_helpdesk`.`pr_code` desc,`cdb_helpdesk`.`COD_START_DATE`;";
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
		
        if( $rec_det_detels[25]=='7002'){ // || $rec_det_detels[25]=="7002" $rec_det_detels[8]=='Highest' ||
            $colPr = "background-color:#F7819F;";
        }else{
            $colPr = "";
        }
		
        $MyRow = "";
        //if ($_SESSION['user'] == $rec_det_detels[9]){
           //$MyRow = "background-color:lightblue;";
        //}
        $col = "";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:70px;text-align: right;".$colPr .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:70px;text-align: right;".$colPr .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:110px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";

        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
		if($rec_det_detels[26] == '') // QC_CDPU
			echo "<td style='width:25px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:25px;text-align: left;' title ='".$rec_det_detels[26]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";
		if($rec_det_detels[27] == '') // QC_SECURITY DOC
			echo "<td style='width:25px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:25px;text-align: left;' title ='".$rec_det_detels[27]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";
		if($rec_det_detels[28] == '') // QC_INSURANCE
			echo "<td style='width:25px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:25px;text-align: left;' title ='".$rec_det_detels[28]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		
		if($rec_det_detels[21] == '0000-00-00 00:00:00') // Charges Recovery Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[21]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[22] == '0000-00-00 00:00:00') // Do Printing Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[22]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[23] == '0000-00-00 00:00:00') // Check List Column
			echo "<td style='width:25px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:25px;text-align: left;' title ='".$rec_det_detels[23]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";
	
	
		echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[24]."</span></td>";         
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
?>
</table>