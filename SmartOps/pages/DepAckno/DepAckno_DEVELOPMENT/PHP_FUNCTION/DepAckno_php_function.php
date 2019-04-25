<?php 
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

//.........................................get Printout Inster in Entry.........................................................
//if(isset($_POST['getprintText']) && isset($_POST['getComment']) && isset($_POST['getUsreID']) && isset($_POST['getdepNum']) && isset($_POST['getConNum']) && isset($_POST['getUserBranch'])){ 
if(isset($_POST['getComment']) && isset($_POST['getUsreID']) && isset($_POST['getdepNum']) && isset($_POST['getConNum']) && isset($_POST['getUserBranch']) && isset($_POST['getOptionCertificate']) && isset($_POST['getiscerNum']) && isset($_POST['gettxtClient_Name'])){ 
   // echo $_POST['getprintText']."--".$_POST['getComment']."--".$_POST['getUsreID']."--".$_POST['getdepNum']."--".$_POST['getConNum'];
    //isInsertPrintLog($_POST['getprintText'],$_POST['getComment'],$_POST['getUsreID'],$_POST['getdepNum'],$_POST['getConNum'],$_POST['getUserBranch']);
    isInsertPrintLog($_POST['getComment'],$_POST['getUsreID'],$_POST['getdepNum'],$_POST['getConNum'],$_POST['getUserBranch'],$_POST['getOptionCertificate'],$_POST['getiscerNum'],$_POST['gettxtClient_Name']);       
}

//........................................function for Printout Inster in Entry
function isInsertPrintLog($comment,$UsreID,$getdepNum,$getConNum,$userBranch,$getOptionCertificate,$getiscerNum,$gettxtClient_Name){
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_ptintLog = "SELECT count(*) as cityCount FROM `print_gen` WHERE `dep_num` = '".$getdepNum."' AND `cont_num` = ".$getConNum.";";
    $result = mysqli_query($conn,$sql_ptintLog) or  die(mysqli_error($conn));
    
    while($RES_ptintLog = mysqli_fetch_array($result)){
        $conPrintLlog = $RES_ptintLog[0] + 1 ;
         $sqli_Insert = "INSERT INTO `print_gen`(`dep_num`, `cont_num`, `prnt_serial`, `rec_stat`, `gen_on`, `gen_by`, `auth_on`, `auth_by`, `prnt_on`, `prnt_by`, `print_text`, `remarks`, `print_branch`,`cert_type`,`cert_Number`,`Client_Name`)
                     VALUES ('".$getdepNum."','".$getConNum."','".$conPrintLlog."','A',now(),'".$UsreID."','0000-00-00 00:00:00','',now(),'".$UsreID."','','".$comment."','".$userBranch."','".$getOptionCertificate."','".$getiscerNum."','".$gettxtClient_Name."');";
         $que_insert_ath = mysqli_query($conn,$sqli_Insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
    }
}
?>