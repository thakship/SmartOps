<?php
//@Author: Azhagupandian - wsnippets.com
function showMonth($month = null, $year = null)
{
    $conn=mysqli_connect("localhost","root","1234","cdberp");
    // Check connection
    if (mysqli_connect_errno($conn))
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	$calendar = '';
	if($month == null || $year == null) {
		$month = date('m');
		$year = date('Y');
	}
	$date = mktime(12, 0, 0, $month, 1, $year);
	$daysInMonth = date("t", $date);
	$offset = date("w", $date);
	$rows = 1;
	$prev_month = $month - 1;
	$prev_year = $year;
	if ($month == 1) {
		$prev_month = 12;
		$prev_year = $year-1;
	}
	
	$next_month = $month + 1;
	$next_year = $year;
	if ($month == 12) {
		$next_month = 1;
		$next_year = $year + 1;
	}
	$calendar .= "<div class='panel-heading text-center'><div class='row'><div class='col-md-3 col-xs-4'><a class='ajax-navigation btn btn-default btn-sm' href='calendar/calendar.php?month=".$prev_month."&year=".$prev_year."'><span class='glyphicon glyphicon-arrow-left'></span></a></div><div class='col-md-6 col-xs-4'><strong>" . date("F Y", $date) . "</strong></div>";
	$calendar .= "<div class='col-md-3 col-xs-4 '><a class='ajax-navigation btn btn-default btn-sm' href='calendar/calendar.php?month=".$next_month."&year=".$next_year."'><span class='glyphicon glyphicon-arrow-right'></span></a></div></div></div>"; 
	$calendar .= "<table class='table table-bordered'>";
	$calendar .= "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
	$calendar .= "<tr>";
	for($i = 1; $i <= $offset; $i++) {
		$calendar .= "<td></td>";
	}
	for($day = 1; $day <= $daysInMonth; $day++) {
		if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
			$calendar .= "</tr><tr>";
			$rows++;
		}
        $V_date = $year."-".$month."-".$day;
        $V_ave_bokking = "SELECT SUM(leisure_detels.numOfRooms),'A' 
                                 FROM leisure_detels, leisure_header  
                                 WHERE leisure_detels.bookingId = leisure_header.bookingId AND
                                       leisure_detels.bookDate='$V_date' AND
                                       (leisure_header.state = 'P' OR leisure_header.state = 'A')"." UNION SELECT 5,`leisure_force_booking`.`remarks` FROM `leisure_force_booking` WHERE `fromdate` = '$V_date'" ;
        //echo $V_ave_bokking;
        $quary_ave_bokking = mysqli_query($conn,$V_ave_bokking);
        while ($rec_ave_bokking = mysqli_fetch_array($quary_ave_bokking)){
  			   $ave_bokking = $rec_ave_bokking[0]; 
               $ave_bokkingT = $rec_ave_bokking[1];
        }
        $V_bokking_col = "SELECT `booking_active_colour`,`booking_pending_colour`,`booking_null_colour`,`repircolor` FROM `leisure_parameter`";
        $quary_bokking_col = mysqli_query($conn,$V_bokking_col);
        while ($rec_bokking_col = mysqli_fetch_array($quary_bokking_col)){
              //echo "ave_bokking : " . $ave_bokking." | rec_bokking_col : ".$rec_bokking_col[0];
  			  if($ave_bokking == 0){
  			       //$calendar .= "<td style='background:".$rec_bokking_col[0]." ;'>".$day."</td>";
                   $nulColu = $rec_bokking_col[2];
                   $calendar .= "<td style='background: $nulColu ;' title = 'No Booking for the day.'>".$day."</td>";
  			  }elseif($ave_bokking < 5){
  			       //$calendar .= "<td style='background:".$rec_bokking_col[1]." ;'>".$day."</td>";
                   $penColu = $rec_bokking_col[1];
                   $calendar .= "<td style='background: $penColu ;' title = 'Partially booked. (". (5 - $ave_bokking) . " remaining)'>".$day."</td>";
  			  }else{
  			       //$calendar .= "<td style='background:".$rec_bokking_col[2]." ;'>".$day."</td>";
                   $actColu = $rec_bokking_col[0];
                   if($ave_bokkingT !='A') {
                    $actColu = $rec_bokking_col[3];
                    $calendar .= "<td style='background: $actColu ;' title = '".$ave_bokkingT."'>".$day."</td>";
                   }
                   else
                    $calendar .= "<td style='background: $actColu ;' title = 'No rooms available for the day'>".$day."</td>";
  			  }
        }
        
 		//$calendar .= "<td>".$day."</td>";
        
	}
	while( ($day + $offset) <= $rows * 7)
	{
		$calendar .= "<td></td>";
		$day++;
	}
	$calendar .= "</tr>";
	$calendar .= "</table>";
	return $calendar;
}

?>