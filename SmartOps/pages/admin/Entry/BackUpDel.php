<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Delete Backup Files
Purpose			: To Delete Backup Files
Author			: Madushan Wikramaarachchi
Date & Time		: 11.47 A.M 19/08/2014 (Modified)
                : 2:34 P.M 28/04/2014 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P011";
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

    <title>System Date Update</title>

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
                   Backup Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-3">To Del Uploaded CMS file click : </label>
                    <div class="col-sm-2">
   	                    <button type="submit" style="width: 100px;" class="btn btn-success" value="DELETE" name="deleteCMS" id="deleteCMS">DELETE</button>
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-3">To Del Uploaded Temp file click :  </label>
                    <div class="col-sm-2">
   	                    <button type="submit" style="width: 100px;" class="btn btn-success" value="DELETE" name="deleteTemp" id="deleteTemp">DELETE</button>
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
<?php
if(isset($_POST['deleteCMS']) && $_POST['deleteCMS']=="DELETE"){
	$files = glob('C:/uploadsCMSExcel/*'); // get all file names
	foreach($files as $file){ // iterate files
 		if(is_file($file))
    	unlink($file); // delete file
	}
	echo "<script> alert('Delete Uploaded CMS File!');</script>";
}

if(isset($_POST['deleteTemp']) && $_POST['deleteTemp']=="DELETE"){
	$files = glob('C:/wamp64/www/CDB/temp/*'); // get all file names
	foreach($files as $file){ // iterate files
 		if(is_file($file))
    	unlink($file); // delete file
	}
	echo "<script> alert('Delete Uploaded Temp File!');</script>";
}

?>
</form>

</body>
</html>