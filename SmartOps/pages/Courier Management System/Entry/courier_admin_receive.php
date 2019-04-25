<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Receive Admin Bag
Purpose			: To Receive Admin Bag
Author			: Madushan Wikramaarachchi
Date & Time		: 09.55 A.M 21/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/005";
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
<title>Receive Admin Bag</title>
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
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_admin_receive.php?DispName=Receive%20Admin%20Bag','conectpage');
    }
</script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:800px;
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
<?php
		//echo $_SESSION['userBranch'];
			$selectBranchNum="SELECT  DISTINCT `branchNumber`,`receiveBranchNumber`,`stats` FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001'))";
			$sql_selectBranchNum = mysqli_query($conn,$selectBranchNum);
			$numOfRow = mysqli_num_rows($sql_selectBranchNum);
			
		?>
<table class="tbl1" border="1">
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">From Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">To Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Normal Type</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Special Type</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Normal View</td>
          <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Special View</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
      </tr>
<?php
	  	$b = 1 ;
      	while ($add_selectBranchNum = mysqli_fetch_array($sql_selectBranchNum)) {
			echo "<script>
					function view(obj,title){
						//alert('show :' + obj);
						var [m,n,b]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						var b1 = [b];
						//alert('m is :' + m1);
						//alert('n is :' + n1);
						//alert('b is :' + b1);
						if(obj == 'btnViewNormal' || obj == 'btnViewSpecial'){ 
							//alert('Do my code');
							var mydata1;
							mydata1= new XMLHttpRequest();
							mydata1.onreadystatechange=function(){
								if(mydata1.readyState==4){
									document.getElementById('fileTbl').innerHTML=mydata1.responseText;
								}
							}
							var Fbranch = document.getElementById(m1).value;;
							//alert('Fbranch is :' + Fbranch);
							var Tbranch = document.getElementById(n1).value;; 
							//alert('Tbranch is :' + Tbranch);
							var getfileType= b1;
							//alert('getfileType is :' + getfileType);
							mydata1.open('GET','ajaxadminbranchReceiveSub.php'+'?a1='+Fbranch+ '&a2='+Tbranch+ '&a3='+getfileType,true);
							mydata1.send();
						}else{
							alert('else my code');
						}
					}
				</script>";
			$branchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[0]."'";
			$sqlbranchSel = mysqli_query($conn,$branchSel);
			$branchSel1 = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[1]."'";
			$sqlbranchSel1 = mysqli_query($conn,$branchSel1);
			$nomOfFilesSP = "SELECT COUNT(`fileNumber`) FROM `courier_files` WHERE `receiveBranchNumber`='".$_SESSION['userBranch']."' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001')) AND `fileType`='Special' AND `branchNumber`='".$add_selectBranchNum[0]."'";
			$sql_nomOfFilesSP = mysqli_query($conn,$nomOfFilesSP);
			$nomOfFilesNBor = "SELECT COUNT(`fileNumber`) FROM `courier_files` WHERE `receiveBranchNumber`='".$_SESSION['userBranch']."' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001')) AND `fileType`='Normal' AND `branchNumber`='".$add_selectBranchNum[0]."'";
			$sql_nomOfFilesNBor = mysqli_query($conn,$nomOfFilesNBor);
			while($add_branchSel = mysqli_fetch_array($sqlbranchSel)){
				while($add_branchSel1 = mysqli_fetch_array($sqlbranchSel1)){
				while($add_nomOfFilesSP = mysqli_fetch_array($sql_nomOfFilesSP)){
				while($add_nomOfFilesNBor = mysqli_fetch_array($sql_nomOfFilesNBor)){
				
					 echo "<tr style='background-color:#FFFFFF;'>";
					 echo "<td style='width:150px;'>
						   <div id='diva".$b."' style='display:none;'>
						   <input type='text' name='sela".$b."' id='sela".$b."' value='".$add_selectBranchNum[0]."' required/></div>
						   <input style='width:150px;' type='text' name='selaa".$b."' id='selaa".$b."' value='".$add_branchSel[0]."' disabled='disabled'/></td>";
					echo "<td style='width:150px;'>
						   <div id='diva".$b."' style='display:none;'>
						   <input type='text' name='selc".$b."' id='selc".$b."' value='".$add_selectBranchNum[1]."' required/></div>
						   <input style='width:150px;' type='text' name='selcc".$b."' id='selcc".$b."' value='".$add_branchSel1[0]."' disabled='disabled'/></td>";
					 echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtNoOfNoemalF' id='txtNoOfNoemalF' value='".$add_nomOfFilesNBor[0]."' disabled='disabled'/></td>";
					 echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtNoOfSpecialF' id='txtNoOfSpecialF' value='".$add_nomOfFilesSP[0]."' disabled='disabled'/></td>";
					 echo "<td style='width:100px;'><input style='font-size: 12px;' type='button' id='btnViewNormal' name='btnViewNormal' value='View' title='sela".$b."|selc".$b."|Normal' onclick='view(this.id,title)'/></td>";
					 echo "<td style='width:100px;'><input style='font-size: 12px;' type='button' id='btnViewSpecial' name='btnViewSpecial' value='View' title='sela".$b."|selc".$b."|Special' onclick='view(this.id,title)'/></td>";
					 echo "<td style='width:100px;'>";
					 		//echo $add_selectBranchNum[3];
							if($add_selectBranchNum[2] == "AB" || $add_selectBranchNum[2] == "OB"){
								echo "<input type='checkbox' name='chka".$b."' id='chka".$b."' checked='checked'/>";
							}else{
								echo "<input type='checkbox' name='chka".$b."' id='chka".$b."'/>";
							}
					echo "</td>";
					 echo "</tr>";
					 $b++;
					 }
					 }
				 }
			 }
		}
	?>
</table>
<br/>
<div id="fileTbl">
   
</div>
<br/>
<input class="buttonManage" type="submit" id="btnSave" name="btnSave" value="Save"/>
<?php
	if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
		// Set autocommit to off
	   	 mysqli_autocommit($conn,FALSE);
            try{
                for ($i = 1; $i<=$numOfRow; $i++){ 
					/*echo "<script> alert('a'); </script>";*/
                    if(isset($_POST['chka'.$i])){
						/*echo "<script> alert('b'); </script>";*/
						date_default_timezone_set('Asia/Colombo');
						$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE receiveBranchNumber = '".trim($_POST['selc'.$i])."' AND (stats = 'AB' OR stats = 'OB') AND `branchNumber`='".trim($_POST['sela'.$i])."'";
						$sqlfileGet = mysqli_query($conn,$fileGet);
						$fielRow = mysqli_num_rows($sqlfileGet);
						for($a = 1; $a <= $fielRow; $a++){
							while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
								//FileMovementLogger($conn,$add_fileGet[0],'receive branch');
                                FileMovementLogger_USER($conn,$add_fileGet[0],'receive branch',$_SESSION['user']);
							}
						}
                        $updateFile="UPDATE courier_files SET `stats`='BR' WHERE `receiveBranchNumber` = '".trim($_POST['selc'.$i])."' AND `branchNumber` = '".trim($_POST['sela'.$i])."' AND (stats = 'AB' OR stats = 'OB')";
                        $sql_updateFile= mysqli_query($conn,$updateFile) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						
					echo "<script> alert('Record Update!'); </script>";
                    echo "<script>pageRef();</script>";
                    }else{
						/*echo "<script> alert('c'); </script>";*/
                    }
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