<?php
include('../../../php_con/includes/db.ini.php'); // DB Connection ....
if(isset($_REQUEST['getCatagorySetletment'])){
    //echo $_REQUEST['txt1']." - ".$_REQUEST['txt2'];
    getDropSecurityReqList($_REQUEST['getCatagorySetletment']);
}

if(isset($_REQUEST['cat1']) && isset($_REQUEST['scat1']) && isset($_REQUEST['getUSERgROUP']) && isset($_REQUEST['getUSERBRANCHNAME']) && isset($_REQUEST['userID'])){
    //echo $_REQUEST['cat1']." -- ".$_REQUEST['scat1'];
    getGriedLOad($conn,$_REQUEST['cat1'],$_REQUEST['scat1'],$_REQUEST['getUSERgROUP'],$_REQUEST['getUSERBRANCHNAME'],$_REQUEST['userID']);
}

function getDropSecurityReqList($getCatagorySetletment){
    echo "<select class='box_decaretion'  style='width: 200px;' name='sel_scat01' id='sel_scat01' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
    echo "<option value=''>--Select Sub Catagory 1--</option>";
    if($getCatagorySetletment == 1){
        echo "<option value='10290112'>CR Request (Settlement)</option>";
        echo "<option value='10290116'>Mortgage Loan Document Request</option>";
        echo "<option value='10290130'>CR Collecting Branch Change</option>";
        
    }else if ($getCatagorySetletment == 2){
        echo "<option value='10290101'>CR Request (Lease_Transfer)</option>";
        echo "<option value='10290110'>CR Request (RMV_Correction)</option>";
        echo "<option value='10290113'>CR Request (Yard_Release)</option>";
        echo "<option value='10290114'>CR Request (Court_Case)</option>";
        echo "<option value='10290123'>CR Request (One Day Payment)</option>";
        echo "<option value='10290125'>CR Request (Invoice_Settlement)</option>";
        echo "<option value='10290126'>CR Request (12(iv) Transfer)</option>";
        
        
    }else if ($getCatagorySetletment == 3){
        echo "<option value='10290117'>CR to be Collected (RMV_Correction)</option>";
        echo "<option value='10290119'>CR to be Collected (Lease_Transfer)</option>";
        echo "<option value='10290122'>CR to be Collected (Court_Case)</option>";
        echo "<option value='10290124'>CR to be Collected (One Day Payment)</option>";
        echo "<option value='10290127'>CR to be Collected (12(iv) Transfer)</option>";
        
       
   }else if ($getCatagorySetletment == 4){
        echo "<option value='10290105'>Facility to be closed (Lease_Transfer)</option>";
        echo "<option value='10290128'>Facility to be closed (Lease_Transfer)-Reopen</option>";
        echo "<option value='10290129'>Facility to be closed (One Day Payment)-Reopen</option>";
       
   }else if ($getCatagorySetletment == 5){
        echo "<option value='10290118'>CR to be RMV Lodge (One Day Payment)</option>";
        
       
   }else{
    
   }
    echo "</select>";
}

function getGriedLOad($conn,$cat1,$scat1,$getUSERgROUP,$getUSERBRANCHNAME,$userID){
    $v_sql_det_detelsCNT = "SELECT COUNT(1) FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`,`scat_01`,`cat_states` 
        WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cat_code` = `cat_states`.`cat_code` AND
       `scat_01`.`cat_code` = `cdb_helpdesk`.`cat_code` AND
       `scat_01`.`scat_code_1` = `cdb_helpdesk`.`scat_code_1` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1029' AND
       `cdb_helpdesk`.`scat_code_2` = '".$scat1."' AND
       `cdb_help_user_oth`.`user_group` = '".$getUSERgROUP."' AND
       `scat_01`.`scat_discr_1` like  IF(`cat_states`.`isBrachRelated` = 1 , '".$getUSERBRANCHNAME."' , '%')
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
   //echo $v_sql_det_detelsCNT;
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	   echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }
    
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>Issue</span></td>
                <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>States</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Branch</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Department</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Urgency</span></td>
                <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>Priority</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
                <td style='width:50px;'></td>
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
                                `cdb_helpdesk`.scat_code_2 , 
                                `cdb_helpdesk`.Linked_helpid ,
                                `cdb_helpdesk`.scat_code_1 
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`,`scat_01`,`cat_states` 
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cat_code` = `cat_states`.`cat_code` AND
       `scat_01`.`cat_code` = `cdb_helpdesk`.`cat_code` AND
       `scat_01`.`scat_code_1` = `cdb_helpdesk`.`scat_code_1` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_helpdesk`.`cat_code` = '1029' AND
        `cdb_helpdesk`.`scat_code_2` = '".$scat1."' AND
       `cdb_help_user_oth`.`user_group` = '".$getUSERgROUP."' AND
       `scat_01`.`scat_discr_1` like  IF(`cat_states`.`isBrachRelated` = 1 , '".$getUSERBRANCHNAME."' , '%')
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
       $sql_count_note = "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
          $v_que_count_note = mysqli_query($conn,$sql_count_note);
          while($rec_count_note =  mysqli_fetch_array($v_que_count_note)){
                $f_Col = "#000000";
                if($rec_count_note[0] != 0){
                    $f_Col = "#01DF3A";
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
        if ($userID == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        if ($rec_det_detels[13] == 2005){
           $MyRow = "background-color:#b3ffb3;";
        }
        
         if ($rec_det_detels[13] == 103101 && $rec_det_detels[9] == $userID){
           $MyRow = "background-color:#ff8080;";
         }
        //------------------------------ 2017-01-26 - Madushan - color for the time pass issuer-------------------------------------------------------------------------------
        $sql_timePass = "SELECT s1.SLA_TYPE , s1.SAL FROM scat_02 AS s1  WHERE s1.scat_code_2 = '".$rec_det_detels[11]."';";
        $query_timePass = mysqli_query($conn,$sql_timePass) or die(mysqli_error($conn));
        while($resalt_timePass = mysqli_fetch_array($query_timePass)){
            if($resalt_timePass[0] == "DAY"){
               $datetime1 = date_create(date("Y-m-d",strtotime($rec_det_detels[1])));
               $datetime2 = date_create(date("Y-m-d"));
               $interval = date_diff($datetime1, $datetime2);
               $diferantDate = $interval->format('%a days');
               
               if($resalt_timePass[1] != 0 && $diferantDate >= $resalt_timePass[1]){
                   $bgcol = "background-color:#FDBDCF";
                   //$numberDiff = $resalt_timePass[1];
               }else{
                    $bgcol = "";
                    //$numberDiff = $resalt_timePass[1];
               }
                
                
            }else if($resalt_timePass[0] == "HOURS"){
                //$col = '#C70039';
            }else if($resalt_timePass[0] == "MINUTES"){
                //$col = '#C70039';
            }else{
                $bgcol = "";
            }
        }
        
        if($rec_det_detels[11] == 10280119 || $rec_det_detels[11] == 10280120 || $rec_det_detels[11] == 10290128  || $rec_det_detels[11] == 10290129){
            $bglink = "background-color:#bf80ff";
        }else{
            $bglink = "";
        }
        
        
        //---------------------------------------------------------------------------------------------------------------------------------------------
        echo "<tr style='color: ".$col.";' onclick='myFunction(this)'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";".$bgcol.";' onclick='columFunction(this)'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow .";".$bglink.";' onclick='columFunction(this)'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:300px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[5]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."' onclick='columFunction(this)'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;' onclick='columFunction(this)'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;' onclick='columFunction(this)'>".$rec_det_detels[8]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."' title = '".$asingBy."' onclick='columFunction(this)'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getUserNameGenaral_Mob_Eml($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID`,`email`,`GSMNO` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0]."&#013;".$RES_getUsreNAme[1]."&#013;".$RES_getUsreNAme[2];
    }
}
?>