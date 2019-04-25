<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Creadit Card Call Inquery
Purpose			: To viwe Request Creadit Card 
Author			: Madushan Wikramaarachchi
Date & Time		: 01:43 PM 2018-06-06
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/053";
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
<title>Creadit Card Call Inquery</title>
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
		height:300px;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/credit_card_call_level01.php?DispName=Credit%20Card%20-%20Call%20Inquery','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/credit_card_call_level01.php?DispName=Credit%20Card%20-%20Call%20Inquery','conectpage');
}

function clientValidate(title,moduleCode){
    var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
    var helpClose = document.getElementById('txt_helpdesk_close').value;
   
       //alert(moduleCode);
        var mydata;
        var getHI = document.getElementById(title).value;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }          
        mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_creaditCard.php"+"?getHelpIDreq1="+getHI+"&gettxt_helpdesk_close1="+helpClose+"&get_moduleCode="+moduleCode,true);
        mydata.send();
    
    
}

function is_kiosk_ok(title,moduleCode){
    if(title == "R"){
        //alert('Recomented');
          var getsubHI = document.getElementById('txt_help_ID').value;
          var resTitle = title.split("|");
          var v_srting =  "R|"+getsubHI+"|Are you sure you want to Recommended this?";
          popup1(1,v_srting);
    }else if(title == "C"){
       // alert('Reject');
         var getsubHI = document.getElementById('txt_help_ID').value;
        mydata1= new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata1.responseText;     
                document.getElementById("chk_C").checked = true;  
                //document.getElementById("chk_C").disabled = true;   
            }
        }
        mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_creaditCard.php"+"?getsubHelpIDReject="+getsubHI+"&get_moduleCode="+moduleCode,true);
        mydata1.send();
    }else{
        alert('Not Difend Function');
    }
}

function is_kiosk_pending(title){
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
     ksrl_pn = ksrl_pn + " - "+ document.getElementById('txt_pnndingNOTI').value;
    //alert(ksrl_helpid);
    //alert(ksrl_user);
    //alert(ksrl_pn);
    //if(document.getElementById('chk_1').checked == true){
        chk_1 = 0;
    //}
    //if(document.getElementById('chk_2').checked == true){
        chk_2 = 0;
    //}
    //if(document.getElementById('chk_3').checked == true){
        chk_3 = 0;
    //}
    //if(document.getElementById('chk_4').checked == true){
        chk_4 = 0;
    //}
    //if(document.getElementById('chk_5').checked == true){
        chk_5 = 0;
    //}
    //if(document.getElementById('chk_6').checked == true){
        chk_6 = 0;
    //}
    //alert("A");
    if(ksrl_user != ""){
        //alert("B");
       if(document.getElementById('chk_1').checked == true && document.getElementById('chk_2').checked == true && document.getElementById('chk_3').checked == true && document.getElementById('chk_4').checked == true && document.getElementById('chk_5').checked == true && document.getElementById('chk_6').checked == true){
        //alert("C");
            $.ajax({ 
    				type:'POST', 
    				data: {get_ksrl_helpid : ksrl_helpid , get_chk_1 : chk_1 , get_chk_2 : chk_2 , get_chk_3 : chk_3 , get_chk_4 : chk_4 , get_chk_5 : chk_5 , get_chk_6 : chk_6 , get_ksrl_user : ksrl_user , get_ksrl_pn : ksrl_pn , get_title : title}, 
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
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
            //alert("D");
            var r = confirm('Confirm to proceed ?')
            if (r==true){
                //alert('function ok');
    			$.ajax({ 
    				type:'POST', 
    				data: {get_ksrl_helpid : ksrl_helpid , get_chk_1 : chk_1 , get_chk_2 : chk_2 , get_chk_3 : chk_3 , get_chk_4 : chk_4 , get_chk_5 : chk_5 , get_chk_6 : chk_6 , get_ksrl_user : ksrl_user , get_ksrl_pn : ksrl_pn , get_title : title}, 
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
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
        //alert("E");
    }else{
        alert('login user undifind.');
    }  
}  
function popup1(x,title){
       // alert(x);
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
			mydataGried.open("GET","credit_card_call_ajax.php"+"?get_Approve="+x+"&get_function="+title,true);
			mydataGried.send();
			document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
}
    
function getSolutionCallNotans(){
        var getsubHI = document.getElementById('txt_help_ID').value;
        mydata1= new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('callDiv').innerHTML=mydata1.responseText;           
            }
        }
        mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_creaditCard.php"+"?getsubHelpIDreq="+getsubHI,true);
        mydata1.send();
}

function getSolutionCallNotans1(){
      //alert('A');
        var getsubHI = document.getElementById('txt_help_ID').value;
        mydata1= new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('callDiv').innerHTML=mydata1.responseText;           
            }
        }
        mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax_creaditCard.php"+"?getsubHelpIDreqYes="+getsubHI,true);
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

function isAddiImgRequset(title){
    //alert(title);
    var helpID = title;
    var aIType = "K";
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/applicationPendingUpload.php?DispName=Application%20%20Pending%20Upload&helpID='+helpID+'&pendingUploadImgType='+aIType,'conectpage');
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
    				url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
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
    
    function isEnableBtnForRecoment(){
        //alert('A');
        var isOK = 0;
        var r = document.getElementById('text_X').value;
        //alert(r);
        for (i = 1; i < r; i++){
           // alert(i);
            if(document.getElementById('chk_'+i).checked == false){
                isOK++;
            }
        }
        //alert(isOK);
        if(isOK == 0){
            document.getElementById("btnRecommend").disabled = false;
        }else{
            document.getElementById("btnRecommend").disabled = true;
        }
        
         /* for ($q = 1 ; $q < $_POST['text_X'] ; $q++){
                if(isset($_POST['chk_'.$q])){*/
    }
</script>
<script>
var metaChar = false;
function keyEvent(event) {
  var key = event.keyCode || event.which;
   // alert("Key pressed " + key);
   // return;
      
     if(key == 112||key == 113){
        alert("Key pressed " + key);
        var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','Ajax_Credit_card_call_level01F.php'+'?userg_CRditCC='+userg+"&FKey="+key,true);
		mydataNew.send();
    }
}
</script>

</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	//echo $_REQUEST['DispName'];
	echo ($_REQUEST['FKey'] == 119?"Q1":"Q2")
?>	
</p><hr/>
<span id="maneSpan">

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
<td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Type</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Total</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Q1</span></td>
<td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Q2</span></td></tr>
<?php 
	$vColTot = 0; $vColTotQ1 = 0; $vColTotQ2 = 0;
	$v_sql_headerInfo = "SELECT MIS.SSBTYPE,
									 SUM(MIS.NOS) AS NOS,
									 SUM(MIS.q1) AS q1,
									 SUM(MIS.q2) AS q2 FROM (
							SELECT if (`cdb_helpdesk`.ssb_type like 'Pending Notified%' , 'Pending Notified' , `cdb_helpdesk`.ssb_type) AS SSBTYPE, 
										1 AS NOS
									   ,IF(IFNULL((SELECT COUNT(*) FROM credit_card_call_dtl AS cq  WHERE cq.helpid = cdb_helpdesk.helpid AND  cq.q_module_id = 1),0) = 0 , 1 , 0) AS Q1
									   ,IF(IFNULL((SELECT COUNT(*) FROM credit_card_call_dtl AS cq  WHERE cq.helpid = cdb_helpdesk.helpid AND  cq.q_module_id = 1),0) > 0 , 1 , 0) AS Q2  
							 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
							 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
								   `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
								   `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
								   `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
								   `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
								   `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
								   `cdb_helpdesk`.`cmb_code` = '5050' AND
								   `cdb_helpdesk`.`cat_code` = '1038' AND
								   `cdb_helpdesk`.`ssb_app_number` = '' AND date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
								   `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."' AND
								   `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid FROM callcenterinquiry_creaditcard AS c WHERE c.callstatus = 1)".($_REQUEST['FKey'] == 119?"AND NOT exists (select 1 from credit_card_call_dtl cq where cq.helpid = cdb_helpdesk.helpid)":"AND EXISTS (select 1 from credit_card_call_dtl cq where cq.helpid = cdb_helpdesk.helpid and cq.q_module_id = 1)")."
								    
							) MIS GROUP BY MIS.SSBTYPE";
	   $v_Rs_headerInfo = mysqli_query($conn,$v_sql_headerInfo);
	   while($v_Rec_headerInfo = mysqli_fetch_array($v_Rs_headerInfo)){
		   echo "<tr>";
		   echo "<td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[0] ."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[1]."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[2] ."</span></td>";
		   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$v_Rec_headerInfo[3] ."</span></td>";
		   echo "</tr>";
		   $vColTot = $vColTot + $v_Rec_headerInfo[1]; 
		   $vColTotQ1 = $vColTotQ1+ $v_Rec_headerInfo[2]; 
		   $vColTotQ2 = $vColTotQ2 + $v_Rec_headerInfo[3] ;
	   } 
	   echo "<tr>";
	   echo "<td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>"."T O T A L"."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTot."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTotQ1 ."</span></td>";
	   echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$vColTotQ2 ."</span></td>";
	   echo "</tr>";
?>	
</table>;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA; font-size: 11; font-weight: bold;">
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
			<!--<td style="width:90px;text-align: left;"><span style="margin-left: 5px;">Approval</span></td>-->
            <td style="width:90px;text-align: left;"><span style="margin-left: 5px;">File Type</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Facility Amount</span></td>
            <td style="width:260px;text-align: left;"><span style="margin-left: 5px;">Client Information</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
            <td style="width:190px;text-align: left;"><span style="margin-left: 5px;">SSB Type</span></td>
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:70px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <!--<td style="width:40px;text-align: left;"><span style="margin-left: 5px;">App</span></td>
            <td style="width:40px;text-align: left;"><span style="margin-left: 5px;">Fac</span></td>-->
            <td style="width:70px;text-align: right;"><span style="margin-right: 5px;">Call Count</span></td> 
            <td style="width:250px;"></td>
        </tr>
<?php
 $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , 
                             `cdb_helpdesk`.`enterDateTime`, 
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
                              CONCAT(`cdb_helpdesk`.`ssb_type`), 
                              `cdb_helpdesk`.`help_discr`,
                              IF(`cdb_helpdesk`.`ssb_app_number` = '', 4, `cdb_helpdesk`.`IsAppValid`) as validapp,
                              `cdb_helpdesk`.`ssb_app_number`,
                              `cdb_helpdesk`.`facno`,
                              datediff(date(now()),DATE(`cdb_helpdesk`.`enterDateTime`)) as agedays,
                              `cdb_helpdesk`.`curr_stage`,
                              `cdb_helpdesk`.`assign_to`,
                              `cdb_helpdesk`.`taken_by`,
                              `cdb_helpdesk`.`mainFileType`,
                              (SELECT COUNT(*) FROM callcenterinquiry_creaditcard AS c WHERE c.callstatus = 0 AND c.call_answered = 'NO' AND c.helpid = `cdb_helpdesk`.`helpid`) AS COUNT_CALL ,
                               (select s.scat_discr_3 from scat_03 AS s WHERE s.cat_code = `cdb_helpdesk`.`cat_code` AND s.scat_code_1 = `cdb_helpdesk`.`scat_code_1` AND s.scat_code_2 = `cdb_helpdesk`.`scat_code_2` AND s.scat_code_3 = `cdb_helpdesk`.`scat_code_3`) AS scat3
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5050' AND
       `cdb_helpdesk`.`cat_code` = '1038' AND
       `cdb_helpdesk`.`ssb_app_number` = '' AND date(`cdb_helpdesk`.`enterDateTime`) >= (CURRENT_DATE - INTERVAL 30 DAY) AND 
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."' AND
       `cdb_helpdesk`.`helpid` NOT IN (SELECT c.helpid
											FROM callcenterinquiry_creaditcard AS c
											WHERE c.callstatus = 1)
       ".($_REQUEST['FKey'] == 119?"AND NOT exists (select 1 from credit_card_call_dtl cq where cq.helpid = cdb_helpdesk.helpid) AND `cdb_helpdesk`.`ssb_type` = 'Credit Evalution - Recommended'":"AND EXISTS (select 1 from credit_card_call_dtl cq where cq.helpid = cdb_helpdesk.helpid and cq.q_module_id = 1)")."
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
       
       /*
         
       */
	//echo $v_sql_det_detels;
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
        
        if ($rec_det_detels[12] == "File re-submitted" || $rec_det_detels[12] == "Additional Images Uploaded"){
           $col = "#3F12F3;";
           if($rec_det_detels[12] == "Additional Images Uploaded")
            $col = "#BB11F3;";
        }
        $colP = "";
		//Call count more than 0 line colouring.......";
        if($rec_det_detels[22] != 0){
            $colP = "background-color: #ffffb3;";
        }
        //echo $col."<BR>";
        
        $colSCAT3 = "";
        if($rec_det_detels[23] == "CDB STAFF"){
             $colSCAT3 = "background-color: #e066ff;";
        }
        echo "<tr style='color: ".$col.";".$colP."'>";
        
        if($rec_det_detels[17] <= 15){
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";".$colSCAT3."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }else{
            echo "<td style='width:80px;text-align: right;".$MyRow .";color: ".$f_Col.";".$colSCAT3."' title ='".$rec_det_detels[17]." days'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><img src='../../../img/exp.png' height='15' width='5'><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        }
        echo "<td style='width:200px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
		//echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[21]."</span></td>";
        echo "<td style='width:90px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".number_format($rec_det_detels[11], 2)."</span></td>";
        echo "<td style='width:260px;text-align: left;".$MyRow ."' title='".$rec_det_detels[13]."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>"; 
        echo "<td style='width:100px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        
        echo "<td style='width:190px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[12]."</span></td>";
        
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        /*echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";*/
        echo "<td style='width:70px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        /*Rizvi*/        
       /* echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[15].chr(10).$rec_det_detels[18].chr(10).$rec_det_detels[19].chr(10).$rec_det_detels[20]."'><span style='margin-left: 5px;'><img src='../../../img/".$rec_det_detels[14].".png'></span></td>";
        echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'><img src='../../../img/".($rec_det_detels[16]==""?"4":"1").".png'></span></td>";*/
        //echo "<td style='width:40px;text-align: left;' title ='".$rec_det_detels[16]."'><span style='margin-left: 5px;'>".str_pad($rec_det_detels[17], 2, '0', STR_PAD_LEFT)."</span></td>";
        echo "<td style='width:70px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[22]."</span></td>";
        echo "<td style='width:250px;'>";
          
                $sql_btn1 = "SELECT COUNT(*) 
                               FROM credit_card_call_dtl AS cq 
                              WHERE cq.helpid = '".$rec_det_detels[0]."' ;";
                //echo $sql_btn1."<br/>";
                $query_btn1 = mysqli_query($conn,$sql_btn1) or die(mysqli_error($conn));
                while ($rec_btn1 = mysqli_fetch_array($query_btn1)){
                    if($rec_btn1[0] == 0){
                         echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                         echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                         //echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                    }else{
                        $a = "N";
                        $b = "N";
                        $c = "N";
                        $z = 0;
                        $sql_btn2 = "SELECT COUNT(cq.q_module_id) 
                                       FROM credit_card_call_dtl AS cq 
                                      WHERE cq.helpid = '".$rec_det_detels[0]."'
                                         AND  cq.q_module_id = 1 ;";
                        //echo $sql_btn2."<br/>";
                        $query_btn2 = mysqli_query($conn,$sql_btn2) or die(mysqli_error($conn));
                        while($resalt_btn2 = mysqli_fetch_array($query_btn2)){
                            //echo $resalt_btn2[0]." - ";
                            if($resalt_btn2[0] != 0){
                                $a = "Y";
                            }
                        }
                        $sql_btn3 = "SELECT COUNT(cq.q_module_id) 
                                       FROM credit_card_call_dtl AS cq 
                                      WHERE cq.helpid = '".$rec_det_detels[0]."'
                                         AND  cq.q_module_id = 2 ;";
                        //echo $sql_btn3."<br/>";
                        $query_btn3 = mysqli_query($conn,$sql_btn3) or die(mysqli_error($conn));
                        while($resalt_btn3 = mysqli_fetch_array($query_btn3)){
                           //echo $resalt_btn3[0]." - ";
                            if($resalt_btn3[0] != 0){
                                $b = "Y";
                            }
                        }
                        /*$sql_btn4 = "SELECT COUNT(cq.q_module_id) 
                                       FROM credit_card_call_dtl AS cq 
                                      WHERE cq.helpid = '".$rec_det_detels[0]."'
                                         AND  cq.q_module_id = 3 ;";
                        //echo $sql_btn4."<br/>";
                        $query_btn4 = mysqli_query($conn,$sql_btn4) or die(mysqli_error($conn));
                        while($resalt_btn4 = mysqli_fetch_array($query_btn4)){
                            //echo $resalt_btn4[0]." - ";
                            if($resalt_btn4[0] != 0){
                                $c = "Y";
                            }
                        }*/
                        //echo $a . " | " .$b . " | " . $c; 
                        //if($a == "Y" && $b == "N" && $c == "N"){
                        if($a == "Y" && $b == "N"){
                                // echo "A";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                 //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                        //}else if($a == "Y" && $b == "Y" && $c == "N"){
                        }else if($a == "Y" && $b == "Y"){
                              //  echo "B";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                 //echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                        }/*else if($a == "Y" && $b == "N" && $c == "Y"){
                               // echo "C";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q1' title='txta".$index."' onclick='clientValidate(title,1);'/>&nbsp;&nbsp;";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='Q2' title='txta".$index."' onclick='clientValidate(title,2);'/>&nbsp;&nbsp;";
                                 echo "<input type='button' class='buttonManage' id='btn_Validate' disabled='disabled' name='btn_Validate' value='Q3' title='txta".$index."' onclick='clientValidate(title,3);'/>&nbsp;&nbsp;";
                        }*/else{
                            
                        }
                        
                    }
                }
                
          // }
        echo "</td>";
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
        if(trim($_POST['get_help_ID']) != "" && trim($_POST['txtarea_Solution']) != ""){
                    //$getmail = 0;
                    //------------------------------------------------------------------------------------- 
            date_default_timezone_set('Asia/Colombo');
            
           //$sql_ex = "SELECT COUNT(s.helpid)  FROM callinqclosure AS s WHERE s.helpid = ".trim($_POST['get_help_ID']).";";  
           //$que_ex = mysqli_query($conn,$sql_ex) or die(mysqli_error($conn));
           //while($r_ex = mysqli_fetch_array($que_ex)){
                //if($r_ex[0] == 0){
                if($_POST['selCallAnswered'] == "NO"){ 
                    if(isset($_POST['chk_C'])){
                        $StrCallAnswered = "Customer Call Answered : No ";
                        $strCallFeedback = "";
                                       
                        if(trim($_POST['selCallFeedbackNO']) != ""){
                            $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackNO']);
                        }
                                        
                        /*Implement the uniquq closure*/
                        $sql_InsertClosure = "insert into callinqclosure_creaditcard VALUES (".trim($_POST['get_help_ID'])." , now(),'".$_SESSION['user']."')";
                        $stmt_InsertClosure = mysqli_query($conn,$sql_InsertClosure) or die(mysqli_error($conn));
                        /*End of Implement the uniquq closure*/
                                        
                    
                        $sql_upadte_dis = "INSERT INTO callcenterinquiry_creaditcard(helpid , call_answered , call_feedback , remark , enrtyby , callstatus ,callFeedback)
                                            VALUES (".trim($_POST['get_help_ID'])." , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 1 , '".trim($_POST['selCallFeedbackNO'])."');";
                        $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                        
                        $DIS =  "Call center  - File Reject. " .$StrCallAnswered." / ".$strCallFeedback ." - ".trim($_POST['txtarea_Solution']);
                        setNoteCreditCard($conn,trim($_POST['get_help_ID']),$DIS,$_SESSION['user']);
                         
                        CreateNoteTable($conn ,trim($_POST['get_help_ID']),$DIS,$_SESSION['user'],'CREDITC');
                        
                         $v_update_sql = "UPDATE `cdb_helpdesk` 
                                             SET `cmb_code`='5005', 
                                                 `caloser_by`= '".$_SESSION['user']."', 
                                                 `caloser_dateTime`= now(), 
                                                 `resulution`='".$StrCallAnswered."', 
                                                 `solution`='".$strCallFeedback."', 
                                                 `solved_by`= '".$_SESSION['user']."',
                                                 `solved_on`= now() 
                                           WHERE `helpid` = '".trim($_POST['get_help_ID'])."';";
                        $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(mysqli_error($conn));
       
                                        
                    				
                                       /* $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".trim($_POST['get_entryBranch'])."'";
                                        $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                                        $to = "";
                                        
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
                                          
                                                    
                                            if($rec_getbranchdtl[1] != ""){
                                                $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                                            }
                                        }
                                           
                                        if($to != ""){
                                            //$to = "wimukthi.madushan@cdb.lk";
                                            mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                                        }*/
                                       
                    }else{
                                       
                        $sql_upadte_dis = "INSERT INTO callcenterinquiry_creaditcard(helpid , call_answered , call_feedback , remark , enrtyby , callstatus, callFeedback)
                                                            VALUES ('".trim($_POST['get_help_ID'])."' , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 0, '".trim($_POST['selCallFeedbackNO'])."');";
                    					 //echo $sql_upadte_dis;
                        $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));    
                        $StrCallAnswered = "Customer Call Answered : No ";
                        $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackNO']);
                        $DIS = $StrCallAnswered." / ".$strCallFeedback ." - ".trim($_POST['txtarea_Solution']);
                        setNoteCreditCard($conn,trim($_POST['get_help_ID']),$DIS,$_SESSION['user']);
                        CreateNoteTable($conn ,trim($_POST['get_help_ID']),$DIS,$_SESSION['user'],'CREDITC');
                        //setNoteCreditCard($conn,$gethelpID,$note_dis,$user)
                                        
                                        
                                        /*if(trim($_POST['selCallFeedbackNO']) != ""){
                                            $StrCallAnswered = "Customer Call Answered : No ";
                                            
                                            $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackNO']);
                                            
                    						$cif = 0;
                    						$mailfacno = "";
                    						$sql_getcif = "SELECT C.CIF,C.FACNO FROM CDB_HELPDESK C WHERE C.HELPID = ".trim($_POST['get_help_ID']);
                    						$query_getcif = mysqli_query($conn,$sql_getcif) or die(mysqli_error($conn));                
                    						while($rec_getcif = mysqli_fetch_array($query_getcif)){
                    							$cif = $rec_getcif[0];
                    							$mailfacno = $rec_getcif[1];
                    						}
                    						
                    						$to_cc = "";			
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
                    						
                                            $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".trim($_POST['get_entryBranch'])."'";
                                            $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                                            $to = "";
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
                                                if($rec_getbranchdtl[1] != ""){
                                                    $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                                                }
                                            }
                                            if($to != ""){
                                               mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                                            }
                                        }    */            
                    }
                                    
                }else if($_POST['selCallAnswered'] == "YES"){
                   // echo "<script> alert('A')</script>"; 
                    $StrCallAnswered = "Customer Call Answered : Yes ";
                                     
                    $sql_upadte_dis = "INSERT INTO callcenterinquiry_creaditcard(helpid , call_answered , call_feedback , remark , enrtyby , callstatus,callFeedback)
                                        VALUES (".trim($_POST['get_help_ID'])." , '".trim($_POST['selCallAnswered'])."' , '".trim($_POST['selCallFeedback'])."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 0, '".trim($_POST['selCallFeedbackYES'])."');";
                    $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                   // $StrCallAnswered = "Customer Call Answered : No ";
                    $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackYES']);
                    $DIS = $StrCallAnswered." / ".$strCallFeedback;
                    setNoteCreditCard($conn,trim($_POST['get_help_ID']),$DIS,$_SESSION['user']);
                    CreateNoteTable($conn ,trim($_POST['get_help_ID']),$DIS,$_SESSION['user'],'CREDITC');
                }else{
                     echo "<script> alert('B')</script>"; 
                }
                                
                                
                                
                    mysqli_commit($conn); 
                    echo "<script> alert('Record Updated.');pageClose();</script>";      
                    //------------------------------------------------------------------------------------- 
         }else{
            echo "<script> alert('Some Values are missing.');</script>";  
         }
            
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}

if(isset($_POST['btnReqReject']) && $_POST['btnReqReject']=='Submit'){
    mysqli_autocommit($conn,FALSE);
    try{
        if(trim($_POST['get_help_ID']) != "" && trim($_POST['selCallFeedbackNO']) != "" && trim($_POST['txtarea_Solution']) != ""){
                    //$getmail = 0;
                    //------------------------------------------------------------------------------------- 
            date_default_timezone_set('Asia/Colombo');
        
                        $selCallAnswered= "NO";
                        $call_feedback = "";
                        $StrCallAnswered = "Customer Call Answered : No ";
                        $strCallFeedback = "";
                                      
                        if(trim($_POST['selCallFeedbackNO']) != ""){
                            $strCallFeedback = "Feedback Inquiry : ".trim($_POST['selCallFeedbackNO']);
                        }
                                        
                        /*Implement the uniquq closure*/
                        $sql_InsertClosure = "insert into callinqclosure_creaditcard VALUES (".trim($_POST['get_help_ID'])." , now(),'".$_SESSION['user']."')";
                        $stmt_InsertClosure = mysqli_query($conn,$sql_InsertClosure) or die(mysqli_error($conn));
                        /*End of Implement the uniquq closure*/
                                        
                    
                        $sql_upadte_dis = "INSERT INTO callcenterinquiry_creaditcard(helpid , call_answered , call_feedback , remark , enrtyby , callstatus ,callFeedback)
                                            VALUES (".trim($_POST['get_help_ID'])." , '".$selCallAnswered."' , '".$call_feedback."' , '".trim($_POST['txtarea_Solution'])."' , '".$_SESSION['user']."' , 1 , '".trim($_POST['selCallFeedbackNO'])."');";
                        $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                        
                        $DIS = "Call center  - File Reject. " .$StrCallAnswered." / ".$strCallFeedback ." - ".trim($_POST['txtarea_Solution']) ;
                                        
                        setNoteCreditCard($conn,trim($_POST['get_help_ID']),$DIS,$_SESSION['user']);
                        CreateNoteTable($conn ,trim($_POST['get_help_ID']),$DIS,$_SESSION['user'],'CREDITC');
                         $v_update_sql = "UPDATE `cdb_helpdesk` 
                                             SET `cmb_code`='5005', 
                                                 `caloser_by`= '".$_SESSION['user']."', 
                                                 `caloser_dateTime`= now(), 
                                                 `resulution`='".$StrCallAnswered."', 
                                                 `solution`='".$DIS."', 
                                                 `solved_by`= '".$_SESSION['user']."',
                                                 `solved_on`= now() 
                                           WHERE `helpid` = '".trim($_POST['get_help_ID'])."';";
                        $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(mysqli_error($conn));
                        
                        
                        $to = "";
                        $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC , c.issue
                                            FROM branch AS b , cdb_helpdesk c
                                            WHERE b.branchNumber = c.entry_branch
                                              and c.helpid = '".trim($_POST['get_help_ID'])."';";
                        $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
                        $to = "";
                        $to_cc = "";
                        
                        while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                            $subject = "Debit Card Alert - Call Center Inquiry !.";
                            $messageBodyIn = "
                                            <h4>Call Center Inquiry!</h4>
                                            <label>Ref :".trim($_POST['get_help_ID'])."</label><br /><br />
    								    	<label>Client Code :".$rec_getbranchdtl[2]."</label><br /><br />
                                            <label>Note : ".$StrCallAnswered."</label><br /><br />";
                            if($strCallFeedback != ""){
                                $messageBodyIn .= "<label>".$strCallFeedback."</label><br />";
                            }
                            $messageBodyIn .= "<label>Remark : ".trim($_POST['txtarea_Solution'])."</label><br />";
                                                        
                            $sender = $_SESSION['user'];
                           /* if($rec_getbranchdtl[0] != ""){
                                $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                            }*/
                                    
                            if($rec_getbranchdtl[1] != ""){
                                $to = getUserEmail($conn,$rec_getbranchdtl[1]);
                            }
                        }
                        //$to = "wimukthi.madushan@cdb.lk";
                        if($to != ""){
                            //$to = "wimukthi.madushan@cdb.lk";
                            mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                        }
                    mysqli_commit($conn); 
                    echo "<script> alert('Record Updated.');pageClose();</script>";      
                    //------------------------------------------------------------------------------------- 
         }else{
            echo "<script> alert('Some Values are missing.');</script>";  
         }
            
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}

if(isset($_POST['btn_Recomented']) && $_POST['btn_Recomented']=='Recommended'){
   // echo "<script> alert('A');</script>";
    mysqli_autocommit($conn,FALSE);
    try{
            // Validation rule engine
            //echo "<script> alert('B');</script>";
        if(trim($_POST['txt_helpdeskCredit']) != "" && trim($_POST['txtCommentCredit']) != ""){
           // echo "<script> alert('C');</script>";
                    //$getmail = 0;
            date_default_timezone_set('Asia/Colombo');
            $StrCallAnswered = "Customer Call Answered : YES ";
            $strCallFeedback = ""; // txt_qid
            $Q = "";
            if($_POST['text_moduleCode'] == 1){
                $Q = "Q1";
            }else if($_POST['text_moduleCode'] == 2){
                $Q = "Q2";
            }else{
                
            }
            for ($q = 1 ; $q < $_POST['text_X'] ; $q++){
                if(isset($_POST['chk_'.$q])){
                    $sql_Insert_DTL  = "INSERT INTO credit_card_call_dtl(helpid , q_module_id , q_id , q_answer , q_remark , entryby)
                                              VALUES ('".trim($_POST['txt_helpdeskCredit'])."' , ".$_POST['text_moduleCode']." , ".$_POST['txt_qid'.$q]." , 1 , '".trim($_POST['txtCommentCredit'])."' , '".$_SESSION['user']."');";
                    //echo $sql_Insert_DTL . "<BR/>";
                    mysqli_query($conn,$sql_Insert_DTL) or die(mysqli_error($conn));
                }else{
                    $sql_Insert_DTL  = "INSERT INTO credit_card_call_dtl(helpid , q_module_id , q_id , q_answer , q_remark , entryby)
                                              VALUES ('".trim($_POST['txt_helpdeskCredit'])."' , ".$_POST['text_moduleCode']." , ".$_POST['txt_qid'.$q]." , 0 , '' , '".$_SESSION['user']."');";
                    //echo $sql_Insert_DTL . "<BR/>";
                    mysqli_query($conn,$sql_Insert_DTL) or die(mysqli_error($conn));
                }
            }
             
            // ----------------------------------------------------------------------------------------------------------------------// 
           $sql_btn = "SELECT cq.q_module_id FROM credit_card_call_dtl AS cq WHERE cq.helpid = '".trim($_POST['txt_helpdeskCredit'])."' GROUP BY cq.q_module_id;";
           $query_btn = mysqli_query($conn,$sql_btn) or die(mysqli_error($conn));
           
           $rowcount = mysqli_num_rows($query_btn);
           
           /*while($resalt_btn = mysqli_fetch_array($query_btn)){
               
           }*/
           //if($rowcount == 3){
            if($rowcount == 2){
               //$sql_InsertClosure = "insert into callinqclosure_creaditcard VALUES (".trim($_POST['txt_helpdeskCredit'])." , now(),'".$_SESSION['user']."')";
               //echo $sql_InsertClosure . "<BR/>";
               //$stmt_InsertClosure = mysqli_query($conn,$sql_InsertClosure) or die(mysqli_error($conn));
                                            /*End of Implement the uniquq closure*/
               $sql_upadte_dis = "INSERT INTO callcenterinquiry_creaditcard(helpid , call_answered , call_feedback , remark , enrtyby , callstatus ,callFeedback)
                                                                    VALUES (".trim($_POST['txt_helpdeskCredit'])." , 'YES' , '1' , 'Call Center Approved' , '".$_SESSION['user']."' , 1 , '');";
               //echo $sql_upadte_dis . "<BR/>";
               $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
               $DIS = $StrCallAnswered." - ".$_POST['txtCommentCredit'] ;                            
               setNoteCreditCard($conn,trim($_POST['txt_helpdeskCredit']),$DIS,$_SESSION['user']);
                                            
                 $v_update_sql = "UPDATE `cdb_helpdesk` 
                                     SET `cmb_code`='5001' ,
                                         `ssb_type` = 'Call Center Approved'
                                   WHERE `helpid` = '".trim($_POST['txt_helpdeskCredit'])."';";
                
                //echo $v_update_sql. "<BR/>";
                $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(mysqli_error($conn));
           }
         
            $NOTE = $Q." Customer Call Answered". " - ". $_POST['txtCommentCredit'] ;
            $CreateNote = "Credit_Card_Call";
            CreateNoteTable($conn , trim($_POST['txt_helpdeskCredit']),$NOTE,$_SESSION['user'],$CreateNote);
             // ----------------------------------------------------------------------------------------------------------------------//              
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



function setNoteCreditCard($conn,$gethelpID,$note_dis,$user){
    
         
         $sql_note_update = "INSERT INTO `credit_card_note`(`helpid`, `note_dis`, `entry_by`) 
                                                    VALUES ('".$gethelpID."','".$note_dis."','".$user."');";
         //echo $sql_note_update;
         $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                   
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

function CreateNoteTable($ConnERP ,$HELP_ID,$NOTE,$USER,$CreateNote){
        date_default_timezone_set('Asia/Colombo');
        $SERIAL = 1;
        $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$HELP_ID."';";
        $query_select_note_count = mysqli_query($ConnERP , $sql_select_note_count) or die(mysqli_error($ConnERP));
        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
            $SERIAL = $rec_select_note_count[0] + 1;    
        }
        
        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES (".$HELP_ID.",'".$SERIAL."','".$NOTE."','".$USER."',now(),'".$CreateNote."');";
        $query_note_update = mysqli_query($ConnERP,$sql_note_update) or die(mysqli_error($ConnERP));
}

function getUserEmail($conn,$userID){
    $sql_get_email = "SELECT `email` FROM `user` WHERE `userName` = '".$userID."';";
    $query_get_email = mysqli_query($conn,$sql_get_email) or die(mysqli_error($conn));
    while($resat_get_email = mysqli_fetch_array($query_get_email)){
        return $resat_get_email[0];
    }
}

?>
</form>
</body>
</html>
