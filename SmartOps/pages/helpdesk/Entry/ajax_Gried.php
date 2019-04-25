<?php
session_start();
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        serviceRequsestMaual_Gried_POPUP_1();
}
if(isset($_REQUEST['srm_gried'])){
        serviceRequsestMaual_Manual_Gried_POPUP_2();
}

if(isset($_REQUEST['user_verificetion_gried'])){
    userVerificetionHelpdeskPassword();
}

if(isset($_REQUEST['isUserLog'])){
    getUserActiveGried($_REQUEST['isUserLog']);
}

if(isset($_REQUEST['setHelpId_Auth'])){
    auth_dtl_Service_Request($_REQUEST['setHelpId_Auth']);
}

function auth_dtl_Service_Request($HelpId){
    $conn = DatabaseConnection();
    //echo $_SESSION['user'];
    $conn = DatabaseConnection();
    $v_sql_getHelpdesk = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, DATE(`enterDateTime`) AS dd, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3`,`asing_by`,`ipAddress`,`defPassword` , `ssb_facility_amount` , `tentativeon` 
                                FROM `cdb_helpdesk` 
                                WHERE `helpid` = '".$HelpId."';";
    // echo $v_sql_getHelpdesk;
    $v_que_getHelpdesk = mysqli_query($conn,$v_sql_getHelpdesk);
    while($rec_getHelpdesk = mysqli_fetch_assoc($v_que_getHelpdesk)){
        $v_sel_catagory = getCat_Discreption($rec_getHelpdesk['cat_code'],$conn); // Get Cat Discreeption........
        $v_sel_scat01 = getScat_discr_1_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$conn); // Get Scat Descreption...........
        $v_sel_scat02 = getScat_discr_2_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$conn); // Get SCat Descrepion...........

        if($rec_getHelpdesk['scat_code_1'] == 102401){
            $sql_get_usernam = "SELECT u.userID FROM user AS u WHERE u.userName = '".$rec_getHelpdesk['scat_code_3']."';";
            $query_get_usernam = mysqli_query($conn,$sql_get_usernam);
            $rowcount = mysqli_num_rows($query_get_usernam);
            if($rowcount != 0){
                while($eee = mysqli_fetch_array($query_get_usernam)){
                    $v_sel_scat03 = $eee[0];
                }
            }else{
                $v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
            }


        }else{

            $v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
        }

        $v_getStates =  getStates($rec_getHelpdesk['cmb_code'],$conn); // Get Satates Description...............................
        $v_getUrCode = getUrgency_states($rec_getHelpdesk['ur_code'],$conn); // Get Urgency States Descreption...........................
        $v_getPrCode = getPriority_states($rec_getHelpdesk['pr_code'],$conn); // Get Uriority States Descreption................................
        $v_getSource = getSource_States($rec_getHelpdesk['s_type'],$conn); // GetSource Of Issue...............................................
        $v_getBranch = getBranchName($rec_getHelpdesk['inner_brCode'],$conn); // Get Branch Name..............................................
        $v_getDepartment = getDepartment($rec_getHelpdesk['inner_brCode'],$rec_getHelpdesk['inner_dept'],$conn); // Get Department
        $vgetInnerUser = getUserName($rec_getHelpdesk['inner_user'],$conn); // Get Inner Usre Name
        $v_getRnterUsre = getUserName($rec_getHelpdesk['enterBy'],$conn); // Get Enter Usre Name
        $vAsingUser = getUserName($rec_getHelpdesk['asing_by'],$conn); // Get Assign Usre Name
        $vEntryUserBranch = getEntryUserBranch($rec_getHelpdesk['entry_branch'],$conn); // Get Entry Usre Branch
        $v_getTentative = getTentative($rec_getHelpdesk['scat_code_2'],$conn); // get statas of Tantative ON.
        $v_sql_getUsreNAme = "SELECT `email`,`GSMNO` FROM `user` WHERE `userName` =  '".$rec_getHelpdesk['enterBy']."';";
        $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
        $userEmail = "";
        $userGSM = "";
        $DefaultPswd = $rec_getHelpdesk['defPassword'];

        while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
            $userEmail = $RES_getUsreNAme[0];
            $userGSM = $RES_getUsreNAme[1];
        }



        echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' style='background-color:#d1d1e0;' type='text' name='txt_help_ID' id='txt_help_ID' value='".$rec_getHelpdesk['helpid']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Entry Date :</label></td>
                        <td>
                            <input class='box_decaretion' style='background-color:#d1d1e0;'  type='text' name='txt_Entry_Date' id='txt_Entry_Date' value='".$rec_getHelpdesk['dd']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Entry Branch :</label></td>
                        <td>
                            <input class='box_decaretion' style='background-color:#d1d1e0; width : 250px;' type='text' name='txt_Entry_Branch' id='txt_Entry_Branch' value='".$vEntryUserBranch."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                    </tr>
                </table>";
        echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Category :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_catagory' id='sel_catagory' value='".$v_sel_catagory."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' /> 
                        </td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_scat01' id='sel_scat01' value='".$v_sel_scat01."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />                 
                        </td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_scat03' id='sel_scat03' value='".$v_sel_scat03."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:400px;' name='txt_issue' id='txt_issue' value='".$rec_getHelpdesk['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr></table>";
        if($rec_getHelpdesk['cat_code'] == "1024" && $rec_getHelpdesk['scat_code_1'] == "102401"){
            echo " <table><tr>
                            <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Facility Amount :</label></td>
                            <td>
                                <input class='box_decaretion' type='text'  style='width:200px;' name='txt_facAmount' id='txt_facAmount' value='".$rec_getHelpdesk['ssb_facility_amount']."' maxlength='20' onKeyPress='return isNumber(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/>
                            </td></table>";
        }
        // Added by Madushan on 10.20 AM 11/10/2018----
        if($rec_getHelpdesk['scat_code_2'] == 10210208){
            $SQL_INC_CARD = "SELECT  getBranchName(i.COLLECTING_BRANCH) AS COLLECTING_BRANCH, 
                                        	     getBranchName(i.HOME_BRANCH) AS HOME_BRANCH, 
                                        	     i.ACCOUNT_NO_1 ,
                                        	     i.MOTHER_MAIDEN_NAME,
                                        	     i.DEBIT_CARD_NUMBER ,
                                        	     i.NIC ,
                                        	     i.ADDRESS_1 ,
                                        	     i.ADDRESS_2 ,
                                        	     i.ADDRESS_3 ,
                                        	     i.ADDRESS_4 ,
                                        	     i.ADDRESS_5 ,
                                        	     i.CITY ,
                                        	     i.DOB ,
                                        	     i.GSM,
                                        	     i.WITHDRAWAL_LIMIT ,
                                        	     i.PURCHASING_LIMIT 
                                        FROM card_header_ins AS i
                                        WHERE i.help_ID = '".$HelpId."';";
            $QUERY_INC_CARD = mysqli_query($conn,$SQL_INC_CARD) or(die(mysqli_error($conn)));
            while($RESALT_INC_CARD = mysqli_fetch_array($QUERY_INC_CARD)){
                $COLLECTING_BRANCH = $RESALT_INC_CARD[0];
                $HOME_BRANCH = $RESALT_INC_CARD[1];
                $ACCOUNT_NO_1 = $RESALT_INC_CARD[2];
                $MOTHER_MAIDEN_NAME = $RESALT_INC_CARD[3];
                $DEBIT_CARD_NUMBER = $RESALT_INC_CARD[4];
                $NIC = $RESALT_INC_CARD[5];
                $ADDRESS_1 = $RESALT_INC_CARD[6];
                $ADDRESS_2 = $RESALT_INC_CARD[7];
                $ADDRESS_3 = $RESALT_INC_CARD[8];
                $ADDRESS_4 = $RESALT_INC_CARD[9];
                $ADDRESS_5 = $RESALT_INC_CARD[10];
                $CITY = $RESALT_INC_CARD[11];
                $DOB = $RESALT_INC_CARD[12];
                $GSM = $RESALT_INC_CARD[13];
                $WITHDRAWAL_LIMIT = $RESALT_INC_CARD[14];
                $PURCHASING_LIMIT = $RESALT_INC_CARD[15];

            }
            echo " <table><tr style='display: none;'>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop' >Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td></table>";
            echo " <br/><br/>
                                <table>
                                    <tr>
                                       <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                App. sending Branch :
                                            </label>
                                       </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$COLLECTING_BRANCH."</label>
                                        </td>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                Home branch :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$HOME_BRANCH."</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                Account Number :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$ACCOUNT_NO_1."</label>
                            
                                        </td>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                Card number : 
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$DEBIT_CARD_NUMBER."</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                Mother&apos;s Maiden name :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$MOTHER_MAIDEN_NAME."</label>
                                        </td>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                NIC :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$NIC."</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width: 200px; text-align: right;vertical-align: top;'>
                                            <label class='linetop' style='color: #990000;vertical-align: text-top;'>
                                                Address :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$ADDRESS_1." ".$ADDRESS_2. " <br/>".$ADDRESS_3."  ".$ADDRESS_4. " ".$ADDRESS_5."</label>
                                        </td>
                                        <td style='width: 200px; text-align: right;vertical-align: top;'>
                                            <label class='linetop' style='color: #990000;vertical-align: top;'>
                                                City :
                                            </label>
                                        </td>
                                        <td style='vertical-align: top;'>
                                            <label class='linetop' style='color: #990000;'>".$CITY."</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                Date of Birth : 
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$DOB."</label>
                                        </td>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                GSM Number :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$GSM."</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                WITHDRAWAL LIMIT :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$WITHDRAWAL_LIMIT."</label>
                                        </td>
                                        <td style='width: 200px; text-align: right;'>
                                            <label class='linetop' style='color: #990000;'>
                                                PURCHASING LIMIT :
                                            </label>
                                        </td>
                                        <td>
                                            <label class='linetop' style='color: #990000;'>".$PURCHASING_LIMIT."</label>
                                        </td>
                                    </tr>
                          </table><br/><br/>";
        }else{
            echo " <table><tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td></table>";
        }

        //Added by Rizvi on 2:30 PM 16/06/2016
        if ($rec_getHelpdesk['scat_code_2'] == '200115') echo "<div style='text-align: right;margin-right:200px;'><lable style='font-size: 24px;'>".($DefaultPswd=="1"?"":$DefaultPswd)."</lable></div>";
        echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>States :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='sel_States' id='sel_States' value='".$v_getStates."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='sel_Urgency' id='sel_Urgency' value='".$v_getUrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='sel_Priority' id='sel_Priority' value='".$v_getPrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Source of Iss. :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='sel_Source' id='sel_Source' value='".$v_getSource."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:600px;' name='txt_User' id='txt_User' value='".$rec_getHelpdesk['enterBy']." -- ".$v_getRnterUsre." - ".$userGSM." - ".$userEmail ." - ".$rec_getHelpdesk['ipAddress']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'><input class='box_decaretion' type='text' name='txt_UserGetMail' id='txt_UserGetMail' value='".$rec_getHelpdesk['enterBy']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Attachment :</label></td>
                        <td>";
        if($rec_getHelpdesk['attachment_name'] !=""){
            echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_name']."' target='_blank'>GET Attachment</a>";
        }else{

        }

        echo   "</td>
                    </tr>";

        $v_Sql_helpNote = "SELECT COUNT(*) FROM `pending_upload_file` WHERE `help_id` = '".$HelpId."';";

        //echo $v_Sql_helpNote;
        $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
        while($REC_helpNote = mysqli_fetch_array($que_helpNote)){
            if($REC_helpNote[0] > 0){
                echo "<tr><td s tyle='width: 100px; text-align: right;'><label class='linetop'>Additional Files:</label></td><td>";
                echo "<a title='".$gethelpID."' href='#' onclick='isAddiImgRequset(title)'>Additional Images</a>";
                echo   "</td></tr>";
            }
        }
        echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Assign User :</label></td>
                        <td>
                                <input class='box_decaretion' type='text' style='width:100px; color: #747474; background: #F2F2F2;' name='txt_inner_User1' id='txt_inner_User1' value='".$rec_getHelpdesk['asing_by']."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User ID' onclick='popup(1);'/> 
                                <input class='box_decaretion' type='text' style='width:500px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vAsingUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name' onclick='popup(1);'/>
                               
                        </td>
                    </tr>";

        if($v_getTentative == 1){
            $dis = "";
        }else{
            $dis = "display: none;";
        }

        if($rec_getHelpdesk['tentativeon'] != "0000-00-00"){
            $des = "disabled='disabled'";
        }else{
            $des = "";
        }
        echo "</table>";

        //$v_getTentative
        echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:200px;'>Notes</td>
                                    <td style='width:100px;'>Enterd User</td>
                                    <td style='width:200px;'>Enterd On</td>
                                </tr>";
        $v_Sql_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime` FROM `cdb_help_note` WHERE `helpid` = '".$HelpId."';";
        $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
        $index = 1;
        while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){
            echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px; text-align: right;'><input style='width:50px; text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$index."'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/></td>
                                            <td style='width: 200px; text-align: left;'><input style='width:200px;' type='text' name='txtb".$index."' id='txtb".$index."' value='".$REC_helpNote['note_discr']."'  onKeyPress='return disableEnterKey(event)' readonly='readonly' /></td>
                                            <td style='width: 100px; text-align: left;'><input style='width:100px;' type='text' name='txtUse".$index."' id='txtUse".$index."' value='".$REC_helpNote['enterBy']."'  onKeyPress='return disableEnterKey(event)' readonly='readonly' /></td>
                                            <td style='width: 150px; text-align: left;'><input style='width:150px;' type='text' name='txtOn".$index."' id='txtOn".$index."' value='".$REC_helpNote['enterDateTime']."'  onKeyPress='return disableEnterKey(event)' readonly='readonly' /></td>
                 </tr>";
            $index++;
        }
        echo "<tr>
                                <td style='width:50px;'><input style='width:50px; text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$index."'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/></td>
                                <td style='width:200px;'><input style='width:200px;' type='text' name='txtb".$index."' id='txtb".$index."' value=''  onKeyPress='return disableEnterKey(event)' /></td>
                                <td style='width: 100px;><input style='width:100px;' type='text' name='txtUse".$index."' id='txtUse".$index."' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' /></td>
                                <td style='width: 150px;><input style='width:150px;' type='text' name='txtOn".$index."' id='txtOn".$index."' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' /></td>
                            </tr>";
        echo "</table>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'></td>
                        <td></td>
                    </tr>
                </table> <div style='display: none;'>
           <input type='text' name='row_COUNT' id='row_COUNT' value='".$index."' onKeyPress='return disableEnterKey(event)'/> 
        </div>";
        echo "<br/><br/>
                <fieldset>
                    <legend><label class='linetop'>Intermediate Contact:</label></legend>
                    <table>
                        <tr>
                            <td style='width: 93px; text-align: right; vertical-align: top;'><label class='linetop'>Inter. Branch :</label><td>
                            <td>
                                <input class='box_decaretion' type='text'  style='width:200px;' name='txt_Branch' id='txt_Branch' value='".$v_getBranch."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            </td>
                            <td>
                                <input class='box_decaretion' type='text'  style='width:200px;' name='txt_Department' id='txt_Department' value='".$v_getDepartment."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td style='width: 93px; text-align: right; vertical-align: top;'><label class='linetop'>Inter. User :</label><td>   
                            <td>
                                <input class='box_decaretion' type='text'  style='width:600px;' name='txt_inner_User2' id='txt_inn' value='".$vgetInnerUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 93px; text-align: right; vertical-align: top;'><label class='linetop'>Inter. Remark :</label><td>   
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='4' style='height:50px; width: 400px;' name='inner_Remark' id='inner_Remark' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['inner_remark']."</textarea>
                            </td>
                        </tr>
                    </table>
                </fieldset><br/><br/><br/><br/><br/><br/>";

    }


}
//--------------------------------------------------------------------------------------------------------------------------------
function getUserActiveGried($isUserLog){
    $conn = DatabaseConnection();
    echo "<div id='outer1'></div>";
    echo "<div id='conten1'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='getUser(0);' /></div>";
    echo "<div style='width: 100%;'>";
    echo "<lable style='padding: 10px;'>Search by name :</lable> <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            $viewDoc = "SELECT `userName`,`userID` FROM `user` WHERE `userStat` = 'A' AND `branchNumber` = '". $_SESSION['userBranch']."' AND `deparmentNumber` = '".$_SESSION['userDepartment']."';";
							//echo  $viewDoc ;
							
                            $sql_viewDoc = mysqli_query($conn,$viewDoc);
                            echo "<table style='border-collapse: collapse;' border='1' rowspan='0' colspan='0'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:100px;'>User Number</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:220px;'>User Name</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:80px;'>Access</td>
                                      </tr>";
                            $a = 1 ;
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:100px;'>
                                          <input style='width:100px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                                    echo "<td style='width:220px;'>
                                          <input style='width:220px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:80px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);getUser(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div>";
   	echo "</div>";
}

function serviceRequsestMaual_Gried_POPUP_1(){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popup(0);' /></div>";
    echo "<div style='width: 100%;'>";
    echo "<lable style='padding: 10px;'>Search by name :</lable> <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            $viewDoc = "SELECT `userName`,`userID` FROM `user` WHERE `userStat` = 'A' AND `branchNumber` = '". $_SESSION['userBranch']."' AND `deparmentNumber` = '".$_SESSION['userDepartment']."';";
							//echo  $viewDoc ;
							
                            $sql_viewDoc = mysqli_query($conn,$viewDoc);
                            echo "<table style='border-collapse: collapse;' border='1' rowspan='0' colspan='0'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:100px;'>User Number</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:220px;'>User Name</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:80px;'>Access</td>
                                      </tr>";
                            $a = 1 ;
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:100px;'>
                                          <input style='width:100px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                                    echo "<td style='width:220px;'>
                                          <input style='width:220px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:80px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div></div>";
}

function serviceRequsestMaual_Manual_Gried_POPUP_2(){
    $conn = DatabaseConnection();
    echo "<div id='outersub'></div>";
    echo "<div id='contensub'>
            <div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popupsub(0);'/></div>
            <div style='width: 100%;'>
                Search User name : <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearchsub' id='popupsearchsub' value='' onKeyPress='return disableEnterKey(event)'/> 
                                    <input class='buttonManage' type='button' value='Search' id='popupSearchBTNsub' name='popupSearchBTNsub' onclick='fileSelectsub()' />
                <div style='display:none;'>
                    <input style='width:100px;' type='text' name='txsub' id='txsub' value=''  onKeyPress='return disableEnterKey(event)'/>
                    <input style='width:100px;' type='text' name='tysub' id='tysub' value=''  onKeyPress='return disableEnterKey(event)'/>
                </div>
        <br/>
        <br/>
        <div id='getNewtblPopupsub'>";
        $viewDocsub = "SELECT `user`.`userName`, `user`.`userID`, `user`.`branchNumber`, `branch`.`branchName`, `user`.`deparmentNumber`, `deparment`.`deparmentName`
                        FROM `user`, `branch`, `deparment` 
                        WHERE `user`.`branchNumber` = `branch`.`branchNumber` AND
                        	`user`.`deparmentNumber` = `deparment`.`deparmentNumber`";
        $sql_viewDocsub = mysqli_query($conn,$viewDocsub);
        echo "<table class='tbl1' border='1'>
              <tr>
                <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>User Number</td>
                <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>User Name</td>
                <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td>
              </tr>";
                    $a = 1 ;
                    while ($addsub = mysqli_fetch_array($sql_viewDocsub)){
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <input style='width:150px;' type='text' name='txt1sub".$a."' id='txt1sub".$a."' value='".$addsub[0]."' readonly='readonly'/></td>";
                        echo "<td style='width:200px;'>
                              <input style='width:200px;' type='text' name='txt2sub".$a."' id='txt2sub".$a."' value='".$addsub[1]."' readonly='readonly'/>
                              <div style='display:none;'>
                                <input style='width:200px;' type='text' name='txt3sub".$a."' id='txt3sub".$a."' value='".$addsub[2]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt4sub".$a."' id='txt4sub".$a."' value='".$addsub[3]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt5sub".$a."' id='txt5sub".$a."' value='".$addsub[4]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt6sub".$a."' id='txt6sub".$a."' value='".$addsub[5]."' readonly='readonly'/>
                              </div>
                              </td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' title='".$a."' onclick='selectDBsub(title);popupsub(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
			echo "</table></div></div></div>";
    
}

function userVerificetionHelpdeskPassword(){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popup(0);'/></div>";
    echo "<div style='width: 100%;'>";
    echo "Search Request : <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            echo "<table class='tbl1' border='1' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>Help ID</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:400px;'>Request</td>
                                      </tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'>&nbsp;</td>";
                                    echo "<td style='width:200px;'>&nbsp;</td>";
                                    echo "</tr>";
               echo "</table></div></div></div>";
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
function getStates($cmdCode,$conn){
    $v_sql_States = "SELECT `cmb_discr` FROM `cmb_states` WHERE `cmb_code` = '$cmdCode';";
    $que_getStates = mysqli_query($conn,$v_sql_States);
    while($RES_getStates = mysqli_fetch_array($que_getStates)){
        return $RES_getStates[0];
    }
}
function getUrgency_states($ur_state,$conn){
    $v_sql_Urgency = "SELECT `ur_discr` FROM `urgency_states` WHERE `ur_code` = '".$ur_state."';";
    $que_getUrgency = mysqli_query($conn,$v_sql_Urgency);
    while($RES_getUrgency = mysqli_fetch_array($que_getUrgency)){
        return $RES_getUrgency[0];
    }
}
function getPriority_states($pr_code,$conn){
    $v_sql_Priority = "SELECT `pr_discr` FROM `priority_states` WHERE `pr_code` = '".$pr_code."';";
    $que_getPriority = mysqli_query($conn,$v_sql_Priority);
    while($RES_getPriority = mysqli_fetch_array($que_getPriority)){
        return $RES_getPriority[0];
    }
}
function  getSource_States($s_ID,$conn){
    $v_sql_Source = "SELECT `s_descript` FROM `cdb_soarce_of_issue` WHERE `s_type` = '".$s_ID."';";
    $que_getSource = mysqli_query($conn,$v_sql_Source);
    while($RES_getSource = mysqli_fetch_array($que_getSource)){
        return $RES_getSource[0];
    }
}
function getBranchName($getBranchID,$conn){
    $v_sql_getBranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$getBranchID."';";
    $que_getBranch = mysqli_query($conn,$v_sql_getBranch);
    while($RES_getBranch = mysqli_fetch_array($que_getBranch)){
        return $RES_getBranch[0];
    }
}
function getDepartment($getBranchID,$getDepartmnet,$conn){
    $v_sql_getDepartment = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber` = '".$getDepartmnet."' AND `branchNumber` = '".$getBranchID."';";
    $que_getDepartment = mysqli_query($conn,$v_sql_getDepartment);
    while($RES_getDepartment = mysqli_fetch_array($que_getDepartment)){
        return $RES_getDepartment[0];
    }
}
function getUserName($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0];
    }
}

function getEntryUserBranch($entry_branch,$conn){
    $v_sql_getUsreBranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$entry_branch."';";
    $que_getUsreBranch = mysqli_query($conn,$v_sql_getUsreBranch);
    while($RES_getUsreBranch = mysqli_fetch_array($que_getUsreBranch)){
        return $RES_getUsreBranch[0];
    }
}
function getTentative($scat_code_2,$conn){
    $sql = "SELECT s.isTentative FROM scat_02 AS s WHERE s.scat_code_2 = '".$scat_code_2."';";
    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    while($rec = mysqli_fetch_array($query)){
        return $rec[0];
    }
}
?>