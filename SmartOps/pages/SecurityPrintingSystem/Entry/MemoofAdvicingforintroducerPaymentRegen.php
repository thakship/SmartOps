<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Memo of Advicing for introducer Payment Regen
Purpose			: For Generate introducer Payment
Author			: Madushan Wikramaarachchi
Date & Time		: 2018-08-08 15:57
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/010";
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
<title>Letter Printing</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/Memo_of_Advicing_for_introducer_Payment.php?DispName=Memo%20of%20Advicing%20for%20introducer%20Payment','conectpage');
   }
   
        function isRequest(){
            //alert('A');
            var txtFacilityNumber = document.getElementById("txtFacilityNumber").value;
            var txtEnrtyUser = document.getElementById("txtMyUserID").value;
            
            
                getdata= new XMLHttpRequest();
                getdata.onreadystatechange=function(){
                    if(getdata.readyState==4){
                         //alert('B');
                         //alert(getdata.responseText);
                        if(getdata.responseText == "NO"){
                            alert('Invalied Facility Number.');
                        }else if(getdata.responseText == "COPY"){
                             alert('Copy has been printed.');
                        }else{
                            document.getElementById('GenLet').innerHTML = getdata.responseText;     
                            receiptPrint();
                            
                        }
                        
                    }
                }
                getdata.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php"+"?getFacilityNumberREGENMIP="+txtFacilityNumber+"&getEnrtyUserREGENMIP="+txtEnrtyUser,true);
                getdata.send();
            //alert("C");
        }
        
        // for get the print of the introducer Payment
        
        function receiptPrint(){   
        var prtContent = document.getElementById("GenLet");
        // execute check expiration code
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
        pageClose();      
                           
    }
    function getprintCopy(){
		var prtContent = document.getElementById("GenLet");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
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
        <td style="width: 150px; text-align: right;"><label class="linetop">Facility Number  :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="20" style=" width:250px;" name="txtFacilityNumber " id="txtFacilityNumber" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onkeyup="ajaxFunction(event)" onblur="colourLeave(this.id)"/>
            <label id="lblgetFacName" style="color: #8F270E;"></label>
        </td>
    </tr>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Generate" onclick="isRequest();" />
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="GenLet" style="display: none;">
</div>

</form>
</body>
</html>