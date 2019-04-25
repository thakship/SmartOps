<?php
include('../../../php_con/includes/db.ini.php');
if(isset($_POST['get_fromDate']) && isset($_POST['get_toDate']) && isset($_POST['get_remark']) && isset($_POST['get_userID']) && isset($_POST['getrequestBy'])){
     isCancelForceBooking($conn,($_POST['get_fromDate']),trim($_POST['get_toDate']),trim($_POST['get_remark']),trim($_POST['get_userID']),trim($_POST['getrequestBy']));
}

function isCancelForceBooking($conn,$get_fromDate,$get_toDate,$get_remark,$get_userID,$requestBy){
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
                    if($rec_select_day[0] == 0){
                        $isProcess =  false;
                        
                    }
                  }
              }
            
            
              if($isProcess == true){
                    for($x = 0 ; $x <= $ansD ; $x++){
                           $dateGet = date( "Y-m-d", strtotime( $get_fromDate." +".$x." day" ) ); // PHP:  2009-03-03
                          //echo $dateGet;
                          $sql_select_day = "SELECT fb.fromdate , fb.todate , fb.remarks , fb.stat , fb.reqby , fb.reqon FROM leisure_force_booking AS fb WHERE fb.fromdate = '".$dateGet."';";
                          $query_select_day = mysqli_query($conn,$sql_select_day) or die(mysqli_error($conn));
                          while($rec_select_day = mysqli_fetch_array($query_select_day)){
                            if($rec_select_day[0] != ""){
                                $sql_insert = "INSERT INTO `leisure_force_booking_can`(`fromdate`, `todate`, `remarks`, `stat`, `reqby`, `reqon`, `doneby`, `doneon`, `CanRequestedBy`, `CanReason`) 
                                                                               VALUES ('".$rec_select_day[0]."', '".$rec_select_day[1]."', '".$rec_select_day[2]."', '".$rec_select_day[3]."', '".$rec_select_day[4]."', '".$rec_select_day[5]."', '".$get_userID."', NOW(), '".$requestBy."', '".$get_remark."')";
                                //echo $sql_insert."<br/>";
                                $query_insert = mysqli_query($conn,$sql_insert) or die(mysqli_error($conn)); 
                                
                                $sql_delete = "DELETE FROM `leisure_force_booking` WHERE `fromdate` = '".$dateGet."';";
                                //echo $sql_delete."<br/>";
                                $query_delete = mysqli_query($conn,$sql_delete) or die(mysqli_error($conn));
                                    
                            }
                          }
                      }
                      mysqli_commit($conn);  
                      echo "Force Booking Updated.";
              }else{
                mysqli_rollback($conn);
                echo "Same Dates are not Force Booking. Not Updated.";
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