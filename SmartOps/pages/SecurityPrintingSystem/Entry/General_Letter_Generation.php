<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: General Letter Generation
Purpose			: Request for general Letter generations
Author			: Nilanka Chameera
Date & Time		: 11.30 A.M 14/01/2019
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/015";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Letter Generation</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>

<!--<b><p style="color:red; font-size:30px;" >SYSTEM DEVELOPMENT IN PROGRESS!</p></b>-->
<span id="sp1" style="display:none"><img src="../../../img/loading.gif" /></span>

<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Letter Type Code :</label></td>
        <td>
        	 <?php
        		$sql_sps_let_types = "SELECT s.LET_ID , s.Letter_Name
                                     FROM sps_general_letter_gen AS s , sps_general_letter_gen_access AS a
                                     WHERE s.letter_status = 1
                                       AND s.LET_ID = a.LET_ID
                                       AND a.user_group = '".$_SESSION['usergroupNumber']."';";
                $quary_sps_let_types = mysqli_query($conn,$sql_sps_let_types);
            ?>
            <select class="box_decaretion" name="sel_sgu_let_types" id="sel_sgu_let_types" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Letter Type--</option>
            <?php
                while ($rec_sps_let_types = mysqli_fetch_array($quary_sps_let_types)) {
                    echo "<option value='".$rec_sps_let_types[0]."'>".$rec_sps_let_types[1]."</option>";
                }
            ?>
            </select>
            <label id="lbl_msg_Letter_Type_Code" style="color: #CA0000;"></label>
        </td>
    </tr>
 

     <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">User Source</label></td>
        <td>
            <span id="span_user_difind">
                <input class="box_decaretion" style="width: 100px;"  name="txt_u_defiend" type="text"  id="txt_u_defiend" onclick="popup(1);" value="<?php echo $_SESSION['user']; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" readonly="readonly"/>
                <label id="lbl_user_name"><?php echo $_SESSION['userID']; ?></label>
            </span>
          
        </td>
    </tr>
</table><br />
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div style="margin-left: 100px;">
     <input class="buttonManage" style="width: 100px;" type="button" name="btnProcess" id="btnProcess" value="Process" onclick="load_Input_form();"/>
     <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
    <label id="getErrorMsg" style="color: #CC0000"></label>
<!-- ****************************************************************************************************************************************************** -->
<div id="getGried"></div>
    <div id="printablediv"></div>
</form>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<!--<script src="../SPS_DEVELOPMENT/JS_General_letter_Generation.js"></script>-->

<script type="text/javascript">
    
    function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
        window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/General_Letter_Generation.php?DispName=General%20Letter%20Generation','conectpage');
    }

    function load_Input_form(){
        var let_id = document.getElementById('sel_sgu_let_types').value;
        
        if(let_id == ''){
            document.getElementById('lbl_msg_Letter_Type_Code').innerHTML = 'Missing Letter Type';
        }else{
            document.getElementById('lbl_msg_Letter_Type_Code').innerHTML = '';
            //console.log(let_id);
            var mydata1 = new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('getGried').innerHTML = mydata1.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydata1.open("GET","ajax_general_Letter_Generation.php"+"?get_let_id_header="+let_id,true);
			mydata1.send();
        }
    }

   function receiptPrint(){
       var prtContent = document.getElementById("printablediv");
       // execute check expiration code
       var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
       WinPrint.document.write(prtContent.innerHTML);
       WinPrint.document.close();
       WinPrint.focus();
       WinPrint.print();
       WinPrint.close();
       pageClose();

   }
   
function isCashBackedLoansAPR(){
      // alert('Function OK');
        //console.log('Function OK');
    var fac_numberCB = document.getElementById('txtDepositNumber').value;
    var ContractNo = document.getElementById('txtContractNo').value;
    var CashBackAmount = document.getElementById('txtCashBackAmount').value;
    var loguser = document.getElementById('txt_u_defiend').value;
    if(fac_numberCB == ""){
        document.getElementById('lbl_1').innerHTML = 'Missing Deposit Number';
    }else if(ContractNo == ""){
        document.getElementById('lbl_2').innerHTML = 'Missing Contract Number';
    }else if(CashBackAmount == ""){
        document.getElementById('lbl_3').innerHTML = 'Missing Cashback Amount';
    }else{
        //alert(loguser);
       // console.log(loguser);
      //console.log('A');
     //   console.log(loguser);
        var r = confirm('Are you sure you want to Process this?');
        if (r == true) {
            
            $.ajax({
                type: 'POST',
                data: {get_fac_numberCB : fac_numberCB, get_ContractNo : ContractNo , get_CashBackAmount : CashBackAmount  ,get_loguser : loguser , setTitle: 'cashbackloan_APP'},
                url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php',
                success: function (val_retn) {
                   
                    if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('printablediv').innerHTML = val_retn;
                        receiptPrint();
                    }
                }
            });
        }
    }
}

function isLeaseAgreementProcess(){
    //alert("A");
    //console.log('Function OK');
    var fac_number = document.getElementById('txtLeaseAgreementFacilityNumber').value;
    var get_date = document.getElementById('empappodate1').value;
    var loguser = document.getElementById('txt_u_defiend').value;
    if(fac_number == ""){
        document.getElementById('lblMsgLeaseAgreementFacilityNumber').innerHTML = 'Missing Facility Number';
    }else if(get_date == ""){
        document.getElementById('lbl_2').innerHTML = 'Missing On Date';
    }else{
        var r = confirm('Are you sure you want to Process this?');
        if (r == true) {
            $.ajax({
                type: 'POST',
                data: {get_fac_number : fac_number, get_loguser : loguser , setTitle: 'leaseAgreement' , isget_date : get_date},
                url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php',
                success: function (val_retn) {
                   // alert(val_retn);
                   
                    if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('printablediv').innerHTML = val_retn;
                        receiptPrint();
                    }
                }
            });
        }
    }
}

function isLeaseAgreementStructure(){
    alert("isLeaseAgreementStructure");
    //console.log('Function OK');
    var fac_number = document.getElementById('txtLeaseAgreementFacilityNumber').value;
    var get_date = document.getElementById('empappodate1').value;
    var loguser = document.getElementById('txt_u_defiend').value;
    if(fac_number == ""){
        document.getElementById('lblMsgLeaseAgreementFacilityNumber').innerHTML = 'Missing Facility Number';
    }else if(get_date == ""){
        document.getElementById('lbl_2').innerHTML = 'Missing On Date';
    }else{
        var r = confirm('Are you sure you want to Process this?');
        if (r == true) {
            $.ajax({
                type: 'POST',
                data: {get_fac_number : fac_number, get_loguser : loguser , setTitle: 'leaseStructure' , isget_date : get_date},
                url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php',
                success: function (val_retn) {
                   // alert(val_retn);
                   
                    if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('printablediv').innerHTML = val_retn;
                        receiptPrint();
                    }
                }
            });
        }
    }
}

function isLeaseAgreementCorporate(){
    alert("isLeaseAgreementCorporate");
    //console.log('Function OK');
    var fac_number = document.getElementById('txtLeaseAgreementFacilityNumber').value;
    var get_date = document.getElementById('empappodate1').value;
    var loguser = document.getElementById('txt_u_defiend').value;
    if(fac_number == ""){
        document.getElementById('lblMsgLeaseAgreementFacilityNumber').innerHTML = 'Missing Facility Number';
    }else if(get_date == ""){
        document.getElementById('lbl_2').innerHTML = 'Missing On Date';
    }else{
        var r = confirm('Are you sure you want to Process this?');
        if (r == true) {
            $.ajax({
                type: 'POST',
                data: {get_fac_number : fac_number, get_loguser : loguser , setTitle: 'leaseCorporate' , isget_date : get_date},
                url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php',
                success: function (val_retn) {
                   // alert(val_retn);
                   
                    if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('printablediv').innerHTML = val_retn;
                        receiptPrint();
                    }
                }
            });
        }
    }
}
function getDateCal(){
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
}

</script>
<script>
  /*$(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });*/
</script>
</body>

</html>