<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request List
Purpose			: To viwe Request list for Service
Author			: Madushan Wikramaarachchi
Date & Time		: 01.09 P.M 01/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/002";
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
    require('PHPMailer/class.phpmailer.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Courier Day Receive  Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/contextMenu.js-master/contextMenu.min.js"></script>

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

<script>
  
</script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}

    function clientValidate(title,cat_cod){
        var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
        var helpClose = document.getElementById('txt_helpdesk_close').value;
        var user = document.getElementById('txt_USERMY').value;
        if(cat_cod != '1014' ){
            var mydata;
            var getHI = document.getElementById(title).value;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;
                    $(function() {
                        $("#txt_tentativeon").datepicker({dateFormat:"yy-mm-dd"});
                      });           
                }
            }
            mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDreq="+getHI+"&gettxt_helpdesk_close="+helpClose,true);
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
            
            mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDreq1="+getHI+"&gettxt_helpdesk_close1="+helpClose,true);
            mydata.send();
        }
        
    }
    
    function getSolution(){
       // alert('a');
        var getsubHI = document.getElementById('txt_help_ID').value;
        //alert(getsubHI);
            mydata1= new XMLHttpRequest();
            mydata1.onreadystatechange=function(){
                if(mydata1.readyState==4){
                    //alert('IN');
                    document.getElementById('maneSpan').innerHTML=mydata1.responseText;           
                }
            }
            mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getsubHelpIDreq="+getsubHI,true);
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

function genPdfForUserLogin(){
   //alert("a");
    var prtContent = document.getElementById("content");
	var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
}
function getprintCopy(){
		var prtContent = document.getElementById("content");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
}

function isSubmitSolution(){
    var help_ID = document.getElementById('get_help_ID').value;
    var Resulution = document.getElementById('txtarea_Resulution').value;
    var Solution = document.getElementById('txtarea_Solution').value;
    var user = document.getElementById('txt_USERMY').value;
   // var help_ID = document.getElementById('get_help_ID').value;
     
    //var helpDesk = 123456;
   // alert(helpDesk);
   if(Resulution.length == 8){
        document.getElementById("btnReqtest").disabled = true;
        document.getElementById("btnReq").disabled = true;
        $.ajax({ 
    		type:'POST', 
    		data: {getHelp_ID : help_ID}, 
    		url: 'genSecPDF/examples/gen_PDF.php', 
    		success: function(val_retn) { 
    		    //alert(val_retn); 
                var myarr = val_retn.split("|");
                //alert(myarr[0]);
                //alert(myarr[1]);
                //alert(myarr[2]);
                
                
                $.ajax({ 
            		type:'POST', 
            		data: {getval_retnHelp_ID : myarr[0] , getResulution : Resulution , getSolution : Solution , getuser : user , fileName : myarr[1] , pathDir : myarr[2]}, 
            		url: 'functionUserManagenetCreationHelpDeskLIst.php', 
            		success: function(isretnval) { 
            		  //document.getElementById('maneSpan').innerHTML = isretnval;
          		      alert(isretnval); 
                      pageClose()
                        
            		}
            	});
                
    		}
	   });
   }else{
        alert("Please type ERP User login for Caused By.");
   }
    
}

function getCourierSend(){
    //alert('OK');
    if(document.getElementById("chk_Courier").checked == true){
        document.getElementById("courierSpan").style.display = "inline";
        document.getElementById("selBranchNumber").value = document.getElementById("get_entryBranch").value;
        document.getElementById("selDepartmentNumber").value = document.getElementById("get_EntentryDepartment").value; 
    }else{
        document.getElementById("courierSpan").style.display = "none";
        document.getElementById("selBranchNumber").value = document.getElementById("get_entryBranch").value;
        document.getElementById("selDepartmentNumber").value = document.getElementById("get_EntentryDepartment").value; 
    }
}


function department(){
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('diva').innerHTML=mydata.responseText;
			}
		}
		var no=document.getElementById('selBranchNumber').value;
		mydata.open("GET","ajaxdemartmentselect.php"+"?txt1="+no,true);
		mydata.send();
	}
</script>
<script>
var metaChar = false;
var tagRow = 0;
var tagCol = 0;
function keyEvent(event) {
  var key = event.keyCode || event.which;
    //alert(key);
    if(key == 120){
        //alert("F9");
        //("Key pressed " + key);
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		mydataNew.open('GET','ajaxEntryNewGrid.php'+'?n_userID='+userID+'&n_userg='+userg,true);
		mydataNew.send();
    }
    if(key == 121){
        // alert("F10");
        //("Key pressed " + key);
        //if (tagCoum == 1) 
        //if (window.getSelection().substr(0, 2) != '01') 
        
        if(tagCol != 2) return;
        //alert('A');
        var userDepartment = document.getElementById('userDepartment').value;
        if(userDepartment != '9507') return; 
        // alert('B');
        // alert(window.getSelection().toString().length);
        // alert('-'+window.getSelection().toString()+'-');
        if (window.getSelection().toString().trim().length != 8) return;
         //alert('C');
         //alert(window.getSelection().toString().trim().substr(0, 2));
        if (window.getSelection().toString().trim().substr(0, 2) != '01') return;
        // alert('OK');
         //alert('D');
        var userID = document.getElementById('txt_USERMY').value;
        var helpID = document.getElementById('txta'+tagRow).value ; 
        var RaisedUserID = document.getElementById('txtx'+tagRow).value ; 
        if(window.getSelection) {  // all browsers, except IE before version 9
                var range = window.getSelection();                                        
                alert(range.toString ());
                if(range.toString() == ""){
                    alert('Missing Selected text.');
                }else if(userID == ""){
                    alert('Undefind User.');
                }else{
                    
                    $.ajax({ 
          		        type:'POST', 
                  		data: {select_userID : userID , select_text : range.toString () , select_helpID : helpID , selsetRaisedUserID : RaisedUserID}, 
                  		url: 'ajaxServiceRequestListSelectTextFunction.php', 
                  		success: function(val_retn) { 
                    	        alert(val_retn);
                                pageClose();
                  		}
                    });
                }
                
        } 
    }
    if(key == 113){
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		var SelectedValue = window.getSelection().toString().trim();
		//alert(SelectedValue);
		mydataNew.open('GET','ajaxEntryNewGrid_11.php'+'?n_userID='+userID+'&n_userg='+userg+'&n_SelectedValue='+SelectedValue,true);
		mydataNew.send();
		
	}
    if(key == 119){
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
        var userID = document.getElementById('txt_USERMY').value;
        var userg = document.getElementById('txt_USERgROUP').value;
		var SelectedValue = window.getSelection().toString().trim();
		//alert(SelectedValue);
		mydataNew.open('GET','ajaxEntryNewGrid_12.php'+'?n_userID='+userID+'&n_userg='+userg+'&n_SelectedValue='+SelectedValue,true);
		mydataNew.send();
		
	}
}

function myFunction(x) {
    tagRow = x.rowIndex;
}
function columFunction(x) {
    tagCol = x.cellIndex;
}
function tentativeonAgree(title){
    //alert(title);
    var getTDate = document.getElementById('txt_tentativeon').value;
    var userID = document.getElementById('txt_USERMY').value;
    if(getTDate != "" && getTDate != "0000-00-00"){
         $.ajax({ 
    		type:'POST', 
    		data: {gettentHelpID : title, getentativeon : getTDate, getTUser : userID}, 
    		url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
    		success: function(isretnval) { 
    		  //document.getElementById('maneSpan').innerHTML = isretnval;
    	      alert("Agreed to proceed"); 
              pageClose()
                
    		}
	   });
    }else{
        alert("Tentative day is Missing.");
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
    $tbl = ",cdb_help_user_oth";
    $where_1 = "`cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND ";
    $where_2 = "`cdb_helpdesk`.`cat_code` not in ('1014' , '1024' , '1032' , '1028' , '1029' , '1038') AND `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."' AND `cdb_helpdesk`.`scat_code_1` NOT IN ('2021','100517') AND";
    $where_3 = "`cdb_helpdesk`.`cat_code` in (";
    $sql_sp = "SELECT u.cat_code FROM cdb_help_user_oth_user_sp AS u WHERE u.user_id = '". $_SESSION['user']."' AND u.cat_code not in ('1014' , '1024' , '1032' , '1028' , '1029' , '1038');";
    $query_sp = mysqli_query($conn,$sql_sp) or die(mysqli_error($conn)); 
    $count_sp = mysqli_num_rows($query_sp);
    $q = 1;
    while($rec_sp = mysqli_fetch_array($query_sp)){
        if($q == $count_sp){
            $where_3 .=  $rec_sp[0];
        }else{
            $where_3 .=  $rec_sp[0].",";
        }
        $q++;  
       // echo $where_3;
    }
    
    if($count_sp != 0){
        $tbl = "";
        $where_1 = "";
       // $where_2 = "";
       $where_3 .= ",";
        $sql_sp1 = "SELECT u.cat_code FROM cdb_help_user_oth AS u WHERE u.user_group = '".$_SESSION['usergroupNumber']."' AND u.`cat_code` not in ('1014' , '1024' , '1032' , '1028' , '1029' , '1038');";
        $query_sp1 = mysqli_query($conn,$sql_sp1) or die(mysqli_error($conn));
        $count_sp1 = mysqli_num_rows($query_sp1);
        $q1 = 1;
        while($rec_sp1 = mysqli_fetch_array($query_sp1)){
            if($q1 == $count_sp1){
                $where_3 .=  $rec_sp1[0];
            }else{
                $where_3 .=  $rec_sp1[0].",";
            }
            $q++;  
            
        }
        $where_3 =  substr_replace($where_3 ,"",-1);;
        $where_3 .= ") AND";
        //echo $where_3;
        $where_2 = $where_3;
    }
    
    if($_SESSION['usergroupNumber'] == 'ITADM' || $_SESSION['usergroupNumber'] == 'ug00001'){
        
    }else{
        $where_2 .= "`cdb_helpdesk`.`scat_code_1` not in ('2005') AND ";
    }

    $v_sql_det_detelsCNT = "SELECT COUNT(1) 
    FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`scat_01`,`cat_states` ".$tbl." 
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cat_code` = `cat_states`.`cat_code` AND
       `scat_01`.`cat_code` = `cdb_helpdesk`.`cat_code` AND
       `scat_01`.`scat_code_1` = `cdb_helpdesk`.`scat_code_1` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       ".$where_1."
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       ".$where_2."
       `scat_01`.`scat_discr_1` like  IF(`cat_states`.`isBrachRelated` = 1 , '".$_SESSION['USERBRANCHNAME']."' , '%')
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
       //echo $v_sql_det_detelsCNT;
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">Issue</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Sub Category 2</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Department</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <!--<td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td> -->
            <!--<td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td> -->
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Sub Category 3</span></td>
            <td style="width:50px;"></td>
        </tr>
<?php

    //echo "-".$tbl."-";
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
                                `cdb_helpdesk`.scat_code_2 , 
                                `cdb_helpdesk`.Linked_helpid ,
                                `cdb_helpdesk`.scat_code_1 ,
                                `scat_02`.rowCol ,
                                 (SELECT s.scat_discr_3 FROM scat_03 AS s WHERE s.scat_code_3 = `cdb_helpdesk`.scat_code_3 ) AS Scat3
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`scat_01`,`cat_states` ".$tbl."  
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cat_code` = `cat_states`.`cat_code` AND
       `scat_01`.`cat_code` = `cdb_helpdesk`.`cat_code` AND
       `scat_01`.`scat_code_1` = `cdb_helpdesk`.`scat_code_1` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       ".$where_1."
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       ".$where_2."
       `scat_01`.`scat_discr_1` like  IF(`cat_states`.`isBrachRelated` = 1 , '".$_SESSION['USERBRANCHNAME']."' , '%')
       ORDER BY `cdb_helpdesk`.`enterDateTime`;";
    //echo $v_sql_det_detels;
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
       $sql_count_note = "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$rec_det_detels[0]."';";
          $v_que_count_note = mysqli_query($conn,$sql_count_note);
          while($rec_count_note =  mysqli_fetch_array($v_que_count_note)){
                $f_Col = "#000000";
                if($rec_count_note[0] != 0){
                    $f_Col = "#01DF3A";
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
        $MyRow = "background-color:".$rec_det_detels[14].";";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        if ($rec_det_detels[13] == 2005){
           $MyRow = "background-color:#b3ffb3;";
        }
        
        if($rec_det_detels[14] != "#FFFFFF"){
             $MyRow = "background-color:".$rec_det_detels[14].";";
        }
        
         if ($rec_det_detels[13] == 103101 && $rec_det_detels[9] == $_SESSION['user']){
           $MyRow = "background-color:#ff8080;";
         }
        //------------------------------ 2017-01-26 - Madushan - color for the time pass issuer-------------------------------------------------------------------------------
        $sql_timePass = "SELECT s1.SLA_TYPE , s1.SAL FROM scat_02 AS s1  WHERE s1.scat_code_2 = '".$rec_det_detels[11]."';";
        $query_timePass = mysqli_query($conn,$sql_timePass) or die(mysqli_error($conn));
        while($resalt_timePass = mysqli_fetch_array($query_timePass)){
            if($resalt_timePass[0] == "DAY"){
               $datetime1 = date_create(date("Y-m-d",strtotime($rec_det_detels[1])));
               $datetime2 = date_create(date("Y-m-d"));
               $interval = date_diff($datetime1, $datetime2);
               $diferantDate = $interval->format('%a days');
               
               if($resalt_timePass[1] != 0 && $diferantDate >= $resalt_timePass[1]){
                   $bgcol = "background-color:#FDBDCF";
                   //$numberDiff = $resalt_timePass[1];
               }else{
                    $bgcol = "";
                    //$numberDiff = $resalt_timePass[1];
               }
                
                
            }else if($resalt_timePass[0] == "HOURS"){
                //$col = '#C70039';
            }else if($resalt_timePass[0] == "MINUTES"){
                //$col = '#C70039';
            }else{
                $bgcol = "";
            }
        }
        
        if($rec_det_detels[11] == 10280119 || $rec_det_detels[11] == 10280120 || $rec_det_detels[11] == 10290128  || $rec_det_detels[11] == 10290129){
            $bglink = "background-color:#bf80ff";
        }else{
            $bglink = "";
        }
        
        
        
        //---------------------------------------------------------------------------------------------------------------------------------------------
        echo "<tr style='color: ".$col.";' onclick='myFunction(this)'>";
        echo "<td style='width:60px;text-align: right;".$MyRow .";color: ".$f_Col.";".$bgcol.";' onclick='columFunction(this)'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow .";".$bglink.";' onclick='columFunction(this)'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:300px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."' onclick='columFunction(this)'><span style='margin-left: 2px;'>".$rec_det_detels[5]."</span></td>";
        echo "<td style='width:100px;text-align: right;".$MyRow ."' title = '".$entryBy."' onclick='columFunction(this)'><div style='display: none;'><input type='text' name='txtx".$index."' id='txtx".$index."' value='".$rec_det_detels[6]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 2px;'>".$rec_det_detels[6]."</span></td>";
        //echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;' onclick='columFunction(this)'>".$rec_det_detels[7]."</span></td>";
        //echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;' onclick='columFunction(this)'>".$rec_det_detels[8]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."' title = '".$asingBy."' onclick='columFunction(this)'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."' onclick='columFunction(this)'><span style='margin-right: 2px;' >".$rec_det_detels[15]."</span></td>";
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
    <input type="text" name="userBranch" id="userBranch" value="<?php echo  $_SESSION['userBranch']; ?>" />
    <input type="text" name="userDepartment" id="userDepartment" value="<?php echo  $_SESSION['userDepartment']; ?>" />
    
</div>


<?php
    if(isset($_POST['btnReq']) && $_POST['btnReq']=='Submit'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            if(trim($_POST['get_help_ID']) != "" && trim($_POST['txtarea_Resulution']) != "" && trim($_POST['txtarea_Solution']) != ""){
                //$getmail = 0;
                echo "<script> document.getElementById('btnReq').disabled = true;</script>"; 
                $getStateList = isServiceRequsetListInsert(trim($_POST['get_help_ID']),trim($_POST['txtarea_Resulution']),trim($_POST['txtarea_Solution']),trim($_POST['txt_USERMY']));	
                date_default_timezone_set('Asia/Colombo');
                $sql_upadte_dis = "UPDATE `cdb_helpdesk` 
                                    SET `decision_discription`= '".mysqli_real_escape_string($conn,trim($_POST['selDesision']))."' 
                                    WHERE `helpid` = '".trim($_POST['get_help_ID'])."';";
                $que_update_dis = mysqli_query($conn,$sql_upadte_dis) or die(mysqli_error($conn));
                
                $sql_email = "SELECT `email`,`userID` FROM `user` WHERE `userName` = '".trim($_POST['get_help_Ent'])."';";
                $que_email = mysqli_query($conn,$sql_email);
                	while($RES_email = mysqli_fetch_assoc($que_email)){
                    	$getmail = $RES_email['email'];
                        //$getUser = $RES_email['userID'];
                        $get_ResiveOfficer = $RES_email['userID'];
                	}
                 $getUser = $_SESSION['user'];
                 
                 $sql_helpDeskDis = "SELECT chk.entry_branch , chk.entry_department , chk.scat_code_2 
                                     FROM cdb_helpdesk AS chk WHERE chk.helpid = '".trim($_POST['get_help_ID'])."';";
                 $query_helpDeskDis = mysqli_query($conn,$sql_helpDeskDis) or die(mysqli_error($conn));
                 while($rec_helpDeskDis = mysqli_fetch_array($query_helpDeskDis)){
                    $receiveBranchNumber = $rec_helpDeskDis[0];
                    $receiveDepartmentNumber = $rec_helpDeskDis[1];
                    $scat_code_2 = $rec_helpDeskDis[2];
                 }
                 
                 
                 if(isset($_POST['chk_Courier'])){
                    //echo "<script> alert('C - OK.');</script>";  
                            if($_POST['selBranchNumber'] != "" && $_POST['selDepartmentNumber'] != ""){
                                $sendBranch = $_POST['selBranchNumber'];
                                $sendDepartment = $_POST['selDepartmentNumber'];
                            }else{
                                $sendBranch = $receiveBranchNumber;
                                $sendDepartment = $receiveDepartmentNumber;
                            }
                            
                            $sql_cou_status = "SELECT sc2.IsCourierStatus , sc2.docList , sc2.couriertype 
                                                 FROM scat_02 AS sc2 
                                                 WHERE sc2.scat_code_2 = '".$scat_code_2."' 
                                                   AND sc2.IsCourierStatus = 1;";
                            $quer_cou_status = mysqli_query($conn,$sql_cou_status) or die(mysqli_error($conn));
                            while($rec_cou_status = mysqli_fetch_array($quer_cou_status)){
                                if($rec_cou_status[0] == 1){
                                        $array_document = explode("|",$rec_cou_status[1]);
                                        $numOfDoc = sizeof($array_document);
                                        $statCount1 ="SELECT `count` ,`year` 
                                                        FROM `filesnumbergenaret` 
                                                       where `branch`='".$_POST['userBranch']."' 
                                                         AND `serial`='file' 
                                                         AND`department`='".$_POST['userDepartment']."' 
                                                         AND `year` = year(now())";
                    					$sql_statCount1=mysqli_query($conn,$statCount1);
                    					while($add_statCount1=mysqli_fetch_array($sql_statCount1)){
                    						if($add_statCount1[0]==0){
                    						 	$fileNumber = $_POST['userBranch'].$_POST['userDepartment'].$add_statCount1[1]."000001";
                    							$cou = $add_statCount1[0] + 1;
                    						}else{
                    						 	$fileNumber = $_POST['userBranch'].$_POST['userDepartment'].$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT);
                    							$cou = $add_statCount1[0] + 1;
                    						}
                    					}
                                        $file_name = $sendBranch." ".$sendDepartment." ".mysqli_real_escape_string($conn,trim($_POST['txtarea_Resulution']));
                                        $currentowner = trim($_POST['txt_USERMY']);
                                         
                                        $statUpdate ="SELECT `serial` 
                                                        FROM filesNumberGenaret  
                                                       where `branch`='".$_POST['userBranch']."' AND `department`='".$_POST['userDepartment']."' AND `year` = year(now())";
                    					$sql_statUpdate=mysqli_query($conn,$statUpdate);
                                        
                    					while($add_statUpdate=mysqli_fetch_array($sql_statUpdate)){
                    						$fileCount ="UPDATE `filesnumbergenaret`  
                                                            SET `count`= '".$cou."'  
                                                          WHERE `branch`= '".$_POST['userBranch']."' 
                                                            AND `department`='".$_POST['userDepartment']."' 
                                                            AND `year` = year(now()) 
                                                            AND `serial`='".$add_statUpdate[0]."'";
                    						$updateFileCount = mysqli_query($conn,$fileCount) or die(mysqli_error($conn));
                    					}
                                        
                                        if($fileNumber != ""){
                                            $addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) 
                                                                        VALUES('".$fileNumber."','".$file_name."','".$currentowner."' ,'".$get_ResiveOfficer."','".$sendDepartment."',  '".$sendBranch."' ,'JC','".$numOfDoc."','".$rec_cou_status[2]."','".$_POST['userBranch']."','".$_POST['userDepartment']."','".$file_name."','".$currentowner."',now(),'','NO')";
                                            $query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
                                            
                                           	
                    	                    $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) 
                                                                            VALUES ('".$fileNumber."',now(),'File Created','".$currentowner."')";
                                            $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
                                            //echo $fileNumber;
                                            for($r = 0 ; $r<$numOfDoc; $r++){
                                                //echo "<script> alert('".$r."');</script>";  
                                                //echo "<script> alert('".$array_document[$r]."');</script>";
                                                $DocName = "SELECT `documentName` FROM `courier_masters_document` 
                                                             WHERE `documentNumber` = '".$array_document[$r]."';";
                                                $sql_DocName= mysqli_query($conn,$DocName) or die(mysqli_error($conn));
                                                while($rec_DocName = mysqli_fetch_array($sql_DocName)){
                                                      
                                                      $addsq2= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
                                                             VALUES('".$array_document[$r]."','".$rec_DocName[0]."','".$fileNumber."',now(),'YES','YES')";
                                                      $result2= mysqli_query($conn,$addsq2)  or die(mysqli_error($conn));
                                                }
                                              	
                                            }
                                            
                                       }else{
                                            echo "Error in file number generation. ERP-ERROR";
                                       }		
                                }
                                        
                            }
                            
                                        
                    
                 }else{
                    //echo "<script> alert('C - NOT.');</script>";  
                 }
                 
                 
                 $sql_bandD = "SELECT `branch`.`branchName`,
                                     `deparment`.`deparmentName`,
                                     `cdb_helpdesk`.`issue`,
                                     `cdb_helpdesk`.`help_discr` , 
                                     `cat_states`.`cat_discr`,
                                     `scat_01`.`scat_discr_1` ,
                                     `scat_02`.scat_discr_2 ,
                                     `cdb_helpdesk`.scat_code_2
                                   FROM `cdb_helpdesk`,`branch`,`deparment` , `cat_states` , `scat_01` , `scat_02`
                                   WHERE `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                   AND `cdb_helpdesk`.`cat_code` = `cat_states`.cat_code
                                   AND `cdb_helpdesk`.`scat_code_1` = `scat_01`.scat_code_1 
                                   AND `cdb_helpdesk`.`scat_code_2` =  `scat_02`.scat_code_2
                                   AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                AND `cdb_helpdesk`.`helpid` = '".trim($_POST['get_help_ID'])."';";
                $que_bandD = mysqli_query($conn,$sql_bandD);
                while($RES_bandD = mysqli_fetch_array($que_bandD)){
   	                $ebranchName 	      = $RES_bandD[0];
                    $eDepartmnet 		  = $RES_bandD[1];
					$Var_Issue_ShortDescr = mysqli_real_escape_string($conn,$RES_bandD[2]); // Newly added by Rizvi on 1:03 PM 25/10/2016
					$Var_Issue_LongDescr  = mysqli_real_escape_string($conn,$RES_bandD[3]); // Newly added by Rizvi on 1:03 PM 25/10/2016
                    $cat = $RES_bandD[4];
                    $scat_01 = $RES_bandD[5];
                    $scat_02 = $RES_bandD[6];
                    $scat_code_2_number = $RES_bandD[7];
                }
                if(mysqli_num_rows($que_email) > 0){
				
                       	            
                    $title = "CDB Help Desk : Solved Issue";
                    //$mail = "Your service request << ".trim($_POST['get_help_ID'])." >> - <<".trim($_POST['get_help_Iss']).">> States changed to solved. Please check and confirm to close the job. \nCDB SmartOps --> Help Desk -- >Service Request Acknowledge";
                    //sendMail($getmail,$title,$mail);
                    $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['get_help_ID'])."</td>
    </tr>
    <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>From Branch </td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$ebranchName."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>From Department</td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$eDepartmnet."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>Main Category </td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$cat."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 1</td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_01."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 2</td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_02."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_ShortDescr."</td>
        </tr>
        <tr>
            <td style='width:200px; text-align:left; padding-left:5px'>Issue Description</td>
            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_LongDescr."</td>
        </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Caused by</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".mysqli_real_escape_string($conn,trim($_POST['txtarea_Resulution']))."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Solution</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".mysqli_real_escape_string($conn,trim($_POST['txtarea_Solution']))."</td>
    </tr>";
    if(trim($_POST['selDesision']) != ""){
         $mail .= "<tr>
                        <td style='width:200px; text-align:left; padding-left:5px'>Decision</td>
                        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['selDesision'])."</td>
                    </tr>";
    }
    $mail .= "<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Solve by</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUser."--".date('Y-m-d h:i:s')."</td>
    </tr>
 </table><br/>
 States changed to solved. Please check and confirm to close the job.<br/>
 CDB SmartOps --> Help Desk -- >Service Request Acknowledge
 
</body>
</html>";

if($_FILES['file']['tmp_name'] == ""){
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
	// More headers
    $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
    //sendMail($getmail,$title,$mail,$headers);    
    sendMailNuw($getmail,$title,$mail,$headers); 
      //echo "<script> alert('no ATTACHMENT.');</script>";	           
                
}else{
      //echo "<script> alert('Have ATTACHMENT.');</script>";    
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     $sql_upadte_att = "UPDATE `cdb_helpdesk` 
                                    SET `attachmentlbl` = '".$_FILES["file"]["name"]."' 
                                    WHERE `helpid` = '".trim($_POST['get_help_ID'])."';";
     $que_update_att = mysqli_query($conn,$sql_upadte_att) or die(mysqli_error($conn));
                
     
    $email_from = 'cdberp@cdbnet.lk'; // required
    $email_to = $getmail; // required
    //$addr = explode(';',$email_to);
    //$telephone = $_POST['telephone']; // not required
    $comments = ''; // required
    $mailTitle= $title;
 // if(($selected_key==0))
   // echo "<script> alert('Please enter your title')</script>";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     $email_message = "";
    /*$email_message .="Title: ".$selected_val."\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";*/
    $email_message .= $mail;

    $allowedExts = array("doc", "docx", "xls", "xlsx", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if($_FILES["file"]["type"] != ""){
    if ((($_FILES["file"]["type"] == "application/pdf")
    || ($_FILES["file"]["type"] == "application/msword")
    || ($_FILES["file"]["type"] == "application/excel")
    || ($_FILES["file"]["type"] == "application/vnd.ms-excel")
    || ($_FILES["file"]["type"] == "application/x-excel")
    || ($_FILES["file"]["type"] == "application/x-msexcel")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
    
    ) //&& in_array($extension, $allowedExts)
      {
      if ($_FILES["file"]["error"] > 0){
        echo "<script>alert('Error: " . $_FILES["file"]["error"] ."')</script>";
      }else{
            //$d='upload/';
            //$de=$d . basename($_FILES['file']['name']);
        //move_uploaded_file($_FILES["file"]["tmp_name"], $de);
        $fileName = $_FILES['file']['name'];
        $filePath = $_FILES['file']['tmp_name'];
         //add only if the file is an upload
         }
      }
    else
      {
        //echo "<script>alert('Invalid file')</script>";
      }
}


// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
//$mail->IsSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 1;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host       = 'mail.cdbnet.lk';//"hidden";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port       = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth   = false;
//Username to use for SMTP authentication
$mail->Username   = 'cdberp@cdbnet.lk';//"hidden";
//Password to use for SMTP authentication
$mail->Password   = 'CDB@erp1234';//"hidden";
//Set who the message is to be sent from
$mail->SetFrom($email_from, 'CDB SmartOps');
//Set an alternative reply-to address
//$mail->AddReplyTo('replyto@example.com','First Last');
//Set who the message is to be sent to
//foreach ($addr as $ad) {
  //  if($ad != ""){
         $mail->AddAddress($email_to,$email_to); 
              
         $sql_email_CC = "SELECT `email`,`userID` FROM `user` WHERE `userName` = '".trim($_POST['txt_USERMY'])."';";
         $que_email_CC = mysqli_query($conn,$sql_email_CC);
         while($RES_email_CC = mysqli_fetch_assoc($que_email_CC)){
              //$getmail = $RES_email['email'];
              if($RES_email_CC['email'] != "" ){
                  $mail->addCC($RES_email_CC['email'],$RES_email_CC['email']);
              }else{
                 $mail->addCC($email_to,$email_to);
              }
                        //$getUser = $RES_email['userID'];
 	     } 
        
    //}
   
//}
//Set the subject line
$mail->Subject =  $mailTitle; //'Request for Profile Check up';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML($email_message);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->AddAttachment($file);
if($_FILES['file']['tmp_name'] != ""){
    $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
}

//Send the message, check for errors
if(!$mail->Send()) {
  echo "<script>alert('Mailer Error: " . $mail->ErrorInfo."')</script>";
} else {
  echo "<script>alert('Your request has been submitted. We will contact you soon.')</script>";
  //Header('Location: test1.php');
}     
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////     
}


                }
                
              if($getStateList == 1){
                    $disMkr = "";
                    $sql_issue_disMkr = "select ig.isDisMkr from cdb_cat_issue_gen AS ig WHERE ig.c_scat_code_2 = '".$scat_code_2_number."' AND ig.run_statas = 1  AND  ig.isEntryUser = 0;";
                    $query_issue_disMkr = mysqli_query($conn,$sql_issue_disMkr) or die(mysqli_error($conn));
                    while($resalt_issue_disMkr = mysqli_fetch_array($query_issue_disMkr)){
                        $disMkr = $resalt_issue_disMkr[0];
                     }
                     
                 if($disMkr == trim($_POST['selDesision'])){ 
                    $sql_issue_cat = "select COUNT(*) from cdb_cat_issue_gen AS ci WHERE ci.c_scat_code_2 = '".$scat_code_2_number."' AND ci.run_statas = 1 AND  ci.isEntryUser = 0;";
                    $query_issue_cat = mysqli_query($conn,$sql_issue_cat) or die(mysqli_error($conn));
                   // echo "<script> alert('".$disMkr."');</script>";	
                    while($resalt_issue_cat = mysqli_fetch_array($query_issue_cat)){
                        	
                          //echo "<script> alert('".$scat_code_2_number."');</script>";	
                          if($disMkr == trim($_POST['selDesision'])){
                            //echo "<script> alert('".$resalt_issue_cat[0]."');</script>";
                            if($resalt_issue_cat[0] > 0){
                                //echo "<script> alert('A');</script>";
                                genHelpdeskIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number);
                            }
                          }else if($disMkr == ""){
                            if($resalt_issue_cat[0] > 0){
                                //echo "<script> alert('B');</script>";
                                genHelpdeskIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number);
                            }
                          }else{
                            
                          }
                        
                         
                    }
                 }else{
                    //echo "<script> alert('1Else');</script>";
                 }
                    
                    $disMkr1 = "";
                    $sql_issue_disMkr = "select ig.isDisMkr from cdb_cat_issue_gen AS ig WHERE ig.c_scat_code_2 = '".$scat_code_2_number."' AND ig.run_statas = 1  AND  ig.isEntryUser = 1;";
                    $query_issue_disMkr = mysqli_query($conn,$sql_issue_disMkr) or die(mysqli_error($conn));
                    while($resalt_issue_disMkr = mysqli_fetch_array($query_issue_disMkr)){
                        $disMkr1 = $resalt_issue_disMkr[0];
                     }
                 
                if($disMkr1 == trim($_POST['selDesision'])){   
                    $sql_issue_catnew = "select COUNT(*) from cdb_cat_issue_gen AS ci WHERE ci.c_scat_code_2 = '".$scat_code_2_number."' AND ci.run_statas = 1  AND  ci.isEntryUser = 1;";
                    //echo "<script> alert('W ".$sql_issue_catnew."');</script>";
                    $query_issue_catnew = mysqli_query($conn,$sql_issue_catnew) or die(mysqli_error($conn));
                    while($resalt_issue_catnew = mysqli_fetch_array($query_issue_catnew)){
                       // echo "<script> alert('Q ".$resalt_issue_catnew[0]."');</script>";	
                          //echo "<script> alert('".$scat_code_2_number."');</script>";	
                          if($disMkr1 == trim($_POST['selDesision'])){
                           //  echo "<script> alert('A');</script>";
                              //echo "<script> alert('".$resalt_issue_catnew[0]."');</script>";	
                             if($resalt_issue_catnew[0] > 0){
                                //genHelpdeskIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number);
                                //echo "<script> alert('C');</script>";
                                genHelpdeskNewIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number,$_SESSION['user'],$_SESSION['userBranch'],$_SESSION['userDepartment']);
                             }
                          }else if($disMkr1 == ""){
                            // echo "<script> alert('C');</script>";
                            if($resalt_issue_catnew[0] > 0){
                               //echo "<script> alert('D');</script>";
                                //genHelpdeskIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number);
                                genHelpdeskNewIssue($conn,trim($_POST['get_help_ID']),$scat_code_2_number,$_SESSION['user'],$_SESSION['userBranch'],$_SESSION['userDepartment']);
                             }
                          }else{
                            
                          }
                        
                    }
                }else{
                    //echo "<script> alert('2Else');</script>";
                }
                     mysqli_commit($conn);
                    echo "<script> alert('Issue  solved.');
                              pageClose();
        			     </script>";	
                   
                }else{
                    echo "<script> alert('Some Values Not Update.');</script>";  
                }
            }else{
                echo "<script> alert('Some Values are missing.');</script>";  
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    
    
//-----------------------------------------------------------------------------------------------------------------------------------------------------------
/*if(isset($_POST['btnReqtest']) && $_POST['btnReqtest']=='Submit'){
   
}*/
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    if(isset($_POST['btnUpdate']) && $_POST['btnUpdate']=='Update'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            echo "<script> document.getElementById('btnUpdate').disabled = true;</script>"; 
            $sql_update_asing = "UPDATE `cdb_helpdesk` SET `asing_by`= '".trim($_POST['txt_inner_User1'])."' WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(mysqli_error($conn));
            isHelpDeskHistory(trim($_POST['txt_help_ID'])); // Helpdesk History
            //$v_delete_note = "DELETE FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
            //$que_delete_note = mysqli_query($conn,$v_delete_note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            
            for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
                if(trim($_POST['txtb'.$y])!= ""){
                    if(trim($_POST['txt_c_n'.$y] == 1)){
                        $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now(),'ServiceRequestList.php');";
                        $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
                    }                 
                 }
            }
                if(time($_POST['txt_UserGetMail']) != ""){
                    $sql_emailEnter = "SELECT `email` FROM `user` WHERE `userName` = '".trim($_POST['txt_UserGetMail'])."';";
                    $que_emailEnter = mysqli_query($conn,$sql_emailEnter);
                    if(mysqli_num_rows($que_emailEnter) > 0){
        			    while($RES_emailEnter = mysqli_fetch_assoc($que_emailEnter)){
           	                $getmailEnter = $RES_emailEnter['email'];
           	            }
                                    $Var_Issue_ShortDescr = "";
								     $Var_Issue_LongDescr  = "";
                                    $sql_bandD = "SELECT `branch`.`branchName`,
                                                         `deparment`.`deparmentName`,
                                                         `cdb_helpdesk`.`issue`,
                                                         `cdb_helpdesk`.`help_discr` , 
                                                         `cat_states`.`cat_discr`,
                                                         `scat_01`.`scat_discr_1` ,
                                                         `scat_02`.scat_discr_2
                                                       FROM `cdb_helpdesk`,`branch`,`deparment` , `cat_states` , `scat_01` , `scat_02`
                                                       WHERE `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                                       AND `cdb_helpdesk`.`cat_code` = `cat_states`.cat_code
                                                       AND `cdb_helpdesk`.`scat_code_1` = `scat_01`.scat_code_1 
                                                       AND `cdb_helpdesk`.`scat_code_2` =  `scat_02`.scat_code_2
                                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                                    AND `cdb_helpdesk`.`helpid` = '".trim($_POST['txt_help_ID'])."';";
                                    $que_bandD = mysqli_query($conn,$sql_bandD);
                                    while($RES_bandD = mysqli_fetch_array($que_bandD)){
                       	                $ebranchName 	      = $RES_bandD[0];
                                        $eDepartmnet 		  = $RES_bandD[1];
										$Var_Issue_ShortDescr = $RES_bandD[2]; // Newly added by Rizvi on 1:03 PM 25/10/2016
										$Var_Issue_LongDescr  = $RES_bandD[3]; // Newly added by Rizvi on 1:03 PM 25/10/2016
                                        $cat = $RES_bandD[4];
                                        $scat_01 = $RES_bandD[5];
                                        $scat_02 = $RES_bandD[6];
                                    }
                       	            
                        $title1 = "CDB Help Desk : Service Request - Notes";
                        date_default_timezone_set('Asia/Colombo');
                        $mail1 = "<html>
                                    <head>
                                    <title>HTML email</title>
                                    </head>
                                    <body>
                                    <h3>CDB Help Desk : Service Request - Notes</h3>
                                    <table border='1'>
                                    	<tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Service Request - Add Note</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_help_ID'])."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>From Branch </td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$ebranchName."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>From Department</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$eDepartmnet."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Main Category </td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$cat."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 1</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_01."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 2</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_02."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_ShortDescr."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Issue Description</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_LongDescr."</td>
                                        </tr>
                                          <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Assign User :</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_inner_User1'])." - ".getUserName($conn,trim($_POST['txt_inner_User1']))."</td>
                                        </tr>
                                     </table>
                                     </hr>
                                     <br/>
                                     Date : ".date('Y-m-d h:i:s')."
                                     <br/>
                                     <table border='1'>
                                     <tr>
                                        <td style='width:50px; text-align:right; padding-right:5px'>#</td>
                                        <td style='width:400px; text-align:left; padding-left:5px'>Notes</td>
                                        <td style='width:100px; text-align:left; padding-left:5px'>Enterd User</td>
                                        <td style='width:150px; text-align:left; padding-left:5px'>Enterd On</td>
                                     </tr>
                                     ";
                                     
                                     
                                     $sql_noteget = "SELECT n.note_code , n.note_discr , n.enterBy , n.enterDateTime FROM cdb_help_note AS n WHERE n.helpid = '".trim($_POST['txt_help_ID'])."';";
                                     //echo "<script> alert('".$sql_noteget."');</script>";
                                     $squery_noteget = mysqli_query($conn , $sql_noteget) or die(mysqli_error($conn));
                                     while($rec_noteget = mysqli_fetch_assoc($squery_noteget)){
                                        $mail1 .=  "<tr>
                                                        <td style='width:50px; text-align:right; padding-right:5px'>".$rec_noteget['note_code']."</td>
                                                        <td style='width:400px; text-align:left; padding-left:5px'>".$rec_noteget['note_discr']."</td>
                                                        <td style='width:100px; text-align:left; padding-left:5px'>".$rec_noteget['enterBy']."</td>
                                                        <td style='width:150px; text-align:left; padding-left:5px'>".$rec_noteget['enterDateTime']."</td>
                                                    </tr> "; 
                                     }
                                     $mail1 .=  "<tr>
                                                        <td style='width:50px; text-align:right; padding-right:5px'>&nbsp;</td>
                                                        <td style='width:400px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                        <td style='width:100px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                        <td style='width:150px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                    </tr> "; 
                                        /*for($t = 1 ; $t <= trim($_POST['row_COUNT']) ; $t++){
											    if(trim($_POST['txt_c_n'.$t] == 0)){
                                                  $mail1 .=  "<tr>
                                                                <td style='width:50px; text-align:right; padding-right:5px'>".$t."</td>
                                                                <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txtb'.$t])."</td>
                                                                <td style='width:100px; text-align:left; padding-left:5px'>".trim($_POST['txtUse'.$t])."</td>
                                                                <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txtOn'.$t])."</td>
                                                            </tr> ";
                                                }else if(trim($_POST['txt_c_n'.$t] == 1)){
                                                  $mail1 .=  "<tr>
                                                                <td style='width:50px; text-align:right; padding-right:5px'>".$t."</td>
                                                                <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txtb'.$t])."</td>
                                                                <td style='width:100px; text-align:left; padding-left:5px'>".$_SESSION['user']."</td>
                                                                <td style='width:150px; text-align:left; padding-left:5px'>".date('Y-m-d h:i:s')."</td>
                                                            </tr>";
                                                }else{
                                                    
                                                }
												
                                        }*/
                                        
                                     $mail1 .= "</table>
                                    </body>
                                    </html>";
                                    $headers1 = "MIME-Version: 1.0" . "\r\n";
                                    $headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    		
                    						// More headers
                                    $headers1 .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                    //sendMail($getmail,$title,$mail,$headers);    
                                    sendMailNuw($getmailEnter,$title1,$mail1,$headers1);
                    }
                }
				// Sending an e-Mail to newly assigned user
                if(trim($_POST['txt_inner_User1'])!= $_SESSION['user']){
                                $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".trim($_POST['txt_inner_User1'])."';";
                                $que_email = mysqli_query($conn,$sql_email);
								$Var_Issue_ShortDescr = "";
								$Var_Issue_LongDescr  = "";
                                if(mysqli_num_rows($que_email) > 0){
                    			    while($RES_email = mysqli_fetch_assoc($que_email)){
                       	                $getmail = $RES_email['email'];
                       	            }
                                    $sql_bandD = "SELECT `branch`.`branchName`,
                                                         `deparment`.`deparmentName`,
                                                         `cdb_helpdesk`.`issue`,
                                                         `cdb_helpdesk`.`help_discr` , 
                                                         `cat_states`.`cat_discr`,
                                                         `scat_01`.`scat_discr_1` ,
                                                         `scat_02`.scat_discr_2
                                                       FROM `cdb_helpdesk`,`branch`,`deparment` , `cat_states` , `scat_01` , `scat_02`
                                                       WHERE `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                                       AND `cdb_helpdesk`.`cat_code` = `cat_states`.cat_code
                                                       AND `cdb_helpdesk`.`scat_code_1` = `scat_01`.scat_code_1 
                                                       AND `cdb_helpdesk`.`scat_code_2` =  `scat_02`.scat_code_2
                                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                                    AND `cdb_helpdesk`.`helpid` = '".trim($_POST['txt_help_ID'])."';";
                                    $que_bandD = mysqli_query($conn,$sql_bandD);
                                    while($RES_bandD = mysqli_fetch_array($que_bandD)){
                       	                $ebranchName 	      = $RES_bandD[0];
                                        $eDepartmnet 		  = $RES_bandD[1];
										$Var_Issue_ShortDescr = $RES_bandD[2]; // Newly added by Rizvi on 1:03 PM 25/10/2016
										$Var_Issue_LongDescr  = $RES_bandD[3]; // Newly added by Rizvi on 1:03 PM 25/10/2016
                                        $cat = $RES_bandD[4];
                                        $scat_01 = $RES_bandD[5];
                                        $scat_02 = $RES_bandD[6];
                                    }
                                    $title = "CDB Help Desk : Service request - Re-Assigned";
                                    //$mail = "New Service Request : ".trim($_POST['txt_help_ID'])."<<".trim($_POST['txt_issue']).">>\n\n";
                                   /* $mail .= "Branch :".$_SESSION['userBranchName']."\\n\\n";
                                    $mail .= "Department :".$getUBranch;*/
                                    $mail1 = "
                    <html>
                    <head>
                    <title>HTML email</title>
                    </head>
                    <body>
                    <h3>CDB Help Desk : Service request - Assign User</h3>
                    <table border='1'>
                    	<tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Service Request</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_help_ID'])."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>From Branch </td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$ebranchName."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>From Department</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$eDepartmnet."</td>
                        </tr>
                         <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Main Category </td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$cat."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 1</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_01."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Sub Category 2</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$scat_02."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_ShortDescr."</td>
                        </tr>	
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Issue Description</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$Var_Issue_LongDescr."</td>
                        </tr>		
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Assign User :</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_inner_User1'])." - ".getUserName($conn,trim($_POST['txt_inner_User1']))."</td>
                        </tr>				
                     </table>
                     </hr>
                                     <br/>
                                     Date : ".date('Y-m-d h:i:s')."
                                     <br/>
                                     <table border='1'>
                                     <tr>
                                        <td style='width:50px; text-align:right; padding-right:5px'>#</td>
                                        <td style='width:400px; text-align:left; padding-left:5px'>Notes</td>
                                        <td style='width:100px; text-align:left; padding-left:5px'>Enterd User</td>
                                        <td style='width:150px; text-align:left; padding-left:5px'>Enterd On</td>
                                     </tr>
                                     ";
                                     $sql_noteget1 = "SELECT n.note_code , n.note_discr , n.enterBy , n.enterDateTime FROM cdb_help_note AS n WHERE n.helpid = '".trim($_POST['txt_help_ID'])."';";
                                     
                                     $squery_noteget1 = mysqli_query($conn , $sql_noteget1) or die(mysqli_error($conn));
                                     while($rec_noteget1 = mysqli_fetch_assoc($squery_noteget1)){
                                        $mail1 .=  "<tr>
                                                        <td style='width:50px; text-align:right; padding-right:5px'>".$rec_noteget1['note_code']."</td>
                                                        <td style='width:400px; text-align:left; padding-left:5px'>".$rec_noteget1['note_discr']."</td>
                                                        <td style='width:100px; text-align:left; padding-left:5px'>".$rec_noteget1['enterBy']."</td>
                                                        <td style='width:150px; text-align:left; padding-left:5px'>".$rec_noteget1['enterDateTime']."</td>
                                                    </tr> "; 
                                     }
                                     $mail1 .=  "<tr>
                                                        <td style='width:50px; text-align:right; padding-right:5px'>&nbsp;</td>
                                                        <td style='width:400px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                        <td style='width:100px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                        <td style='width:150px; text-align:left; padding-left:5px'>&nbsp;</td>
                                                    </tr> "; 
                                     $mail1 .= "</table>";
                                     
                     $mail1 .= "</body></html>";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    		
                    						// More headers
                                            $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                    //sendMail($getmail,$title,$mail,$headers);    
                                    sendMailNuw($getmail,$title,$mail1,$headers); 
                }
            }
            mysqli_commit($conn);
            echo "<script> alert('Update Successful');</script>";
             
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    function getUserName($conn,$userID){
        $getSql = "SELECT u.userID FROM user AS u WHERE u.userName = '".$userID."';";
        $getQuery = mysqli_query($conn,$getSql) or die(mysqli_error($conn));
        while($getResalt = mysqli_fetch_array($getQuery)){
            return $getResalt[0];
        }
        
    }
    
function genHelpdeskIssue($conn,$helpdeskId,$scat02){
            $isUniquc = 0;
            $isValidator = 0;
            
            $cat_code = "";
            $scat_code_1 = "";
            $scat_code_2 = "";
            $scat_code_3 = "";
            $sql_issue_cat = "select ci.cat_code , ci.scat_code_1, ci.scat_code_2, ci.scat_code_3 from cdb_cat_issue_gen AS ci WHERE ci.c_scat_code_2 = '".$scat02."' AND ci.run_statas = 1 AND ci.isEntryUser = 0;";
            $query_issue_cat = mysqli_query($conn,$sql_issue_cat) or die(mysqli_error($conn));
while($resalt_issue_cat = mysqli_fetch_array($query_issue_cat)){
  
   //echo "<script> alert('T');</script>";
   $cat_code = $resalt_issue_cat[0];
    $scat_code_1 = $resalt_issue_cat[1];
    $scat_code_2 = $resalt_issue_cat[2];
    $scat_code_3 = $resalt_issue_cat[3]; 
//}
            
            $sql_select_helpdesk_issure = "select * from cdb_helpdesk AS chi WHERE chi.helpid = '".$helpdeskId."';";
            $query_select_helpdesk_issure = mysqli_query($conn,$sql_select_helpdesk_issure) or die(mysqli_error($conn));
            //--------------------------- Start of CDB HELP DESK Table -----------------------------------------
            while($resalt_select_helpdesk_issure = mysqli_fetch_assoc($query_select_helpdesk_issure)){
                //-------- Start Helpdesk ID gen --------------------------------------
                $TableID = "";
                $hetCheck = 0;
                $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				$add = mysqli_query($conn,$sql);
				while ($rec = mysqli_fetch_array($add)){
					$_SESSION['CURRENT_DATE'] = $rec[0];
				}
                $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
                $quary_Function = mysqli_query($conn,$sqlFunction);
                while ($rec_Function = mysqli_fetch_array($quary_Function)){
                    $batch_num = $rec_Function[0]; 
                }
                $TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
                //---------- End Helpdesk ID gen --------------------------------------------
                
                //----------- Start Randam Password Generate ---------------------------------
                $DefaultPassword = "";
                /*function randomPassword() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    
                    $Signs = '@#$%*()+=[{]}\|/?';
                    $passS = array(); //remember to declare $pass as an array
                    $alphaLength = 1; //put the length -1 in cache
                    for ($i = 0; $i < 1; $i++) {
                        $n = rand(0, $alphaLength);
                        $passS[] = $Signs[$n];
                    }
                                        
                    $digits = '1234567890';
                    $passD = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $passD[] = $digits[$n];
                    }
                    
                    return ucwords(implode($pass)).implode($passS).implode($passD); //turn the array into a string
                }*/
                if($scat_code_2 == "200115") {
                    //$DefaultPassword = randomPassword();
                    $DefaultPassword = "Asdf@1234";
                }       
                //----------- END Randam Password Generate ---------------------------------
                
                //----------- Start clone Issure Insert ---------------------------------
                $v_get_Def_User = "SELECT `DefuserID` , `scat_discr_2` 
                                     FROM `scat_02` 
                                    WHERE `cat_code` = '".$cat_code."' AND
                                          `scat_code_1` = '".$scat_code_1."' AND 
                                          `scat_code_2` = '".$scat_code_2."';";
                $que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(mysqli_error($conn));
                while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
                    $usrDf = $RES_get_User['DefuserID'];
                    $scat_discr_2 =  $RES_get_User['scat_discr_2'];
                }
                
                if($scat_code_3 == "20011502" || $scat_code_3 == "20011504") $usrDf = "01002136"; //Marketing officer creation goes to Maneesha
							
			
				if($usrDf =='01BRANCH'){
					$SQL_BRWISE_USER = "select DefuserID from defuserforbranchreq df  where branchNumber = '".$resalt_select_helpdesk_issure['entry_branch']."' and scat_code_2 = ".$scat_code_2.";";
					$RS_GetBrWiseDefaultUser = mysqli_query($conn,$SQL_BRWISE_USER) or die(mysqli_error($conn));
					while($t_RS_GetBrWiseDefaultUser = mysqli_fetch_assoc($RS_GetBrWiseDefaultUser)){
						$usrDf = $t_RS_GetBrWiseDefaultUser['DefuserID'];
					}
				}
                
                $validateCount = 0;
                if(!isset($resalt_select_helpdesk_issure['inner_Remark'])){
                    $resalt_select_helpdesk_issure['inner_Remark'] = "";
                }
                
                if(!isset($resalt_select_helpdesk_issure['inner_Remark'])){
                    $resalt_select_helpdesk_issure['inner_Remark'] = "";
                }
                $query_Auth_Very = mysqli_query($conn ,"SELECT `auth_verified` FROM `scat_02` WHERE `cat_code` = '".$cat_code."' AND  `scat_code_1` = '".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';") or die(mysqli_error($conn));
                while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
                    if($rec_Auth_Very[0] == 1){
                        $validateCount = 1;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`,`Linked_helpid`) 
                                                               VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$resalt_select_helpdesk_issure['enterBy']."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$resalt_select_helpdesk_issure['entry_branch']."','".$resalt_select_helpdesk_issure['entry_department']."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$resalt_select_helpdesk_issure['init_enrty_by']."','".$resalt_select_helpdesk_issure['init_enrty_on']."','','0000-00-00 00:00:00','".$helpdeskId."');";
                        //	echo $v_getSQL_insert;
						$que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
						$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                                VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$resalt_select_helpdesk_issure['enterBy']."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$resalt_select_helpdesk_issure['entry_branch']."','".$resalt_select_helpdesk_issure['entry_department']."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$resalt_select_helpdesk_issure['user']."','".$resalt_select_helpdesk_issure['init_enrty_on']."','','0000-00-00 00:00:00');";
						//echo $v_getSQL_insert_1;
						$que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                        

                    }else{
                        $validateCount = 0;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`, `Linked_helpid`) 
                                    VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$resalt_select_helpdesk_issure['enterBy']."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$resalt_select_helpdesk_issure['entry_branch']."','".$resalt_select_helpdesk_issure['entry_department']."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$helpdeskId."');";
                        $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                        $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                     VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$resalt_select_helpdesk_issure['enterBy']."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$resalt_select_helpdesk_issure['entry_branch']."','".$resalt_select_helpdesk_issure['entry_department']."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."');";
                        $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
                    
                    }
                }
                
                //----------- END clone Issure Insert ---------------------------------
                 // -------------Strat send Mail - ------------------------------------------
                
                $sql_edfu = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code`='".$cat_code."' AND `scat_code_1`='".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';";
                $que_edrf = mysqli_query($conn,$sql_edfu) or die(mysqli_error($conn));
                while($RES_edrf = mysqli_fetch_assoc($que_edrf)){
                    if ($RES_edrf['DefuserID'] =='01BRANCH'){
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
                    }else{
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
                    }
                    $que_email = mysqli_query($conn,$sql_email) or die(mysqli_error($conn));
                   	if(mysqli_num_rows($que_email) > 0){
                   	    while($RES_email = mysqli_fetch_assoc($que_email)){
           	                $getmail = $RES_email['email'];
           	            }
                        $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$resalt_select_helpdesk_issure['enterBy']."';";
                        $que_uName = mysqli_query($conn,$sql_uName);
                        while($RES_uName = mysqli_fetch_assoc($que_uName)){
                            $getUName = $RES_uName['userID'];
                            $getTP = $RES_uName['GSMNO'];
                        }
                        $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$resalt_select_helpdesk_issure['entry_department']."' AND `branchNumber` = '".$resalt_select_helpdesk_issure['entry_branch']."';";
                        $que_uDepa = mysqli_query($conn,$sql_uDepart);
                        while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                            $getUBranch = $RES_udep['deparmentName'];
                        } 
                        $title = "CDB Help Desk : New service request";
                        $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$TableID."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['issue']."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['enterBy']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['entry_branch']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Department</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User IP</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['ipAddress']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User Telephone</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getTP."</td>
    </tr>
 </table>
</body>
</html>";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        		
                        						// More headers
                        $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                        //sendMail($getmail,$title,$mail,$headers);    
                        if($validateCount == 0){
                            sendMailNuw($getmail,$title,$mail,$headers); 
                        }
                         // -------------END send Mail - ------------------------------------------
                         // ------------- Start Pat pat lease send sms - ------------------------------------------
                        $sql_cou_cycal = "SELECT s3.DefuserID , u.GSMNO , s3.scat_discr_3
                                            FROM scat_03 AS s3 , user AS u 
                                            WHERE s3.DefuserID = u.userName 
                                            	and s3.cat_code = '1024'
                                                and s3.scat_code_2 = '".$scat_code_2."'
                                                and s3.scat_code_3 = '".$scat_code_3."';";
                        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn)) ;
                        while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                            if ( substr($res_cou_cycal[1],0,2) =='07'){                  
                                $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".$res_cou_cycal[1]."',CONCAT('PATPAT.LK Alert!".chr(10)."Ref :".$TableID.chr(10)."Client Contact Number :".$resalt_select_helpdesk_issure['issue'].chr(10)."".$resalt_select_helpdesk_issure['help_discr'].chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
                                                                                   
                            }
                            $sql_updatedef = "UPDATE `cdb_helpdesk` SET `asing_by` = '".$res_cou_cycal[0]."' WHERE `helpid` = '".$TableID."';";
                            $query_updatedef =  mysqli_query($conn,$sql_updatedef) or die(mysqli_error($conn)); 
                            
                            $msgCus1 = $scat_discr_2." patpat.lk officer ".$res_cou_cycal[2]." (".$res_cou_cycal[1].") will contact you shortly."; 
                            //$msgCus1 = "For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999" ;
                            
                            if ( substr($resalt_select_helpdesk_issure['issue'],0,2) =='07' && strlen($resalt_select_helpdesk_issure['issue']) == 10){                  
                                /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".trim($_POST['txt_issue'])."',CONCAT('PATPAT.LK Alert!".chr(10).$msgCus1.chr(10)."For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999".chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));        */                                            
                            }
                        }
                    
                         // ------------- END Pat pat lease send sms - ------------------------------------------
                    }
                                                 
                }
                
                
                
            }
            //--------------------------- End of select CDB HELP DESK Table ------------------------------------
    }
}


function genHelpdeskNewIssue($conn,$helpdeskId,$scat02,$userEnrty,$userBranch,$userDepartment){
            $isUniquc = 0;
            $isValidator = 0;
            
            $cat_code = "";
            $scat_code_1 = "";
            $scat_code_2 = "";
            $scat_code_3 = "";
            $sql_issue_cat = "select ci.cat_code , ci.scat_code_1, ci.scat_code_2, ci.scat_code_3 from cdb_cat_issue_gen AS ci WHERE ci.c_scat_code_2 = '".$scat02."' AND ci.run_statas = 1 AND ci.isEntryUser = 1;";
            $query_issue_cat = mysqli_query($conn,$sql_issue_cat) or die(mysqli_error($conn));
while($resalt_issue_cat = mysqli_fetch_array($query_issue_cat)){
    //echo "<script> alert('Q');</script>";
    $cat_code = $resalt_issue_cat[0];
    $scat_code_1 = $resalt_issue_cat[1];
    $scat_code_2 = $resalt_issue_cat[2];
    $scat_code_3 = $resalt_issue_cat[3]; 
//}
            
            $sql_select_helpdesk_issure = "select * from cdb_helpdesk AS chi WHERE chi.helpid = '".$helpdeskId."';";
            $query_select_helpdesk_issure = mysqli_query($conn,$sql_select_helpdesk_issure) or die(mysqli_error($conn));
            //--------------------------- Start of CDB HELP DESK Table -----------------------------------------
            while($resalt_select_helpdesk_issure = mysqli_fetch_assoc($query_select_helpdesk_issure)){
                //-------- Start Helpdesk ID gen --------------------------------------
                $TableID = "";
                $hetCheck = 0;
                $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				$add = mysqli_query($conn,$sql);
				while ($rec = mysqli_fetch_array($add)){
					$_SESSION['CURRENT_DATE'] = $rec[0];
				}
                $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
                $quary_Function = mysqli_query($conn,$sqlFunction);
                while ($rec_Function = mysqli_fetch_array($quary_Function)){
                    $batch_num = $rec_Function[0]; 
                }
                $TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
                //---------- End Helpdesk ID gen --------------------------------------------
                
                //----------- Start Randam Password Generate ---------------------------------
                $DefaultPassword = "";
               /* function randomPassword1() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    
                    $Signs = '@#$%*()+=[{]}\|/?';
                    $passS = array(); //remember to declare $pass as an array
                    $alphaLength = 1; //put the length -1 in cache
                    for ($i = 0; $i < 1; $i++) {
                        $n = rand(0, $alphaLength);
                        $passS[] = $Signs[$n];
                    }
                                        
                    $digits = '1234567890';
                    $passD = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $passD[] = $digits[$n];
                    }
                    
                    return ucwords(implode($pass)).implode($passS).implode($passD); //turn the array into a string
                }*/
                if($scat_code_2 == "200115") {
                   // $DefaultPassword = randomPassword1();
                     $DefaultPassword = "Acdb@1235";
                }       
                //----------- END Randam Password Generate ---------------------------------
                
                //----------- Start clone Issure Insert ---------------------------------
                $v_get_Def_User = "SELECT `DefuserID` , `scat_discr_2` 
                                     FROM `scat_02` 
                                    WHERE `cat_code` = '".$cat_code."' AND
                                          `scat_code_1` = '".$scat_code_1."' AND 
                                          `scat_code_2` = '".$scat_code_2."';";
                $que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(mysqli_error($conn));
                while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
                    $usrDf = $RES_get_User['DefuserID'];
                    $scat_discr_2 =  $RES_get_User['scat_discr_2'];
                }
                
                if($scat_code_3 == "20011502" || $scat_code_3 == "20011504") $usrDf = "01002136"; //Marketing officer creation goes to Maneesha
							
			
				if($usrDf =='01BRANCH'){
					$SQL_BRWISE_USER = "select DefuserID from defuserforbranchreq df  where branchNumber = '".$userBranch."' and scat_code_2 = ".$scat_code_2.";";
					$RS_GetBrWiseDefaultUser = mysqli_query($conn,$SQL_BRWISE_USER) or die(mysqli_error($conn));
					while($t_RS_GetBrWiseDefaultUser = mysqli_fetch_assoc($RS_GetBrWiseDefaultUser)){
						$usrDf = $t_RS_GetBrWiseDefaultUser['DefuserID'];
					}
				}
                
                $validateCount = 0;
                $query_Auth_Very = mysqli_query($conn ,"SELECT `auth_verified` FROM `scat_02` WHERE `cat_code` = '".$cat_code."' AND  `scat_code_1` = '".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';") or die(mysqli_error($conn));
                while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
                    if($rec_Auth_Very[0] == 1){
                        $validateCount = 1;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`,`Linked_helpid`) 
                                                               VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$resalt_select_helpdesk_issure['init_enrty_by']."','".$resalt_select_helpdesk_issure['init_enrty_on']."','','0000-00-00 00:00:00','".$helpdeskId."');";
                        //	echo $v_getSQL_insert;
						$que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
						$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                                VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$resalt_select_helpdesk_issure['user']."','".$resalt_select_helpdesk_issure['init_enrty_on']."','','0000-00-00 00:00:00');";
						//echo $v_getSQL_insert_1;
						$que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                        

                    }else{
                        $validateCount = 0;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`Linked_helpid`) 
                                    VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$helpdeskId."');";
                        $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                        $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                     VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."');";
                        $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
                    
                    }
                }
                
                //----------- END clone Issure Insert ---------------------------------
                 // -------------Strat send Mail - ------------------------------------------
                
                $sql_edfu = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code`='".$cat_code."' AND `scat_code_1`='".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';";
                $que_edrf = mysqli_query($conn,$sql_edfu) or die(mysqli_error($conn));
                while($RES_edrf = mysqli_fetch_assoc($que_edrf)){
                    if ($RES_edrf['DefuserID'] =='01BRANCH'){
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
                    }else{
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
                    }
                    $que_email = mysqli_query($conn,$sql_email) or die(mysqli_error($conn));
                   	if(mysqli_num_rows($que_email) > 0){
                   	    while($RES_email = mysqli_fetch_assoc($que_email)){
           	                $getmail = $RES_email['email'];
           	            }
                        $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$userEnrty."';";
                        $que_uName = mysqli_query($conn,$sql_uName);
                        while($RES_uName = mysqli_fetch_assoc($que_uName)){
                            $getUName = $RES_uName['userID'];
                            $getTP = $RES_uName['GSMNO'];
                        }
                        $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$userDepartment."' AND `branchNumber` = '".$userBranch."';";
                        $que_uDepa = mysqli_query($conn,$sql_uDepart);
                        while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                            $getUBranch = $RES_udep['deparmentName'];
                        } 
                        $title = "CDB Help Desk : New service request";
                        $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$TableID."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['issue']."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$userEnrty."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$userBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Department</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User IP</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['ipAddress']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User Telephone</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getTP."</td>
    </tr>
 </table>
</body>
</html>";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        		
                        						// More headers
                        $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                        //sendMail($getmail,$title,$mail,$headers);    
                        if($validateCount == 0){
                            sendMailNuw($getmail,$title,$mail,$headers); 
                        }
                         // -------------END send Mail - ------------------------------------------
                         // ------------- Start Pat pat lease send sms - ------------------------------------------
                        $sql_cou_cycal = "SELECT s3.DefuserID , u.GSMNO , s3.scat_discr_3
                                            FROM scat_03 AS s3 , user AS u 
                                            WHERE s3.DefuserID = u.userName 
                                            	and s3.cat_code = '1024'
                                                and s3.scat_code_2 = '".$scat_code_2."'
                                                and s3.scat_code_3 = '".$scat_code_3."';";
                        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn)) ;
                        while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                            if ( substr($res_cou_cycal[1],0,2) =='07'){                  
                                $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".$res_cou_cycal[1]."',CONCAT('PATPAT.LK Alert!".chr(10)."Ref :".$TableID.chr(10)."Client Contact Number :".$resalt_select_helpdesk_issure['issue'].chr(10)."".$resalt_select_helpdesk_issure['help_discr'].chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
                                                                                   
                            }
                            $sql_updatedef = "UPDATE `cdb_helpdesk` SET `asing_by` = '".$res_cou_cycal[0]."' WHERE `helpid` = '".$TableID."';";
                            $query_updatedef =  mysqli_query($conn,$sql_updatedef) or die(mysqli_error($conn)); 
                            
                            $msgCus1 = $scat_discr_2." patpat.lk officer ".$res_cou_cycal[2]." (".$res_cou_cycal[1].") will contact you shortly."; 
                            //$msgCus1 = "For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999" ;
                            
                            if ( substr($resalt_select_helpdesk_issure['issue'],0,2) =='07' && strlen($resalt_select_helpdesk_issure['issue']) == 10){                  
                                /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".trim($_POST['txt_issue'])."',CONCAT('PATPAT.LK Alert!".chr(10).$msgCus1.chr(10)."For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999".chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));        */                                            
                            }
                        }
                    
                         // ------------- END Pat pat lease send sms - ------------------------------------------
                    }
                                                 
                }
                
                
                
            }
            //--------------------------- End of select CDB HELP DESK Table ------------------------------------

  }                  
                    
}                       
?>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>
