<?php
    $V_book_id = $_REQUEST['book_id'];
    $V_userID = $_REQUEST['userID'];
    $V_Date = $_REQUEST['cDate'];
    //echo $V_book_id."--".$V_userID;
    $hris = substr("$V_userID",2,7);
    include('../../../php_con/includes/db.ini.php');
    $sql_select_header = "SELECT `fromDate`,`toDate`,`numOfAduls`,`numOfChildren` FROM `leisure_header` WHERE `bookingId` ='$V_book_id'";
    $quary_select_header = mysqli_query($conn,$sql_select_header );
     while ($rec_select_header = mysqli_fetch_array($quary_select_header)){
        $fromDate = $rec_select_header[0];
        $toDate = $rec_select_header[1];
        $numOfAdu = $rec_select_header[2];
        $numOfchil = $rec_select_header[3];
     }
     $user_name = "";
     $rec_select_User = "";
     $department_user = "";
    $sql_select_User = "select user.userID ,branch.branchName, deparment.deparmentName,user.NIC from user , branch , deparment
                            where user.branchNumber = branch.branchNumber and 
                            user.deparmentNumber = deparment.deparmentNumber and user.userName = '$V_userID'";
    $quary_select_User = mysqli_query($conn,$sql_select_User);
     while ($rec_select_User = mysqli_fetch_array($quary_select_User)){
        $user_name = $rec_select_User[0];
        $branch_user = $rec_select_User[1];
        $department_user = $rec_select_User[2];
        $user_NIC = $rec_select_User[3];
     }

     $sql_select_para = "SELECT `room_chg`,`entire_Bungalow_rate`,`check_in_time`,`check_out_time`,`dinner_time` FROM `leisure_parameter`";
     $quary_select_para = mysqli_query($conn,$sql_select_para);
     while ($rec_select_para = mysqli_fetch_array($quary_select_para)){
        $room_chg = $rec_select_para[0];
        $Bungalow_rate = $rec_select_para[1];
        $ch_in = $rec_select_para[2];
        $ch_out = $rec_select_para[3];
        $dinner_time = $rec_select_para[4];
     }

?>

<div style="background-image: url('../../../img/cdbw.png');">
<label style="margin-left: 20px;font-family: Calibri;font-size: 14px;">Booking Reference Number : <?php echo $V_book_id;?>&nbsp;&nbsp;&nbsp; Date :  <?php echo $V_Date;?> </label>
<br /><br />
<table class="tbl2" border="1" cellpadding='0' cellspacing='0'>
      <tr>
        <td style="text-align: right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Name :</label></td>
        <td style="text-align:left;width:320px; font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $user_name; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">HRIS :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $hris; ?></label></td>
      </tr>   
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Branch :</label></td>
        <td style="text-align:left; width:320px;font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $branch_user; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Division :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $department_user; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">No of Guest(s) :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Adult(s) :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfAdu; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Children :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfchil ?></label></td>
      </tr>  
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Booking period :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check in :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $fromDate; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check out :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $toDate; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Payment made :</label></td>
        <td style="text-align:left; width:220px;font-family: Calibri; font-size: 12px;" >
        <table>
            <tr>
            <td style="text-align:left; width:109px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;">YES / NO</label></td>
            <td style="text-align:right; width:110px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 3px;">NIC No :</label></td>
            </tr>
        </table>
        </td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $user_NIC; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Ref. Number :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $V_book_id;?></label></td>
      </tr>   
</table>
<br />
<br />

<label style="margin-left: 20px;">...................................................</label><br />
<label style="margin-left: 80px;font-family: Calibri;font-size: 12px;">Approved</label>
<br /><br />
<label style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Terms and conditions.</label>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">It is Mandatory that the Staff member under whose name the booking is made be present with the guests at all times when occupying holiday bungalows</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Room charges would <?php echo $room_chg; ?> /= per room per day Staff can book the entire bungalow for <?php echo $Bungalow_rate; ?>/= </p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Relevant staff member will be responsible for the conduct of his/her guests and needs to bear any damages which is caused during the period of the stay by the guests.</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">The check in time will be <?php echo $ch_in; ?> a.m and the check  out time <?php echo $ch_out; ?> a.m on the respective shediled dates</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Staff members are required to produce their staff identify card and the acknowledgement form to the caretaker of the bungalow at the time of checking in.</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Staff members is required sign the Guesta&#39;s Register, indicating the details of visitors, soon after checking in.</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">The number of persons specified in the acknowledgement form, should not be exceeded under any circumstances</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">Occupants area requested to consume dinner by <?php echo $dinner_time; ?> pm the latest</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">The occupants should neither remove plants or flowers from the bungalow nor embarrass the cook/caretaker by requesting such items</p>
<p style="margin-left: 20px;font-family: Calibri; font-size: 12px;">When staying at the Holiday Bungalows staff are request to maintain minimum noise and not to disturb the other occupants in the Holiday Bungalow and or the public in the general vicinity.In this is not a exhaustive list for more information you may refer the Holiday bungalow policy document.</p>
<hr />
<table class="tbl2" border="1" cellpadding='0' cellspacing='0'>
      <tr>
        <td style="text-align: right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Name :</label></td>
        <td style="text-align:left;width:320px; font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $user_name; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">HRIS :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $hris; ?></label></td>
      </tr>   
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Branch :</label></td>
        <td style="text-align:left; width:320px;font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $branch_user; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Division :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $department_user; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">No of Guest(s) :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Adult(s) :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfAdu; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Children :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfchil ?></label></td>
      </tr>  
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Booking period :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check in :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $fromDate; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check out :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $toDate; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Payment made :</label></td>
        <td style="text-align:left; width:220px;font-family: Calibri; font-size: 12px;" >
        <table>
            <tr>
            <td style="text-align:left; width:109px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;">YES / NO</label></td>
            <td style="text-align:right; width:110px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 3px;">NIC No :</label></td>
            </tr>
        </table>
        </td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $user_NIC; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Ref. Number :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $V_book_id;?></label></td>
      </tr>   
</table>
<br />
<hr />
<table class="tbl2" border="1" cellpadding='0' cellspacing='0'>
      <tr>
        <td style="text-align: right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Name :</label></td>
        <td style="text-align:left;width:320px; font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $user_name; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">HRIS :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $hris; ?></label></td>
      </tr>   
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Branch :</label></td>
        <td style="text-align:left; width:320px;font-family: Calibri; font-size: 12px;" colspan="2"><label style="margin-left: 5px;"><?php echo $branch_user; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Division :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $department_user; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">No of Guest(s) :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Adult(s) :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfAdu; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Children :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $numOfchil ?></label></td>
      </tr>  
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Booking period :</label></td>
        <td style="text-align:right; width:220px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check in :</label></td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $fromDate; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Check out :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $toDate; ?></label></td>
      </tr> 
      <tr>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Payment made :</label></td>
        <td style="text-align:left; width:220px;font-family: Calibri; font-size: 12px;" >
        <table>
            <tr>
            <td style="text-align:left; width:109px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;">YES / NO</label></td>
            <td style="text-align:right; width:110px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 3px;">NIC No :</label></td>
            </tr>
        </table>
        </td>
        <td style="text-align:left; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $user_NIC; ?></label></td>
        <td style="text-align:right; width:100px;font-family: Calibri; font-size: 12px;"><label style="margin-right: 5px;">Ref. Number :</label></td>
        <td style="text-align:left; width:200px;font-family: Calibri; font-size: 12px;"><label style="margin-left: 5px;"><?php echo $V_book_id;?></label></td>
      </tr>   
</table>
</div>