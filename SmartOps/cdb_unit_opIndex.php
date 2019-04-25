<?php
//echo $_GET['PARENT_BRANCHNUMBER'] . " - " . $_GET['UNIT_BRANCHNUMBER'] ; 

?>
<?php
	session_start();
	include('php_con/includes/db.ini.php');
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
	
</script>
</head>

<body class="login-body">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-wrap">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Branch Selector </h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <fieldset>
                                <div class="form-group">
                                   
                                   <?php
                        			/*
                                    Commendted by Rizvi on 2:45 PM 23/10/2018
                                    $addsql01="SELECT `branchNumber`,`branchName` FROM `branch` WHERE `branchNumber` IN ('".$_GET['PARENT_BRANCHNUMBER']."','".$_GET['UNIT_BRANCHNUMBER']."');";
                                    */
                                    
                                    $addsql01="SELECT `branchNumber`,`branchName` FROM `branch` WHERE `branchNumber` = '".$_GET['PARENT_BRANCHNUMBER']."'union all SELECT `branchNumber`,`branchName` FROM `branch`,`cdb_unit_op` op  WHERE  op.`CDB_PARENT_BRANCHNUMBER` =  '".$_GET['PARENT_BRANCHNUMBER']."' and `branch`.`branchNumber` = op.CDB_UNIT_BRANCHNUMBER;";
                                    //echo  $addsql01;
                        			$quary101 = mysqli_query($conn,$addsql01);
                                  ?>
                                   <select class="form-control" name="selbranch" id="selbranch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                                     <?php
                                         while ($rec1 = mysqli_fetch_array($quary101)){
                            			 	echo "<option value='".$rec1[0]."'>".$rec1[1]."</option>";
                                            
                            			 }
                                    ?>
                                     </select>
                                </div>
                               
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
                                    <input type="submit" style="margin-left: 20px;" class="btn btn-md btn-success" name="btnsubmit" id="btnsubmit" value="Login" />
                                    <input type="submit" class="btn btn-md btn-success" name="btnlogout" id="btnlogout"  value="Logout"/>
                                </div>
                                <!--<a href="include/sequr.php?" class="btn btn-lg btn-success btn-block" onclick="return validatePassword()">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
    <?php
							if(isset($_POST['btnsubmit']) && $_POST['btnsubmit']=='Login'){	
								// Set autocommit to off
								mysqli_autocommit($conn,FALSE);
								try{
								    $_SESSION['userBranch'] = $_POST['selbranch'];
                                    $sqlSelectDepartment = "SELECT `deparmentNumber`,`deparmentName`,getBranchName(`branchNumber`) FROM `deparment` WHERE `branchNumber` = '".$_POST['selbranch']."'";
							        $Query_SELECT_DEpartment = mysqli_query($conn,$sqlSelectDepartment);
                                    while($rec_SELECTDEPARTMNET = mysqli_fetch_array($Query_SELECT_DEpartment)){
                                        $_SESSION['userDepartment'] = $rec_SELECTDEPARTMNET[0];
                                        $_SESSION['userBranchName'] = $rec_SELECTDEPARTMNET[2];
                                         mysqli_query($conn,"UPDATE user SET ip='".$_SESSION['userIP']."', lastlog =now() , login_count = '0' WHERE userName = '".$_SESSION['user']."'") or die(mysqli_error($conn));
            							//mysql_query("UPDATE user SET login_count = 0 WHERE username = '$user'");
                                         header('Location:pages/home.php');
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