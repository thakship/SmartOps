<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: My Calendar
Purpose			: To Veiw my calender Detels
Author			: Madushan Wikramaarachchi
Date & Time		: 4:16 PM 11/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/e/003";
	$_SESSION['Module'] = "Leisure";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Leisure_DEVELOPMENT/PHP_FUNCTION/leisure_system_php_function.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Calendar</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<!-- Starts CDB User defined function here -->
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:1000px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
</style>
<!-- Ends CDB User defined function here -->
</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
   <table class="tbl1" border="1" cellpadding='0' cellspacing='0'>
      <tr style="background: #888888 ;">
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;"><label style="margin-left: 5px;">Index</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">Booking ID</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;"><label style="margin-left: 5px;">User ID</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">From Date</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">To Date</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">No. of Rooms</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">No. Of Adults</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;"><label style="margin-left: 5px;">No. Of Children</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;"><label style="margin-left: 5px;">Status</label></td>
      </tr>
<?php
    $sql_selct_header = "select leisure_header.bookingId, leisure_header.userName, leisure_header.fromDate, leisure_header.toDate, leisure_header.numOfRooms, leisure_header.numOfAduls, leisure_header.numOfChildren, leisure_header.state
                         from leisure_header 
                         where leisure_header.userName = '".$_SESSION['user']."'";
    $quary_selct_header = mysqli_query($conn,$sql_selct_header);
    $index = 0; 
    while($rec_selct_header = mysqli_fetch_array($quary_selct_header)){
        $index++;
         $str = $rec_selct_header[7]=='P'?'Pending':($rec_selct_header[7]=='A'?'Authorized':($rec_selct_header[7]=='C'?'Cancelled':'Rejected'));
 ?>
        <tr>
        <td style="text-align: right; width:50px;"><label style="margin-right: 5px;"><?php echo $index; ?></label></td>
        <td style="text-align:left;width:100px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[0]; ?></label></td>
        <td style="text-align: left; width:200px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[1]; ?></label></td>
        <td style="text-align:left;width:100px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[2]; ?></label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[3]; ?></label></td>
        <td style="text-align:right; width:100px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[4]; ?></label></td>
        <td style="text-align:right; width:100px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[5]; ?></label></td>
        <td style="text-align:right; width:150px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[6]; ?></label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left: 5px;"><?php echo $str; ?></label></td>
        </tr>
 <?php		   
    }
?>
</table>
</form>
</body>
</html>
