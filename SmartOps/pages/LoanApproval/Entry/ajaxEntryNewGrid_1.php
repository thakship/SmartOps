<?php
    include('../../../php_con/includes/db.ini.php');
    //echo "ok";
    $v_sql_det_detelsCNT = "SELECT COUNT(1)  FROM `loan_cdb_helpdesk`, `urgency_states`, `priority_states`, `loan_product` , `branch`, `deparment`
 WHERE `loan_cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `loan_cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `loan_cdb_helpdesk`.`scat_code_2` = `loan_product`.`product_id` AND
       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `loan_cdb_helpdesk`.`cmb_code` = '5001' AND
       `loan_cdb_helpdesk`.`recommend_datetime` <> '0000-00-00 00:00:00'
       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
       
 
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:260px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:190px;text-align: left;"><span style="margin-left: 5px;">Req. Statas</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Recommend Date</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <td style="width:50px;"></td>
        </tr>
<?php
 $v_sql_det_detels = "SELECT `loan_cdb_helpdesk`.`helpid` , DATE(`loan_cdb_helpdesk`.`enterDateTime`), `loan_cdb_helpdesk`.`issue`,`loan_product`.`product_name`, `branch`.`branchName`, `deparment`.`deparmentName`, `loan_cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `loan_cdb_helpdesk`.`asing_by` , `loan_cdb_helpdesk`.`cat_code` , `loan_cdb_helpdesk`.`ssb_facility_amount` , `loan_cdb_helpdesk`.`ssb_type`,`loan_cdb_helpdesk`.`help_discr`,IF(`loan_cdb_helpdesk`.`ssb_app_number` = '', 4, `loan_cdb_helpdesk`.`IsAppValid`) as validapp,`loan_cdb_helpdesk`.`ssb_app_number`,`loan_cdb_helpdesk`.`facno`,datediff(date(now()),DATE(`loan_cdb_helpdesk`.`enterDateTime`)) as agedays,`loan_cdb_helpdesk`.`curr_stage`,`loan_cdb_helpdesk`.`assign_to`,`loan_cdb_helpdesk`.`taken_by` , DATE(`loan_cdb_helpdesk`.`recommend_datetime`)
 FROM `loan_cdb_helpdesk`, `urgency_states`, `priority_states`, `loan_product` , `branch`, `deparment`
 WHERE `loan_cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `loan_cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `loan_cdb_helpdesk`.`scat_code_2` = `loan_product`.`product_id` AND
       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `loan_cdb_helpdesk`.`cmb_code` = '5001' AND
       `loan_cdb_helpdesk`.`recommend_datetime` <> '0000-00-00 00:00:00'
       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
       $sql_count_note = "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
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
        echo "<tr style='color: ".$col.";'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[21]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
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