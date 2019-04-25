<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: User Group Management
Purpose			: To Create User Group
Author			: Madushan Wikramaarachchi
Date & Time		: 4.32 P.M 18/08/2014 (Modified)
                : 2.38 P.M 08/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P001";
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

    <title>User Group Management</title>

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
		var url = "getagentids.php?param=";
		var idValue = document.getElementById("txtUsergroupNumber").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse() {
			if (http.readyState == 4) {
				results = http.responseText.split(",");
				document.getElementById('txtUsergroupNumber').value = results[0].trim();
				document.getElementById('txtUsergroupName').value = results[1].trim();
				//document.getElementById('agtel').value = results[2];
				//document.getElementById('agid').value = results[3];
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
					<label class="col-sm-2">User Group ID : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUsergroupNumber" name="txtUsergroupNumber" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="User Group ID" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">User Group Name : *</label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtUsergroupName" name="txtUsergroupName" value="" maxlength="50" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="User Group Name" />
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
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Delete" name="btnUsergroupDelete" id="btnUsergroupDelete">Delete</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>

        <?php
			if(isset($_POST['btnUsergroupSave']) && $_POST['btnUsergroupSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if((trim($_POST['txtUsergroupNumber']) != "") && (trim($_POST['txtUsergroupName']) != "")){
					   date_default_timezone_set('Asia/Colombo');
						$addsq1="INSERT INTO usergroup(`usergroupNumber`, `usergroupName`, `enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`) 
                                    VALUES('".trim($_POST['txtUsergroupNumber'])."','".trim($_POST['txtUsergroupName'])."','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now());";
						$query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
						if($query1){
							mysqli_commit($conn);
                            echo "<script> alert('Record saved!');</script>";
							echo "<script>pageClose();</script>";
						}else{
                            mysqli_rollback($conn);
							echo "<script> alert('Record not saved!');</script>";
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
			
            if(isset($_POST['btnUsergroupUpdate']) && $_POST['btnUsergroupUpdate']=="Update" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					 date_default_timezone_set('Asia/Colombo');
					$newContac = trim($_POST['txtUsergroupNumber'])."|".trim($_POST['txtUsergroupName']);
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `usergroupNumber`,`usergroupName` FROM `usergroup` WHERE usergroupNumber = '".trim($_POST['txtUsergroupNumber'])."'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = $rec1[0]."|".$rec1[1];
			 		}
					if((trim($_POST['txtUsergroupNumber']) != "") && (trim($_POST['txtUsergroupName']) != "")){
					  
						$addsql2="UPDATE usergroup 
								  SET usergroupName = '".trim($_POST['txtUsergroupName'])."' ,
                                      modifiedBy = '".$_SESSION['user']."',
                                      modifiedDateTime = now(),
                                      authoriedBy='".$_SESSION['user']."',
                                      authoriedDateTime =now()
								  WHERE usergroupNumber = '".trim($_POST['txtUsergroupNumber'])."';";
						$quary12 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
						if(!$quary12){
						    mysqli_rollback($conn);
							echo "<script> alert('Updated not success!'); </script>";
						}else{
							$table = "usergroup";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
                            mysqli_commit($conn);
							echo "<script> alert('Updated success!'); </script>";	
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
		?>
        <?php
			 if(isset($_POST['btnUsergroupDelete']) && $_POST['btnUsergroupDelete']=="Delete" ){
			 	// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if(trim($_POST['txtUsergroupNumber']) != ""){
						$addsql3 = "DELETE FROM `cdberp`.`usergroup` WHERE `usergroup`.`usergroupNumber` = '".trim($_POST['txtUsergroupNumber'])."'";
						$quary13 = mysqli_query($conn,$addsql3) or die(mysqli_error($conn));
						if(!$quary13){
						    mysqli_rollback($conn);
							echo "<script> alert('Deleted not success!');	</script>";
							$_SESSION['txtUsergroupNumber']="";			
						}else{
						   mysqli_commit($conn);
							echo "<script> alert('Deleted success!');	</script>";	
                            echo "<script>pageClose();</script>";
						}
					}else{
						echo "<script> alert('enter User group number!');	</script>";	
					}
					// Commit transaction
					
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			 }	
		?>
<hr />
<div class="panel panel-default">
                <div class="panel-heading">
                    User Group table
                </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table  id="myTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group Code</th>
                                        <th>Group Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $select_group = "SELECT ause.usergroupNumber , ause.usergroupName FROM usergroup AS ause;";
                                    $quary_group = mysqli_query($conn , $select_group);
                                    $x = 1;
                                    while($result_group = mysqli_fetch_array($quary_group)){
                                        echo "<tr title='".$result_group[0]."|".$result_group[1]."' onclick='getdate(title);'>";
                                        echo "<td>".$x."</td>";
                                        echo "<td>".$result_group[0]."</td>";
                                        echo "<td>".$result_group[1]."</td>";
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
$(document).ready(function() {
    $('#example').DataTable();
} );
function getdate(title){
    //alert(title);
    var [m,n]= title.split('|');
    document.getElementById('txtUsergroupNumber').value = [m];
    document.getElementById('txtUsergroupName').value = [n];
}
</script>
</body>
</html>