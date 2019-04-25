<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Generate Courier Serial No
Purpose			: To Generate Courier Serial No
Author			: Madushan Wikramaarachchi
Date & Time		: 11.02 A.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/003";
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
<title>Courier sirial name generate</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.tblsub{
	 	text-align:center;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
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
				//alert("aaaaa");
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
		//alert('aaaaaa');
	  }	
	}
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" onsubmit="return chak()">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Serial Branch :</label></td>
    <td>
        <div style='display:none;'>
        <input type="text" name="selBranchNumber" id="selBranchNumber" value=""  onKeyPress="return disableEnterKey(event)" readonly required/>
       </div>
        <input class="box_decaretion" type="text" style=" width:200px;" name="selBranchNumber1" id="selBranchNumber1" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onclick="popup(1)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Serial Department :</label></td>
    <td>
    	
         <div id='test'>
            <select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required>
                <option value="">--Select Department Name--</option>
            </select>
       </div>  
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Serial Year :</label></td>
    <td>
    		<input class="box_decaretion" type="text" name="txtYear" id="txtYear" value="<?php  
			date_default_timezone_set('Asia/Colombo');
			echo DATE("Y");
		?>"  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
    	</td>
  </tr>
   <tr>
    <td style="width:150px;"><label class="linetop">Serial Name :</label></td>
    <td>
    	<input class="box_decaretion" type="text" name="txtSname" id="txtSname" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
    </td>
  </tr>
</table>
<br/>
<input class="buttonManage" type="submit" name="btnSSave" id="btnSSave" value="Save"/>
   <?php
		if(isset($_POST['btnSSave']) && $_POST['btnSSave']=='Save'){
			// Set autocommit to off
			mysqli_autocommit($conn,FALSE);
			try{
				$_SESSION['srialBranch'] = trim($_POST['selBranchNumber']);
				$_SESSION['seialdepartment'] = trim($_POST['selDepartmentNumber']);
				$_SESSION['seialYear'] = trim($_POST['txtYear']);
				$_SESSION['seialName'] = trim($_POST['txtSname']);
				if($_SESSION['srialBranch']!="" && $_SESSION['seialdepartment']!="" && $_SESSION['seialYear']!="" && $_SESSION['seialName']!=""){
					$sql_add = "INSERT INTO `filesnumbergenaret`(`branch`, `department`, `year`, `serial`, `count`) VALUES ('".$_SESSION['srialBranch']."','".$_SESSION['seialdepartment']."','".$_SESSION['seialYear']."','".$_SESSION['seialName']."','0')"; 
					echo $sql_add;
                    $query1 = mysqli_query($conn,$sql_add) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					if($query1){
							echo "<script> alert('Record Saved!'); </script>";
							$_SESSION['srialBranch'] = "";
							$_SESSION['seialdepartment'] = "";
							$_SESSION['seialYear'] = "";
							$_SESSION['seialName'] = "";
                            echo "<script>pageClose();</script>";
						}else{
							echo "<script> alert('Record not Saved!');</script>";
							$_SESSION['srialBranch'] = "";
							$_SESSION['seialdepartment'] = "";
							$_SESSION['seialYear'] = "";
							$_SESSION['seialName'] = "";
						}
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
<br/>
  
<div id="outer">
		
</div>
<div id="conten">
    <p class="topline">Search branch</p>
    <?php
		ShowGrid($conn,"SELECT `branchNumber`,`branchName` FROM `branch`",'selBranchNumber','selBranchNumber1','popup(0)','branch','txt1','txt2','NULL');			
    ?>
       
</div>
</form>
</body>
</html>