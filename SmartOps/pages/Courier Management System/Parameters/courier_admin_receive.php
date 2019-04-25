<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Received File Details
Purpose			: To Received File Details
Author			: Madushan Wikramaarachchi
Date & Time		: 09.47 A.M 25/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/p/001";
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
<title>Received File Details</title>
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
		width:500px;
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
	#fileTbl{
		visibility: hidden;
		width:1120px;
		height:200px;
		overflow-y: scroll;
	}
	#fileTblsub{
		visibility: hidden;
		height:300px;
		width:550px;
		overflow-y: scroll;
	}
</style>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	$sqlPageName ="SELECT `pageName` FROM `pages` WHERE `pageCode`='cou/p/001'";	
	$add_sqlPageName = mysqli_query($conn,$sqlPageName);
	while ($r_sqlPageName = mysqli_fetch_array($add_sqlPageName)){
		echo $r_sqlPageName[0];
	}
?>
</p><hr/>
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<br/><br/>
<?php
			$selectBranchNum="SELECT  DISTINCT `branchNumber`,`receiveBranchNumber` FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001'))";
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
							document.getElementById('fileTbl').style.visibility = 'visible';
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
					function viewGet(obj,title){
						if(obj == 'btnViewFile'){ 
							//alert('Do my code');
							document.getElementById('fileTblsub').style.visibility = 'visible';
							var mydata3;
							mydata3= new XMLHttpRequest();
							mydata3.onreadystatechange=function(){
								if(mydata3.readyState==4){
									document.getElementById('fileTblsub').innerHTML=mydata3.responseText;
								}
							}
							var Fbranch = document.getElementById(title).value;;
							//alert('Fbranch is :' + Fbranch);
							mydata3.open('GET','jaxadminbranchReceiveSub1.php'+'?b1='+Fbranch,true);
							mydata3.send();
						}else{
							alert('else my code');
						}
					}
				</script>";
			$branchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[0]."'";
			$sqlbranchSel = mysqli_query($conn,$branchSel);
			$branchSel1 = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum[1]."'";
			$sqlbranchSel1 = mysqli_query($conn,$branchSel1);
			$nomOfFilesSP = "SELECT COUNT(`fileNumber`) FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001')) AND `fileType`='Special' AND `branchNumber`='".$add_selectBranchNum[0]."'";
			$sql_nomOfFilesSP = mysqli_query($conn,$nomOfFilesSP);
			$nomOfFilesNBor = "SELECT COUNT(`fileNumber`) FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND ((`stats`='AB' AND (`receiveBranchNumber` = '0001' OR `branchNumber` = '0001')) OR (`stats`='OB' AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001')) AND `fileType`='Normal' AND `branchNumber`='".$add_selectBranchNum[0]."'";
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
					 echo "<td style='width:100px;'><input type='button' id='btnViewNormal' name='btnViewNormal' value='View' title='sela".$b."|selc".$b."|Normal' onclick='view(this.id,title)'/></td>";
					 echo "<td style='width:100px;'><input type='button' id='btnViewSpecial' name='btnViewSpecial' value='View' title='sela".$b."|selc".$b."|Special' onclick='view(this.id,title)'/></td>";
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
<br/><br/>
<div id="fileTblsub">
   
</div>
<br/>
<div style='display:none;'>
<input class='txt' type='text' name='txtp' id='txtp' value='<?php echo $_SESSION['userBranch']; ?>'/>
</div>
</form>
</body>
</html>