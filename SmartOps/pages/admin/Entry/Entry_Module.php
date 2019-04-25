<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Module Management
Purpose			: To Create Module
Author			: Madushan Wikramaarachi
Date & Time		: 3.27 P.M 18/08/2014 (Modified)
                : 9:45 A.M 08/04/2014 (MOdified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P002";
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

    <title>Module Management</title>

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
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
    .tbl_with_first_col{
        width: 150px;
    }
</style>
<script language="javascript" type="text/javascript">
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
			var url = "getagentids.php?param2=";
            var idValue = document.getElementById("txtModuleCode").value;
            var myRandom = parseInt(Math.random()*99999999);  // cache buster
            http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&rand=" + myRandom, true);
            http.onreadystatechange = handleHttpResponse;
            http.send(null);
         	function handleHttpResponse(){
            	if (http.readyState == 4){
                	results = http.responseText.split(",");
                    document.getElementById('txtModuleCode').value = results[0].trim();
                    document.getElementById('txtModuleName').value = results[1].trim();
                    document.getElementById('txt_icon_code').value = results[2].trim();
                }
            } 
		}
</script> 
<style type="text/css">    
    .pg-normal {
        color: black;
        font-weight: normal;
        text-decoration: none;    
        cursor: pointer;    
    }
    .pg-selected {
        color: black;
        font-weight: bold;        
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<script type="text/javascript" src="paging.js"></script>
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
                   Module Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">Module Code : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtModuleCode" name="txtModuleCode" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="Module Code" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">Module Name : *</label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtModuleName" name="txtModuleName" value="" maxlength="50" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="Module Name" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					<label class="col-sm-2">Icon Code : *</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="txt_icon_code" name="txt_icon_code" placeholder="Icon Code"  value="" maxlength="30"/>
                    </div>
                    <label  class="col-sm-5"> ( using bootstrap icon code )</label>
				 </div>
                  <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Save" name="btnModuleSave" id="btnModuleSave">Save</button>
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Update" name="btnUsergroupUpdate" id="btnUsergroupUpdate">Update</button>
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Delete" name="btnModuleDelete" id="btnModuleDeletee">Delete</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>

<br />
<!--<input class="buttonManage" type="submit" name="btnModuleSave" id="btnModuleSave" />-->
        <?php
			if(isset($_POST['btnModuleSave']) && $_POST['btnModuleSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if(trim($_POST['txtModuleCode']) != "" && trim($_POST['txtModuleName']) != ""){
					   date_default_timezone_set('Asia/Colombo');
                       
					   $addsq1="INSERT INTO module(`moduleCode`, `moduleName`,`IconName`,`enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`) VALUES('".trim($_POST['txtModuleCode'])."','".trim($_POST['txtModuleName'])."','".trim($_POST['txt_icon_code'])."','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now());";
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
				    echo 'Message: '.$e->getMessage();
 				}
			}
		?>
<!--<input class="buttonManage" type="submit" name="btnUsergroupUpdate" id="btnUsergroupUpdate" value="Update"/>-->
        <?php
			if(isset($_POST['btnUsergroupUpdate']) && $_POST['btnUsergroupUpdate']=="Update" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
                    date_default_timezone_set('Asia/Colombo');
					$newContac = trim($_POST['txtModuleCode'])."|".trim($_POST['txtModuleName']);
					$sqlLoadStNo = "SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo = mysqli_query($conn,$sqlLoadStNo) or die(mysqli_error($conn));
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `moduleCode`,`moduleName` FROM `module` WHERE moduleCode = '".trim($_POST['txtModuleCode'])."';";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = $rec1[0]."|".$rec1[1];
			 		}
					if((trim($_POST['txtModuleCode']) != "") && (trim($_POST['txtModuleName']) != "")){
						$addsql2="UPDATE module 
                                  SET moduleName = '".trim($_POST['txtModuleName'])."' ,
                                      modifiedBy = '".$_SESSION['user']."',
                                      modifiedDateTime = now(),
                                      authoriedBy = '".$_SESSION['user']."',
                                      authoriedDateTime = now(),
                                      IconName = '".trim($_POST['txt_icon_code'])."'
                                  WHERE moduleCode = '".trim($_POST['txtModuleCode'])."';";
						$quary12 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
						
						if(!$quary12){
						    mysqli_rollback($conn);  
							echo "<script> alert('updated not success!');</script>";
						}else{
							$table = "module";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
      	                    mysqli_commit($conn);
							echo "<script> alert('Updated success!');</script>";	
                            echo "<script>pageClose();</script>";
						}
					}else{
                        mysqli_rollback($conn);
						echo "<script> alert('Please enter complete details!');</script>";
					}
					// Commit transaction
				
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			}
		?>
<!--<input class="buttonManage" type="submit" name="btnModuleDelete" id="btnModuleDeletee" value="Delete"/>-->
        <?php
			 if(isset($_POST['btnModuleDelete']) && $_POST['btnModuleDelete']=="Delete" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if(trim($_POST['txtModuleCode'])!=""){
						$addsql3 = "DELETE FROM `cdberp`.`module` WHERE `module`.`moduleCode` = '".trim($_POST['txtModuleCode'])."';";
						$quary13 = mysqli_query($conn,$addsql3) or die(mysqli_error($conn));
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
						echo "<script> alert('Enter Module code!');	</script>";
					}
					// Commit transaction
				
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: '.$e->getMessage();
				}
			 }	
		?>
<!--<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>-->
<hr />
<div class="panel panel-default">
                <div class="panel-heading">
                    Module table
                </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Module Code</th>
                                        <th>Module Name</th>
                                        <th>Item Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $select_module = "SELECT amo.moduleCode , amo.moduleName , amo.IconName FROM module AS amo;";
                                    $quary_module = mysqli_query($conn , $select_module);
                                    $x = 1;
                                    while($result_module = mysqli_fetch_array($quary_module)){
                                        echo "<tr title='".$result_module[0]."|".$result_module[1]."|".$result_module[2]."' onclick='getdate(title);'>";
                                        echo "<td>".$x."</td>";
                                        echo "<td>".$result_module[0]."</td>";
                                        echo "<td>".$result_module[1]."</td>";
                                        echo "<td>".$result_module[2]."</td>";
                                        echo "</tr>";
                                        $x++;
                                    }
                                ?>  
                                </tbody>
                            </table>
                            <div id="pageNavPosition" style="margin-left: 20px;"></div>
                        <script type="text/javascript"><!--
                                var pager = new Pager('myTable', 10); 
                                pager.init(); 
                                pager.showPageNav('pager', 'pageNavPosition'); 
                                pager.showPage(1);
                            //--></script>
                        </span>                            
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            <span id="error"></span>
</form>
<script type="text/javascript">
    function getdate(title){
            //alert(title);
            var value_get = title.split('|');
            document.getElementById('txtModuleCode').value = value_get[0];
            document.getElementById('txtModuleName').value = value_get[1];
            document.getElementById('txt_icon_code').value = value_get[2];
        }
</script>
</body>
</html>