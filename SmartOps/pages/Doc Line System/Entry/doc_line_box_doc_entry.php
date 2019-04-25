<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Load Documents
Purpose			: Load Documents
Author			: Madushan Wikramaara
Date & Time		: 2.29 PM 09/06/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/001";
	$_SESSION['Module'] = "Doc Line System";
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
<title>Box Type Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
<script language="javascript" type="text/javascript">
		function deleteRow(n){
			var m=n.parentNode.parentNode.rowIndex;
			document.getElementById('myTable').deleteRow(m);
			var num1 = document.getElementById("myTable").rows.length;
			var num2 = num1 - 1;
			document.getElementById('txtrow').value = num2;
			document.getElementById('txtrow1').value = num2;
			var y = 1;
			
			var  rowcount = document.getElementById("myTable").rows.length;
			i = rowcount-1;
			for(var mloop=2;mloop <=100;mloop++){
				var elementA =  document.getElementById('txta' + (mloop - 1));
				var elementB =  document.getElementById('txtb' + (mloop - 1));
				var elementC1 =  document.getElementById('gettext' + (mloop - 1));
				var elementC =  document.getElementById('txtc' + (mloop - 1));
				var elementD =  document.getElementById('txtd' + (mloop - 1));
				var elementE =  document.getElementById('txte' + (mloop - 1));
				if (elementA != null){
					  // Re-order the sequence of the table rows.............
					  elementA.value = y;
					  
					  //Changing the element ID's to capture in the php
					  elementA.id = 'txta' + y;				  
					  elementB.id = 'txtb' + y;
					  elementC1.id = 'gettext' + y;
					  elementC.id = 'txtc' + y;
					  elementD.id = 'txtd' + y;
					  elementE.id = 'txte' + y;
					  
					  //Changing the element name's to capture in the php				  
					  elementA.name = 'txta' + y;				  
					  elementB.name = 'txtb' + y;
					  elementC.name = 'txtc' + y;
					  elementD.name = 'txtd' + y;
					  elementE.name = 'txte' + y;
					  y++;
				}			
			}
		}
		  
		var metaChar = false;
		var exampleKey = 13;

		function keyEvent(event) {
		  var key = event.keyCode || event.which;
		  var keychar = String.fromCharCode(key);
		  if (key == exampleKey) {
			metaChar = true;
		  }
		  if (key != exampleKey) {
			if (metaChar) {
			  alert("Combination of metaKey + " + keychar);
			  metaChar = false;
			} else {
			  //alert("Key pressed " + key);
			}
		  }else{
			//alert("aaaasss " + key);
			 		var o = 1;
					var selectBox = document.getElementById('selBoxMast').value;
					var y = document.getElementById("myTable").rows.length-1;
                    var chk1 = 'N';
                    var chk2 = 'N'
                    if(document.getElementById("txtd"+y).checked == true){
                        chk1 = 'RD';
                    }
                    if(document.getElementById("txte"+y).checked == true){
                         chk2 = 'SD';
                    }
                  
                    //alert(chk1+' '+chk2);
                    
					//alert("aaaasss " + selectBox);
if(selectBox != ""){
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
					//alert("aaaasss " + y);
					var isDuplicate = false;

					var CurrentCellValue  = document.getElementById('txtb'+y).value; //Account No
					//alert("aaaasss " + CurrentCellValue);
					var ss = document.getElementById('txtb'+y).value; //Account No
					
					var x = document.getElementById("myTable").rows.length;
					var docsel = document.getElementById("selDocType").value;
					
					/////////////////////////////////////////////////////////////////////////////////////
					var mydataSub;
					mydataSub= new XMLHttpRequest();
					mydataSub.onreadystatechange=function(){
						if(mydataSub.readyState==4){
							document.getElementById('desitionVal').innerHTML=mydataSub.responseText;
							var getDesValNew=document.getElementById('txtDesitionVal').value;
if(getDesValNew=="NOFULL"){
								//alert("NOFULL");
								for(var r=1; r<document.getElementById("myTable").rows.length -1; r++){
									if(CurrentCellValue == document.getElementById('txtb'+r).value){
										isDuplicate = true;
										break;
									}
								}
					
					if(isDuplicate){
						alert("Account number cannot be duplicate in a box");
						return null;
					}
					
					if(ss != ""&&!isDuplicate){
						var mydata;
						mydata= new XMLHttpRequest();
						mydata.onreadystatechange=function(){
							if(mydata.readyState==4){
								document.getElementById('getValID').innerHTML=mydata.responseText;
								var getCount = document.getElementById('txtCount').value;
								if(getCount != 0){
									if(docsel == "BO"){
								var mydata1;
								mydata1= new XMLHttpRequest();
								mydata1.onreadystatechange=function(){
									if(mydata1.readyState==4){
										document.getElementById('gettext'+y).innerHTML=mydata1.responseText;
									}
								}
								mydata1.open("GET","ajax_doc_line_box_doc_entry_01.php"+"?txtdoc="+ss+"&txtnum="+y,true);
								mydata1.send();
								var table=document.getElementById("myTable");
								var row=table.insertRow(-1);
								var cell1=row.insertCell(0);
								var cell2=row.insertCell(1);
								var cell3=row.insertCell(2);
							 	var cell4=row.insertCell(3);
							 	var cell5=row.insertCell(4);
							 	var cell6=row.insertCell(5);
								cell1.innerHTML="<input style='width:50px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"' onKeyPress='return disableEnterKey(event)' required/>";
								cell2.innerHTML="<input style='width:150px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  maxlength='22' onKeyPress='return disableEnterKey(event)' required/>";
								cell3.innerHTML="<div id='gettext"+(x)+"'><input style='width:350px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>";
								cell4.innerHTML="<input type='checkbox' name='txtd"+(x)+"' id='txtd"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' checked='checked' onclick='checkValidate(this.id)'/>";
								cell5.innerHTML="<input type='checkbox' name='txte"+(x)+"' id='txte"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' onclick='checkValidate(this.id)' checked='checked'/>";
								cell6.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
								document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
								document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
								var elem = document.getElementById('txtb'+x);
								if(elem != null){
									if(elem.createTextRange){
										var range = elem.createTextRange();
										range.move('character', caretPos);
										range.select();
									}else{
										if(elem.selectionStart){
											elem.focus();
											elem.setSelectionRange(caretPos, caretPos);
										}else{
											elem.focus();
										}
									}
								}
							}else if(docsel == "RO"){
								var mydata1;
								mydata1= new XMLHttpRequest();
								mydata1.onreadystatechange=function(){
									if(mydata1.readyState==4){
										document.getElementById('gettext'+y).innerHTML=mydata1.responseText;
									}
								}
								mydata1.open("GET","ajax_doc_line_box_doc_entry_01.php"+"?txtdoc="+ss+"&txtnum="+y,true);
								mydata1.send();
								var table=document.getElementById("myTable");
								var row=table.insertRow(-1);
								var cell1=row.insertCell(0);
								var cell2=row.insertCell(1);
								var cell3=row.insertCell(2);
								var cell4=row.insertCell(3);
								var cell5=row.insertCell(4);
								var cell6=row.insertCell(5);
								cell1.innerHTML="<input style='width:50px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"' onKeyPress='return disableEnterKey(event)' required/>";
								cell2.innerHTML="<input style='width:150px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  maxlength='22' onKeyPress='return disableEnterKey(event)'/>";
								cell3.innerHTML="<div id='gettext"+(x)+"'><input style='width:350px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>";
								cell4.innerHTML="<input type='checkbox' name='txtd"+(x)+"' id='txtd"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' checked='checked' onclick='checkValidate(this.id)'/>";
								cell5.innerHTML="<input type='checkbox' name='txte"+(x)+"' id='txte"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' onclick='checkValidate(this.id)'/>";
								cell6.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
								document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
								document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
								var elem = document.getElementById('txtb'+x);
								if(elem != null) {
									if(elem.createTextRange) {
											var range = elem.createTextRange();
											range.move('character', caretPos);
											range.select();
										}
										else {
											if(elem.selectionStart) {
												elem.focus();
												elem.setSelectionRange(caretPos, caretPos);
											}
											else
												elem.focus();
										}
									}
							}else if(docsel == "SO"){
								var mydata1;
							mydata1= new XMLHttpRequest();
							mydata1.onreadystatechange=function(){
								if(mydata1.readyState==4){
									document.getElementById('gettext'+y).innerHTML=mydata1.responseText;
								}
							}
							mydata1.open("GET","ajax_doc_line_box_doc_entry_01.php"+"?txtdoc="+ss+"&txtnum="+y,true);
							mydata1.send();
							var table=document.getElementById("myTable");
							var row=table.insertRow(-1);
							var cell1=row.insertCell(0);
							var cell2=row.insertCell(1);
							var cell3=row.insertCell(2);
							 var cell4=row.insertCell(3);
							 var cell5=row.insertCell(4);
							 var cell6=row.insertCell(5);
							cell1.innerHTML="<input style='width:50px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)'  required/>";
							cell2.innerHTML="<input style='width:150px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value='' maxlength='22'  onKeyPress='return disableEnterKey(event)'/>";
							cell3.innerHTML="<div id='gettext"+(x)+"'><input style='width:350px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>";
							cell4.innerHTML="<input type='checkbox' name='txtd"+(x)+"' id='txtd"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onclick='checkValidate(this.id)'/>";
							cell5.innerHTML="<input type='checkbox' name='txte"+(x)+"' id='txte"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onclick='checkValidate(this.id)' checked='checked'/>";
							cell6.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
							document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
							document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
								var elem = document.getElementById('txtb'+x);
								if(elem != null) {
									if(elem.createTextRange) {
										var range = elem.createTextRange();
										range.move('character', caretPos);
										range.select();
									}
									else {
										if(elem.selectionStart) {
											elem.focus();
											elem.setSelectionRange(caretPos, caretPos);
										}
										else
											elem.focus();
									}
								}
							}
								}else{
									alert("Incorrect Document Number !");
									document.getElementById('txtb'+y).value = "";
								}
							}
						}
						mydata.open("GET","ajax_doc_line_box_doc_entry_02.php"+"?txtval="+ss,true);
						mydata.send();
					}else{
						alert("Insert to data in befor row");
					}
}else if(getDesValNew=="ISFULL"){
			var mydataval;
			mydataval= new XMLHttpRequest();
			mydataval.onreadystatechange=function(){
				if(mydataval.readyState==4){
					document.getElementById('boxValidate').innerHTML=mydataval.responseText;
					var getDocNumNew =document.getElementById('txtb'+y).value;
					var getnewBoxNum =document.getElementById('txtalet').value;
					//alert("This Document already exists!");
					alert("This Document already exists! \n Document no : <"+getDocNumNew+"> \n Box no : <"+getnewBoxNum+">");
					document.getElementById("txtb"+y).value="";
					document.getElementById("txtc"+y).value="";
					document.getElementById("txte"+y).checked=true;
					document.getElementById("txtd"+y).checked=true;
					
				}
			}
			
			mydataval.open("GET","ajax_doc_line_box_doc_entry_05.php"+"?txtVal="+CurrentCellValue,true);
			mydataval.send();
			
}else if(getDesValNew=="RDFULL"){
			//alert("RDFULL");
			if(docsel=="RO"){
				alert("This Document already exists!");
			}else{
				//alert("The Reference Only Document already exist!");
				for(var r=1; r<document.getElementById("myTable").rows.length -1; r++){
					if(CurrentCellValue == document.getElementById('txtb'+r).value){
						isDuplicate = true;
						break;
					}
				}
					
				if(isDuplicate){
					alert("Account number cannot be duplicated in a box");
					return null;
				}
					
					if(ss != ""&&!isDuplicate){
						var mydata;
						mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
							if(mydata.readyState==4){
								document.getElementById('getValID').innerHTML=mydata.responseText;
								var getCount = document.getElementById('txtCount').value;
								if(getCount != 0){
								//////////////////////////////////////////	
										var mydata1;
										mydata1= new XMLHttpRequest();
										mydata1.onreadystatechange=function(){
											if(mydata1.readyState==4){
												document.getElementById('gettext'+y).innerHTML=mydata1.responseText;
											//////////////////////////////////////	
												var mydataval;
												mydataval= new XMLHttpRequest();
												mydataval.onreadystatechange=function(){
													if(mydataval.readyState==4){
														document.getElementById('boxValidate').innerHTML=mydataval.responseText;
														var getnewBoxNum =document.getElementById('txtalet').value;
														//alert("The Reference Only Document already exist!");
														alert("The Reference Only Document already exist! \n Document no : <"+CurrentCellValue+"> \n Box no : <"+getnewBoxNum+">");
														document.getElementById("txtb"+y).value="";
														document.getElementById("txtc"+y).value="";
														document.getElementById("txte"+y).checked=true;
														document.getElementById("txtd"+y).checked=true;
													}
												}
												
                                                //chk1+' '+chk2
                                                //+"&getchk1="+getchk2+"&getchk2="+chk2
												mydataval.open("GET","ajax_doc_line_box_doc_entry_05.php"+"?txtVal="+CurrentCellValue,true);
												mydataval.send();
											///////////////////////////////////////////////////////			
												
											}
										}
										mydata1.open("GET","ajax_doc_line_box_doc_entry_01.php"+"?txtdoc="+ss+"&txtnum="+y,true);
										mydata1.send();
										
												if(elem != null) {
													if(elem.createTextRange) {
														var range = elem.createTextRange();
														range.move('character', caretPos);
														range.select();
													}
													else {
														if(elem.selectionStart) {
															elem.focus();
															elem.setSelectionRange(caretPos, caretPos);
														}
														else
															elem.focus();
													}
												}
									/////////////////////////////
								}else{
									alert("Incorrect Document Number !");
									document.getElementById('txtb'+y).value = "";
								}
							}
						}
						mydata.open("GET","ajax_doc_line_box_doc_entry_02.php"+"?txtval="+ss,true);
						mydata.send();
					}else{
						alert("Insert to data in befor row");
					}
		}
}else if(getDesValNew=="SDFULL"){
			//alert("SDFULL");
			if(docsel=="SO"){
				alert("This Document already exists!");
			}else{
				//alert("The Security Only Document already exist!");
				for(var r=1; r<document.getElementById("myTable").rows.length -1; r++){
					if(CurrentCellValue == document.getElementById('txtb'+r).value){
						isDuplicate = true;
						break;
					}
				}
					
				if(isDuplicate){
					alert("Account number cannot be duplicate in a box");
					return null;
				}
					
					if(ss != ""&&!isDuplicate){
						var mydata;
						mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
							if(mydata.readyState==4){
								document.getElementById('getValID').innerHTML=mydata.responseText;
								var getCount = document.getElementById('txtCount').value;
								if(getCount != 0){
								//////////////////////////////////////////	
										var mydata1;
										mydata1= new XMLHttpRequest();
										mydata1.onreadystatechange=function(){
											if(mydata1.readyState==4){
												document.getElementById('gettext'+y).innerHTML=mydata1.responseText;
												var mydataval;
												mydataval= new XMLHttpRequest();
												mydataval.onreadystatechange=function(){
													if(mydataval.readyState==4){
														document.getElementById('boxValidate').innerHTML=mydataval.responseText;
														var getnewBoxNum = document.getElementById('txtalet').value;
														//alert("The Security Only Document already exist!");
														alert("The Security Only Document already exist! \n Document no : <"+CurrentCellValue+"> \n Box no : <"+getnewBoxNum+">");
														document.getElementById("txtb"+y).value="";
														document.getElementById("txtc"+y).value="";
														document.getElementById("txte"+y).checked=true;
														document.getElementById("txtd"+y).checked=true;
														
													}
												}
												//+"&getchk1="+getchk2+"&getchk2="+chk2
												mydataval.open("GET","ajax_doc_line_box_doc_entry_05.php"+"?txtVal="+CurrentCellValue,true);
												mydataval.send();
											}
										}
										mydata1.open("GET","ajax_doc_line_box_doc_entry_01.php"+"?txtdoc="+ss+"&txtnum="+y,true);
										mydata1.send();
										
												if(elem != null) {
													if(elem.createTextRange) {
														var range = elem.createTextRange();
														range.move('character', caretPos);
														range.select();
													}
													else {
														if(elem.selectionStart) {
															elem.focus();
															elem.setSelectionRange(caretPos, caretPos);
														}
														else
															elem.focus();
													}
												}
									/////////////////////////////
								}else{
									alert("Incorrect Document Number !");
									document.getElementById('txtb'+y).value = "";
								}
							}
						}
						mydata.open("GET","ajax_doc_line_box_doc_entry_02.php"+"?txtval="+ss,true);
						mydata.send();
					}else{
						alert("Insert to data in befor row");
					}
		}
}else{
		
		}
	}
}
//var sub1=document.getElementById('selectCodeDoc').value;
mydataSub.open("GET","ajax_doc_line_box_doc_entry_03.php"+"?txtDesVal="+ss+"&getchk1="+chk1+"&getchk2="+chk2,true);
mydataSub.send();
/////////////////////////////////////////////////////////////////////////////////////
					
}else{
	alert("Select First Box Number!");
	document.getElementById('txtb'+y).value = ""; 
	
}				
		  }
		}
		
		function metaKeyUp (event) {
		  var key = event.keyCode || event.which;
		  if (key == exampleKey) {
			metaChar = false;
		  }
		}
		
		function changeSleUp(){
			var docsel = document.getElementById("selDocType").value; 	//Current Cell Value
			var y = document.getElementById("myTable").rows.length-1;	//Current Cell row number
			
			var statusValue = [true,true];
			statusValue [0] = (docsel == "BO") ? true : (docsel == "RO") ? true : false;
			statusValue [1] = (docsel == "BO") ? true : (docsel == "RO") ? false : true;
			document.getElementById("txtd"+y).checked=statusValue [0];
    		document.getElementById("txte"+y).checked=statusValue [1];			
		}
		
		function checkValidate(getid){
			var idStr = getid.substring(4);
			
			var x = document.getElementById("txtd" + idStr).checked;
			var y = document.getElementById("txte" + idStr).checked;		
			if(x == false && y == false){
				alert("Both cannot be unchcked.");
				document.getElementById(getid).checked=true;
			}
				
		}
		function loadGried(){
			//alert("aaaa");
			var mydataLoad;
			mydataLoad= new XMLHttpRequest();
			mydataLoad.onreadystatechange=function(){
				if(mydataLoad.readyState==4){
					document.getElementById('divLoad').innerHTML=mydataLoad.responseText;
					//document.getElementById('txtb'+(document.getElementById("myTable").rows.length-1).focus();

					document.getElementById('txtb' + (document.getElementById("myTable").rows.length-1) ).focus();
					
				}
			}
			var no=document.getElementById('selBoxMast').value;
			mydataLoad.open("GET","ajax_doc_line_box_doc_entry_04.php"+"?txt1="+no,true);
			mydataLoad.send();
		}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr />
<table>
  <tr>
    <td style="width:150px; text-align:right;" ><p class="linetop">Box Number : </p></td>
    <td>
    	<?php 
			$addsqlBox_Mast="SELECT `box_number` FROM `doc_line_box_mast` WHERE `box_clo_date`='0000-00-00' AND `branch` = '$_SESSION[userBranch]' AND `department` = '$_SESSION[userDepartment]'";
			$quaryBox_Mast = mysqli_query($conn,$addsqlBox_Mast);
			?>
            <select name="selBoxMast" style=" font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selBoxMast" onchange="loadGried()" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required>
            <option style="color:#CCCCCC;" value="">--Select Box Master--</option>
            <?php
			 while ($rec1 = mysqli_fetch_array($quaryBox_Mast)){
			 	echo "<option value='".$rec1[0]."'>".$rec1[0]."</option>";
			 }
			?>
            </select>
    </td>
    <td style="width:300px;"><div id="boxValidate"></div></td>
  </tr>
</table>
<table>
  <tr>
    <td style="width:150px; text-align:right;"><p class="linetop">Document Selection : </p></td>
    <td>
            <select name="selDocType" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selDocType" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="changeSleUp()" required>
            <option value="BO">Both</option>
            <option value="RO">Reference Only</option>
            <option value="SO">Security Only</option>
            </select>
    </td>
  </tr>
</table><br/>
<br/>
<div id="divLoad">
 <table border="1" id="myTable"  style="width:840px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
  <tr class="tbl1">
    <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
    <td style="width:150px; text-align:left; padding-left:5px;">Document Number</td>
    <td style="width:350px; text-align:left; padding-left:5px;">Document Name</td>
    <td style="width:100px; text-align:left; padding-left:5px;">Reference Documnet</td>
    <td style="width:100px; text-align:left; padding-left:5px;">Security Documnet</td>
    <td style="width:90px;"></td>
  </tr>
  <tr style="background:#FFFFFF;">
    <td style="width:50px;"><input style="width:50px;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
    <td style="width:150px;"><input style="width:150px;" type="text" name="txtb1" id="txtb1" value="" maxlength="22"  onKeyPress="return disableEnterKey(event)" required/></td>
    <td style="width:350px;"><div id="gettext1"><input style="width:350px; color:#999999;" type="text" name="txtc1" id="txtc1" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></div></td>
    <td style="width:100px;"><input type="checkbox" name="txtd1" id="txtd1" value=""  onKeyPress="return disableEnterKey(event)" onclick="checkValidate(this.id)" checked="checked"/></td>
    <td style="width:100px;"><input type="checkbox" name="txte1" id="txte1" value=""  onKeyPress="return disableEnterKey(event)"  onclick="checkValidate(this.id)" checked="checked"/></td>
    <td style="width:90px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
  </tr>
</table>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocMasterSave" value="Save"/>
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div id="getValID" style='display:none;'>
	<input type="text" name="txtCount" id="txtCount" value="0"  onKeyPress="return disableEnterKey(event)"/>
</div>

<div id="desitionVal" style='display:none;'>
	<input type="text" name="txtDesitionVal" id="txtDesitionVal" value="0"  onKeyPress="return disableEnterKey(event)"/>
</div>
 <?php
			if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Save'){
				// Set autocommit to off
				
				mysqli_autocommit($conn,FALSE);
				try{
				
					$_SESSION['selBoxMast'] = trim($_POST['selBoxMast']);
					$_SESSION['txtrow'] =  trim($_POST['txtrow']);
					if($_SESSION['selBoxMast']!=""){
						 date_default_timezone_set('Asia/Colombo');
						 $sql_del = "DELETE FROM `doc_line_file_stack` WHERE `box_number`= '$_SESSION[selBoxMast]'";
						 $result_del= mysqli_query($conn,$sql_del) or  die(mysqli_error($conn));

						 for($i = 1 ; $i<=$_SESSION['txtrow']; $i++){
							
							if(isset($_POST['txtd'.$i])){
								$v_Sql_Command = "INSERT INTO `doc_line_file_stack`(`box_number`, `doc_number`, `doc_type`, `action_stat`,`docindex`) VALUES ('$_SESSION[selBoxMast]','".trim($_POST['txtb'.$i])."','RD','LD','".trim($_POST['txta'.$i])."')";			
								$result1= mysqli_query($conn,$v_Sql_Command) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));				
							}

							
							if(isset($_POST['txte'.$i])){
								$v_Sql_Command = "INSERT INTO `doc_line_file_stack`(`box_number`, `doc_number`, `doc_type`, `action_stat`,`docindex`) VALUES ('$_SESSION[selBoxMast]','".trim($_POST['txtb'.$i])."','SD','LD','".trim($_POST['txta'.$i])."')";			
								$result2= mysqli_query($conn,$v_Sql_Command) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));	
							}
						 }
						 echo "<script> alert('" . $_SESSION['txtrow'] . " record(s) updated!');
						 				pageClose();
						 	   </script>";
						 
					}else{
						echo "<script> alert('Please enter complete details!');</script>";
					}
					// Commit transaction
					
					mysqli_commit($conn);
  				}catch(Exception $e){
					// Rollback transaction
					//die();
					
					mysqli_rollback($conn);
					//die();
				    echo 'Message: '.$e->getMessage();
 				}
			}
?>

</form>
</body>
</html>