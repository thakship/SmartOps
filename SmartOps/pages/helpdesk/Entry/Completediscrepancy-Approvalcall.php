<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Complete discrepancy - Approval call 
Purpose			: To viwe Pending discrepancy list 
Author			: Madushan Wikramaarachchi
Date & Time		: 09.27 A.M 06/03/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/042";
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
		height:250px;
		/*overflow-y: scroll;*/
		border:#000000 solid 1px;
	}
        /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
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

function myFunction(title) {
   // alert(title);
    //var resTitle = title.split("|");
    //document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
   // var v_srting =  "P|"+resTitle[1]+"|Are you sure you want to update this?";
    popup(1,title);
}


function popup(x,title){
        //alert(x);
        //alert(title);
    if(x==1){ 
		    //alert('a');
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
				    //alert('b');
					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_callCenter.php"+"?get_D_Approve="+x+"&get_D_function="+title,true);
			mydataGried.send();
			document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
}

 function getCallFeedback(){
        var callAnswered = document.getElementById('selCallAnswered').value;
        //alert(callAnswered);
        if(callAnswered == "YES"){
            document.getElementById('callchk').style.display = "none";
            document.getElementById("chk_C").checked = false;
            
        }else if(callAnswered == "NO"){
            document.getElementById('callchk').style.display = "inherit";
            
        }else{
            document.getElementById('callchk').style.display = "none";
            document.getElementById("chk_C").checked = false;
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
		mydataNew.open('GET','ajaxEntryNewGrid_1.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();
       
    }else{ 
        if(key == 121){
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
    		mydataNew.open('GET','ajaxEntryNewGrid_1.php'+'?n_userID='+userID+'&n_userg='+userg,true);
    		mydataNew.send();
        }else{
             if(key == 119){
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
        		mydataNew.open('GET','ajaxEntryNewGrid_2.php'+'?v_userBranch='+userBranch,true);
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
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = subdate(date(now()),1) THEN 1 END) ,
	COUNT(CASE WHEN IFNULL(GREATEST(date(`cdb_helpdesk`.`callRecOn`),date(`cdb_helpdesk`.`priorCallRecOn`)),date(`cdb_helpdesk`.`callRecOn`)) = date(now()) AND `cdb_helpdesk`.`facno` = '' THEN 1 END) 
	FROM `cdb_helpdesk` ,callcenterinquiry AS c
 WHERE `cdb_helpdesk`.`cat_code` = '1014' AND `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
	    date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) 
        and `cdb_helpdesk`.callRecOn IS NOT NULL AND
       `cdb_helpdesk`.`helpid` = c.helpid AND
        ((c.callstatus = 1  AND c.call_feedback = 2 AND brn_reply_by <> '') OR (c.callstatus = 1  AND c.call_answered = 'NO' and c.callFeedback in ('Invalid Number','No such person','No contact number'))) and 
        c.d_call_chk = 0 ";
	  // echo $v_sql_det_detelsCNT;
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;	
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
        echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. "&nbsp;&nbsp;<font style='color:red; font-size:14px;'>[For the Day : ".$rec_det_detelsCNT[1]." - Not Initiated : ".$rec_det_detelsCNT[3]."]</font>&nbsp;&nbsp;<font style='color:blue; font-size:14px;'>[Yesterday : ".$rec_det_detelsCNT[2]." ]</font></h3>";
		echo "<font style='color:Green; font-size:14px;'>Sort : Application Creation Date - Descending</font>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Calibri, Helvetica, sans-serif; font-size:11px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
			<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">LOS Creation Date</span></td>
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:120px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:200px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:110px;text-align: left;"><span style="margin-left: 5px;">Facility Number</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Call Queued</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <!--<td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>--> 
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">CIF</span></td> 
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Descrepency</span></td> 
            <td style="width:250px;text-align: left;"><span style="margin-left: 5px;">Discrepancy Branch Note</span></td>
            <td style="width:250px;text-align: left;"><span style="margin-left: 5px;"></span></td>
            
			<!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">No Of Pending</span></td>-->
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken Full</span></td>-->
			<!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Minutes Taken - After Verification</span></td>-->
            <!--<td style="width:50px;"></td>-->
        </tr>
<?php


      $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                            (`cdb_helpdesk`.`enterDateTime`), 
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
                             datediff(date(now()),DATE(`cdb_helpdesk`.`enterDateTime`)) as agedays, 
                             `cdb_helpdesk`.`curr_stage`,
                             `cdb_helpdesk`.`assign_to`,
                             `cdb_helpdesk`.`taken_by`,
                            IFNULL(`cdb_helpdesk`.priorCallRecOn,`cdb_helpdesk`.callRecOn), /*`cdb_helpdesk`.`lastactivityon`,*/
                            `cdb_helpdesk`.`appcrdate`, 
                            (select count(*) from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'P') AS PEND,
                            ROUND(time_to_sec((TIMEDIFF(`cdb_helpdesk`.`appcrdate`, `cdb_helpdesk`.`enterDateTime`))) / 60) AS FULL_TIME,
                        	CASE  (select count(*) t from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'P') 
                         		WHEN  0 then 0 
                        	else		  ROUND(time_to_sec((TIMEDIFF((select max(pv.histdate) from cdb_ssb_his pv where pv.helpid = `cdb_helpdesk`.`helpid` and pv.P_V = 'V'), `cdb_helpdesk`.`enterDateTime`))) / 60)  
                           END AS FULL_TIME_AFTERVRF ,
                           ROUND(time_to_sec((TIMEDIFF(now(), `cdb_helpdesk`.`lastactivityon`))) / 60) AS ADII_UP,
                           `cdb_helpdesk`.`priorCallRecOn` AS priorCallRecOn ,
                           `cdb_helpdesk`.`cif` AS CIF,
                           (SELECT cq.brn_reply_remark FROM callcenterinquiry AS cq WHERE ((cq.callstatus = 1 AND cq.call_feedback = 2) OR (c.callstatus = 1  AND c.call_answered = 'NO' and c.callFeedback in ('Invalid Number','No such person','No contact number'))) AND cq.helpid = `cdb_helpdesk`.`helpid`) AS CALLEN_ID ,
                           (SELECT f.inquiry_id
                                    	FROM callcenterinquiry AS f
                                    	WHERE ((f.callstatus = 1 AND f.call_feedback = 2 AND f.brn_reply_by <> '') OR (c.callstatus = 1  AND c.call_answered = 'NO' and c.callFeedback in ('Invalid Number','No such person','No contact number'))) AND f.helpid = `cdb_helpdesk`.`helpid`) AS inquiry_id,
                           (SELECT c.CallFeedback FROM callcenterinquiry AS c WHERE c.helpid =  `cdb_helpdesk`.`helpid` and ((c.callstatus = 1 AND c.call_feedback = 2 AND brn_reply_by <> '')  OR (c.callstatus = 1  AND c.call_answered = 'NO' and c.callFeedback in ('Invalid Number','No such person','No contact number'))) ) as CallFeedback 
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,callcenterinquiry AS c
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND 
	   `cdb_helpdesk`.`cmb_code` = '5002' AND
       `cdb_helpdesk`.`cat_code` = '1014' AND
       `cdb_helpdesk`.`facno` <> '' AND `cdb_helpdesk`.`IsAppValid` = 4 AND
       `cdb_helpdesk`.`helpid` = c.helpid AND
        
        ((c.callstatus = 1  AND c.call_feedback = 2 AND brn_reply_by <> '' and c.d_call_chk = 0) OR (c.callstatus = 1  AND c.call_answered = 'NO' and c.callFeedback in ('Invalid Number','No such person','No contact number') AND c.d_call_chk = 0))  
        
        
        AND date(`cdb_helpdesk`.`callRecOn`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND  
        `cdb_helpdesk`.callRecOn IS NOT NULL 
       ORDER BY `cdb_helpdesk`.`priorCallRecOn` desc , `cdb_helpdesk`.callRecOn;";
	//echo $v_sql_det_detels;	 callcenterinquiry
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
    
    
    // -- develop by madushan - 2017-11-22
    /*   $sql_add_img_diff = "SELECT 
                                p.done_on ,
                                NOW() ,
                                ROUND(time_to_sec((TIMEDIFF(now(), p.done_on))) / 60)
                                FROM pending_upload_file AS p
                            WHERE p.help_id = ".$rec_det_detels[0]." AND
                                  p.removedon = '0000-00-00 00:00:00'
                            ORDER BY p.done_on DESC
                            LIMIT 1  " ;  
                                  
       $query_add_img_diff = mysqli_query($conn,$sql_add_img_diff);
       while($rec_add_img_diff =  mysqli_fetch_array($query_add_img_diff)){*/
                
              /*if($rec_det_detels[12] == "Additional Images Uploaded"){
                    if($rec_add_img_diff[2] > 15){
                        $add_img_Col = "#ff9999";
                    }else{
                        $add_img_Col = "#FFFFFF";
                    } 
                }
                     
          }*/
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
        
        /*
        if ($rec_det_detels[12] == "File re-submitted"){
           $col = "#3F12F3;";
        }
        */
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

        //echo $col."<BR>";
        $colP = "";
        /*if($rec_det_detels[27]){
            $colP = "background-color: #ff8080;";
        }*/
        echo "<tr style='color: ".$col.";".$colP."'>";
        
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
		echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[22]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:120px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:200px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$colLos ."'><span style='margin-left: 2px;'>".$rec_det_detels[16]."</span></td>"; 
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        
        /*Rizvi */
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]. "". ($rec_det_detels[21] == '0000-00-00 00:00:00' ? '' : $rec_det_detels[21]) ." </span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
       // echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
		 echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[28]."</span></td>";
		
        /*Rizvi*/        
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15].chr(10).$rec_det_detels[18].chr(10).$rec_det_detels[19].chr(10).$rec_det_detels[20]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
		 echo "<td style='width:70px;text-align: right;".$MyRow ."'title ='".$rec_det_detels[31]."'><span style='margin-right: 2px;'>".$rec_det_detels[31]."</span></td>";
        echo "<td style='width:250px;text-align: left;'><span style='margin-left: 5px;'>".$rec_det_detels[29]."</span></td>";
		
		/*Rizvi Added below line on 29-dec-2016 21 */
		//echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[23]."</span></td>";
		//echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[24]."</span></td>";
		//echo "<td style='width:70px;text-align: right;".$MyRow .";background-color:".$add_img_Col."'><span style='margin-right: 2px;'>".$rec_det_detels[25]."</span></td>";
		/*End Rizvi Added below line on 29-dec-2016 */
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'>".str_pad($rec_det_detels[17], 2, '0', STR_PAD_LEFT)."</span></td>";
        
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='".$rec_det_detels[30]."' onclick='myFunction(title)'/></td>";
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
    if(isset($_POST['btn_submit']) && $_POST['btn_submit'] == "Update"){
        echo "E";
        
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
        
        if(trim($_POST['txt_helpID_D']) != "" && trim($_POST['txtComment']) != ""){
                    //$getmail = 0;
                date_default_timezone_set('Asia/Colombo');
            
                    
                if($_POST['selCallAnswered'] == "YES"){
                //email BOIC
                $StrCallAnswered = "Customer Call Answered (Descrepency) : Yes ";
                
                
                $sql_upadte_dis = "UPDATE callcenterinquiry AS c 
                                    SET c.d_call_ans = '".$_POST['selCallAnswered']."',
                                        c.d_remark = '".$_POST['txtComment']."',
                                        c.d_call_ans_entryBy = '".$_POST['txt_USERMY']."',
                                        c.d_call_chk = 1 ,
                                        c.d_call_ans_entry_on = NOW()
                                    WHERE c.inquiry_id = ".$_POST['txt_helpID_D'].";";
                $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
            }else if($_POST['selCallAnswered'] == "NO"){
                if(isset($_POST['chk_C'])){
                    
                    
                    $sql_upadte_dis = "UPDATE callcenterinquiry AS c 
                                    SET c.d_call_ans = '".$_POST['selCallAnswered']."',
                                        c.d_remark = '".$_POST['txtComment']."',
                                        c.d_call_chk = 1 ,
                                        c.d_call_ans_entryBy = '".$_POST['txt_USERMY']."',
                                        c.d_call_ans_entry_on = NOW()
                                    WHERE c.inquiry_id = ".$_POST['txt_helpID_D'].";";
                      $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                    
                   
                }else{
                   
                    $sql_upadte_dis = "UPDATE callcenterinquiry AS c 
                                    SET c.d_call_ans = '".$_POST['selCallAnswered']."',
                                        c.d_remark = '".$_POST['txtComment']."',
                                        c.d_call_chk = 0 ,
                                        c.d_call_ans_entryBy = '".$_POST['txt_USERMY']."',
                                        c.d_call_ans_entry_on = NOW()
                                    WHERE c.inquiry_id = ".$_POST['txt_helpID_D'].";";
                      $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));            
                }
                
            }   
            
             mysqli_commit($conn); 
             echo "<script> alert('Record Updated.');pageClose();</script>";        
                   
         }else{
            echo "<script> alert('Some Values are missing.');</script>";  
         }
      }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
      }
        
    }

?>
</form>
</body>
</html>
