<?php
include('../../../php_con/includes/db.ini.php');
include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');

if($_REQUEST['userg_CRditCC'] && $_REQUEST['FKey']){
    //echo $_REQUEST['userg_CRditCC']."<br/>";
    //echo $_REQUEST['FKey'];


?>

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<tr style="background-color: #BEBABA; font-size: 11px; font-weight: bold;">
<td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Type</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Total</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Q1</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Q2</span></td></tr>
<?php 
	$vColTot = 0; $vColTotQ1 = 0; $vColTotQ2 = 0;
	$v_sql_headerInfo = "SELECT MIS.SSBTYPE,
									 SUM(MIS.NOS) AS NOS,
									 SUM(MIS.q1) AS q1,
									 SUM(MIS.q2) AS q2 FROM (
							SELECT if (`cdb_helpdesk`.ssb_type like 'Pending Notified%' , 'Pending Notified' , `cdb_helpdesk`.ssb_type) AS SSBTYPE, 
										1 AS NOS
									   ,IF(IFNULL((SELECT COUNT(*) FROM credit_card_call_dtl AS cq  WHERE cq.helpid = cdb_helpdesk.helpid AND  cq.q_module_id = 1),0) = 0 , 1 , 0) AS Q1
									   ,IF(IFNULL((SELECT COUNT(*) FROM credit_card_call_dtl AS cq  WHERE cq.helpid = cdb_helpdesk.helpid AND  cq.q_module_id = 1),0) > 0 , 1 , 0) AS Q2  
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
								   `cdb_help_user_oth`.`user_group` = '".$_REQUEST['userg_CRditCC']."' AND
								   `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid FROM callcenterinquiry_creaditcard AS c WHERE c.callstatus = 1)
								  
							) MIS GROUP BY MIS.SSBTYPE";
	   $v_Rs_headerInfo = mysqli_query($conn,$v_sql_headerInfo);
	   while($v_Rec_headerInfo = mysqli_fetch_array($v_Rs_headerInfo)){
		   echo "<tr>";
		   echo "<td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[0] ."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[1]."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[2] ."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[3] ."</span></td>";
		   echo "</tr>";
		   $vColTot = $vColTot + $v_Rec_headerInfo[1]; 
		   $vColTotQ1 = $vColTotQ1+ $v_Rec_headerInfo[2]; 
		   $vColTotQ2 = $vColTotQ2 + $v_Rec_headerInfo[3] ;
	   } 
	   echo "<tr>";
	   echo "<td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>"."T O T A L"."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTot."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTotQ1 ."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTotQ2 ."</span></td>";
	   echo "</tr>";
?>	
</table>;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
			<td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Last Activity Date</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:260px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:190px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">App</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Fac</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Count</span></td> 
            <td style="width:250px;"></td>
        </tr>
<?php
 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
							 `cdb_helpdesk`.`enterDateTime` as enterDateTime,
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
                              `cdb_helpdesk`.`mainFileType`,
                              (SELECT COUNT(*) FROM callcenterinquiry_creaditcard AS c WHERE c.callstatus = 0 AND c.call_answered = 'NO' AND c.helpid = `cdb_helpdesk`.`helpid`) AS COUNT_CALL ,
                              (select s.scat_discr_3 from scat_03 AS s WHERE s.cat_code = `cdb_helpdesk`.`cat_code` AND s.scat_code_1 = `cdb_helpdesk`.`scat_code_1` AND s.scat_code_2 = `cdb_helpdesk`.`scat_code_2` AND s.scat_code_3 = `cdb_helpdesk`.`scat_code_3`) AS scat3,
							  `cdb_helpdesk`.lastactivityon as lastactivityon
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
       `cdb_help_user_oth`.`user_group` = '".$_REQUEST['userg_CRditCC']."' AND
       `cdb_helpdesk`.`ssb_type` like '%Pending Notified%' AND
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
       /* if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }*/
        
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        $colP = "";
		//Call count more than 0 line colouring.......";
        if($rec_det_detels[22] != 0){
            $colP = "background-color: #ffffb3;";
        }
        //echo $col."<BR>";
        $colSCAT3 = "";
        if($rec_det_detels[23] == "CDB STAFF"){
             $colSCAT3 = "background-color: #e066ff;";
        }
        echo "<tr style='color: ".$col.";".$colP."'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";".$colSCAT3."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";".$colSCAT3."' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:200px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
		echo "<td style='width:200px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[24]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]." - ".$rec_det_detels[23]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
       /* echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15].chr(10).$rec_det_detels[18].chr(10).$rec_det_detels[19].chr(10).$rec_det_detels[20]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'>".str_pad($rec_det_detels[17], 2, '0', STR_PAD_LEFT)."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[22]."</span></td>";
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
    }
?>

</table>

<?php

}
?>