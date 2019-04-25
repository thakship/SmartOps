<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: System Date Update
Purpose			: To Update System time
Author			: Madushan Wikramaara
Date & Time		: 1.14 P.M 18/08/2014 (Modified)
                : 2:34 P.M 28/04/2014 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P009";
	$_SESSION['Module'] = "Admin";
	include('../../pageasses.php');
	$ass = cakepageaccess();
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
 <div style='display:none;'>
    <input type="text" name="txtUN" id="txtUN" value="<?php echo $_SESSION['user']; ?>"  onkeypress="return disableEnterKey(event)" required="required"/>
 </div> 
<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   System Date Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">Current Date :</label>
                    <div class="col-sm-2">
                   	<?php 
            			$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
            			$add = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    					while ($rec = mysqli_fetch_array($add)){
    						$dateNow = $rec[0];;
    					}
 	                ?>
                        <input type="text" class="form-control" id="txtCD1" name="txtCD1" value="<?php echo $dateNow; ?>" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="User ID" />
				        
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" value="Update" name="btnCDSave1" id="btnCDSave1" onclick="return confirmUpdate()">Update</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>

<script type="text/javascript">
	function confirmUpdate() {
		var b =document.getElementById('txtCD1').value;
		var c =document.getElementById('txtUN').value;
		//alert(b);
        var r = confirm('Are you sure you want to update date?')
		if (r==true){
			$.ajax({ 
				type:'POST', 
				data: {id : b, un : c}, 
				url: 'ajaxSystemDate.php', 
				success: function() { 
					alert('Record Updated!'); 
                    pageClose();
				}
			});	
		}else{
			//alert('BBBBB');		
		}
	}
</script>
</form>
</body>
</html>