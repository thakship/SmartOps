<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}


if(isset($_REQUEST['txt_Root_Help_ID'])){
    isgetRootTable($_REQUEST['txt_Root_Help_ID']);
}

function isgetRootTable($getHelpID){
    $conn = DatabaseConnection();
    $sql_root = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `scat_code_3`, `issue`, `enterBy`, `entry_branch`, `entry_department`, `ipAddress`
                    FROM `cdb_helpdesk` 
                    WHERE `helpid`= '".$getHelpID."' AND `cmb_code` = '5001';";
    $que_root = mysqli_query($conn,$sql_root);
    if(mysqli_num_rows($que_root) != 0){
        while($res_root = mysqli_fetch_assoc($que_root)){
            
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Category :</label></td>
                        <td style='width: 200px; text-align: left;'><input style='width: 200px;' class='box_decaretion' type='text' name='txt_cat' id='txt_cat' value='".getCat_Discreption($res_root['cat_code'],$conn)."' onKeyPress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/></td>
                        <td style='width: 200px; text-align: left;'><input style='width: 200px;' class='box_decaretion' type='text' name='txt_cat_01' id='txt_cat_01' value='".getScat_discr_1_Descreption($res_root['cat_code'],$res_root['scat_code_1'],$conn)."' onKeyPress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/></td>
                        <td style='width: 200px; text-align: left;'><input style='width: 200px;' class='box_decaretion' type='text' name='txt_cat_02' id='txt_cat_02' value='".getScat_discr_2_Descreption($res_root['cat_code'],$res_root['scat_code_1'],$res_root['scat_code_2'],$conn)."' onKeyPress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/></td>
                        <td style='width: 200px; text-align: left;'><input style='width: 200px;' class='box_decaretion' type='text' name='txt_cat_03' id='txt_cat_03' value='".getScat_discr_3_Descreption($res_root['cat_code'],$res_root['scat_code_1'],$res_root['scat_code_2'],$res_root['scat_code_3'],$conn)."' onKeyPress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/></td>
                    <tr/>
                  <table/>";
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Sel. Category :</label></td>
                        <td>";
                $sql_cat_code = "SELECT `cat_code`, `cat_discr` FROM `cat_states`;";
                $que_cat_code = mysqli_query($conn,$sql_cat_code);
                echo "<select class='box_decaretion'  style='width: 200px;' name='sel_catagory' id='sel_catagory' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' title='1' onchange='is_getScat_01(this.id,title);'>
                <option value=''>--Select Catagory --</option>";
                while($res_cat_code = mysqli_fetch_assoc($que_cat_code)){
                    echo "<option value=".$res_cat_code['cat_code'].">".$res_cat_code['cat_discr']."</option>";
                }
                echo "</select>";
                echo "</td>
                        <td>
                            <div id='diva'>
                                <select class='box_decaretion' style='width: 200px;' name='sel_scat01' id='sel_scat01' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' disabled='disabled'>
                                    <option value=''>--Select Sub Catagory 1--</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id='divb'>
                                <select class='box_decaretion'  style='width: 200px;' name='sel_scat02' id='sel_scat02' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' disabled='disabled'>
                                    <option value=''>--Select Sub Catagory 2--</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div id='divz'>
                                 <select class='box_decaretion'  style='width: 200px;' name='sel_scat03' id='sel_scat03' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' disabled='disabled'>
                                    <option value=''>--Select Sub Catagory 3--</option>
                                 </select>
                            </div>
                        </td>
                      </tr>
                    </table><br/>";
                    
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'></td>
                        <td text-align: right;'>
                            <input type='submit' style='width: 100px;' class='buttonManage' id='btnSave' name='btnSave' value='Update'/>
                            <input type='button' style='width: 100px;' class='buttonManage' id='btnClose' name='btnClose' value='Close' onclick='pageClose()'/>
                        <td/>
                    <tr/>
                    <table/>";
                echo "<div style='display: none;'>
                        <input type='text' name='txt_get_helpid' id='txt_get_helpid' value='".$res_root['helpid']."' onKeyPress='return disableEnterKey(event)'/> 
                        <input type='text' name='txt_get_issue' id='txt_get_issue' value='".$res_root['issue']."' onKeyPress='return disableEnterKey(event)'/> 
                        <input type='text' name='txt_get_enterBy' id='txt_get_enterBy' value='".$res_root['enterBy']."' onKeyPress='return disableEnterKey(event)'/>
                        <input type='text' name='txt_get_enterdis' id='txt_get_enterdis' value='".user_name($res_root['enterBy'],$conn)."' onKeyPress='return disableEnterKey(event)'/>
                        <input type='text' name='txt_get_branch' id='txt_get_branch' value='".user_branch($res_root['entry_branch'],$conn)."' onKeyPress='return disableEnterKey(event)'/>
                        <input type='text' name='txt_get_department' id='txt_get_department' value='".user_department($res_root['entry_branch'],$res_root['entry_department'],$conn)."' onKeyPress='return disableEnterKey(event)'/>
                        <input type='text' name='txt_get_IP' id='txt_get_IP' value='".$res_root['ipAddress']."' onKeyPress='return disableEnterKey(event)'/>
                       <input type='text' name='txt_retun_cou' id='txt_retun_cou' value='1' onKeyPress='return disableEnterKey(event)'/> 
                      </div>";
        }
    }else{
        echo "<div style='display: none;'><input type='text' name='txt_retun_cou' id='txt_retun_cou' value='0' onKeyPress='return disableEnterKey(event)'/> </div>";
    }
}

function getCat_Discreption($catCode,$conn){
        $v_sql_getCategory = "SELECT `cat_discr` FROM `cat_states` WHERE `car_state` = '1' AND `cat_code` = '".$catCode."';";
        $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
        while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
            return $RES_getCategory[0];
        }
    }
    function getScat_discr_1_Descreption($catCode,$sCode1,$conn){
        $v_sql_getscat_code_1 = "SELECT `scat_discr_1` FROM `scat_01` WHERE `cat_code` = '".$catCode."' AND `scat_code_1` = '".$sCode1."';";
        $que_getscat_code_1 = mysqli_query($conn,$v_sql_getscat_code_1);
        while($RES_getscat_code_1 = mysqli_fetch_array($que_getscat_code_1)){
            return $RES_getscat_code_1[0];
        }
    }
    function getScat_discr_2_Descreption($catCode,$sCode1,$sCode2,$conn){
        $v_sql_getscat_code_2 = "SELECT `scat_discr_2` FROM `scat_02` WHERE `cat_code` = '".$catCode."' AND `scat_code_1` = '".$sCode1."' AND `scat_code_2` = '".$sCode2."';";
        $que_getscat_code_2 = mysqli_query($conn,$v_sql_getscat_code_2);
        while($RES_getscat_code_2 = mysqli_fetch_array($que_getscat_code_2)){
               return $RES_getscat_code_2[0];
        }
    }
    function getScat_discr_3_Descreption($catCode,$sCode1,$sCode2,$sCode3,$conn){
        
         $v_sql_getscat_code_3 = "SELECT `scat_discr_3` FROM `scat_03` WHERE `cat_code` = '".$catCode."' AND `scat_code_1` = '".$sCode1."' AND `scat_code_2` = '".$sCode2."' AND `scat_code_3` = '".$sCode3."';";
        $que_getscat_code_3 = mysqli_query($conn,$v_sql_getscat_code_3);
        while($RES_getscat_code_3 = mysqli_fetch_array($que_getscat_code_3)){
               return $RES_getscat_code_3[0];
        }
    }
    
    function user_name($userID, $conn){
        $sqli_select = "SELECT `userID` FROM `user` WHERE `userName`= '".$userID."';";
         $que_sel = mysqli_query($conn,$sqli_select);
        while($RES_sel= mysqli_fetch_array($que_sel)){
               return $RES_sel[0];
        }
    }
    
    function user_branch($userBr, $conn){
        $sqli_select = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$userBr."';";
         $que_sel = mysqli_query($conn,$sqli_select);
        while($RES_sel= mysqli_fetch_array($que_sel)){
               return $RES_sel[0];
        }
    }
    
    function user_department($userBr, $userDep, $conn){
        $sqli_select = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber` = '".$userDep."' AND  `branchNumber` = '".$userBr."';";
         $que_sel = mysqli_query($conn,$sqli_select);
        while($RES_sel= mysqli_fetch_array($que_sel)){
               return $RES_sel[0];
        }
    }
?>