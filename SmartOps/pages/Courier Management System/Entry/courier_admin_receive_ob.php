<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Admin Receive - Other Branch
Purpose			: To Admin Receive - Other Branch
Author			: Madushan Wikramaarachchi
Date & Time		: 04.47 P.M 21/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/008";
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
<title>Admin Receive - Other Branch</title>
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
    window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_admin_receive_ob.php?DispName=Admin%20Receive%20-%20Other%20Branch','conectpage');
}

function cdocument1(obj,title){
		var [m,n,o]= title.split('|');
		var m1 = [m];
		var n1 = [n];
		var o1 = [o];						
		//alert('m is : ' + m1);
		//alert('n is : ' + n1);
		if(obj == 'btnselect'){ 
			//alert('Do my code');
			//alert('sad');
			var mydata;
			mydata= new XMLHttpRequest();
			mydata.onreadystatechange=function(){
				if(mydata.readyState==4){
					//alert('aa2 - Before');
					document.getElementById('tbl').innerHTML=mydata.responseText;
					//alert('aa2 - After');
				}
			}
			//alert('aa2 - End');
			var no1=document.getElementById(m1).value;
			var no2=document.getElementById(n1).value;
			var no3=document.getElementById(o1).value;
			//alert(no3);
			mydata.open('GET','ajaxadminbranchReceiveob.php'+'?txt1='+no1+ '&txt2='+no3+ '&txt3='+no2,true);
			//alert('aa2 - End - 3');
			mydata.send();
			//alert('Send');	
		}else{
			alert('else my code');
		}								
}

function view(obj,title){
						//alert('show :' + obj);
		var [m,n]= title.split('|');
		var m1 = [m];
		var n1 = [n];
		//alert('m is :' + m1);
		//alert('n is :' + n1);
		if(obj == 'btnView'){ 
			//alert('Do my code');
			var mydata1;
			mydata1= new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('subtbl').innerHTML=mydata1.responseText;
				}
			}
			var branch= n1;
			//alert('e'+branch);
			var rDepartment=document.getElementById(m1).value;
			//alert('e'+rDepartment);
			var typeFile=document.getElementById('txtc').value;
			mydata1.open('GET','ajaxadminbranchReceiveSubob.php'+'?a1='+branch+ '&a2='+rDepartment+ '&a3='+typeFile,true);
			mydata1.send();
		}else{
			alert('else my code');
		}
}
function show(obj){
	//alert('show :' + obj);
	if(obj == 'btnView'){ 
		//alert('Do my code');
		document.getElementById('btnSave').disabled=false;
		//document.getElementById('btndocSave').style.display = 'block';
	}else{
		alert('else my code');
	}
}
function showsub(objsub){
	//alert('show :' + obj);
	
	if(objsub == 'cheRoot'){ 
		var sl = document.getElementById(objsub).checked;
		if(sl == true){
			document.getElementById('selBranchNumber').disabled=false;
			document.getElementById('selDepartmentNumber').disabled=false;
			document.getElementById('txtResiveOfficer').disabled=false;
			document.getElementById('txtareSN').disabled=false;
		}else{
			document.getElementById('selBranchNumber').disabled=true;
			document.getElementById('selDepartmentNumber').disabled=true;
			document.getElementById('txtResiveOfficer').disabled=true;
			document.getElementById('txtareSN').disabled=true;
		}
	}else{
		alert('else my code');
	}
}



function department(){
	if(document.getElementById('selBranchNumber').value==''){
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
	mydata.open('GET','ajaxdemartmentselect.php'+'?txt1='+no,true);
	mydata.send();
	/*alert('aa');*/
}
</script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:600px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	.tbl2{
	 	text-align:center;
		width:700px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	.tbl3{
	 	text-align:center;
		width:1000px;
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
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div id="tbl">

<?php
			$selectBranchNum="SELECT  DISTINCT `branchNumber`,`receiveBranchNumber`,`fileType` FROM `courier_files` WHERE `stats`='AB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001';";
			$sql_selectBranchNum = mysqli_query($conn,$selectBranchNum);
		?>
<table class="tbl1" border="1">
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">From Branch Name</td>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">To Branch Name</td>         
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Courier Type</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Access</td>
      </tr>
<?php
	  	$b = 1 ;
      	while ($add_selectBranchNum = mysqli_fetch_array($sql_selectBranchNum)) {
			$branchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[0]."'";
			$sqlbranchSel = mysqli_query($conn,$branchSel);
			$branchSel1 = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[1]."'";
			$sqlbranchSel1 = mysqli_query($conn,$branchSel1);
			while($add_branchSel = mysqli_fetch_array($sqlbranchSel)){
				while($add_branchSel1 = mysqli_fetch_array($sqlbranchSel1)){
					 echo "<tr style='background-color:#FFFFFF;'>";
					 echo "<td style='width:200px;'>
						   <div id='diva".$b."' style='display:none;'>
						   <input type='text' name='sela".$b."' id='sela".$b."' value='".$add_selectBranchNum[0]."' required/></div>
						   <input style='width:200px;' type='text' name='selaa".$b."' id='selaa".$b."' value='".$add_branchSel[0]."' disabled='disabled'/></td>";
						   
					 echo "<td style='width:200px;'>
						   <div id='divd".$b."' style='display:none;'>
						   <input type='text' name='seld".$b."' id='seld".$b."' value='".$add_selectBranchNum[1]."' required/></div>
						   <input style='width:200px;' type='text' name='selad".$b."' id='selad".$b."' value='".$add_branchSel1[0]."' disabled='disabled'/></td>";
						   
					 echo "<td style='width:200px;'>
						   <div id='divb".$b."' style='display:none;'>
						   <input type='text' name='selb".$b."' id='selb".$b."' value='".$add_selectBranchNum[2]."' required/></div>
						   <input style='width:200px;' type='text' name='selbb".$b."' id='selbb".$b."' value='".$add_selectBranchNum[2]."'  disabled='disabled'/></td>";
					 echo "<td style='width:200px;'>";
					 echo "<input type='button' id='btnselect' name='btnselect' value='Select' title='sela".$b."|seld".$b."|selb".$b."' onclick='cdocument1(this.id,title)'/>";
					 echo "</td>";
					 echo "</tr>";
					 $b++;
				 }
			 }
		}
	?>
</table>
</div>
<br/>
<div >
     
</div>
<div id='subtbl'>

</div>
<br/>
<input class="buttonManage" type="submit" id="btnSave" name="btnSave" value="Save" disabled="disabled"/>
<?php
	if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
		// Set autocommit to off
        echo "OK";
	   	mysqli_autocommit($conn,FALSE);
		try{
			//echo $_POST['txta'];
			//echo "<br/>";
            	//echo $_POST['cheRoot']."OUT";
			if(isset($_POST['cheRoot'])) {
				$_SESSION['selectBranch'] = $_POST['selBranchNumber'];
				$_SESSION['selectdepertment'] = $_POST['selDepartmentNumber'];
				$_SESSION['txtResiveOfficer'] = $_POST['txtResiveOfficer'];
				$_SESSION['txtareSN'] = $_POST['txtareSN'];
				if($_SESSION['selectBranch'] != "" && $_SESSION['selectdepertment'] != "" && $_SESSION['txtResiveOfficer'] != "" && $_SESSION['txtareSN'] !=""){
					if(isset($_POST['chka'])){
						for ($i = 1; $i<$_POST['txta']; $i++){ 
							//echo trim($_POST['txtref'.$i]);
							//echo "<br/>"; 
							date_default_timezone_set('Asia/Colombo');
							$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE `stats` = 'AB' AND `fileNumber` = '".trim($_POST['txtref'.$i])."'";
							//echo $fileGet;
							//echo "<br/>";
							$sqlfileGet = mysqli_query($conn,$fileGet);
							$fielRow = mysqli_num_rows($sqlfileGet);
							
							for($a = 1; $a <= $fielRow; $a++){
								while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
									FileMovementLogger($conn,$add_fileGet[0],'receive branch');
								}
							}
							$updateFile="UPDATE `courier_files` SET `stats` = 'BR', `receiveBranchNumber`='".$_SESSION['selectBranch']."', `receiveDepartmentNumber`='".$_SESSION['selectdepertment']."', `receiveOfficer`='".$_SESSION['txtResiveOfficer']."' WHERE `fileNumber` = '".trim($_POST['txtref'.$i])."' AND `stats` = 'AB'";
							//echo $updateFile;
							$sql_updateFile= mysqli_query($conn,$updateFile) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							$rootper = "SELECT `branchNumber`,`departmentNumber`,`receiveBranchNumber`,`receiveDepartmentNumber` FROM `courier_files` WHERE `fileNumber`='".trim($_POST['txtref'.$i])."'";
							$sql_rootper = mysqli_query($conn,$rootper);
							while ($add_rootper = mysqli_fetch_array($sql_rootper)){
								$preRootGet = $add_rootper[0]."|".$add_rootper[1]."|".$add_rootper[2]."|".$add_rootper[3];
								$noeRootGet = $add_rootper[0]."|".$add_rootper[1]."|".$_SESSION['selectBranch']."|".$_SESSION['selectdepertment'];
								date_default_timezone_set('Asia/Colombo');
								$inRoot = "INSERT INTO `courier_branch_root_chenge`(`fileNumber`, `preRoot`, `nowRoot`,`remark`,`modifedBy`, `modifedDateTime`) VALUES ('".trim($_POST['txtref'.$i])."','".$preRootGet."','".$noeRootGet."','".$_SESSION['txtareSN']."','".$_SESSION['user']."',now())";
								$sql_inroot= mysqli_query($conn,$inRoot) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							}
						}
					}else{
						
					}
					echo "<script> alert('Record Update!'); </script>";
                    echo "<script>pageRef();</script>";
				}else{
					echo "<script> alert('Fill Required root chenges!'); </script>";
				}
			}else{
				if(isset($_POST['chka'])){
					for ($i = 1; $i<$_POST['txta']; $i++){ 
						//echo trim($_POST['txtref'.$i]);
						//echo "<br/>"; 
						date_default_timezone_set('Asia/Colombo');
						$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE `stats` = 'AB' AND `fileNumber` = '".trim($_POST['txtref'.$i])."'";
						//echo $fileGet;
						//echo "<br/>";
						$sqlfileGet = mysqli_query($conn,$fileGet);
						$fielRow = mysqli_num_rows($sqlfileGet);
						
						for($a = 1; $a <= $fielRow; $a++){
							while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
								FileMovementLogger($conn,$add_fileGet[0],'Admin re-assign other branch file');
							}
						}
						$updateFile="UPDATE `courier_files` SET `stats` = 'OB' WHERE `fileNumber` = '".trim($_POST['txtref'.$i])."' AND `stats` = 'AB'";
						//echo $updateFile;
						$sql_updateFile= mysqli_query($conn,$updateFile) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					}
				}else{
					
				}
				echo "<script> alert('Record Update!'); </script>";
                echo "<script>pageRef();</script>";
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
<div style='display:none;'>
<input class='txt' type='text' name='txtp' id='txtp' value='<?php echo $_SESSION['userBranch']; ?>'/>
</div>
</form>
</body>
</html>