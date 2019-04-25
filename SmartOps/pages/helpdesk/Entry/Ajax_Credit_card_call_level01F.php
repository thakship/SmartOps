<?php
session_start();
include('../../../php_con/includes/db.ini.php');
include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');

if(isset($_REQUEST['userg_CRditCC']) && isset($_REQUEST['FKey'])){
	if($_REQUEST['FKey'] == 112){
	   //echo $_REQUEST['userg_CRditCC']." - ".$_REQUEST['FKey']."F1";
       getF1_Call_Status_1($_REQUEST['userg_CRditCC'],$conn); // Call Status 01
	}else if($_REQUEST['FKey'] == 113){
	 // echo $_REQUEST['userg_CRditCC']." - ".$_REQUEST['FKey']."F2";
     getF1_Call_Status_2($_REQUEST['userg_CRditCC'],$conn); // Call Status 01
	}else{
      echo $_REQUEST['userg_CRditCC']." - ".$_REQUEST['FKey'];  
    }
   
}

function getF1_Call_Status_1($user_group,$conn){
    
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:260px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
            <td style='width:190px;text-align: left;'><span style='margin-left: 5px;'>SSB Type</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Call Count</span></td>
            <td style='width:250px;'></td>
        </tr>";
    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                                `cdb_helpdesk`.`enterDateTime`, 
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
                                CONCAT(`cdb_helpdesk`.`ssb_type`), 
                                `cdb_helpdesk`.`help_discr`,
                                IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                                `cdb_helpdesk`.`ssb_app_number`,
                                `cdb_helpdesk`.`facno`,
                                datediff(date(now()),DATE(`cdb_helpdesk`.`enterDateTime`)) as agedays,
                                `cdb_helpdesk`.`curr_stage`,
                                `cdb_helpdesk`.`assign_to`,
                                `cdb_helpdesk`.`taken_by`,
                                `cdb_helpdesk`.`mainFileType` ,
				                (SELECT COUNT(*) FROM callcenterinquiry_creaditcard AS c1 WHERE c1.helpid = `cdb_helpdesk`.`helpid`) AS CALL_Count
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5050' AND
       `cdb_helpdesk`.`cat_code` = '1038' AND
       `cdb_helpdesk`.`ssb_app_number` = '' AND date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$user_group."' AND
       `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry_creaditcard AS c
											WHERE c.callstatus = 1)
       
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
       /*
         
       */
	//echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        if($rec_det_detels[22] == 1 ){     
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
                    //echo $col."<BR>";
                    echo "<tr style='color: ".$col.";'>";
                    
                    if($rec_det_detels[17] <= 15){
                        echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    }else{
                        echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    }
                    echo "<td style='width:200px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
                    echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
                    echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
                    echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
                    echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
                    echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
                    echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
                    echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
                    echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 5px;'>".$rec_det_detels[22]."</span></td>";
                    echo "<td style='width:250px;'>";
                      
                            $sql_btn1 = "SELECT COUNT(*) 
                                           FROM credit_card_call_dtl AS cq 
                                          WHERE cq.helpid = '".$rec_det_detels[0]."' ;";
                            //echo $sql_btn1."<br/>";
                            $query_btn1 = mysqli_query($conn,$sql_btn1) or die(mysqli_error($conn));
                            while ($rec_btn1 = mysqli_fetch_array($query_btn1)){
                                if($rec_btn1[0] == 0){
                                     echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                     echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                     //echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                }else{
                                    $a = "N";
                                    $b = "N";
                                    $c = "N";
                                    $z = 0;
                                    $sql_btn2 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 1 ;";
                                    //echo $sql_btn2."<br/>";
                                    $query_btn2 = mysqli_query($conn,$sql_btn2) or die(mysqli_error($conn));
                                    while($resalt_btn2 = mysqli_fetch_array($query_btn2)){
                                        //echo $resalt_btn2[0]." - ";
                                        if($resalt_btn2[0] != 0){
                                            $a = "Y";
                                        }
                                    }
                                    $sql_btn3 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 2 ;";
                                    //echo $sql_btn3."<br/>";
                                    $query_btn3 = mysqli_query($conn,$sql_btn3) or die(mysqli_error($conn));
                                    while($resalt_btn3 = mysqli_fetch_array($query_btn3)){
                                       //echo $resalt_btn3[0]." - ";
                                        if($resalt_btn3[0] != 0){
                                            $b = "Y";
                                        }
                                    }
                                    /*$sql_btn4 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 3 ;";
                                    //echo $sql_btn4."<br/>";
                                    $query_btn4 = mysqli_query($conn,$sql_btn4) or die(mysqli_error($conn));
                                    while($resalt_btn4 = mysqli_fetch_array($query_btn4)){
                                        //echo $resalt_btn4[0]." - ";
                                        if($resalt_btn4[0] != 0){
                                            $c = "Y";
                                        }
                                    }*/
                                    //echo $a . " | " .$b . " | " . $c; 
                                    //if($a == "Y" && $b == "N" && $c == "N"){
                                    if($a == "Y" && $b == "N"){
                                            // echo "A";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    //}else if($a == "Y" && $b == "Y" && $c == "N"){
                                    }else if($a == "Y" && $b == "Y"){
                                          //  echo "B";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    }/*else if($a == "Y" && $b == "N" && $c == "Y"){
                                           // echo "C";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    }*/else{
                                        
                                    }
                                    
                                }
                            }
                            
                      // }
                    echo "</td>";
                    echo "</tr>";
        } // Een Count If in Call Statues.   
    }
    echo "</table>";
}


function getF1_Call_Status_2($user_group,$conn){
    
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
            <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
            <td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
            <td style='width:90px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
            <td style='width:260px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
            <td style='width:190px;text-align: left;'><span style='margin-left: 5px;'>SSB Type</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
            <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Call Count</span></td>
            <td style='width:250px;'></td>
        </tr>";
    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                                `cdb_helpdesk`.`enterDateTime`, 
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
                                CONCAT(`cdb_helpdesk`.`ssb_type`), 
                                `cdb_helpdesk`.`help_discr`,
                                IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                                `cdb_helpdesk`.`ssb_app_number`,
                                `cdb_helpdesk`.`facno`,
                                datediff(date(now()),DATE(`cdb_helpdesk`.`enterDateTime`)) as agedays,
                                `cdb_helpdesk`.`curr_stage`,
                                `cdb_helpdesk`.`assign_to`,
                                `cdb_helpdesk`.`taken_by`,
                                `cdb_helpdesk`.`mainFileType` ,
				                (SELECT COUNT(*) FROM callcenterinquiry_creaditcard AS c1 WHERE c1.helpid = `cdb_helpdesk`.`helpid`) AS CALL_Count
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5050' AND
       `cdb_helpdesk`.`cat_code` = '1038' AND
       `cdb_helpdesk`.`ssb_app_number` = '' AND date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$user_group."' AND
       `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry_creaditcard AS c
											WHERE c.callstatus = 1)
       
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
      // echo $v_sql_det_detels;
       /*
         
       */
	//echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        if($rec_det_detels[22] > 1 ){     
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
                    //echo $col."<BR>";
                    echo "<tr style='color: ".$col.";'>";
                    
                    if($rec_det_detels[17] <= 15){
                        echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    }else{
                        echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    }
                    echo "<td style='width:200px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
                    echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
                    echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
                    echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
                    echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
                    echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
                    echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
                    echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
                    echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 5px;'>".$rec_det_detels[22]."</span></td>";
                    echo "<td style='width:250px;'>";
                      
                            $sql_btn1 = "SELECT COUNT(*) 
                                           FROM credit_card_call_dtl AS cq 
                                          WHERE cq.helpid = '".$rec_det_detels[0]."' ;";
                            //echo $sql_btn1."<br/>";
                            $query_btn1 = mysqli_query($conn,$sql_btn1) or die(mysqli_error($conn));
                            while ($rec_btn1 = mysqli_fetch_array($query_btn1)){
                                if($rec_btn1[0] == 0){
                                     echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                     echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                     //echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                }else{
                                    $a = "N";
                                    $b = "N";
                                    $c = "N";
                                    $z = 0;
                                    $sql_btn2 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 1 ;";
                                    //echo $sql_btn2."<br/>";
                                    $query_btn2 = mysqli_query($conn,$sql_btn2) or die(mysqli_error($conn));
                                    while($resalt_btn2 = mysqli_fetch_array($query_btn2)){
                                        //echo $resalt_btn2[0]." - ";
                                        if($resalt_btn2[0] != 0){
                                            $a = "Y";
                                        }
                                    }
                                    $sql_btn3 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 2 ;";
                                    //echo $sql_btn3."<br/>";
                                    $query_btn3 = mysqli_query($conn,$sql_btn3) or die(mysqli_error($conn));
                                    while($resalt_btn3 = mysqli_fetch_array($query_btn3)){
                                       //echo $resalt_btn3[0]." - ";
                                        if($resalt_btn3[0] != 0){
                                            $b = "Y";
                                        }
                                    }
                                    /*$sql_btn4 = "SELECT COUNT(cq.q_module_id) 
                                                   FROM credit_card_call_dtl AS cq 
                                                  WHERE cq.helpid = '".$rec_det_detels[0]."'
                                                     AND  cq.q_module_id = 3 ;";
                                    //echo $sql_btn4."<br/>";
                                    $query_btn4 = mysqli_query($conn,$sql_btn4) or die(mysqli_error($conn));
                                    while($resalt_btn4 = mysqli_fetch_array($query_btn4)){
                                        //echo $resalt_btn4[0]." - ";
                                        if($resalt_btn4[0] != 0){
                                            $c = "Y";
                                        }
                                    }*/
                                    //echo $a . " | " .$b . " | " . $c; 
                                    //if($a == "Y" && $b == "N" && $c == "N"){
                                    if($a == "Y" && $b == "N"){
                                            // echo "A";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    //}else if($a == "Y" && $b == "Y" && $c == "N"){
                                    }else if($a == "Y" && $b == "Y"){
                                          //  echo "B";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    }/*else if($a == "Y" && $b == "N" && $c == "Y"){
                                           // echo "C";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                             echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                                    }*/else{
                                        
                                    }
                                    
                                }
                            }
                            
                      // }
                    echo "</td>";
                    echo "</tr>";
        } // Een Count If in Call Statues.   
    }
    echo "</table>";
}


?>