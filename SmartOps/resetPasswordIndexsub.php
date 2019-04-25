<?php
	session_start();
	include('php_con/includes/db.ini.php');
	include('php_con/includes/seqursub.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>index</title>
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

<body>
	<div id="indexWape">
    	<div id="head">
        	<div id="logo">
      			<img src="img/cdb_logo.gif" style="margin-left:5px; margin-top:5px;"/>
      		</div>
      		<div id="heading">
            	<h1 class="headding">ERP SYSTEM</h1>
      		</div>
        </div>
        <div class="line1">
    
    	</div>
        <div id="bodyTop">
    	
    	</div>
        <div class="box">
        
        </div>
        <div class="indexbody" style="height: 300px; width: 400px;">
        	<form name="frmadd" action="" method="post" onsubmit="return chak()">
                    <table>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">User ID :</h1></td>
                        <td class="frm2"><input type="text" name="txtusername" id="txtusername" readonly="readonly" value="<?php echo $_GET['uName']; ?>" style="width:150px; -webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);"/></td>
                      </tr>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">Old password :</h1></td>
                        <td class="frm2">
                        <input type="password" name="txtpassword" id="txtpassword" value="" style="width:150px;-webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);" required="required"/>
                        </td>
                      </tr>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">New password :</h1></td>
                        <td class="frm2">
                        <input type="password" name="txtpassword1" id="txtpassword1" value="" style="width:150px;-webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);" required="required"/>
                        </td>
                      </tr>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">Confirm password :</h1></td>
                        <td class="frm2">
                        <input type="password" name="txtpassword2" id="txtpassword2" value="" style="width:150px;-webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);" required="required"/>
                        </td>
                      </tr>
                      <tr>
                        <td class="frm1" style="width: 160px;">&nbsp;</td>
                        <td class="frm2">
                        <input type="submit" class="btn1" style="width: 100px;" name="btnDone1" value="Login" onclick="return validatePass()"/>
                        <?php
							if(isset($_POST['btnDone1']) && $_POST['btnDone1']=='Login'){	
								// Set autocommit to off
								mysqli_autocommit($conn,FALSE);
								try{
									$user = $_POST['txtusername'];
									$oldpass = $_POST['txtpassword'];
									$pass  = $_POST['txtpassword1'];
									$sql="select * from user where userName='$user'";
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
													$sqlUpInfo="UPDATE user SET ip='$IP',lastlog =now(),password = MD5('$pass'),accountStat = 'A' where userName='$user'";
													$result= mysqli_query($conn,$sqlUpInfo) or die(mysql_error($conn));
													//mysql_query("UPDATE user SET login_count = 0 WHERE username = '$user'");
													header('Location:logoutsub.php');
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
                        </td>
                      </tr>
                       </table>
                        <table>
                      <tr>
                        <td style="line-height: 20px;"><h1 class="name1" style=" margin-right: 5px; margin-left: 50px;">
                            Password : <br />
                            - matches a string of 8 or more characters <br />
                            - that contains at least one digit is shorthand for [0-9] <br />
                            - at least one uppercase and one lowercase character <br />
                            - at least one symbol !&nbsp;@&nbsp;#&nbsp;$&nbsp;%&nbsp;^&nbsp;&amp;&nbsp;*</h1>
                        </td>
                      </tr>
                    </table>
        	
          	</form>
        </div>
        <div class="box">
        
        </div>
        <div id="bodyfoot">
    	
    	</div>
    </div>
</body>
</html>