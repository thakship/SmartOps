<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Confirmation of Nominee Detail Request
Purpose			: Request for Confirmation of Nominee Detail 
Author			: Madushan Wikramaarachchi
Date & Time		: 02.55 P.M 23/01/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/008";
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
<title>Confirmation of Nominee Detail Request</title>
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
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/ConfirmationofNomineeDetailRequest.php?DispName=Confirmation%20of%20Nominee%20Detail%20Request','conectpage');
   }
   function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }    
function isRequest(){
        var txtAccountNo = document.getElementById("txtAccountNo").value;
        var txtContracNo = document.getElementById('txtContracNo').value;
        
        var txtEnrtyUser = document.getElementById("txtMyUserID").value;
        
        if(txtAccountNo == ""){
           alert("Missing Account No.!");     
        }else if(txtContracNo == ""){
            alert("Missing Contract No.!");     
        }else{
            var r = confirm('Confirm to Request?');
            if (r==true){
              		$.ajax({ 
             			type:'POST', 
             			data: {getAccountNo : txtAccountNo , getContracNo : txtContracNo , getEnrtyUser : txtEnrtyUser}, 
             			url: 'ajax_ConfirmationofNomineeDetailRequest.php', 
             			success: function(getVal) { 
             			    //document.getElementById('err').innerHTML = getVal
                            alert(getVal);
                            pageRef()
                           /* pageRef();
                            alert('updated success!'); */
             			}
              		});
            }else{
                    		//alert('BBBBB');		
           	}
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
        <td style="width: 150px; text-align: right;"><label class="linetop">Account No :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="22" style=" width:250px;" name="txtAccountNo" id="txtAccountNo" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
            <label id="lblgetFacName" style="color: #8F270E;"></label>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Contract No :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="4" style=" width:50px;" name="txtContracNo" id="txtContracNo" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
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