<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Re-Generate Letter Request
Purpose			: Re Generate for Letter Printing Entry 
Author			: Madushan Wikramaarachchi
Date & Time		: 12.01 P.M 02/02/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/005";
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
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/Re-GenerateLetterPrintingRequest.php?DispName=Re-Generate%20Letter%20Request','conectpage');
   }
   function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }
    
     function ajaxFunction(e){
    		var http;  // The variable that makes Ajax possible! 
		    var e=e || window.event;
			var keycode=e.which || e.keyCode;
			if(keycode!==13 || (e.target||e.srcElement).value=='') return false;
    		try{ 
        		// Opera 8.0+, Firefox, Safari 
        		http = new XMLHttpRequest(); 
    		}catch(ex){ 
        		// Internet Explorer Browsers 
        		try{ 
					http = new ActiveXObject("Msxml2.XMLHTTP"); 
        		}catch(ex){ 
            		try{ 
                		http = new ActiveXObject("Microsoft.XMLHTTP"); 
            		}catch(ex){ 
                		// Something went wrong 
                		alert("Your browser broke!"); 
                		return false; 
            		}
        		}
    		}
            var txtFacilityNumber = document.getElementById("txtFacilityNumber").value;
            //alert(txtFacilityNumber);
            if(txtFacilityNumber != ""){
                var mydata1;
    			mydata1 = new XMLHttpRequest();
    			mydata1.onreadystatechange=function(){
    				if(mydata1.readyState==4){
    				    if(mydata1.responseText != ""){
    				        document.getElementById('lblgetFacName').innerHTML = mydata1.responseText;
                            document.getElementById('btnRequest').disabled = false;
    				    }else{
    				        alert('Invalid Facility Number or Cannot reprint This documnet');
                            document.getElementById('btnRequest').disabled = true;
    				    }
    					
    				}
    			}
    			//var sub1=document.getElementById('selectCodeDoc').value;
    			mydata1.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?getFacilityNumber="+txtFacilityNumber,true);
    			mydata1.send();
            }
    			
		}  
        
        function isRequest(){
            var txtFacilityNumber = document.getElementById("txtFacilityNumber").value;
            var txtEnrtyUser = document.getElementById("txtMyUserID").value;
            var r = confirm('Confirm to Request?');
            if (r==true){
                //alert("OK");
        		$.ajax({ 
        			type:'POST', 
        			data: {getFacilityNumberRequest : txtFacilityNumber , getEnrtyUser : txtEnrtyUser}, 
        			url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
        			success: function(getVal) { 
  			           alert(getVal);
                       pageRef();
                        //alert('updated success!'); 
        			}
        		});	
            }else{
        		//alert('BBBBB');		
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
        <td style="width: 150px; text-align: right;"><label class="linetop">Facility Number  :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="20" style=" width:250px;" name="txtFacilityNumber " id="txtFacilityNumber" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onkeyup="ajaxFunction(event)" onblur="colourLeave(this.id)"/>
            <label id="lblgetFacName" style="color: #8F270E;"></label>
        </td>
    </tr>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isRequest();" disabled="disabled"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>

</form>
</body>
</html>