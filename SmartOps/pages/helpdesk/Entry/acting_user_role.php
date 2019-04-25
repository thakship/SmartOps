<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Acting User Role
Purpose			: To give Acting User Role 
Author			: Madushan Wikramaarachchi
Date & Time		: 02.06 P.M 07/03/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/015";
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
<title>User Transfer Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<!--END Common fumction Libariries-->
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

<script type="text/javascript"> 
//JAVASCRIPT FUNCTION START............................................................................................................................
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
    
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/acting_user_role.php?DispName=Acting%20User%20Role','conectpage');
}
function popup(x){
    if(x==1){
    	var mydataGried;
    	mydataGried= new XMLHttpRequest();
    	mydataGried.onreadystatechange=function(){
    		if(mydataGried.readyState==4){
    			document.getElementById('getGried').innerHTML=mydataGried.responseText;  
    			document.getElementById('outer').style.visibility = "visible";
    			document.getElementById('conten').style.visibility = "visible";           
    		}
    	}
    	mydataGried.open("GET","ajax_Griedsub.php"+"?sr_gried="+x,true);
    	mydataGried.send();
    	/*document.getElementById('outer').style.visibility = "visible";
    	document.getElementById('conten').style.visibility = "visible";*/
    
    }else{
    document.getElementById('outer').style.visibility = "hidden";
    document.getElementById('conten').style.visibility = "hidden";
    }	
}
function fileSelect(){
    var mydata5;
    mydata5= new XMLHttpRequest();
    mydata5.onreadystatechange=function(){
    	if(mydata5.readyState==4){
    		document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
    	}
    }
    var searchup=document.getElementById('popupsearch').value;
    mydata5.open('GET','ajaxEntryPopu1sub.php'+'?txtsearch='+searchup,true);
    mydata5.send();
}
function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_To_Branch').value = id1;
			document.getElementById('toBranch').innerHTML = id2;
}

function getSubmit(){
    //alert('OK');
    var txt_User_ID = document.getElementById('txt_User_ID').value;
    var txt_Requested_User = document.getElementById('txt_Requested_User').value; 
    var txt_Currant_User_Role = document.getElementById('txt_Currant_User_Role').value; 
    var empappodate1 = document.getElementById('empappodate1').value;
    var timeformatExample1 = document.getElementById('timeformatExample1').value;
    var empappodate2 = document.getElementById('empappodate2').value;
    var timeformatExample2 = document.getElementById('timeformatExample2').value;
    var txt_Request_User_Role = document.getElementById('txt_Request_User_Role').value;
    var txt_Reason = document.getElementById('txt_Reason').value;
    var txt_Currant_User_Role_dis = document.getElementById('txt_Currant_User_Role_dis').value; 
    var txt_Currant_br = document.getElementById('txt_Currant_br').value; 
    var lbl_user = document.getElementById('lbl_user').innerHTML;
    var log_user = document.getElementById('txt_USERMY').value;
    //alert(txt_Currant_br);
    var chk_current_role = 1;
    
    if(document.getElementById("chk_current_role").checked == true){
        chk_current_role = 1;
    }else{
        chk_current_role = 0;
    }
    
    var today = new Date();
    var dd = today.getDate(); //alert('date - '+dd);
    var mm = today.getMonth()+1; //January is 0! //
   // alert(today.getMonth());
    var yyyy = today.getFullYear();
    
    var hh = today.getHours();
    var min = today.getMinutes();
    var ss = today.getSeconds();
    if(ss < 10){
        ss = '0'+ss;
    }
    if(min < 10){
        min = '0'+min;
    }
    if(hh < 10){
        hh = '0'+hh;
    }
    var totime = hh+':'+min+':'+ss;
    
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = yyyy+'-'+mm+'-'+dd;//alert(today);
    var nowDateTime = today+' '+totime;
   
    if(txt_User_ID == ""){
        alert('Missing User ID.');
        
    }else if(txt_Requested_User == ""){
        alert('Undifind Your loging.');
    }else if(empappodate1 == ""){
        alert('Missing From Date.');
    }else if(timeformatExample1 == "" ){
        alert('Missing From Time.');
    }else if(empappodate2 == ""){
        alert('Missing To Date.');
    }else if(timeformatExample2 == "" ){
        alert('Missing To Time.');
    }else if(txt_Request_User_Role == ""){
        alert('Select Request User Role.');
    }else if(txt_Currant_User_Role == ""){
        alert('Current User role canot be blank.');
    }else if(txt_Reason == ""){
        alert('Missing Reason for Reason.');
    }else if(today > empappodate1){
        alert("From Date must be in the future");
    }else if(today > empappodate2){
        alert("To Date must be in the future");
    }else if(empappodate1 > empappodate2){
        alert("To Date is Invalied.");
    }else if(txt_Currant_User_Role == txt_Request_User_Role){
        alert("Currant User Role and Request User Role is same.");
    }else{
        RegEx = "\([0-2][0-9]):([0-5][0-9])$";
        if (Regs1 = timeformatExample1.match(RegEx)) {
            //alert(Regs1[1]);
            if (Regs2 = timeformatExample2.match(RegEx)) {
                //alert(Regs2[1]);
                if((Regs1[1] > 23)) {
                    alert('Invalied hours . Using 24 hours format');
                    document.getElementById('timeformatExample1').value = "";
                    document.getElementById('timeformatExample1').focus();
                }else if((Regs2[1] > 23)){
                    alert('Invalied hours . Using 24 hours format');
                    document.getElementById('timeformatExample2').value = "";
                    document.getElementById('timeformatExample2').focus();
                }else {
                    var getDataTime_form = empappodate1+' '+timeformatExample1+':00';
                    var getDataTime_to = empappodate2+' '+timeformatExample2+':00';
                     //alert('getDataTime_form '+getDataTime_form);
                    // alert('getDataTime_to '+getDataTime_to);
                    // alert('now '+ nowDateTime);
                    if(getDataTime_form > getDataTime_to){
                        alert("Effective From Date Time should be grater than To Date Time .");
                    }else if(nowDateTime > getDataTime_form ){
                        alert("Transfer effective date/time must be a future occurrence A");
                    }else if(nowDateTime > getDataTime_to ){
                        alert("Transfer effective date/time must be a future occurrence B");
                    }else{
                         var r = confirm('Are you sure you want to Process this?');
                         if (r==true){
                            $.ajax({ 
                				type:'POST', 
                				data: {get_User_ID_AR : txt_User_ID , get_Requested_User_AR : txt_Requested_User , get_Currant_User_Role_AR : txt_Currant_User_Role , getDataTime_form_AR : getDataTime_form , getDataTime_to_AR : getDataTime_to , get_Request_User_Role_AR : txt_Request_User_Role , get_Reason_AR : txt_Reason , get_current_role : chk_current_role , get_Currant_User_Role_dis : txt_Currant_User_Role_dis , get_txt_Currant_br : txt_Currant_br , get_lbl_user_ar : lbl_user}, 
                				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
                				success: function(val_retn) { 
                				    alert(val_retn);
                                    pageRef();
                                      
                				}
                 			});
                         }
                    }
                    
                }
            }else{
                alert('Invalied Time.Using 24 hours format (HH:MM)');
                document.getElementById('timeformatExample2').value = "";
            }
        }else{
            alert('Invalied Time.Using 24 hours format (HH:MM)');
            document.getElementById('timeformatExample1').value = "";
        } 
    }
    
}

function SetCurrentRoleBlank(){
    document.getElementById('lbl_Currant_User_Role').innerHTML = ''; 
    document.getElementById('txt_Currant_User_Role').value = '';
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
   // alert("A");
    var url = "getagentids.php?param1=";
    var idValue = document.getElementById("txt_User_ID").value;
    var log_user = document.getElementById('txt_USERMY').value;
   /* if(idValue == log_user){
        alert('You Cannot Grant Access by Yourself.');
    }else{*/
        var myRandom = parseInt(Math.random()*99999999);  // cache buster
        http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&rand=" + myRandom, true);
        http.onreadystatechange = handleHttpResponse;
        http.send(null);
        function handleHttpResponse(){
            if (http.readyState == 4){
                results = http.responseText.split(",");
                //alert(results);
               //alert(results[2].trim());
                if(results[3].trim() == ""){
                    alert('Undefied User.');
                    document.getElementById("txt_User_ID").value = "";
                }else{
                    document.getElementById('txt_Currant_User_Role').value = results[0].trim();
                    document.getElementById('txt_Currant_User_Role_dis').value = results[1].trim();
                    document.getElementById('lbl_Currant_User_Role').innerHTML = results[1].trim();
                    document.getElementById('txt_Currant_br').value = results[2].trim();
                    document.getElementById('lbl_user').innerHTML = results[3].trim();
                }
                
            }
        } 
    //}
    
}
//JAVASCRIPT FUNCTION END............................................................................................................................
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
   $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
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
    <td style="width: 150px; text-align: right;"><label class="linetop">User ID :</label></td>
    <td>
    
        <input class="box_decaretion" type="text"  style="width:100px;"  onfocus="SetCurrentRoleBlank()" name="txt_User_ID" id="txt_User_ID" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" required="required" />
         <label class="linetop" style="color: #840000;" id="lbl_user"></label>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Requested User :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px; background-color: #B1B1B1;" name="txt_Requested_User" id="txt_Requested_User" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly" />
        <label class="linetop"><?php echo $_SESSION['userID']; ?></label>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Currant User Role :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;background-color: #B1B1B1;" name="txt_Currant_User_Role" id="txt_Currant_User_Role" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/>
        <span style="display: none;">
        <input class="box_decaretion" type="text"  name="txt_Currant_User_Role_dis" id="txt_Currant_User_Role_dis" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/>
        <input class="box_decaretion" type="text"  name="txt_Currant_br" id="txt_Currant_br" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/>
        </span>
        <label class="linetop" style="color: #840000;"  id="lbl_Currant_User_Role"></label>
    </td>
  </tr>
</table>
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">From Date :</label></td>
        <td>
            <input class="box_decaretion" type="text"  style="width:100px;"  name="empappodate1"   id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="From Date"/>
        </td>
        <td style="width: 100px; text-align: right;"><label class="linetop">From Time :</label></td>
        <td>
            <input class="box_decaretion" type="text"  style="width:50px;"  name="timeformatExample1"   id="timeformatExample1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="00:00"/> 24h
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">To Date :</label></td>
        <td>
            <input class="box_decaretion" type="text"  style="width:100px;"  name="empappodate2"   id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="To Date"/>
        </td>
        <td style="width: 100px; text-align: right;"><label class="linetop">To Time :</label></td>
        <td>
            <input class="box_decaretion" type="text"  style="width:50px;"  name="timeformatExample2"   id="timeformatExample2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="00:00"/> 24h
        </td>
    </tr>
</table>
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Request User Role :</label></td>
    <td>
        <select class="box_decaretion" name="txt_Request_User_Role" id="txt_Request_User_Role" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value=""> -- Select User Role -- </option>
            <?php 
                $sql_user_role = "SELECT ar.role_id , ar.role_dis FROM cdb_acting_roles AS ar where ar.sts = 1;";
                $que_user_role = mysqli_query($conn,$sql_user_role) or die(mysqli_error($conn));
                while($res_user_role = mysqli_fetch_array($que_user_role)){
                    echo "<option value='".$res_user_role[0]."'>".$res_user_role[1]."</option>";
                }  
            ?>
        </select>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Reason :</label></td>
    <td>
        <textarea onkeyup="this.value = this.value.replace(/[&*<>]/g/, '')" class="box_decaretion" cols="35" rows="3" maxlength="105" name="txt_Reason" id="txt_Reason" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"></textarea>
    </td>
  </tr>
</table>
<input class="box_decaretion" style="margin-left: 155px;" type="checkbox" name="chk_current_role" id="chk_current_role" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" checked="checked" disabled="disabled"/>
<label class="linetop" style="font-weight: bold;">Current role active along with acting roles</label>

<br /><hr />
<div style="margin-left: 10px;">
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="getSubmit();" value="Send"/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageRef();" value="Refresh"/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageClose();" value="Close"/>
</div>
</span>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>