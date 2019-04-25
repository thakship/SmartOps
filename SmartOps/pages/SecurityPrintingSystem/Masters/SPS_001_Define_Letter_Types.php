<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Define Letter Types
Purpose			: This process define letter types with a unique letter type code.
Author			: Madushan Wikramaarachchi
Date & Time		: 09.58 A.M 08/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/m/001";
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
<title>Define Letter Types</title>
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
            var idValue = document.getElementById("txtLetterTypeCode").value;
            var myRandom = parseInt(Math.random()*99999999);  // cache buster
            http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&rand=" + myRandom, true);
            http.onreadystatechange = handleHttpResponse;
            http.send(null);
         	function handleHttpResponse(){
            	if (http.readyState == 4){
                	results = http.responseText.split(",");
                    document.getElementById('txtLetterTypeCode').value = results[0].trim();
                    document.getElementById('txtDescription').value = results[1].trim();
                    document.getElementById('txtNumOfSig').value = results[2].trim();
                }
            } 
		}
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Letter Type Code :</label></td>
    <td>
    	<input type="text" maxlength="6" class="box_decaretion" style=" width:80px;" name="txtLetterTypeCode" id="txtLetterTypeCode" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)"  required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 150px;text-align: right;"><label class="linetop">Description :</label></td>
    <td>
    	<input type="text" maxlength="30" class="box_decaretion"  style=" width:300px;" name="txtDescription" id="txtDescription" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
    </td>
  </tr>
   <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Num. of Signatories :</label></td>
    <td>
    	<input type="text" maxlength="2" class="box_decaretion"  style=" width:40px;" name="txtNumOfSig" id="txtNumOfSig" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
    </td>
  </tr>
</table>
<div style="display: none;">
    <input type="text" id="txtUserID" name="txtUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<div style="margin-left: 100px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnAdd" id="btnAdd" value="Save" title="1" onclick="isCheckFromDefineLetterTypes(title)"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnModify" id="btnModify" value="Modify" title="2" onclick="isCheckFromDefineLetterTypes(title)"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnDelete" id="btnDelete" value="Delete" title="3" onclick="isCheckFromDefineLetterTypes(title)"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<?php
        echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
            	<tr style='background-color: #BEBABA;'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Letter Type Code</span></td>
                <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>Description</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Num. of Sig.</span></td>
            </tr>";
        $getsql = "SELECT `TYPE_CODE`, `TYPE_DESC`, `NUM_OF_SIG` FROM `sps_let_types`";
        $query = mysqli_query($conn, $getsql) or die(mysqli_error());
        while($RES_sql = mysqli_fetch_assoc($query)){
             echo "<tr>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_sql['TYPE_CODE']."</span></td>
                        <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>".$RES_sql['TYPE_DESC']."</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_sql['NUM_OF_SIG']."</span></td>
                    </tr>";
        }
        echo "</table>";
?>
</form>
</body>
</html>

