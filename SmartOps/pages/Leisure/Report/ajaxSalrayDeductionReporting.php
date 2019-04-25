<?php
    $fromDateGet = $_REQUEST['fromDate'];
    $toDateGet = $_REQUEST['toDate'];
    $userIDGet = $_REQUEST['userID'];

    $Where_1 = ($fromDateGet == '') ? '' :"leisure_header.fromDate >= '$fromDateGet'";    
    $Where_2 = ($toDateGet == '') ? ''   :"leisure_header.toDate <= '$toDateGet'";
    $Where_3 = ($userIDGet == '') ? ''   :"leisure_header.userName like '$userIDGet%'";
    
    if($Where_1=="" && $Where_2==""&& $Where_3=="")
        $Where = "";
    else{
        $Where = $Where_1;
        if($Where!="" ||$Where_2!=""||$Where_3!="" ){
            if($Where_2!=""){
                if($Where!="")
                    $Where = $Where." AND ".$Where_2;
                else
                    $Where = $Where_2;
            }
                
            if($Where_3!=""){
                if($Where!="")
                    $Where = $Where." AND ".$Where_3;
                else
                    $Where = $Where_3;
            }
        }
    }
     
    if($Where!="")
        $Where = "WHERE leisure_header.userName = user.userName AND (leisure_header.state = 'A' || leisure_header.state = 'C') AND ".$Where;
    else
        $Where = "WHERE leisure_header.userName = user.userName AND (leisure_header.state = 'A' || leisure_header.state = 'C')";
    
    include('../../../php_con/includes/db.ini.php');
     $sql_selct_header = "select leisure_header.bookingId,
	   leisure_header.userName,
	   user.userID,
	   leisure_header.fromDate,
	   leisure_header.toDate,
	   leisure_header.numOfRooms,
	   leisure_header.numOfAduls,
	   leisure_header.numOfChildren,
	   leisure_header.state,
	   IF(leisure_header.state = 'A', if(leisure_header.entire_bunglow_booked = 'YES', leisure_parameter.entire_Bungalow_rate * (DATEDIFF(`toDate`,`fromDate`) + leisure_parameter.Datediff) , leisure_parameter.room_chg * leisure_header.numOfRooms * (DATEDIFF(`toDate`,`fromDate`) + leisure_parameter.Datediff)), 0.00) as amountA,
	   IF(leisure_header.state = 'C', leisure_parameter.cancellation_chg * leisure_header.numOfRooms * (DATEDIFF(`toDate`,`fromDate`) + leisure_parameter.Datediff),0.00 ) as amountC,
	   user.CDB_SAVINGS_ACCOUNT
from leisure_header,leisure_parameter,user ".$Where;
    //echo $sql_selct_header;                        
    $quary_selct_header = mysqli_query($conn,$sql_selct_header);
    $index = 0; 
?>
 <table class="tbl1" border="1" cellpadding='0' cellspacing='0'>
      <tr style="background: #888888 ;">
        <td style="text-align:left;  width:50px;"><label style="margin-left: 5px;">#</label></td>
        <td style="text-align:left; width:80px;"><label style="margin-left: 5px;">Booking ID</label></td>
        <td style="text-align:left; width:80px;"><label style="margin-left: 5px;">User ID</label></td>
        <td style="text-align:left; width:280px;"><label style="margin-left: 5px;">User Name</label></td>
        <td style="text-align:left; width:70px;"><label style="margin-left: 5px;">From Date</label></td>
        <td style="text-align:left; width:70px;"><label style="margin-left: 5px;">To Date</label></td>
        <td style="text-align:right; width:40px;"><label style="margin-left: 5px;">No. of Rooms</label></td>
        <td style="text-align:right; width:40px;"><label style="margin-left: 5px;">No. Of Adults</label></td>
        <td style="text-align:right; width:40px;"><label style="margin-left: 5px;">No. Of Children</label></td>
        <td style="text-align:left; width:65px;"><label style="margin-left: 5px;">Status</label></td>
        <td style="text-align:right; width:90px;"><label style="margin-left: 0px;">&nbsp;&nbsp;&nbsp;Booking Charges</label></td>
        <td style="text-align:right; width:75px;"><label style="margin-left: 0px;">Cancellation Charges</label></td>
        <td style="text-align:right; width:120px;"><label style="margin-left: 0px;">Account Number</label></td>
      </tr>
<?php
    while($rec_selct_header = mysqli_fetch_array($quary_selct_header)){
        $index++;
        $str = $rec_selct_header[2]=='P'?'Pending':($rec_selct_header[8]=='A'?'Authorized':($rec_selct_header[8]=='C'?'Cancelled':'Rejected'));
        $sql_chg = "SELECT `room_chg`,`cancellation_chg` FROM `leisure_parameter`";
        $quary_chg = mysqli_query($conn,$sql_chg);
        while($rec_chg = mysqli_fetch_array($quary_chg)){
            $auh_chg = $rec_chg[0];
            $can_chg = $rec_chg[1];
        }
 ?>
       <tr>
        <td style="text-align:right; width:50px;"> <label style="margin-right:5px;"><?php echo $index; ?></label></td>
        <td style="text-align:left;  width:80px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[0]; ?></label></td>
        <td style="text-align:left;  width:80px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[1]; ?></label></td>
        <td style="text-align:left;  width:280px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[2]; ?></label></td>
        <td style="text-align:left;  width:70px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[3]; ?></label></td>
        <td style="text-align:left;  width:70px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[4]; ?></label></td>
        <td style="text-align:right; width:40px;"> <label style="margin-right:5px;"><?php echo $rec_selct_header[5]; ?></label></td>
        <td style="text-align:right; width:40px;"> <label style="margin-right:5px;"><?php echo $rec_selct_header[6]; ?></label></td>
        <td style="text-align:right; width:40px;"><label style="margin-right:5px;"><?php echo $rec_selct_header[7]; ?></label></td>
        <td style="text-align:left;  width:65px;"><label style="margin-left:5px;"> <?php echo $str; ?></label></td>
        <td style="text-align:right;  width:90px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[9]; ?></label></td>
        <td style="text-align:right;  width:75px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[10]; ?></label></td>
        <td style="text-align:right;  width:120px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[11]; ?></label></td>
        </tr>
 <?php		   
    }
?>
</table>