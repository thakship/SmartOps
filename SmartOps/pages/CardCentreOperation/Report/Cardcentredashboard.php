<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Card Centre Dashboard
Purpose			: Details of Debit card request 
Author			: Nilanka Chameera
Date & Time		: 11.37 P.M 15/03/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/r/001";
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
    include('../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php');
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Debit Card Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../CardCentreOperation_DEVELOPMENT/CSS/CardCentreOperation_Style_Sheet.css" />
<style type="text/css">
  
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CardCentreOperation_DEVELOPMENT/JAVASCRIPT_FUNCTION/CardCentreOperation_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>

</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<fieldset>
<legend><label class="linetop">System Overview</label></legend>

<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;"></span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Info</span></td> 
        <td style="width:75px;"></td>
    </tr>
    <tr>
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">1</span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Total System Entered Applications</span></td> 
        <td style="width:75px;">
            <?php
                $result = $conn->query("select count(*) from card_header c where c.CARD_STATE != 'Data Migrate';");
                $row = $result->fetch_row();
                echo $row[0];
            ?>
        </td>
    </tr>
        <tr>
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">2</span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Total of Rejected Applications</span></td> 
        <td style="width:75px;">
            <?php
                $result = $conn->query("select count(*) from card_header c where c.CARD_STATE = 'Application - Reject';");
                $row = $result->fetch_row();
                echo $row[0];
            ?>
        </td>
        
    </tr>
        <tr>
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">3</span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Total Com_bank sent Applications</span></td> 
        <td style="width:75px;">
            <?php
                $result = $conn->query("select count(*) from card_header c where c.CARD_STATE != 'Data Migrate' AND  c.COM_SENT_ON <> '0000-00-00 00:00:00';");
                $row = $result->fetch_row();
                echo $row[0];
            ?>
        </td>
        
    </tr>
    <tr>
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">4</span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Total Branch Sent Applications</span></td> 
        <td style="width:75px;">
            <?php
                $result = $conn->query("select count(c.HEADER_ID) from card_header c where c.CARD_STATE != 'Data Migrate' AND  c.BRANCH_SENT_ON <> '0000-00-00 00:00:00';");
                $row = $result->fetch_row();
                echo $row[0];
            ?>
            
        </td>
    </tr>
    <tr>
        <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">5</span></td>
        <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Total Client Issue Applications</span></td> 
        <td style="width:75px;">
             <?php
                $result = $conn->query("select count(c.HEADER_ID) from card_header c where c.CARD_STATE != 'Data Migrate' AND  c.CLIENT_ISS_ON != '0000-00-00 00:00:00';");
                $row = $result->fetch_row();
                echo $row[0];
            ?>
            
        </td>
    </tr>
    
    
</table>
</fieldset>



</form>
</body>
</html>