<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Approval Management
Page Name		: Credit Approval 
Purpose			: This process allows to give to credit approval in marcating file.
Author			: Madushan Wikramaarachchi
Date & Time		: 10.20 A.M 23/09/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ams/a/001";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php'); // conncet mysql databace.
    include('../../../php_con/includes/ordbcon.php'); // connect oracle Databace.
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../approval_management_DEVELOPMENT/PHP_FUNCTION/ams_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Security Printing Authorization</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../approval_management_DEVELOPMENT/approval_management_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../approval_management_DEVELOPMENT/approval_management_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<?php
    
    $stid = oci_parse($dbConn, 'SELECT * FROM cdbproddb.rizvi_01');
    oci_execute($stid);
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes 
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { //Read Oracle Source table
        echo $row[0]."<br/>";
    }
?>
</form>
</body>
</html>

