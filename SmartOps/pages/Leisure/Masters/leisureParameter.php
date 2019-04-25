<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Leisure Parameter
Purpose			: To Create Booking parameter
Author			: Madushan Wikramaarachchi
Date & Time		: 3:55 AM 12/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/m/001";
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
<title>Leisure Parameter</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<style type="text/css">
.linetop{
    color: #FFFFFF;
    font-family: sans-serif;
    font-size: 12px;
}
</style>
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
   function chak(){
		var em = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(document.getElementById('txtFromMail').value.length >0){
			if(!document.getElementById('txtFromMail').value.match(em)){
				alert("Plase only enter yyyyyyy@ghj.com");
				document.getElementById('txtFromMail').value ="";
				return false;
			}
			
		}else{
			
		}
        if(document.getElementById('txtToMail').value.length >0){
			if(!document.getElementById('txtToMail').value.match(em)){
				alert("Plase only enter yyyyyyy@ghj.com");
				document.getElementById('txtToMail').value ="";
				return false;
			}
			
		}else{
			
		}
		return true;
	}
</script>
<!-- Ends  function here -->

</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;" onsubmit="return chak()">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<?php
    $sql_para = "SELECT `force_booking`, `booking_open_period_day`, `booking_null_colour`, `booking_pending_colour`, `booking_active_colour`, `num_of_rooms`, `num_of_aduls_max`, `num_of_children_max`, `audit_pre_user`, `module_version`, `from_mail`, `to_mail`, `Max_days_per_user`, `msg_view`, `room_chg`, `max_booking`, `cancellation_chg`, `season_max_date`,`entire_Bungalow_rate`,`check_in_time`,`check_out_time`,`dinner_time`,`Datediff`,`repircolor`,`whocanModify` FROM `leisure_parameter`";
    $query_para = mysqli_query($conn,$sql_para);
     while ($rec_para = mysqli_fetch_array($query_para)) {
?>
<table>
  <tr>
    <td style="width:200px;"><p class="linetop">Force Booking :</p></td>
    <td>
        <select class="box_decaretion" id="txtforcebooking" name="txtforcebooking"  onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <?php
                if($rec_para[0] == "YES"){
            ?>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
            <?php
                }else{
            ?>  
                    <option value="NO">NO</option>
                    <option value="YES">YES</option>
            <?php
                }
            ?>
        </select>
	</td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Booking Open Period Day :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width: 75px;" type="text" class="box_decaretion" name="txtBookingOpenPeriodDay" id="txtBookingOpenPeriodDay" maxlength="3" value="<?php echo $rec_para[1]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Booking Null Colour :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;background:<?php echo $rec_para[2]; ?>;" type="text" class="box_decaretion" name="txtBookingNullColor" id="txtBookingNullColor" maxlength="7" value="<?php echo $rec_para[2]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Booking Pending Colour :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;background:<?php echo $rec_para[3]; ?>;" type="text" class="box_decaretion" name="txtBookingPendingColor" id="txtBookingPendingColor" maxlength="7" value="<?php echo $rec_para[3]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>

  <tr>
    <td style="width:200px;"><p class="linetop">Booking Active Colour :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;background:<?php echo $rec_para[4]; ?>;" type="text" class="box_decaretion" name="txtBookingActiveColor" id="txtBookingActiveColor" maxlength="7" value="<?php echo $rec_para[4]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  
  <!-- Added by Rizvi on 03-03-2016 to show the force booking color -->
  <tr>
    <td style="width:200px;"><p class="linetop">Force Booking Colour :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;background:<?php echo $rec_para[23]; ?>;" type="text" class="box_decaretion" name="txtForceBkColor" id="txtForceBkColor" maxlength="7" value="<?php echo $rec_para[23]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  
  <tr>
    <td style="width:200px;"><p class="linetop">Number Of Rooms :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtNumOfRoom" id="txtNumOfRoom" maxlength="1" value="<?php echo $rec_para[5]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Number Of Aduls Max :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtNumOfAduls" id="txtNumOfAduls" maxlength="2" value="<?php echo $rec_para[6]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Number Of Children Max :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtNumOfChildren" id="txtNumOfChildren" maxlength="2" value="<?php echo $rec_para[7]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Audit Pre User :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtAuditPerUser" id="txtAuditPerUser" maxlength="2" value="<?php echo $rec_para[8]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Module Version :</p></td>
    <td>
  		<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:150px;" type="text" class="box_decaretion" name="txtModuleVersion" id="txtModuleVersion" maxlength="20" value="<?php echo $rec_para[9]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">From Mail :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:250px;" type="text" class="box_decaretion" name="txtFromMail" id="txtFromMail" maxlength="50" value="<?php echo $rec_para[10]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">To Mail :</p></td>
    <td>
   	    <input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:250px;" type="text" class="box_decaretion" name="txtToMail" id="txtToMail" maxlength="50" value="<?php echo $rec_para[11]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Max Days Per User :</p></td>
    <td>
   	    <input title="consecutive numbers days for a booking"  <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtMaxDaysPerUser" id="txtMaxDaysPerUser" maxlength="2" value="<?php echo $rec_para[12]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Messege View :</p></td>
    <td>
    	<textarea title="This is the message will appear in the room bookng page" <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly=readonly"; ?> cols="60" rows="4" class="box_decaretion" name="messegeView" id="messegeView" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"><?php echo $rec_para[13]; ?></textarea>
    </td>
  </tr>
   <tr>
    <td style="width:200px;"><p class="linetop">Room Charges :</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtRoomCharges" id="txtRoomCharges" maxlength="10" value="<?php echo $rec_para[14]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Max Booking Per User  :</p></td>
    <td>
    	<input title="Number of approved booking per year for an employee"  <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtMaxBookingPerUser" id="txtMaxBookingPerUser" maxlength="1" value="<?php echo $rec_para[15]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Cancellation Charges:</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtCancellationChg" id="txtCancellationChg" maxlength="10" value="<?php echo $rec_para[16]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Season Max Dates:</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:50px;" type="text" class="box_decaretion" name="txtSeasonMaxDate" id="txtSeasonMaxDate" maxlength="3" value="<?php echo $rec_para[17]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Entire Bungalow Charges:</p></td>
    <td>
    	<input title="This will be used to calcuate the booking amount"  <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtEntireBungalow" id="txtEntireBungalow" maxlength="100" value="<?php echo $rec_para[18]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  
  <tr>
    <td style="width:200px;"><p class="linetop">Check In Time:</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtCheckInTime" id="txtCheckInTime" maxlength="5" value="<?php echo $rec_para[19]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Check Out Time:</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtCheckOutTime" id="txtCheckOutTime" maxlength="5" value="<?php echo $rec_para[20]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Dinner Closing Time:</p></td>
    <td>
    	<input <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtDinnerTime" id="txtDinnerTime" maxlength="5" value="<?php echo $rec_para[21]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Date Diff:</p></td>
    <td>
    	<input title="This will be used to get the payment calculation. Possible values 0,1" <?php  echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:75px;" type="text" class="box_decaretion" name="txtDateDff" id="txtDateDff" maxlength="1" value="<?php echo $rec_para[22]; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  <tr>
    <td style="width:200px;"><p class="linetop">Who Can modify:</p></td>
    <td>
    	<input title="Only this IDs can make the changes to parameters" <?php echo in_array($_SESSION['user'], explode(',',$rec_para[24]))?"":"readonly"; ?> style="width:500px;" type="text" class="box_decaretion" name="txtWhoCanMod" id="txtWhoCanMod" maxlength="160" value="<?php echo $rec_para[24]; ?>" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
</table>
<?php
    }
?>
<br />
<input type="submit" class="buttonManage" style="width: 100px;" name="btnlp" id="btnlp" value="Save"/>
<input type="button" class="buttonManage" style="width: 100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
 <?php
	if(isset($_POST['btnlp']) && $_POST['btnlp']=='Save'){
		// Set autocommit to off
		mysqli_autocommit($conn,FALSE);
		try{
			$sql_update_para ="UPDATE `leisure_parameter` 
                                    SET `force_booking`='".trim($_POST['txtforcebooking'])."', 
                                        `booking_open_period_day`='".trim($_POST['txtBookingOpenPeriodDay'])."', 
                                        `booking_null_colour`='".trim($_POST['txtBookingNullColor'])."', 
                                        `booking_pending_colour`='".trim($_POST['txtBookingPendingColor'])."', 
                                        `booking_active_colour`='".trim($_POST['txtBookingActiveColor'])."', 
                                        `num_of_rooms`='". trim($_POST['txtNumOfRoom'])."', 
                                        `num_of_aduls_max`='".trim($_POST['txtNumOfAduls'])."',
                                        `num_of_children_max`='".trim($_POST['txtNumOfChildren'])."',
                                        `audit_pre_user`='".trim($_POST['txtAuditPerUser'])."',
                                        `module_version`='".trim($_POST['txtModuleVersion'])."',
                                        `from_mail`='".trim($_POST['txtFromMail'])."',
                                        `to_mail`='".trim($_POST['txtToMail'])."',
                                        `Max_days_per_user`='".trim($_POST['txtMaxDaysPerUser'])."',
                                        `msg_view`='".$_POST['messegeView']."',
                                        `room_chg`='".trim($_POST['txtRoomCharges'])."',
                                        `max_booking`='".trim($_POST['txtMaxBookingPerUser'])."',
                                        `cancellation_chg` = '".trim($_POST['txtCancellationChg'])."',
                                        `season_max_date` = '".trim($_POST['txtSeasonMaxDate'])."',
                                        `entire_Bungalow_rate` = '".trim($_POST['txtEntireBungalow'])."',
                                        `check_in_time` = '".trim($_POST['txtCheckInTime'])."',
                                        `check_out_time`  = '".trim($_POST['txtCheckOutTime'])."',
                                        `dinner_time`  = '".trim($_POST['txtDinnerTime'])."',
                                        `repircolor`  = '".trim($_POST['txtForceBkColor'])."',
                                        `Datediff`  = '".trim($_POST['txtDateDff'])."',
                                        `whocanModify` = '".trim($_POST['txtWhoCanMod'])."';";
            $quary_approed  = mysqli_query($conn,$sql_update_para) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            
            if(!$quary_approed){
                 echo "<script> alert('Record not Saved!');</script>";
            }else{
                $sqlHist = "insert into leisure_parameter_hist (force_booking, booking_open_period_day, booking_null_colour, booking_pending_colour, booking_active_colour, num_of_rooms, num_of_aduls_max, num_of_children_max, audit_pre_user, module_version, from_mail, to_mail, Max_days_per_user, msg_view, room_chg, max_booking, cancellation_chg, season_max_date, entire_Bungalow_rate, check_in_time, check_out_time, dinner_time, Datediff, repircolor, whocanModify, BagalowID, moduser, modon) SELECT leisure_parameter.*,'".$_SESSION['user']."',now() FROM leisure_parameter;";
                $quary_sqlHist  = mysqli_query($conn,$sqlHist) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                if(!$quary_sqlHist){
                    echo "<script> alert('Record not Saved!');</script>";
                }
                else{
                    echo "<script> alert('Record Saved!');</script>";
                    echo "<script> pageClose();</script>";
                }
            }
			
			// Commit transaction
			mysqli_commit($conn);
		}catch(Exception $e){
			// Rollback transaction
			mysqli_rollback($conn);
		    echo 'Message: '.$e->getMessage();
		}
	}
?>
 
</form>
</body>
</html>
