<?php
session_start();
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
//.........................................get Helpdesk ID for Service Requset List............................................................................
 if(isset($_REQUEST['getHelpIDreq']) && isset($_REQUEST['gettxt_helpdesk_close']) && isset($_REQUEST['get_c_stats'])){
        getAjaxServiceRequsesList_helpID($_REQUEST['getHelpIDreq'],$_REQUEST['gettxt_helpdesk_close'],$_REQUEST['get_c_stats']);
        //echo $_REQUEST['getHelpIDreq'];
 }
 
 if(isset($_REQUEST['getHelpIDreqmybranch']) && isset($_REQUEST['gettxt_helpdesk_closemybranch']) && isset($_REQUEST['get_c_statsmybranch'])){
        getAjaxServiceRequsesList_mybranch($_REQUEST['getHelpIDreqmybranch'],$_REQUEST['gettxt_helpdesk_closemybranch'],$_REQUEST['get_c_statsmybranch']);
        //echo $_REQUEST['getHelpIDreq'];
 }
 
 
 if(isset($_REQUEST['getHelpIDreq1']) && isset($_REQUEST['gettxt_helpdesk_close1']) && isset($_REQUEST['getuserID'])){
        getAjaxServiceRequsesList_helpIDSub($_REQUEST['getHelpIDreq1'],$_REQUEST['gettxt_helpdesk_close1'],$_REQUEST['getuserID']);
       // echo $_REQUEST['getHelpIDreq1']."--".$_REQUEST['gettxt_helpdesk_close1']."--".$_REQUEST['getuserID'];
 }
  if(isset($_REQUEST['getHelpIDreq1_mybranch']) && isset($_REQUEST['gettxt_helpdesk_close1_mybranch']) && isset($_REQUEST['getuserID_mybranch'])){
        getAjaxServiceRequsesList_helpID_My_Branch($_REQUEST['getHelpIDreq1_mybranch'],$_REQUEST['gettxt_helpdesk_close1_mybranch'],$_REQUEST['getuserID_mybranch']);
       // echo $_REQUEST['getHelpIDreq1']."--".$_REQUEST['gettxt_helpdesk_close1']."--".$_REQUEST['getuserID'];
 }
 
 
 if(isset($_REQUEST['getsubHelpIDreq'])){
    getAjaxServiceRequsesList_SoledIssue($_REQUEST['getsubHelpIDreq']);
 }
 if(isset($_REQUEST['getAthUserGroup'])){
    getAjaxUsreGroup_CatFile($_REQUEST['getAthUserGroup']);
 }
 if(isset($_REQUEST['editHelpReq_ID'])){
    getAjaxServiceRequses_Edit($_REQUEST['editHelpReq_ID']);
 }
 if(isset($_REQUEST['getSRReoptDate1']) && isset($_REQUEST['getSRReoptDate2']) && isset($_REQUEST['getSRUGroup']) && isset($_REQUEST['opt']) && isset($_REQUEST['getDe'])){
    getServiceReequses_Report($_REQUEST['getSRReoptDate1'],$_REQUEST['getSRReoptDate2'],$_REQUEST['getSRUGroup'],$_REQUEST['opt'],$_REQUEST['getDe']);
 }
 if(isset($_REQUEST['linkExcel'])){
    echo "<a style='font-size:15px;text-decoration: none; color:#000000;' href='../../../temp/".$_REQUEST['linkExcel']."'>GET EXCEL</a>";
 }
 if(isset($_REQUEST['getSelectSRSelection']) && isset($_REQUEST['getSelectIDSelection']) && isset($_REQUEST['getSelectUGroupSelection']) && isset($_REQUEST['opt']) && isset($_REQUEST['getDe'])){
    getAjaxServiceRequses_Selection($_REQUEST['getSelectIDSelection'],$_REQUEST['getSelectSRSelection'],$_REQUEST['getSelectUGroupSelection'],$_REQUEST['opt'],$_REQUEST['getDe']);
 }
 if(isset($_POST['getCatID'])){
    getAjaxsubCatogorySelection_01($_POST['getCatID']);
 }
 if(isset($_POST['getCatIDSub1'])){
    getAjaxsubSubCatogorySelection_01($_POST['getCatIDSub1']);
 }
  if(isset($_REQUEST['getCatIDSub11']) && isset($_REQUEST['getVatIDSub22'])){
    getAjaxsubSubCatogorySelection_02($_REQUEST['getCatIDSub11'],$_REQUEST['getVatIDSub22']);
 }
 
 if(isset($_REQUEST['getSRCRFromDate']) && isset($_REQUEST['getSRCRToDate']) && isset($_REQUEST['getSRCRIdVal']) && isset($_REQUEST['srctopt'])){
    if($_REQUEST['srctopt']==1){
        getSR_Report_cat_period($_REQUEST['getSRCRFromDate'],$_REQUEST['getSRCRToDate'],$_REQUEST['getSRCRIdVal']);
    }
 }
 
 if(isset($_REQUEST['get_cnic']) && isset($_REQUEST['get_c_cstatus'])){
    //echo $_REQUEST['get_cnic'];
    getNewCompliedDataGrid_informetion($_REQUEST['get_cnic'],$_REQUEST['get_c_cstatus']);
 } 
 
  if(isset($_REQUEST['get_cnicmybranch']) && isset($_REQUEST['get_c_cstatusmybranch']) && isset($_REQUEST['txtuserBranch']) && isset($_REQUEST['txtuserDepartment'])){
    //echo $_REQUEST['get_cnic'];
    getNewCompliedDataGrid_informetionmybranch($_REQUEST['get_cnicmybranch'],$_REQUEST['get_c_cstatusmybranch'],$_REQUEST['txtuserBranch'],$_REQUEST['txtuserDepartment']);
 } 
 
     
 if(isset($_REQUEST['get_cnic_r'])){
    //echo $_REQUEST['get_cnic'];
    getNewCompliedDataGrid_informetion_r($_REQUEST['get_cnic_r']);
 }
//............................................................................................................................................................
    function getAjaxServiceRequsesList_helpID($gethelpID,$getStClose,$get_c_stats){
        //echo $get_c_stats;
        //echo $gethelpID."OK";
        $conn = DatabaseConnection();
        
        // Modified by Rizvi on 9:51 AM 15/09/2015
        $v_sql_getHelpdesk = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, DATE(`enterDateTime`) AS dd, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3`,`asing_by`,`ipAddress` , `ssb_facility_amount` ,`ssb_type` , `ssb_app_number`,`IsAppValid` , `facno` , `attachment_namesub` , `recommend_note` , `recommend_datetime` , `approve_note` , `re_init_on` , `submit_on`
                                FROM `loan_cdb_helpdesk` 
                                WHERE `helpid` = '".$gethelpID."';";
        $v_que_getHelpdesk = mysqli_query($conn,$v_sql_getHelpdesk);
        while($rec_getHelpdesk = mysqli_fetch_assoc($v_que_getHelpdesk)){
            
            $recommend_note = $rec_getHelpdesk['recommend_note'];
            $recommend_datetime = $rec_getHelpdesk['recommend_datetime'];
            $v_sel_catagory = getCat_Discreption($rec_getHelpdesk['cat_code'],$conn); // Get Cat Discreeption........ 
            //$v_sel_scat01 = getScat_discr_1_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$conn); // Get Scat Descreption...........
            //$v_sel_scat02 = getScat_discr_2_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$conn); // Get SCat Descrepion...........
            //$v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
            $v_sel_scat02 = getScat_discr_2_Descreption_loan($rec_getHelpdesk['scat_code_2'],$conn); 
            $v_getStates =  getStates($rec_getHelpdesk['cmb_code'],$conn); // Get Satates Description...............................
            $v_getUrCode = getUrgency_states($rec_getHelpdesk['ur_code'],$conn); // Get Urgency States Descreption...........................
            $v_getPrCode = getPriority_states($rec_getHelpdesk['pr_code'],$conn); // Get Uriority States Descreption................................
            $v_getSource = getSource_States($rec_getHelpdesk['s_type'],$conn); // GetSource Of Issue...............................................
            $v_getBranch = getBranchName($rec_getHelpdesk['inner_brCode'],$conn); // Get Branch Name..............................................
            $v_getDepartment = getDepartment($rec_getHelpdesk['inner_brCode'],$rec_getHelpdesk['inner_dept'],$conn); // Get Department
            $vgetInnerUser = getUserName($rec_getHelpdesk['inner_user'],$conn); // Get Inner Usre Name
            $v_getRnterUsre = getUserName($rec_getHelpdesk['enterBy'],$conn); // Get Enter Usre Name
            $vAsingUser = getUserName($rec_getHelpdesk['asing_by'],$conn); // Get Assign Usre Name
            $v_sql_getUsreNAme = "SELECT `email`,`GSMNO` FROM `user` WHERE `userName` =  '".$rec_getHelpdesk['enterBy']."';";
            $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
            $userEmail = "";
            $userGSM = "";
            while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
               $userEmail = $RES_getUsreNAme[0];
               $userGSM = $RES_getUsreNAme[1]; 
            }
            
            
            
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 150px;' type='text' name='txt_help_ID' id='txt_help_ID' value='".$rec_getHelpdesk['helpid']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 80px; text-align: right;'><label class='linetop'>Entry Date :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 70px;' type='text' name='txt_Entry_Date' id='txt_Entry_Date' value='".$rec_getHelpdesk['dd']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 70px; text-align: right;'><label class='linetop'>File Type :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:120px;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>";
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:433px;' name='txt_issue' id='txt_issue' value='".$rec_getHelpdesk['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:75px; width: 433px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Facility Amount :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='txt_issuessb_facility_amount' id='txt_issuessb_facility_amount' value='".$rec_getHelpdesk['ssb_facility_amount']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    
                    </table>";
             echo "<table>       
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Urgency' id='sel_Urgency' value='".$v_getUrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                         <td style='width: 120px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Priority' id='sel_Priority' value='".$v_getPrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr></table>";
             echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:720px;' name='txt_User' id='txt_User' value='".$rec_getHelpdesk['enterBy']." - ".$v_getRnterUsre." - ".$userGSM." - ".$userEmail ." - ".$rec_getHelpdesk['ipAddress']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'><input class='box_decaretion' type='text' name='txt_UserGetMail' id='txt_UserGetMail' value='".$rec_getHelpdesk['enterBy']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Main File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_name'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_name']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                        
                            
                     echo   "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>CRIB File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_namesub'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_namesub']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                     echo   "</td>
                    </tr>";
                     $v_Sql_helpNote = "SELECT COUNT(*) FROM `pending_upload_file` WHERE `file_type` = 'L' AND `help_id` = '".$gethelpID."';";
                    $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                    while($REC_helpNote = mysqli_fetch_array($que_helpNote)){
                        if($REC_helpNote[0] > 0){
                            echo "<tr><td style='width: 100px; text-align: right;'><label class='linetop'>Additional Files:</label></td><td>";
                            echo "<a title='".$gethelpID."' href='#' onclick='isAddiImgRequset(title)'>Additional Images</a>";
                            echo   "</td></tr>";     
                        } 
                    }  
                    echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Assign User :</label></td>
                        <td>
                                <input class='box_decaretion' type='text' style='width:100px; color: #747474; background: #F2F2F2;' name='txt_inner_User1' id='txt_inner_User1' value='".$rec_getHelpdesk['asing_by']."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User ID'/> 
                                <input class='box_decaretion' type='text' style='width:400px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vAsingUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name'/>
                                   
                        </td>
                    </tr>
                </table>";
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:400px;'>Notes</td>
                                    <td style='width:100px;'>User</td>
                                    <td style='width:150px;'>Date</td>
                                </tr>";
                                $v_Sql_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime` FROM `loan_cdb_help_note` WHERE `helpid` = '".$gethelpID."';";
                                $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                                $index = 1;
                                $Rowsnos =  50;
                                while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){  
                                    $colsnos =  round ((strlen($REC_helpNote['note_discr']) + 1) / 40,0);
                                    $Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
                                    echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px; text-align: right;'>".$index."</td>
                                            <td style='width: 400px; text-align: left;'><textarea style='overflow: hidden; border: none;resize: none;' rows='".$colsnos."' cols='70' readonly='readonly'>".$REC_helpNote['note_discr']."</textarea></td>
                                            <td style='width: 100px; text-align: left;'>".$REC_helpNote['enterBy']."</td>
                                            <td style='width: 150px; text-align: left;'>".$REC_helpNote['enterDateTime']."</td>
                                        </tr>";
                                    $index++;
                                }
                    echo "</table>
                        </td>
                    </tr>
                </table>";
                echo "
                <fieldset style='width: 700px;margin-left: 100px;'>
                    <legend><label class='linetop'>Verification :</label></legend>
                    <table style='display: none;'>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_1' id='chk_1'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Applicant Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_2' id='chk_2'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Clear Valuation.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_3' id='chk_3'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>1st Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_5' id='chk_5'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>CR Copy and Invoce.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_4' id='chk_4'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>2nd Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_6' id='chk_6'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Supplar Info.</label>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr style='width: 250px;'>
                            <td style='width: 140px; vertical-align: top;'>
                                <label class='linetop'>Pending Notification : </label>
                            <td>
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='2' style='height:40px; width: 400px;' name='txt_pn' id='txt_pn' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'></textarea>
                            </td>
                        </tr>
                    </table>
                    <table  style='display: none;'>
                    <tr  style='width: 250px;'>
                        <td style='width: 140px;'><label class='linetop'>Applicaton Number 2222:</label></td>
                        <td>";
                        if( $rec_getHelpdesk['ssb_app_number'] == 0 ||  $rec_getHelpdesk['ssb_app_number'] == ""){
                            echo "<input class='box_decaretion' type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }else{
                            echo "<input class='box_decaretion' ". ($rec_getHelpdesk['IsAppValid'] == '1'?"disabled='disabled'":"") ." type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='". $rec_getHelpdesk['ssb_app_number']."' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }    
                        
                        if( $rec_getHelpdesk['IsAppValid'] != '1' ){
                            echo "<input type='button' style='width: 120px' class='buttonManage' value='App Confirmation' title='sol' onclick='isAppGenerater();'/>";
                        }else{
                            echo "<img style='margin-left:5px;'margin-top:5px;' src='../../../img/1.png'>";
                        }
                        
                        echo "
                        </td>
                    </tr>
                </table>
                </fieldset>";
                if($get_c_stats == "NO"){
                    if($rec_getHelpdesk['re_init_on'] == '0000-00-00 00:00:00'){
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Re - Initiate' onclick='reInitate();'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Submit' onclick='' disabled='disabled'/>";
                    }else if($rec_getHelpdesk['submit_on'] == '0000-00-00 00:00:00'){
                       echo "<input type='button' style='width: 100px;' class='buttonManage' value='Re - Initiated' onclick='reInitate();' disabled='disabled'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Submit' title='is_submit();|is_Reject();' onclick='popup(1,title);'/>";
                    }else{
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Re - Initiated' onclick='reInitate();' disabled='disabled'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Submit' onclick='' disabled='disabled' />";
                    }
                }        
                
               
                echo "<input type='button' style='width: 100px;' class='buttonManage' value='Close' onclick='pageRef()'/>";
        }
    }
    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 
    function getAjaxServiceRequsesList_mybranch($gethelpID,$getStClose,$get_c_stats){
        //echo $get_c_stats;
        //echo $gethelpID."OK";
        $conn = DatabaseConnection();
        
        // Modified by Rizvi on 9:51 AM 15/09/2015
        $v_sql_getHelpdesk = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, DATE(`enterDateTime`) AS dd, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3`,`asing_by`,`ipAddress` , `ssb_facility_amount` ,`ssb_type` , `ssb_app_number`,`IsAppValid` , `facno` , `attachment_namesub` , `recommend_note` , `recommend_datetime` , `approve_note` , `re_init_on` , `submit_on`
                                FROM `loan_cdb_helpdesk` 
                                WHERE `helpid` = '".$gethelpID."';";
        $v_que_getHelpdesk = mysqli_query($conn,$v_sql_getHelpdesk);
        while($rec_getHelpdesk = mysqli_fetch_assoc($v_que_getHelpdesk)){
            
            $recommend_note = $rec_getHelpdesk['recommend_note'];
            $recommend_datetime = $rec_getHelpdesk['recommend_datetime'];
            $v_sel_catagory = getCat_Discreption($rec_getHelpdesk['cat_code'],$conn); // Get Cat Discreeption........ 
            //$v_sel_scat01 = getScat_discr_1_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$conn); // Get Scat Descreption...........
            //$v_sel_scat02 = getScat_discr_2_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$conn); // Get SCat Descrepion...........
            //$v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
            $v_sel_scat02 = getScat_discr_2_Descreption_loan($rec_getHelpdesk['scat_code_2'],$conn); 
            $v_getStates =  getStates($rec_getHelpdesk['cmb_code'],$conn); // Get Satates Description...............................
            $v_getUrCode = getUrgency_states($rec_getHelpdesk['ur_code'],$conn); // Get Urgency States Descreption...........................
            $v_getPrCode = getPriority_states($rec_getHelpdesk['pr_code'],$conn); // Get Uriority States Descreption................................
            $v_getSource = getSource_States($rec_getHelpdesk['s_type'],$conn); // GetSource Of Issue...............................................
            $v_getBranch = getBranchName($rec_getHelpdesk['inner_brCode'],$conn); // Get Branch Name..............................................
            $v_getDepartment = getDepartment($rec_getHelpdesk['inner_brCode'],$rec_getHelpdesk['inner_dept'],$conn); // Get Department
            $vgetInnerUser = getUserName($rec_getHelpdesk['inner_user'],$conn); // Get Inner Usre Name
            $v_getRnterUsre = getUserName($rec_getHelpdesk['enterBy'],$conn); // Get Enter Usre Name
            $vAsingUser = getUserName($rec_getHelpdesk['asing_by'],$conn); // Get Assign Usre Name
            $v_sql_getUsreNAme = "SELECT `email`,`GSMNO` FROM `user` WHERE `userName` =  '".$rec_getHelpdesk['enterBy']."';";
            $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
            $userEmail = "";
            $userGSM = "";
            while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
               $userEmail = $RES_getUsreNAme[0];
               $userGSM = $RES_getUsreNAme[1]; 
            }
            
            
            
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 150px;' type='text' name='txt_help_ID' id='txt_help_ID' value='".$rec_getHelpdesk['helpid']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 80px; text-align: right;'><label class='linetop'>Entry Date :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 70px;' type='text' name='txt_Entry_Date' id='txt_Entry_Date' value='".$rec_getHelpdesk['dd']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 70px; text-align: right;'><label class='linetop'>File Type :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:120px;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>";
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:433px;' name='txt_issue' id='txt_issue' value='".$rec_getHelpdesk['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:75px; width: 433px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Facility Amount :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='txt_issuessb_facility_amount' id='txt_issuessb_facility_amount' value='".$rec_getHelpdesk['ssb_facility_amount']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    
                    </table>";
             echo "<table>       
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Urgency' id='sel_Urgency' value='".$v_getUrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                         <td style='width: 120px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Priority' id='sel_Priority' value='".$v_getPrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr></table>";
             echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:720px;' name='txt_User' id='txt_User' value='".$rec_getHelpdesk['enterBy']." - ".$v_getRnterUsre." - ".$userGSM." - ".$userEmail ." - ".$rec_getHelpdesk['ipAddress']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'><input class='box_decaretion' type='text' name='txt_UserGetMail' id='txt_UserGetMail' value='".$rec_getHelpdesk['enterBy']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Main File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_name'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_name']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                        
                            
                     echo   "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>CRIB File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_namesub'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_namesub']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                     echo   "</td>
                    </tr>";
                     $v_Sql_helpNote = "SELECT COUNT(*) FROM `pending_upload_file` WHERE `file_type` = 'L' AND `help_id` = '".$gethelpID."';";
                    $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                    while($REC_helpNote = mysqli_fetch_array($que_helpNote)){
                        if($REC_helpNote[0] > 0){
                            echo "<tr><td style='width: 100px; text-align: right;'><label class='linetop'>Additional Files:</label></td><td>";
                            echo "<a title='".$gethelpID."' href='#' onclick='isAddiImgRequset(title)'>Additional Images</a>";
                            echo   "</td></tr>";     
                        } 
                    }  
                    echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Assign User :</label></td>
                        <td>
                                <input class='box_decaretion' type='text' style='width:100px; color: #747474; background: #F2F2F2;' name='txt_inner_User1' id='txt_inner_User1' value='".$rec_getHelpdesk['asing_by']."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User ID'/> 
                                <input class='box_decaretion' type='text' style='width:400px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vAsingUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name'/>
                                   
                        </td>
                    </tr>
                </table>";
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:400px;'>Notes</td>
                                    <td style='width:100px;'>User</td>
                                    <td style='width:150px;'>Date</td>
                                </tr>";
                                $v_Sql_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime` FROM `loan_cdb_help_note` WHERE `helpid` = '".$gethelpID."';";
                                $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                                $index = 1;
                                $Rowsnos =  50;
                                while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){  
                                    $colsnos =  round ((strlen($REC_helpNote['note_discr']) + 1) / 40,0);
                                    $Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
                                    echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px; text-align: right;'>".$index."</td>
                                            <td style='width: 400px; text-align: left;'><textarea style='overflow: hidden; border: none;resize: none;' rows='".$colsnos."' cols='70' readonly='readonly'>".$REC_helpNote['note_discr']."</textarea></td>
                                            <td style='width: 100px; text-align: left;'>".$REC_helpNote['enterBy']."</td>
                                            <td style='width: 150px; text-align: left;'>".$REC_helpNote['enterDateTime']."</td>
                                        </tr>";
                                    $index++;
                                }
                    echo "</table>
                        </td>
                    </tr>
                </table>";
                echo "
                <fieldset style='width: 700px;margin-left: 100px;display: none;'>
                    <legend><label class='linetop'>Verification :</label></legend>
                    <table style='display: none;'>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_1' id='chk_1'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Applicant Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_2' id='chk_2'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Clear Valuation.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_3' id='chk_3'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>1st Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_5' id='chk_5'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>CR Copy and Invoce.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_4' id='chk_4'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>2nd Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_6' id='chk_6'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Supplar Info.</label>
                            </td>
                        </tr>
                    </table>
                    <table style='display: none;'>
                        <tr style='width: 250px;'>
                            <td style='width: 140px; vertical-align: top;'>
                                <label class='linetop'>Pending Notification : </label>
                            <td>
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='2' style='height:40px; width: 400px;' name='txt_pn' id='txt_pn' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'></textarea>
                            </td>
                        </tr>
                    </table>
                    <table style='display: none;'>
                    <tr  style='width: 250px;'>
                        <td style='width: 140px;'><label class='linetop'>Applicaton Number 2222:</label></td>
                        <td>";
                        if( $rec_getHelpdesk['ssb_app_number'] == 0 ||  $rec_getHelpdesk['ssb_app_number'] == ""){
                            echo "<input class='box_decaretion' type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }else{
                            echo "<input class='box_decaretion' ". ($rec_getHelpdesk['IsAppValid'] == '1'?"disabled='disabled'":"") ." type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='". $rec_getHelpdesk['ssb_app_number']."' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }    
                        
                        if( $rec_getHelpdesk['IsAppValid'] != '1' ){
                            echo "<input type='button' style='width: 120px' class='buttonManage' value='App Confirmation' title='sol' onclick='isAppGenerater();'/>";
                        }else{
                            echo "<img style='margin-left:5px;'margin-top:5px;' src='../../../img/1.png'>";
                        }
                        
                        echo "
                        </td>
                    </tr>
                </table>
                </fieldset><br/>";
                echo "<input type='button' style='width: 150px;' class='buttonManage' value='Close' onclick='pageRef()'/>";
        }
    }
    
   
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getAjaxServiceRequsesList_helpIDSub($gethelpID,$getStClose,$getuserID){
        //echo $gethelpID;
        $conn = DatabaseConnection();
        
        // Modified by Rizvi on 9:51 AM 15/09/2015
        $sql_update = "update `loan_cdb_helpdesk` set `loan_cdb_helpdesk`.`asing_by` = '".$getuserID."' WHERE trim(`loan_cdb_helpdesk`.`asing_by`) = '' AND `loan_cdb_helpdesk`.`helpid` = '".$gethelpID."';";
        $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));

        
        $v_sql_getHelpdesk = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, DATE(`enterDateTime`) AS dd, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3`,`asing_by`,`ipAddress` , `ssb_facility_amount` ,`ssb_type` , `ssb_app_number`,`IsAppValid` , `facno` , `attachment_namesub` , `recommend_note` , `recommend_datetime` , `approve_note` , `submit_on` , `lgl_chk_on`,`lgl_chk_type` , `cro_chk_on` , `cro_des_type`
                                FROM `loan_cdb_helpdesk` 
                                WHERE `helpid` = '".$gethelpID."';";
        $v_que_getHelpdesk = mysqli_query($conn,$v_sql_getHelpdesk);
        while($rec_getHelpdesk = mysqli_fetch_assoc($v_que_getHelpdesk)){
            $recommend_note = $rec_getHelpdesk['recommend_note'];
            $recommend_datetime = $rec_getHelpdesk['recommend_datetime'];
            $v_sel_catagory = getCat_Discreption($rec_getHelpdesk['cat_code'],$conn); // Get Cat Discreeption........ 
            //$v_sel_scat01 = getScat_discr_1_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$conn); // Get Scat Descreption...........
            //$v_sel_scat02 = getScat_discr_2_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$conn); // Get SCat Descrepion...........
            //$v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
            $v_sel_scat02 = getScat_discr_2_Descreption_loan($rec_getHelpdesk['scat_code_2'],$conn); 
            $v_getStates =  getStates($rec_getHelpdesk['cmb_code'],$conn); // Get Satates Description...............................
            $v_getUrCode = getUrgency_states($rec_getHelpdesk['ur_code'],$conn); // Get Urgency States Descreption...........................
            $v_getPrCode = getPriority_states($rec_getHelpdesk['pr_code'],$conn); // Get Uriority States Descreption................................
            $v_getSource = getSource_States($rec_getHelpdesk['s_type'],$conn); // GetSource Of Issue...............................................
            $v_getBranch = getBranchName($rec_getHelpdesk['inner_brCode'],$conn); // Get Branch Name..............................................
            $v_getDepartment = getDepartment($rec_getHelpdesk['inner_brCode'],$rec_getHelpdesk['inner_dept'],$conn); // Get Department
            $vgetInnerUser = getUserName($rec_getHelpdesk['inner_user'],$conn); // Get Inner Usre Name
            $v_getRnterUsre = getUserName($rec_getHelpdesk['enterBy'],$conn); // Get Enter Usre Name
            $vAsingUser = getUserName($rec_getHelpdesk['asing_by'],$conn); // Get Assign Usre Name
            $v_sql_getUsreNAme = "SELECT `email`,`GSMNO` FROM `user` WHERE `userName` =  '".$rec_getHelpdesk['enterBy']."';";
            $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
            $userEmail = "";
            $userGSM = "";
            while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
               $userEmail = $RES_getUsreNAme[0];
               $userGSM = $RES_getUsreNAme[1]; 
            }
            
            
            
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 150px;' type='text' name='txt_help_ID' id='txt_help_ID' value='".$rec_getHelpdesk['helpid']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 80px; text-align: right;'><label class='linetop'>Entry Date :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 70px;' type='text' name='txt_Entry_Date' id='txt_Entry_Date' value='".$rec_getHelpdesk['dd']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 70px; text-align: right;'><label class='linetop'>File Type :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:120px;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>";
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:433px;' name='txt_issue' id='txt_issue' value='".$rec_getHelpdesk['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:75px; width: 433px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Facility Amount :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='txt_issuessb_facility_amount' id='txt_issuessb_facility_amount' value='".$rec_getHelpdesk['ssb_facility_amount']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    
                    </table>";
             echo "<table>       
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Urgency' id='sel_Urgency' value='".$v_getUrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                         <td style='width: 120px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Priority' id='sel_Priority' value='".$v_getPrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr></table>";
             echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:720px;' name='txt_User' id='txt_User' value='".$rec_getHelpdesk['enterBy']." - ".$v_getRnterUsre." - ".$userGSM." - ".$userEmail ." - ".$rec_getHelpdesk['ipAddress']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'><input class='box_decaretion' type='text' name='txt_UserGetMail' id='txt_UserGetMail' value='".$rec_getHelpdesk['enterBy']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Main File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_name'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_name']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                        
                            
                     echo   "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>CRIB File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_namesub'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_namesub']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                     echo   "</td>
                    </tr>";
                    $v_Sql_helpNote = "SELECT COUNT(*) FROM `pending_upload_file` WHERE `file_type` = 'L' AND `help_id` = '".$gethelpID."';";
                    $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                    while($REC_helpNote = mysqli_fetch_array($que_helpNote)){
                        if($REC_helpNote[0] > 0){
                            echo "<tr><td s tyle='width: 100px; text-align: right;'><label class='linetop'>Additional Files:</label></td><td>";
                            echo "<a title='".$gethelpID."' href='#' onclick='isAddiImgRequset(title)'>Additional Images</a>";
                            echo   "</td></tr>";     
                        } 
                    }  
                    if($rec_getHelpdesk['cmb_code'] == '5001'){
                        echo "<tr>
                            <td style='width: 100px; text-align: right;'><label class='linetop'>Assign User :</label></td>
                            <td>
                                   <input class='box_decaretion' type='text' style='width:100px; color: #747474; background: #F2F2F2;' name='txt_inner_User1' id='txt_inner_User1' value='".$rec_getHelpdesk['asing_by']."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User ID' onclick='popup(1);'/> 
                                <input class='box_decaretion' type='text' style='width:400px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vAsingUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name' onclick='popup(1);'/>
                                <input type='button' class='buttonManage' id='btnPopUp' name='btnPopUp' value='...' onclick='popup(1);'/> 
                               <div style='display: none;'><input type='button' class='buttonManage' id='btnremove' name='btnremove' value='Remove' onclick='removeUsreID()'/></div>
                                       
                            </td>
                        </tr>";
                    }
                echo "</table>";
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' cellspacing='0' cellpadding='0 id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:500px;'>Notes</td>
                                    <td style='width:100px;'>User</td>
                                    <td style='width:150px;'>Date</td>
                                </tr>";
                                $v_Sql_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime`,`user`.`userID`  FROM `loan_cdb_help_note`,`user` WHERE `user`.userName = `loan_cdb_help_note`.`enterBy` AND `helpid` = '".$gethelpID."';";
                                $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                                $index = 1;
                                $Rowsnos =  50;
                                while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){
                                    $colsnos =  round ((strlen($REC_helpNote['note_discr']) + 1) / 40,0);
                                    $Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
                                    echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px;  text-align: middle; vertical-align:top;'>".$index."</td>
                                            <td style='width: 500px; text-align: left;'><textarea style='overflow: hidden; border: none;resize: none;' rows='".$colsnos."' cols='70' readonly='readonly'>".$REC_helpNote['note_discr']."</textarea></td>
                                            <td style='width: 100px; text-align: middle; vertical-align:top;'title='".$REC_helpNote['userID']."'>".$REC_helpNote['enterBy']."</td>
                                            <td style='width: 150px; text-align: middle; vertical-align:top;'>".$REC_helpNote['enterDateTime']."</td>
                                        </tr>";
                                    $index++;
                                }
                    echo "</table>
                        </td>
                    </tr>
                </table>";
                echo "
                <fieldset style='width: 700px;margin-left: 100px;'>
                    <legend><label class='linetop'>Verification :</label></legend>
                    <table style='display: none;'>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_1' id='chk_1'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Applicant Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_2' id='chk_2'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Clear Valuation.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_3' id='chk_3'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>1st Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_5' id='chk_5'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>CR Copy and Invoce.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_4' id='chk_4'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>2nd Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_6' id='chk_6'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Supplar Info.</label>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr style='width: 250px;'>
                            <td style='width: 140px; vertical-align: top;'>
                                <label class='linetop'>Pending Notification : </label>
                            <td>
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='2' style='height:40px; width: 400px;' name='txt_pn' id='txt_pn' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'></textarea>
                            </td>
                        </tr>
                    </table>
                    <table  style='display: none;'>
                    <tr  style='width: 250px;'>
                        <td style='width: 140px;'><label class='linetop'>Applicaton Number :</label></td>
                        <td>";
                        if( $rec_getHelpdesk['ssb_app_number'] == 0 ||  $rec_getHelpdesk['ssb_app_number'] == ""){
                            echo "<input class='box_decaretion' type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }else{
                            echo "<input class='box_decaretion' ". ($rec_getHelpdesk['IsAppValid'] == '1'?"disabled='disabled'":"") ." type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='". $rec_getHelpdesk['ssb_app_number']."' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }    
                        
                        if( $rec_getHelpdesk['IsAppValid'] != '1' ){
                            echo "<input type='button' style='width: 120px' class='buttonManage' value='App Confirmation' title='sol' onclick='isAppGenerater();'/>";
                        }else{
                            echo "<img style='margin-left:5px;'margin-top:5px;' src='../../../img/1.png'>";
                        }
                        
                        echo "
                        </td>
                    </tr>
                </table>
                </fieldset>
                
                <table>
                    <tr>
                        <td style='width: 100px;'>&nbsp;</td>
                        <td>";
                        
                        //`submit_on` , `lgl_chk_on`,`lgl_chk_type` , `cro_chk_on` , `cro_des_type`
                        
                        if($rec_getHelpdesk['submit_on'] == '0000-00-00 00:00:00'){
                              $sql_get_btn = "SELECT `loan_group`.`grp_id` , `loan_group`.`grp_descreption`, `loan_group`.`can_reject`, `loan_group`.`can_recommend` , `loan_group`.`can_approve`, `loan_group`.`approve_upto`
                                        FROM `loan_group` , `loan_group_member` 
                                        WHERE `loan_group`.`grp_id` = `loan_group_member`.`grp_id` AND
                                              `loan_group_member`.`user_id` = '".$getuserID."';";
                                              //echo $sql_get_btn;
                            $que_get_btn = mysqli_query($conn , $sql_get_btn);
                             echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>
                                   <input type='button' style='width: 100px;' class='buttonManage' value='Comment' title='5' onclick='is_kiosk_ok(title);'/>
                                   <input type='button' style='width: 100px;' class='buttonManage' id='btnupdateUser' name='btnupdateUser' value='Forward' onclick='updateAssUser()'/>";
                            while($rec_get_btn = mysqli_fetch_assoc($que_get_btn)){
                                if($rec_get_btn['can_reject'] == 1){
                                    echo "<input type='button' style='width: 100px;' class='buttonManage' value='Reject' title='1' onclick='is_kiosk_ok(title);'/>";
                                }
                                if($recommend_note == "" && $recommend_datetime == "0000-00-00 00:00:00"){
                                    if($rec_get_btn['can_recommend'] == 1){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Recommend' title='2' onclick='is_kiosk_ok(title);'/>";
                                    }
                                    if(($rec_get_btn['can_approve'] == 1) && ($rec_get_btn['approve_upto'] >=  $rec_getHelpdesk['ssb_facility_amount'])){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Approve' title='3' onclick='' disabled='disabled'/>";
                                    }
                                }else if($recommend_note != "" && $recommend_datetime != "0000-00-00 00:00:00"){
                                    if($rec_get_btn['can_recommend'] == 1){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Recommend' title='2' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                                    }
                                    //echo $rec_get_btn['approve_upto'];
                                    if(($rec_get_btn['can_approve'] == 1) && ($rec_get_btn['approve_upto'] >=  $rec_getHelpdesk['ssb_facility_amount'])){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Approve' title='3' onclick='is_kiosk_ok(title);'/>";
                                    }
                                }
                            }
                        }else{
                            $sql_user_apr = "SELECT u.`legal_approve` , u.`credit_approve` FROM `user` AS u WHERE u.`userName` = '".$getuserID."';";
                            $query_user_apr = mysqli_query($conn , $sql_user_apr) or dir(mysqli_error($conn));
                            while($rec_user_apr = mysqli_fetch_array($query_user_apr)){
                                //`lgl_chk_on`,`lgl_chk_type` , `cro_chk_on` , `cro_des_type`
                                if($rec_user_apr[0] == 1 && $rec_user_apr[1] == 1){
                                    if($rec_getHelpdesk['lgl_chk_on'] == "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);' disabled='disabled'/>";  
                                    }else if($rec_getHelpdesk['lgl_chk_on'] != "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);' />";  
                                    }else{
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                    }
                                    
                                }else if($rec_user_apr[0] == 1 && $rec_user_apr[1] == 0){
                                    if($rec_getHelpdesk['lgl_chk_on'] == "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";  
                                    }else if($rec_getHelpdesk['lgl_chk_on'] != "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";  
                                    }else{
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";
                                    }
                                    
                                }else if($rec_user_apr[0] == 0 && $rec_user_apr[1] == 1){
                                    if($rec_getHelpdesk['lgl_chk_on'] == "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";  
                                    }else if($rec_getHelpdesk['lgl_chk_on'] != "0000-00-00 00:00:00" && $rec_getHelpdesk['cro_chk_on'] == "0000-00-00 00:00:00"){
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);' />";  
                                    }else{
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve'title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve'title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";
                                    }
                                    
                                }else{
                                    echo "<input type='button' style='width: 100px;' class='buttonManage' value='Notify Pending' title='4' onclick='is_kiosk_ok(title);' disabled='disabled'/>";
                                    echo "<input type='button' style='width: 100px;' class='buttonManage' value='Legal Approve' title='is_Legal_Approve();|is_Legal_Reject();' onclick='popup(1,title);' disabled='disabled'/>";
                                    echo "<input type='button' style='width: 100px;' class='buttonManage' value='Credit Approve' title='is_Credit_Approve();|is_Credit_Reject();' onclick='popup(1,title);'  disabled='disabled'/>";
                                }
                            }
                             
                        }
                    
                       
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Close' onclick='pageRef()'/>";
                        
                        echo "</td>
                    </tr>
                </table>
                ";
        }
    }




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getAjaxServiceRequsesList_helpID_My_Branch($gethelpID,$getStClose,$getuserID){
        //echo $gethelpID;
        $conn = DatabaseConnection();
        
        $v_sql_getHelpdesk = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, DATE(`enterDateTime`) AS dd, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3`,`asing_by`,`ipAddress` , `ssb_facility_amount` ,`ssb_type` , `ssb_app_number`,`IsAppValid` , `facno` , `attachment_namesub` , `recommend_note` , `recommend_datetime` , `approve_note`
                                FROM `loan_cdb_helpdesk` 
                                WHERE `helpid` = '".$gethelpID."';";
        $v_que_getHelpdesk = mysqli_query($conn,$v_sql_getHelpdesk);
        while($rec_getHelpdesk = mysqli_fetch_assoc($v_que_getHelpdesk)){
            $recommend_note = $rec_getHelpdesk['recommend_note'];
            $recommend_datetime = $rec_getHelpdesk['recommend_datetime'];
            $v_sel_catagory = getCat_Discreption($rec_getHelpdesk['cat_code'],$conn); // Get Cat Discreeption........ 
            //$v_sel_scat01 = getScat_discr_1_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$conn); // Get Scat Descreption...........
            //$v_sel_scat02 = getScat_discr_2_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$conn); // Get SCat Descrepion...........
            //$v_sel_scat03 = getScat_discr_3_Descreption($rec_getHelpdesk['cat_code'],$rec_getHelpdesk['scat_code_1'],$rec_getHelpdesk['scat_code_2'],$rec_getHelpdesk['scat_code_3'],$conn); // Get SCat Descrepion...........
            $v_sel_scat02 = getScat_discr_2_Descreption_loan($rec_getHelpdesk['scat_code_2'],$conn); 
            $v_getStates =  getStates($rec_getHelpdesk['cmb_code'],$conn); // Get Satates Description...............................
            $v_getUrCode = getUrgency_states($rec_getHelpdesk['ur_code'],$conn); // Get Urgency States Descreption...........................
            $v_getPrCode = getPriority_states($rec_getHelpdesk['pr_code'],$conn); // Get Uriority States Descreption................................
            $v_getSource = getSource_States($rec_getHelpdesk['s_type'],$conn); // GetSource Of Issue...............................................
            $v_getBranch = getBranchName($rec_getHelpdesk['inner_brCode'],$conn); // Get Branch Name..............................................
            $v_getDepartment = getDepartment($rec_getHelpdesk['inner_brCode'],$rec_getHelpdesk['inner_dept'],$conn); // Get Department
            $vgetInnerUser = getUserName($rec_getHelpdesk['inner_user'],$conn); // Get Inner Usre Name
            $v_getRnterUsre = getUserName($rec_getHelpdesk['enterBy'],$conn); // Get Enter Usre Name
            $vAsingUser = getUserName($rec_getHelpdesk['asing_by'],$conn); // Get Assign Usre Name
            $v_sql_getUsreNAme = "SELECT `email`,`GSMNO` FROM `user` WHERE `userName` =  '".$rec_getHelpdesk['enterBy']."';";
            $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
            $userEmail = "";
            $userGSM = "";
            while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
               $userEmail = $RES_getUsreNAme[0];
               $userGSM = $RES_getUsreNAme[1]; 
            }
            
            
            
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 150px;' type='text' name='txt_help_ID' id='txt_help_ID' value='".$rec_getHelpdesk['helpid']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 80px; text-align: right;'><label class='linetop'>Entry Date :</label></td>
                        <td>
                            <input class='box_decaretion' style='width: 70px;' type='text' name='txt_Entry_Date' id='txt_Entry_Date' value='".$rec_getHelpdesk['dd']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                        <td style='width: 70px; text-align: right;'><label class='linetop'>File Type :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:120px;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>";
            echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:433px;' name='txt_issue' id='txt_issue' value='".$rec_getHelpdesk['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:75px; width: 433px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'>".$rec_getHelpdesk['help_discr']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Facility Amount :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px;' name='txt_issuessb_facility_amount' id='txt_issuessb_facility_amount' value='".$rec_getHelpdesk['ssb_facility_amount']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    
                    </table>";
             echo "<table>       
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Urgency' id='sel_Urgency' value='".$v_getUrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                         <td style='width: 120px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:150px;' name='sel_Priority' id='sel_Priority' value='".$v_getPrCode."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr></table>";
             echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:720px;' name='txt_User' id='txt_User' value='".$rec_getHelpdesk['enterBy']." - ".$v_getRnterUsre." - ".$userGSM." - ".$userEmail ." - ".$rec_getHelpdesk['ipAddress']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'><input class='box_decaretion' type='text' name='txt_UserGetMail' id='txt_UserGetMail' value='".$rec_getHelpdesk['enterBy']."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Main File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_name'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_name']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                        
                            
                     echo   "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>CRIB File :</label></td>
                        <td>";
                        if($rec_getHelpdesk['attachment_namesub'] !=""){
                          echo "<a href='../../../uploadHelpdesk/".$rec_getHelpdesk['attachment_namesub']."' target='_blank'>GET Attachment</a>";
                        }else{
                            
                        }
                     echo   "</td>
                    </tr>";
                    $v_Sql_helpNote = "SELECT COUNT(*) FROM `pending_upload_file` WHERE `file_type` = 'L' AND `help_id` = '".$gethelpID."';";
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
                                <input class='box_decaretion' type='text' style='width:100px; color: #747474; background: #F2F2F2;' name='txt_inner_User1' id='txt_inner_User1' value='".$rec_getHelpdesk['asing_by']."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User ID'/> 
                                <input class='box_decaretion' type='text' style='width:400px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vAsingUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name'/>
                               
                        </td>
                    </tr>
                </table>";
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' cellspacing='0' cellpadding='0 id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:500px;'>Notes</td>
                                    <td style='width:100px;'>User</td>
                                    <td style='width:150px;'>Date</td>
                                </tr>";
                                $v_Sql_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime`,`user`.`userID`  FROM `loan_cdb_help_note`,`user` WHERE `user`.userName = `loan_cdb_help_note`.`enterBy` AND `helpid` = '".$gethelpID."';";
                                $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                                $index = 1;
                                $Rowsnos =  50;
                                while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){
                                    $colsnos =  round ((strlen($REC_helpNote['note_discr']) + 1) / 40,0);
                                    $Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
                                    echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px;  text-align: middle; vertical-align:top;'>".$index."</td>
                                            <td style='width: 500px; text-align: left;'><textarea style='overflow: hidden; border: none;resize: none;' rows='".$colsnos."' cols='70' readonly='readonly'>".$REC_helpNote['note_discr']."</textarea></td>
                                            <td style='width: 100px; text-align: middle; vertical-align:top;'title='".$REC_helpNote['userID']."'>".$REC_helpNote['enterBy']."</td>
                                            <td style='width: 150px; text-align: middle; vertical-align:top;'>".$REC_helpNote['enterDateTime']."</td>
                                        </tr>";
                                    $index++;
                                }
                    echo "</table>
                        </td>
                    </tr>
                </table>";
                echo "
                
                <fieldset style='width: 700px;margin-left: 100px;display: none;'>
                    <legend><label class='linetop'>Verification :</label></legend>
                    <table style='display: none;'>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_1' id='chk_1'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Applicant Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_2' id='chk_2'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Clear Valuation.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_3' id='chk_3'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>1st Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_5' id='chk_5'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>CR Copy and Invoce.</label>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 250px;'>
                                 <input class='box_decaretion' type='checkbox' name='chk_4' id='chk_4'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>2nd Guarantor Info.</label>
                            <td>
                            <td>
                                <input class='box_decaretion' type='checkbox' name='chk_6' id='chk_6'   onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/> <label class='linetop'>Supplar Info.</label>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr style='width: 250px;'>
                            <td style='width: 140px; vertical-align: top;'>
                                <label class='linetop'>Pending Notification : </label>
                            <td>
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='2' style='height:40px; width: 400px;' name='txt_pn' id='txt_pn' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'></textarea>
                            </td>
                        </tr>
                    </table>
                    <table  style='display: none;'>
                    <tr  style='width: 250px;'>
                        <td style='width: 140px;'><label class='linetop'>Applicaton Number :</label></td>
                        <td>";
                        if( $rec_getHelpdesk['ssb_app_number'] == 0 ||  $rec_getHelpdesk['ssb_app_number'] == ""){
                            echo "<input class='box_decaretion' type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }else{
                            echo "<input class='box_decaretion' ". ($rec_getHelpdesk['IsAppValid'] == '1'?"disabled='disabled'":"") ." type='text' style='width:180px;margin-left: 5px;font-size:15px;' name='txt_app_number' id='txt_app_number' maxlength='17' value='". $rec_getHelpdesk['ssb_app_number']."' onKeyPress='return disableEnterKey(event)'  placeholder='Application Number' />";
                        }    
                        
                        if( $rec_getHelpdesk['IsAppValid'] != '1' ){
                            echo "<input type='button' style='width: 120px' class='buttonManage' value='App Confirmation' title='sol' onclick='isAppGenerater();'/>";
                        }else{
                            echo "<img style='margin-left:5px;'margin-top:5px;' src='../../../img/1.png'>";
                        }
                        
                        echo "
                        </td>
                    </tr>
                </table>
                </fieldset>
                
                <table>
                    <tr>
                        <td style='width: 100px;'>&nbsp;</td>
                        <td>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' value='Close' onclick='pageRef()'/>";
                        echo "</td>
                    </tr>
                </table>
                ";
        }
    }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getAjaxServiceRequsesList_SoledIssue($getSubHI){
        $conn = DatabaseConnection();
        $v_get_Issue = "SELECT `issue`,`enterBy` FROM `cdb_helpdesk` WHERE `helpid` = '".$getSubHI."'";
        $que_get_Issue = mysqli_query($conn,$v_get_Issue);
        while($RES_get_Issue = mysqli_fetch_assoc($que_get_Issue)){
            $get_Iss = $RES_get_Issue['issue'];
            $entryUser = $RES_get_Issue['enterBy'];
        }
        echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Help ID :</label></td>
                        <td>
                            <input class='box_decaretion' type='text' name='get_help_ID' id='get_help_ID' value='".$getSubHI."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <div style='display: none;'>
                            <input type='text' name='get_help_Iss' id='get_help_Iss' value='".$get_Iss."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            <input type='text' name='get_help_Ent' id='get_help_Ent' value='".$entryUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Caused by :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:50px; width: 400px;' name='txtarea_Resulution' id='txtarea_Resulution' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Solution :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txtarea_Solution' id='txtarea_Solution' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' ></textarea>
                        </td>
                    </tr>
                     <tr>
                        <td style='width: 100px;'>&nbsp;</td>
                        <td>
                            <input type='submit' style='width: 100px;' class='buttonManage' id='btnReq' name='btnReq' value='Submit'/>
                            <input type='button' style='width: 100px;' class='buttonManage' id='btnClose' name='btnClose' value='Close' onclick='pageClose()'/>
                        </td>
                    </tr>
            </table>";
        
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    function getAjaxUsreGroup_CatFile($userGroup){
        $conn = DatabaseConnection();
        echo "<table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 25px;'>
                <tr style='background-color: #BEBABA;'>
                <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Cat Code</span></td>
                <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>Cat Name</span></td>
                <td style='width:50px;'></td>
            </tr>";
 
                $v_sql_Category = "SELECT `cat_code`,`cat_discr` FROM `cat_states`;";
                $que_Category = mysqli_query($conn,$v_sql_Category);
                $index = 0;
                while($RES_Category = mysqli_fetch_array($que_Category)){
                    $sql_getSt_ATH = "SELECT COUNT(*) FROM `cdb_help_user_oth` WHERE `user_group` = '".$userGroup."' AND `cat_code` = '".$RES_Category[0]."';";
                    $que_getSt_ATH = mysqli_query($conn,$sql_getSt_ATH);
                    $index++;
                    while($RES_getSt_ATH = mysqli_fetch_array($que_getSt_ATH)){
                        if($RES_getSt_ATH[0] != 0){
                            $chk = "checked = 'checked'";
                        }else{
                            $chk = "";
                        }
                        echo "<tr>";
                        echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$index."</span></td>";
                        echo "<td style='width:100px;text-align: right;'><div style='display: none;'><input type='text' name='txtCatID".$index."' id='txtCatID".$index."' value='".$RES_Category[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 5px;'>".$RES_Category[0]."</span></td>";
                        echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$RES_Category[1]."</span></td>";
                        echo "<td style='width:50px;'><input type='checkbox' name='cheCat".$index."' id='cheCat".$index."' ".$chk." /></td>";
                        echo "</tr>";
                    }
                   
                }
      
      echo "</table><div style='display:none;'><input type='text' name='txtrow' id='txtrow' value='".$index."'/></div>";
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function  getAjaxServiceRequses_Edit($editHID){ // Edit Sevise Reqvest ............................................
        $conn = DatabaseConnection();
          $v_sql_getHelpdesk_edit= "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `s_type`, `scat_code_3` , `ssb_facility_amount` , `attachment_namesub`
                                FROM `loan_cdb_helpdesk` 
                                WHERE `helpid` = '".$editHID."';";
        $v_que_getHelpdesk_edit = mysqli_query($conn,$v_sql_getHelpdesk_edit);
        while($REC_getHelpdesk_edit = mysqli_fetch_assoc($v_que_getHelpdesk_edit)){
            
         echo "<table>
               <tr>
                <td style='width: 150px; text-align: right;padding-right: 5px;'><label class='linetop'>File ID : </label></td>
                <td> <input class='box_decaretion' type='text' name='txt_help_ID' id='txt_help_ID' value='".$editHID."' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></td>
               </tr>
               </table>";
            $v_sel_catagory = getCat_Discreption($REC_getHelpdesk_edit['cat_code'],$conn); // Get Cat Discreeption........
            //$v_sel_scat01 = getScat_discr_1_Descreption($REC_getHelpdesk_edit['cat_code'],$REC_getHelpdesk_edit['scat_code_1'],$conn); // Get Scat Descreption...........
            //$v_sel_scat02 = getScat_discr_2_Descreption($REC_getHelpdesk_edit['cat_code'],$REC_getHelpdesk_edit['scat_code_1'],$REC_getHelpdesk_edit['scat_code_2'],$conn); // Get SCat Descrepion...........
            //$v_sel_scat03 = getScat_discr_3_Descreption($REC_getHelpdesk_edit['cat_code'],$REC_getHelpdesk_edit['scat_code_1'],$REC_getHelpdesk_edit['scat_code_2'],$REC_getHelpdesk_edit['scat_code_3'],$conn); // Get SCat Descrepion...........
            $v_sel_scat02 = getScat_discr_2_Descreption_loan($REC_getHelpdesk_edit['scat_code_2'],$conn);
            $v_getStates =  getStates($REC_getHelpdesk_edit['cmb_code'],$conn); // Get Satates Description...............................
            $v_getRnterUsre = getUserName($REC_getHelpdesk_edit['enterBy'],$conn); // Get Enter Usre Name
            $v_getBranch = getBranchName($REC_getHelpdesk_edit['inner_brCode'],$conn); // Get Branch Name..............................................
            $v_getDepartment = getDepartment($REC_getHelpdesk_edit['inner_brCode'],$REC_getHelpdesk_edit['inner_dept'],$conn); // Get Department
            $vgetInnerUser = getUserName($REC_getHelpdesk_edit['inner_user'],$conn); // Get Inner Usre Name
            $v_getRnterUsre = getUserName($REC_getHelpdesk_edit['enterBy'],$conn); // Get Enter Usre Name
             echo "<table style='display: none;'>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Category :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px; color: #747474; background: #D3D3D3;' name='sel_catagory' id='sel_catagory' value='".$v_sel_catagory."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' /> 
                            <div style='display: none;'><input class='box_decaretion' type='text'   name='sel_catagory_1' id='sel_catagory_1' value='".$REC_getHelpdesk_edit['cat_code']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' /> </div>
                        </td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px; color: #747474; background: #D3D3D3;' name='sel_scat02' id='sel_scat02' value='".$v_sel_scat02."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly' />      
                        </td>
                    </tr>
                </table>";
             echo "<table>";
                   echo " <tr>
                    <td style='width: 150px; text-align: right;padding-right: 5px;'><label class='linetop'>Facility Amount :</label></td>
                    <td>
                        <input class='box_decaretion' type='text'  style='width:150px;' maxlength='15' placeholder='0.00' name='txt_facility_amount' id='txt_facility_amount' value='".$REC_getHelpdesk_edit['ssb_facility_amount']."' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' required='required' />
                    </td>
                  </tr>";
                   echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Issue :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:400px;' name='txt_issue' id='txt_issue' value='".$REC_getHelpdesk_edit['issue']."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right; vertical-align: top;'><label class='linetop'>Description :</label></td>
                        <td>
                            <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>".$REC_getHelpdesk_edit['help_discr']."</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>States :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:200px; color: #747474; background: #D3D3D3;' name='sel_States' id='sel_States' value='".$v_getStates."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Urgency :</label></td>
                        <td>";
                        echo "<div style='display: none;'><input type='text' name='sel_Urgency_defolt' id='sel_Urgency_defolt' value='".$REC_getHelpdesk_edit['ur_code']."'  onKeyPress='return disableEnterKey(event)'/></div>";
                        echo "<select class='box_decaretion'  style='width: 200px;' name='sel_Urgency' id='sel_Urgency' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
                        $v_sql_Urgency = "SELECT `ur_code`,`ur_discr` FROM `urgency_states` WHERE `ur_state` = 1;";
                        $que_getUrgency = mysqli_query($conn,$v_sql_Urgency);
                        while($RES_getUrgency = mysqli_fetch_array($que_getUrgency)){
                            echo "<option value=".$RES_getUrgency[0].">".$RES_getUrgency[1]."</option>";
                        }
                        echo "</select>";
                echo "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Priority :</label></td>
                        <td>";
                        echo "<div style='display: none;'><input type='text' name='sel_Priority_defolt' id='sel_Priority_defolt' value='".$REC_getHelpdesk_edit['pr_code']."'  onKeyPress='return disableEnterKey(event)'/></div>";
                        echo "<select class='box_decaretion'  style='width: 200px;' name='sel_Priority' id='sel_Priority' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
                        $v_sql_Priority = "SELECT `pr_code`,`pr_discr` FROM `priority_states` WHERE `pr_state` = 1;";
                        $que_getPriority = mysqli_query($conn,$v_sql_Priority);
                        while($RES_getPriority = mysqli_fetch_array($que_getPriority)){
                            echo "<option value=".$RES_getPriority[0].">".$RES_getPriority[1]."</option>";
                        }
                        echo "</select>";
                     echo "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Source of Iss. :</label></td>
                        <td>";
                            echo "<div style='display: none;'><input type='text' name='sel_Source_defolt' id='sel_Source_defolt' value='".$REC_getHelpdesk_edit['s_type']."'  onKeyPress='return disableEnterKey(event)'/></div>";
                            echo "<select class='box_decaretion'  style='width: 200px;' name='sel_Source' id='sel_Source' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
                            $v_sql_Source = "SELECT `s_type`,`s_descript` FROM `cdb_soarce_of_issue` WHERE `s_stats` = 1;";
                            $que_getSource = mysqli_query($conn,$v_sql_Source);
                            while($RES_getSource = mysqli_fetch_array($que_getSource)){
                                echo "<option value=".$RES_getSource[0].">".$RES_getSource[1]."</option>";
                            }
                            echo "</select>";
                       echo "</td>
                    </tr>
                    <tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Enterd User :</label></td>
                        <td>
                            <input class='box_decaretion' type='text'  style='width:600px; color: #747474; background: #D3D3D3;' name='txt_User' id='txt_User' value='".$REC_getHelpdesk_edit['enterBy']." -- ".$v_getRnterUsre." ' onKeyPress='return disableEnterKey(event)' readonly='readonly'/>
                        </td>
                    </tr>";
                echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>Main File :</label></td>
                        <td>";
                            echo "<div  style='display: none;'><input type='text' name='fileAttachment1' id='fileAttachment1' value='".$REC_getHelpdesk_edit['attachment_name']."' onKeyPress='return disableEnterKey(event)'/></div>";
                            if($REC_getHelpdesk_edit['attachment_name'] !=""){
                                echo "<span id='link_att'><a href='../../../uploadHelpdesk/".$REC_getHelpdesk_edit['attachment_name']."' target='_blank'>GET Attachment</a></span>";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' style='width: 100px;' class='buttonManage' id='btnCloseAtt' name='btnCloseAtt' value='Remove' title='".$editHID."' onclick='isRemoveAttachment(title);'/>";
                                echo "<input class='buttonManage' type='file' name='fileAttachment' id='fileAttachment'/>";
                            }else{
                                echo "<input class='buttonManage' type='file' name='fileAttachment' id='fileAttachment' />";  
                            }
                        echo "</td>
                      </tr>";
                echo "<tr>
                        <td style='width: 100px; text-align: right;'><label class='linetop'>CRIB File :</label></td>
                        <td>";
                            echo "<div style='display: none;'><input type='text' name='fileAttachment2' id='fileAttachment2' value='".$REC_getHelpdesk_edit['attachment_namesub']."' onKeyPress='return disableEnterKey(event)'/></div>";
                            if($REC_getHelpdesk_edit['attachment_namesub'] !=""){
                                echo "<span id='link_att1'><a href='../../../uploadHelpdesk/".$REC_getHelpdesk_edit['attachment_namesub']."' target='_blank'>GET Attachment</a></span>";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' style='width: 100px;' class='buttonManage' id='btnCloseAtt1' name='btnCloseAtt1' value='Remove' title='".$editHID."' onclick='isRemoveAttachment1(title);'/>";
                                echo "<input class='buttonManage' type='file' name='fileAttachmentsub' id='fileAttachmentsub'/>";
                            }else{
                                echo "<input class='buttonManage' type='file' name='fileAttachmentsub' id='fileAttachmentsub' />";  
                            }
                    
                        echo "</td>
                    </tr>";
                    echo "<tr>
                        <td style='width: 100px; text-align: right;'></td>
                        <td>
                            <div id='progress-div'><div id='progress-bar'></div></div>
                        </td>
                    </tr>
                </table>";
                echo "<table>
                    <tr>
                        <td style='width: 100px; text-align: right;vertical-align: top;'><label class='linetop'>Note :</label></td>
                        <td>
                            <table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                                <tr style='background-color: #BEBABA;'>
                                    <td style='width:50px;'>#</td>
                                    <td style='width:600px;'>Notes</td>
                                    <td style='width:30px;'></td>
                                </tr>";
                                $v_Sql_helpNote = "SELECT `note_discr` FROM `loan_cdb_help_note` WHERE `helpid` = '".$REC_getHelpdesk_edit['helpid']."';";
                                $que_helpNote = mysqli_query($conn,$v_Sql_helpNote);
                                $index = 1;
                                while($REC_helpNote = mysqli_fetch_assoc($que_helpNote)){  
                                    echo "<tr style='background:#FFFFFF;'>
                                            <td style='width: 50px; text-align: right;'><input style='width:50px; text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$index."'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/></td>
                                            <td style='width: 600px; text-align: left;'><textarea style='width:600px;' readonly='readonly' name='txtb".$index."' id='txtb".$index."'>".$REC_helpNote['note_discr']."</textarea></td>
                                            <td style='width:30px;'></td>
                                        </tr>";
                                    $index++;
                                }
                    echo "</table>
                        </td>
                    </tr>";
               echo " </table> <div style='display: none;'>
           <input type='text' name='row_COUNT' id='row_COUNT' value='".$index."' onKeyPress='return disableEnterKey(event)'/> 
        </div>";
              echo "<br/><br/>
                <div style='display: none;'>
                <fieldset>
                    <legend><label class='linetop'>Intermediate Contact:</label></legend>
                        <table style='margin-left: 100px;'>
                        <tr>
                            <td>";
                                echo "<div style='display: none;'><input type='text' name='txt_Branch_defolt' id='txt_Branch_defolt' value='".$REC_getHelpdesk_edit['inner_brCode']."'  onKeyPress='return disableEnterKey(event)'/></div>
                                <select class='box_decaretion'  style='width: 200px;' name='txt_Branch' id='txt_Branch' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' title='3' onchange='is_getScat_01(this.id,title);'>
                                    <option value=''>--Select Branch --</option>";
                                    $v_sql_Branch = "SELECT `branchNumber`,`branchName` FROM `branch`;";
                                    $que_getBranch = mysqli_query($conn,$v_sql_Branch);
                                    while($RES_getBranch = mysqli_fetch_array($que_getBranch)){
                                        echo "<option value=".$RES_getBranch[0].">".$RES_getBranch[1]."</option>";
                                    }
                                echo "</select>
                            </td>
                            <td>
                                <div id='divc'>";
                                    echo "<div style='display: none;'><input type='text' name='txt_Department_defolt' id='txt_Department_defolt' value='".$REC_getHelpdesk_edit['inner_dept']."'  onKeyPress='return disableEnterKey(event)'/></div>";
                                    echo "<select class='box_decaretion'  style='width: 200px;' name='txt_Department' id='txt_Department' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                                        <option value=''>--Select Department--</option>";
                                        
                                    $v_sql_Dept = "SELECT `deparmentNumber`,`deparmentName` FROM `deparment` WHERE `branchNumber` = '" . $REC_getHelpdesk_edit['inner_brCode'] ."'" ;
                                    $que_getDept = mysqli_query($conn,$v_sql_Dept);
                                    while($RES_getDept = mysqli_fetch_array($que_getDept)){
                                        echo "<option value=".$RES_getDept[0].">".$RES_getDept[1]."</option>";
                                    }

                                    echo "</select>   
                                </div>
                            </td>
                        </tr>
                        </table>
                    <table>
                        <tr>
                            <td style='width: 93px; text-align: right; vertical-align: top;'>
                                <label class='linetop'>Inter. User :</label>
                            <td>   
                            <td>
                                <div style='display: none;'>
                                    <input type='text' name='txt_inner_User1' id='txt_inner_User1' value='".$REC_getHelpdesk_edit['inner_user']."' onKeyPress='return disableEnterKey(event)'/> 
                                </div>
                                <input class='box_decaretion' type='text'  style='width:600px; color: #747474; background: #F2F2F2;' name='txt_inner_User2' id='txt_inner_User2' value='".$vgetInnerUser."' onKeyPress='return disableEnterKey(event)' readonly='readonly' placeholder='User Name' onclick='popup(1);'  />
                                <input type='button' class='buttonManage' id='btnPopUp' name='btnPopUp' value='...' onclick='popup(1);'/>
                                <input type='button' class='buttonManage' id='btnremove' name='btnremove' value='Remove' onclick='removeUsreID()'/>
                            </td>
                        </tr>
                        <tr>
                            <td style='width: 93px; text-align: right; vertical-align: top;'>
                                <label class='linetop'>Inter. Remark :</label>
                            <td>   
                            <td>
                                <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='inner_Remark' id='inner_Remark' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>".$REC_getHelpdesk_edit['inner_remark']."</textarea>
                            </td>
                        </tr>
                    </table>
                </fieldset></div>";  
         
                echo "<table>
                    <tr>
                        <td style='width: 100px;'>&nbsp;</td>
                        <td>";
                        echo "<input type='submit' style='width: 100px;' class='buttonManage' id='btnSolution' name='btnSolution' value='Update'/>";
                        echo "<input type='button' style='width: 100px;' class='buttonManage' id='btnClose' name='btnClose' value='Close' onclick='pageClose()'/>
                        </td>
                    </tr>
                </table>";
             
             
        }
         
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    function  getServiceReequses_Report($getDate1,$getDate2,$uGroup,$opt,$ude){
        $conn = DatabaseConnection();
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                    <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>Issue</span></td>
                    <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Branch</span></td>
                    <td style='width:150px;text-align: left'><span style='margin-left: 5px;'>Req. Department</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                    <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Urgency</span></td>
                    <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>Priority</span></td>
                    <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>States</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Assign By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Solved By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Solved On</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Ackn. By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Ackn. On</span></td>
                </tr>";
                
                if($opt==1){
                $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, DATE(`cdb_helpdesk`.`solved_on`),  `cdb_helpdesk`.`act_by`,  DATE(`cdb_helpdesk`.`act_on`)
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code`
                                       AND  DATE(`cdb_helpdesk`.`enterDateTime`) BETWEEN '".$getDate1."' AND '".$getDate2."'
                                       AND  `cdb_help_user_oth`.`user_group` = '".$uGroup."'
                                    ORDER BY `cdb_helpdesk`.`helpid`;";
                }else if($opt==2){
                    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, DATE(`cdb_helpdesk`.`solved_on`),  `cdb_helpdesk`.`act_by`,  DATE(`cdb_helpdesk`.`act_on`)
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND  DATE(`cdb_helpdesk`.`enterDateTime`) BETWEEN '".$getDate1."' AND '".$getDate2."'
                                       AND  `cdb_helpdesk`.`entry_branch` = '".$uGroup."'
                                       AND  `cdb_helpdesk`.`entry_department` = '".$ude."'
                                    ORDER BY `cdb_helpdesk`.`helpid`;";
                }
                $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
                $index = 0;
                while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
                    $entryBy = getUserName($rec_det_detels[5],$conn);
                    $asingBy = getUserName($rec_det_detels[9],$conn);
                    $sodBy = getUserName($rec_det_detels[10],$conn);
                    $atcBy = getUserName($rec_det_detels[12],$conn);
                    //$string = preg_replace( '/[^[:print:]]/', '',$rec_det_detels[2]);
                    $string = preg_replace( '/[\x00-\x1F\x80-\xFF]/', '',$rec_det_detels[2]);
                    $index++;
                    echo "<tr id = 'tr".$index."' title = '".$rec_det_detels[0]."' onclick='gettrVal(this.id,title,1)'>";
                    echo "<td style='width:60px;text-align: right;'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
                    echo "<td style='width:300px;text-align: left;'><span style='margin-left: 2px;'>".$string."</span></td>";
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'title = '".$entryBy."' ><span style='margin-right: 2px;'>".$rec_det_detels[5]."</span></td>";
                    echo "<td style='width:100px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[6]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$sodBy."'><span style='margin-right: 2px;'>".$rec_det_detels[10]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[11]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$atcBy."'><span style='margin-right: 2px;'>".$rec_det_detels[12]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[13]."</span></td>";
                    echo "</tr>";
                }
            echo "</table>";  
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function  getAjaxServiceRequses_Selection($IDSelection,$SRSelection,$uGroup,$opt,$udep){
        $conn = DatabaseConnection();
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                    <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>Issue</span></td>
                    <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Branch</span></td>
                    <td style='width:150px;text-align: left'><span style='margin-left: 5px;'>Req. Department</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                    <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Urgency</span></td>
                    <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>Priority</span></td>
                    <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>States</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Assign By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Solved By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Solved On</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Ackn. By</span></td>
                    <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Ackn. On</span></td>
                </tr>";
                if($opt == 1){
                 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, DATE(`cdb_helpdesk`.`solved_on`),  `cdb_helpdesk`.`act_by`,  DATE(`cdb_helpdesk`.`act_on`)
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code`
                                       AND  `cdb_help_user_oth`.`user_group` = '".$uGroup."' AND";
                 }else if($opt == 2){
                    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, DATE(`cdb_helpdesk`.`solved_on`),  `cdb_helpdesk`.`act_by`,  DATE(`cdb_helpdesk`.`act_on`)
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND `cdb_helpdesk`.`entry_branch` = '".$uGroup."' 
                                       AND `cdb_helpdesk`.`entry_department` = '".$udep."' AND ";
                                       
                 }
                if($IDSelection == 1){
                  $v_sql_det_detels  .= "`cdb_helpdesk`.`cmb_code` = '".$SRSelection."'";
                          
                }
                if($IDSelection == 2){
                    $v_sql_det_detels .= "`cdb_helpdesk`.`ur_code` = '".$SRSelection."'"; 
                }
                if($IDSelection == 3){
                    $v_sql_det_detels .= "`cdb_helpdesk`.`pr_code` = '".$SRSelection."'"; 
                }
                if($IDSelection == 4){
                    $v_sql_det_detels .= "`cdb_helpdesk`.`s_type` = '".$SRSelection."'"; 
                }
                if($IDSelection == 5){
                    $v_sql_det_detels .= "`cdb_helpdesk`.`asing_by` = '".$SRSelection."'"; 
                }
                $v_sql_det_detels .= "ORDER BY `cdb_helpdesk`.`helpid`;";   
                $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
                $index = 0;
                while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
                    $entryBy = getUserName($rec_det_detels[5],$conn);
                    $asingBy = getUserName($rec_det_detels[9],$conn);
                    $sodBy = getUserName($rec_det_detels[10],$conn);
                    $atcBy = getUserName($rec_det_detels[12],$conn);
                    //$string = preg_replace( '/[^[:print:]]/', '',$rec_det_detels[2]);
                    $string = preg_replace( '/[\x00-\x1F\x80-\xFF]/', '',$rec_det_detels[2]);
                    $index++;
                    echo "<tr id = 'tr".$index."' title = '".$rec_det_detels[0]."' onclick='gettrVal(this.id,title,1)'>";
                    echo "<td style='width:60px;text-align: right;'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
                    echo "<td style='width:300px;text-align: left;'><span style='margin-left: 2px;'>".$string."</span></td>";
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
                    echo "<td style='width:150px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'title = '".$entryBy."' ><span style='margin-right: 2px;'>".$rec_det_detels[5]."</span></td>";
                    echo "<td style='width:100px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[6]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
                    echo "<td style='width:80px;text-align: left;'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$sodBy."'><span style='margin-right: 2px;'>".$rec_det_detels[10]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[11]."</span></td>";
                    echo "<td style='width:80px;text-align: right;' title = '".$atcBy."'><span style='margin-right: 2px;'>".$rec_det_detels[12]."</span></td>";
                    echo "<td style='width:80px;text-align: right;'><span style='margin-right: 2px;'>".$rec_det_detels[13]."</span></td>";
                    echo "</tr>";
                }
            echo "</table>";  
        
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getAjaxsubCatogorySelection_01($getCatID){
        $conn = DatabaseConnection();
        echo "<table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>";
        echo "<tr style='background-color: #BEBABA;'>";
        echo "<td style='width:100px;'>Sub Cat ID</td>";
        echo "<td style='width:500px;'>Sub Cat Name</td>";
        echo "<td style='width:30px;'></td>";
        echo "</tr>";
        $sql_getScat1 = "SELECT `scat_code_1`,`scat_discr_1` FROM `scat_01` WHERE `cat_code`='".$getCatID."';";
        $q_getScat1 = mysqli_query($conn,$sql_getScat1);
        $rowcount=mysqli_num_rows($q_getScat1);
        $x = 1;
        if($rowcount !=0 ){
            while($RES_getScat1 = mysqli_fetch_assoc($q_getScat1)){
                echo "<tr>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$x."' id='txta".$x."' value='".$RES_getScat1['scat_code_1']."'  onKeyPress='return disableEnterKey(event)'/></td>";
                echo "<td style='width:500px;'><input style='width:500px;' type='text' name='txtb".$x."' id='txtb".$x."' value='".$RES_getScat1['scat_discr_1']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:30px;'><img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/></td>";
                echo "</tr>";
                $x++;
            }
            echo "</table>";
            echo "<div style='display: none;'>";
            echo "<input type='text' name='row_COUNT' id='row_COUNT' value='".($x-1)."' onKeyPress='return disableEnterKey(event)'/>"; 
            echo "</div>";
        }else{
            echo "<tr>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$x."' id='txta".$x."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
            echo "<td style='width:500px;'><input style='width:500px;' type='text' name='txtb".$x."' id='txtb".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:30px;'><img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/></td>";
            echo "</tr>";  
            echo "</table>";
            echo "<div style='display: none;'>";
            echo "<input type='text' name='row_COUNT' id='row_COUNT' value='".($x)."' onKeyPress='return disableEnterKey(event)'/>"; 
            echo "</div>"; 
        }
        
        
        
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function getAjaxsubSubCatogorySelection_01($scat1){
        $conn = DatabaseConnection();
        $sql_getScat1 = "SELECT `scat_code_1`,`scat_discr_1` FROM `scat_01` WHERE `cat_code`='".$scat1."';";
        $q_getScat1 = mysqli_query($conn,$sql_getScat1);
        echo "<select class='box_decaretion'  style='width: 200px;' name='sel_catagory_1' id='sel_catagory_1' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='isChangeSubCat1()'>";
        echo "<option value=''>--Select Sub Catagory 1--</option>";
        while($RES_getScat1 = mysqli_fetch_assoc($q_getScat1)){
            echo "<option value='".$RES_getScat1['scat_code_1']."'>".$RES_getScat1['scat_discr_1']."</option>";
        }
        echo "</select>";
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
    function getAjaxsubSubCatogorySelection_02($cat1,$cat2){
        $conn = DatabaseConnection();
        echo "<table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>";
        echo "<tr style='background-color: #BEBABA;'>";
        echo "<td style='width:100px;'>Sub Cat ID</td>
              <td style='width:300px;'>Sub Cat Name</td>
              <td style='width:100px;'>Def. User</td>
              <td style='width:100px;'>SLA_Type</td>
              <td style='width:100px;'>SLA</td>
              <td style='width:100px;'>Esca. User 1</td>
              <td style='width:50px;'>Esca. 1</td>
              <td style='width:100px;'>Esca. User 2</td>
              <td style='width:50px;'>Esca. 2</td>
              <td style='width:100px;'>Esca. User 3</td>
              <td style='width:50px;'>Esca. 3</td>
              <td style='width:30px;'></td>";
        echo "</tr>";
        $sql_getScat1 = "SELECT * FROM `scat_02` WHERE `cat_code`='".$cat1."' AND `scat_code_1`='".$cat2."';";
        $q_getScat1 = mysqli_query($conn,$sql_getScat1);
        $rowcount=mysqli_num_rows($q_getScat1);
        $x = 1;
        if($rowcount !=0 ){
            while($RES_getScat1 = mysqli_fetch_assoc($q_getScat1)){
                echo "<tr>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$x."' id='txta".$x."' value='".$RES_getScat1['scat_code_2']."'  onKeyPress='return disableEnterKey(event)'/></td>";
                echo "<td style='width:300px;'><input style='width:300px;' type='text' name='txtb".$x."' id='txtb".$x."' value='".$RES_getScat1['scat_discr_2']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtc".$x."' id='txtc".$x."' value='".$RES_getScat1['DefuserID']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'>
                        <select class='box_decaretion'  style='width:100px;' name='txtd".$x."' id='txtd".$x."' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                            <option value=''>SLA TYPE</option>
                            <option value='DAY'>Day</option>
                            <option value='HOURS'>Hours</option>
                            <option value='MINUTES'>Minutes</option>
                         </select>
                <div style='display: none;'><input type='text' name='txtl".$x."' id='txtl".$x."' value='".$RES_getScat1['SLA_TYPE']."'  onKeyPress='return disableEnterKey(event)' /><div></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txte".$x."' id='txte".$x."' value='".$RES_getScat1['SAL']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtf".$x."' id='txtf".$x."' value='".$RES_getScat1['ESCAL_1_USER_ID']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtg".$x."' id='txtg".$x."' value='".$RES_getScat1['ESCAL_1']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txth".$x."' id='txth".$x."' value='".$RES_getScat1['ESCAL_2_USER_ID']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txti".$x."' id='txti".$x."' value='".$RES_getScat1['ESCAL_2']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtj".$x."' id='txtj".$x."' value='".$RES_getScat1['ESCAL_3_USER_ID']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtk".$x."' id='txtk".$x."' value='".$RES_getScat1['ESCAL_3']."'  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:30px;'><img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/></td>";
                echo "</tr>";
                $x++;
            }
            echo "</table>";
            echo "<div style='display: none;'>";
            echo "<input type='text' name='row_COUNT' id='row_COUNT' value='".($x-1)."' onKeyPress='return disableEnterKey(event)'/>"; 
            echo "</div>";
        }else{
           /* echo "<tr>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$x."' id='txta".$x."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
            echo "<td style='width:300px;'><input style='width:300px;' type='text' name='txtb".$x."' id='txtb".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtc".$x."' id='txtc".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtd".$x."' id='txtd".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txte".$x."' id='txte".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtf".$x."' id='txtf".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:30px;'><img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/></td>";
            echo "</tr>";  
            echo "</table>";
            echo "<div style='display: none;'>";
            echo "<input type='text' name='row_COUNT' id='row_COUNT' value='".($x)."' onKeyPress='return disableEnterKey(event)'/>"; 
            echo "</div>"; 
            */
            
            echo "<tr>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$x."' id='txta".$x."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
            echo "<td style='width:300px;'><input style='width:300px;' type='text' name='txtb".$x."' id='txtb".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtc".$x."' id='txtc".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
            echo "<td style='width:100px;'>
                        <select class='box_decaretion'  style='width:100px;' name='txtd".$x."' id='txtd".$x."' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                            <option value=''>SLA TYPE</option>
                            <option value='DAY'>Day</option>
                            <option value='HOURS'>Hours</option>
                            <option value='MINUTES'>Minutes</option>
                         </select>
                <div style='display: none;'><input type='text' name='txtl".$x."' id='txtl".$x."' value=''  onKeyPress='return disableEnterKey(event)' /><div></td>";
            echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txte".$x."' id='txte".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtf".$x."' id='txtf".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtg".$x."' id='txtg".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txth".$x."' id='txth".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txti".$x."' id='txti".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtj".$x."' id='txtj".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtk".$x."' id='txtk".$x."' value=''  onKeyPress='return disableEnterKey(event)' /></td>";
                echo "<td style='width:30px;'><img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/></td>";
                echo "</tr>";
            echo "</table>";
            echo "<div style='display: none;'>";
            echo "<input type='text' name='row_COUNT' id='row_COUNT' value='".($x)."' onKeyPress='return disableEnterKey(event)'/>"; 
            echo "</div>";
        }
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    function getSR_Report_cat_period($getSRCRFromDate,$getSRCRToDate,$getSRCRIdVal){
        $conn = DatabaseConnection();
        $sql_getReport = "SELECT MIS.CAT_CODE,
                                 MIS.CAT_DESCR, 
                                 MIS.OPBAL_SR,
                                 MIS.OPEN_SR,
                                 MIS.CLOSE_SR,
                                 (MIS.OPBAL_SR + MIS.OPEN_SR - MIS.CLOSE_SR) AS PENDING,
                                 MIS.firstCol,
                                 MIS.secCol,
                                 MIS.THCOL
                          FROM(SELECT   cs.`cat_code` AS CAT_CODE, 
                                        cs.`cat_discr` AS CAT_DESCR,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE date(ch.`enterDateTime`) < '".$getSRCRFromDate."' AND (date(ch.`caloser_dateTime`) >= '".$getSRCRFromDate."' OR date(ch.`caloser_dateTime`)  = '0000-00-00 00:00:00')  AND ch.`cat_code` = cs.`cat_code`) AS OPBAL_SR,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE date(ch.`enterDateTime`) >= '".$getSRCRFromDate."'   AND date(ch.`enterDateTime`) <= '".$getSRCRToDate."' AND ch.`cat_code` = cs.`cat_code`) AS OPEN_SR,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE date(ch.`solved_on`) >= '".$getSRCRFromDate."'   AND date(ch.`solved_on`) <= '".$getSRCRToDate."'   AND ch.`cat_code` = cs.`cat_code`) AS CLOSE_SR,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`cat_code` = cs.`cat_code` and `cmb_code` = '5001' and DATEDIFF(date(now()),date(ch.`enterDateTime`)) < 3) AS firstCol,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`cat_code` = cs.`cat_code` and `cmb_code` = '5001' and DATEDIFF(date(now()),date(ch.`enterDateTime`)) >= 3 AND DATEDIFF(date(now()),date(ch.`enterDateTime`)) < 5) AS secCol,
                                        (SELECT COUNT(*) FROM `cdb_helpdesk` ch WHERE ch.`cat_code` = cs.`cat_code` and `cmb_code` = '5001' and DATEDIFF(date(now()),date(ch.`enterDateTime`)) >= 5) AS THCOL                                          
                               FROM `cat_states` cs
                               where cs.`cat_code` like '%".$getSRCRIdVal."%'
                          ) MIS";
       // echo $sql_getReport;
        $q_getScat = mysqli_query($conn,$sql_getReport);
        //$rowcount=mysqli_num_rows($q_getScat);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;'>";
        echo "<tr style='background-color: #BEBABA;'>";
        echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Category</span></td>";
        echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>#</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Open Balance</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>New SR</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Closed SR</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Pending SR</span></td>";
        echo "<td style='width:150px;text-align: right;' colspan='3'><span style='margin-right: 5px;'>Age Analysis</span></td>";
        echo "</tr>";
         echo "<tr style='background-color: #BEBABA;'>";
        echo "<td style='width:660px;text-align: right;' colspan='6'></td>";
        echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>1 - 3</span></td>";
        echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>4 - 5</span></td>";
        echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>>5</span></td>";
        echo "</tr>";
        $index = 1;
        while($RES_getScat = mysqli_fetch_array($q_getScat)){
            $index++;
            if($index%2 == 1){
                $col = "#FFFFFF";
            }else{
                 $col = "#F2F2F2";
            }
            echo "<tr style='background-color:".$col."'>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[0]."</span></td>";
            echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$RES_getScat[1]."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[2]."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[3]."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[4]."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[5]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[6]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[7]."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_getScat[8]."</span></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 


function getNewCompliedDataGrid_informetion($get_cnic , $get_c_cstatus){
    echo $get_c_cstatus;
    $status_file_final_stat = "";
    if($get_c_cstatus == "YES"){
        $status_file_final_stat = "Approved";
    }else if($get_c_cstatus == "NO"){
        $status_file_final_stat = "";
    }else if($get_c_cstatus = "REC"){
        $status_file_final_stat = "Rejectd";
    }else{
        $status_file_final_stat = "";
    }
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
                <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
                <td style='width:120px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
                <td style='width:260px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
                <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Type</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
                <td style='width:50px;'></td>
            </tr>";
 $v_sql_det_detels = "SELECT `loan_cdb_helpdesk`.`helpid` , DATE(`loan_cdb_helpdesk`.`enterDateTime`), `loan_cdb_helpdesk`.`issue`,`loan_cdb_helpdesk`.`scat_code_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `loan_cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `loan_cdb_helpdesk`.`asing_by` , `loan_cdb_helpdesk`.`cat_code` , `loan_cdb_helpdesk`.`ssb_facility_amount` , `loan_cdb_helpdesk`.`ssb_type`,`loan_cdb_helpdesk`.`help_discr`,IF(`loan_cdb_helpdesk`.`ssb_app_number` = '', 4, `loan_cdb_helpdesk`.`IsAppValid`) as validapp,`loan_cdb_helpdesk`.`ssb_app_number`,`loan_cdb_helpdesk`.`facno`,`loan_cdb_helpdesk`.`caloser_dateTime`,DATE(`loan_cdb_helpdesk`.`caloser_dateTime`) = DATE(NOW()) AS is_old
 FROM `loan_cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
 WHERE `loan_cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `loan_cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `loan_cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `loan_cdb_helpdesk`.`cmb_code` = '5002' AND
        `loan_cdb_helpdesk`.`file_final_stat` = '".$status_file_final_stat."' AND
       `loan_cdb_helpdesk`.`issue` like  '%".$get_cnic."%'
       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
       
 
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
        // if ($_SESSION['user'] == $rec_det_detels[9]){
        if ($rec_det_detels[18]){
           $MyRow = "background-color:#E6FFFA;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
        /*echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";
}




function getNewCompliedDataGrid_informetionmybranch($get_cnic , $get_c_cstatus ,$txtuserBranch,$txtuserDepartment){
    //echo $get_c_cstatus;
    $status_file_final_stat = "";
    if($get_c_cstatus == "YES"){
        $status_file_final_stat = "Approved";
    }else if($get_c_cstatus == "NO"){
        $status_file_final_stat = "";
    }else if($get_c_cstatus = "REC"){
        $status_file_final_stat = "Rejectd";
    }else{
        $status_file_final_stat = "";
    }
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
                <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
                <td style='width:120px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
                <td style='width:260px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
                <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Type</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
                <td style='width:50px;'></td>
            </tr>";
 $v_sql_det_detels = "SELECT `loan_cdb_helpdesk`.`helpid` , DATE(`loan_cdb_helpdesk`.`enterDateTime`), `loan_cdb_helpdesk`.`issue`,`loan_cdb_helpdesk`.`scat_code_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `loan_cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `loan_cdb_helpdesk`.`asing_by` , `loan_cdb_helpdesk`.`cat_code` , `loan_cdb_helpdesk`.`ssb_facility_amount` , `loan_cdb_helpdesk`.`ssb_type`,`loan_cdb_helpdesk`.`help_discr`,IF(`loan_cdb_helpdesk`.`ssb_app_number` = '', 4, `loan_cdb_helpdesk`.`IsAppValid`) as validapp,`loan_cdb_helpdesk`.`ssb_app_number`,`loan_cdb_helpdesk`.`facno`,`loan_cdb_helpdesk`.`caloser_dateTime`,DATE(`loan_cdb_helpdesk`.`caloser_dateTime`) = DATE(NOW()) AS is_old
 FROM `loan_cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
 WHERE `loan_cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `loan_cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `loan_cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `loan_cdb_helpdesk`.`issue` like  '%".$get_cnic."%' AND
       `loan_cdb_helpdesk`.`entry_branch` = '".$txtuserBranch."' AND
       `loan_cdb_helpdesk`.`entry_department` = '".$txtuserDepartment."'
       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
       
 
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
        // if ($_SESSION['user'] == $rec_det_detels[9]){
        if ($rec_det_detels[18]){
           $MyRow = "background-color:#E6FFFA;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
        /*echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function getNewCompliedDataGrid_informetion_r($get_cnic){
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA; font-size: 11; font-weight: bold;'>
                <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>File Type</span></td>
                <td style='width:120px;text-align: right;'><span style='margin-right: 5px;'>Facility Amount</span></td>
                <td style='width:260px;text-align: left;'><span style='margin-left: 5px;'>Client Information</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
                <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Type</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Enter By</span></td>
                <td style='width:70px;text-align: right;'><span style='margin-right: 5px;'>Assign User</span></td>
                <td style='width:50px;'></td>
            </tr>";
 $v_sql_det_detels = "SELECT `loan_cdb_helpdesk`.`helpid` , DATE(`loan_cdb_helpdesk`.`enterDateTime`), `loan_cdb_helpdesk`.`issue`,`loan_cdb_helpdesk`.`scat_code_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `loan_cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `loan_cdb_helpdesk`.`asing_by` , `loan_cdb_helpdesk`.`cat_code` , `loan_cdb_helpdesk`.`ssb_facility_amount` , `loan_cdb_helpdesk`.`ssb_type`,`loan_cdb_helpdesk`.`help_discr`,IF(`loan_cdb_helpdesk`.`ssb_app_number` = '', 4, `loan_cdb_helpdesk`.`IsAppValid`) as validapp,`loan_cdb_helpdesk`.`ssb_app_number`,`loan_cdb_helpdesk`.`facno`,`loan_cdb_helpdesk`.`caloser_dateTime`,DATE(`loan_cdb_helpdesk`.`caloser_dateTime`) = DATE(NOW()) AS is_old
 FROM `loan_cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`
 WHERE `loan_cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `loan_cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `loan_cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `loan_cdb_helpdesk`.`cmb_code` = '5005' AND
       `loan_cdb_helpdesk`.`issue` like  '%".$get_cnic."%'
       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
       
 
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
        // if ($_SESSION['user'] == $rec_det_detels[9]){
        if ($rec_det_detels[18]){
           $MyRow = "background-color:#E6FFFA;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
        /*echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
    echo "</table>";
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
    
    function getScat_discr_2_Descreption_loan($scat_code_2,$conn){
         $v_sql_getscat_code_2 = "SELECT `product_name` FROM `loan_product` WHERE `product_id` = '".$scat_code_2."';";
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
     
     function getUserNameGenaral_Mob_Eml($user,$conn){
        //return $user;
        $v_sql_getUsreNAme = "SELECT `userID` , `GSMNO` , `email` FROM `user` WHERE `userName` =  '".$user."';";
        $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
        while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
            return $RES_getUsreNAme[0]."\n".$RES_getUsreNAme[1]."\n".$RES_getUsreNAme[2];
        }
     }
?>
