<?php
    function DoValidation($User,$FromDate,$ToDate,$NumRooms,$CurrentYear,$dateDiffGet,$conn,$cunDate){
        $sqlParamInfo = "SELECT `season_max_date`,`Max_days_per_user`, `booking_open_period_day`,`max_booking`,`Datediff` FROM `leisure_parameter`";
        $QryParamInfo = mysqli_query($conn,$sqlParamInfo);
        $MaxDaysSeason = 0;
        $MaxDaysOffSeason = 0;
        $max_OpenPeriod =0;
        $max_BookingPerYear =0;
        $DateDiff=0;
        while ($RecParamInfo = mysqli_fetch_array($QryParamInfo)){
      	  $MaxDaysSeason      = $RecParamInfo[0]; 
          $MaxDaysOffSeason   = $RecParamInfo[1];
          $max_OpenPeriod     = $RecParamInfo[2];
          $max_BookingPerYear = $RecParamInfo[3];
          $DateDiff           = $RecParamInfo[4];  
        }
            
      
		$SQL_CMMMember = "SELECT IsCMMMember FROM `user` WHERE `userName`='$User'";
        $QR_SQL_CMMMember = mysqli_query($conn,$SQL_CMMMember);
        $IsCmmMember = 0;
        while ($RS_QR_SQL_CMMMember = mysqli_fetch_array($QR_SQL_CMMMember)){
  		    $IsCmmMember = $RS_QR_SQL_CMMMember[0]; 
        }      
		
        $IsError = "S";
        $returnValue = "";

        //Check the user has pending booking requests ......................
        if(GetPendingBooking($User,$conn)>0){
            $IsError = "E";
            $returnValue = "You have pending Request to be authorized.";  
        }
        
        //Check the user have any avaiable booking days for a year 
        if($IsError!="E"){
            $FromDate1 = new DateTime($FromDate); //Get the User selected from date
            $ToDate1   = new DateTime($ToDate);   //Get the User selected from date

            //Current Year Stamp            
            $Current_Year_Start = $FromDate1->format('Y')."-01-01"; //$CurrentYear
            $Current_Year_End   = $FromDate1->format('Y')."-12-31";
            $FromDateCr = new DateTime($Current_Year_Start); //Get the User selected from date
            $ToDateCr   = new DateTime($Current_Year_End);   //Get the User selected from date
            
            if(GetAuthBooking($User,$conn,$FromDateCr->format('Y-m-d'),$ToDateCr->format('Y-m-d')) >= $max_BookingPerYear )
            {
				if($IsCmmMember ==0){ //This Rule will apply only to the Non CMM Employees
					$IsError = "E";
					$returnValue = "You have already utilized the maximum booking per year. (Parameter: $max_BookingPerYear)";  
				}
              } 
        }


        //Check the room availability for a given date ......................
        if($IsError!="E"){
            $date_getVal = str_replace('-', '/', $FromDate);
            for($loop=0;$loop <$dateDiffGet; $loop++){
                $CurrentDateVal = date('Y-m-d',strtotime($date_getVal."+".$loop." days"));
                if ($NumRooms > GetAvailableRoom($CurrentDateVal,$conn)){
                    $IsError = "E";
                    $returnValue = "Requested numbers of rooms are not available for the Day : ".$CurrentDateVal;
                } 
            }
        }

        //Off Season        
        if($IsError!="E"){
            $FromDate1 = new DateTime($FromDate); //Get the User selected from date
            $ToDate1   = new DateTime($ToDate); //Get the User selected from date
            $monthFrom = $FromDate1->format('m');
            $monthTo = $ToDate1->format('m');
            
            if($monthFrom=='04'||$monthFrom=='08'||$monthFrom=='12'||$monthTo=='04'||$monthTo=='08'||$monthTo=='12') {
                if($dateDiffGet > $MaxDaysSeason){
                    $IsError = "E";
                    $returnValue = "You have exceeded the maximum allowed number of days(seasonal). (Parameter: $MaxDaysSeason Days)";  
                }
            }
            else{
                if($dateDiffGet > $MaxDaysOffSeason){
                    $IsError = "E";
                    $returnValue = "You have exceeded the maximum allowed number of days. (Parameter: $MaxDaysOffSeason Days)";  
                }
            }
        }
        
        if($IsError!="E"){
            $ToDate1 = new DateTime($ToDate); //Get the User selected from date
            $cunDate1 = new DateTime($cunDate); //Get the User selected to date
            if(IsPeriodOpen($ToDate1->format('Y-m-d') ,$cunDate1->format('Y-m-d'),$conn)==0){
                $IsError = "E";
                $returnValue = "Requested period is not open.";  
            }
        }
        
         if($IsError!="E"){
            $fromD = new DateTime($FromDate); //Get the User selected from date
            $cunD = new DateTime($cunDate); //Get the User selected to date
            if(IsBackDate($fromD->format('Y-m-d') ,$cunD->format('Y-m-d'),$conn)==0){
                $IsError = "E";
                $returnValue = "Only Future Dates are Allowed.";  
            }
        }
        return $IsError."|".$returnValue;
    }
    
    function GetAvailableRoom($CurrentDateVal_get,$conn){
        //$sql_numRomm_date = "SELECT sum(`numOfRooms`) FROM `leisure_detels` WHERE `bookDate`='$CurrentDateVal_get'";
        $sql_numRomm_date = "select sum(mis.rm) from (SELECT `numOfRooms` as rm FROM `leisure_detels` WHERE `bookDate`='$CurrentDateVal_get' union all SELECT 5 FROM `leisure_force_booking` WHERE `fromdate`='$CurrentDateVal_get') mis";
        $quary_numRomm_date = mysqli_query($conn,$sql_numRomm_date);
        $room_num = 0;
        while ($rec_numRomm_date = mysqli_fetch_array($quary_numRomm_date)){
  			   $room_num = $rec_numRomm_date[0]; 
        }
        
        $sql_max_room = "SELECT `num_of_rooms` FROM `leisure_parameter`";
        $quary_max_room = mysqli_query($conn,$sql_max_room);
        $roomCount = 0;
        while ($rec_max_room = mysqli_fetch_array($quary_max_room)){
  			   $roomCount = $rec_max_room[0]; 
        }
        return $roomCount - $room_num;
    }

		
    function GetPendingBooking($User,$conn){
        $sql_pendinCount = "SELECT count(`userName`) FROM `leisure_header` WHERE `userName`='$User' AND `state` ='P'";
        $quary_pendinCount = mysqli_query($conn,$sql_pendinCount);
        $pending_num = 0;
        while ($rec_pendinCount = mysqli_fetch_array($quary_pendinCount)){
  			   $pending_num = $rec_pendinCount[0]; 
        }
        return $pending_num;
    }

    
    function GetAuthBooking($User,$conn,$fdt, $fto){
        $sql_pendinCount = "SELECT count(`userName`) FROM `leisure_header` WHERE `userName`='$User' AND `fromDate` >=  '$fdt' AND `toDate` <= '$fto' AND `state` ='A'";
        $quary_pendinCount = mysqli_query($conn,$sql_pendinCount);
        $pending_num = 0;
        while ($rec_pendinCount = mysqli_fetch_array($quary_pendinCount)){
  			   $pending_num = $rec_pendinCount[0]; 
        }
        return $pending_num;
    }
    
    
    function IsPeriodOpen($BookingToDate,$ServerDate,$conn){
        // $cunDate --> Serverdate
        $sql_max_OpenPeriod = "SELECT `booking_open_period_day` FROM `leisure_parameter`";
        $quary_max_OpenPeriod = mysqli_query($conn,$sql_max_OpenPeriod);
        $max_OpenPeriod = 0;
        while ($rec_max_OpenPeriod = mysqli_fetch_array($quary_max_OpenPeriod)){
  			   $max_OpenPeriod = $rec_max_OpenPeriod[0]; 
        }
        $MaximumOpenDate = date('Y-m-d',strtotime($ServerDate." +". $max_OpenPeriod ." days")); 
        if($BookingToDate>$MaximumOpenDate)
            return 0;
        else 
            return 1;
    }
    
     function IsBackDate($BookingFromDate,$ServerDate,$conn){
        // $cunDate --> Serverdate
        if($BookingFromDate>=$ServerDate)
            return 1;
        else 
            return 0;
    }
?>