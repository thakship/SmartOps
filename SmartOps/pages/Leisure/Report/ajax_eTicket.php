<?php

    $fromDateGet = $_REQUEST['fromDate'];
    $toDateGet   = $_REQUEST['toDate'];
    $userIDGet   = $_REQUEST['userID'];
    $RePrint     = $_REQUEST['reprint'];

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
        $Where = " WHERE leisure_header.userName = user.userName AND leisure_header.state='A' AND ".$Where;
    else
        $Where = " WHERE leisure_header.userName = user.userName AND leisure_header.state='A'";
        
    if($RePrint=="REPRINT")
        $Where =$Where . " AND leisure_header.print_by <> ''";
    else
        $Where =$Where . " AND leisure_header.print_by = ''";         
    
    include('../../../php_con/includes/db.ini.php');
     $sql_selct_header = "select leisure_header.bookingId,
	   leisure_header.userName,
	   user.userID,
	   leisure_header.fromDate,
	   leisure_header.toDate,
	   leisure_header.numOfRooms,
	   leisure_header.numOfAduls,
	   leisure_header.numOfChildren,
	   leisure_header.state
from leisure_header,leisure_parameter,user".$Where;
    //echo $sql_selct_header;                        
    $quary_selct_header = mysqli_query($conn,$sql_selct_header);
    $index = 0; 
?>
 <table class="tbl1" border="1" cellpadding='0' cellspacing='0'>
      <tr style="background: #888888 ;">
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;"><label style="margin-left: 5px;">#</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:80px;"><label style="margin-left: 5px;">Booking ID</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:80px;"><label style="margin-left: 5px;">User ID</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;"><label style="margin-left: 5px;">User Name</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:80px;"><label style="margin-left: 5px;">From Date</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:80px;"><label style="margin-left: 5px;">To Date</label></td>
        <td style="text-align:right; padding-top:5px; padding-bottom:5;width:60px;"><label style="margin-left: 5px;">No. of Rooms</label></td>
        <td style="text-align:right; padding-top:5px; padding-bottom:5;width:60px;"><label style="margin-left: 5px;">No. Of Adults</label></td>
        <td style="text-align:right; padding-top:5px; padding-bottom:5;width:60px;"><label style="margin-left: 5px;">No. Of Children</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:80px;"><label style="margin-left: 5px;">Status</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:40px;"><label style="margin-left: 5px;">Print</label></td>
      </tr>
<?php
    while($rec_selct_header = mysqli_fetch_array($quary_selct_header)){
        $index++;
        $str = $rec_selct_header[8]=='P'?'Pending':($rec_selct_header[8]=='A'?'Authorized':($rec_selct_header[8]=='C'?'Cancelled':'Rejected'));
 ?>
       <tr>
        <td style="text-align: right; width:50px;"><label style="margin-right: 5px;"><?php echo $index; ?></label></td>
        <td style="text-align:left;   width:80px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[0]; ?></label>
         <div style='display:none;'>
                <input type='text' name='txta<?php echo $index; ?>' id='txta<?php echo $index; ?>' value='<?php echo  $rec_selct_header[0]; ?>'/>
            </div></td>
        <td style="text-align:left;   width:80px;"><label style="margin-left:5px;"> <?php echo $rec_selct_header[1]; ?></label>
        <div style='display:none;'>
                <input type='text' name='txtb<?php echo $index; ?>' id='txtb<?php echo $index; ?>' value='<?php echo  $rec_selct_header[1]; ?>'/>
        </div></td>
        <td style="text-align:left;   width:300px;"><label style="margin-left:5px;"><?php echo $rec_selct_header[2]; ?></label></td>
        <td style="text-align:left;   width:80px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[3]; ?></label></td>
        <td style="text-align:left;   width:80px;"><label style="margin-left: 5px;"><?php echo $rec_selct_header[4]; ?></label></td>
        <td style="text-align:right;  width:60px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[5]; ?></label></td>
        <td style="text-align:right;  width:60px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[6]; ?></label></td>
        <td style="text-align:right;  width:60px;"><label style="margin-right: 5px;"><?php echo $rec_selct_header[7]; ?></label></td>
        <td style="text-align:left;   width:80px;"><label style="margin-left: 5px;"><?php echo $str; ?></label></td>
            <td style="text-align:left;   width:40px;"><label style="margin-left: 5px;">
                <img src="../../../img/print.png" style="margin-top:3px;" title="txta<?php echo $index; ?>|txtb<?php echo $index; ?>" onclick="DoPrinteTicket(title);" />&nbsp;&nbsp;
            </td>
        </tr>
 <?php		   
    }
?>
</table>
