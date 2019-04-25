<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: User Management
Purpose			: To Create User Group
Author			: Madushan Wikramaara
Date & Time		: 08.32 A.M 19/08/2014 (Modified)
                : 11.10 A.M 19/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P006";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>User Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- MetisMenu CSS -->
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../../../dist/css/realSolution_1.css" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
<!--Javascript-->

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
</style>
<script type="text/javascript">
	function ajaxFunction(e){
		var http;  // The variable that makes Ajax possible! 
		var e=e || window.event;
		var keycode=e.which || e.keyCode;
		if(keycode!==13 || (e.target||e.srcElement).value=='') return false;
		try{ 
			// Opera 8.0+, Firefox, Safari 
			http = new XMLHttpRequest(); 
		}catch(ex){ 
			// Internet Explorer Browsers 
			try{ 
				http = new ActiveXObject("Msxml2.XMLHTTP"); 
			}catch(ex){ 
				try{ 
					http = new ActiveXObject("Microsoft.XMLHTTP"); 
				}catch(ex){ 
					// Something went wrong 
					alert("Your browser broke!"); 
					return false; 
				}
			}
		}
		var url = "getagentids.php?param4=";
		var idValue = document.getElementById("txtUserName").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param4=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtUserName').value = results[0].trim();
				document.getElementById('txtUserID').value = results[1].trim();
				document.getElementById('txtPassword').value = results[2].trim();
				document.getElementById('txtNIC').value = results[3].trim();
				document.getElementById('txtEPF').value = results[4].trim();
				document.getElementById('txtHRIS').value = results[5].trim();
				document.getElementById('txtEmail').value = results[6].trim();
				document.getElementById('selUserGroupCode').value = results[7].trim();
				document.getElementById('txtBranchNumber').value = results[8].trim();
				document.getElementById('txtBranchNumber1').value = results[9].trim();
                document.getElementById('txtDepartmentNumber').value = results[10].trim();
                document.getElementById('txtAcc').value = results[12].trim();
                document.getElementById('txtGSM').value = results[13].trim();
                document.getElementById('selUserStat').value = results[14].trim();
                //alert(results[10].trim() + " -- " + results[11].trim());
                var CurrentDep=results[10].trim();
				var mydata1;
				mydata1= new XMLHttpRequest();
				mydata1.onreadystatechange=function(){
					if(mydata1.readyState==4){
						document.getElementById('test').innerHTML=mydata1.responseText;
                        document.getElementById('txtDepartmentNumber').value = CurrentDep;
					}
				}
				var a1=document.getElementById('txtBranchNumber').value;
				mydata1.open("GET","ajaxUserDepartmet1.php"+"?g2="+a1,true);
				mydata1.send();
                
                
                
			}
		} 
	}
	function chak(){
		var em = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(document.getElementById('txtEmail').value.length >0){
			if(!document.getElementById('txtEmail').value.match(em)){
				alert("Plase only enter yyyyyyy@ghj.com");
				document.getElementById('txtEmail').value ="";
				return false;
			}
			/*if(document.getElementById('txtNIC').value.length >0){
				if(document.getElementById('txtNIC').value.length!=10){
					alert("Plase only enter 9 numbers and end \' V\ '");
					document.getElementById('txtNIC').value ="";
					return false;
				}
			}else{
				return true;
			}*/
		}else{
			/*if(document.getElementById('txtNIC').value.length >0){
				if(document.getElementById('txtNIC').value.length!=10){
					alert("Plase only enter 9 numbers and end \' V\ '");
					document.getElementById('txtNIC').value ="";
					return false;
				}
			}else{
				return true;
			}*/
		}
		return true;
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
    
    function selectUserGroup(){
        alert('a');
        if(document.getElementById('selUserGroupCode').value == "ug00016"){
            document.getElementById('mkr').style.display = "inline";
        }
            
        
    }
</script> 
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" onsubmit="return chak()" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>

<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   User Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">User ID : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUserName" name="txtUserName" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="User ID" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">User Name : *</label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control" id="txtUserID" name="txtUserID" value="" maxlength="150" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="User Name" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Password : *</label>
                     <div class="col-sm-3">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="" maxlength="20" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="Password" />
                      </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                  <div class='form-group'>
					 <label class="col-sm-2">N.I.C : *</label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtNIC" name="txtNIC" value="" maxlength="12" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="NIC" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">E.P.F : </label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtEPF" name="txtEPF" value="" maxlength="10" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"  placeholder="EPF Number" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">H.R.I.S : </label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtHRIS" name="txtHRIS" value="" maxlength="10" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="HRIS Number" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">E-Mail : </label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="" maxlength="100" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="E - mail" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">User Group Name : </label>
                     <div class="col-sm-4">
                        <?php
                			$addsql01="SELECT `usergroupNumber`,`usergroupName` FROM `usergroup`";
                			$quary101 = mysqli_query($conn,$addsql01);
                        ?>
                        <select class="form-control" name="selUserGroupCode" id="selUserGroupCode" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="selectUserGroup();">
                             <option value="">--Select User Group Name--</option>
                             <?php
                                 while ($rec1 = mysqli_fetch_array($quary101)){
                    			 	echo "<option value='".$rec1[0]."'>".$rec1[1]."</option>";
                    			 }
                            ?>
                            </select>
                     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div id="mkr" style="display: none;">
                      <div class='form-group'>
    					 <label class="col-sm-2">Officer Type : </label>
                        <div class="col-sm-4">
                        &nbsp;
                        </div>
                     </div>
                      <div class='col-lg-12'>
    					
    				 </div>
                     <div class='form-group'>
    					 <label class="col-sm-2" style="text-align: right;">Deposit : </label>
                        <div class="col-sm-1">
                         <input type="checkbox" class="form-control" id="txtisDeposit" name="txtisDeposit" value="1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
                         </div>
                     </div>
                      <div class='col-lg-12'>
    					
    				 </div>
                     <div class='form-group'>
    				    <label class="col-sm-2" style="text-align: right;">Lending : </label>
                        <div class="col-sm-1">
                         <input type="checkbox" class="form-control" id="txtisLending" name="txtisLending" value="1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
                         </div>
                     </div>
                      <div class='col-lg-12'>
    					
    				 </div>
                     <div class='form-group'>
    					 <label class="col-sm-2" style="text-align: right;">Saving : </label>
                        <div class="col-sm-1">
                          <input type="checkbox" class="form-control" id="txtisSaving" name="txtisSaving" value="1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
                         </div>
                     </div>
                      <div class='col-lg-12'>
    					
    				 </div>
                 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Branch Name : </label>
                     <div class="col-sm-4">
                        <div style='display:none;'>
                            <input type="text" name="txtBranchNumber" id="txtBranchNumber" value=""  onkeypress="return disableEnterKey(event)"  readonly="readonly" required="required"/>
                        </div>
                        <input type="text" class="form-control" id="txtBranchNumber1" name="txtBranchNumber1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1)"  required="required" placeholder="Barnch Name" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Department Name : </label>
                     <div class="col-sm-4">
                        <div id='test'>
                            <select class="form-control" name="txtDepartmentNumber" id="txtDepartmentNumber" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                             <option value="">--Select Department Name--</option>
                            </select>
                        </div>
                        
                     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                  <div class='form-group'>
					 <label class="col-sm-2">Account Number : </label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtAcc" name="txtAcc" value="" maxlength="20" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="Account Number" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">GSM Number : </label>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtGSM" name="txtGSM" value="" maxlength="10" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"  placeholder="GSM Number" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                  <div class='form-group'>
					 <label class="col-sm-2">User Stat : *</label>
                     <div class="col-sm-4">
                         <select class="form-control" name="selUserStat" id="selUserStat" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                        	<option value="A">Active</option>
                            <option value="R">Resign</option>
                            <option value="T">Termineted</option>
                            <option value="S">Saspented</option>
                            <option value="N">Not Active</option>
                         </select>
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Save" name="btnUsergroupSave" id="btnUsergroupSave">Save</button>
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Update" name="btnUsergroupUpdate" id="btnUsergroupUpdate">Update</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
<br/>
        <?php
			if(isset($_POST['btnUsergroupSave']) && $_POST['btnUsergroupSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{ 
					if(trim($_POST['txtUserName']) != "" && trim($_POST['txtPassword']) != "" && trim($_POST['selUserGroupCode']) != "" && trim($_POST['txtBranchNumber']) != "" && trim($_POST['txtDepartmentNumber']) != ""){
					    date_default_timezone_set('Asia/Colombo');
                        //echo ."-".trim($_POST['txtisLending'])."-".trim($_POST['txtisSaving']);
                        $isDeposit = 0;
                        $isLending = 0;
                        $isSaving = 0;
                        
                        $isDeposit = isset($_POST['txtisDeposit']) ? 1 : 0;
                        $isLending = isset($_POST['txtisLending']) ? 1 : 0;
                        $isSaving = isset($_POST['txtisSaving']) ? 1 : 0;
                        /*if(isset($_POST['txtisDeposit'])){
                            $isDeposit = trim($_POST['txtisDeposit']);
                        }
                        if(isset($_POST['txtisSaving'])){
                            $isLending =  trim($_POST['txtisSaving']);
                        }
                        if(isset($_POST['txtisLending'])){
                            $isSaving = trim($_POST['txtisLending']);
                        }*/
                       // echo $isDeposit."-".$isLending."-".$isSaving;
                        
                        $addsq1="INSERT INTO user(`userName`,`userID`,`password`,`NIC`,`EPF`,`HRIS`,`email`,`usergroupNumber`,`userStat`,`accountStat`,`branchNumber`,`deparmentNumber`,`enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`,`CDB_SAVINGS_ACCOUNT`,`GSMNO` ,`isDeposit`,`isLending`,`isSaving`) 
                                           VALUES('".trim($_POST['txtUserName'])."','".trim($_POST['txtUserID'])."',MD5('".trim($_POST['txtPassword'])."'),'".trim($_POST['txtNIC'])."','".trim($_POST['txtEPF'])."','".trim($_POST['txtHRIS'])."','".trim($_POST['txtEmail'])."','".trim($_POST['selUserGroupCode'])."','A','N','".trim($_POST['txtBranchNumber'])."','".trim($_POST['txtDepartmentNumber'])."','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now(),'".trim($_POST['txtAcc'])."','".trim($_POST['txtGSM'])."','".$isDeposit."','".$isLending."','".$isSaving."');";
						$query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
                        $addsql2="INSERT INTO `user_password_handling`(`userName`,`userID`,`restBy`,`restDateTime`,`password`)VALUES ('".trim($_POST['txtUserName'])."','".trim($_POST['txtUserID'])."','".$_SESSION['user']."',now(),MD5('".$_POST['txtPassword']."'));";
                        $query2 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
                        
                        if(trim($_POST['selUserGroupCode']) == "ug00016"){
                             $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                VALUES ('".trim($_POST['txtGSM'])."',CONCAT('CDB SmartOps alert!".chr(10)."CDB SmartOps USER LOGIN.".chr(10)."User ID : ".trim($_POST['txtUserName']).chr(10)."Password : ".trim($_POST['txtPassword']).chr(10)."', now()),now(),'CDB SmartOps','USERLOGIN',0);";
                             $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
                             
                               
                            $sql_branch = "SELECT getBranchName('".trim($_POST['txtBranchNumber'])."') FROM dual" ;
                            $query_branch = mysqli_query($conn,$sql_branch)   or die(mysqli_error($conn));
                            while($rec_branch = mysqli_fetch_array($query_branch)){
                                $brn = $rec_branch[0];
                            }
                               
                            /*$addsqlMailGen = "INSERT INTO `mail_queue` (`jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`) 
                                                                 VALUES( now(), '".$_SESSION['user']."', 'sachini@patpat.lk', 'Marketing Officer Enrollment - SmartOps', 'USER ID : ".trim($_POST['txtUserName']). " (".$_POST['txtUserID'].") <br/> BRANCH : ".$brn." <br/>GSM : ".trim($_POST['txtGSM'])." <br/> NEW STATUS : A', 'thushith@patpat.lk;rizvi.kareem@cdb.lk')";
                            $queryMailGen = mysqli_query($conn, $addsqlMailGen) or die(mysqli_error($conn));  */
                        }
                       
                        
						if($query1){
						    // Commit transaction
					        mysqli_commit($conn);
                            
							echo "<script> alert('Record Saved!'); </script>";
                             //echo "<script>pageClose();</script>";
						}else{
						    mysqli_rollback($conn);
							echo "<script> alert('Record not Saved!');</script>";
						}
					}else{
					    mysqli_rollback($conn);
						echo "<script> alert('Please enter complete details!');</script>";
					}
					
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			}
	
			if(isset($_POST['btnUsergroupUpdate']) && $_POST['btnUsergroupUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
                    date_default_timezone_set('Asia/Colombo');
					$newContac = trim($_POST['txtUserName'])."|".trim($_POST['txtUserID'])."|".trim($_POST['txtNIC'])."|".trim($_POST['txtEPF'])."|".trim($_POST['txtHRIS'])."|".trim($_POST['txtEmail'])."|".trim($_POST['selUserGroupCode'])."|".trim($_POST['txtBranchNumber'])."|".trim($_POST['txtDepartmentNumber'])."|".trim($_POST['txtAcc']);
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `userName`,`userID`,`NIC`,`EPF`,`HRIS`,`email`,`usergroupNumber`,`branchNumber`,`deparmentNumber`,`CDB_SAVINGS_ACCOUNT` FROM `user` WHERE userName = '".trim($_POST['txtUserName'])."';";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
					
                    $userG = $rec1[7];
                    $userD = $rec1[8];   
					$concat = $rec1[0]."|".$rec1[1]."|".$rec1[2]."|".$rec1[3]."|".$rec1[4]."|".$rec1[5]."|".$rec1[6]."|".$rec1[7]."|".$rec1[8]."|".$rec1[9];
			 		}
					if(trim($_POST['txtUserName']) != "" && trim($_POST['selUserGroupCode']) != "" && trim($_POST['txtBranchNumber']) != "" && trim($_POST['txtDepartmentNumber']) != ""){
					    
                        $addsql2="UPDATE user 
                                  SET userID = '".trim($_POST['txtUserID'])."' , 
                                      NIC = '".trim($_POST['txtNIC'])."' , 
                                      EPF = '".trim($_POST['txtEPF'])."' , 
                                      HRIS = '".trim($_POST['txtHRIS'])."', 
                                      email = '".trim($_POST['txtEmail'])."', 
                                      usergroupNumber = '".trim($_POST['selUserGroupCode'])."', 
                                      userStat = '".trim($_POST['selUserStat'])."',
                                      branchNumber = '".trim($_POST['txtBranchNumber'])."', 
                                      deparmentNumber = '".trim($_POST['txtDepartmentNumber'])."', 
                                      modifiedBy = '".$_SESSION['user']."', 
                                      modifiedDateTime = now(), 
                                      authoriedBy = '".$_SESSION['user']."', 
                                      authoriedDateTime = now(),
                                      CDB_SAVINGS_ACCOUNT = '".trim($_POST['txtAcc'])."', 
                                      GSMNO = '".trim($_POST['txtGSM'])."'
                                  WHERE userName = '".trim($_POST['txtUserName'])."'";
						$quary2 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
						if(!$quary2){
						    mysqli_rollback($conn);
							echo "<script> alert('Updated not success!');</script>";
						}else{
							$table = "user";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
                             if(trim($_POST['selUserStat']) != "A"){
                                $sql_update = "UPDATE scat_03 AS sc3
                                SET sc3.scat_state_3 = 0
                                WHERE sc3.DefuserID = '".trim($_POST['txtUserName'])."';";
                                //echo $sql_update;
                                $queryupdate = mysqli_query($conn, $sql_update) or die(mysqli_error($conn)); 
                             }
    
                             if($userG != trim($_POST['txtBranchNumber']) && $userD != trim($_POST['txtDepartmentNumber'])){
                                $sql_update = "UPDATE scat_03 AS sc3
                                SET sc3.scat_state_3 = 0
                                WHERE sc3.DefuserID = '".trim($_POST['txtUserName'])."';";
                                //echo $sql_update;
                                $queryupdate = mysqli_query($conn, $sql_update) or die(mysqli_error($conn)); 
                             }
                             
                        if(trim($_POST['selUserGroupCode']) == "ug00016"){
                               
                            $sql_branch = "SELECT getBranchName('".trim($_POST['txtBranchNumber'])."') FROM dual" ;
                            $query_branch = mysqli_query($conn,$sql_branch)   or die(mysqli_error($conn));
                            while($rec_branch = mysqli_fetch_array($query_branch)){
                                $brn = $rec_branch[0];
                            }
                               
                            $addsqlMailGen = "INSERT INTO `mail_queue` (`jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`) 
                                                                 VALUES( now(), '".$_SESSION['user']."', 'sachini@patpat.lk', 'Marketing Officer Enrollment - SmartOps', 'USER ID : ".trim($_POST['txtUserName']). " (".$_POST['txtUserID'].") <br/> BRANCH : ".$brn." <br/>GSM : ".trim($_POST['txtGSM'])." <br/> NEW STATUS : ".trim($_POST['selUserStat'])."', 'thushith@patpat.lk;rizvi.kareem@cdb.lk')";
                            $queryMailGen = mysqli_query($conn, $addsqlMailGen) or die(mysqli_error($conn));  
                        }
      	                    // Commit transaction
					        mysqli_commit($conn);
							echo "<script> alert('Updated success!');</script>";
                            echo "<script>pageClose();</script>";
						}
					}else{
					    mysqli_rollback($conn);
						echo "<script> alert('Please enter complete details!'); </script>";
					}
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			}
		?>
<div id="outer">
		
</div>
<div id="conten">
    <p class="topline">Search branch
     <input style="margin-left:310px; font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
    </p>
    <?php
		ShowGrid($conn,"SELECT `branchNumber`,`branchName` FROM `branch`",'txtBranchNumber','txtBranchNumber1','popup(0)','branch','txt1','txt2','NULL');			
     ?>
       
</div>
</form>
</body>
</html>