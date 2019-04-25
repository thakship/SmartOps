<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: User Transfer Request
Purpose			: To Request for User Transfer 
Author			: Madushan Wikramaarachchi
Date & Time		: 10.51 A.M 01/02/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/010";
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
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/uerTransferRequest.php?DispName=User%20Transfer%20Request','conectpage');
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

function SetCurrentRoleBlank(){
    document.getElementById('lbl_from_branch').innerHTML = ''; 
    document.getElementById('txt_From_Branch').value = '';
}

function getSubmit(){
   // alert('OK');
    var txt_User_ID = document.getElementById('txt_User_ID').value;
    var txt_Requested_User = document.getElementById('txt_Requested_User').value;
    var empappodate1 = document.getElementById('empappodate1').value;
    var timeformatExample1 = document.getElementById('timeformatExample1').value;
    var txt_From_Branch = document.getElementById('txt_From_Branch').value;
    var txt_To_Branch = document.getElementById('txt_To_Branch').value;
    var txt_Transfer_Type = document.getElementById('txt_Transfer_Type').value;
    var txt_Reason = document.getElementById('txt_Reason').value;
    var lbl_user = document.getElementById('lbl_user').innerHTML;
    var lbl_from_branch = document.getElementById('lbl_from_branch').innerHTML;
    var toBranch = document.getElementById('toBranch').innerHTML; 
    var log_user = document.getElementById('txt_USERMY').value;
    alert(lbl_user+' '+lbl_from_branch+' '+toBranch);
    
    var today = new Date();
    var dd = today.getDate();
    //alert('date - '+dd);
    var mm = today.getMonth()+1; //January is 0!
    //alert(today.getMonth());
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
    //alert(totime);
    
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
   
    var today = yyyy+'-'+mm+'-'+dd;
    //alert(today);
    
    var nowDateTime = today+' '+totime;
    
    if(txt_User_ID == ""){
        alert('Missing User ID.');
        
    }else if(txt_Requested_User == ""){
        alert('Undefined session user');
    }else if(empappodate1 == ""){
        alert('Missing request date.');
    }else if(timeformatExample1 == "" ){
        alert('Missing request time.');
    }else if(txt_From_Branch == ""){
        alert('Undefind branch.');
    }else if(txt_To_Branch == ""){
        alert('Missing to branch.');
    }else if(txt_Transfer_Type == ""){
        alert('Missing transfer Type.');
    }else if(txt_Reason == ""){
        alert('Missing reason for the transfer');
    }else if(today > empappodate1){
        alert("Date must be in the future");
    }else if(txt_From_Branch == txt_To_Branch){
        alert("User already exists in the same branch.");
    }else{
       RegEx = "\([0-2][0-9]):([0-5][0-9])$";
        if (Regs = timeformatExample1.match(RegEx)) {
            //alert(Regs[1]);
            //alert(Regs[2]);
            if ((Regs[1] > 23)) {
                alert('Invalid time format. Please use HH:MM (24 Hrs)');
                document.getElementById('timeformatExample1').value = "";
            }else {
                var getDataTime = empappodate1+' '+timeformatExample1+':00';
                //alert(getDataTime);
                if(nowDateTime > getDataTime ){
                    alert("Transfer effective date/time must be a future occurrence");
                }else{
                    var r = confirm('Are you sure you want to Process this?');
                     if (r==true){
                        $.ajax({ 
            				type:'POST', 
            				data: {get_User_ID : txt_User_ID , get_Requested_User : txt_Requested_User ,get_dateT : getDataTime , get_From_Branch : txt_From_Branch , get_To_Branch : txt_To_Branch ,get_Transfer_Type : txt_Transfer_Type , get_Reason : txt_Reason , get_lbl_user : lbl_user , get_lbl_from_branch : lbl_from_branch , get_toBranch : toBranch}, 
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
            alert('Invalid Time. Please use 24 hours format(HH:MM)');
            document.getElementById('timeformatExample1').value = "";
            
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
   // alert("A");
   var log_user = document.getElementById('txt_USERMY').value;
    var url = "getagentids.php?param=";
    var idValue = document.getElementById("txt_User_ID").value;
    /*if(idValue == log_user){
        alert('You Cannot Grant Access by Yourself.');
    }else{*/
        var myRandom = parseInt(Math.random()*99999999);  // cache buster
        http.open("GET", "getagentids.php?param=" + escape(idValue) + "&rand=" + myRandom, true);
        http.onreadystatechange = handleHttpResponse;
        http.send(null);
        function handleHttpResponse(){
            if (http.readyState == 4){
                results = http.responseText.split(",");
                //alert(results[4].trim());
                if(results[2].trim() == ""){
                    alert('Undefied User.');
                    document.getElementById("txt_User_ID").value = "";
                }else{
                    document.getElementById('txt_From_Branch').value = results[0].trim();
                    document.getElementById('lbl_from_branch').innerHTML = results[1].trim();
                    document.getElementById('lbl_user').innerHTML = results[2].trim();
                }
                
            }
        } 
   // }
}
//JAVASCRIPT FUNCTION END............................................................................................................................
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    /*$( "#timeformatExample1" ).timepicker({
        'showDuration': true,
        'timeFormat':"H:i:s"
    });*/  
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
        <input class="box_decaretion" type="text"  style="width:100px;" onfocus="SetCurrentRoleBlank()" name="txt_User_ID" id="txt_User_ID" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" required="required" />
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
    <td style="width: 150px; text-align: right;"><label class="linetop">From Branch :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;background-color: #B1B1B1;" name="txt_From_Branch" id="txt_From_Branch" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" readonly="readonly"/>
        <label class="linetop" style="color: #840000;"  id="lbl_from_branch"></label>
    </td>
  </tr>
</table>
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Request Date :</label></td>
        <td>
            <input value="<?php echo date("Y-m-d") ;?>" class="box_decaretion" type="text"  style="width:100px;"  name="empappodate1"   id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="From Date" maxlength="10"/>
        </td>
        <td style="width: 100px; text-align: right;"><label class="linetop">Request Time :</label></td>
        <td>
            <input value="<?php //echo date('H:', strtotime('+88 minutes', strtotime(date("Y-m-d H:i:s"))))."00"?>" class="box_decaretion" type="text"  style="width:50px;"  name="timeformatExample1"   id="timeformatExample1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="00:00" maxlength="5"/> 24h
        </td>
    </tr>
</table>
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">To Branch :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_To_Branch" id="txt_To_Branch" value="" onclick="popup(1);" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" readonly="readonly" required="required" />
        <input type="button" class="buttonManage" id="btnPopUp" name="btnPopUp" value="..." onclick="popup(1);"/>
        <label id="toBranch" style="color: #840000;" class="linetop"></label>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Transfer Type :</label></td>
    <td>
        <select class="box_decaretion" name="txt_Transfer_Type" id="txt_Transfer_Type" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="D">D - Deputation</option>
           <!-- <option value="P">P - Permanent</option>-->
        </select>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right; vertical-align: top;"><label class="linetop">Reason :</label></td>
    <td>
        <textarea class="box_decaretion" cols="35" rows="3" maxlength="105" name="txt_Reason" id="txt_Reason" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"></textarea>
    </td>
  </tr>
</table>
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
