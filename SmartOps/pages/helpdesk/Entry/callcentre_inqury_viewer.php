<!------------------------------------------------------------------------------------------------------------------------
Module Code		: helpdesk
Page Name		: Call Centre inquary viewer
Purpose			: Tracking Call centre details 
Author			: Nilanka Chameera
Date & Time		: 10:29 A.M 2018-03-27
 ------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/045";
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
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Call Centre inquary viewer</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
  <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<style type="text/css">
  
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/contextMenu.js-master/contextMenu.min.js"></script>

<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>

</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<form action="" method="post">
<table>
  <tr>
    <td style="width:150px; text-align:right;"><p class="linetop">Help ID :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txthelpid" name="txthelpid" maxlength="22" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" /></td>
    <td style="width:150px; text-align:right;"><p class="linetop">Facility Number :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="facNumber" name="facNumber" maxlength="22" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" /></td>
    <td style="width:150px; text-align:right;"><p class="linetop">CIF Code :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="cif" name="cif" maxlength="22" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" /></td>
   
  </tr>
</table>
  
   <input type="button"  id="btnRequestSelection" name="btnRequestSelection" value="Search" onclick="checkSelection()"/>
   
  
  
<hr />
<div style="display: none;">
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
    <input type="text" name="userBranch" id="userBranch" value="<?php echo  $_SESSION['userBranch']; ?>" />
    <input type="text" name="userDepartment" id="userDepartment" value="<?php echo  $_SESSION['userDepartment']; ?>" />
    
</div>

<div id="loadTable"></div>

<script type="text/javascript">
 function checkSelection(){
  //  alert('a');
    var helpid = document.getElementById('txthelpid').value;
    var facNumber = document.getElementById('facNumber').value;
    var cif = document.getElementById('cif').value;
    
  
        var mydata = new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('loadTable').innerHTML = mydata.responseText;       
            }
        }
        
        mydata.open("GET","ajax_callcentre_inqury_viewer.php"+"?get_helpid="+helpid+"&get_facNumber="+facNumber+"&get_cif="+cif,true);
        mydata.send();
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
    //alert("A");
    checkSelection();
    
    
}

</script>

</form>
</body>
</html>