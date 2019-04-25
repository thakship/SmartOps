<?php
include('../../../php_con/includes/db.ini.php');
if(isset($_POST['get_fromDate']) && isset($_POST['get_toDate']) && isset($_POST['get_remark']) && isset($_POST['get_userID']) && isset($_POST['getrequestBy'])){
     isUpdaterForceBooking($conn,($_POST['get_fromDate']),trim($_POST['get_toDate']),trim($_POST['get_remark']),trim($_POST['get_userID']),trim($_POST['getrequestBy']));
}

function isUpdaterForceBooking($conn,$get_fromDate,$get_toDate,$get_remark,$get_userID,$requestBy){
   // echo $get_fromDate. " - " .$get_toDate ." - " .$get_remark . " - " . $get_userID;
   if($get_fromDate != "" && $get_toDate != ""){
        date_default_timezone_set('Asia/Colombo');
        mysqli_autocommit($conn,FALSE);
        try{
         
            $dateDiff = 0;
            $date1 = date_create($get_fromDate);
            $date2 = date_create($get_toDate);
            $diff = date_diff($date1,$date2);
            $ansD =  $diff->format("%d");
            //echo "A".$ansD."B";
           
          if($ansD >= 0){
               $isProcess = true;
              for($y = 0 ; $y <= $ansD ; $y++){
                   $dateGet = date( "Y-m-d", strtotime( $get_fromDate." +".$y." day" ) ); // PHP:  2009-03-03
                  //echo $dateGet;
                  $sql_select_day = "select COUNT(*) from leisure_force_booking AS lf WHERE lf.fromdate = '".$dateGet."';";
                  $query_select_day = mysqli_query($conn,$sql_select_day) or die(mysqli_error($conn));
                  while($rec_select_day = mysqli_fetch_array($query_select_day)){
                    if($rec_select_day[0] != 0){
                        $isProcess =  false;
                        
                    }
                  }
                  
                  $sql_select_booking = "SELECT COUNT(*) FROM leisure_detels AS ld WHERE ld.bookDate = '".$dateGet."';";
                  $query_select_booking = mysqli_query($conn,$sql_select_booking) or die(mysqli_error($conn));
                  while($rec_select_booking = mysqli_fetch_array($query_select_booking)){
                    if($rec_select_booking[0] != 0){
                        $isProcess =  false;
                        
                    }
                  }
                  
              }
            
            
              if($isProcess == true){
                    for($x = 0 ; $x <= $ansD ; $x++){
                           $dateGet = date( "Y-m-d", strtotime( $get_fromDate." +".$x." day" ) ); // PHP:  2009-03-03
                          //echo $dateGet;
                          $sql_select_day = "select COUNT(*) from leisure_force_booking AS lf WHERE lf.fromdate = '".$dateGet."';";
                          $query_select_day = mysqli_query($conn,$sql_select_day) or die(mysqli_error($conn));
                          while($rec_select_day = mysqli_fetch_array($query_select_day)){
                            if($rec_select_day[0] == 0){
                                $sql_insert = "INSERT INTO `leisure_force_booking`(`fromdate`, `todate`, `remarks`, `stat`, `reqby`, `reqon`, `doneby`, `doneon`) 
                                                VALUES ('".$dateGet."', '".$dateGet."', '".$get_remark."', 1, '".$requestBy."', NOW(), '".$get_userID."', NOW())";
                                //echo $sql_insert."<br/>";
                                $query_insert = mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));     
                            }
                          }
                      }
                      mysqli_commit($conn);  
                      echo "Force Booking Updated.";
              }else{
                mysqli_rollback($conn);
                echo "Same Dates are alredy Booking or Force Booking. Not Updated.";
              }
            
              
          }else{
            mysqli_rollback($conn);
            echo "Date is incorect.";  
          }
        }catch(Exception $e){
    		// Rollback transaction
    		mysqli_rollback($conn);
    		echo 'Message: ' .$e->getMessage();
    	}
   }else{
    echo "Some Data is Missing.";
   }
    
}

?>