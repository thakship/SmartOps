<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['get_herdIDDtl'])){
    getUserDtl($_REQUEST['get_herdIDDtl']);
}
if(isset($_REQUEST['get_herdIDEdit'])){
    getHeaderDtlEdit($_REQUEST['get_herdIDEdit']);
}

function getUserDtl($herdID){
    // $herdID = 6;
    $conn = DatabaseConnection();
    $sql_select = "SELECT * FROM card_header  AS c WHERE c.HEADER_ID = ".$herdID.";";
    $query_select = mysqli_query($conn,$sql_select) or die(mysqli_error($conn));
    if($query_select){
        $row = mysqli_fetch_assoc($query_select);
    echo "<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>ACCOUNT :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:200px;' name='txt_acc_01' id='txt_acc_01' value='".$row['ACCOUNT_NO_1']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 01' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>&nbsp;</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='20' style='width:200px;' name='txt_acc_02' id='txt_acc_02' value='".$row['ACCOUNT_NO_2']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 02' readonly='readonly'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:200px;' name='txt_acc_03' id='txt_acc_03' value='".$row['ACCOUNT_NO_3']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 03' readonly='readonly'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:200px;' name='txt_acc_04' id='txt_acc_04' value='".$row['ACCOUNT_NO_4']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 04' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>APP RECEIVED DATE :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:100px;' name='txt_App_Received_date' id='txt_App_Received_date' value='".$row['APP_RECEIVED_DATE']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='----/--/--' readonly='readonly'/>&nbsp;&nbsp;
             <label class='linetop'>ACC OPENING DATE : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:100px;' name='txt_Acc_Opening_Date' id='txt_Acc_Opening_Date' value='".$row['ACC_OPENING_DATE']."' onkeypress='return disableEnterKey(event)' readonly='readonly' placeholder='----/--/--'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CLIENT :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='5' style='width:50px;' name='txt_Clint_title' id='txt_Clint_title' value='".$row['CLIENT_TITLE']."' onkeypress='return disableEnterKey(event)' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;' name='txt_Clint_Name' id='txt_Clint_Name' value='".$row['CLIENT_NAME']."' onkeypress='return disableEnterKey(event)' placeholder='Clint Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>EMBOSSING NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Embossing_Name' id='txt_Embossing_Name' value='".$row['EMBOSSING_NAME']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Embossing Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>COLLECTING BRANCH :</label></td>
        <td>
            
             <input type='text' class='box_decaretion' style='width:200px;' name='sel_Collecting_Branch' id='sel_Collecting_Branch' value='".$row['COLLECTING_BRANCH']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/> 
             &nbsp;&nbsp;
             <label class='linetop'>HOME BRANCH : </label>&nbsp;
            <input type='text' class='box_decaretion' style='width:200px;' name='sel_Home_Branch' id='sel_Home_Branch' value='".$row['HOME_BRANCH']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/> 
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CIF :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='12' style='width:100px;' name='txt_cif' id='txt_cif' value='".$row['CIF']."' onkeypress='return disableEnterKey(event)'  placeholder='CIF' readonly='readonly'/>
             <label class='linetop'>NIC : </label>
             <input type='text' class='box_decaretion' maxlength='15' style='width:200px;' name='txt_NIC' id='txt_NIC' value='".$row['NIC']."' onkeypress='return disableEnterKey(event)' placeholder='NIC' readonly='readonly'/>
             <label class='linetop'>DATE OF BIRTH : </label>
             <input type='text' class='box_decaretion' style='width:100px;' name='txt_DOB' id='txt_DOB' value='".$row['DOB']."' onkeypress='return disableEnterKey(event)' placeholder='----/--/--' readonly='readonly'/>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;vertical-align: top;'><label class='linetop'>ADDRESS :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:250px;' name='txt_Permanent_Add_line_01' id='txt_Permanent_Add_line_01' value='".$row['ADDRESS_1']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 01' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;' name='txt_Permanent_Add_line_02' id='txt_Permanent_Add_line_02' value='".$row['ADDRESS_2']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 02' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;' name='txt_Permanent_Add_line_03' id='txt_Permanent_Add_line_03' value='".$row['ADDRESS_3']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 03' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;' name='txt_Permanent_Add_line_04' id='txt_Permanent_Add_line_04' value='".$row['ADDRESS_4']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 04' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;' name='txt_Permanent_Add_line_05' id='txt_Permanent_Add_line_05' value='".$row['ADDRESS_5']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 05' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;' name='txt_Permanent_Add_line_06' id='txt_Permanent_Add_line_06' value='".$row['CITY']."' onkeypress='return disableEnterKey(event)' placeholder='City' readonly='readonly'/><br />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>MOTHER MAIDEN NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Mother_Maiden_Name' id='txt_Mother_Maiden_Name' value='".$row['MOTHER_MAIDEN_NAME']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Mother Maiden Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>MOBILE NUMBER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Mobile_Number' id='txt_Mobile_Number' value='".$row['GSM']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>&nbsp;&nbsp;
             <label class='linetop'>HOME TP : </label>&nbsp;
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Home_TP' id='txt_Home_TP' value='".$row['HOME_GSM']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>SAL PLUS CATEGORY :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:200px;' name='sel_Sal_Plus_Category' id='sel_Sal_Plus_Category' value='".getSAL_PLUS_CATEGORY($conn,$row['SAL_PLUS_CATEGORY_ID'])."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' readonly='readonly'/> 
            
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>PREVIOUS CARD NO. :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_Previous_Card_No' id='txt_Previous_Card_No' value='".$row['PREVIOUS_CARD_NUMBER']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Previous Card No.' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:70px;' name='txt_IntroducerCode' id='txt_IntroducerCode' value='".$row['INTRODUCER']."' onkeypress='return disableEnterKey(event)' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;' name='txt_Introducer_Name' id='txt_Introducer_Name' value='".getUserName($conn,$row['INTRODUCER'])."' onkeypress='return disableEnterKey(event)' placeholder='Introducer Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER BRANCH :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:70px;' name='txt_IntroducerBranchCode' id='txt_IntroducerBranchCode' value='".$row['INTRODUCER_BRANCH']."' onkeypress='return disableEnterKey(event)'  readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:250px;' name='txt_IntroducerBranchName' id='txt_IntroducerBranchName' value='".getBranchName($conn,$row['INTRODUCER_BRANCH'])."' onkeypress='return disableEnterKey(event)'  placeholder='Introducer Branch' readonly='readonly'/>
        </td>
    </tr>
     <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>WITHDRAWAL LIMIT :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:200px;' name='sel_Withdrawal_Limit' id='sel_Withdrawal_Limit' value='".$row['WITHDRAWAL_LIMIT']."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
             
             &nbsp;&nbsp;
             <label class='linetop'>PURCHASING LIMIT : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:200px;' name='txt_PurchasingLimit' id='txt_PurchasingLimit' value='".$row['PURCHASING_LIMIT']."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        </td>
    </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>";
    }
}


function getHeaderDtlEdit($get_herdIDEdit){
     //$get_herdIDEdit = 6;
    $conn = DatabaseConnection();
       $sql_select = "SELECT * FROM card_header  AS c WHERE c.HEADER_ID = ".$get_herdIDEdit.";";
    $query_select = mysqli_query($conn,$sql_select) or die(mysqli_error($conn));
    if($query_select){
        $row = mysqli_fetch_assoc($query_select);
    echo "<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>ACCOUNT :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:250px;background-color: #B6B6B6;' name='txt_acc_01' id='txt_acc_01' value='".$row['ACCOUNT_NO_1']."' onkeypress='return disableEnterKey(event)' placeholder='Account 01' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>&nbsp;</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_02' id='txt_acc_02' value='".$row['ACCOUNT_NO_2']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 02'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_03' id='txt_acc_03' value='".$row['ACCOUNT_NO_3']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 03'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_04' id='txt_acc_04' value='".$row['ACCOUNT_NO_4']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 04'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>APP RECEIVED DATE :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:100px;background-color: #B6B6B6;' name='txt_App_Received_date' id='txt_App_Received_date' value='".$row['APP_RECEIVED_DATE']."' onkeypress='return disableEnterKey(event)' readonly='readonly' placeholder='----/--/--'/>&nbsp;&nbsp;
             <label class='linetop'>ACC OPENING DATE : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:100px;background-color: #B6B6B6;' name='txt_Acc_Opening_Date' id='txt_Acc_Opening_Date' value='".$row['ACC_OPENING_DATE']."' onkeypress='return disableEnterKey(event)' readonly='readonly' placeholder='----/--/--'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CLIENT :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='5' style='width:50px;background-color: #B6B6B6;' name='txt_Clint_title' id='txt_Clint_title' value='".$row['CLIENT_TITLE']."' onkeypress='return disableEnterKey(event)' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;background-color: #B6B6B6;' name='txt_Clint_Name' id='txt_Clint_Name' value='".$row['CLIENT_NAME']."' onkeypress='return disableEnterKey(event)' placeholder='Clint Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>EMBOSSING NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Embossing_Name' id='txt_Embossing_Name' value='".$row['EMBOSSING_NAME']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Embossing Name'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>COLLECTING BRANCH :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Collecting_Branch' id='sel_Collecting_Branch' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
            <option value=''>--Select Collecting Branch --</option>";
             $v_sql_Collecting_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b;";
                $que_Collecting_Branch = mysqli_query($conn,$v_sql_Collecting_Branch);
                while($RES_Collecting_Branch = mysqli_fetch_array($que_Collecting_Branch)){
                    echo "<option value='".$RES_Collecting_Branch[0]."'>".$RES_Collecting_Branch[1]."</option>";
                }
    echo "</select>             
             &nbsp;&nbsp;
             <label class='linetop'>HOME BRANCH : </label>&nbsp;
             <select class='box_decaretion'  style='width: 200px;' name='sel_Home_Branch' id='sel_Home_Branch' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                <option value=''>--Select Home Barnch --</option>";
                    $v_sql_Home_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b;";
                    $que_Home_Branch = mysqli_query($conn,$v_sql_Home_Branch);
                    while($RES_Home_Branch = mysqli_fetch_array($que_Home_Branch)){
                        echo "<option value='".$RES_Home_Branch[0]."'>".$RES_Home_Branch[1]."</option>";
                    }
    echo "</select> 

        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CIF :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='12' style='width:100px;background-color: #B6B6B6;' name='txt_cif' id='txt_cif' value='".$row['CIF']."' onkeypress='return disableEnterKey(event)'  placeholder='CIF' readonly='readonly'/>
             <label class='linetop'>NIC : </label>
             <input type='text' class='box_decaretion' maxlength='15' style='width:200px;background-color: #B6B6B6;' name='txt_NIC' id='txt_NIC' value='".$row['NIC']."' onkeypress='return disableEnterKey(event)' placeholder='NIC' readonly='readonly'/>
             <label class='linetop'>DATE OF BIRTH : </label>
             <input type='text' class='box_decaretion' style='width:100px;background-color: #B6B6B6;' name='txt_DOB' id='txt_DOB' value='".$row['DOB']."' onkeypress='return disableEnterKey(event)' placeholder='----/--/--' readonly='readonly'/>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;vertical-align: top;'><label class='linetop'>ADDRESS :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:250px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_01' id='txt_Permanent_Add_line_01' value='".$row['ADDRESS_1']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 01' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_02' id='txt_Permanent_Add_line_02' value='".$row['ADDRESS_2']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 02' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_03' id='txt_Permanent_Add_line_03' value='".$row['ADDRESS_3']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 03' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_04' id='txt_Permanent_Add_line_04' value='".$row['ADDRESS_4']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 04' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_05' id='txt_Permanent_Add_line_05' value='".$row['ADDRESS_5']."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 05' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_06' id='txt_Permanent_Add_line_06' value='".$row['CITY']."' onkeypress='return disableEnterKey(event)' placeholder='City' readonly='readonly'/><br />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>MOTHER MAIDEN NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Mother_Maiden_Name' id='txt_Mother_Maiden_Name' value='".$row['MOTHER_MAIDEN_NAME']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Mother Maiden Name'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>MOBILE NUMBER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Mobile_Number' id='txt_Mobile_Number' value='".$row['GSM']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/>&nbsp;&nbsp;
             <label class='linetop'>HOME TP : </label>&nbsp;
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Home_TP' id='txt_Home_TP' value='".$row['HOME_GSM']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' />
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>SAL PLUS CATEGORY :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Sal_Plus_Category' id='sel_Sal_Plus_Category' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
            <option value='0'>--Select Sal Plus Category --</option>";
                $sql_SAL = "SELECT cs.SAL_PLUS_CATEGORY_ID , cs.SAL_PLUS_CATEGORY_DIS FROM card_sal_plus_category AS cs;";
                $que_SAL = mysqli_query($conn,$sql_SAL);
                while($RES_SAL = mysqli_fetch_array($que_SAL)){
                    echo "<option value='".$RES_SAL[0]."'>".$RES_SAL[1]."</option>";
                }
    echo "  </select> 
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>PREVIOUS CARD NO. :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_Previous_Card_No' id='txt_Previous_Card_No' value='".$row['PREVIOUS_CARD_NUMBER']."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Previous Card No.'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:70px;background-color: #B6B6B6;' name='txt_IntroducerCode' id='txt_IntroducerCode' value='".$row['INTRODUCER']."' onkeypress='return disableEnterKey(event)' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;background-color: #B6B6B6;' name='txt_Introducer_Name' id='txt_Introducer_Name' value='".getUserName($conn,$row['INTRODUCER'])."' onkeypress='return disableEnterKey(event)' placeholder='Introducer Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER BRANCH :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:70px;background-color: #B6B6B6;' name='txt_IntroducerBranchCode' id='txt_IntroducerBranchCode' value='".$row['INTRODUCER_BRANCH']."' onkeypress='return disableEnterKey(event)'  readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:250px;background-color: #B6B6B6;' name='txt_IntroducerBranchName' id='txt_IntroducerBranchName' value='".getBranchName($conn,$row['INTRODUCER_BRANCH'])."' onkeypress='return disableEnterKey(event)'  placeholder='Introducer Branch' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>WITHDRAWAL LIMIT :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:200px;background-color: #B6B6B6;' name='txt_Pit' id='txt_Pit' value='".$row['WITHDRAWAL_LIMIT']."' onkeypress='return disableEnterKey(event)' readonly='readonly' />";  
     echo "&nbsp;&nbsp;
             <label class='linetop'>PURCHASING LIMIT : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:200px;background-color: #B6B6B6;' name='txt_gLimit' id='txt_gLimit' value='".$row['PURCHASING_LIMIT']."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        </td>
    </tr>
     <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>WITHDRAWAL LIMIT :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Withdrawal_Limit' id='sel_Withdrawal_Limit' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='getPurchasingLimit();'>
            <option value=''>--Select Withdrawal Limit--</option>";
                 $v_sql_W = "SELECT w.WP_ID , w.WITHDRAWAL_LIMIT , w.PURCHASING_LIMIT FROM card_withdrawal_pos_header AS w";
                $que_W = mysqli_query($conn,$v_sql_W);
                while($RES_W = mysqli_fetch_array($que_W)){
                    echo "<option value='".$RES_W[0]."|".$RES_W[2]."|".$RES_W[1]."'>".$RES_W[1]."</option>";
                }
     echo "</select> 
             &nbsp;&nbsp;
             <label class='linetop'>PURCHASING LIMIT : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:200px;background-color: #B6B6B6;' name='txt_PurchasingLimit' id='txt_PurchasingLimit' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        </td>
    </tr>
</table>
<br /><hr />
<input class='buttonManage' style='width: 100px;' type='button' name='btnRequest' id='btnRequest' value='Update' onclick='isRequest();'/>
<div style='display: none;'>
    <input type='text' id='getHeadID' name='getHeadID' value='".$get_herdIDEdit."' onkeypress='return disableEnterKey(event)' />
    <input type='text' id='getCollectingBranch' name='getCollectingBranch' value='".$row['COLLECTING_BRANCH']."' onkeypress='return disableEnterKey(event)' />
    <input type='text' id='getHomeBranch' name='getHomeBranch' value='".$row['HOME_BRANCH']."' onkeypress='return disableEnterKey(event)' />
    <input type='text' id='getSPCI' name='getSPCI' value='".$row['SAL_PLUS_CATEGORY_ID']."' onkeypress='return disableEnterKey(event)' />
</div>

";

    }
    
}


function getUserName($conn,$userID){
    $sql_userName = "SELECT u.userID FROM user AS u WHERE u.userName = '".$userID."';";
    $query_userName = mysqli_query($conn,$sql_userName) or die(mysqli_error($conn));
     if($query_userName){
        $row = mysqli_fetch_assoc($query_userName);
        return $row['userID'];
     }
}

function getBranchName($conn,$branchID){
    $sql_BranchName = "SELECT b.branchName FROM branch AS b WHERE b.branchNumber  = '".$branchID."';";
    $query_BranchName = mysqli_query($conn,$sql_BranchName) or die(mysqli_error($conn));
     if($query_BranchName){
        $row = mysqli_fetch_assoc($query_BranchName);
        return $row['branchName'];
     }
}
   
function getSAL_PLUS_CATEGORY($conn,$SALID){
    $sql_SAL = "SELECT s.SAL_PLUS_CATEGORY_DIS FROM card_sal_plus_category AS s WHERE s.SAL_PLUS_CATEGORY_ID  = '".$SALID."';";
    $query_SAL = mysqli_query($conn,$sql_SAL) or die(mysqli_error($conn));
     if($query_SAL){
        $row = mysqli_fetch_assoc($query_SAL);
        return $row['SAL_PLUS_CATEGORY_DIS'];
     }
} 
?>