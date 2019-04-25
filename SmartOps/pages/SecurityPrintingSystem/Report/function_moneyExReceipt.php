<?php
if(isset($_POST['TP_FXTRAN_BRN_CODE']) && isset($_POST['TP_FXTRAN_DATE']) && isset($_POST['TP_FXTRAN_DAY_SL']) && isset($_POST['TP_FXTRAN_CUST_CODE']) && isset($_POST['TP_FXTRAN_PUR_CURR']) && isset($_POST['TP_FXTRAN_PUR_AMT']) && isset($_POST['TP_FXTRAN_SALE_CURR']) && isset($_POST['TP_FXTRAN_SALE_AMT']) && isset($_POST['TP_FXTRAN_CONV_RATE']) && isset($_POST['TP_FXTRAN_CUST_NAME']) && isset($_POST['TP_FXTRAN_NIC_NUM']) && isset($_POST['TP_FXTRAN_PASS_NUMBER']) && isset($_POST['get_entryUser']) && isset($_POST['TP_FXTRAN_REM1']) && isset($_POST['TP_FXTRAN_REM2']) && isset($_POST['TP_FXTRAN_REM3'])){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
    //echo trim($_POST['TP_FXTRAN_BRN_CODE'])." - ".trim($_POST['TP_FXTRAN_DATE'])." - ".trim($_POST['TP_FXTRAN_DAY_SL'])." - ".trim($_POST['TP_FXTRAN_CUST_CODE'])." - ".trim($_POST['TP_FXTRAN_PUR_CURR'])." - ".trim($_POST['TP_FXTRAN_PUR_AMT'])." - ".trim($_POST['TP_FXTRAN_SALE_CURR'])." - ".trim($_POST['TP_FXTRAN_SALE_AMT'])." - ".trim($_POST['TP_FXTRAN_CONV_RATE'])." - ".trim($_POST['TP_FXTRAN_CUST_NAME'])." - ".trim($_POST['TP_FXTRAN_NIC_NUM'])." - ".trim($_POST['TP_FXTRAN_PASS_NUMBER']); 
    setPrintReceipt(trim($_POST['TP_FXTRAN_BRN_CODE']),trim($_POST['TP_FXTRAN_DATE']),trim($_POST['TP_FXTRAN_DAY_SL']),trim($_POST['TP_FXTRAN_CUST_CODE']),trim($_POST['TP_FXTRAN_PUR_CURR']),trim($_POST['TP_FXTRAN_PUR_AMT']),trim($_POST['TP_FXTRAN_SALE_CURR']),trim($_POST['TP_FXTRAN_SALE_AMT']),trim($_POST['TP_FXTRAN_CONV_RATE']),trim($_POST['TP_FXTRAN_CUST_NAME']),trim($_POST['TP_FXTRAN_NIC_NUM']),trim($_POST['TP_FXTRAN_PASS_NUMBER']),trim($_POST['get_entryUser']),trim($_POST['TP_FXTRAN_REM1']),trim($_POST['TP_FXTRAN_REM2']),trim($_POST['TP_FXTRAN_REM3']));
}
//**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 
 //*************************** End Mysql Database Connection **************************************************************************

function setPrintReceipt($TP_FXTRAN_BRN_CODE,$TP_FXTRAN_DATE,$TP_FXTRAN_DAY_SL,$TP_FXTRAN_CUST_CODE,$TP_FXTRAN_PUR_CURR,$TP_FXTRAN_PUR_AMT,$TP_FXTRAN_SALE_CURR,$TP_FXTRAN_SALE_AMT,$TP_FXTRAN_CONV_RATE,$TP_FXTRAN_CUST_NAME,$TP_FXTRAN_NIC_NUM,$TP_FXTRAN_PASS_NUMBER,$get_entryUser,$TP_FXTRAN_REM1,$TP_FXTRAN_REM2,$TP_FXTRAN_REM3){
     $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_inset = "INSERT INTO `moneyex_receipt`(`TP_FXTRAN_BRN_CODE`, `TP_FXTRAN_DATE`, `TP_FXTRAN_DAY_SL`, `TP_FXTRAN_CUST_CODE`, `TP_FXTRAN_PUR_CURR`, `TP_FXTRAN_PUR_AMT`, `TP_FXTRAN_SALE_CURR`, `TP_FXTRAN_SALE_AMT`, `TP_FXTRAN_CONV_RATE`, `TP_FXTRAN_CUST_NAME`, `TP_FXTRAN_NIC_NUM`, `TP_FXTRAN_PASS_NUMBER`,`entryBy`,`entryOn`,`TP_FXTRAN_REM1`,`TP_FXTRAN_REM2`,`TP_FXTRAN_REM3`) 
                                            VALUES ('".$TP_FXTRAN_BRN_CODE."','".$TP_FXTRAN_DATE."','".$TP_FXTRAN_DAY_SL."','".$TP_FXTRAN_CUST_CODE."','".$TP_FXTRAN_PUR_CURR."','".$TP_FXTRAN_PUR_AMT."','".$TP_FXTRAN_SALE_CURR."','".$TP_FXTRAN_SALE_AMT."','".$TP_FXTRAN_CONV_RATE."','".$TP_FXTRAN_CUST_NAME."','".$TP_FXTRAN_NIC_NUM."','".$TP_FXTRAN_PASS_NUMBER."','".$get_entryUser."',NOW(),'".$TP_FXTRAN_REM1."','".$TP_FXTRAN_REM2."','".$TP_FXTRAN_REM3."');";
        $que_inset = mysqli_query($conn,$sql_inset) or die(mysqli_error($conn));
        if($que_inset){
            mysqli_commit($conn);
            echo "OK";
        }else{
            mysqli_rollback($conn);
            echo "NOT";
        }
        
    }catch(Exception $e){
        // Rollback transaction
        
        echo 'Message: ' .$e->getMessage();
    }
    
}
?>