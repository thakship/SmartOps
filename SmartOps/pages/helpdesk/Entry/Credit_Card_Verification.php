<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Credit Card Verification
Purpose			: To get user details 
Author			: nilanka Chameera
Date & Time		: 01.53 P.M 16/11/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/065";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card Verification</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
<style type="text/css">
  #outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<!--END Common fumction Libariries-->

<script type="text/javascript"> 
//JAVASCRIPT FUNCTION START............................................................................................................................
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
    
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/Credit_Card_Verification.php?DispName=CreditCard%20Verification','conectpage');
}

function fileSelectNote(hID){
    var mydata1;
    mydata1 = new XMLHttpRequest();
    mydata1.onreadystatechange=function(){
    	if(mydata1.readyState==4){
    		document.getElementById('divNote').innerHTML = mydata1.responseText;
            
    	}
    }
    mydata1.open('GET','ajaxUserVerification.php'+'?getGriedVeriHID='+hID,true);
    mydata1.send();
}    
    
function getData(){
    var idValue = document.getElementById("txt_Help_ID").value;
    var idNIC = document.getElementById("txt_NIC").value;

    var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
             results =  mydata.responseText.split("|");
             if(results[0].trim() == ""){
                alert("Invalied HelpID or NIC");
             }else{
                document.getElementById('txt_Help_ID').value = results[0].trim();
                document.getElementById('txt_Request').value = results[1].trim();
                document.getElementById('txt_Reason').value = results[2].trim();  
                
                var x = document.createElement("A");
                var t = document.createTextNode(results[3].trim());
                x.setAttribute("href", "../../../uploadHelpdesk/"+results[3].trim());
                x.appendChild(t);
                document.getElementById('txt_Attachment').appendChild(x);
                //alert(results[4].trim());
                
                var x1 = document.createElement("A");
                var t1 = document.createTextNode(results[4].trim());
                x1.setAttribute("href", "../../../uploadHelpdesk/"+results[4].trim());
                x1.appendChild(t1);
                document.getElementById('txt_Attachment2').appendChild(x1);
                
                fileSelectNote(results[0].trim());
                  
             }
        }
    }          
    mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_creaditCard.php"+"?getHELPID_REPORT="+idValue+"&geidNIC="+idNIC,true);
    mydata.send();  
    
    
    
  
            //results = http.responseText.split("|");
           // alert(http.responseText);
            //alert(results[0].trim());
          /*  if(results[0].trim() == ""){
                alert('Undefied Help ID.');
                document.getElementById("txt_Help_ID").value = "";
            }else{
                document.getElementById('txt_Help_ID').value = results[0].trim();
                document.getElementById('txt_Request').value = results[1].trim();
                document.getElementById('txt_Reason').value = results[2].trim();
                //alert('A');
                document.getElementById('txt_Solution').value = results[3].trim();
                //alert('B');
                document.getElementById('txt_User_Password').value = results[4].trim();
                document.getElementById('txt_Delivery').innerHTML = results[6].trim();
                
                var x = document.createElement("A");
                var t = document.createTextNode(results[5].trim());
                x.setAttribute("href", "../../../uploadHelpdesk/"+results[5].trim());
                x.appendChild(t);
                
                document.getElementById('txt_Attachment').appendChild(x);
                
                fileSelectNote(results[0].trim());
                
            }*/
            
       
}
//-------------------------------------------------------------------------------------------------------------
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
   $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script>
var metaChar = false;
function keyEvent(event) {
  var key = event.keyCode || event.which;
    if(key == 120){
        //("Key pressed " + key);
        var x = 1; 
       popup(x)
    }
}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>

</p><hr/>
<div style="display: none;">
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
</div>
<span id="maneSpan">
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Help ID :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_Help_ID" id="txt_Help_ID" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" />
    </td>
      <td style="width: 100px; text-align:right;"><label class="linetop">NIC :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_NIC" id="txt_NIC" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" />
    </td> 
   <td>&nbsp;&nbsp;&nbsp;&nbsp;
     <input class="buttonManage" style="width: 80px;" type="button" id="btnSub" name="btnSub" onclick="getData();" value="Submit"/>        
  </td>
  </tr>
    

  
</table>



<hr />
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Request :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:400px;" name="txt_Request" id="txt_Request" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" readonly="readonly" />       
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Description :</label></td>
    <td>
        <textarea class="box_decaretion" cols="90" rows="3" name="txt_Reason" id="txt_Reason" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"></textarea>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Solution  :</label></td>
    <td>
        <textarea class="box_decaretion" cols="90" rows="3" name="txt_Solution" id="txt_Solution" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"></textarea>
    </td>
  </tr>


  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Attachment 1 :</label></td>
    <td>
        <label id="txt_Attachment"></label><label></label> 
    </td>
  </tr>
   <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Attachment 2 :</label></td>
    <td>
        <label id="txt_Attachment2"></label><label></label> 
    </td>
  </tr>

</table>
<br /><hr />
<div id="divNote">
<table border="1" cellpadding="0" cellspacing="0"  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 30px;'>
    <tr style='background-color: #BEBABA;'>
        <td style='width:50px;'>#</td>
        <td style='width:600px;'>Notes</td>
        <td style='width:100px;'>Enterd User</td>
        <td style='width:200px;'>Enterd On</td>
    </tr>   
        
    <tr>
        <td style='width:50px;'>&nbsp;</td>
        <td style='width:600px;'>&nbsp;</td>
        <td style='width:100px;'>&nbsp;</td>
        <td style='width:200px;'>&nbsp;</td>
    </tr>    
</table>
</div>

<br />
<hr />
<div style="margin-left: 10px;">
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageRef();" value="Refresh"/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageClose();" value="Close"/>
</div>
</span>
<!-- ****************************************************************************************************************************************************** -->
<span id="divNote"></span>

</form>
</body>
</html>