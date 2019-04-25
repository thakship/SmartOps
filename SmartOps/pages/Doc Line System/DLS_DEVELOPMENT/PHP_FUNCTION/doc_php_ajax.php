<?php
    //.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
    if(isset($_REQUEST['srdFDate']) && isset($_REQUEST['srdTDate']) && isset($_REQUEST['srdUserBranch']) && isset($_REQUEST['srdUserDepartment'])){
        getDocumentRequestReport($_REQUEST['srdFDate'],$_REQUEST['srdTDate'],$_REQUEST['srdUserBranch'],$_REQUEST['srdUserDepartment']);
    }
    
    if(isset($_REQUEST['get_boxNumber']) && isset($_REQUEST['get_docNumber']) && isset($_REQUEST['get_docType']) && isset($_REQUEST['get_myUserID']) && isset($_REQUEST['gat_actionUser'])){
        rejectRequestDocument($_REQUEST['get_boxNumber'],$_REQUEST['get_docNumber'],$_REQUEST['get_docType'],$_REQUEST['get_myUserID'],$_REQUEST['gat_actionUser']);
    }
    // ........ Function For get Documnet Request Report ......
    function  getDocumentRequestReport($fromDate,$toDate,$usreBranch,$userDepartment){
        $conn = DatabaseConnection();
        $sql_grid = "SELECT dlsh.`box_number` , dlsh.`doc_number` , dldm.`doc_name` , dlsh.`doc_type`
                    FROM `doc_line_stat_history` dlsh, `doc_line_doc_mast` dldm
                    WHERE dlsh.`doc_number` = dldm.`doc_number` 
                    AND dlsh.`action_stat` =  'RQ'
                    AND  DATE(dlsh.`action_date_time`) BETWEEN '".$fromDate."' AND '".$toDate."'
                    AND dlsh.`branch_Numbar` = '".$usreBranch."'";
        $que_grid = mysqli_query($conn,$sql_grid);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Box Number</span></td>
                    <td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>Document Number</span></td>
                    <td style='width:400px;text-align: left;'><span style='margin-left: 5px;'>Document Name</span></td>
                    <td style='width:50px;text-align: left;'><span style='margin-left: 5px;'>Doc Type</span></td>
                </tr>";
                $a = 1;
                while($RES_grid = mysqli_fetch_array($que_grid)){
                   echo "<tr style='background-color:'>";
                   echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$a."</span></td>";
                   echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_grid[0]."</span></td>";
                   echo "<td style='width:200px;text-align: right;'><span style='margin-right: 5px;'>".$RES_grid[1]."</span></td>";
                   echo "<td style='width:400px;text-align: left;'><span style='margin-left: 5px;'>".$RES_grid[2]."</span></td>";
                   echo "<td style='width:50px;text-align: left;'><span style='margin-left: 5px;'>".$RES_grid[3]."</span></td>";
                   echo "</tr>"; 
                   $a++;
                }
        echo "</table>";
    }
    
    function rejectRequestDocument($get_boxNumber,$get_docNumber,$get_docType,$get_myUserID,$gat_actionUser){
        //echo $get_boxNumber." ".$get_docNumber." ".$get_docType." ".$get_myUserID." OK ".$gat_actionUser;
        $conn = DatabaseConnection(); // Date Base connection.
       	mysqli_autocommit($conn,FALSE);
        try{
       	  date_default_timezone_set('Asia/Colombo');
            //Update the document stack
			$sql_docUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='ST' WHERE `box_number`='".$get_boxNumber."' AND `doc_number` = '".$get_docNumber."' AND `doc_type` = '".$get_docType."' AND `action_stat`='RQ';";
			$query_docUpdate= mysqli_query($conn,$sql_docUpdate)  or die(mysqli_error($conn));
			
			//Insert new record(s) to document movement tables
			$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`) 
                                      VALUES ('".$get_boxNumber."','".$get_docNumber."','".$get_docType."',now(),'ST','".$get_myUserID."')";						
			$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(mysqli_error($conn));
            
            $to = userMail($gat_actionUser,$conn);
            //$to = userMail("01002276",$conn);
            $subject = "CDB SmartOps - Doc Line System!";
            $message = "
<html>
<head>
  <title>CDB SmartOps - Doc Line System</title>
</head>
<body>
  <p>Your Request has been rejected.</p>
  <table>
    <tr>
      <td>Box Number </td>
      <td>: ".$get_boxNumber."</td>
    </tr>
    <tr>
      <td>Document Number </td>
      <td>: ".$get_docNumber."</td>
    </tr>
    <tr>
      <td>Document Type </td>
      <td>: ".$get_docType."</td>
    </tr>
    <tr>
      <td>Action User </td>
      <td>: ".$get_myUserID."</td>
    </tr>
  </table>
</body>
</html>
";
          mysqli_commit($conn);
          // $to = 'wimukthi.madushan@cdb.lk';
          // To send HTML mail, the Content-type header must be set
if($to != ""){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    // Additional headers
    $headers .= 'From: CDB SmartOps - Doc Line System <cdberp@cdbnet.lk>' . "\r\n";
    // Mail it
    mail($to, $subject, $message, $headers);
}

if($sql_docUpdate){
    echo "1";
}else{
    echo "0";
}
               
    	}catch(Exception $e){
				mysqli_rollback($conn);
			    echo 'Message: '.$e->getMessage();
		}
            
            
    }
       
    function userMail($userId,$conn){
        $sql_email = "SELECT u.email FROM `user` AS u WHERE u.userName = '".$userId."';";
        $que_email = mysqli_query($conn, $sql_email) or die(mysqli_error($conn));
        while($rec_email = mysqli_fetch_array($que_email)){
            return $rec_email[0];
        }
    } 

?>