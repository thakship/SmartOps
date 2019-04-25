<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: My Booking Cancellation
Purpose			: To Booking cancellation
Author			: Madushan Wikramaarachchi
Date & Time		: 4:12 AM 22/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/e/005";
	$_SESSION['Module'] = "Leisure";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Leisure_DEVELOPMENT/PHP_FUNCTION/leisure_system_php_function.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Booking Cancellation</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<style type="text/css">
.linetop{
    color: #FFFFFF;
    font-family: sans-serif;
    font-size: 12px;
    text-align: right;
    width: 150px;
}
</style>
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
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
			var url = "getagentids.php?param1=";
            var idValue = document.getElementById("txtBookingId").value;
            var idUser = document.getElementById("txtUser").value;
				var myRandom = parseInt(Math.random()*99999999);  // cache buster
				http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&param3=" +  escape(idUser) + "&rand=" + myRandom, true);
				http.onreadystatechange = handleHttpResponse;
				http.send(null);
				function handleHttpResponse(){
					if (http.readyState == 4){
						results = http.responseText.split(",");
                        if(idUser ==results[1].trim()){
    						document.getElementById('txtBookingId').value = results[0].trim();
    						document.getElementById('txtUserID').value = results[1].trim();
    						document.getElementById('txtFromDate').value = results[2].trim();
    						document.getElementById('txtToDate').value = results[3].trim();
    						document.getElementById('txtNumOfRoom').value = results[4].trim();
    						document.getElementById('txtNumOfAdult').value = results[5].trim();
    						document.getElementById('txtNumOfChi').value = results[6].trim();
    						if(results[0].trim()==""){
    							document.getElementById('txtBookingId').value = idValue;	
    						}
                        }else{
                            alert("Your booking ID is invalid !"); 
    						document.getElementById('txtUserID').value = "";
    						document.getElementById('txtFromDate').value = "";
    						document.getElementById('txtToDate').value = "";
    						document.getElementById('txtNumOfRoom').value = "";
    						document.getElementById('txtNumOfAdult').value = "";
    						document.getElementById('txtNumOfChi').value = "";
                        }
					}
				}
    }
        
    function get_cansaletion(){
        var V_book_id = document.getElementById('txtBookingId').value;
        var V_userID = document.getElementById('txtUserID').value;
        var V_userA = document.getElementById('txtUser').value;
        var V_cancelRemarks = document.getElementById('cancelRemarks').value;
       // alert(V_book_id + " | " + V_userID + " | " + V_userA );
       if(V_book_id != "" && V_userID != "" && V_userA != ""){
            var r = confirm('Booking cancellation confirmation?')
            if (r==true){
                //alert('R : YES');
    			$.ajax({ 
    				type:'POST', 
    				data: {B_id : V_book_id,u_id:V_userID,a_id:V_userA,cancelRemarks:V_cancelRemarks}, 
    				url: 'ajax_mybookingCancellation.php', 
    				success: function() { 
    				alert('Booking Cancelled.'); 
                    pageClose();
    				}
    			});	   
            }else{
    			//alert('R : NO');		
    		}
       }else{
           	alert('Booking ID should not be blank.');  
       }
        
    }
</script>
<!-- Ends  function here -->

</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
      <tr>
        <td style="width:150px;"><p class="linetop">Booking ID :</p></td>
        <td>
            <input style="width: 100px;" type="text" maxlength="8" class="box_decaretion" name="txtBookingId" id="txtBookingId" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)"/>
        </td>
      </tr>
      <tr>
        <td style="width:150px;"><p class="linetop">User ID :</p></td>
        <td>
            <input style="width: 100px;" type="text" class="box_decaretion" name="txtUserID" id="txtUserID" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
      </tr>
</table>
<table>
      <tr>
        <td style="width:150px;"><p class="linetop">Booking Dates :</p></td>
        <td>
            <input style="width: 100px;" type="text" class="box_decaretion" name="txtFromDate" id="txtFromDate" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
        
        <td>
            <input style="width: 100px;" type="text" class="box_decaretion" name="txtToDate" id="txtToDate" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
      </tr>
</table>
<table>
      <tr>
        <td style="width:150px;"><p class="linetop">Number of Rooms :</p></td>
        <td>
            <input style="width: 50px;" type="text" class="box_decaretion" name="txtNumOfRoom" id="txtNumOfRoom" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
      </tr>
</table>
<table>
        <td style="width:150px;"><p class="linetop">Number Of Adults:</p></td>
        <td style="width:30px;">
            <input style="width: 50px;" type="text" class="box_decaretion" name="txtNumOfAdult" id="txtNumOfAdult" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
        <td style="width:40px;"  valign="bottom"><p class="linetop" style="width:60px; text-align: left; ;">Children :</p></td>
        <td>
            <input style="width: 50px;" type="text" class="box_decaretion" name="txtNumOfChi" id="txtNumOfChi" value="" onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
        </td>
      </tr>
</table>
<table>
      <tr>
        <td style="width:150px; vertical-align: top;"><p class="linetop">Cancellation Remarks:</p></td>
        <td>
            <textarea style="350px" cols="64" rows="5"  name="cancelRemarks" id="cancelRemarks" onKeyPress="return disableEnterKey(event)"></textarea>
        </td>
      </tr>
</table>
<div style='display:none;'>
    <input type='text' name='txtUser' id='txtUser' value='<?php echo  $_SESSION['user']; ?>'/>
</div>
<br />
<input type="button" class="buttonManage" style="width: 100px; margin-left: 165px;" name="btnlp" id="btnlp" value="Save" onclick="get_cansaletion()"  />
<input type="button" class="buttonManage" style="width: 100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>
