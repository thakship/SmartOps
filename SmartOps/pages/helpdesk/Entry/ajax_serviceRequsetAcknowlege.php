<?php
include('../../../php_con/includes/db.ini.php'); // DB Connection 
if(isset($_REQUEST['getSRReoptDate1']) && isset($_REQUEST['getSRReoptDate2']) && isset($_REQUEST['getcat_m']) && isset($_REQUEST['getcat1']) && isset($_REQUEST['getcat2']) && isset($_REQUEST['getcat3']) && isset($_REQUEST['getAsingUer']) && isset($_REQUEST['isgetUserBranch']) && isset($_REQUEST['isgetUserDepartment'])){
  //echo $_REQUEST['getSRReoptDate1']."--".$_REQUEST['getSRReoptDate2']."--".$_REQUEST['getcat_m']."--".$_REQUEST['getcat1']."--".$_REQUEST['getcat2']."--".$_REQUEST['getcat3']."--".$_REQUEST['getAsingUer']; "&="+getUserBranch+"&="+getUserDepartment
    getServiceRequsetAcknowlege($conn,$_REQUEST['getSRReoptDate1'],$_REQUEST['getSRReoptDate2'],$_REQUEST['getcat_m'],$_REQUEST['getcat1'],$_REQUEST['getcat2'],$_REQUEST['getcat3'],$_REQUEST['getAsingUer'],$_REQUEST['isgetUserBranch'],$_REQUEST['isgetUserDepartment']);
}

function getServiceRequsetAcknowlege($conn,$FomDate,$ToDate,$cat,$cat1,$cat2,$cat3,$AsingUer,$userBranch,$userDepartment){
     $v_sql_select = "SELECT `cdb_helpdesk`.`helpid`, 
                           `cdb_helpdesk`.`issue`,  
                           DATE(`cdb_helpdesk`.`enterDateTime`) AS enDate,  
                           `cdb_helpdesk`.`solved_by`, 
                           DATE(`cdb_helpdesk`.`solved_on`) AS svDate , 
                           `cdb_helpdesk`.`entry_branch` AS entry_branch  , 
                           `cdb_helpdesk`.`enterBy` AS enterBy , 
                            `scat_02`.scat_discr_2 AS sca
                      FROM `cdb_helpdesk` ,scat_02
                      WHERE  `cdb_helpdesk`.scat_code_2 = scat_02.scat_code_2 AND
                           `cdb_helpdesk`.`cmb_code` = '5002' AND 
                               `cdb_helpdesk`.`cat_code` != '1014' AND 
                              `cdb_helpdesk`.`entry_branch` = '".$userBranch."' AND 
                              `cdb_helpdesk`.`entry_department` = '".$userDepartment."'";
     if($FomDate != "" && $ToDate == ""){
        $v_sql_select .= "AND DATE(`cdb_helpdesk`.solved_on) = '".$FomDate."'";
     }else if($FomDate == "" && $ToDate != ""){
        $v_sql_select .= "AND DATE(`cdb_helpdesk`.solved_on) = '".$ToDate."'";
     }else if($FomDate != "" && $ToDate != ""){
        $v_sql_select .= "AND DATE(`cdb_helpdesk`.solved_on) BETWEEN '".$FomDate."' AND '".$ToDate."'";
     }else{
        
     }
     
     if($cat != ""){
        $v_sql_select .= "AND `cdb_helpdesk`.cat_code = '".$cat."'";
     }
     if($cat1 != ""){
        $v_sql_select .= "AND `cdb_helpdesk`.scat_code_1 = '".$cat1."'";
     }
     if($cat2 != ""){
        $v_sql_select .= "AND `cdb_helpdesk`.scat_code_2 = '".$cat2."'";
     }
     if($cat3 != ""){
        $v_sql_select .= "AND `cdb_helpdesk`.scat_code_3 = '".$cat3."'";
     }
      if($AsingUer != ""){
        $v_sql_select .= "AND `cdb_helpdesk`.enterBy = '".$AsingUer."'";
     }
                       
                              
    $v_sql_select .= ";";
     //echo $v_sql_select;
     echo "<table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:60px;'><span style='margin-right: 5px;'>Help ID</span></td>
                 <td style='width:250px;'><span  style='margin-left: 5px;'>Issue</span></td>
                 <td style='width:150px;'><span  style='margin-left: 5px;'>Sub Cat 2</span></td>
                 <td style='width:80px;'><span style='margin-right: 5px;'>Entry by</span></td>
                <td style='width:80px;'><span style='margin-right: 5px;'>Entry Date</span></td>
                 <td style='width:80px;'><span style='margin-right: 5px;'>Solved Date</span></td>
                <td style='width:80px;'><span style='margin-right: 5px;'>Solved by</span></td>
                <td style='width:150px;'><span style='margin-right: 5px;'>Remark</span></td>
                <td style='width:60px;'></td>
                <td style='width:200px;'></td>
            </tr>";
      $v_que_select = mysqli_query($conn,$v_sql_select);
    $index = 0;
    
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        $getuserName = "";
        if($index%2 == 1){
            $col = "#FFFFFF";
        }else{
             $col = "#FFFFFF";
        }
        $sql_userName = "SELECT `userID` FROM `user` WHERE `userName` = '".$res_Select['solved_by']."';";
        $que_userName = mysqli_query($conn,$sql_userName);
        while($RSE_userName = mysqli_fetch_assoc($que_userName)){
            $getuserName = $RSE_userName['userID'];
        }
        $sql_userName1 = "SELECT `userID` FROM `user` WHERE `userName` = '".$res_Select['enterBy']."';";
        $que_userName1 = mysqli_query($conn,$sql_userName1);
        while($RSE_userName1 = mysqli_fetch_assoc($que_userName1)){
            $getuserName1 = $RSE_userName1['userID'];
        }
        echo "<tr style='background-color: ".$col.";'>";
        echo "<td style='width:60px; text-align: right;'><div style='display: none;'><input type='text' name='txtclose".$index."' id='txtclose".$index."' value='".$res_Select['helpid']."'  onKeyPress='return disableEnterKey(event)'/></div><span  style='margin-right: 5px;'>".$res_Select['helpid']."</span></td>";
        echo "<td style='width:250px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['issue']."</span></td>";
       echo "<td style='width:250px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['sca']."</span></td>";
        echo "<td style='width:80px; text-align: left;' title='".$getuserName1."'><span id='span_id' style='margin-left: 5px;'>".$res_Select['enterBy']."</span></td>";
        echo "<td style='width:80px; text-align: right;'><span  style='margin-right: 5px;'>".$res_Select['enDate']."</span></td>";
        echo "<td style='width:80px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['svDate']."</span></td>";
        echo "<td style='width:80px; text-align: left;' title='".$getuserName."'><span id='span_id' style='margin-left: 5px;'>".$res_Select['solved_by']."</span></td>";
        echo "<td style='width:250px; text-align: left;'><input type='text' style='width:250px;' name='txtremark".$index."' id='txtremark".$index."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
         echo "<td style='width:60px;'>
                    <select class='box_decaretion'  style='width: 50px;' name='sel_atc".$index."' id='sel_atc".$index."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                    <option value='0'>0</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
             </select>
                </td>";
        echo "<td style='width:200px;'>
                <input type='button' class='buttonManage' id='btn_ReOpen' name='btn_ReOpen' value='Re-open' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isReOpen(title);'/>
                <input type='button' class='buttonManage' id='btn_Atc' name='btn_Atc' value='Submit' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isSubmitAct(title);'/>
            </td>";
        echo "</tr>";
    }
    echo "</table>";
}




?>