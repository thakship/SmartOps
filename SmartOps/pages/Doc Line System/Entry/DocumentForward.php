<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Document Request - Forward
Purpose			: Reqwest documents are forward	
Author			: Madushan Wikramaara
Date & Time		: 2.29 PM 09/06/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/004/a";
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
<title>Document Request - Forward</title>
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
				var elementF =  document.getElementById('txtf' + (mloop - 1));
				var elementG =  document.getElementById('txtg' + (mloop - 1));
				var elementH =  document.getElementById('txth' + (mloop - 1));
				var elementI =  document.getElementById('txti' + (mloop - 1));
				var elementE =  document.getElementById('txte' + (mloop - 1));
				if (elementA != null){
					  // Re-order the sequence of the table rows.............
					  elementA.value = y;
					  
					  //Changing the element ID's to capture in the php
					  elementA.id = 'txta' + y;				  
					  elementB.id = 'txtb' + y;
					  elementC.id = 'txtc' + y;
					  elementD.id = 'txtd' + y;
					  elementF.id = 'txtf' + y;
					  elementG.id = 'txtg' + y;
					  elementH.id = 'txth' + y;
					  elementI.id = 'txti' + y;
					  elementE.id = 'txte' + y;
					  
					  //Changing the element name's to capture in the php				  
					  elementA.name = 'txta' + y;				  
					  elementB.name = 'txtb' + y;
					  elementC.name = 'txtc' + y;
					  elementD.name = 'txtd' + y;
					  elementF.name = 'txtf' + y;
					  elementG.name = 'txtg' + y;
					  elementH.name = 'txth' + y;
					  elementI.name = 'txti' + y;
					  elementE.name = 'txte' + y;
					  y++;
				}			
			}
}

function prossessUndo(title){
    var boxNumber = document.getElementById('txtc'+title).value;
    var docNumber = document.getElementById('txtd'+title).value;
    var docType = document.getElementById('txtf'+title).value;
    var myUserID = document.getElementById('txtMyUserID').value; 
    var actionUser = document.getElementById('txti'+title).value;
    
    var r = confirm('Are you sure you want to Reject this?')
        if (r==true){
          //alert(boxNumber+"--"+docNumber+"--"+docType+'--'+myUserID);
	      $.ajax({ 
				type:'POST', 
				data: {get_boxNumber : boxNumber , get_docNumber : docNumber , get_docType : docType , get_myUserID : myUserID , gat_actionUser : actionUser}, 
				url: '../DLS_DEVELOPMENT/PHP_FUNCTION/doc_php_ajax.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    if(val_retn == 1){
                        alert('Request has been rejected!.');
                         pageClose();
                    }else{
                        alert('Code Error!.');
                    }
                   
                    //document.getElementById('aaaa').innerHTML=val_retn;
                    //pageCloseSecurityPrintinAuthorization();
				}
			});
        }else{
			//alert('BBBBB');		
		}
    
}

</script>
<style type="text/css">
.sckolar{
	height:500px;
	overflow-y: scroll;
	width:1190px;
}
</style>
</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p>
<!-- Screen design will be started from here -->
<form action="" method="post">
<hr/>
<div id="loadGrid" class="sckolar">
<?php
$sql_box_get ="SELECT DISTINCT`box_number` FROM `doc_line_file_stack` WHERE `action_stat`='RQ'";
$quary_box_get = mysqli_query($conn,$sql_box_get);
?>
<select name="selBoxMast" style=" font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selBoxMast" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
	<option style="color:#CCCCCC;" value="NULL">--Select Box Master--</option>
    <?php
		while ($rec_Box_get = mysqli_fetch_array($quary_box_get)){ ?>
			<option style="color: #000000;" value="<?php echo $rec_Box_get[0];?>"><?php echo $rec_Box_get[0];?></option>	
	<?php 
		}
	?>
 </select>
 <br/><br/>
 <div id ="tblgried">
<table border="1" id="myTable"  style="width:1170px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:40px; text-align:left; padding-left:5px">Index</td>
        <td style="width:180px; text-align:left; padding-left:5px"> Branch Name</td>
        <td style="width:100px; text-align:left; padding-left:5px"> Box Number</td>
        <td style="width:150px; text-align:left; padding-left:5px"> Document Number</td>
        <td style="width:50px; text-align:left; padding-left:5px"> Doc Type</td>        
        <td style="width:150px; text-align:left; padding-left:5px"> Requested Date</td>
        <td style="width:150px; text-align:left; padding-left:5px"> Purpose</td>
        <td style="width:150px; text-align:left; padding-left:5px"> Action User</td>
        <td style="width:100px;">Confirm</td>
         <td style="width:200px;">&nbsp;</td>
     </tr>
<?php
	$sql_Doc_get = "SELECT BR.`branchName`, dh.`box_number`, dh.`doc_number`, dh.`doc_type`, dh.`action_date_time`, PR.`parpas_value`,dh.`action_user`
FROM `doc_line_stat_history` dh,`doc_line_file_stack` ds,`branch` BR, `doc_line_perpase_requst` PR
WHERE dh.`box_number` = ds.`box_number`
  AND dh.`doc_number` = ds.`doc_number`
  AND dh.`doc_type` = ds.`doc_type`
  AND dh.`action_stat` = ds.`action_stat`
  AND dh.`action_stat` = 'RQ'
  AND dh.`branch_Numbar` = BR.`branchNumber` AND ds.APPR_BY != '' AND ds.APPR_BY != 'N'
  AND dh.`perpas_code` = PR.`perpas_code`
  AND dh.`action_date_time` =   (SELECT max(dhs.`action_date_time`) FROM `doc_line_stat_history` dhs,`doc_line_file_stack` dsh,`branch` BRh, `doc_line_perpase_requst` PRs
WHERE dhs.`box_number` = dsh.`box_number`
  AND dhs.`doc_number` = dsh.`doc_number`
  AND dhs.`doc_number` = dh.`doc_number`
  AND dhs.`doc_type` = dsh.`doc_type`
  AND dhs.`action_stat` = dsh.`action_stat`
  AND dhs.`action_stat` = 'RQ'
  AND dhs.`branch_Numbar` = BRh.`branchNumber` 
  AND dsh.APPR_BY != '' AND ds.APPR_BY != 'N'
  AND dhs.`perpas_code` = PRs.`perpas_code`);";
	$quary_Doc_get = mysqli_query($conn,$sql_Doc_get);
	$index = 0;
	while ($rec_Doc_get = mysqli_fetch_array($quary_Doc_get)){
		$index++;
?>
		<tr class="tbl1">
		<td style="width:40px;"><input style="width:40px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:180px;"><input style="width:180px; color:#999999;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_Doc_get[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input style="width:100px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_Doc_get[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value="<?php echo $rec_Doc_get[2]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>        
        <td style="width:50px;"><input style="width:50px; color:#999999;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value="<?php echo $rec_Doc_get[3]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txtg".$index; ?>" id="<?php echo "txtg".$index; ?>" value="<?php echo $rec_Doc_get[4]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txth".$index; ?>" id="<?php echo "txth".$index; ?>" value="<?php echo $rec_Doc_get[5]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txti".$index; ?>" id="<?php echo "txti".$index; ?>" value="<?php echo $rec_Doc_get[6]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" checked=" checked"/></td>
        <td style="width:200px;">
            <img src="../../../img/dele.png" title="Row Delete" style=" width:15px;" onclick="deleteRow(this)"/>
            <img src="../../../img/undo.png" title="<?php echo $index; ?>" style=" width:15px;" onclick="prossessUndo(title)"/>
        </td>
        </tr>
<?php
	}
?>
</table>
</div>
<br/>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="<?php echo $index; ?>"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="<?php echo $index; ?>" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>

 <!-- End of Screen design will be started from here -->
<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocSave" value="Confirm"/>
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php

	 if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Confirm'){
		mysqli_autocommit($conn,FALSE);
			try{
				if(trim($_POST['selBoxMast']) == "NULL"){
				if(trim($_POST['txtrow'])!=0){
					$DocCouNum = "";
					 
					 for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
						if(isset($_POST['txte'.$i])){
							date_default_timezone_set('Asia/Colombo');
							
							// Update the box master
							$sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='RF' WHERE `box_number`='".trim($_POST['txtc'.$i])."' AND `doc_number`='".trim($_POST['txtd'.$i])."' AND `doc_type`='".trim($_POST['txtf'.$i])."' AND `action_stat`='RQ'";
							$query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
							//Insert new record(s) to document movement tables
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`) VALUES ('".trim($_POST['txtc'.$i])."','".trim($_POST['txtd'.$i])."','".trim($_POST['txtf'.$i])."',now(),'RF','".$_SESSION['user']."')";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
						}else{
						
						}
					 }
					mysqli_commit($conn);
					$getmail = GetParamValue(2,$conn);
					if($getmail != ""){
					
						$title = "CITIZENS DEVELOPMENT BUSINESS FINANCE PLC - Document Request";
						$mess1 = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p style='color:#FF0000; font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif;'>VERY URGENT</p>
<p style='color:#000000; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;text-decoration:underline;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;text-decoration:underline;'>Document scanning & archiving unit</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>
The Storage Cartons has been accepted by IML from CDB on a \"SAID TO CONTAIN BASIS\".IML shall be under no obligation whatsoever to verify and or check the contents of the said Storage Cartons upon receipt of same for providing the Services.  Consequently, IML shall not be responsible for the unavailability of any Files or document from any Storage Carton or for any discrepancy between the actual contents of any Storage Carton when providing a file retrieval requested made by an authorized person of CDB.</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Kindly retrieve the following files from the cartons stated below</p>

<table border='1'>
	<tr style='background:#FFA6FF;'>
        <td style='width:40px;text-align:left;padding-left:5px'>Index</td>
        <td style='width:180px; text-align:left; padding-left:5px'> Branch Name</td>
        <td style='width:100px; text-align:left; padding-left:5px'> Box Number</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Document Number</td>
        <td style='width:50px; text-align:left; padding-left:5px'> Doc Type</td>        
        <td style='width:150px; text-align:left; padding-left:5px'> Requested Date</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Purpose</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Action User</td>
    </tr>";
	$mess2 = "";
	for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
							if(isset($_POST['txte'.$i])){
								//$mail  = $mail."Branch Name : ".chr(9).trim($_POST['txtb'.$i]).chr(9)."Box Number : ".chr(9).trim($_POST['txtc'.$i]).chr(9)."Document Number : ".chr(9).trim($_POST['txtd'.$i]).chr(9)."Doc Type : ".chr(9).trim($_POST['txtf'.$i]).chr(9)."Requested Date : ".chr(9).trim($_POST['txtg'.$i]).chr(9)."Purpose : ".chr(9).trim($_POST['txth'.$i]).chr(9)."Action User : ".chr(9).trim($_POST['txti'.$i]).chr(13)."---------------";
						
	$mess2 = $mess2."<tr>
		<td style='width:40px;text-align:left;padding-left:5px'>".$i."</td>
        <td style='width:180px; text-align:left; padding-left:5px'>".trim($_POST['txtb'.$i])."</td>
        <td style='width:100px; text-align:left; padding-left:5px'>".trim($_POST['txtc'.$i])."</td>
        <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txtd'.$i])."</td>
        <td style='width:50px; text-align:left; padding-left:5px'>".trim($_POST['txtf'.$i])."</td>        
        <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txtg'.$i])."</td>
        <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txth'.$i])."</td>
        <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txti'.$i])."</td>
	</tr>
";
}else{
							
	}
}
$mess3 ="</table>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Thanks & Best regards</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Sajeeva Godamunna<br/>
Senior Executive<br/>
Tel: +94(0)11 2429934<br/>
Mobile : +94(0)77 1328112<br/>
Fax : +94 (0)11 2429800<br/>
E mail : sajeeva@cdb.lk<br/>
Web : www.cdb.lk<br/>
CITIZENS DEVELOPMENT BUSINESS FINANCE PLC.<br/>
No. 123 Orabipasha Mawatha, Colombo 10</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>This message contains confidential information and is intended only for the recipient(s) named above. If you are not the intended recipient, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately and delete the e-mail from your system. Any views or opinions represented are solely those of the author and do not represent those of Citizens Development Business Finance PLC.</p>
</body></html>";
$message = $mess1.$mess2.$mess3;
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
						$headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
						$headers .= 'Cc: upul@cdb.lk' . "\r\n";
						sendMailNuw($getmail,$title,$message,$headers);
						//mail($emailaddress, $emailsubject, $msg, $headers); 
					}else{
						echo "<script> alert('Null'); </script>";
					}
					echo "<script> alert('Request completed successfully !.');
								   pageClose();
						</script>";
							
				}else{
					echo "<script> alert('Required information missing!'); </script>";
				}
				
				}else{
					date_default_timezone_set('Asia/Colombo');
					$sql_InsertStackHistory1 ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`) SELECT `box_number`,`doc_number`,`doc_type`,now(),'RF','".$_SESSION['user']."' FROM `doc_line_file_stack` WHERE `box_number`='".trim($_POST['selBoxMast'])."'  AND  (`action_stat`='RQ' OR `action_stat`='ST')";
					$rsInsertStackHistory1 =  mysqli_query($conn,$sql_InsertStackHistory1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					// Update the box master
					$sql_FileStacUpdate1 = "UPDATE `doc_line_file_stack` SET `action_stat`='RF' WHERE `box_number`='".trim($_POST['selBoxMast'])."' AND (`action_stat`='RQ' OR `action_stat`='ST')";
					$query_FileStacUpdate1= mysqli_query($conn,$sql_FileStacUpdate1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					mysqli_commit($conn);
					$getmail = GetParamValue(2,$conn);
					if($getmail != ""){
					
						$title = "CITIZENS DEVELOPMENT BUSINESS FINANCE PLC - Document Request";
						$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p style='color:#FF0000; font-size:16px; font-family:Verdana, Arial, Helvetica, sans-serif;'>VERY URGENT</p>
<p style='color:#000000; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;text-decoration:underline;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;text-decoration:underline;'>Document scanning & archiving unit</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>
The Storage Cartons has been accepted by IML from CDB on a \"SAID TO CONTAIN BASIS\".IML shall be under no obligation whatsoever to verify and or check the contents of the said Storage Cartons upon receipt of same for providing the Services.  Consequently, IML shall not be responsible for the unavailability of any Files or document from any Storage Carton or for any discrepancy between the actual contents of any Storage Carton when providing a file retrieval requested made by an authorized person of CDB.</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Kindly retrieve the following files from the cartons stated below</p>

<table border='1'>
	<tr style='background:#FFA6FF;'>
        <td style='width:40px;text-align:left;padding-left:5px'>Index</td>
        <td style='width:180px; text-align:left; padding-left:5px'> Branch Name</td>
        <td style='width:100px; text-align:left; padding-left:5px'> Box Number</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Document Number</td>
        <td style='width:50px; text-align:left; padding-left:5px'> Doc Type</td>        
        <td style='width:150px; text-align:left; padding-left:5px'> Requested Date</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Purpose</td>
        <td style='width:150px; text-align:left; padding-left:5px'> Action User</td>
    </tr>
	<tr>
		<td style='width:40px;text-align:left;padding-left:5px'>1</td>
        <td style='width:180px; text-align:left; padding-left:5px'>CDB HEAD OFFICE</td>
        <td style='width:100px; text-align:left; padding-left:5px'>".trim($_POST['selBoxMast'])."</td>
        <td style='width:150px; text-align:left; padding-left:5px'>Full Box</td>
        <td style='width:50px; text-align:left; padding-left:5px'>-</td>        
        <td style='width:150px; text-align:left; padding-left:5px'>".date("m/d/Y h:i:s a", time() + (30*60))."</td>
        <td style='width:150px; text-align:left; padding-left:5px'>Other</td>
        <td style='width:150px; text-align:left; padding-left:5px'>".$_SESSION['user']."</td>
	</tr>
</table>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Thanks & Best regards</p>
<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Upul Fernando<br/>
Junior Executive<br/>
Tel: +94(0)11 2429934<br/>
Mobile : +94(0)77 3451507<br/>
Fax : +94 (0)11 2429800<br/>
E mail : upul@cdb.lk<br/>
Web : www.cdb.lk<br/>
CITIZENS DEVELOPMENT BUSINESS FINANCE PLC.<br/>
No. 18 Sri Sangaraja Mawatha, Colombo 10</p>

<p style='color:#000000; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;'>This message contains confidential information and is intended only for the recipient(s) named above. If you are not the intended recipient, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately and delete the e-mail from your system. Any views or opinions represented are solely those of the author and do not represent those of Citizens Development Business Finance PLC.</p>
</body></html>";
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
						$headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
						$headers .= 'Cc: wimukthi.madushan@cdb.lk' . "\r\n";
						sendMailNuw($getmail,$title,$message,$headers);
						
						
					}else{
						echo "<script> alert('Null'); </script>";
					}
					echo "<script> alert('Request completed successfully !.');
								   pageClose();
						</script>";	
						
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
