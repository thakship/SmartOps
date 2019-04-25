<?php
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
       
    $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`,`cdb_ssb` ";       
     $vsqlAux_1 = "`cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."'"; /*  */
     $vsqlAux_2 = ""; /* AND `cdb_helpdesk`.`asing_by` = '".$_REQUEST['n_userID']."'*/
     $vsqlAux_3 = "`cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND "; /**/
     $vsqlAux_4 = "";
     
		

     $v_sql_det_detelsCNT = "SELECT COUNT(1), COUNT(1) - COUNT(NULLIF(TRIM(`cdb_helpdesk`.`asing_by`), '')) ,
	     COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` like 'Pending Notified%' THEN 1 END) AS PENDING_NOTIFIED,
	     COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File re-submitted' THEN 1 END) AS FILE_RE_SUBMITTED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'Additional Images Uploaded' THEN 1 END) AS ADD_IMG_UPLOADED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' THEN 1 END) AS FILE_VERIFIED,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'Initial Submission' THEN 1 END) AS INIT_SUBMISSION ,
         COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' AND TRIM(`cdb_helpdesk`.`asing_by`) = '' THEN 1 END) AS FILE_VERIFIED_P,
		 COUNT(CASE WHEN `cdb_helpdesk`.`ssb_type` = 'File Verified by CDPU' AND TRIM(`cdb_helpdesk`.`asing_by`) <> '' THEN 1 END) AS FILE_VERIFIED_PR ".$FromTables."
     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
           `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
		   cdb_helpdesk.helpid = cdb_ssb.helpid AND
           `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
           `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
		   `cdb_helpdesk`.`helpid` IN (select cdb_ssb_his.helpid from cdb_ssb_his where cdb_ssb_his.P_V = 'V') AND
		   not(`cdb_helpdesk`.`ssb_type` like 'Pending Notified%') AND
           `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND ".$vsqlAux_3." `cdb_helpdesk`.`cmb_code` = '5001' AND
           `cdb_helpdesk`.`cat_code` = '1014' AND `scat_02`.scat_code_1 = '101401' AND 
           `cdb_helpdesk`.`ssb_app_number` = ''  AND  date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY)  AND ". $vsqlAux_1.$vsqlAux_2.$vsqlAux_4." ORDER BY `cdb_helpdesk`.`helpid`;";       
 
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	//echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
	//echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_det_detelsCNT[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_det_detelsCNT[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_det_detelsCNT[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_det_detelsCNT[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_det_detelsCNT[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_det_detelsCNT[5]."]</font></h3>";	
	//echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_det_detelsCNT[1]." ]</font>&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[Initial Submission : ".$rec_det_detelsCNT[6]." ]</font>&nbsp;&nbsp;<font style='color:#9966ff; font-size:14px;'>[Pending Notified : ".$rec_det_detelsCNT[2]."]</font>&nbsp;&nbsp;<font style='color:#ff6600; font-size:14px;'>[File Re-Submitted : ".$rec_det_detelsCNT[3]."]</font>&nbsp;&nbsp;<font style='color:#ffcc66; font-size:14px;'>[Additional Images : ".$rec_det_detelsCNT[4]."]</font>&nbsp;&nbsp;<font style='color:#669900; font-size:14px;'>[CDPU Verified : ".$rec_det_detelsCNT[5]." -  Not Assigned: ".$rec_det_detelsCNT[7]."  -  In Progress - ".$rec_det_detelsCNT[8]."]</font></h3>";
	echo "<h3>Total record(s) - File Verified : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[ Not Assigned : ".$rec_det_detelsCNT[1]." ]</font></h3>";

    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->
<span style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold"><b>F2</b> - Cash-In-Hand , <b>F3</b> - 3W , <b>F4</b> - Other Products , <b>F8</b> - File Verified , <b>F10</b> - QC Pending , <b>F1</b> - QC Pending (Officer Sort) 
<table border="1" cellpadding="0" cellspacing="0" style="margin-left: 800px;">
<tr><td style="width:100px;text-align: left;">SSB Type</td><td style="width:100px;text-align: left;" bgcolor='#fbe379'>With Pending</td><td style="width:100px;text-align: left;" bgcolor='#cabefd'>Zero Pending</td></tr>
</table>
</span>
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
			<td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Cl</span></td>
            <td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Sup</span></td>
            <td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Sec</span></td>			
            <td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Gu1</span></td>
            <td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Gu2</span></td>
            <!--<td style="width:30px;text-align: left;"><span style="margin-left: 1px;">Gu3</span></td>-->
			
		    <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assigned User</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Minutes Elapsed</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Minutes After Last Assignment</span></td>
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">App</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Fac</span></td>-->
            <td style="width:50px;"></td>
        </tr>
<?php
    /*$v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `cdb_helpdesk`.`asing_by` 
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."' AND
       `cdb_helpdesk`.`asing_by` = '".$_REQUEST['n_userID']."'
       ORDER BY `cdb_helpdesk`.`helpid`;";*/
       
 $FromTables = "FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`,`cdb_ssb` ";       
 $vsqlAux_1 = "`cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."'"; /*`cdb_help_user_oth`.`user_group` = '".$_REQUEST['n_userg']."'*/
 $vsqlAux_2 = "";
 $vsqlAux_3 = "`cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND  "; /**/
 $vsqlAux_4 = "";
    
 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , (`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, 
 `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , 
 `cdb_helpdesk`.`asing_by` , `cdb_helpdesk`.`cat_code` , `cdb_helpdesk`.`ssb_facility_amount` , 
 CONCAT(`cdb_helpdesk`.`ssb_type`,' - ',(`cdb_helpdesk`.`lastactivityon`)) ,`cdb_helpdesk`.`help_discr`,
 IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,`cdb_helpdesk`.`ssb_app_number`,
 `cdb_helpdesk`.`facno`,ROUND(time_to_sec((TIMEDIFF(NOW(), `cdb_helpdesk`.lastactivityon))) / 60)
 ,ROUND(time_to_sec((TIMEDIFF(NOW(), (select max(cn.enterDateTime) from cdb_help_note cn where cn.helpid = cdb_helpdesk.helpid and cn.note_discr like 'Agent Assigned to file%')))) / 60) "
 ." ,IFNULL((select COUNT(*) from cdb_ssb_his ssbh where ssbh.helpid = `cdb_helpdesk`.helpid  and ssbh.P_V = 'P') ,0),
 clcode_val,supcode_val,sec_no_val,gar_code_1_val,gar_code_2_val,gar_code_3_val,`clcode`,`supcode`,`sec_no`,`gar_code_1`,`gar_code_2`,`gar_code_3`,
ROUND(time_to_sec((TIMEDIFF(NOW(), IFNULL((select max(p.done_on) from pending_upload_file p where p.help_id = cdb_helpdesk.helpid),cdb_helpdesk.enterDateTime)))) / 60) "
 .$FromTables."
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
	   cdb_helpdesk.helpid = cdb_ssb.helpid AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber` AND
	   not(`cdb_helpdesk`.`ssb_type` like 'Pending Notified%') AND 
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND ".$vsqlAux_3." `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND `scat_02`.scat_code_1 = '101401' AND 
       `cdb_helpdesk`.`ssb_app_number` = '' AND  date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY)  
	   AND `cdb_helpdesk`.`helpid` IN (select cdb_ssb_his.helpid from cdb_ssb_his where cdb_ssb_his.P_V = 'V')
	   AND ". $vsqlAux_1.$vsqlAux_2.$vsqlAux_4." ORDER BY 33 desc;";
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
        if ($_REQUEST['n_userID'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
				
		if (substr($rec_det_detels[12],0,17) == "File re-submitted" || substr($rec_det_detels[12],0,26) == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if(substr($rec_det_detels[12],0,26) == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        
		if($rec_det_detels[19]>0){
			echo "<td style='width:200px;text-align: left;".$MyRow ."' bgcolor='#fbe379'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
		}
		else{
			echo "<td style='width:200px;text-align: left;".$MyRow ."' bgcolor='#cabefd'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";			
		}
		
		
		if($rec_det_detels[20] == '0') // Client 
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[26]."'><span style='margin-left: 2px;'>".($rec_det_detels[26]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[26]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";
		
		if($rec_det_detels[21] == '0') // Sup 
			echo "<td style='width:30px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>&nbsp;</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[27]."'><span style='margin-left: 2px;'>".($rec_det_detels[27]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";

		if($rec_det_detels[22] == '0') // Sec 
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[28]."'><span style='margin-left: 2px;'>".($rec_det_detels[28]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[28]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";

		if($rec_det_detels[23] == '0') // Gu 1 
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[29]."'><span style='margin-left: 2px;'>".($rec_det_detels[29]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[29]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";
		
		if($rec_det_detels[24] == '0') // Gu 2 
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[30]."'><span style='margin-left: 2px;'>".($rec_det_detels[30]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[30]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";

		/*if($rec_det_detels[25] == '0') // Gu 2 
			echo "<td style='width:30px;text-align: left;".$MyRow ."' title ='".$rec_det_detels[31]."'><span style='margin-left: 2px;'>".($rec_det_detels[31]==0?"&nbsp;":"<img src='../../../img/note.gif'>")."</span></td>";
		else        
			echo "<td style='width:30px;text-align: left;' title ='".$rec_det_detels[31]."'><span style='margin-left: 2px;'><img src='../../../img/1.png'></span></td>";
		*/
		
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		if ($rec_det_detels[32]>30){   // $rec_det_detels[17] == From Last verified time 3:22 PM 15/06/2017
			echo "<td style='width:70px;text-align: right;".$MyRow ."' bgcolor='#f99995' title='From Last Verified: ".$rec_det_detels[17]."'><span style='margin-right: 2px;'>".$rec_det_detels[32]."</span></td>";
		}
		elseif($rec_det_detels[32]>15){ // $rec_det_detels[17] == From Last verified time 3:22 PM 15/06/2017
			echo "<td style='width:70px;text-align: right;".$MyRow ."' bgcolor='#e8ff42' title='From Last Verified: ".$rec_det_detels[17]."'><span style='margin-right: 2px;'>".$rec_det_detels[32]."</span></td>";
		}else
			echo "<td style='width:70px;text-align: right;".$MyRow ."'  bgcolor='#d9ff87' title='From Last Verified: ".$rec_det_detels[17]."'><span style='margin-right: 2px;'>".$rec_det_detels[32]."</span></td>";
		
		/*Rizvi*/        
        echo "<td style='width:40px;text-align: left;'><span style='margin-left: 5px;'>".$rec_det_detels[18]."</span></td>";
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";
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
