<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Operation
Page Name		: CR To Be Received List
Purpose			: To viwe Request List for CR To Be Received List
Author			: Madushan Wikramaarachchi
Date & Time		: 10.45 A.M 2019-03-27
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ope/e/014";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php');
  
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CR Received List</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../Operation_DEVELOPMENT/CSS/operation_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../Operation_DEVELOPMENT/JAVASCRIPT_FUNCTION/operation_js_function"></script>
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
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/operation/Entry/CrReceivedList.php?DispName=CR%20Received%20List','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/operation/Entry/CrReceivedList.php?DispName=CR%20Received%20List','conectpage');
}

function clientValidate(title,cat_cod){
    var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
    var helpClose = document.getElementById('txt_helpdesk_close').value;
        //alert(cat_cod);
        var mydata;
        var getHI = document.getElementById(title).value;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }          
        mydata.open("GET","../Operation_DEVELOPMENT/PHP_FUNCTION/operation_Ajax.php"+"?getHelpIDreq1rmvlq="+getHI+"&gettxt_helpdesk_close1rmvlq="+helpClose+"&pageref=RMVReceived",true);
        mydata.send();
    
}
    
    function getSolution(){
        var getsubHI = document.getElementById('txt_help_ID').value;
            mydata1= new XMLHttpRequest();
            mydata1.onreadystatechange=function(){
                if(mydata1.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata1.responseText;           
                }
            }
            mydata1.open("GET","../Operation_DEVELOPMENT/PHP_FUNCTION/operation_Ajax.php"+"?getsubHelpIDreq="+getsubHI,true);
            mydata1.send();
    }
    
    function deleteRow(n){ // this fuction is Delete Row(s) in table
        //alert(n);
        var m=n.parentNode.parentNode.rowIndex;
        document.getElementById('myTable').deleteRow(m);
        var num1 = document.getElementById("myTable").rows.length;
        var num2 = num1 - 1;
        var y = 1;
        var  rowcount = document.getElementById("myTable").rows.length;
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
        var i = rowcount-1;    
       	for(var mloop=2;mloop <=100;mloop++){
            var elementA =  document.getElementById('txta' + (mloop - 1));
            var elementB =  document.getElementById('txtb' + (mloop - 1));
            if (elementA != null){
                // Re-order the sequence of the table rows.............
                elementA.value = y;
                //Changing the element ID's to capture in the php
                elementA.id = 'txta' + y;				  
                elementB.id = 'txtb' + y;
                //Changing the element name's to capture in the php				  
                elementA.name = 'txta' + y;				  
                elementB.name = 'txtb' + y;
                y++;
            }			
        }
}

function is_add_row(){
    var x = document.getElementById("myTable").rows.length;
    var getVal = document.getElementById('txtb'+(x-1)).value;
    if(getVal != ""){
        var table=document.getElementById("myTable");
        var row=table.insertRow(-1);
        var cell1=row.insertCell(0);
        var cell2=row.insertCell(1);
        var cell3=row.insertCell(2);
        var cell4=row.insertCell(3);
        var cell5=row.insertCell(4);
        cell1.innerHTML="<input style='width:50px;text-align: right;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/>";
        cell2.innerHTML="<input style='width:600px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<input style='width:100px;' type='text' name='txtUse"+(x)+"' id='txtUse"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
        cell4.innerHTML="<input style='width:150px;' type='text' name='txtOn"+(x)+"' id='txtOn"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
        cell5.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/><div style='display: none;'><input class='box_decaretion' type='text' name='txt_c_n"+(x)+"' id='txt_c_n"+(x)+"' value='1' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>";
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
    }else{
       alert('Note text box empty.');
    }
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
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
}
	
	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_inner_User1').value = id1;
			document.getElementById('txt_inner_User2').value = id2;
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
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
function removeUsreID(){
    document.getElementById('txt_inner_User1').value = '';
    document.getElementById('txt_inner_User2').value = '';
}  

function is_kiosk_ok(title){
    //alert('OK button');
    var chk_1 = 0;
    var chk_2 = 0;
    var chk_3 = 0;
    var chk_4 = 0;
    var chk_5 = 0;
    var chk_6 = 0;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    var ksrl_user = document.getElementById('txt_USERMY').value;
    var ksrl_pn = document.getElementById('txt_pn').value;
    
   /* chk_1 = document.getElementById('chk_1').checked ? 1 :0;
    chk_2 = document.getElementById('chk_2').checked ? 1 :0;
    chk_3 = document.getElementById('chk_3').checked ? 1 :0;
    chk_4 = document.getElementById('chk_4').checked ? 1 :0;
    chk_5 = document.getElementById('chk_5').checked ? 1 :0;
    chk_6 = document.getElementById('chk_6').checked ? 1 :0;*/
    
    if(document.getElementById('chk_1').checked == true){
        chk_1 = 1;
    }
    if(document.getElementById('chk_2').checked == true){
        chk_2 = 1;
    }
    if(document.getElementById('chk_3').checked == true){
        chk_3 = 1;
    }
    if(document.getElementById('chk_4').checked == true){
        chk_4 = 1;
    }
    if(document.getElementById('chk_5').checked == true){
        chk_5 = 1;
    }
    if(document.getElementById('chk_6').checked == true){
        chk_6 = 1;
    }
    if(ksrl_user != ""){
       if(document.getElementById('chk_1').checked == true && document.getElementById('chk_2').checked == true && document.getElementById('chk_3').checked == true && document.getElementById('chk_4').checked == true && document.getElementById('chk_5').checked == true && document.getElementById('chk_6').checked == true){
        //alert('all check');
            $.ajax({ 
    				type:'POST', 
    				data: {get_ksrl_helpid : ksrl_helpid , get_chk_1 : chk_1 , get_chk_2 : chk_2 , get_chk_3 : chk_3 , get_chk_4 : chk_4 , get_chk_5 : chk_5 , get_chk_6 : chk_6 , get_ksrl_user : ksrl_user , get_ksrl_pn : ksrl_pn , get_title : title}, 
    				url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
    				success: function(val_retn) { 
    				    //alert(val_retn); 
                        if(val_retn == 'OK'){
                            alert('Updated.');
                            pageRef();
                        }else{
                            alert('Updated Error.');
                        }
                        //pageCloseDefineLetterTypes();
    				}     
            });    
        }else{
            var r = confirm('Confirm to proceed ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    				type:'POST', 
    				data: {get_ksrl_helpid : ksrl_helpid , get_chk_1 : chk_1 , get_chk_2 : chk_2 , get_chk_3 : chk_3 , get_chk_4 : chk_4 , get_chk_5 : chk_5 , get_chk_6 : chk_6 , get_ksrl_user : ksrl_user , get_ksrl_pn : ksrl_pn , get_title : title}, 
    				url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
    				success: function(val_retn) { 
    				    //document.getElementById('maneSpan').innerHTML = val_retn;
    				    alert(val_retn);
                        if(val_retn == 'OK'){
                            alert('Updated.')
                            pageRef();
                        }else{
                            alert('Updated Error.')
                        }
                        //pageCloseDefineLetterTypes();
    				}               
    			});
            }
        } 
    }else{
        alert('login user undifind.');
    }    
}  
function isAddiImgRequset(title){
    //alert(title);
    var helpID = title;
    var aIType = "K";
    window.open('http://cdberp:8080/cdb/pages/operation/Entry/applicationPendingUpload.php?DispName=Application%20%20Pending%20Upload&helpID='+helpID+'&pendingUploadImgType='+aIType,'conectpage');
}
function isAppGenerater(companyname){
    var appNUmber = document.getElementById('txt_app_number').value;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    var ksrl_user = document.getElementById('txt_USERMY').value;
    
    //alert(companyname);
    
    if(isNaN(appNUmber) == true){
        alert('Invalid Application Number.');
    }else if(companyname == "CDB" && appNUmber.length != 17){
        alert('Invalid Application Number - length : 17.');
    }else if(companyname == "UCL" && appNUmber.length != 10){
        alert('Invalid Application Number - length : 10.');
    }else if(appNUmber == ""){
        alert('Application Number is missing.');
    }else if(ksrl_helpid == ""){
        alert('Help ID is missing.');
    }else if(ksrl_user == ""){
        alert('User ID is missing.');
    }else{
         var r = confirm('Confirm to proceed ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    				type:'POST', 
    				data: {get_appNUmber : appNUmber , get_app_ksrl_helpid : ksrl_helpid , get_app_ksrl_user : ksrl_user }, 
    				url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
    				success: function(val_retn) { 
    				   //document.getElementById('maneSpan').innerHTML = val_retn;
    				    //alert(val_retn);
                        if(val_retn == 'OK'){
                            alert('Updated.')
                            pageRef();
                        }else{
                            alert('Updated Error.')
                        }
                        //pageCloseDefineLetterTypes();
    				}               
    			});
            }
    }
    
    
}
/*function updateAssUser(){
    //alert('A');
    var assuser = document.getElementById('txt_inner_User1').value;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    
   // alert(assuser);
    var r = confirm('Confirm to Update ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    			 
    				type:'POST', 
    				data: {get_assuserrmv : assuser  , get_aass_ksrl_helpidrmv : ksrl_helpid , pagerefrmv : 'RMVReceived'}, 
    				url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
    				success: function(val_retn) { 
    				   //document.getElementById('maneSpan').innerHTML = val_retn;
    				   // alert(val_retn);
                        if(val_retn == 'OK'){
                            alert('Updated.')
                             pageClose();
                            //pageRef();
                        }else{
                            alert('Updated Error.')
                        }
                        //pageCloseDefineLetterTypes();
    				}               
    			});
            }
}*/



function isRMVReceived(){
    //alert('RMV');
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    var ksrl_user = document.getElementById('txt_USERMY').value;
    var rmv_officer = "";
    var rmv_vehicle = document.getElementById("").value;
    var rmv_Cr_Stat_name = document.getElementById("").value;
    var rmv_Cr_Stat_code = document.getElementById("").value;
    
    var r = confirm('Confirm to Update ?')
    if (r==true){
       // alert('function ok');
		$.ajax({ 
		 
			type:'POST', 
			data: {getCDPUQCUserrmvlodge : ksrl_user  , getCDPUQCHelpIDrmvlodge : ksrl_helpid , getPageTitle : 'RMVReceived' ,getrmv_officer : rmv_officer, getrmv_vehicle : rmv_vehicle , getrmv_Cr_Stat_name : rmv_Cr_Stat_name ,getrmv_Cr_Stat_code : rmv_Cr_Stat_code  }, 
			url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
			success: function(val_retn) { 
			   //document.getElementById('maneSpan').innerHTML = val_retn;
			    //alert(val_retn);
                if(val_retn == 'OK'){
                    alert('Updated.')
                     //pageClose();
                    pageRef();
                }else{
                    alert('Updated Error.')
                }
                //pageCloseDefineLetterTypes();
			}               
		});
    }
}


function isEnableBtnForRecoment(){
        //alert('A');
        var isOK = 0;
        
        var r = document.getElementById('txtrowCount').value;
        
        //alert(r);
        for (i = 1; i <= r; i++){
           // alert(i);
           
            if(document.getElementById('chka'+i).checked == true){
                
                
                isOK++;
                //alert(isOK);
                
            }
        }
        //alert(isOK);
        if(isOK == 0){
            document.getElementById("btnProcess").disabled = true;
        }else{
            document.getElementById("btnProcess").disabled = false ;
        }
        
    }

</script>
<script>
var metaChar = false;
function keyEvent(event) {
  var key = event.keyCode || event.which;
   //alert("Key pressed " + key);
   if(key == 120){ // F9
        //alert("Key pressed " + key);
        
       /* var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajax_OperationQueueCompeted_F.php'+'?f9_userIDgen='+userID+'&f9_userggen='+userg,true);
		mydataNew.send();*/
    } else if(key == 112){ // F1 Key
        //alert("Key pressed " + key);
       /*var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F1.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
    }else if(key == 113){ // F2 Key
        //alert("Key pressed " + key);
      /* var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F2.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
    }else if(key == 114){ // F3 Key
        //alert("Key pressed " + key);
       /*var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F3.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
    }else if(key == 115){ // F4 Key
        //alert("Key pressed " + key);
       /*var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F4.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
    }else if(key == 121){ // F10 Key
        //alert("Key pressed " + key);
       /*var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F10.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
    }else if(key == 119){ // F8 key
        //alert("Key pressed " + key);
      /* var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_F8.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();*/
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
<span id="maneSpan">

<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->
<!--<span style="background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:10px; font-weight:bold"><b>F2</b> - Cash-In-Hand , <b>F8</b> - File Verified , <b>F10</b> - QC Pending  </span> -->
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="table-layout:fixed;width:100%;background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV Start Date</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:90px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
			<td style="width:120px;text-align: left;"><span style="margin-left: 5px;">Facility No</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">COD Last Event</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Entered By</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV Type</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV Debited Amount</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV Officer</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Vehicle No</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV Status</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">RMV place</span></td>
		
			<td style="width:50px;text-align: left;"><span style="margin-left: 5px;">Minutes</span></td>

            <td style="width:50px;"></td>
        </tr>
        
        
<?php

       $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                            `rmv_header`.`RMV_Q_START_DATE`, 
                            `cdb_helpdesk`.`issue`,
                            `scat_02`.`scat_discr_2`, 
				            `branch`.`branchName`, 
                            `deparment`.`deparmentName`,
                             `cdb_helpdesk`.`enterBy`,
                              `urgency_states`.`ur_discr`, 
								   `priority_states`.`pr_discr` , 
                                   `cdb_helpdesk`.`COD_FILE_PROCUSER` , 
                                   `cdb_helpdesk`.`cat_code` , 
								   `cdb_helpdesk`.`ssb_facility_amount` , 
                                   CONCAT( `cdb_helpdesk`.`COD_LAST_EVENT` , IF(`cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`), '') ),
                                   `cdb_helpdesk`.`help_discr`,
								   IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                                   `cdb_helpdesk`.`ssb_app_number`,
								   `cdb_helpdesk`.`facno`,
                                   datediff(date(now()),DATE(`cdb_helpdesk`.`COD_START_DATE`)) as agedays,
                                   `cdb_helpdesk`.`curr_stage`,
								   `cdb_helpdesk`.`assign_to`,
                                   `cdb_helpdesk`.`taken_by`,
                                   `cdb_helpdesk`.`COD_CHG_REC_ON`,
                                   `cdb_helpdesk`.`COD_DO_PRINT_ON`,
								   `cdb_helpdesk`.`COD_CHKLIST_ON`,
                                   `rmv_header`.`RMV_Type`,
                                   `rmv_header`.`RmvDebitedAmount`,
                                   `rmv_header`.`RMV_OFFICER`,
                                   `rmv_header`.`CR_Place`,
                                   `rmv_header`.`CR_Status`,
                                   `rmv_header`.`CR_VehicleNo`,
                                   ROUND(time_to_sec((TIMEDIFF(NOW(),`rmv_header`.RMV_Q_START_DATE))) / 60),
                                   `cdb_helpdesk`.`pr_code`,
								   `cdb_helpdesk`.`QC_CDPU_ON` , 
                                   `cdb_helpdesk`.`QC_SECDOCS_ON`,
                                   `cdb_helpdesk`.`QC_INS_ON`,
                                   `cdb_helpdesk`.`REC_ACBAL`,
                                   `cdb_helpdesk`.`REC_ACCNO`,
								   `cdb_helpdesk`.`SUP_ACCNO`,
                                   `cdb_helpdesk`.`SUP_ACCSTS` ,
                                   `cdb_helpdesk`.`ssb_type` , 
                                   `cdb_helpdesk`.`COD_LAST_EVENT_DT` ,
                                   (select scat_03.scat_discr_3 from scat_03 where scat_03.cat_code = cdb_helpdesk.cat_code and scat_03.scat_code_1 = cdb_helpdesk.scat_code_1 and scat_03.scat_code_2 = cdb_helpdesk.scat_code_2 and scat_03.scat_code_3 = cdb_helpdesk.scat_code_3)
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth` , `rmv_header`
 WHERE  `cdb_helpdesk`.`helpid` =  `rmv_header`.`helpid` AND
        `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND   
	   date(`cdb_helpdesk`.`COD_START_DATE`) >= (CURRENT_DATE - INTERVAL 45 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."' AND
      /* `cdb_helpdesk`.COD_DO_PRINT_ON = '0000-00-00 00:00:00'  */
      `cdb_helpdesk`.COD_STATUS = '002' AND
           `rmv_header`.`RmvLogBy` IS NOT NULL
       and `rmv_header`.`RmvConfirmedBy` IS NOT NULL
       and `rmv_header`.`CR_ReceivedBy` IS NOT NULL
       and `rmv_header`.`PAYMENT_BATCH` = 0
       ORDER BY `cdb_helpdesk`.`pr_code` desc,`cdb_helpdesk`.`COD_START_DATE`;";
	//echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        $f_Col = "#000000";
        //$colPH = "background-color:#FFFFFF;";
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
       
        $index++; 
		$sql_pending_ph = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Payment Release Doc' AND
                            		pu.PaymentHandling = 'Existing Customer';";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }
        
        
        
                                
        if( $rec_det_detels[25]=='7002'){ // || $rec_det_detels[25]=="7002" $rec_det_detels[8]=='Highest' ||
            $colPr = "background-color:#F7819F;";
        }else{
            $colPr = "";
        }
	   $MyRow = "";
 	   /*$sql_selectrmv_header    = "SELECT `rmv_header`.`RmvConfirmedAssignBy`, `rmv_header`.`RmvConfirmedAssignOn` 
                                     from `rmv_header` 
                                    WHERE `rmv_header`.`helpid` = '".$rec_det_detels[0]."';";
		$query_selectrmv_header =  mysqli_query($conn,$sql_selectrmv_header) or die(mysqli_error($conn));
        while($rec_selectrmv_header = mysqli_fetch_array($query_selectrmv_header)){
             if ($_SESSION['user'] == $rec_selectrmv_header[0]){
                $MyRow = "background-color:lightblue;";
            }
        }*/
        
        
        
       
        $col = "";
         $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded" || $rec_det_detels[33] == 'Additional Images Uploaded'){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded" || $rec_det_detels[33] == 'Additional Images Uploaded')
            $col = "#BB11F3;";
        }
                
        /*
       $sql_add_img_ok = "SELECT n.note_discr
                                FROM  cdb_help_note AS n 
                                WHERE n.helpid = '".$rec_det_detels[0]."'  
                                and n.note_discr like 'File Scanned%'
                                ORDER BY n.enterDateTime DESC LIMIT 1;";
        $QUERY_add_img_ok = mysqli_query($conn,$sql_add_img_ok);
        while($rec_add_img_ok = mysqli_fetch_array($QUERY_add_img_ok)){
            $qqq = substr($rec_add_img_ok[0],0,20);
            if(substr($rec_add_img_ok[0],0,20) == 'COD Pending Notified' && $rec_det_detels[33] == 'Additional Images Uploaded'){ 
                $col = "#BB11F3;"; //|| && $rec_det_detels[26] == 'Additional Images Uploaded'
            }
        }
        */
        $qwer = "";
        $sql_pendin_upload_doc = "SELECT pu.done_on ,  pu.DocPurpose
                                    FROM pending_upload_file AS pu
                                    WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                            pu.DocPurpose = 'Pending Reply' 
                                    ORDER BY pu.done_on DESC LIMIT 1;";
        $query_pendin_upload_doc = mysqli_query($conn,$sql_pendin_upload_doc);
        $row_count_upload_doc = mysqli_num_rows($query_pendin_upload_doc);
         if($row_count_upload_doc == 0){
            //while($rec_pendin_upload_doc = mysqli_fetch_array($query_pendin_upload_doc)){
                //$qwer = $rec_pendin_upload_doc[0];
                //$rec_det_detels[12] && ($rec_det_detels[33] <  $rec_pendin_upload_doc[0])
                if(substr($rec_det_detels[12],0,16)  == "Pending Notified"){
                   // $qwer = $rec_pendin_upload_doc[0];
                    $qwer = "background-color:#ff3300;";
                }/*else{
                    $qwer = $rec_det_detels[12];
                }*/
               // `cdb_helpdesk`.`COD_LAST_EVENT` = 'Pending Notified.', CONCAT(' - ' ,`cdb_helpdesk`.`COD_LAST_EVENT_DT`)
                
            //}
        }else{
            while($rec_pendin_upload_doc = mysqli_fetch_array($query_pendin_upload_doc)){
                if(substr($rec_det_detels[12],0,16)  == "Pending Notified" && $rec_pendin_upload_doc[0] < $rec_det_detels[34]){
                   // $qwer = $rec_pendin_upload_doc[0];
                    $qwer = "background-color: #ff3300;";
                }else{
                    $qwer = "background-color:#99e699;";
                }
            }
        }
                                    
        /*$sql_pending_ph_1 = "SELECT COUNT(*) 
                            FROM pending_upload_file AS pu
                            WHERE pu.help_id = '".$rec_det_detels[0]."' AND
                                  pu.DocPurpose = 'Pending Reply' ;";
        $QUERY__pending_ph = mysqli_query($conn,$sql_pending_ph);
        while($rec_pending_ph = mysqli_fetch_array($QUERY__pending_ph)){
            if($rec_pending_ph[0] == 0){
                $colPH = "background-color:#FFFFFF;";
            }else{
                $colPH = "background-color:#cc99ff;";
            }
        }*/
        //echo $col."<BR>";
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$colPr .";color: ".$f_Col.";'>
                    <div style='display: none;'>
                       <input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/>
                       </div>
                    <span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:60px;text-align: right;".$MyRow."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:70px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]." - ".$rec_det_detels[39]."</span></td>";
        echo "<td style='width:90px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$colPH."' title='".$rec_det_detels[33]."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:60px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
       // echo "<td style='width:60px;text-align: right;".$qwer."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[24]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[25]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[26]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[29]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[28]."</span></td>";
       echo "<td style='width:120px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[27]."</span></td>";
		
	
	
		echo "<td style='width:90px;text-align: left;".$MyRow ."' title='".con_min_days($rec_det_detels[30])."'><span style='margin-left: 2px;'>".$rec_det_detels[30]."</span></td>";
        /*Rizvi*/           
        echo "<td style='width:50px;'>
                  <input type='checkbox' class='buttonManage'  name='chka".$index."' id='chka".$index."' onclick='isEnableBtnForRecoment();' /></td>";
        echo "</tr>";
    }
	
	function con_min_days($mins){
		$hours = str_pad(floor($mins /60),2,"0",STR_PAD_LEFT);
		$mins  = str_pad($mins %60,2,"0",STR_PAD_LEFT);

		if((int)$hours > 24){
		  $days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
		  $hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
		}
		if(isset($days)) {$days = $days." Dy ";} else {	$days = "";}

		return $days.($hours=="00"?"":$hours." Hr ").$mins." Mn";
    }
?>
</table>

</span>
<br /><br />
 <input class="buttonManage" style="width: 100px;" type="submit" name="btnProcess" id="btnProcess" value="Process" disabled="disabled" />
  
<div style="display: none;">
     <input type='text' name='txtrowCount' id='txtrowCount' value='<?php echo $index; ?>' />   
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
    
</div>

<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<?php

    if(isset($_POST['btnProcess']) && $_POST['btnProcess']=='Process'){
        mysqli_autocommit($conn,FALSE);
        try{
            $TableID = 1;
            $sqlFunction ="SELECT GetNextSerial('RMV_BATCH',1) FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
            $quary_Function = mysqli_query($conn,$sqlFunction);
            while ($rec_Function = mysqli_fetch_array($quary_Function)){
	            $batch_num = $rec_Function[0]; 
            }
            $CountOfBatch = 0;
            for ($i = 1; $i <= $_POST['txtrowCount']; $i++){ 
                 if(isset($_POST['chka'.$i])){
                       // Code Update to Batch ......
                    $sql_update = "UPDATE `rmv_header` 
                                     SET `PAYMENT_BATCH`= ".$batch_num."
                                   WHERE `helpid` = '".$_POST['txta'.$i]."';";
                    //echo $sql_update." -- ";
                    $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                    $CountOfBatch++;
                   
                 
                 }
            }
            
            $sql_insert_batch = "INSERT INTO rmv_batch_header (batch_id,noOfBatch,createBy) VALUES(".$batch_num.",".$CountOfBatch.",'".$_SESSION['user']."');";
            $query_insert_batch = mysqli_query($conn,$sql_insert_batch) or die(mysqli_error($conn));     
             mysqli_commit($conn); 
             $stringMessage = "Batch Process Success. \\n\\n Batch Number : ".$batch_num;
             echo "<script> alert('". $stringMessage ."');pageClose();</script>";
         }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
}
?>
</form>
</body>
</html>
