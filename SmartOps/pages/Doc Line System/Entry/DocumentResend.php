<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Document Re-Sent
Purpose			: Docunet Re-sent in Box
Author			: Madushan Wikramaarachchi
Date & Time		: 8:52 AM 30/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/006";
	$_SESSION['Module'] = "Doc Line System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
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
<title>Document Re-send</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
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
<!--END Common fumction Libariries-->
<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
<!-- Starts CDB User defined function here -->
<script type="text/javascript">
function selectFiled(getID){
	//alert("aaaa :"+getID);
	if(getID == "radSelectionDoc"){
		document.getElementById('txtDocNumber').disabled = false;
		document.getElementById('txtBoxNumber').disabled = true;
		document.getElementById('txtBoxNumber').value = "";
	}else{
		document.getElementById('txtDocNumber').disabled = true;
		document.getElementById('txtBoxNumber').disabled = false;
		document.getElementById('txtDocNumber').value = "";
	}
}
function chakValidate(){
	var num = /^([0-9])+$/;
	if(!document.getElementById('txtDocNumber').value.match(num) || document.getElementById('txtDocNumber').value == ""){
		alert("Plase only enter only number");
		document.getElementById('txtDocNumber').value ="";
		return false;
	}
	if(!document.getElementById('txtBoxNumber').value.match(num) || document.getElementById('txtBoxNumber').value == ""){
		alert("Plase only enter only number");
		document.getElementById('txtBoxNumber').value ="";
		return false;
	}
	return true;
}
//Check Selection Function in Document number(s) or Box number(s)

function checkSelection(){
	if(document.getElementById("radSelectionDoc").checked==true){//select Document Area/////////////////////////////////////////////////////////////////////
			var no1=document.getElementById('txtDocNumber').value;
			var V_count=document.getElementById('txtrow').value;
			//chakValidate();
			if(no1 != ""){
				/****************************************************/
				var isDuplicate = false;
				for(var r=1; r<V_count; r++){
					if(no1 == document.getElementById('txtc'+r).value){
						isDuplicate = true;
						break;
					}
				}
					
				if(isDuplicate){
					alert("Account number cannot be duplicate!");
					return null;
				}
				/*********************************************************/
				
				var mydataLoad;
				mydataLoad= new XMLHttpRequest();
				mydataLoad.onreadystatechange=function(){
					if(mydataLoad.readyState==4){
						document.getElementById('tr'+V_count).innerHTML=mydataLoad.responseText;
						var V_New=document.getElementById('txtb'+V_count).value;
						if(V_New==""){
							alert("This is not received Documnet !");
						}else{
							//Start Creat New Row//////////////////////////////////////////////////////////////////////////////////////////////////////////////
							var new_row = document.createElement('tr');
							var x  = document.getElementById('txtrow').value;
							x++;
							//alert(x);
							var elementid = "tr"+x;
							new_row.setAttribute('id',elementid);
							new_row.insertCell(0).innerHTML = "<input style='width:50px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"' onKeyPress='return disableEnterKey(event)' readonly  required/>";
							new_row.insertCell(1).innerHTML = "<input style='width:200px; color:#999999;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required readonly='readonly'/>";
							new_row.insertCell(2).innerHTML = "<input style='width:200px; color:#999999;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' required readonly='readonly'/>";
							new_row.insertCell(3).innerHTML = "<input type='checkbox' name='txtd"+(x)+"' id='txtd"+(x)+"' value='' onKeyPress='return disableEnterKey(event)'  disabled='disabled'/>";
							new_row.insertCell(4).innerHTML = "<input type='checkbox' name='txte"+(x)+"' id='txte"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'  disabled='disabled'/>";
                            new_row.insertCell(5).innerHTML = "<input style='width:150px; color:#999999;' type='text' name='txtf"+(x)+"' id='txtf"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' required readonly='readonly'/>";
							new_row.insertCell(6).innerHTML = "<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
							
							function insertAfter(target, el) {
								if( !target.nextSibling )
									target.parentNode.appendChild( el );
								else
									target.parentNode.insertBefore( el, target.nextSibling );
							};
							insertAfter(document.getElementById('tr'+V_count), new_row);
							document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
							document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
							//End Creat New Row///////////////////////////////////////////////////////////////////////////////////////////////////////////////
						}
					}
				}
				mydataLoad.open("GET","ajax_DocumentResend_01.php"+"?txt1="+no1+"&txt2="+V_count,true);
				mydataLoad.send();
			}else{
				alert("Plase enter Documnet Number & select Documnet Type");
			}
		
	}else if(document.getElementById("radSelectionBox").checked==true){ // Select Box Area//////////////////////////////////////////////////////////////////
		//alert("Box");
			var no1=document.getElementById('txtBoxNumber').value;
			//chakValidate();
			if(no1 != ""){
				var mydataLoad;
				mydataLoad= new XMLHttpRequest();
				mydataLoad.onreadystatechange=function(){
					if(mydataLoad.readyState==4){
						document.getElementById('loadGrid').innerHTML=mydataLoad.responseText;
						var V_count=document.getElementById('txtrow').value;
						if(V_count==0){
							alert("This is not a received Box!");
						}else{
							
						}
					}
				}
				mydataLoad.open("GET","ajax_DocumentResend_02.php"+"?txtBoxNum="+no1,true);
				mydataLoad.send();
			}else{
				alert("Plase enter Box Number");
			}
	}else{ //Select Null Area //////////////////////////////////////////////////////////////////////////////
		alert("Select Document Or Box !");
	}
}

function deleteRow(n){ // this fuction is Delete Row(s) in table
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
				var elementC =  document.getElementById('txtc' + (mloop - 1));
				var elementD =  document.getElementById('txtd' + (mloop - 1));
				var elementE =  document.getElementById('txte' + (mloop - 1));
                var elementF =  document.getElementById('txtf' + (mloop - 1));
				if (elementA != null){
					  // Re-order the sequence of the table rows.............
					  elementA.value = y;
					  
					  //Changing the element ID's to capture in the php
					  elementA.id = 'txta' + y;				  
					  elementB.id = 'txtb' + y;
					  elementC.id = 'txtc' + y;
					  elementD.id = 'txtd' + y;
					  elementE.id = 'txte' + y;
                      elementF.id = 'txtf' + y;
					  
					  //Changing the element name's to capture in the php				  
					  elementA.name = 'txta' + y;				  
					  elementB.name = 'txtb' + y;
					  elementC.name = 'txtc' + y;
					  elementD.name = 'txtd' + y;
					  elementE.name = 'txte' + y;
                      elementF.name = 'txtf' + y;
					  y++;
				}			
			}
}

function clickBranch(title , x){
   // alert(x);
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
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x+"&sr_tit="+title,true);
			mydataGried.send();
			
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }
}

function selectDB(xx,ss){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
		//	alert(id1);
		//	alert(id2);
			document.getElementById('txtf'+ss).value = id1;
			//document.getElementById('txt_inner_User2').value = id2;
}
</script>
<style type="text/css">
.sckolar{
	height:200px;
	overflow-y: scroll;
	width:800px;
}
</style>
</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
  <tr>
    <td><input type="radio" name="radSelection" id="radSelectionDoc" value="Doc" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onclick="selectFiled(this.id)"/><label class="linetop" for="radSelectionDoc">Document</label></td>
    <td style="width:150px; text-align:right;"><p class="linetop">Document Number :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtDocNumber" name="txtDocNumber" maxlength="22" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled"/></td>
  </tr>
</table>
<table>
  <tr>
    <td><input type="radio" name="radSelection" id="radSelectionBox" value="Box" onKeyPress="return disableEnterKey(event)" onclick="selectFiled(this.id)" /><label class="linetop" for="radSelectionBox">Box</label></td>
    <td style="width:150px; text-align:right;"><p class="linetop">Box Number :</p></td>
    <td><input type="text" style="width:100px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtBoxNumber" name="txtBoxNumber" maxlength="9" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled"/></td>
  </tr>
  <tr>
    <td><input type="button" id="btnRequestSelection" name="btnRequestSelection" value="Select" onclick="checkSelection()"/></td>
    <td><!--<input type="button" id="btnRequestNewCreate" name="btnRequestNewCreate" value="Doc Select" onclick="DocSelection()"/>--></td>
  </tr>
</table>
<hr/>
<div id="loadGrid" class="sckolar" style="width: 920px;" >
<table border="1" id="myTable"  style="width:900px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Box Number</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Document Number</td>
        <td style="width:100px; text-align:left; padding-left:5px;">Reference Documnet</td>
        <td style="width:100px; text-align:left; padding-left:5px;">Security Documnet</td>
        <td style="width:150px;">Courier Branch</td>
        <td style="width:100px;">&nbsp;</td>
     </tr>
     <tr class="tbl1" id="tr1" style="background:#FFFFFF;">
		<td style="width:50px;"><input style="width:50px;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="txtc1" id="txtc1" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="txtd1" id="txtd1" value=""  onKeyPress="return disableEnterKey(event)" disabled="disabled"/></td>
        <td style="width:100px;"><input type="checkbox" name="txte1" id="txte1" value=""  onKeyPress="return disableEnterKey(event)" disabled="disabled"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="txtf1" id="txtf1" value=""  onKeyPress="return disableEnterKey(event)" readonly="readonly" /></td>
        <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
	</tr>
</table>
<br/>
<div id="nodTable">
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
            <input type="text" name="txtrowCount" id="txtrowCount" value="1"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
</div>
 <!-- End of Screen design will be started from here -->
<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocSave" value="Confirm"/>
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php
	 if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Confirm'){
		mysqli_autocommit($conn,FALSE);
			try{
				if(trim($_POST['txtrow'])!=0){
					$sqlFunction ="SELECT GetNextSerial('m3','RES') FROM DUAL";
					$quary_Function = mysqli_query($conn,$sqlFunction);
					while ($rec_Function = mysqli_fetch_array($quary_Function)){
						$batch_num = $rec_Function[0]; 
					}
					$k = 0;
					$j = 0;
					 for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
						if(isset($_POST['txtd'.$i])){
							date_default_timezone_set('Asia/Colombo');
							
							
							// Update the box master
							$sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='ST' WHERE `box_number`='".trim($_POST['txtb'.$i])."' AND `doc_number`='".trim($_POST['txtc'.$i])."' AND `doc_type`='RD' AND `action_stat`='RC'";
							$query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
							//Insert new record(s) to document movement tables
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`,`prog_code`, `batch_number`) VALUES ('".trim($_POST['txtb'.$i])."','".trim($_POST['txtc'.$i])."','RD',now(),'ST','".$_SESSION['user']."','RES','$batch_num')";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							$k++;
						}else{
						
						}
					 }
					 for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
						if(isset($_POST['txte'.$i])){
							date_default_timezone_set('Asia/Colombo');
							
							// Update the box master
                            if(trim($_POST['txtf'.$i]) == ""){
						          $sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='ST', `seq_in_out` = 0 , `seq_branch` = '' WHERE `box_number`='".trim($_POST['txtb'.$i])."' AND `doc_number`='".trim($_POST['txtc'.$i])."' AND `doc_type`='SD' AND `action_stat`='RC'";
							     $query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							}else{
							     $sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='ST' , `seq_in_out` = 1 , `seq_branch` = '".trim($_POST['txtf'.$i])."'  WHERE `box_number`='".trim($_POST['txtb'.$i])."' AND `doc_number`='".trim($_POST['txtc'.$i])."' AND `doc_type`='SD' AND `action_stat`='RC'";
							     $query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							}
							//Insert new record(s) to document movement tables
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`,`prog_code`, `batch_number`) VALUES ('".trim($_POST['txtb'.$i])."','".trim($_POST['txtc'.$i])."','SD',now(),'ST','".$_SESSION['user']."','RES','$batch_num')";				
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							$j++;
						}else{
						
						}
					 }
					 
					$numOfFile = $k + $j;
					
					$sql_Batch = "INSERT INTO `batchlog`(`batch`, `numberoffiles`, `userBy`, `userDateTime`, `catchStat`,`serial_number`) VALUES ('RES','$numOfFile','".$_SESSION['user']."',now(),'0','$batch_num')";
					 $query_Batch  =  mysqli_query($conn,$sql_Batch ) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					 
					mysqli_commit($conn);
					echo "<script> alert('Resend completed successfully !.');
									pageClose();
						</script>";
				}else{
					echo "<script> alert('Required information missing!'); </script>";
				}
					
			}catch(Exception $e){
					mysqli_rollback($conn);
				    echo 'Message: '.$e->getMessage();
 			}
	
	}
	
?>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>