<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier File Management
Purpose			: To Create Courier Files
Author			: Madushan Wikramaara
Date & Time		: 09.39 A.M 20/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->

<?php
	session_start();
	$_SESSION['page']="cou/e/001";
	$_SESSION['Module'] = "Courier Management System";
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
<title>Courier File Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<script type="text/javascript">
    function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_document_file.php?DispName=Courier%20File%20Management','conectpage');
    }
</script>
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
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
	#outer1{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten1{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		z-index: 5;
		height:100px;
		overflow-y: scroll;
		border:#000000 solid 1px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
</style>
<script type="text/javascript">
	function department(){
		if(document.getElementById('selBranchNumber').value==""){
			document.getElementById('selDepartmentNumber').disabled=false;
		}else{
			document.getElementById('selDepartmentNumber').disabled=true;
		}
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
	function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
	function popupa(y){
	  if(y==1){
		document.getElementById('outer1').style.visibility = "visible";
		document.getElementById('conten1').style.visibility = "visible";
	  }else{
		document.getElementById('outer1').style.visibility = "hidden";
		document.getElementById('conten1').style.visibility = "hidden";
	  }	
	}
	function getValue(obj){
    		//alert('id - ' + obj.id);
    		var txtIDnum = obj.id;
			var r = document.getElementById("myTable").rows.length;
			var r1 = r-1
			//alert(r1);
			document.getElementById('tx').value = txtIDnum;
			document.getElementById('ty').value = 'txtc'+r1;
	}
	
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p>
<hr/>
<table>
    <tr>
    <td style=" width:110px;"><label class="linetop">File Name :</label></td>
    <td>
   		<input style="width:250px;" class="box_decaretion" type="text" name="txtFName" id="txtFName" value=""  onKeyPress="return disableEnterKey(event)" required/>
   </td>
   <td style=" width:110px;"><label class="linetop">Courier Type :</label></td>
    <td>
    	<select class="box_decaretion" name="selFileType" id="selFileType" onKeyPress="return disableEnterKey(event)" required>
            <option value="Normal">Normal</option>
            <option value="Special ">Special</option>
        </select>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style=" width:110px;"><label class="linetop">Receive Branch :</label></td>
    <td>
    	<?php
			$addsql01="SELECT `branchNumber`,`branchName` FROM `branch`  WHERE `branchNumber`!='$_SESSION[userBranch]'";
			$quary101 = mysqli_query($conn,$addsql01);
		?>
        <select class="box_decaretion" name="selBranchNumber" id="selBranchNumber" onKeyPress="return disableEnterKey(event)" onchange="department()" required>
            			<option value="">--Select Branch Name--</option>
            			<?php
			 				while ($rec1 = mysqli_fetch_array($quary101)){
			 					echo "<option value='".$rec1[0]."'>".$rec1[1]."</option>";
			 				}
						?>
            		</select>
    </td>
     <td valign="bottom"><label class="linetop">Receive Department :</label></td>
    <td>
    	 <div id="diva">
    		 &nbsp;&nbsp; <select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onKeyPress="return disableEnterKey(event)"  required>
            	 		  	<option value="">--Select Department Name--</option>
              			  </select>
         </div>
    </td>
    <td><label class="linetop">Receive Officer :</label></td>
    <td>
    	&nbsp;&nbsp;<input class="box_decaretion" type="text" name="txtResiveOfficer" id="txtResiveOfficer" value=""  onKeyPress="return disableEnterKey(event)"/>
    	</td>
  </tr>
</table>
<table>
	<tr>
    <td style=" width:110px; vertical-align:top;"><label class="linetop">Remarks :</label></td>
    <td>
   		<textarea class="box_decaretion" rows="3" cols="40" name="txtareSN" id="txtareSN"></textarea>
   </td>
  </tr>
</table>
<table>
  <tr>
    <td style=" width:110px; vertical-align:top;"><label class="linetop">Previous File &nbsp;&nbsp;&nbsp;&nbsp;Number :</label></td>
    <td>
   		<input style="width:250px;" class="box_decaretion" type="text" name="txtPreFNum" id="txtPreFNum" value=""  onKeyPress="return disableEnterKey(event)" />
   </td>
  </tr>
</table><br/>
	<script>
        var i = 1;
        function displayResult(){
			var ss = document.getElementById('txtb'+i).value;
			var cc = document.getElementById('txtc'+i).value;
			var x = document.getElementById("myTable").rows.length;
				if(ss != "" && cc != ""){
				var table=document.getElementById("myTable");
				var row=table.insertRow(-1);
				var cell1=row.insertCell(0);
				var cell2=row.insertCell(1);
				var cell3=row.insertCell(2);
				 var cell4=row.insertCell(3);
				cell1.innerHTML="<input style='width:100px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)'  required/>";
				cell2.innerHTML="<input style='width:350px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onclick='popup(1);getValue(this);' required/>";
				cell3.innerHTML="<input style='width:350px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly required/>";
				 cell4.innerHTML="<input type='button' value='Delete' onclick='deleteRow(this)'>";
				document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
				document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
				i++;
				}else{
					alert("Insert to data in befor row");
					//i = document.getElementById("myTable").rows.length;
				}
			
        }
		

		function deleteRow(n){
			var m=n.parentNode.parentNode.rowIndex;
			document.getElementById('myTable').deleteRow(m);
			var num1 = document.getElementById("myTable").rows.length;
			var num2 = num1 - 1;
			//alert(m);
			//alert(num2);
			document.getElementById('txtrow').value = num2;
			document.getElementById('txtrow1').value = num2;
			var y = 1;
			
			var  rowcount = document.getElementById("myTable").rows.length;
			i = rowcount-1;
			for(var mloop=2;mloop <=100;mloop++){
				var elementA =  document.getElementById('txta' + (mloop - 1));
				var elementB =  document.getElementById('txtb' + (mloop - 1));
				var elementC =  document.getElementById('txtc' + (mloop - 1));
				if (elementA != null)
				{
				  // Re-order the sequence of the table rows.............
				  elementA.value = y;
				  
				  //Changing the element ID's to capture in the php
				  elementA.id = 'txta' + y;				  
				  elementB.id = 'txtb' + y;
				  elementC.id = 'txtc' + y;
				  
				  //Changing the element name's to capture in the php				  
  			      elementA.name = 'txta' + y;				  
				  elementB.name = 'txtb' + y;
				  elementC.name = 'txtc' + y;
				  y++;
				}			
			}
		}
		
		function newTbldoc(){
			var mydataSub;
			mydataSub= new XMLHttpRequest();
			mydataSub.onreadystatechange=function(){
				if(mydataSub.readyState==4){
					document.getElementById('newdoctb').innerHTML=mydataSub.responseText;
				}
			}
			var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub.open("GET","ajaxDocumentFile_GroupDoc.php"+"?sub2="+sub1,true);
			mydataSub.send();
		}
    </script>
  <hr /> 
 <input class="buttonManage" type="button" onclick="displayResult()" value="Insert new row" id="rowNew" name="rowNew" />
 <input class="buttonManage" type="button" onclick="popupa(1)" value="Insert group doc" id="rowNew1" name="rowNew1" /><br/><br/>
	<div id="outer">
		
	</div>
	<div id="conten">
		<p class="topline">Search Document 
        <input style="margin-left:200px; font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
        </p>
        <div style='display:none;'>
        <input style="width:100px;" type="text" name="tx" id="tx" value=""  onKeyPress="return disableEnterKey(event)" readonly required/>
        <input style="width:100px;" type="text" name="ty" id="ty" value=""  onKeyPress="return disableEnterKey(event)" readonly required/>
        </div>
        Search Document name : <input class="box_decaretion" style="width:200px; background-color:#E0E0E0;" type="text" name="popupsearch" id="popupsearch" value=""/> 
        <input class="buttonManage" type="button" value="Search" id="popupSearchBTN" name="popupSearchBTN" onclick="fileSelect()" />
        <script>
        	function fileSelect(){
				//var no=document.getElementById('txtFilename').value;
				//alert('aa2 - ');
				//document.getElementById('selectFilName').style.visibility = "visible";
				var mydata5;
				mydata5= new XMLHttpRequest();
				mydata5.onreadystatechange=function(){
					if(mydata5.readyState==4){
						document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
					}
				}
				var searchup=document.getElementById('popupsearch').value;
				//var no1=document.getElementById('selFileType').value;
				mydata5.open("GET","ajaxEntryPopu1.php"+"?txtsearch="+searchup,true);
				mydata5.send();
			}
	
        </script>
        <br/>
        <br/>
        <div id="getNewtblPopup">
		<?php
            $viewDoc = "SELECT `documentNumber`,`documentName` FROM `courier_masters_document`";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table class="tbl1" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Document Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Document Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<script>
								function selectDB".$a."(){
									var id1 = document.getElementById('txt1".$a."').value;
									var newID = document.getElementById('tx').value;
									document.getElementById(newID).value = id1;
									var id2 = document.getElementById('txt2".$a."').value;
									var newName = document.getElementById('ty').value;
									document.getElementById(newName).value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."'/></div> 
                              <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' onclick='selectDB".$a."();popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
            </div>
	</div>
    <div id="outer1">
		
	</div>
    <div id="conten1">
    	 <?php
		$selectGDN = "SELECT `groupCodeDoc`,`groupDetels` FROM `courier_groupdoctype`";
		$add_selectGDN = mysqli_query($conn,$selectGDN);
		?>
    <table style="text-align: left;" border="0">
    <tr>
    	<td style="width:200px; vertical-align:middle"><p class="linetop">Select Group Doc Description </p></td>
 		<td> 
          <select name="selectCodeDoc" id="selectCodeDoc" onKeyPress="return disableEnterKey(event)">
                <option value="">--Select Group Doc Description--</option>
                <?php
                    while($recGDD = mysqli_fetch_array($add_selectGDN)){
                        echo "<option value='".$recGDD[0]."'>".$recGDD[1]."</option>";
                    }
                ?>
            </select> 
       </td>
     </tr>
     <tr>
     	<td></td>
	   <td><input type="button" onclick="newTbldoc();popupa(0);" value="Insert group doc" id="groupDOC" name="groupDOC"></td>
     </tr>
     </table>
    </div>
 <div id="newdoctb">
 <table width="921" border="1" id="myTable" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Document Number</td>
    <td width="449" style="width:350px;">Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
  <tr style="width:800px;">
    <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" onclick="popup(1);getValue(this);" required/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtc1" id="txtc1" value=""  onKeyPress="return disableEnterKey(event)" readonly required/></td>
     <td style="width:100px;"><input type="button" value="Delete" onclick="deleteRow(this)" /></td>
  </tr>
</table>
<br/>
<table>
  <tr>
    <td><label class="linetop">Number of Document(s) :</label></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
<br/>
<input class="buttonManage" type="submit" style="width:100px;" id="btnDFSave" name="btnDFSave" value="Save"/>
	<?php
		if(isset($_POST['btnDFSave']) && $_POST['btnDFSave']=='Save'){
			// Set autocommit to off
			mysqli_autocommit($conn,FALSE);
			try{
				//$_SESSION['txtFNumber'] = trim($_POST['txtFNumber']);
				$_SESSION['txtFName'] = trim($_POST['txtFName']);
				$_SESSION['selBranchNumber'] = trim($_POST['selBranchNumber']);
				$_SESSION['selDepartmentNumber'] = trim($_POST['selDepartmentNumber']);
				$_SESSION['txtResiveOfficer'] = trim($_POST['txtResiveOfficer']);
				$_SESSION['selFileType'] = trim($_POST['selFileType']);
				$_SESSION['txtrow'] = trim($_POST['txtrow']);
				$_SESSION['txtPreFNum'] = trim($_POST['txtPreFNum']);
				if($_SESSION['txtFName']!="" && $_SESSION['selBranchNumber']!="" && $_SESSION['selDepartmentNumber']!="" && $_SESSION['selFileType']!=""){
					date_default_timezone_set('Asia/Colombo');
					$statCount1 ="SELECT `count` ,`year` FROM `filesnumbergenaret` where `branch`='$_SESSION[userBranch]' AND `serial`='file' AND`department`='$_SESSION[userDepartment]' AND `year` = year(now())";
					$sql_statCount1=mysqli_query($conn,$statCount1);
					while($add_statCount1=mysqli_fetch_array($sql_statCount1)){
						if($add_statCount1[0]==0){
						 	$fileNumber = $_SESSION['userBranch'].$_SESSION['userDepartment'].$add_statCount1[1]."000001";
							$cou = $add_statCount1[0] + 1;
						}else{
						 	$fileNumber = $_SESSION['userBranch'].$_SESSION['userDepartment'].$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT);
							$cou = $add_statCount1[0] + 1;
						}
					}
					date_default_timezone_set('Asia/Colombo');
					
					$_SESSION['txtFNumber']  = $fileNumber;
					$addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,createBy,createDateTime,preFileNumber, `subdoc`) 
                             VALUES('$_SESSION[txtFNumber]','$_SESSION[txtFName]','".$_SESSION['user']."' ,'$_SESSION[txtResiveOfficer]','$_SESSION[selDepartmentNumber]',  '$_SESSION[selBranchNumber]' ,'JC','$_SESSION[txtrow]','$_SESSION[selFileType]','$_SESSION[userBranch]','$_SESSION[userDepartment]','".trim($_POST['txtareSN'])."','".$_SESSION['user']."',now(),'$_SESSION[txtPreFNum]','NO')";
					$query1 = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					//$txtFNumber = $_POST['txtFNumber'];
					
					for ($y = 1; $y<=($_SESSION['txtrow']); $y++){ 
						$addsq2= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
								  VALUES('".trim($_POST['txtb'.$y])."','".trim($_POST['txtc'.$y])."','$_SESSION[txtFNumber]',now(),'YES','YES')";
						$result2= mysqli_query($conn,$addsq2)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					}
					
					//code removed
					$statUpdate ="SELECT `serial` FROM filesNumberGenaret  where `branch`='$_SESSION[userBranch]' AND `department`='$_SESSION[userDepartment]' AND `year` = year(now())";
					$sql_statUpdate=mysqli_query($conn,$statUpdate);
					while($add_statUpdate=mysqli_fetch_array($sql_statUpdate)){
						$fileCount ="UPDATE `filesnumbergenaret`  SET `count`= '$cou'  WHERE `branch`= '$_SESSION[userBranch]' AND `department`='$_SESSION[userDepartment]' AND `year` = year(now()) AND `serial`='".$add_statUpdate[0]."'";
						$updateFileCount = mysqli_query($conn,$fileCount)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						//FileMovementLogger($conn,$_SESSION['txtFNumber'],'File Created');
                        FileMovementLogger_USER($conn,$_SESSION['txtFNumber'],'File Created',$_SESSION['user']);
					}					
					if($query1){
						echo "<script> alert('Record Saved!'); </script>";
                        $_SESSION['txtFNumber'] = "";
					   $_SESSION['txtFName'] = "";
					   $_SESSION['selBranchNumber'] = "";
					   $_SESSION['selDepartmentNumber'] = "";
			    	   $_SESSION['txtResiveOfficer'] = "";
					   $_SESSION['selFileType'] = "";
					   $_SESSION['txtrow'] = "";
                        echo "<script>pageRef();</script>";
					}else{
						echo "<script> alert('Record not Saved!');</script>";
					}
					$_SESSION['txtFNumber'] = "";
					$_SESSION['txtFName'] = "";
					$_SESSION['selBranchNumber'] = "";
					$_SESSION['selDepartmentNumber'] = "";
					$_SESSION['txtResiveOfficer'] = "";
					$_SESSION['selFileType'] = "";
					$_SESSION['txtrow'] = "";
				}else{
					echo "<script> alert('Please enter complete details!');</script>";
				}
				// Commit transaction
				mysqli_commit($conn);
			}catch(Exception $e){
				// Rollback transaction
				mysqli_rollback($conn);
				echo 'Message: ' .$e->getMessage();
			}
		}
	?>
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>