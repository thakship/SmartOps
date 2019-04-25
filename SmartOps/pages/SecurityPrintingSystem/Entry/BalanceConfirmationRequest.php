<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Balance Confirmation Request
Purpose			: Re Generate for Balance Confirmation 
Author			: Madushan Wikramaarachchi
Date & Time		: 12.01 P.M 12/04/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/007";
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
<title>Balance Confirmation Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/BalanceConfirmationRequest.php?DispName=Balance%20Confirmation%20Request','conectpage');
   }
   function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }    
function isRequest(){
        var txtClientCode = document.getElementById("txtClientCode").value;
        var txtEnrtyUser = document.getElementById("txtMyUserID").value;
        var sel_Embassy = document.getElementById("sel_Embassy").value;
        var CusName = document.getElementById("txtCustom_Address1").value;
        var txtCustom_Address1 = document.getElementById("txtCustom_Address2").value;
        var txtCustom_Address2 = document.getElementById("txtCustom_Address3").value;
        var txtCustom_Address3 = document.getElementById("txtCustom_Address4").value;
        var txtCustom_Address4 = document.getElementById("txtCustom_Address5").value;
        var getJointPartyDetails = 0;
        var getCashBackedLoanOutstanding = 0;
        var getRedemptionCapability = 0;
        var getchkNomineeDetails = 0;
      //  var Nic_Number = document.getElementById("Nic_Number").value;
     //   var Individual_Client_Code = document.getElementById("Individual_Client_Code").value;
    //    var Joint_Client_Code = document.getElementById("Joint_Client_Code").value;
        
        if(document.getElementById("chkJointPartyDetails").checked == true){
                    getJointPartyDetails = 1;
        }
        if(document.getElementById("chkCashBackedLoanOutstanding").checked == true){
            getCashBackedLoanOutstanding = 1;
        }
        if(document.getElementById("chkRedemptionCapability").checked == true){
            getRedemptionCapability = 1;
        }
        if(document.getElementById("chkNomineeDetails").checked == true){
            getchkNomineeDetails = 1;
        }
        var getList = document.getElementById('sel_DocumentType').value;
        
        if(getList == 1){
            if(sel_Embassy != ""){    
                   // alert(txtClientCode+" "+txtEnrtyUser+" "+getJointPartyDetails+" "+getCashBackedLoanOutstanding+" "+getRedemptionCapability+" "+getchkNomineeDetails+" "+sel_Embassy);
                    
                    var r = confirm('Confirm to Request?');
                    if (r==true){
                        alert("OK");
                  		$.ajax({ 
                 			type:'POST', 
                 			data: {settxtClientCode : txtClientCode , setEnrtyUser : txtEnrtyUser , setJointPartyDetails : getJointPartyDetails , setCashBackedLoanOutstanding : getCashBackedLoanOutstanding , setRedemptionCapability : getRedemptionCapability , setchkNomineeDetails : getchkNomineeDetails , setsel_Embassy : sel_Embassy , getCusName : CusName , gettxtCustom_Address1 : txtCustom_Address1 , gettxtCustom_Address2 : txtCustom_Address2 , gettxtCustom_Address3 : txtCustom_Address3 , gettxtCustom_Address4 : txtCustom_Address4 , getgetList : getList}, 
                 			url: 'ajax_balanceConfrmationRequest.php', 
                 			success: function(getVal) { 
                 			    //document.getElementById('err').innerHTML = getVal
                                alert(getVal);
                                pageRef();
                                alert('updated success!'); 
                 			}
                  		});
                    }else{
                    		//alert('BBBBB');		
                   	} 
           }else{
                alert("select Embassy.");
           } 
        }else if(getList == 2){
                    var r = confirm('Confirm to Request?');
                    if (r==true){
                        alert("OK");
                  		$.ajax({ 
                 			type:'POST', 
                 			data: {settxtClientCode : txtClientCode , setEnrtyUser : txtEnrtyUser , setJointPartyDetails : getJointPartyDetails , setCashBackedLoanOutstanding : getCashBackedLoanOutstanding , setRedemptionCapability : getRedemptionCapability , setchkNomineeDetails : getchkNomineeDetails , setsel_Embassy : sel_Embassy , getCusName : CusName , gettxtCustom_Address1 : txtCustom_Address1 , gettxtCustom_Address2 : txtCustom_Address2 , gettxtCustom_Address3 : txtCustom_Address3 , gettxtCustom_Address4 : txtCustom_Address4 , getgetList : getList}, 
                 			url: 'ajax_balanceConfrmationRequest.php', 
                 			success: function(getVal) { 
                 			    //document.getElementById('err').innerHTML = getVal
                                alert(getVal);
                                pageRef();
                                alert('updated success!'); 
                 			}
                  		});
                    }else{
                    		//alert('BBBBB');		
                   	}  
        }else if(getList == 3){
           // alert(CusName+ " "+ txtCustom_Address1 + " " + txtCustom_Address2 + " " + txtCustom_Address3 + " " + txtCustom_Address4);
            if(CusName != "" && txtCustom_Address1 != "" && txtCustom_Address2 != ""){    
                   // alert(txtClientCode+" "+txtEnrtyUser+" "+getJointPartyDetails+" "+getCashBackedLoanOutstanding+" "+getRedemptionCapability+" "+getchkNomineeDetails+" "+sel_Embassy);
                    
                    var r = confirm('Confirm to Request?');
                    if (r==true){
                        alert("OK");
                  		$.ajax({ 
                 			type:'POST', 
                 			data: {settxtClientCode : txtClientCode , setEnrtyUser : txtEnrtyUser , setJointPartyDetails : getJointPartyDetails , setCashBackedLoanOutstanding : getCashBackedLoanOutstanding , setRedemptionCapability : getRedemptionCapability , setchkNomineeDetails : getchkNomineeDetails , setsel_Embassy : sel_Embassy , getCusName : CusName , gettxtCustom_Address1 : txtCustom_Address1 , gettxtCustom_Address2 : txtCustom_Address2 , gettxtCustom_Address3 : txtCustom_Address3 , gettxtCustom_Address4 : txtCustom_Address4 , getgetList : getList}, 
                 			url: 'ajax_balanceConfrmationRequest.php', 
                 			success: function(getVal) { 
                 			    //document.getElementById('err').innerHTML = getVal
                                alert(getVal);
                                pageRef();
                                alert('updated success!'); 
                 			}
                  		});
                    }else{
                    		//alert('BBBBB');		
                   	} 
           }else{
                alert("Missing Custom Detels.");
           } 
        }       
        else{
            alert("Select Document Type.");
        }
}
    
    function changeInterface(){
        var getList = document.getElementById('sel_DocumentType').value;
        if(getList == 1){
            document.getElementById("tr_Embassy").style.display = "table-row";
            document.getElementById("tr_Cos").style.display = "none";
          //  document.getElementById("tr_Cos1").style.display = "none";
        } else if( getList == 3){
            document.getElementById("tr_Embassy").style.display = "none";
            document.getElementById("tr_Cos").style.display = "table-row";
         //   document.getElementById("tr_Cos1").style.display = "none";
        }
        else{
            document.getElementById("tr_Embassy").style.display = "none";
            document.getElementById("tr_Cos").style.display = "none";
          //  document.getElementById("tr_Cos1").style.display = "none";
        }
    }
</script>


</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div>
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Client Code:</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="10" style=" width:250px;" name="txtClientCode " id="txtClientCode" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
            <label id="lblgetFacName" style="color: #8F270E;"></label>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Document Type:</label></td>
        <td>
            <select class="box_decaretion"  style="width: 200px;" name="sel_DocumentType" id="sel_DocumentType" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="changeInterface();">
            <option value="1">Embassy Document Type</option>
            <option value="2">Clint Document Type</option>
            <option value="3">Custom Document Type</option>
      <!---     <option value="4">With Holding Tax</option> -->
            
         </select>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Instruction :</label></td>
        <td>
             <span style="display: none;"> <input type="checkbox" class="box_decaretion" style="border: #FFFFFF solid 1px;" id="chkJointPartyDetails" name="chkJointPartyDetails" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>&nbsp;&nbsp;&nbsp;&nbsp;: Joint Party Details<br /></span>
             
             <input type="checkbox" class="box_decaretion" id="chkCashBackedLoanOutstanding" name="chkCashBackedLoanOutstanding" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>&nbsp;&nbsp;&nbsp;&nbsp;: Cash Backed Loan Outstanding<br />
             
             <input type="checkbox" class="box_decaretion" id="chkRedemptionCapability" name="chkRedemptionCapability" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>&nbsp;&nbsp;&nbsp;&nbsp;: Redemption Capability<br />
             
            <span style="display: none;"> <input type="checkbox" class="box_decaretion" id="chkNomineeDetails" name="chkNomineeDetails" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>&nbsp;&nbsp;&nbsp;&nbsp;: Nominee Details</span>
        </td>
        </td>
    </tr>
    <tr id="tr_Embassy">
        <td style="width: 150px; text-align: right;"><label class="linetop">Embassy :</label></td>
        <td>
            <?php
        		$sql_Embassy = "SELECT e.embassy_id , e.embasy_N FROM sps_embassy AS e WHERE e.stats = 1;";
                $quary_Embassy = mysqli_query($conn,$sql_Embassy);
            ?>
            <select class="box_decaretion" name="sel_Embassy" id="sel_Embassy" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Embassy--</option>
            <?php
                while ($rec_Embassy = mysqli_fetch_array($quary_Embassy)) {
                    echo "<option value='".$rec_Embassy[0]."'>".$rec_Embassy[1]."</option>";
                }
            ?>
            </select>
        </td>
    </tr>
    <tr id="tr_Cos" style="display: none;">
        <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Custom Address:</label></td>
        <td>
            <input type="text" class="box_decaretion" style=" width:250px;" name="txtCustom_Address1" id="txtCustom_Address1" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Name"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="txtCustom_Address2" id="txtCustom_Address2" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Address 1"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="txtCustom_Address3" id="txtCustom_Address3" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Address 2"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="txtCustom_Address4" id="txtCustom_Address4" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Address 3"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="txtCustom_Address5" id="txtCustom_Address5" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Address 4"/>
        </td>
    </tr>
    
    <!--  <tr id="tr_Cos1" style="display: none;">
        <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Client Details:</label></td>
        <td>
            <input type="text" class="box_decaretion" style=" width:250px;" name="Nic_Number" id="Nic_Number" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="NIC1"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="Individual_Client_Code" id="Individual_Client_Code" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="IndividualClientCode1"/><br />
            <input type="text" class="box_decaretion" style=" width:250px;margin-top: 3px;" name="Joint_Client_Code" id="Joint_Client_Code" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="JointClientCode1"/><br />
            
        </td>-->
    </tr>  
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isRequest();"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>

</form>
</body>
</html>