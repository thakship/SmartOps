<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Assign Courier SP
Purpose			: To Assign Courier SP
Author			: Madushan Wikramaarachchi
Date & Time		: 11.25 A.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/004";
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
<title>Assign Courier SP</title>
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
	.tbl{
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
	function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
</script> 
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Branch Name :</label></td>
    <td>
    <div  style='display:none;'>
        <input type="text" name="selBranchNumber" id="selBranchNumber" value=""  onKeyPress="return disableEnterKey(event)" required/>
    </div>
        <input class="box_decaretion" type="text" style=" width:200px;" name="selBranchNumber1" id="selBranchNumber1" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onclick="popup(1)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Courier SP :</label></td>
    <td>
    	<?php
			$sql_SP = "SELECT `serviceProviderNumber`,`serviceProviderName` FROM `courier_service_provider`";
			$add_SP = mysqli_query($conn,$sql_SP);
		?>
			 <select class="box_decaretion" name="selSP" id="selSP" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required>
            			<option value="">--Select SP Name--</option>
            			<?php
			 				while ($recSP = mysqli_fetch_array($add_SP)){
			 					echo "<option value='".$recSP[0]."'>".$recSP[1]."</option>";
			 				}
						?>
            		</select> 
    </td>
  </tr>
</table><br/>
<input class="buttonManage" type="submit" id="btnSPSave" name="btnSPSave" value="Update"/>
        <?php
			if(isset($_POST['btnSPSave']) && $_POST['btnSPSave']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['selBranchNumber'] = $_POST['selBranchNumber'];
					$_SESSION['selSP'] = $_POST['selSP'];
					$updateSQL = "UPDATE `branch` SET `dcsp`= '$_SESSION[selSP]' WHERE `branchNumber`='$_SESSION[selBranchNumber]'";
					$quarySQL = mysqli_query($conn,$updateSQL) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
					if(!$quarySQL){
						echo "<script> alert('Updated not success!');</script>";
						$_SESSION['selBranchNumber'] = "";
						$_SESSION['selSP'] = "";
					}else{
						echo "<script> alert('Updated success!');</script>";
						$_SESSION['selBranchNumber'] = "";
						$_SESSION['selSP'] = "";
                        echo "<script>pageClose();</script>";
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
<div id="outer">
		
</div>
<div id="conten">
 <p class="topline">Search branch</p>
  
   <?php
   	$sql =  "SELECT `branchNumber`,`branchName` FROM `branch`";
	//echo $sql."<br/>"; 
	
	$sql_grid= mysqli_query($conn,$sql) or die(mysqli_error($conn));
    echo "<table class='tblsub' border='1'><tr>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Code</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Description</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td> </tr>";
					
	$a = 1 ;					
	while ($recs = mysqli_fetch_array($sql_grid)){
		if ($a==1){
			echo "<script>
					function branch(obj,title){
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						if(obj == 'btnselect'){ 
							var id1 = document.getElementById(m1).value;
							var id2 = document.getElementById(n1).value;
							document.getElementById('selBranchNumber').value = id1;
							document.getElementById('selBranchNumber1').value = id2;
						}else{
							alert('else my code');
						}
					} 
				</script>";
		}
			/*document.getElementById('".$OutputCode."').value = id1;*/
			/*echo "<script>alert(document.getElementById('".$OutputCode."').value);</script>";*/
     	
        echo "<tr style='background-color:#FFFFFF;'>";
        echo "<td style='width:200px;'><div style='display:none;'><input class='txt' type='text' name='txt".$a."' id='txt".$a."' value='".$recs[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txt".$a."' id='txt".$a."' value='".$recs[0]."' disabled='disabled'/></td>";
        echo "<td style='width:200px;'> <div style='display:none;'><input class='txt' type='text' name='txta".$a."' id='txta".$a."' value='".$recs[1]."'/></div>
                              <input style='width:200px;' type='text' name='txta".$a."' id='txta".$a."' value='".$recs[1]."' disabled='disabled'/></td>";
        echo "<td style='width:100px;'>";
        echo "<input style='font-size: 12px;' type='button' id='btnselect' name='btnselect' title='txt".$a."|txta".$a."' value='Select' onclick='branch(this.id,title);popup(0);'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
   ?>
</div>
</form>
</body>
</html>