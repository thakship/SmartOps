<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Reset user password
Purpose			: To reset usre password
Author			: Madushan Wikramaarachchi
Date & Time		: 10.52 A.M 19/08/2014 (Modified)
                : 11:33 A.M 27/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P008";
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

    <title>User Password Reset</title>

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
        		} catch(ex){ 
            		try{ 
                		http = new ActiveXObject("Microsoft.XMLHTTP"); 
            		} catch (ex){ 
                		// Something went wrong 
                		alert("Your browser broke!"); 
                		return false; 
            		} 
        		}
    		}
			var url = "getagentids.php?param6=";
            var idValue = document.getElementById("txtUsername").value;
            var myRandom = parseInt(Math.random()*99999999);  // cache buster
            http.open("GET", "getagentids.php?param6=" + escape(idValue) + "&rand=" + myRandom, true);
            http.onreadystatechange = handleHttpResponse;
            http.send(null);
         	function handleHttpResponse() {
            	if (http.readyState == 4) {
                	results = http.responseText.split(",");
                    if(results[0].trim() != ""){
                        document.getElementById('txtUsername').value = results[0].trim();
                        //document.getElementById('txtPassword').value = results[1].trim();
                        document.getElementById('lblUser').innerHTML = results[2].trim();
                    }else{
                        alert('invalid User ID.');
                         document.getElementById('lblUser').innerHTML = "";
                    }
                    
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
                   Password Reset Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">User ID : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="User ID" />
				        
                    </div>
                    <label class="col-sm-8" id="lblUser" style="color: #840000;"></label>    
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">User Password : *</label>
                     <div class="col-sm-4">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="" maxlength="150" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="New Password" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Update" name="btnPasswordReset" id="btnPasswordReset">Update</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
        <?php
			if(isset($_POST['btnPasswordReset']) && $_POST['btnPasswordReset']=="Update" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if(trim($_POST['txtUsername']) != "" && trim($_POST['txtPassword']) != ""){
					    date_default_timezone_set('Asia/Colombo');
						$sql = "SELECT `userName`,`userID`,`email` FROM `user` WHERE  userName = '".trim($_POST['txtUsername'])."'";
						$result = mysqli_query($conn,$sql) or die (mysqli_error($conn));
						if(mysqli_num_rows($result) == 1){
				            while($row = mysqli_fetch_assoc($result)){
    						   $addsql2="INSERT INTO `user_password_handling`(`userName`,`userID`,`restBy`,`restDateTime`,`password`)VALUES ('".trim($_POST['txtUsername'])."','".$row['userID']."','".$_SESSION['user']. "',now(),MD5('".trim($_POST['txtPassword'])."'))";
    					       $query2 = mysqli_query($conn,$addsql2);
    						}
    						$addsql1="UPDATE user SET password = MD5('".trim($_POST['txtPassword'])."'),accountStat='N' WHERE userName = '".trim($_POST['txtUsername'])."'";
    						$query1 = mysqli_query($conn,$addsql1);
    						
    						if(!$query1 && !$query2){
    						    mysqli_rollback($conn);
    							echo "<script> alert('Updated not success!');</script>";
    						}else{
    						      // Commit transaction
    					       mysqli_commit($conn);
    							echo "<script> alert('Updated success!');</script>";
                                echo "<script>pageClose();</script>";
    						}
						}else{
						  	echo "<script> alert('User ID is Deplicet or Missing !');</script>";
						}
						
					}else{
						echo "<script> alert('Please enter complete details!');</script>";
					}	
					
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			}
		?>
</form>
</body>
</html>