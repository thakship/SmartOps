<?php
include('../../../php_con/includes/db.ini.php');
if(isset($_REQUEST['f9_userID']) && isset($_REQUEST['f9_userg'])){
    //echo $_REQUEST['f9_userID']." - ".$_REQUEST['f9_userg'];
    isget_f9GenaralQC($conn,$_REQUEST['f9_userID'],$_REQUEST['f9_userg']);
}

if(isset($_REQUEST['f9_userIDgen']) && isset($_REQUEST['f9_userggen'])){
    
    isget_f9GenaralQCgen($conn,$_REQUEST['f9_userIDgen'],$_REQUEST['f9_userggen']);
}

if(isset($_REQUEST['d_f9_userID']) && isset($_REQUEST['d_f9_userg'])){
   // echo $_REQUEST['d_f9_userID']." - ".$_REQUEST['d_f9_userg'];
    isget_f9DisbursementQueue($conn,$_REQUEST['d_f9_userID'],$_REQUEST['d_f9_userg']);
}

if(isset($_REQUEST['comf9_userID']) && isset($_REQUEST['comf9_userg'])){
    //echo $_REQUEST['comf9_userID']." - ".$_REQUEST['comf9_userg'];
    isget_f9OperationQueueCompeted($conn,$_REQUEST['comf9_userID'],$_REQUEST['comf9_userg']);
}

function isget_f9GenaralQC($conn,$userID,$userg){
    $v_sql_det_detelsCNT = "SELECT COUNT(1),FORMAT(SUM(ssb_facility_amount),2) AS FACAMT FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
		date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
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
		 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
           `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
           `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
           `cdb_helpdesk`.`cmb_code` = '5002' AND
            `cdb_helpdesk`.`cat_code` = '1014' AND
			date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
           `cdb_help_user_oth`.`user_group` = '".$userg."' AND
           `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
           `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
           ORDER BY `cdb_helpdesk`.`helpid`;";           
            $v_que_app_count = mysqli_query($conn,$v_app_count);
            while($rec_app_count = mysqli_fetch_array($v_que_app_count)){
                echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."&nbsp;&nbsp;&nbsp;[Amount :".$rec_det_detelsCNT[1]."]</h3> <div style='padding-left:900px;font-size:14px;'><table border='1' cellpadding='0' cellspacing='0'><tr><td style='background:#F7819F'>Supplier DO</td><td style='background:#FFFFFF'>Client DO</td></tr></table></div> ";
				// echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_app_count[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_app_count[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_app_count[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_app_count[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_app_count[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_app_count[5]." -  Not Assigned: ".$rec_app_count[7]."  -  In Progress - ".$rec_app_count[8]."]</font></h3>";

            } #F7819F
    }
    echo "<span style='background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:10px; font-weight:bold'><b>F2</b> - Cash-In-Hand , <b>F8</b> - File Verified , <b>F10</b> - QC Pending  </span>
<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='table-layout:fixed;width:100%;background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;; font-size:12px;'>
        <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:70px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:120px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
			<td style='width:120px;text-align: left;'><span style='margin-left: 5px;'>Facility No</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>COD Last Event</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Entered By</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Assigned User</span></td>
			<!-- Start by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>CDPU</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Sec</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Ins</span></td>
			<!-- End of added by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Sup Acc</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chg Rec</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>DO Prnt</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chk List</span></td>
			<td style='width:50px;text-align: left;'><span style='margin-left: 5px;'>Minutes</span></td>

            <td style='width:50px;'></td>
        </tr>";
        $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , `cdb_helpdesk`.`COD_START_DATE`, `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
								   `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , `cdb_helpdesk`.`COD_FILE_PROCUSER` , `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , CONCAT( `cdb_helpdesk`.`COD_LAST_EVENT` , IF(`cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`), '') ),`cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,`cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,`cdb_helpdesk`.`taken_by`,`cdb_helpdesk`.`COD_CHG_REC_ON`,`cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,ROUND(time_to_sec((TIMEDIFF(NOW(), `cdb_helpdesk`.COD_START_DATE))) / 60),`cdb_helpdesk`.`pr_code`,
								   `cdb_helpdesk`.`QC_CDPU_ON` , `cdb_helpdesk`.`QC_SECDOCS_ON`,`cdb_helpdesk`.`QC_INS_ON`,`cdb_helpdesk`.`REC_ACBAL`,`cdb_helpdesk`.`REC_ACCNO`,
								   `cdb_helpdesk`.`SUP_ACCNO`,`cdb_helpdesk`.`SUP_ACCSTS` ,`cdb_helpdesk`.`ssb_type`
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
	   date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
       `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
       ORDER BY `cdb_helpdesk`.`pr_code` desc,`cdb_helpdesk`.`COD_START_DATE`;";
	//echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        $f_Col = "#000000";
        //$colPH = "background-color:#FFFFFF;";
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        $index++; 
		$sql_pending_ph = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Payment Release Doc' AND
                            		pu.PaymentHandling = 'Existing Customer';";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }
        
        
        
                                
        if( $rec_det_detels[25]=='7002'){ // || $rec_det_detels[25]=="7002" $rec_det_detels[8]=='Highest' ||
            $colPr = "background-color:#F7819F;";
        }else{
            $colPr = "";
        }
		
        $MyRow = "";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        $col = "";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        
       $sql_add_img_ok = "SELECT n.note_discr
                                FROM  cdb_help_note AS n 
                                WHERE n.helpid = '".$rec_det_detels[0]."'  
                                ORDER BY n.enterDateTime DESC LIMIT 1;";
        $QUERY_add_img_ok = mysqli_query($conn,$sql_add_img_ok);
        while($rec_add_img_ok = mysqli_fetch_array($QUERY_add_img_ok)){
            $qqq = substr($rec_add_img_ok[0],0,20);
            if(substr($rec_add_img_ok[0],0,20) == 'COD Pending Notified' && $rec_det_detels[33] == 'Additional Images Uploaded'){ 
                $col = "#BB11F3;"; //|| && $rec_det_detels[26] == 'Additional Images Uploaded'
            }
        }
        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$colPr .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:60px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:70px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:90px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$colPH."' title='".$rec_det_detels[33]."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:60px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:60px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
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

		if($rec_det_detels[31] != "") {
			if($rec_det_detels[32] == "1") 
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[31]." Acc Freeze'><span style='margin-left: 2px;'><img src='../../../img/warning.png'></span></td>";
			else
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[31]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";
		}
		else
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";

		if($rec_det_detels[21] == '0000-00-00 00:00:00') // Charges Recovery Column
			if($rec_det_detels[29] != 0) 
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[29]."'><span style='margin-left: 2px;'><img src='../../../img/cash.png'></span></td>";
			else{
				if($rec_det_detels[30] != "0" && $rec_det_detels[30] != "") 
					echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[30]." No Balance'><span style='margin-left: 2px;'><img src='../../../img/warning.png'></span></td>";
				else
					echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
			} 
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[21]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[22] == '0000-00-00 00:00:00') // Do Printing Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[22]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[23] == '0000-00-00 00:00:00') // Check List Column
			echo "<td style='width:50px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:50px;text-align: left;' title ='".$rec_det_detels[23]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";
	
	
		echo "<td style='width:90px;text-align: left;".$MyRow ."' title='".con_min_days($rec_det_detels[24])."'><span style='margin-left: 2px;'>".$rec_det_detels[24]."</span></td>";
        /*Rizvi*/           
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
	
	function con_min_days($mins){
		$hours = str_pad(floor($mins /60),2,"0",STR_PAD_LEFT);
		$mins  = str_pad($mins %60,2,"0",STR_PAD_LEFT);

		if((int)$hours > 24){
		  $days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
		  $hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
		}
		if(isset($days)) {$days = $days." Dy ";} else {	$days = "";}

		return $days.($hours=="00"?"":$hours." Hr ").$mins." Mn";
    } 
}


function isget_f9GenaralQCgen($conn,$f9_userIDgen,$f9_userggen){
    $v_sql_det_detelsCNT = "SELECT COUNT(1),FORMAT(SUM(ssb_facility_amount),2) AS FACAMT FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
		date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$f9_userggen."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$f9_userIDgen."' AND
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
		 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
           `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
           `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
           `cdb_helpdesk`.`cmb_code` = '5002' AND
            `cdb_helpdesk`.`cat_code` = '1014' AND
			date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
           `cdb_help_user_oth`.`user_group` = '".$f9_userggen."' AND
           `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$f9_userIDgen."' AND
           `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
           ORDER BY `cdb_helpdesk`.`helpid`;";           
            $v_que_app_count = mysqli_query($conn,$v_app_count);
            while($rec_app_count = mysqli_fetch_array($v_que_app_count)){
                echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."&nbsp;&nbsp;&nbsp;[Amount :".$rec_det_detelsCNT[1]."]</h3> <div style='padding-left:900px;font-size:14px;'><table border='1' cellpadding='0' cellspacing='0'><tr><td style='background:#F7819F'>Supplier DO</td><td style='background:#FFFFFF'>Client DO</td></tr></table></div> ";
				// echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_app_count[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_app_count[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_app_count[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_app_count[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_app_count[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_app_count[5]." -  Not Assigned: ".$rec_app_count[7]."  -  In Progress - ".$rec_app_count[8]."]</font></h3>";

            } #F7819F
    } 
    
    echo "<span style='background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:10px; font-weight:bold'><b>F2</b> - Cash-In-Hand , <b>F8</b> - File Verified , <b>F10</b> - QC Pending  </span>
<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='table-layout:fixed;width:100%;background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;; font-size:12px;'>
        <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:70px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:120px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
			<td style='width:120px;text-align: left;'><span style='margin-left: 5px;'>Facility No</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>COD Last Event</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Entered By</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Assigned User</span></td>
			<!-- Start by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>CDPU</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Sec</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Ins</span></td>
			<!-- End of added by Rizvi on 8:45 PM 23/02/2017 : QC Feature -->
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Sup Acc</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chg Rec</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>DO Prnt</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chk List</span></td>
			<td style='width:50px;text-align: left;'><span style='margin-left: 5px;'>Minutes</span></td>

            <td style='width:50px;'></td>
        </tr>";
        $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , `cdb_helpdesk`.`COD_START_DATE`, `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
								   `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , `cdb_helpdesk`.`COD_FILE_PROCUSER` , `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , CONCAT( `cdb_helpdesk`.`COD_LAST_EVENT` , IF(`cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`), '') ),`cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,`cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,`cdb_helpdesk`.`taken_by`,`cdb_helpdesk`.`COD_CHG_REC_ON`,`cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,ROUND(time_to_sec((TIMEDIFF(NOW(), `cdb_helpdesk`.COD_START_DATE))) / 60),`cdb_helpdesk`.`pr_code`,
								   `cdb_helpdesk`.`QC_CDPU_ON` , `cdb_helpdesk`.`QC_SECDOCS_ON`,`cdb_helpdesk`.`QC_INS_ON`,`cdb_helpdesk`.`REC_ACBAL`,`cdb_helpdesk`.`REC_ACCNO`,
								   `cdb_helpdesk`.`SUP_ACCNO`,`cdb_helpdesk`.`SUP_ACCSTS` ,`cdb_helpdesk`.`ssb_type` ,
                                    `cdb_helpdesk`.`COD_LAST_EVENT_DT` ,
                                    (select scat_03.scat_discr_3 from scat_03 where scat_03.cat_code = cdb_helpdesk.cat_code and scat_03.scat_code_1 = cdb_helpdesk.scat_code_1 and scat_03.scat_code_2 = cdb_helpdesk.scat_code_2 and scat_03.scat_code_3 = cdb_helpdesk.scat_code_3)
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND   
	   date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$f9_userggen."' AND
           `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$f9_userIDgen."' AND
       `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'
       ORDER BY `cdb_helpdesk`.`pr_code` desc,`cdb_helpdesk`.`COD_START_DATE`;";
	//echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        $f_Col = "#000000";
        //$colPH = "background-color:#FFFFFF;";
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        $index++; 
		$sql_pending_ph = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Payment Release Doc' AND
                            		pu.PaymentHandling = 'Existing Customer';";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }
        
        
        
                                
        if( $rec_det_detels[25]=='7002'){ // || $rec_det_detels[25]=="7002" $rec_det_detels[8]=='Highest' ||
            $colPr = "background-color:#F7819F;";
        }else{
            $colPr = "";
        }
		
        $MyRow = "";
        if ($f9_userIDgen == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        $col = "";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded" || $rec_det_detels[33] == 'Additional Images Uploaded'){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded" || $rec_det_detels[33] == 'Additional Images Uploaded')
            $col = "#BB11F3;";
        }
                
        /*
       $sql_add_img_ok = "SELECT n.note_discr
                                FROM  cdb_help_note AS n 
                                WHERE n.helpid = '".$rec_det_detels[0]."'  
                                and n.note_discr like 'File Scanned%'
                                ORDER BY n.enterDateTime DESC LIMIT 1;";
        $QUERY_add_img_ok = mysqli_query($conn,$sql_add_img_ok);
        while($rec_add_img_ok = mysqli_fetch_array($QUERY_add_img_ok)){
            $qqq = substr($rec_add_img_ok[0],0,20);
            if(substr($rec_add_img_ok[0],0,20) == 'COD Pending Notified' && $rec_det_detels[33] == 'Additional Images Uploaded'){ 
                $col = "#BB11F3;"; //|| && $rec_det_detels[26] == 'Additional Images Uploaded'
            }
        }
        */
        $qwer = "";
        $sql_pendin_upload_doc = "SELECT pu.done_on ,  pu.DocPurpose
                                    FROM pending_upload_file AS pu
                                    WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                            pu.DocPurpose = 'Pending Reply' 
                                    ORDER BY pu.done_on DESC LIMIT 1;";
        $query_pendin_upload_doc = mysqli_query($conn,$sql_pendin_upload_doc);
        $row_count_upload_doc = mysqli_num_rows($query_pendin_upload_doc);
         if($row_count_upload_doc == 0){
            //while($rec_pendin_upload_doc = mysqli_fetch_array($query_pendin_upload_doc)){
                //$qwer = $rec_pendin_upload_doc[0];
                //$rec_det_detels[12] && ($rec_det_detels[33] <  $rec_pendin_upload_doc[0])
                if(substr($rec_det_detels[12],0,16)  == "Pending Notified"){
                   // $qwer = $rec_pendin_upload_doc[0];
                    $qwer = "background-color:#ff3300;";
                }/*else{
                    $qwer = $rec_det_detels[12];
                }*/
               // `cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`)
                
            //}
        }else{
            while($rec_pendin_upload_doc = mysqli_fetch_array($query_pendin_upload_doc)){
                if(substr($rec_det_detels[12],0,16)  == "Pending Notified" && $rec_pendin_upload_doc[0] < $rec_det_detels[34]){
                   // $qwer = $rec_pendin_upload_doc[0];
                    $qwer = "background-color: #ff3300;";
                }else{
                    $qwer = "background-color:#99e699;";
                }
            }
        }
                                    
        /*$sql_pending_ph_1 = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Pending Reply' ;";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }*/
        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$colPr .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:60px;text-align: right;".$MyRow."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:70px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]." - ".$rec_det_detels[35]."</span></td>";
        echo "<td style='width:90px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$colPH."' title='".$rec_det_detels[33]."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:60px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:60px;text-align: right;".$qwer."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
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

		if($rec_det_detels[31] != "") {
			if($rec_det_detels[32] == "1") 
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[31]." Acc Freeze'><span style='margin-left: 2px;'><img src='../../../img/warning.png'></span></td>";
			else
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[31]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";
		}
		else
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";

		if($rec_det_detels[21] == '0000-00-00 00:00:00') // Charges Recovery Column
			if($rec_det_detels[29] != 0) 
				echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[29]."'><span style='margin-left: 2px;'><img src='../../../img/cash.png'></span></td>";
			else{
				if($rec_det_detels[30] != "0" && $rec_det_detels[30] != "") 
					echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[30]." No Balance'><span style='margin-left: 2px;'><img src='../../../img/warning.png'></span></td>";
				else
					echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
			} 
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[21]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[22] == '0000-00-00 00:00:00') // Do Printing Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[22]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[23] == '0000-00-00 00:00:00') // Check List Column
			echo "<td style='width:50px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:50px;text-align: left;' title ='".$rec_det_detels[23]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";
	
	
		echo "<td style='width:90px;text-align: left;".$MyRow ."' title='".con_min_days($rec_det_detels[24])."'><span style='margin-left: 2px;'>".$rec_det_detels[24]."</span></td>";
        /*Rizvi*/           
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }

}

function con_min_days($mins){
	$hours = str_pad(floor($mins /60),2,"0",STR_PAD_LEFT);
	$mins  = str_pad($mins %60,2,"0",STR_PAD_LEFT);

	if((int)$hours > 24){
	  $days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
	  $hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
	}
	if(isset($days)) {$days = $days." Dy ";} else {	$days = "";}

	return $days.($hours=="00"?"":$hours." Hr ").$mins." Mn";
}

function getUserNameGenaral_Mob_Eml($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID`,`email`,`GSMNO` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0]."&#013;".$RES_getUsreNAme[1]."&#013;".$RES_getUsreNAme[2];
    }
}

function isget_f9DisbursementQueue($conn,$userID,$userg){
      $v_sql_det_detelsCNT = "SELECT COUNT(1),FORMAT(SUM(ssb_facility_amount),2) AS FACAMT FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
		date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
         `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON <> '0000-00-00 00:00:00'
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
		 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
           `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
           `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
           `cdb_helpdesk`.`cmb_code` = '5002' AND
            `cdb_helpdesk`.`cat_code` = '1014' AND
			date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
           `cdb_help_user_oth`.`user_group` = '".$userg."' AND
           `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
           `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON <> '0000-00-00 00:00:00'
           ORDER BY `cdb_helpdesk`.`helpid`;";           
            $v_que_app_count = mysqli_query($conn,$v_app_count);
            while($rec_app_count = mysqli_fetch_array($v_que_app_count)){                
				echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."&nbsp;&nbsp;&nbsp;[Amount :".$rec_det_detelsCNT[1]."]</h3> <div style='padding-left:900px;font-size:14px;'><table border='1' cellpadding='0' cellspacing='0'><tr><td style='background:#F7819F'>Supplier DO</td><td style='background:#FFFFFF'>Client DO</td></tr></table></div> ";
                //echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."&nbsp;&nbsp;&nbsp;[Amount :".$rec_det_detelsCNT[1]."]</h3>";
				// echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_app_count[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_app_count[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_app_count[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_app_count[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_app_count[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_app_count[5]." -  Not Assigned: ".$rec_app_count[7]."  -  In Progress - ".$rec_app_count[8]."]</font></h3>";

            }
    }
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:12px;'>
        <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:110px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:230px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
			<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Facility No</span></td>
            <td style='width:190px;text-align: left;'><span style='margin-left: 5px;'>COD Last Event</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Entered By</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assigned User</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chg Rec</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>DO Prnt</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chk List</span></td>
			<td style='width:25px;text-align: left;'><span style='margin-left: 5px;'>Minutes</span></td>

            <td style='width:50px;'></td>
        </tr>";
    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , `cdb_helpdesk`.`COD_START_DATE`, `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
								   `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , `cdb_helpdesk`.`COD_FILE_PROCUSER` , `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , CONCAT(`cdb_helpdesk`.`COD_LAST_EVENT`),`cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,`cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,`cdb_helpdesk`.`taken_by`,`cdb_helpdesk`.`COD_CHG_REC_ON`,`cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,ROUND(time_to_sec((TIMEDIFF(NOW(), `cdb_helpdesk`.COD_START_DATE))) / 60),
								   `cdb_helpdesk`.`pr_code` ,`cdb_helpdesk`.`ssb_type`
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
	   date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 90 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
       `cdb_helpdesk`.COD_STATUS = '001' AND `cdb_helpdesk`.COD_DO_PRINT_ON <> '0000-00-00 00:00:00'
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
        
         $sql_pending_ph = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Payment Release Doc' AND
                            		pu.PaymentHandling = 'Existing Customer';";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }
        
        
        if( $rec_det_detels[25]=='7002'){ // || $rec_det_detels[25]=="7002" $rec_det_detels[8]=='Highest' ||
            $colPr = "background-color:#F7819F;";
        }else{
            $colPr = "";
        }
	
        $MyRow = "";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        $col = "#000000";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        
        $sql_add_img_ok = "SELECT n.note_discr
                                FROM  cdb_help_note AS n 
                                WHERE n.helpid = '".$rec_det_detels[0]."'  
                                ORDER BY n.enterDateTime DESC LIMIT 1;";
        $QUERY_add_img_ok = mysqli_query($conn,$sql_add_img_ok);
        while($rec_add_img_ok = mysqli_fetch_array($QUERY_add_img_ok)){
            $qqq = substr($rec_add_img_ok[0],0,20);
            if(substr($rec_add_img_ok[0],0,20) == 'COD Pending Notified' && $rec_det_detels[26] == 'Additional Images Uploaded'){ 
                $col = "#BB11F3;"; //|| 
            }
        }

        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:70px;text-align: right;".$colPr.";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:70px;text-align: right;".$colPr.";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:110px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:230px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";

        echo "<td style='width:190px;text-align: left;".$colPH ."' title='".$rec_det_detels[26]."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
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
        /*Rizvi*/           
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";

}

function isget_f9OperationQueueCompeted($conn,$userID,$userg){
    $v_sql_det_detelsCNT = "SELECT COUNT(1) FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
        `cdb_helpdesk`.`cat_code` = '1014' AND
		date(`cdb_helpdesk`.`disbdate`) >= (CURRENT_DATE - INTERVAL 15 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
       `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
         `cdb_helpdesk`.COD_STATUS IN ('002' , '003') AND
         `cdb_helpdesk`.PAYMENT_RELEASE_ON = '0000-00-00 00:00:00'
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
		 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
           `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
           `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
           `cdb_helpdesk`.`cmb_code` = '5002' AND
            `cdb_helpdesk`.`cat_code` = '1014' AND
			date(`cdb_helpdesk`.`disbdate`) >= (CURRENT_DATE - INTERVAL 15 DAY) AND 
           `cdb_help_user_oth`.`user_group` = '".$userg."' AND
            `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
           `cdb_helpdesk`.COD_STATUS IN ('002' , '003') AND
           `cdb_helpdesk`.PAYMENT_RELEASE_ON = '0000-00-00 00:00:00'
           ORDER BY `cdb_helpdesk`.`helpid`;";           
            $v_que_app_count = mysqli_query($conn,$v_app_count);
            while($rec_app_count = mysqli_fetch_array($v_que_app_count)){
                echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]."</h3>";
				// echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_app_count[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_app_count[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_app_count[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_app_count[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_app_count[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_app_count[5]." -  Not Assigned: ".$rec_app_count[7]."  -  In Progress - ".$rec_app_count[8]."]</font></h3>";

            }
    }
    
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:12px;'>
        <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:110px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:230px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
			<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Facility No</span></td>
            <td style='width:190px;text-align: left;'><span style='margin-left: 5px;'>SSB Type</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Entered By</span></td>
            <!--<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Urgency</span></td>
            <td style='width:70px;text-align: left;'><span style='margin-left: 5px;'>Priority</span></td>-->
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assigned User</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chg Rec</span></td>
            <td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>DO Prnt</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Chk List</span></td>
			<td style='width:30px;text-align: left;'><span style='margin-left: 5px;'>Disb</span></td>
            <td style='width:50px;'></td>
        </tr>";
      $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , `cdb_helpdesk`.`COD_START_DATE`, `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
								   `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , `cdb_helpdesk`.`COD_FILE_PROCUSER` , `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , CONCAT(`cdb_helpdesk`.`COD_LAST_EVENT`),`cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,`cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,`cdb_helpdesk`.`taken_by`,`cdb_helpdesk`.`COD_CHG_REC_ON`,`cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,`cdb_helpdesk`.`disbdate`,`cdb_helpdesk`.`COD_STATUS` ,`cdb_helpdesk`.`ssb_type`
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
	   date(`cdb_helpdesk`.`disbdate`) >= (CURRENT_DATE - INTERVAL 15 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$userg."' AND
        `cdb_helpdesk`.`COD_FILE_PROCUSER` = '".$userID."' AND
       `cdb_helpdesk`.COD_STATUS IN ('002' , '003') AND
           `cdb_helpdesk`.PAYMENT_RELEASE_ON = '0000-00-00 00:00:00'
       ORDER BY `cdb_helpdesk`.`disbdate` desc;";
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
        
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        
        
        $sql_add_img_ok = "SELECT n.note_discr
                                FROM  cdb_help_note AS n 
                                WHERE n.helpid = '".$rec_det_detels[0]."'  
                                ORDER BY n.enterDateTime DESC LIMIT 1;";
        $QUERY_add_img_ok = mysqli_query($conn,$sql_add_img_ok);
        while($rec_add_img_ok = mysqli_fetch_array($QUERY_add_img_ok)){
            $qqq = substr($rec_add_img_ok[0],0,20);
            if(substr($rec_add_img_ok[0],0,24) == 'Operation Notify Pending' && $rec_det_detels[26] == 'Additional Images Uploaded'){ 
                $col = "#BB11F3;"; //|| 
            }
        }
        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:70px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:70px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:110px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:230px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";

        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		
		if($rec_det_detels[21] == '0000-00-00 00:00:00') // Charges Recovery Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[21]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[22] == '0000-00-00 00:00:00') // Do Printing Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[22]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[23] == '0000-00-00 00:00:00') // Check List Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[23]."'><span style='margin-left: 5px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[24] == '0000-00-00') // Disb Column
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[24]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[25]=='002'?'1':'2') .".png'></span></td>";
		
        /*Rizvi*/        
       /* echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15].chr(10).$rec_det_detels[18].chr(10).$rec_det_detels[19].chr(10).$rec_det_detels[20]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'>".str_pad($rec_det_detels[17], 2, '0', STR_PAD_LEFT)."</span></td>";
        
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>