<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Box Closure
Purpose			: To close the opened box	
Author			: Madushan Wikramaara
Date & Time		: 8:52 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/004";
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
<title>Document Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
<!-- Starts CDB User defined function here -->
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>
<script type="text/javascript">
function selectFiled(getID){
	//alert("aaaa :"+getID);
	if(getID == "radSelectionDoc"){
		document.getElementById('txtDocNumber').disabled = false;
		document.getElementById('selDocType').disabled = false;
		document.getElementById('txtBoxNumber').disabled = true;
		document.getElementById('txtBoxNumber').value = "";
	}else{
		document.getElementById('txtDocNumber').disabled = true;
		document.getElementById('selDocType').disabled = true;
		document.getElementById('txtBoxNumber').disabled = false;
		document.getElementById('selDocType').value = "NULL";
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
			var no2=document.getElementById('selDocType').value;
			//chakValidate();
			if(no1 != "" && no2!="NULL"){
				var mydataLoad;
				mydataLoad= new XMLHttpRequest();
				mydataLoad.onreadystatechange=function(){
					if(mydataLoad.readyState==4){
						document.getElementById('loadGrid').innerHTML=mydataLoad.responseText;
						var V_count=document.getElementById('txtrow').value;
						if(V_count==0){
							alert("This is not sent Documnet !");
						}else{
						
						}
					}
				}
				mydataLoad.open("GET","ajax_DocumentRequset_01.php"+"?txt1="+no1+"&txt2="+no2,true);
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
							alert("This is not a dispatched Box!");
						}else{
						
						}
					}
				}
				mydataLoad.open("GET","ajax_DocumentRequset_02.php"+"?txtBoxNum="+no1,true);
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
				if (elementA != null){
					  // Re-order the sequence of the table rows.............
					  elementA.value = y;
					  
					  //Changing the element ID's to capture in the php
					  elementA.id = 'txta' + y;				  
					  elementB.id = 'txtb' + y;
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
function getPrint(){
    var prtContent = document.getElementById("loadGrid");
	var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
}
function getprintCopy(){
		var prtContent = document.getElementById("loadGrid");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
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
    <td ><select name="selDocType" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selDocType" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
            <option value="NULL">--Documnet Type--</option>
            <option value="BO">Both</option>
            <option value="RD">Reference Only</option>
            <option value="SD">Security Only</option>
         </select>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td><input type="radio" name="radSelection" id="radSelectionBox" value="Box" onKeyPress="return disableEnterKey(event)" onclick="selectFiled(this.id)" /><label class="linetop" for="radSelectionBox">Box</label></td>
    <td style="width:150px; text-align:right;"><p class="linetop">Box Number :</p></td>
    <td><input type="text" style="width:100px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtBoxNumber" name="txtBoxNumber" maxlength="9" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled"/></td>
    <td style="width:100px;"><input type="button" id="btnRequestSelection" name="btnRequestSelection" value="Select" onclick="checkSelection()"/></td>
    <td>
    	
    </td>
  </tr>
</table>
<hr/>
<table>
  <tr>
    <td><p class="linetop">Purpose Of Request : </p></td>
    <td><select name="selpaerpas" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selpaerpas" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required>
     		<option value="">--Documnet Type--</option>
	 <?php
	 	$sql_pearps = "SELECT perpas_code,parpas_value FROM doc_line_perpase_requst WHERE perpas_code != 'PP003';";
		$quary_pearps = mysqli_query($conn,$sql_pearps);
		while ($rec_pearps = mysqli_fetch_array($quary_pearps)){
	 		echo "<option value='".$rec_pearps[0]."'>".$rec_pearps[1]."</option>";
	 	}
	 ?>
     </select> </td>
  </tr>
</table>

<div id="loadGrid" class="sckolar">
<table border="1" id="myTable"  style="width:750px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Box Number</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Document Number</td>
        <td style="width:100px; text-align:left; padding-left:5px;">Documnet Type</td>
        <td style="width:100px;">Confirm</td>
         <td style="width:100px;">&nbsp;</td>
     </tr>
</table>
<br/>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="0"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="0" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>


 <!-- End of Screen design will be started from here -->
<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocSave" value="Confirm"/>
<!--<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>-->
<!--<input type="button" style="font-size:12px;" value="Print" name="btnRefresh" id="btnRefresh" onclick="getPrint()"/>-->
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php
	 if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Confirm'){
		mysqli_autocommit($conn,FALSE);
			try{
				if(trim($_POST['txtrow'])!=0){
					$DocCouNum = "";
					 
					 for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
						if(isset($_POST['txte'.$i])){
							date_default_timezone_set('Asia/Colombo');
							
							// Update the box master
							$sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='RQ' WHERE `box_number`='".trim($_POST['txtb'.$i])."' AND `doc_number`='".trim($_POST['txtc'.$i])."' AND `doc_type`='".trim($_POST['txtd'.$i])."' AND `action_stat`='ST'";
							$query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
							//Insert new record(s) to document movement tables
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`, `perpas_code`,`branch_Numbar`) VALUES ('".trim($_POST['txtb'.$i])."','".trim($_POST['txtc'.$i])."','".trim($_POST['txtd'.$i])."',now(),'RQ','".$_SESSION['user']."','".trim($_POST['selpaerpas'])."','".$_SESSION['userBranch']."')";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
						}else{
						
						}
					 }
					mysqli_commit($conn);
					$getmail = GetParamValue(1,$conn);
					if($getmail != ""){
                        $sql_branch = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$_SESSION['userBranch']."';";
                        $que_branch = mysqli_query($conn,$sql_branch);
                        while($rec_branch = mysqli_fetch_array($que_branch)){
                            $userBranch_n = $rec_branch[0];
                        }
						$title = "Dcoument Request from :".$userBranch_n." By : ".$_SESSION['user'];
						$mail  = "";
						for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
							if(isset($_POST['txte'.$i])){
								$mail  = $mail."Box Num : ".chr(9).trim($_POST['txtb'.$i]).chr(9)."Doc Num : ".chr(9).trim($_POST['txtc'.$i]).chr(9)."Doc Type : ".chr(9).trim($_POST['txtd'.$i]).chr(13);
							}else{
							
							}
						}
						sendMail($getmail,$title,$mail);
					}else{
						echo "<script> alert('Null'); </script>";
					}
					echo "<script> alert('Request completed successfully !.');
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
</form>
</body>
</html>
