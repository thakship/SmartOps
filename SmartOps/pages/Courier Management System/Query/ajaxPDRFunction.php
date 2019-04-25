<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_POST['isFileNumber']) && isset($_POST['isDocumnetNumber']) && isset($_POST['isDisacknowledgmentNote']) && isset($_POST['isLogUser'])){
     //echo trim($_POST['isFileNumber']). " " .trim($_POST['isDocumnetNumber']). " " . trim($_POST['isDisacknowledgmentNote']). " " . $_POST['isLogUser'];
     isBranchErrorCorection(trim($_POST['isFileNumber']),trim($_POST['isDocumnetNumber']),trim($_POST['isDisacknowledgmentNote']),trim($_POST['isLogUser']));
}

function isBranchErrorCorection($fileNumber,$documnetNumber,$disacknowledgmentNote,$logUser){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sqlSubDocStatus = "SELECT cf.subdoc FROM courier_files AS cf WHERE cf.fileNumber = '".$fileNumber."';";
        $queSubDocStatus = mysqli_query($conn,$sqlSubDocStatus) or die(mysqli_error($conn));
        while($recSubDocStatus = mysqli_fetch_array($queSubDocStatus)){
            if($recSubDocStatus[0] == "NO"){
                /*$sql_UpdateDocumnet = "UPDATE `courier_document` 
                                SET `receiveAvailable`='YES',
                                    `receiveDateTime`='0000-00-00 00:00:00',
                                    `disacknowledgmentNote`='".$disacknowledgmentNote."' 
                                WHERE `documentNumber` = '".$documnetNumber."' AND 
                                      `fileNumber` =  '".$fileNumber."';";*/
                  $sql_UpdateDocumnet = "UPDATE `courier_document` 
                                SET `disacknowledgmentNote`='".$disacknowledgmentNote."' 
                                WHERE `documentNumber` = '".$documnetNumber."' AND 
                                      `fileNumber` = '".$fileNumber."';";
                  //echo $sql_UpdateDocumnet."<br/>";
                 $query_UpdateDocumnet = mysqli_query($conn,$sql_UpdateDocumnet) or die(mysqli_error($conn));
                 //----------------------------------- File Update ---------------------------------------------------------------------------------------------------
                 $sql_CountDocStatus = "SELECT COUNT(*) FROM `courier_document` WHERE `fileNumber` = '".$fileNumber."' AND `receiveAvailable` = 'NO' AND `disacknowledgmentNote` = '' ;";
                 $query_CountDocStatus = mysqli_query($conn,$sql_CountDocStatus)  or die(mysqli_error($conn));
                 
                 while($rec_CountDocStatus = mysqli_fetch_array($query_CountDocStatus)){
                    if($rec_CountDocStatus[0] == 0){
                        $updateFile2="UPDATE courier_files SET `error_log` = 1 WHERE `fileNumber`='".$fileNumber."';";
                        //echo $updateFile2."<br/>";
                        $sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                        
                        $Upadet_His = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',NOW(),'Disacknowledgment','".$logUser."');";
                        $sql_Upadet_His = mysqli_query($conn,$Upadet_His) or die(mysqli_error($conn));
                    }
                 }
                 
            }else{
                
                /*$sql_UpdateSubDocument = "UPDATE `courier_document_sub` 
                                   SET `receiveAvailable`='YES',
                                       `receiveDateTime`='0000-00-00 00:00:00' ,
                                       `disacknowledgmentNote`='".$disacknowledgmentNote."'
                                    WHERE `subDocumentNumber` = '".$documnetNumber."' AND 
                                          `fileNumber` = '".$fileNumber."';";*/
                 $sql_UpdateSubDocument = "UPDATE `courier_document_sub` 
                                   SET `disacknowledgmentNote`='".$disacknowledgmentNote."'
                                    WHERE `subDocumentNumber` = '".$documnetNumber."' AND 
                                          `fileNumber` = '".$fileNumber."';";
                 $query_UpdateSubDocument = mysqli_query($conn,$sql_UpdateSubDocument) or die(mysqli_error($conn));
                 
                 //----------------------------------- File Update ---------------------------------------------------------------------------------------------------
                 
                 $sql_SubDocStat = "SELECT COUNT(*) FROM `courier_document_sub` WHERE `fileNumber` = '".$fileNumber."' AND `receiveAvailable` = 'NO' AND `disacknowledgmentNote` = '';";
                 $query_SubDocStat = mysqli_query($conn,$sql_SubDocStat)  or die(mysqli_error($conn));
                 while($rec_SubDocStat = mysqli_fetch_array($query_SubDocStat)){
                    if($rec_SubDocStat[0] == 0){
                        
                        /*$sql_UpdateDocumnet = "UPDATE `courier_document` 
                                SET `receiveAvailable`='YES',
                                    `receiveDateTime`='0000-00-00 00:00:00' 
                                WHERE `fileNumber` = '".$fileNumber."';";
                        $query_UpdateDocumnet = mysqli_query($conn,$sql_UpdateDocumnet) or die(mysqli_error($conn));*/
                        $updateFile2="UPDATE courier_files SET `error_log` = 1 WHERE `fileNumber`='".$fileNumber."';";
                        $sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                        $Upadet_His = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',NOW(),'Disacknowledgment','".$logUser."');";
                        $sql_Upadet_His = mysqli_query($conn,$Upadet_His) or die(mysqli_error($conn));
                    }
                 }
                 
                 
            }
        }
        mysqli_commit($conn);
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
}
?>