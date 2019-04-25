<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Close Service Request
Purpose			: To viwe Close Request list for Service
Author			: Madushan Wikramaarachchi
Date & Time		: 10.35 A.M 25/04/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/025";
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
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}

    /*function clientValidate(title,cat_cod){
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
        
    }*/
    
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
}

function myFunction(x) {
    tagRow = x.rowIndex;
}
function columFunction(x) {
    tagCol = x.cellIndex;
}

function selcect_helpID_delels(){
  //  alert("A");
    
    var getHI = document.getElementById('txt_HelpID').value;
    var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('maneSpan').innerHTML=mydata.responseText;           
        }
    }
    
    mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDCloaseREquest="+getHI,true);
    mydata.send();
       
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
<table>
    <tr>
        <td style="width: 100px; text-align: right;"><label class="linetop">Help ID :</label></td>
        <td style="width: 150px;">
            <input class="box_decaretion" type="text" name="txt_HelpID" id="txt_HelpID" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
        </td>
        <td>
           <input type="button" style="width: 100px;" class="buttonManage" value="Select" id="btn_select" name="btn_select" onclick="selcect_helpID_delels()" />
        </td>
    </tr>
</table>

<span id="maneSpan">


</span>
<div style="display: none;">
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
    <input type="text" name="userBranch" id="userBranch" value="<?php echo  $_SESSION['userBranch']; ?>" />
    <input type="text" name="userDepartment" id="userDepartment" value="<?php echo  $_SESSION['userDepartment']; ?>" />
    
</div>


<span id="getGried"></span>
</form>
</body>
</html>
