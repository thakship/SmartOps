<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Booking Authentication
Purpose			: To Booking Management
Author			: Madushan Wikramaarachchi
Date & Time		: 9:15 AM 10/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/e/002";
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
<title>Booking Authentication</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:1090px;
        font-size: 14px;
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
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
    function get_approved(title){
        var [m,n]= title.split('|');
        var m1 = [m];
        var n1 = [n];
        var V_book_id = document.getElementById(m1).value;
        var V_userID = document.getElementById(n1).value;
        var V_userA = document.getElementById('txtUser').value;
        var r = confirm('Authorization confirmation?')
        if (r==true){
            //alert('A : YES');
			$.ajax({ 
				type:'POST', 
				data: {B_id : V_book_id,u_id:V_userID,a_id:V_userA}, 
				url: 'ajax_apoed_booking.php', 
				success: function() { 
				alert('Record authorized.'); 
                pageClose();
				}
			});	
            
        }else{
			//alert('A : NO');		
		}
    }
    
    function get_regect(title){
        var [m,n]= title.split('|');
        var m1 = [m];
        var n1 = [n];
        var V_book_id = document.getElementById(m1).value;
        var V_userID = document.getElementById(n1).value;
        var V_userA = document.getElementById('txtUser').value;
       // alert(V_book_id + " | " + V_userID + " | " + V_userA );
        var r = confirm('Rejection confirmation?')
        if (r==true){
            //alert('R : YES');
			$.ajax({ 
				type:'POST', 
				data: {B_id : V_book_id,u_id:V_userID,a_id:V_userA}, 
				url: 'ajax_reject_booking.php', 
				success: function() { 
				alert('Record rejected.'); 
                pageClose();
				}
			});	
            
        }else{
			//alert('R : NO');		
		}
    }
</script>
<!-- Ends  function here -->

</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<img src="../../../img/ok.png" style="border: solid 1px #000000; margin-left: 10px;" /><label style="font-family: sans-serif; font-size: 12px; color: #FFFFFF;"> &nbsp;&nbsp;&nbsp;: Approved  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../../img/dele.png" style="border: solid 1px #000000;"  /> &nbsp;&nbsp;&nbsp;: Rejected &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E.B &nbsp;&nbsp;&nbsp;: Entire Bungalow</label>
<br /><br />
<table class="tbl1" border="1" cellpadding='0' cellspacing='0'>
      <tr style="background: #888888 ;">
        <td style="text-align: left; width:50px;"> <label style="margin-left:5px">Index</label></td>
        <td style="text-align:left;width:80px;"><label style="margin-left:5px">Booking ID</label></td>
        <td style="text-align:left;width:80px;"><label style="margin-left:5px">User ID</label></td>
        <td style="text-align:left; width:280px;"><label style="margin-left:5px">User Name</label></td>
        <td style="text-align:left;width:100px;"><label style="margin-left:5px">From Date</label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left:5px">To Date</label></td>
        <td style="text-align:left;width:75px;"><label style="margin-left:5px">Rooms</label></td>
        <td style="text-align:left;width:75px;"><label style="margin-left:5px">Adults</label></td>
        <td style="text-align:left;width:75px;"><label style="margin-left:5px">Children</label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left:5px">Entered on</label></td>
        <td style="text-align:left;width:75px;">&nbsp;</td>
      </tr>
<?php
    $sql_selct_header = "select leisure_header.bookingId,leisure_header.userName, user.userID, leisure_header.fromDate, 
leisure_header.toDate,leisure_header.numOfRooms,leisure_header.numOfAduls,leisure_header.numOfChildren ,leisure_header.enteredDataTime
from leisure_header, user 
where leisure_header.userName = user.userName and
 leisure_header.state ='P'";
    $quary_selct_header = mysqli_query($conn,$sql_selct_header);
    $index = 0; 
    while($rec_selct_header = mysqli_fetch_array($quary_selct_header)){
        $index++;
        $sql_para_get_room = "SELECT `num_of_rooms` FROM `leisure_parameter`";
        $quary_para_get_room = mysqli_query($conn,$sql_para_get_room);
         while($rec_para_get_room = mysqli_fetch_array($quary_para_get_room)){
            if($rec_para_get_room[0] == $rec_selct_header[5]){
                $room_get = "E.B";
            }else{
                $room_get = $rec_selct_header[5];
            }
         }
        
 ?>
        <tr>
        <td style="text-align:left; width:50px;"><label style="margin-left:5px"><?php echo $index; ?></label></td>
        <td style="text-align:left; width:80px;"><label style="margin-left:5px">
            <?php echo $rec_selct_header[0]; ?>
            <div style='display:none;'>
                <input type='text' name='txta<?php echo $index; ?>' id='txta<?php echo $index; ?>' value='<?php echo  $rec_selct_header[0]; ?>'/>
            </div></label>
        </td>
        <td style="text-align:left; width:80px;"><label style="margin-left:5px">
            <?php echo $rec_selct_header[1]; ?>
            <div style='display:none;'>
                <input type='text' name='txtb<?php echo $index; ?>' id='txtb<?php echo $index; ?>' value='<?php echo  $rec_selct_header[1]; ?>'/>
            </div></label>
        </td>
        <td style="text-align:left; width:280px;"><label style="margin-left:5px"><?php echo $rec_selct_header[2]; ?></label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left:5px"><?php echo $rec_selct_header[3]; ?></label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left:5px"><?php echo $rec_selct_header[4]; ?></label></td>
        <td style="text-align:left; width:75px;"><label style="margin-left:5px"><?php echo $room_get; ?></label></td>
        <td style="text-align:left; width:75px;"><label style="margin-left:5px"><?php echo $rec_selct_header[6]; ?></label></td>
        <td style="text-align:left; width:75px;"><label style="margin-left:5px"><?php echo $rec_selct_header[7]; ?></label></td>
        <td style="text-align:left; width:100px;"><label style="margin-left:5px"><?php echo $rec_selct_header[8]; ?></label></td>
        <td style="text-align:left; width:75px;"><label style="margin-left:5px;">
        <img src="../../../img/ok.png" style="border: solid 1px #000000; margin-top:3px;" title="txta<?php echo $index; ?>|txtb<?php echo $index; ?>" onclick="return get_approved(title);" />&nbsp;&nbsp;
        <img src="../../../img/dele.png" style="border: solid 1px #000000;margin-top:3px;" title="txta<?php echo $index; ?>|txtb<?php echo $index; ?>"  onclick="return get_regect(title);"/></td>
        </label></tr>
 <?php		   
    }
?>
</table>
<div style='display:none;'>
    <input type='text' name='txtUser' id='txtUser' value='<?php echo  $_SESSION['user']; ?>'/>
</div>
</form>
</body>
</html>
