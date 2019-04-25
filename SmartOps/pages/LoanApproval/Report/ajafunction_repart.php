<?php
    if(isset($_REQUEST['date1']) && isset($_REQUEST['date2'])){
       // echo $_REQUEST['date1']."--".$_REQUEST['date2'];
        loanApproval_issur_report(trim($_REQUEST['date1']),$_REQUEST['date2']);
        
    }
    
    //.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
    
    function loanApproval_issur_report($date1,$date2){
        $conn = DatabaseConnection();
        $sql_report = "SELECT `loan_cdb_helpdesk`.`helpid` , 
                              `loan_cdb_helpdesk`.`enterDateTime`, 
			                  `loan_product`.`product_name`,
                              `loan_cdb_helpdesk`.`issue`, 
                              `loan_cdb_helpdesk`.`ssb_facility_amount` , 
                              `loan_cdb_helpdesk`.`enterBy`,
                 			  `branch`.`branchName`, 
                              `deparment`.`deparmentName`, 
                              `loan_cdb_helpdesk`.`asing_by` , 
                              `loan_cdb_helpdesk`.`ssb_type` ,
              				  (SELECT MAX(hn1.enterDateTime)
                								FROM loan_cdb_help_note AS hn1
                								WHERE hn1.helpid = `loan_cdb_helpdesk`.`helpid` AND
                											hn1.note_discr LIKE 'Pending Notified%') AS Pending ,
              				  (SELECT MAX(hn2.enterDateTime)
                								FROM loan_cdb_help_note AS hn2
                								WHERE hn2.helpid = `loan_cdb_helpdesk`.`helpid` AND
                											hn2.note_discr LIKE 'File re-submitted%') AS forwarded ,
              				  (SELECT MAX(hn3.enterDateTime) 
                							FROM loan_cdb_help_note AS hn3
                							WHERE hn3.helpid  = `loan_cdb_helpdesk`.`helpid` AND
                										hn3.note_discr LIKE 'File Approved%') AS Approved ,
              				   (SELECT MAX(hn4.enterDateTime) 
                							FROM loan_cdb_help_note AS hn4
                							WHERE hn4.helpid  = `loan_cdb_helpdesk`.`helpid` AND
                										hn4.note_discr LIKE 'File Reject%') AS Reject
                 FROM `loan_cdb_helpdesk`, `loan_product` , `branch`, `deparment`
                 WHERE `loan_cdb_helpdesk`.`scat_code_2` = `loan_product`.`product_id` AND
                       `loan_cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
                       `loan_cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
                			  DATE(`loan_cdb_helpdesk`.enterDateTime) BETWEEN '".$date1."' AND '".$date2."'
                       ORDER BY `loan_cdb_helpdesk`.`helpid`;";
        $que_report = mysqli_query($conn,$sql_report) or die(mysqli_error($conn));
        echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='font-size: 12px; margin-left: 10px;'>
              <tr>
      	 <th style='text-align:left; padding-left:5px;'>#</th>
         <th style='text-align:left; padding-left:5px;'>Help ID</th>
         <th style='text-align:left; padding-left:5px;'>Entry Date</th>
         <th style='text-align:left; padding-left:5px;'>Loan type</th>
         <th style='text-align:left; padding-left:5px;'>Client name</th>
         <th style='text-align:left; padding-left:5px;'>Loan amount</th>
         <th style='text-align:left; padding-left:5px;'>Entry By</th>
         <th style='text-align:left; padding-left:5px;'>Branch</th>
         <th style='text-align:left; padding-left:5px;'>Department</th>
         <th style='text-align:left; padding-left:5px;'>Assigned To</th>
         <th style='text-align:left; padding-left:5px;'>Current Status</th>
         <th style='text-align:left; padding-left:5px;'>Pending Notified On</th>
         <th style='text-align:left; padding-left:5px;'>File Re-Submitted On</th>
         <th style='text-align:left; padding-left:5px;'>Approval Date</th>
         <th style='text-align:left; padding-left:5px;'>Rejection Date</th>
         <th style='text-align:left; padding-left:5px;'>Elapsed Time</th>
      </tr>";
        $x = 1;
        while($res_report = mysqli_fetch_array($que_report)){
            echo "<tr style='background-color: #FFFFFF;'> 
                  	 <td style='text-align:left; padding-left:5px;'>".$x."</td>
                  	 <td style='text-align:left; padding-left:5px;'>".$res_report[0]."</td>
                  	 <td style='text-align:left; padding-left:5px;'>".$res_report[1]."</td>
                  	 <td style='text-align:left; padding-left:5px;'>".$res_report[2]."</td>
                  	 <td style='text-align:left; padding-left:5px;'>".$res_report[3]."</td>
                     <td style='text-align:left; padding-left:5px;'>".number_format($res_report[4], 2)."</td>
                     <td style='text-align:left; padding-left:5px;'>".$res_report[5]."</td>
                     <td style='text-align:left; padding-left:5px;'>".$res_report[6]."</td>
                     <td style='text-align:left; padding-left:5px;'>".$res_report[7]."</td>
                     <td style='text-align:left; padding-left:5px;'>".($res_report[8] != "" ? $res_report[8] : "-")."</td>
                     <td style='text-align:left; padding-left:5px;'>".$res_report[9]."</td>
                     <td style='text-align:left; padding-left:5px;'>".($res_report[10] != "" ? $res_report[10] : "-")."</td>
                     <td style='text-align:left; padding-left:5px;'>".($res_report[11] != "" ? $res_report[11] : "-")."</td>
                     <td style='text-align:left; padding-left:5px;'>".($res_report[12] != "" ? $res_report[12] : "-")."</td>
                     <td style='text-align:left; padding-left:5px;'>".($res_report[13] != "" ? $res_report[13] : "-")."</td>
                     <td style='text-align:left; padding-left:5px;'>";
                     $dteStart = new DateTime($res_report[1]); 
                     if($res_report[12] != ""){
                         $dteEnd   = new DateTime($res_report[12]); 
                         $interval  = $dteStart->diff($dteEnd);
                        // print $dteDiff->format("%H:%I:%S"); 
                         $elapsed = $interval->format('%Y-%m-%d %H:%i:%s');
                         echo $elapsed;
                     }else if($res_report[13] != ""){
                         $dteEnd   = new DateTime($res_report[13]);
                          $interval  = $dteStart->diff($dteEnd);
                          //print $dteDiff->format("%H:%I:%S"); 
                           $elapsed = $interval->format('%Y-%m-%d %H:%i:%s');
                         echo $elapsed;
                     }else{
                        echo "-";
                        //$dteStart = "0000-00-00 00:00:00";
                        //$dteEnd = "0000-00-00 00:00:00";
                     }
                  /*  $datetime1 = new DateTime();
$datetime2 = new DateTime('2011-01-03 17:13:00');
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %S seconds');
echo $elapsed;*/
                    
                     echo"</td>
                  </tr>";
                  
            $x++;
        }
        echo "</table>";
        
       
    }


?>