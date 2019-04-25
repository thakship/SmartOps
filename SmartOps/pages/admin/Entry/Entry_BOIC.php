<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Branch Officer Management
Purpose			: To Manage for BOIC
Author			: Madushan Wikramaarachchi
Date & Time		: 11.04 A.M 19/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P010";
	$_SESSION['Module'] = "Admin";
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

<title>Branch Officer Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
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
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
	#outer2{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten2{
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
<script language="javascript" type="text/javascript">
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
	  function popupsub(y){
		  if(y==1){
			document.getElementById('outer1').style.visibility = "visible";
			document.getElementById('conten1').style.visibility = "visible";
		  }else{
			document.getElementById('outer1').style.visibility = "hidden";
			document.getElementById('conten1').style.visibility = "hidden";
			//alert('aaaaaa');
		  }	
	}
	 function popupsub1(z){
		  if(z==1){
			document.getElementById('outer2').style.visibility = "visible";
			document.getElementById('conten2').style.visibility = "visible";
		  }else{
			document.getElementById('outer2').style.visibility = "hidden";
			document.getElementById('conten2').style.visibility = "hidden";
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
</p>
<hr/>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Branch Name :</label></td>
    <td>
         <div style='display:none;'><input type="text" name="txtBranchNumber" id="txtBranchNumber" value=""  onKeyPress="return disableEnterKey(event)"  readonly required/></div>
        <input type="text" style="width:150px; border: solid 1px #000000;" name="txtBranchNumber1" id="txtBranchNumber1" value=""  onKeyPress="return disableEnterKey(event)" onclick="popup(1)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" readonly required/>
    </td>
  </tr>
   <tr>
    <td style="width:150px;"><label class="linetop">Head of Depatment :</label></td>
    <td>
    	<div style='display:none;'><input type="text" name="txtHOD1" id="txtHOD1" value="" onKeyPress="return disableEnterKey(event)" readonly /></div>
    	<input type="text" style="width:300px; border: solid 1px #000000;" name="txtHOD" id="txtHOD" value="" onclick="popupsub1(1)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" readonly/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">BOIC Name :</label></td>
    <td>
    	<div style='display:none;'><input type="text" name="txtBOIC1" id="txtBOIC1" value="" onKeyPress="return disableEnterKey(event)" readonly /></div>
    	<input type="text" style="width:300px; border: solid 1px #000000;" name="txtBOIC" id="txtBOIC" value="" onclick="popupsub(1)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" readonly/>
    </td>
  </tr>
 </table><br/>
<input type="submit" class="buttonManage" name="btnBOCESave" id="btnBOCESave" value="Save"/>
        <?php
			if(isset($_POST['btnBOCESave']) && $_POST['btnBOCESave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBranchNumber'] = trim($_POST['txtBranchNumber']);
					$_SESSION['txtHOD1'] = trim($_POST['txtHOD1']);
					$_SESSION['txtBOIC1'] = trim($_POST['txtBOIC1']);
					$newContac = "$_SESSION[txtBranchNumber]|$_SESSION[txtHOD1]|$_SESSION[txtBOIC1]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `branchNumber`,`BOH`,`BOIC` FROM `branch` WHERE `branchNumber`='$_SESSION[txtBranchNumber]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]|$rec1[2]";
			 		}
					if($_SESSION['txtBranchNumber']!=""){
						$addsql2="UPDATE `branch` SET `BOH`='$_SESSION[txtHOD1]',`BOIC`='$_SESSION[txtBOIC1]' WHERE `branchNumber`='$_SESSION[txtBranchNumber]'";
						$quary12 = mysqli_query($conn,$addsql2);
						if(!$quary12){
							echo "<script> alert('updated not success!');</script>";
						}else{
							date_default_timezone_set('Asia/Colombo');
							$table = "Branch";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtBranchNumber'] = "";
							$_SESSION['txtHOD1'] = "";
							$_SESSION['txtBOIC1'] = "";
                            echo "<script> pageClose();</script>";
						}
					}else{
						echo "<script> alert('Please enter complete details!');</script>";
					}
					// Commit transaction
					mysqli_commit($conn);
  				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
				    echo 'Message: '.$e->getMessage();
 				}
			}
		?>
       
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div id="outer">
		
</div>
<div id="conten">
    <p class="topline">Search branch 
    <input style="margin-left:310px;font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose"/>
    </p>
     <?php
            $viewDoc = "SELECT `branchNumber`,`branchName` FROM `branch` WHERE `branchNumber`!='0001'";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table style="width: 500px;" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Branch ID</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Branch Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                       echo "<script>
								function selectDB".$a."(){
									var id1 = document.getElementById('txtq".$a."').value;
									document.getElementById('txtBranchNumber').value = id1;
									var id2 = document.getElementById('txtw".$a."').value;
									document.getElementById('txtBranchNumber1').value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txtq".$a."' id='txtq".$a."' value='".$add[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txtq".$a."' id='txtq".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txtw".$a."' id='txtw".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txtw".$a."' id='txtw".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' style='font-size: 12px;' id='btnselect".$a."' name='btnselectsub".$a."' value='Select' onclick='selectDB".$a."();popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
</div>
<div id="outer1">
		
</div>
<div id="conten1">
    <p class="topline">Search Head of Depatment 
    <input style="margin-left:310px;" type="button" onclick="popupsub(0)" value="Colse" id="popupclose" name="popupclose">
    </p>
    Search User name : <input style="width:200px; background-color:#E0E0E0;" type="text" name="popupsearch" id="popupsearch" value=""/> 
        <input type="button" style='font-size: 12px;' value="Search" id="popupSearchBTN" name="popupSearchBTN" onclick="fileSelect()">
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
            $viewDoc = "SELECT `userID`,`userName` FROM `user`";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table style="width: 500px;margin-left: 30px;" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">User ID</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">User Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                       echo "<script>
								function selectDBsub".$a."(){
									var id1 = document.getElementById('txts".$a."').value;
									document.getElementById('txtBOIC1').value = id1;
									var id2 = document.getElementById('txtd".$a."').value;
									document.getElementById('txtBOIC').value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:200px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txts".$a."' id='txts".$a."' value='".$add[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txts".$a."' id='txts".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txtd".$a."' id='txtd".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txtd".$a."' id='txtd".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' onclick='selectDBsub".$a."();popupsub(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
            </div>
</div>      
<div id="outer2">
		
</div>
<div id="conten2">
    <p class="topline">Search BOIC Name :
    <input style="margin-left:310px; font-size: 12px;" type="button" onclick="popupsub1(0)" value="Colse" id="popupclose" name="popupclose" />
    </p>
    Search User name : <input style="width:200px; background-color:#E0E0E0;" type="text" name="popupsearch1" id="popupsearch1" value=""/> 
        <input type="button" style='font-size: 12px;' value="Search" id="popupSearchBTN1" name="popupSearchBTN1" onclick="fileSelect1()" />
        <script>
        	function fileSelect1(){
				//var no=document.getElementById('txtFilename').value;
				//alert('aa2 - ');
				//document.getElementById('selectFilName').style.visibility = "visible";
				var mydata6;
				mydata6= new XMLHttpRequest();
				mydata6.onreadystatechange=function(){
					if(mydata6.readyState==4){
						document.getElementById('getNewtblPopup1').innerHTML=mydata6.responseText;
					}
				}
				var searchup=document.getElementById('popupsearch1').value;
				//var no1=document.getElementById('selFileType').value;
				mydata6.open("GET","ajaxEntryPopu2.php"+"?txtsearch="+searchup,true);
				mydata6.send();
			}
	
        </script>
        <br/>
        <br/>
        <div id="getNewtblPopup1">
		<?php
            $viewDoc = "SELECT `userID`,`userName` FROM `user`";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table style="width: 500px; margin-left: 30px;" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">User ID</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">User Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                       echo "<script>
								function selectDBsub1".$a."(){
									var id1 = document.getElementById('txtf".$a."').value;
									document.getElementById('txtHOD1').value = id1;
									var id2 = document.getElementById('txtm".$a."').value;
									document.getElementById('txtHOD').value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:200px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txtf".$a."' id='txtf".$a."' value='".$add[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txtf".$a."' id='txtf".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txtm".$a."' id='txtm".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txtm".$a."' id='txtm".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' style='font-size: 12px;' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' onclick='selectDBsub1".$a."();popupsub1(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
            </div>
</div>     
</form>
</body>
</html>