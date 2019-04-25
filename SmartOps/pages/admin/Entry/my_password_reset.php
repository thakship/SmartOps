<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: My Password Reset
Purpose			: To Password Reset
Author			: Madushan Wikramaarachci
Date & Time		: 2.09 P.M 06/08/2015 (Modified)
                : 11:00 A.M 29/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P012";
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
<script type="text/javascript">
    function resetPassword(){
        //alert("Password Reset Function");
        var userID = document.getElementById('txtUserID').value;
        var currentPassword = document.getElementById('txtCurrentPassword').value;
        var newPassword = document.getElementById('txtNewPassword').value;
        var confirmPassword = document.getElementById('txtConfirmPassword').value;
        //alert(userID+' - '+currentPassword+' - '+newPassword+' - '+confirmPassword);
         if(userID == ''){
            alert("Enter User ID!.");
        }else if(currentPassword == ''){
            alert("Enter Current Password!.");
        }else if(newPassword == ''){
            alert("Enter New Password!.");
        }else if(confirmPassword == ''){
            alert("Enter Confirm Password!.");
        }else{
            //alert('All Data are get.');
            var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/;
	        if(!document.getElementById('txtNewPassword').value.match(re)){
                alert("- matches a string of 8 or more characters.\n - that contains at least one digit is shorthand for [0-9]). \n - at least one uppercase and one lowercase character. \n - at least one symbol !@#$%^&*");
 		        document.getElementById('txtNewPassword').value ="";
                document.getElementById('txtConfirmPassword').value = "";
   	        }else if(newPassword != confirmPassword){
   	            alert("Password are not match!.");
                document.getElementById('txtConfirmPassword').value = "";
   	        }else{
   	            $.ajax({ 
                    type:'POST', 
       				data: {get_userID : userID , get_oldPassword : currentPassword , get_newPassword : newPassword , get_confirmPasssword : confirmPassword }, 
       				url: '../ADMIN_DEVELOPMENT/PHP_FUNCTION/resetPassword_function.php', 
       				success: function(val_retn) { 
                          
                        //document.getElementById('aaaa').innerHTML = val_retn; 
                        var [m,n]= val_retn.split('|');
                        var m1 = [m];
                        var n1 = [n];
                        if(m1 == 1){
                            alert(n1);
                            window.open("../../../logout.php","_parent"); 
                        }else if(m1 == 2){
                            alert(n1);
                            document.getElementById('txtpassword1').value = "";
                            document.getElementById('txtpassword2').value = ""
                        }else{
                            alert(n1);
                            document.getElementById('txtpassword').value = "";
                            //var newPassword = document.getElementById('txtpassword1').value;
                            //var confirmPasssword = document.getElementById('txtpassword2').value;
                        }
                                
     				}
      			});
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
					<label class="col-sm-2">User ID : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUserID" name="txtUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" required="required" placeholder="User ID" />
				        
                    </div>
                    <label class="col-sm-8" id="lblUser" style="color: #840000;"><?php echo $_SESSION['userID']; ?></label>    
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">Current Password : </label>
                     <div class="col-sm-4">
                        <input type="password" class="form-control" id="txtCurrentPassword" name="txtCurrentPassword" value="" maxlength="150" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="Current Password" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">New Password : </label>
                     <div class="col-sm-4">
                        <input type="password" class="form-control" id="txtNewPassword" name="txtNewPassword" value="" maxlength="150" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="New Password" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Confirm Password : </label>
                     <div class="col-sm-4">
                        <input type="password" class="form-control" id="txtConfirmPassword" name="txtConfirmPassword" value="" maxlength="150" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" placeholder="Confirm Password" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" value="Update" onclick="resetPassword()" name="btnPasswordReset" id="btnPasswordReset">Update</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
</form>
</body>
</html>