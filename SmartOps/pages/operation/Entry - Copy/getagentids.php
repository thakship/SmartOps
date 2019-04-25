<?php

error_reporting(0); // turns off error reporting
//include('../../../php_con/includes/db.ini.php');
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'Off');

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('CDBERP','CDBERP',$dbstr1); 
if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	//echo "Successfully connected to Oracle.\n";
}
//************************** End Oracal Database Connection*************************************************************************************
//**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 
 //*************************** End Mysql Database Connection **************************************************************************
$conn = DatabaseConnection();
$param=$_GET['param']; 
if (strlen($param) > 0) {
    $sql_user = "SELECT `userName` , `userID` FROM `user` WHERE `userName` = '".$param."';";
    $que_user = mysqli_query($conn , $sql_user);
    $cou_user = mysqli_num_rows($que_user);
    if($cou_user != 0){
        while($rec_user = mysqli_fetch_array($que_user)){
            $user = $rec_user[1];
            $sql_oci_select_db = oci_parse($dbConn, "select * from table(CDBPRODDB.PKG_CDB_ERP_LIB.FN_USERINFO(ERPUSERID => '".$param."'))");
            oci_execute($sql_oci_select_db);
            $i = 0;
            //echo "Staring to echo";
            // echo $sql_oci_select_db;
            ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
            while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
                $sql_br = "SELECT `branchNumber`,`branchName`,`br_code` FROM `branch` WHERE `br_code` = '".$row[1]."';";
                $que_br = mysqli_query($conn , $sql_br);
                $cou_br = mysqli_num_rows($que_br);
                if($cou_br != 0){
                    while($rec_br = mysqli_fetch_array($que_br)){
                        $userBranch = (int)$rec_br[2];
                        $userBranchName = $rec_br[1];
                        //$user = $param;
                        $textout .= $userBranch . ", " . $userBranchName . ", ". $user;
                    }
                }else{
                   $sql_de = "SELECT `deparmentNumber`,`deparmentName`,`br_code` FROM `deparment` WHERE `br_code` = '".$row[1]."';";
                    $que_de = mysqli_query($conn , $sql_de);
                    $cou_de = mysqli_num_rows($que_de);
                    if($cou_de != 0){
                        while($rec_de = mysqli_fetch_array($que_de)){
                            $userBranch = (int)$rec_de[2];
                            $userBranchName = $rec_de[1];
                            //$user = $param;
                            $textout .= $userBranch . ", " . $userBranchName . ", ". $user;
                        }
                    }else{
                         $textout = " , , , ," . $user;
                    }
                }
                
            }
        }
    }else{
        $textout = " , , , ," . $user;
    }
    
    
}
echo $textout;


$param1=$_GET['param1']; 
if (strlen($param1) > 0) {
    $sql_user = "SELECT `userName` , `userID` FROM `user` WHERE `userName` = '".$param1."';";
    $que_user = mysqli_query($conn , $sql_user);
    $cou_user = mysqli_num_rows($que_user);
    if($cou_user != 0){
        while($rec_user = mysqli_fetch_array($que_user)){
            $user = $rec_user[1];
           // $user = "01002276";
            $sql_oci_select_db = oci_parse($dbConn, "select * from table(CDBPRODDB.PKG_CDB_ERP_LIB.FN_USERINFO(ERPUSERID => '".$param1."'))");
            oci_execute($sql_oci_select_db);
            $i = 0;
            //echo "Staring to echo";
            // echo $sql_oci_select_db;
            ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
            $row_oci = 0;
            while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source tabl
                $getRoleID = $row[2];
                $getRoleDis = $row[3];
                $getBranch = $row[1];
                    //$textout1 .= $row[2] . ", " . $row[3] . ", ". $user; 
                    $row_oci++;
            }
            if($row_oci == 0){
               $textout1 = " , ," . $user;
                
            }else if($row_oci == 1){
                $textout1 .= $getRoleID . ", " . $getRoleDis .", ".$getBranch. ", ". $user;
            }else{
                $textout1 = " , , ,";
            }
        }
    }else{
        $textout1 = " , ," .$user;
    }
    
    
}
echo $textout1;


$param2 = $_GET['param2']; 
if (strlen($param2) > 0) {
    $sql_helpDesk_veri = "SELECT * FROM `cdb_helpdesk` WHERE `helpid` = '".$param2."';";
    $que_helpDesk_veri  = mysqli_query($conn , $sql_helpDesk_veri);
    $couhelpDesk_veri = mysqli_num_rows($que_helpDesk_veri);
    if($couhelpDesk_veri != 0){
        while($rec_helpDesk_veri = mysqli_fetch_assoc($que_helpDesk_veri)){
                $getHelpid = $rec_helpDesk_veri['helpid'];
                $getIssue = mysqli_real_escape_string($conn,$rec_helpDesk_veri['issue']);
                $getHelp_discr = mysqli_real_escape_string($conn,$rec_helpDesk_veri['help_discr']);
                $getSolution = mysqli_real_escape_string($conn,$rec_helpDesk_veri['solution']);
                $getDefPassword = mysqli_real_escape_string($conn,$rec_helpDesk_veri['defPassword']);
                $getattachment_name = $rec_helpDesk_veri['attachment_name'];
                $textout2 .= $getHelpid."|".$getIssue."|".$getHelp_discr."|".$getSolution."|".$getDefPassword."|".$getattachment_name;
        }
    }else{
        $textout2 = " |" .$param2;
    }
    
    
}
echo $textout2;

$param3 = $_GET['param3']; 
if (strlen($param3) > 0) {
    $textout3 = $param3;
    /*$sql_helpDesk_veri = "SELECT * FROM `cdb_helpdesk` WHERE `helpid` = '".$param3."';";
    $que_helpDesk_veri  = mysqli_query($conn , $sql_helpDesk_veri);
    $couhelpDesk_veri = mysqli_num_rows($que_helpDesk_veri);
    if($couhelpDesk_veri != 0){
        while($rec_helpDesk_veri = mysqli_fetch_assoc($que_helpDesk_veri)){
                $getHelpid = $rec_helpDesk_veri['helpid'];
                $getIssue = mysqli_real_escape_string($conn,$rec_helpDesk_veri['issue']);
                $getHelp_discr = mysqli_real_escape_string($conn,$rec_helpDesk_veri['help_discr']);
                $getSolution = mysqli_real_escape_string($conn,$rec_helpDesk_veri['solution']);
                $getDefPassword = mysqli_real_escape_string($conn,$rec_helpDesk_veri['defPassword']);
                $getattachment_name = $rec_helpDesk_veri['attachment_name'];
                $textout2 .= $getHelpid."|".$getIssue."|".$getHelp_discr."|".$getSolution."|".$getDefPassword."|".$getattachment_name;
        }
    }else{
        $textout3 = " |" .$param3;
    }*/
    
    
}
echo $textout3;

?>