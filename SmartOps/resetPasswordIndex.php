<?php
	session_start();
	include('php_con/includes/db.ini.php');
	include('php_con/includes/sequr.php');
?>
<!doctype html>
<html class="no-js" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- /Meta Data -->
        <!-- Site Icon -->
        <link rel="shortcut icon" href="images/icons/favicon.ico" />
        <!-- /Site Icon -->
        <!-- Stylesheets -->
        <link href="CSS/bootstrap.css" rel="stylesheet" type='text/css' media="screen, all" />
        <link href="CSS/fonts.css" rel="stylesheet" type='text/css' media="screen, all" />
        <link href="CSS/smart_stayl.css" rel="stylesheet" type='text/css' media="screen, all" />
        <!-- /Stylesheets -->
        <!-- Top Load Java Scripts -->
        <script type="text/javascript" src="javascript/modernizr.js"></script>
        <!-- /Top Load Java Scripts -->
        <!-- /Make HTML5 Elements Work in IE 6/7/8  -->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- /Make HTML5 Elements Work in Old IE 6/7/8 -->
        <script type="text/javascript" src="javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/bootstrap.js"></script>
<link href="CSS/index.css" type="text/css" rel="stylesheet"/>
<script>
	function validatePass()
		{
			if(document.getElementById('txtusername').value == '')
				{
					alert("Enter Username ! ");
					//document.getElementById('txtusername').focus();
					return false;
				}
			
			if(document.getElementById('txtpassword').value == false)
				{
					alert("Enter Password");
					//document.getElementById('txtpassword').focus();
					return false;
				}
            if(document.getElementById('txtpassword1').value != document.getElementById('txtpassword2').value)
				{
					alert("Both new passwords much match.");
					document.getElementById('txtpassword2').value ="";
					return false;
				}
			return true;
		}
		function chak(){
			var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/;
			if(!document.getElementById('txtpassword1').value.match(re)){
				alert("- matches a string of 8 or more characters.\n - that contains at least one digit is shorthand for [0-9]). \n - at least one uppercase and one lowercase character. \n - at least one symbol !@#$%^&*");
				document.getElementById('txtpassword1').value ="";
				return false;
			}
			return true;
		}
</script>
</head>

<body class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-wrap">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" onsubmit="return chak()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="User ID" name="txtusername"  id="txtusername" value="<?php echo $_GET['uName']; ?>" autofocus="autofocus" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Old Password" name="txtpassword" id="txtpassword" value="" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="New Password" name="txtpassword1" id="txtpassword1" value="" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Confirm Password" name="txtpassword2" id="txtpassword2" value="" />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-md btn-success btn-block" name="btnDone1" value="Login" onclick="return validatePass()" />
                                <!--<a href="include/sequr.php?" class="btn btn-lg btn-success btn-block" onclick="return validatePassword()">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
    <?php
							if(isset($_POST['btnDone1']) && $_POST['btnDone1']=='Login'){	
								// Set autocommit to off
								mysqli_autocommit($conn,FALSE);
								try{
									$user = $_POST['txtusername'];
									$oldpass = $_POST['txtpassword'];
									$pass  = $_POST['txtpassword1'];
									$sql="select * from user where userName='".$user."'";
									$result=mysqli_query($conn,$sql) or die (mysqli_error($conn));
									//$num_rows=mysql_num_rows($result); 
									//echo $num_rows; 
									if($result){
										$row=mysqli_fetch_assoc($result);
										if($row){
											if($pass!=""){
												if(md5($oldpass)==$row['password']){
													$_SESSION['user']=$user;
													$_SESSION['usergroupNumber']= $row['usergroupNumber'];
													$_SESSION['userID']= $row['userID'];
													$_SESSION['userBranch'] = $row['branchNumber'];
													$_SESSION['userDepartment'] = $row['deparmentNumber'];
													$_SESSION['userEmail'] = $row['email'];
													$IP=$_SERVER["REMOTE_ADDR"];
                                                    $_SESSION['userIP'] = $_SERVER["REMOTE_ADDR"];
													$sqlUpInfo="UPDATE user SET ip='".$_SESSION['userIP']."',lastlog =now(),password = MD5('".$pass."'),accountStat = 'A' where userName='".$user."'";
													$result = mysqli_query($conn,$sqlUpInfo) or die(mysql_error($conn));
													//mysql_query("UPDATE user SET login_count = 0 WHERE username = '$user'");
													header('Location:logout.php');
                                                    // header('Location:index.php');
												}else{
													echo "<script> alert('Incorrect Password!'); </script>";
												}
											}else{
												echo "<script> alert('Enter new password!'); </script>";
											}
										}
									}else{
										echo "<script> alert('Invalid User Name!'); </script>";
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
</body>
</html>