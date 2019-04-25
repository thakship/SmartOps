<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk Service Request List - Call Canter 
Purpose			: To viwe comlited app request list 
Author			: Madushan Wikramaarachchi
Date & Time		: 09.36 A.M 16/02/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/039";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>kiosk Service Request List - Call Canter</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
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
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>

<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        
        $("#btnExport").click(function () {
            alert('A');
            $("#myTable").btechco_excelexport({
                alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestListCallCanter.php?DispName=kiosk%20Service%20Request%20List%20-%20Call%20Canter','conectpage');
}
function pageRef(){
   http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestListCallCanter.php?DispName=kiosk%20Service%20Request%20List%20-%20Call%20Canter','conectpage');
}

    function clientValidate(title,cat_cod){
        var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
        var helpClose = document.getElementById('txt_helpdesk_close').value;
        if(cat_cod != '1014' ){
            var mydata;
            var getHI = document.getElementById(title).value;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;           
                }
            }
            
            mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_callCenter.php"+"?getHelpIDreq="+getHI+"&gettxt_helpdesk_close="+helpClose,true);
            mydata.send();
        }else{
            //alert(cat_cod);
            var mydata;
            var getHI = document.getElementById(title).value;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;           
                }
            }          
            mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_callCenter.php"+"?getHelpIDreq1="+getHI+"&gettxt_helpdesk_close1="+helpClose,true);
            mydata.send();
        }
        
    }
    
    function getSolution(){
        var getsubHI = document.getElementById('txt_help_ID').value;
            mydata1= new XMLHttpRequest();
            mydata1.onreadystatechange=function(){
                if(mydata1.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata1.responseText;           
                }
            }
            mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_callCenter.php"+"?getsubHelpIDreq="+getsubHI,true);
            mydata1.send();
    }
    
    function getCallFeedback(){
        var callAnswered = document.getElementById('selCallAnswered').value;
        //alert(callAnswered);
        if(callAnswered == "YES"){
            document.getElementById('callFed').style.display = "inherit";
            document.getElementById('callchk').style.display = "none";
            document.getElementById("chk_C").checked = false;
            document.getElementById('selCallFeedbackNO').value = "";
             
        }else if(callAnswered == "NO"){
            document.getElementById('callFed').style.display = "none";
            document.getElementById('selCallFeedback').value = "";
            document.getElementById('callchk').style.display = "inherit";
            document.getElementById('callchkYES').style.display = "none";
            document.getElementById('selCallFeedbackYES').value = ""; 
            
        }else{
            document.getElementById('selCallFeedback').value = "";
            document.getElementById('callchk').style.display = "none";
            document.getElementById("chk_C").checked = false;
            document.getElementById('callFed').style.display = "none";
            document.getElementById('selCallFeedbackNO').value = "";
            document.getElementById('callchkYES').style.display = "none";
            document.getElementById('selCallFeedbackYES').value = ""; 
        }
    }
    
    function getCallFSUBback(){
        var callselCallFeedback = document.getElementById('selCallFeedback').value;
        if(callselCallFeedback == 2){
            document.getElementById('callchkYES').style.display = "inherit";
            
        }else{
            document.getElementById('callchkYES').style.display = "none";
            document.getElementById('selCallFeedbackYES').value = "";   
        }
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
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function_callCenter.php', 
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
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function_callCenter.php', 
    				success: function(val_retn) { 
    				    //document.getElementById('maneSpan').innerHTML = val_retn;
    				    //alert(val_retn);
                        if(val_retn == 'OK'){
                            alert('Updated.')
                            pageRef();
                        }else{
                            //document.getElementById('maneSpan').innerHTML=val_retn;
                            //alert(val_retn);
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

function isAppGenerater(){
    var appNUmber = document.getElementById('txt_app_number').value;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    var ksrl_user = document.getElementById('txt_USERMY').value;
    
    //alert(appNUmber+'--'+ksrl_helpid+'--'+ksrl_user);
    
    if(isNaN(appNUmber) == true){
        alert('Invalid Application Number.');
    }else if(appNUmber.length < 17){
        alert('Invalid Application Number - length : 17.');
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
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function_callCenter.php', 
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
function updateAssUser(){
    //alert('A');
    var assuser = document.getElementById('txt_inner_User1').value;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    
   // alert(assuser);
    var r = confirm('Confirm to Update ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    			 
    				type:'POST', 
    				data: {get_assuser : assuser  , get_aass_ksrl_helpid : ksrl_helpid}, 
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function_callCenter.php', 
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
}
function isAddiImgRequset(title){
    //alert(title);
    var helpID = title;
    var aIType = "K";
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/applicationPendingUpload.php?DispName=Application%20%20Pending%20Upload&helpID='+helpID+'&pendingUploadImgType='+aIType,'conectpage');
}

function is_UCLFacNumberGetn(){
    //var appNUmber = document.getElementById('txt_app_number').value;
    var ksrl_helpid = document.getElementById('txt_help_ID').value;
    var ksrl_user = document.getElementById('txt_USERMY').value;
    
    var appNUmber = prompt("Please enter Facility Number");
    if (appNUmber == null){
        alert('Application Number is missing.');
    }else if(appNUmber.length < 17){
        alert('Invalid Application Number - length : 17.');
    }else if(appNUmber.length > 18){
        alert('Invalid Application Number - length : 17.');
    }else if(appNUmber == ""){
        alert('Application Number is missing.');
    }else if(ksrl_helpid == ""){
        alert('Help ID is missing.');
    }else if(ksrl_user == ""){
        alert('User ID is missing.');
    }else if(appNUmber.substr(0, 5) != "LEHOF"){
        alert('Application Number is Incorrect.');
    }else{
         var r = confirm('Confirm to proceed ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    				type:'POST', 
    				data: {get_UCL_appNUmber : appNUmber , get_UCL_app_ksrl_helpid : ksrl_helpid , get_UCL_app_ksrl_user : ksrl_user }, 
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function_callCenter.php', 
    				success: function(val_retn) { 
    				   //document.getElementById('maneSpan').innerHTML = val_retn;
    				    alert(val_retn);
                        /*if(val_retn == 'OK'){
                            alert('Updated.')
                            pageRef();
                        }else{
                            alert('Updated Error.')
                        }*/
                        //pageCloseDefineLetterTypes();
    				}               
    			});
            }
    }
    
}
</script>
<script>
var metaChar = false;
function keyEvent(event) {
  var key = event.keyCode || event.which;
   // alert("Key pressed " + key);
   // return;
   if(key == 120){
        //alert("Key pressed " + key);
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid_1Call.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();
       
    }else{ 
        if(key == 119){ //119-F8
            //alert("Key pressed " + key);
            var mydataNew;
    		mydataNew= new XMLHttpRequest();
    		mydataNew.onreadystatechange=function(){
    			if(mydataNew.readyState==4){
    				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
    			}
    		}
            var userID = "CDBUCL";
            var userg = document.getElementById('txt_USERgROUP').value;
    		mydataNew.open('GET','ajaxEntryNewGrid_2Call.php'+'?n_userID='+userID+'&n_userg='+userg,true);
    		mydataNew.send();
        }else{
             if(key == 112||key == 113||key == 114||key == 115||key == 121){
                //alert("Key pressed " + key);
                var mydataNew;
        		mydataNew= new XMLHttpRequest();
        		mydataNew.onreadystatechange=function(){
        			if(mydataNew.readyState==4){
        				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
        			}
        		}
                var userBranch = "UCL";
                var userg = document.getElementById('txt_USERgROUP').value;
				if(key == 121){
					mydataNew.open('GET','ajaxEntryNewGrid_6Call.php'+'?n_userID='+userID+'&n_userg='+userg,true);
				}else{
					mydataNew.open('GET','ajaxEntryNewGrid_3Call.php'+'?n_userID='+userID+'&n_userg='+userg+'&n_keyCode='+(key % 111),true);
				}
        		mydataNew.send();
            }
        }
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

<!-- added by Rizvi on 9:48 AM 29/01/2015 -->
<?php
    $v_sql_det_detelsCNT = "SELECT COUNT(1),
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = date(now()) THEN 1 END) , 
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) < date(now())  THEN 1 END) , /*subdate(date(now()),1)*/
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = date(now()) AND `cdb_helpdesk`.`facno` = '' THEN 1 END) 
	FROM `cdb_helpdesk`
 WHERE `cdb_helpdesk`.`cat_code` = '1014' AND `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
	    date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) 
        and `cdb_helpdesk`.callRecOn IS NOT NULL
        and `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry AS c
											WHERE c.callstatus = 1
                                            )";
	  // echo $v_sql_det_detelsCNT;
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;	
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
        echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[For the Day : ".$rec_det_detelsCNT[1]."]</font>&nbsp;&nbsp;<font style='color:blue; font-size:14px;'>[Last 30 Days : ".$rec_det_detelsCNT[2]." ]</font></h3>";
		echo "<font style='color:Green; font-size:12px;'>Sort : Call Queue Time - Ascending - [F8 - CDB | F9 - UCL]</font>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Initiate Date</span></td>
			<!--<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">LOS Creation Date</span></td>-->
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:110px;text-align: left;"><span style="margin-left: 5px;">Facility Number</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Call Queued</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Agent</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <!--<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>--> 
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">CIF</span></td> 
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Count</span></td> 
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">LOS</span></td>-->
			<!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">No Of Pending</span></td>-->
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken Full</span></td>-->
			<!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken - After Verification</span></td>-->
            <td style="width:50px;"></td>
        </tr>
<?php


      $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                            (`cdb_helpdesk`.`callRecOn`), 
                            `cdb_helpdesk`.`issue`,
                            `scat_02`.`scat_discr_2`, 
                            `branch`.`branchName`, 
                            `deparment`.`deparmentName`, 
                            `cdb_helpdesk`.`enterBy`, 
                            `urgency_states`.`ur_discr`, 
                            `priority_states`.`pr_discr` , 
                            `cdb_helpdesk`.`asing_by` , 
                            `cdb_helpdesk`.`cat_code` , 
                            `cdb_helpdesk`.`ssb_facility_amount` , 
                            '', /*`cdb_helpdesk`.`ssb_type`,*/
                            `cdb_helpdesk`.`help_discr`,
                            IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                            `cdb_helpdesk`.`ssb_app_number`,
                            `cdb_helpdesk`.`facno`,
                             0 as agedays, 
                             `cdb_helpdesk`.`curr_stage`,
                             `cdb_helpdesk`.`assign_to`,
                             `cdb_helpdesk`.`taken_by`,
                            IFNULL(`cdb_helpdesk`.priorCallRecOn,`cdb_helpdesk`.callRecOn), /*`cdb_helpdesk`.`lastactivityon`,*/
                            `cdb_helpdesk`.`appcrdate`, 
                            0 AS PEND,
                            0 AS FULL_TIME,
                        	0 AS FULL_TIME_AFTERVRF ,
                            0 AS ADII_UP,
                           `cdb_helpdesk`.`priorCallRecOn` AS priorCallRecOn ,
                           `cdb_helpdesk`.`cif` AS CIF ,
                           (SELECT COUNT(*) FROM callcenterinquiry AS c WHERE c.callstatus = 0 AND c.call_answered = 'NO' AND c.helpid = `cdb_helpdesk`.`helpid`) AS COUNT_CALL,
						   `cdb_helpdesk`.CallAssgined
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
       `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry AS c
											WHERE c.callstatus = 1) 
	    AND date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) 
        AND `cdb_helpdesk`.callRecOn IS NOT NULL  
       ORDER BY `cdb_helpdesk`.`priorCallRecOn` desc , `cdb_helpdesk`.callRecOn;";
	//echo $v_sql_det_detels; callinqclosure	
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
          $sql_count_note = "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
          $v_que_count_note = mysqli_query($conn,$sql_count_note);
          while($rec_count_note =  mysqli_fetch_array($v_que_count_note)){
                $f_Col = "#000000";
                if($rec_count_note[0] != 0){
                    $f_Col = "#000000";
                }else{
                    $f_Col = "#000000";
                }  
          }
    
    //-------------------------------------
    
    
        $entryBy = getUserNameGenaral_Mob_Eml($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral_Mob_Eml($rec_det_detels[9],$conn);
        $index++;
        if($rec_det_detels[8]=='Highest'){
            $col = "#000000";
        }else{
            $col = "#000000";
        }
        $MyRow = "";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        

        $add_img_Col = "#FFFFFF";
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded"){
               $col = "#BB11F3;";
               if($rec_det_detels[26] > 15){
                    $add_img_Col = "#ff9999";
               }
           }
            
        }
        
        $colLos = "";
        if($rec_det_detels[19] == "SSOO"){
           $colLos = "background-color: #b3ffb3;";
        }

		$colP = "";
		//Call count more than 0 line colouring.......";
        if($rec_det_detels[29] != 0){
            $colP = "background-color: #ffffb3;";
        }
        
        //Priority line colouring.......";
        if($rec_det_detels[27]!=""){
            $colP = "background-color: #ff8080;";
        }
        		
        echo "<tr style='color: ".$col.";".$colP."'>";
        
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
		//echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[22]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$colLos ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>"; 
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        
        /*Rizvi */
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]. "". ($rec_det_detels[21] == '0000-00-00 00:00:00' ? '' : $rec_det_detels[21]) ." </span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[30]."</span></td>";	   
	    echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[28]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[29]."</span></td>";
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title,".$rec_det_detels[10].");'/></td>";
        echo "</tr>";
    }
?>
</table>
</span>
<div style="display: none;">
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
</div>

<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<?php

if(isset($_POST['btnReq']) && $_POST['btnReq']=='Submit'){
    mysqli_autocommit($conn,FALSE);
    try{
            // Validation rule engine
        if(trim($_POST['get_help_ID']) != "" && trim($_POST['txtarea_Solution']) != ""){
                    //$getmail = 0;
            date_default_timezone_set('Asia/Colombo');
            
           $sql_ex = "SELECT COUNT(s.helpid)  FROM callinqclosure AS s WHERE s.helpid = ".trim($_POST['get_help_ID']).";";  
           $que_ex = mysqli_query($conn,$sql_ex) or die(mysqli_error($conn));
           while($r_ex = mysqli_fetch_array($que_ex)){
                if($r_ex[0] == 0){
                       if($_POST['selCallAnswered'] == "YES"){
                                    //email BOIC
                                    $StrCallAnswered = "Customer Call Answered : Yes ";
                                    if(trim($_POST['selCallFeedback']) == 1){
                                        $strCallFeedback = "<tr>
                                                             <td>Customer Feedback </td><td>: Verified </td>
                                                             </tr>";
                                    }else if(trim($_POST['selCallFeedback']) == 2){
                                        $strCallFeedback = "<tr>
                                                             <td>Customer Feedback </td><td>: Descrepency </td>
                                                            </tr>";
                                        if(trim($_POST['selCallFeedbackYES']) != ""){
                                            $strCallFeedback .= "<tr>
                                                                  <td>Discrepancy type </td><td>: ".trim($_POST['selCallFeedbackYES'])."</td>
                                                            </tr>";
                                        }
                                    }else{
                                        $strCallFeedback = "";
                                    }
                                    
                                    
                                    /*Implement the uniquq closure*/
                                    $sql_InsertClosure = "INSERT INTO callinqclosure VALUES (".trim($_POST['get_help_ID'])." , now(),'".$_SESSION['user']."')";
                                    $stmt_InsertClosure = mysqli_query($conn,$sql_InsertClosure) or die(mysqli_error($conn));
                                    /*End of Implement the uniquq closure*/
                                    
                                    $sql_upadte_dis = "INSERT INTO callcenterinquiry(helpid , call_answered , call_feedback , remark , enrtyby , callstatus,callFeedback)
                                                        VALUES (".trim($_POST['get_help_ID'])." , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 1, '".trim($_POST['selCallFeedbackYES'])."');";
                                    $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                                    
                    				/*-------------------------------------------------------------------------------------------------
                    				Added by Rizvi on 10:30 AM 16/03/2018
                    				-------------------------------------------------------------------------------------------------*/
                    				$cif = 0;
                    				$mailfacno = "";
                                    $sql_getcif = "SELECT C.CIF,C.FACNO FROM CDB_HELPDESK C WHERE C.HELPID = ".trim($_POST['get_help_ID']);
                                    $query_getcif = mysqli_query($conn,$sql_getcif) or die(mysqli_error($conn));                
                    				while($rec_getcif = mysqli_fetch_array($query_getcif)){
                    					$cif = $rec_getcif[0];
                    					$mailfacno = $rec_getcif[1];
                    				}
                    				
                    				$to_cc = "";			
                    				//$sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber in (select '".trim($_POST['get_entryBranch'])."' as bran from dual union select user.email BRNCOMAIL from user where user.branchNumber in (select cdb_unit_op.CDB_PARENT_BRANCHNUMBER from cdb_unit_op where cdb_unit_op.CDB_UNIT_BRANCHNUMBER = '".trim($_POST['get_entryBranch'])."') and user.usergroupNumber = 'ug00020' and user.userStat = 'A')";			
                    				//doLogger($conn,$sql_getBranCOMAIL);		
                                    $sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber = '".trim($_POST['get_entryBranch']). "' and user.usergroupNumber = 'ug00020' and user.userStat = 'A'";
                                    $query_getBranCOMAIL = mysqli_query($conn,$sql_getBranCOMAIL) or die(mysqli_error($conn));
                    				while($rec_getCOMAIL = mysqli_fetch_array($query_getBranCOMAIL)){
                    					if($to_cc == ""){
                    						$to_cc = $to_cc .$rec_getCOMAIL[0];
                    					}else{
                    						$to_cc = $to_cc . ";" . $rec_getCOMAIL[0];
                    					}					
                    				}		
                    				if($to_cc == "")				
                    					$to_cc = "";
                    				else
                    					$to_cc = $to_cc."";
                    				/*End of Added by Rizvi on 10:30 AM 16/03/2018*/
                    
                    				
                                    $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".trim($_POST['get_entryBranch'])."'";
                                    $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                                    $to = "";
                                     
                                    $subject = "Facility approval Call - Call Centre.";
                                    $messageBodyIn = "
                                                    <h4>Facility approval Call - Call Centre.</h4>
                                                    <table>
                                                        <tr><td>Ref </td><td>: ".trim($_POST['get_help_ID'])."</td></tr>
                                                        <tr><td>Client code </td><td>: ".$cif."</td></tr>	
                    									<tr><td>Facility No </td><td>: ".$mailfacno."</td></tr>										
                                                        <tr><td>Note </td><td>: ".$StrCallAnswered."</td></tr>";
                                    if($strCallFeedback != ""){
                                        $messageBodyIn .= $strCallFeedback;
                                    }
                                    $messageBodyIn .= " <tr><td>Remark </td><td>: ".trim($_POST['txtarea_Solution'])."</td><tr></table>";
                                                                
                                    $sender = $_SESSION['user'];
                                    while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                                       /* if($rec_getbranchdtl[0] != ""){
                                            $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                                        }*/
                                                
                                        if($rec_getbranchdtl[1] != ""){
                                            $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                                        }
                                    }
                                            //echo $to;
                                    if($to != ""){
                                        //$to = "wimukthi.madushan@cdb.lk";
                                        mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                                    }
                                }else if($_POST['selCallAnswered'] == "NO"){
                                    if(isset($_POST['chk_C'])){
                                        $StrCallAnswered = "Customer Call Answered : No ";
                                        $strCallFeedback = "";
                                       
                                        if(trim($_POST['selCallFeedbackNO']) != ""){
                                            $strCallFeedback = "<tr><td>Feedback Inquiry </td><td>: ".trim($_POST['selCallFeedbackNO'])."</td></tr>";
                                        }
                                        
                                        /*Implement the uniquq closure*/
                                        $sql_InsertClosure = "insert into callinqclosure VALUES (".trim($_POST['get_help_ID'])." , now(),'".$_SESSION['user']."')";
                                        $stmt_InsertClosure = mysqli_query($conn,$sql_InsertClosure) or die(mysqli_error($conn));
                                        /*End of Implement the uniquq closure*/
                                        
                    
                                        $sql_upadte_dis = "INSERT INTO callcenterinquiry(helpid , call_answered , call_feedback , remark , enrtyby , callstatus ,callFeedback)
                                                            VALUES (".trim($_POST['get_help_ID'])." , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 1 , '".trim($_POST['selCallFeedbackNO'])."');";
                                        $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                                        
                                        /*CBS NOTE TO BE CREATED........*/
                    					/*END OF CBS NOTE TO BE CREATED*/
                                        
                    					/*-------------------------------------------------------------------------------------------------
                    					Added by Rizvi on 10:30 AM 16/03/2018
                    					-------------------------------------------------------------------------------------------------*/
                    					$cif = 0;
                    					$mailfacno = "";
                    					$sql_getcif = "SELECT C.CIF,C.FACNO FROM CDB_HELPDESK C WHERE C.HELPID = ".trim($_POST['get_help_ID']);
                    					$query_getcif = mysqli_query($conn,$sql_getcif) or die(mysqli_error($conn));                
                    					while($rec_getcif = mysqli_fetch_array($query_getcif)){
                    						$cif = $rec_getcif[0];
                    						$mailfacno = $rec_getcif[1];
                    					}
                    					
                    					$to_cc = "";			
                    					//$sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber in (select '".trim($_POST['get_entryBranch'])."' as bran from dual union select user.email BRNCOMAIL from user where user.branchNumber in (select cdb_unit_op.CDB_PARENT_BRANCHNUMBER from cdb_unit_op where cdb_unit_op.CDB_UNIT_BRANCHNUMBER = '".trim($_POST['get_entryBranch'])."') and user.usergroupNumber = 'ug00020' and user.userStat = 'A')";			
                    					//doLogger($conn,$sql_getBranCOMAIL);		
                    					$sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber = '".trim($_POST['get_entryBranch']). "' and user.usergroupNumber = 'ug00020' and user.userStat = 'A'";
                    					$query_getBranCOMAIL = mysqli_query($conn,$sql_getBranCOMAIL) or die(mysqli_error($conn));
                    					while($rec_getCOMAIL = mysqli_fetch_array($query_getBranCOMAIL)){
                    						if($to_cc == ""){
                    							$to_cc = $to_cc .$rec_getCOMAIL[0];
                    						}else{
                    							$to_cc = $to_cc . ";" . $rec_getCOMAIL[0];
                    						}					
                    					}		
                    					if($to_cc == ""){				
                    						$to_cc = "";
                    					}else{
                    						$to_cc = $to_cc."";
                    					}
                    					/*End of Added by Rizvi on 10:30 AM 16/03/2018*/
                    					
                                        $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".trim($_POST['get_entryBranch'])."'";
                                        $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                                        $to = "";
                                        //$to_cc = "";
                                        $subject = "Approval Call Alert - Call Center Inquiry !.";
                                        $messageBodyIn = "
                                                        <h4>Call Center Inquiry!</h4>
                                                        <table>
                                                            <tr><td>Ref </td><td>: ".trim($_POST['get_help_ID'])."</td></tr>
                    										<tr><td>Client code </td><td>: ".$cif."</td></tr>	
                    										<tr><td>Facility No </td><td>: ".$mailfacno."</td></tr>										
                                                            <tr><td>Note </td><td>: ".$StrCallAnswered."</td></tr>";
                                        if($strCallFeedback != ""){
                                            $messageBodyIn .= $strCallFeedback;
                                        }
                                        $messageBodyIn .= "<tr><td>Remark </td><td>: ".trim($_POST['txtarea_Solution'])."</td> </tr></table>";
                                                                    
                                        $sender = $_SESSION['user'];
                                        while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                                           /* if($rec_getbranchdtl[0] != ""){
                                                $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                                            }*/
                                                    
                                            if($rec_getbranchdtl[1] != ""){
                                                $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                                            }
                                        }
                                                //echo $to;
                                        if($to != ""){
                                            //$to = "wimukthi.madushan@cdb.lk";
                                            mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                                        }
                                       
                                    }else{
                                        /**/
                                        
                                        /**/
                                        
                                        $sql_upadte_dis = "INSERT INTO callcenterinquiry(helpid , call_answered , call_feedback , remark , enrtyby , callstatus, callFeedback)
                                                            VALUES (".trim($_POST['get_help_ID'])." , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 0, '".trim($_POST['selCallFeedbackNO'])."');";
                    					echo $sql_upadte_dis;
                                        $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));    
                                        
                                        if(trim($_POST['selCallFeedbackNO']) != ""){
                                            $StrCallAnswered = "Customer Call Answered : No ";
                                            
                                            $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackNO']);
                                            
                    						/*-------------------------------------------------------------------------------------------------
                    						Added by Rizvi on 10:30 AM 16/03/2018
                    						-------------------------------------------------------------------------------------------------*/
                    						$cif = 0;
                    						$mailfacno = "";
                    						$sql_getcif = "SELECT C.CIF,C.FACNO FROM CDB_HELPDESK C WHERE C.HELPID = ".trim($_POST['get_help_ID']);
                    						$query_getcif = mysqli_query($conn,$sql_getcif) or die(mysqli_error($conn));                
                    						while($rec_getcif = mysqli_fetch_array($query_getcif)){
                    							$cif = $rec_getcif[0];
                    							$mailfacno = $rec_getcif[1];
                    						}
                    						
                    						$to_cc = "";			
                    						//$sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber in (select '".trim($_POST['get_entryBranch'])."' as bran from dual union select user.email BRNCOMAIL from user where user.branchNumber in (select cdb_unit_op.CDB_PARENT_BRANCHNUMBER from cdb_unit_op where cdb_unit_op.CDB_UNIT_BRANCHNUMBER = '".trim($_POST['get_entryBranch'])."') and user.usergroupNumber = 'ug00020' and user.userStat = 'A')";			
                    						//echo $sql_getBranCOMAIL;
                    						//doLogger($conn,$sql_getBranCOMAIL);		
                    						$sql_getBranCOMAIL = "select user.email BRNCOMAIL from user where user.branchNumber = '".trim($_POST['get_entryBranch']). "' and user.usergroupNumber = 'ug00020' and user.userStat = 'A'";
                    						$query_getBranCOMAIL = mysqli_query($conn,$sql_getBranCOMAIL) or die(mysqli_error($conn));
                    						while($rec_getCOMAIL = mysqli_fetch_array($query_getBranCOMAIL)){
                    							if($to_cc == ""){
                    								$to_cc = $to_cc .$rec_getCOMAIL[0];
                    							}else{
                    								$to_cc = $to_cc . ";" . $rec_getCOMAIL[0];
                    							}					
                    						}		
                    						if($to_cc == ""){				
                    							$to_cc = "";
                    						}else{
                    							$to_cc = $to_cc."";
                    						}
                    						/*End of Added by Rizvi on 10:30 AM 16/03/2018*/
                    						
                                            $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".trim($_POST['get_entryBranch'])."'";
                                            $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                                            $to = "";
                                            //$to_cc = "";
                                            $subject = "Approval Call Alert - Call Center Inquiry !.";
                                            $messageBodyIn = "
                                                            <h4>Call Center Inquiry!</h4>
                                                            <label>Ref :".trim($_POST['get_help_ID'])."</label><br /><br />
                    										<label>Client Code :".$cif."</label><br /><br />
                    										<label>Facility No :".$mailfacno."</label><br /><br />
                                                            <label>Note : ".$StrCallAnswered."</label><br /><br />";
                                            if($strCallFeedback != ""){
                                                $messageBodyIn .= "<label>".$strCallFeedback."</label><br />";
                                            }
                                            $messageBodyIn .= "<label>Remark : ".trim($_POST['txtarea_Solution'])."</label><br />";
                                                                        
                                            $sender = $_SESSION['user'];
                                            while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                                               /* if($rec_getbranchdtl[0] != ""){
                                                    $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                                                }*/
                                                        
                                                if($rec_getbranchdtl[1] != ""){
                                                    $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                                                }
                                            }
                                            //echo $to;
                                            if($to != ""){
                                                //$to = "wimukthi.madushan@cdb.lk";
                                                mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                                            }
                                        }                
                                    }
                                    
                                }   
                                
                                
                                
                                $sql_update_helpdesk = "UPDATE cdb_helpdesk AS ch
                                                            SET ch.priorCallRecOn = NULL
                                                            WHERE ch.helpid = ".trim($_POST['get_help_ID']).";";
                                $query_update_helpdesk = mysqli_query($conn,$sql_update_helpdesk) or die(mysqli_error($conn));
                                
                                 mysqli_commit($conn); 
                                 echo "<script> alert('Record Updated.');pageClose();</script>";      
                }else{
                    echo "<script> alert('Record NOT Updated. EXISTS HELP ID');pageClose();</script>"; 
                }
           }       
         }else{
            echo "<script> alert('Some Values are missing.');</script>";  
         }
            
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}

function mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender){
     $message = "<html>
                    <head>
                      <title>OPERATION</title>
                    </head>
                    <body>";
     $message .= $messageBodyIn;               
    $message .="</body>
                </html>";
    $message_body = mysqli_real_escape_string($conn,$message);
    $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), '".$sender."', '".$to."', '".$subject."', '".$message_body."', '".$to_cc."', '0000-00-00 00:00:00');";
        //echo $inseet_mailBox;
    $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));   
}

function getUserEmail($conn,$userID){
    $sql_get_email = "SELECT `email` FROM `user` WHERE `userName` = '".$userID."';";
    $query_get_email = mysqli_query($conn,$sql_get_email) or die(mysqli_error($conn));
    while($resat_get_email = mysqli_fetch_array($query_get_email)){
        return $resat_get_email[0];
    }
}

function doLogger($conn,$Logd){
	$InsertLog = "INSERT INTO tmpLogger(logdesc) VALUES ('".$Logd."');";
    $que_InsertLog = mysqli_query($conn,$InsertLog) or die(mysqli_error($conn));   
}

?>
</form>
</body>
</html>
