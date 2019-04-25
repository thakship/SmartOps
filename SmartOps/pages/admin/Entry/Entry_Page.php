<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Page Management
Purpose			: To Create Page
Author			: Madushan Wikramaara
Date & Time		: 5.02 P.M 18/08/2014 (Modified)
                : 9.15 A.M 18/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P003";
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

    <title>Pages Management</title>

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
			try	{ 
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
		var url = "getagentids.php?param3=";
		var idValue = document.getElementById("txtPageCode").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param3=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtPageCode').value = results[0].trim();
				document.getElementById('txtPageName').value = results[1].trim();
				document.getElementById('txtPagePath').value = results[2].trim();
				document.getElementById('selPageType').value = results[3].trim();
				document.getElementById('selModuleCode').value = results[4].trim();
			}
		} 
	}
</script>
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>
<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   Page Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">Page Code : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="txtPageCode" id="txtPageCode" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="Page Code" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
				 <div class='form-group'>
					 <label class="col-sm-2">Page Name : *</label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" name="txtPageName" id="txtPageName" value="" maxlength="50" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="User Group Name" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Module Name : *</label>
                     <div class="col-sm-4">
                        <?php
                       		$addsql01="SELECT `moduleCode`,`moduleName` FROM `module`;";
                            $quary101 = mysqli_query($conn,$addsql01);
                        ?>
                         <select class="form-control" name="selModuleCode" id="selModuleCode" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                         <option value="">--Select Module Name--</option>
                         <?php
                             while ($rec = mysqli_fetch_array($quary101)) {
                                echo "<option value='".$rec[0]."'>".$rec[1]."</option>";
                             }
                        ?>
                        </select>
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Page Type : *</label>
                     <div class="col-sm-4">
                         <select class="form-control" name="selPageType" id="selPageType" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                            <option value="">--Select Page Type--</option>
                        	<option value="Masters">Masters</option>
                            <option value="Parameters">Parameters</option>
                            <option value="Entry">Entry</option>
                            <option value="Authorization">Authorization</option>
                            <option value="Report">Report</option>
                            <option value="Query">Query</option>
                            <option value="Others">Others</option>
                            <option value="User Management">User Management</option>
                            <option value="Scanning">Scanning</option>
                         </select>
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Page Path : *</label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control" name="txtPagePath" id="txtPagePath" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="Page Path" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Save" name="btnPageSave" id="btnPageSave">Save</button>
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Update" name="btnPageUpdate" id="btnPageUpdate">Update</button>
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Delete" name="btnPageDelete" id="btnPageDelete">Delete</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
<br/>
            <?php
				if(isset($_POST['btnPageSave']) && $_POST['btnPageSave']=='Save'){
					// Set autocommit to off
					mysqli_autocommit($conn,FALSE);
					try{
                        date_default_timezone_set('Asia/Colombo');
						if(trim($_POST['txtPageCode'])!= "" && trim($_POST['txtPageName']) != "" && trim($_POST['txtPagePath']) != "" && trim($_POST['selPageType']) != "" && trim($_POST['selModuleCode']) != ""){
							$addsq1="INSERT INTO pages(`pageCode`, `pageName`, `pagePath`, `pageType`, `moduleCode`,`enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`) 
                                                VALUES('".trim($_POST['txtPageCode'])."','".trim($_POST['txtPageName'])."','".trim($_POST['txtPagePath'])."','".trim($_POST['selPageType'])."','".trim($_POST['selModuleCode'])."','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now())";
							$query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
							if($query1){
							    // Commit transaction
						        mysqli_commit($conn);
								echo "<script> alert('Record Saved!');</script>";
                                echo "<script>pageClose();</script>";
							}else{
		    	                mysqli_rollback($conn);
								echo "<script> alert('Record not saved!');</script>";
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
			
			 if(isset($_POST['btnPageUpdate']) && $_POST['btnPageUpdate']=="Update" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
				    date_default_timezone_set('Asia/Colombo');
					$newContac = trim($_POST['txtPageCode'])."|".trim($_POST['txtPageName'])."|".trim($_POST['txtPagePath'])."|".trim($_POST['selPageType'])."|".trim($_POST['selModuleCode']);
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `pageCode`,`pageName`,`pagePath`,`pageType`,`moduleCode` FROM `pages` WHERE pageCode = '".trim($_POST['txtPageCode'])."'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = $rec1[0]."|".$rec1[1]."|".$rec1[2]."|".$rec1[3]."|".$rec1[4];
			 		}
					if(trim($_POST['txtPageCode']) != "" && trim($_POST['txtPageName']) != "" && trim($_POST['txtPagePath']) != "" && trim($_POST['selPageType']) != "" && trim($_POST['selModuleCode']) != ""){
                        
                    	$addsql2="UPDATE pages
                                  SET pageName = '".trim($_POST['txtPageName'])."', 
                                      pagePath='".trim($_POST['txtPagePath'])."', 
                                      pageType='".trim($_POST['selPageType'])."', 
                                      moduleCode ='".trim($_POST['selModuleCode'])."', 
                                      modifiedBy='".$_SESSION['user']."', 
                                      modifiedDateTime = now(),
                                      authoriedBy='".$_SESSION['user']."', 
                                      authoriedDateTime =now() 
                                  WHERE pageCode = '".trim($_POST['txtPageCode'])."'";
						$quary12 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
						if(!$quary12){
						    mysqli_rollback($conn);
							echo "<script> alert('Updated not success!');</script>";
						}else{
							$table = "pages";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
                            mysqli_commit($conn);
							echo "<script> alert('Updated success!');</script>";
                            echo "<script>pageClose();</script>";
						}
					}else{
					    mysqli_rollback($conn);
						echo "<script> alert('Please enter complete details!');	</script>";	
					}
					// Commit transaction
					
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			 }
             
			if(isset($_POST['btnPageDelete']) && $_POST['btnPageDelete']=="Delete" ){
					// Set autocommit to off
					mysqli_autocommit($conn,FALSE);
					try{
						$_SESSION['txtPageCode'] = trim($_POST['txtPageCode']);
						if(trim($_POST['txtPageCode']) != ""){
							$addsql3 = "DELETE FROM `cdberp`.`pages` WHERE `pages`.`pageCode` = '".trim($_POST['txtPageCode'])."'";
							$quary13 = mysqli_query($conn,$addsql3);
							if(!$quary13){
							    mysqli_rollback($conn);
								echo "<script> alert('Deleted not success!');</script>";
							}else{
							    mysqli_commit($conn);
								echo "<script> alert('Deleted success!');</script>";	
                                echo "<script>pageClose();</script>";
							}
						}else{
						    mysqli_rollback($conn);
							echo "<script> alert('Enter Page Code!');</script>";
						}
						// Commit transaction
						
					}catch(Exception $e){
						// Rollback transaction
						mysqli_rollback($conn);
						echo 'Message: '.$e->getMessage();
					}
				}
			?>
</form>
</body>
</html>