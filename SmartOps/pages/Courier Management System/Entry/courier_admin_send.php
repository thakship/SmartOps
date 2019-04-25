<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Send Admin Bag
Purpose			: To Sending Courier Branch vise
Author			: Madushan Wikramaarachchi
Date & Time		: 09.29 A.M 21/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/004";
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
<title>Send Admin Bag</title>
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
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_admin_send.php?DispName=Send%20Admin%20Bag','conectpage');
    }
</script>
<style type="text/css">
	.tbl1{
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
	.tbl2{
	 	text-align:center;
		width:300px;
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
<form action="" method="post" name="schform" novalidate>
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
		<?php
			$selectBranchNum1="SELECT DISTINCT `receiveBranchNumber`,`fileType`,`stats` FROM `courier_files` WHERE `branchNumber`='".$_SESSION['userBranch']."' AND `stats`='AD'";
			$sql_selectBranchNum1 = mysqli_query($conn,$selectBranchNum1);
			$_SESSION['rowDeparment'] = mysqli_num_rows($sql_selectBranchNum1);
		?>
<div style='display:none;'>
<input type="text" name="userBranch" id="userBranch" value="<?php echo $_SESSION['userBranch']; ?>" required="required" />
<input class='txt' type='text' name='txta' id='txta' value='<?php echo $_SESSION['rowDeparment']; ?>'/>
</div>
<table class="tbl1" border="1">
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Branch Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Courier Type</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">View</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
      </tr>
<?php
	  	$b = 1 ;
      	while ($add_selectBranchNum1 = mysqli_fetch_array($sql_selectBranchNum1)) {
			echo "<script>
					function cdocument1(obj,title){
						//alert('show :' + obj);
						//alert('show :' + title);
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
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
							var no=document.getElementById(m1).value;
							//alert(no);
							var no1=document.getElementById(n1).value;
							var no3=document.getElementById('userBranch').value;
							//alert(no1);
							mydata.open('GET','ajaxadminbranchsend.php'+'?txt1='+no+ '&txt2='+no1+ '&txt3='+no3,true);
							//alert('aa2 - End - 3');
							mydata.send();
							//alert('Send');	
						}else{
							alert('else my code');
						}									
					}
					</script>";
			$branchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selectBranchNum1[0]."'";
			$sqlbranchSel = mysqli_query($conn,$branchSel);
			while($add_branchSel = mysqli_fetch_array($sqlbranchSel)){
				 echo "<tr style='background-color:#FFFFFF;'>";
				 echo "<td style='width:200px;'>
					   <div id='diva".$b."' style='display:none;'>
					   <input type='text' name='sela".$b."' id='sela".$b."' value='".$add_selectBranchNum1[0]."' required/></div>
					   <input style='width:200px;' type='text' name='selaa".$b."' id='selaa".$b."' value='".$add_branchSel[0]."' disabled='disabled'/></td>";
				 echo "<td style='width:200px;'>
					   <div id='divb".$b."' style='display:none;'>
					   <input type='text' name='selb".$b."' id='selb".$b."' value='".$add_selectBranchNum1[1]."' required/></div>
					   <input style='width:200px;' type='text' name='selbb".$b."' id='selbb".$b."' value='".$add_selectBranchNum1[1]."'  disabled='disabled'/></td>";
				 echo "<td style='width:100px;'>";
				echo "<input type='button' id='btnselect' name='btnselect' value='Select' title='sela".$b."|selb".$b."' onclick='cdocument1(this.id,title)'/></td>";
				 echo "<td style='width:100px;'>";
						if($add_selectBranchNum1[2] == "AD"){
							echo "<input type='checkbox' name='chka".$b."' id='chka".$b."' checked='checked'/>";
					 	}else{
							echo "<input type='checkbox' name='chka".$b."' id='chka".$b."'/>";
					 	}
				 echo "</td>";
				 echo "</tr>";
				 $b++;
			 }
		}
	?>
</table><br/>
<?php
	$selectSp = "SELECT `dcsp` FROM `branch` WHERE `branchNumber`='$_SESSION[userBranch]'";
	$sql_selectSp = mysqli_query($conn,$selectSp);
?>
<?php
	while($add_selectSp = mysqli_fetch_array($sql_selectSp)){
		$spadd = "SELECT `serviceProviderName` FROM `courier_service_provider` WHERE `serviceProviderNumber`='".$add_selectSp[0]."'";
		$sql_spadd = mysqli_query($conn,$spadd);
		while($add_spadd = mysqli_fetch_array($sql_spadd)){
?>
        <table>
            <tr>
                <td>Courier Service Provider</td>
                <td>
                   &nbsp;&nbsp;<!--<input style="width:250px;" type="text" name="txtCSP" id="txtCSP" value="<?php// echo $add_selectSp[0]; ?>"  onKeyPress="return disableEnterKey(event)" required/>-->
                    <select class="box_decaretion" name="txtCSP" id="txtCSP" onKeyPress="return disableEnterKey(event)"  required>
            			<option value="<?php echo $add_selectSp[0]; ?>"><?php echo $add_spadd[0]; ?></option>
            			<?php
							$subSP = "SELECT `serviceProviderName`,`serviceProviderNumber` FROM `courier_service_provider` WHERE `serviceProviderNumber`!='".$add_selectSp[0]."'";
							$sql_subSP = mysqli_query($conn,$subSP);
			 				while ($add_subSP = mysqli_fetch_array($sql_subSP)){
			 					echo "<option value='".$add_subSP[1]."'>".$add_subSP[0]."</option>";
			 				}
						?>
            		</select>
                </td>
            </tr>
        </table>
<?php 
		}
	}
?>
<br/>
<div id="tbl">
<br/>
</div>
<input class="buttonManage" type="submit" id="btnSave" name="btnSave" value="Save"/>
	<?php
        if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
            // Set autocommit to off
           mysqli_autocommit($conn,FALSE);
            try{
                for ($i = 1; $i<=$_POST['txta']; $i++){ 
                    if(isset($_POST['chka'.$i])){
						date_default_timezone_set('Asia/Colombo');
						$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE receiveBranchNumber = '".trim($_POST['sela'.$i])."' AND fileType = '".trim($_POST['selb'.$i])."' AND branchNumber = '".$_POST['userBranch']."' AND stats = 'AD'";
						$sqlfileGet = mysqli_query($conn,$fileGet);
						$fielRow = mysqli_num_rows($sqlfileGet);
						for($a = 1; $a <= $fielRow; $a++){
							while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
								//FileMovementLogger_USER($conn,$add_fileGet[0],'sent to branch',$_SESSION['user']);
                                $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$add_fileGet[0]."',now(),'sent to branch','".$_SESSION['user']."')";
	                            //echo $fileMove."<br/>";
                                $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
                                $updateFile="UPDATE courier_files SET stats='AB' WHERE receiveBranchNumber = '".trim($_POST['sela'.$i])."' AND fileType = '".trim($_POST['selb'.$i])."' AND stats = 'AD' AND branchNumber = '".$_POST['userBranch']."' AND fileNumber = '".$add_fileGet[0]."';";
                                $sql_updateFile= mysqli_query($conn,$updateFile) or die(mysqli_error($conn));
        					    //echo $updateFile."<br/>";
                                
							}
						}
                        
                        $sendCBranch ="INSERT INTO `courier_branch`(`branchNumber`, `sender`, `sendDateTime`, `receiveBranchNumber`, `stats`, `serviceProviderNumber`, `courierType`) VALUES ('".$_POST['userBranch']."','".$_SESSION['user']."',now(),'".trim($_POST['sela'.$i])."','AB','".trim($_POST['txtCSP'])."','".trim($_POST['selb'.$i])."')";
					    //echo $sendCBranch."<br/>";
                        $sql_sendCBranch= mysqli_query($conn,$sendCBranch) or die(mysqli_error($conn));
					    echo "<script> alert('Record Update!'); </script>";
                        echo "<script>pageRef();</script>";
                    }else{

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
</form>
</body>
</html>