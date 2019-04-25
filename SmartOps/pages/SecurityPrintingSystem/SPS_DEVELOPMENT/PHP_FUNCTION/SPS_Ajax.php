<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['sgp_sps_let_types_01'])){
    isGetGriedDefineSignatoryGroups(trim($_REQUEST['sgp_sps_let_types_01']));
}

if(isset($_REQUEST['spe_e_aj_let_type1'])){
    isGetDropdwon_Signatory_Group1(trim($_REQUEST['spe_e_aj_let_type1']));
}
if(isset($_REQUEST['spe_e_aj_let_type'])){
    isGetDropdwon_Signatory_Group(trim($_REQUEST['spe_e_aj_let_type']));
}

if(isset($_REQUEST['sps_e_let_types_01']) && isset($_REQUEST['sqs_e_Signatory_Group_02'])){
    isgetGriedTable_Define_Signatory_Groups_Users(trim( $_REQUEST['sps_e_let_types_01']),trim($_REQUEST['sqs_e_Signatory_Group_02']));
}
if(isset($_REQUEST['asg_e_aj_let'])){
   isGetGriedAssignSignatoryGroups(trim($_REQUEST['asg_e_aj_let']));
}
if(isset($_REQUEST['var_lgppp_val_sel'])){
    isgetletter_Generation_selecter(trim($_REQUEST['var_lgppp_val_sel']));
}

if(isset($_REQUEST['getFacilityNumber'])){
    //echo trim($_REQUEST['getFacilityNumber']);
    getFacilityName(trim($_REQUEST['getFacilityNumber']));
}

if(isset($_POST['getAccountNoCBL05']) && isset($_POST['getEnrtyUserCBL05'])){
  //  echo trim($_REQUEST['getAccountNoCBL05']);
  //  echo trim($_REQUEST['getEnrtyUserCBL05']);
     getCBL05AccountDetails(trim($_POST['getAccountNoCBL05']),trim($_POST['getEnrtyUserCBL05']));
    
   
}

function isGetGriedDefineSignatoryGroups($letType){
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Sig. Group Code</span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>Sig. Group Name</span></td>
        </tr>";
    $sql_select = "SELECT `SIG_GRPCODE`, `SIG_GRPNAME` FROM `sps_sig_groups` WHERE `TYPE_CODE` = '".$letType."';";
    $q_Select = mysqli_query($conn,$sql_select)  or die(mysqli_error());
    $r = 0;
    while($RES_Select = mysqli_fetch_array($q_Select)){
        $r++;
        echo "<tr style='background-color: #FFFFFF;' title='".$r."' onclick='isGetRecordGried(title);'>
            <td style='width:100px; text-align: left;'><input type='text' maxlength='3' style='width:100px;' name='txta".$r."' id='txta".$r."' value='".$RES_Select[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></td>
            <td style='width:500px; text-align: left;'><input type='text' maxlength='3' style='width:500px;' name='txtb".$r."' id='txtb".$r."' value='".$RES_Select[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></td>
        </tr>";
        
    }
    
        
    echo "</table>";
}

function isgetGriedTable_Define_Signatory_Groups_Users($sps_e_let_types_01,$sqs_e_Signatory_Group_02){
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>User ID</span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
        </tr>";
    $sql_select = "SELECT `sps_sig_groups_users`.`USER_ID` , `user`.`userID`
                    FROM `sps_sig_groups_users` , `user`
                    WHERE `sps_sig_groups_users`.`USER_ID` = `user`.`userName` AND
                          `sps_sig_groups_users`.`TYPE_CODE` = '".$sps_e_let_types_01."' AND
                          `sps_sig_groups_users`.`SIG_GRPCODE` = '".$sqs_e_Signatory_Group_02."';";
    $q_Select = mysqli_query($conn,$sql_select)  or die(mysqli_error());
    $r = 0;
    while($RES_Select = mysqli_fetch_array($q_Select)){
        $r++;
        echo "<tr id='tr".$r."' title='".$r."' onclick='isGetRecordGried(title);' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[0]."</span><span style='display: none;'><input type='text' maxlength='3' style='width:100px;' name='txta".$r."' id='txta".$r."' value='".$RES_Select[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[1]."</span><span style='display: none;'><input type='text' maxlength='3' style='width:500px;' name='txtb".$r."' id='txtb".$r."' value='".$RES_Select[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        </tr>";
        
    }
    
        
    echo "</table>";
}

function isGetDropdwon_Signatory_Group($let_type){
    $conn = DatabaseConnection();
    $sql_sps_sig_groups = "SELECT `SIG_GRPCODE` , `SIG_GRPNAME` FROM `sps_sig_groups` WHERE `TYPE_CODE` = '".$let_type."';";
    $quary_sps_sig_groups = mysqli_query($conn,$sql_sps_sig_groups);
    echo "<select class='box_decaretion' name='sel_sug_Signatory_Group' id='sel_sug_Signatory_Group' onkeyup='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                    <option value=''>--Select Signatory Group--</option>";
    while ($rec_sps_sig_groups = mysqli_fetch_array($quary_sps_sig_groups)) {
                    echo "<option value='".$rec_sps_sig_groups[0]."'>".$rec_sps_sig_groups[1]."</option>";
    }
    echo "</select>";
}

function isGetDropdwon_Signatory_Group1($let_type){
    $conn = DatabaseConnection();
    $sql_sps_sig_groups = "SELECT `SIG_GRPCODE` , `SIG_GRPNAME` FROM `sps_sig_groups` WHERE `TYPE_CODE` = '".$let_type."';";
    $quary_sps_sig_groups = mysqli_query($conn,$sql_sps_sig_groups);
    echo "<select class='box_decaretion' name='sel_sug_Signatory_Group' id='sel_sug_Signatory_Group' onkeyup='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='getGriedTable();'>
                    <option value=''>--Select Signatory Group--</option>";
    while ($rec_sps_sig_groups = mysqli_fetch_array($quary_sps_sig_groups)) {
                    echo "<option value='".$rec_sps_sig_groups[0]."'>".$rec_sps_sig_groups[1]."</option>";
    }
    echo "</select>";
}

function  isGetGriedAssignSignatoryGroups($letterType){
     $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	        <tr style='background-color: #BEBABA;'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Slab Serial</span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount From</span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount To</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Signatory Group</span></td>
            </tr>";
    $sql_select = "SELECT spl.`SLAB_SER`, 
                          spl.`AMT_FROM`, 
                          spl.`AMT_TO`,
                          spg.`SIG_GRPNAME`,
                          spl.`SIG_GRPCODE`
                    FROM  `sps_let_amt_slabs` spl ,`sps_sig_groups` spg
                    WHERE spl.`SIG_GRPCODE` = spg.`SIG_GRPCODE` 
                      AND spl.`TYPE_CODE` = spg.`TYPE_CODE`
                      AND spl.`TYPE_CODE` = '".$letterType."'
                    ORDER BY spl.`SLAB_SER`;";
    //echo $sql_select;
    $q_Select = mysqli_query($conn,$sql_select)  or die(mysqli_error());
    $r = 0;
    while($RES_Select = mysqli_fetch_array($q_Select)){
        $r++;
        echo "<tr id='tr".$r."' title='".$r."' onclick='isGetRecordGried(title);' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[0]."</span><span style='display: none;'><input type='text' name='txta".$r."' id='txta".$r."' value='".$RES_Select[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[1]."</span><span style='display: none;'><input type='text' name='txtb".$r."' id='txtb".$r."' value='".$RES_Select[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[2]."</span><span style='display: none;'><input type='text' name='txtc".$r."' id='txtc".$r."' value='".$RES_Select[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_Select[3]."</span><span style='display: none;'><input type='text' name='txte".$r."' id='txte".$r."' value='".$RES_Select[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        </tr>";
        
    }
    
        
    echo "</table>";
}

function isgetletter_Generation_selecter($var_lgppp_val_sel){
    $conn = DatabaseConnection();
    $sql_select = "SELECT slb.`GEN_BY`, us.`userID`, DATE(slb.`GEN_DATE`) , DATE(slb.`MAT_DATE`)
                    FROM `sps_let_batch` AS slb, `user` AS us
                    WHERE slb.`GEN_BY` = us.`userName` AND
                          slb.`LET_TYPE` = 'RLET' AND
                          slb.`MAT_DATE` = (SELECT MAX(`MAT_DATE`) FROM `sps_let_batch` WHERE `LET_TYPE` = '".$var_lgppp_val_sel."' );";
    $que_select = mysqli_query($conn, $sql_select) or die(mysqli_error());
    while($res_select = mysqli_fetch_array($que_select)){
        echo "Last generated on ".$res_select[2]." by ".$res_select[1]." for ".$res_select[3];
        if( $res_select[2] != ""){
           $date1 = str_replace('-', '/', $res_select[3]);
           $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days")); 
        }
        echo "<div style='display: none;'><input type='text' name='getDDD' id='getDDD' value='".$tomorrow."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></div>";
        
    }
}

function  getFacilityName($facilityNumber){
    $conn = DatabaseConnection();
    $sql_select = "SELECT sp.fac_no , sp.client_name
                     FROM sps_po_gen AS sp 
                    WHERE sp.fac_no = '".$facilityNumber."' AND sp.print_stats = 2;";
    $que_select = mysqli_query($conn, $sql_select) or die(mysqli_error());
    while($res_select = mysqli_fetch_array($que_select)){
        echo $res_select[1];
    }
    
}

function  getCBL05AccountDetails($facilityNumber,$logUser){
    $conn = DatabaseConnection();
    echo $facilityNumber . " - ".$logUser; // get facility number and log user
    
}




?>