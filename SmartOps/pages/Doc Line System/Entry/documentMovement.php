<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Doc Line
Page Name		: Document Movement
Purpose			: traking for facility movemnet  
Author			: Nilanka Chameera
Date & Time		: 10:40 A.M 2018-03-26
 ------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/009";
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
<title>Document Movement</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<style type="text/css">
  
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
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
    <td style="width:150px; text-align:right;"><p class="linetop">Document Number :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtDocNumber" name="txtDocNumber" maxlength="22" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)"/></td>
   
    </td>
    <td>
   <input type="button" id="btnRequestSelection" name="btnRequestSelection" value="Search" onclick="checkSelection()"/>
    <input type="button" id="btnRequestSubmit" name="btnRequestSubmit" value="Save" onclick="submitData()"  disabled="disabled"/>
    
    </td>
  </tr>
</table>

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
    //alert('a');
    var docnumber = document.getElementById('txtDocNumber').value;
    
    if(docnumber != ""){
        mydata = new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                if(mydata.responseText != "Facility Number Invalid"){
                    document.getElementById('loadTable').innerHTML = mydata.responseText;       
                    document.getElementById("btnRequestSubmit").disabled = false;    
                    document.getElementById("btnRequestSubmit").focus();
                }else{
                    document.getElementById('loadTable').innerHTML = mydata.responseText;   
                    document.getElementById("btnRequestSubmit").disabled = true;  
                    //document.getElementById('btnRequestSubmit').focus();
                    
                }
                
            }
        }
        
        mydata.open("GET","ajax_doc_movement.php"+"?get_docnumber="+docnumber,true);
        mydata.send();
    }else{
        alert("Missing Number");
    }

 }
 
 function submitData(){
    //alert('A');
    var doc_number = document.getElementById('txtDocNumber').value.trim();
    var entry_user = document.getElementById('txt_USERMY').value;
    var user_branch = document.getElementById('userBranch').value;
    var user_department = document.getElementById('userDepartment').value;
    
    if(doc_number == ""){
        alert ("Missing Facility Number");
    }else if (entry_user == ""){
            alert ("Undefined Entry User");
    }else if (user_branch == ""){
        alert ("Undefined Branch");
    }else if (user_department == ""){
        alert ("Undefined Department");
    }else {
         var r = confirm('Confirm to Transfer?');
        if (r==true){
            //alert("OK");
        	$.ajax({ 
        		type:'POST', 
        		data: {get_doc_number : doc_number , get_EnrtyUser : entry_user , get_userBranch : user_branch , get_userDepartment : user_department},
         	    url: 'ajax_doc_movement.php', 
            	success: function(getVal) { 
        		    //document.getElementById('err').innerHTML = getVal
                    alert(getVal);
                    checkSelection();
                    /*pageRef();
                    alert('updated success!'); */
        		}
        	});
        }else{
        		//alert('BBBBB');		
        } 
        
    }
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