<?php
//*************************************** Function For DB *************************************************************************
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

//************************************** Call for ajex *************************************************************************************


if(isset($_REQUEST['getBranchNumber']) && isset($_REQUEST['getfileType']) && isset($_REQUEST['getReciveBranch']) && isset($_REQUEST['getReciveDepartmnet'])){
    //echo $_REQUEST['getBranchNumber']." ".$_REQUEST['getfileType']."OK";
    getDeprtmentDtlfile($_REQUEST['getBranchNumber'],$_REQUEST['getfileType'],$_REQUEST['getReciveBranch'],$_REQUEST['getReciveDepartmnet']);
}

if(isset($_REQUEST['getSendBranchNumber']) && isset($_REQUEST['getSendDepartmentNumber']) && isset($_REQUEST['getfileType']) && isset($_REQUEST['getReciveBranch']) && isset($_REQUEST['getReciveDepartmnet'])){
   // echo $_REQUEST['getSendBranchNumber']." ".$_REQUEST['getSendDepartmentNumber']." ". $_REQUEST['getfileType']." ".$_REQUEST['getReciveBranch']." ".$_REQUEST['getReciveDepartmnet'];
    getFile($_REQUEST['getSendBranchNumber'],$_REQUEST['getSendDepartmentNumber'], $_REQUEST['getfileType'],$_REQUEST['getReciveBranch'],$_REQUEST['getReciveDepartmnet']);
}

if(isset($_POST['isFileNumber']) && isset($_POST['isDocString']) && isset($_POST['isLogUser']) && isset($_POST['isPDRString']) && isset($_POST['isPDRDis'])){ 
    //echo $_POST['isFileNumber']." ".$_POST['isDocString']." ".$_POST['isLogUser'];
    submitFile($_POST['isFileNumber'],$_POST['isDocString'],$_POST['isLogUser'],$_POST['isPDRString'], $_POST['isPDRDis']);
}


//*************************************** Function for PHP ********************************************************************************************
function getDeprtmentDtlfile($getBranchNumber,$getfileType,$getReciveBranch,$getReciveDepartmnet){
   $conn = DatabaseConnection();
   $selectBranch = "SELECT DISTINCT(f.departmentNumber), d.deparmentName , b.branchName
        			FROM courier_files AS f , deparment AS d , branch AS b
        			WHERE f.departmentNumber = d.deparmentNumber AND
                            f.branchNumber = b.branchNumber AND
                            f.branchNumber = '".$getBranchNumber."' AND 
    						f.stats = 'DR' AND
    						f.receiveBranchNumber = '".$getReciveBranch."' AND 
                            f.receiveDepartmentNumber = '".$getReciveDepartmnet."' AND 
                            f.fileType = '".$getfileType."';";
   $sql_selectBranch = mysqli_query($conn,$selectBranch);
   
   echo	"<table border='1'cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
              <tr style='background-color: #BEBABA;'>
              	<td style='text-align:center; width:200px;'>Branch</td>
                <td style='text-align:center; width:200px;'>Department</td>
                <td style='text-align:center; width:100px;'>View</td>
              </tr>";
              
	$a = 1 ;
	while ($rec = mysqli_fetch_array($sql_selectBranch)){
	   echo "<tr style='background-color:#FFFFFF;'>";
	   echo "<td style='text-align: left; padding-left: 10px;width:200px;'>".$rec[2]."</td>";
	   echo "<td style='text-align: left; padding-left: 10px;width:200px;'>".$rec[1]."</td>";
	   echo "<td style='width:100px;'>";
	   echo "<input type='button' value='View' title='".$getBranchNumber."|".$rec[0]."|".$getfileType."|".$getReciveBranch."|".$getReciveDepartmnet."' onclick='viewFiles(title);'/>";
	   echo "</td>";
	   echo "</tr>";
	   $a++;
	}	
}

function getFile($getSendBranchNumber,$getSendDepartmentNumber,$getfileType,$getReciveBranch,$getReciveDepartmnet){
   $conn = DatabaseConnection();
   $selectfile = "SELECT f.fileNumber, f.fileName, f.numberOfDocument , f.receiveOfficer
            			FROM courier_files AS f
            			WHERE f.branchNumber = '".$getSendBranchNumber."' AND 
                               f.departmentNumber = '".$getSendDepartmentNumber."' AND
    						f.stats = 'DR' AND
    						f.receiveBranchNumber = '".$getReciveBranch."' AND 
                        f.receiveDepartmentNumber = '".$getReciveDepartmnet."' AND 
                        f.fileType = '".$getfileType."'
                   ORDER BY f.receiveOfficer;";
   $sql_selectfile = mysqli_query($conn,$selectfile);
   $rowcount = mysqli_num_rows($sql_selectfile);
    echo	"<table border='1'cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
              <tr style='background-color: #BEBABA;'>
              	<td style='text-align:center; width:200px;'>File Number</td>
                <td style='text-align:center; width:200px;'>File Name</td>
                <td style='text-align:center; width:100px;'>Number of Doc</td>
                <td style='text-align:center; width:100px;'>Receive Officer</td>
              </tr>";
              
	$a = 1 ;
	while ($rec_selectFile = mysqli_fetch_array($sql_selectfile)){
	   echo "<tr style='background-color:#FFFFFF;' title='".$rec_selectFile[0]."|".$rowcount."' onclick='selectDocuments(title);'>";
	   echo "<td style='text-align: left; padding-left: 10px;width:200px;'>".$rec_selectFile[0]."</td>";
	   echo "<td style='text-align: left; padding-left: 10px;width:300px;'>".$rec_selectFile[1]."</td>";
	   echo "<td style='text-align: left; padding-left: 10px;width:100px;'>".$rec_selectFile[2]."</td>";
       echo "<td style='text-align: left; padding-left: 10px;width:100px;'>".$rec_selectFile[3]."</td>";
	   echo "</tr>";
	   $a++;
	}	
}

function submitFile($FileNumber,$DocString,$LogUser ,$isPDRString, $isPDRDis){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        
       //echo $FileNumber ."<br/>";
       date_default_timezone_set('Asia/Colombo');
       $arr_doc = explode("|",$DocString);
       //echo sizeof($arr_doc)." - D<br/>";
       //echo $arr_doc[0]."-K <br/>";
       $arr_PDRString = explode("|",$isPDRString);
       $arr_PDRDis = explode("|",$isPDRDis);
       
       //$isPDRString, $isPDRDis
       
       $checkStatus = 1;
       
       $sqlSubDocStatus = "SELECT cf.subdoc , cf.preFileNumber FROM courier_files AS cf WHERE cf.fileNumber = '".$FileNumber."';";
       $queSubDocStatus = mysqli_query($conn,$sqlSubDocStatus) or die(mysqli_error($conn));
       while($recSubDocStatus = mysqli_fetch_array($queSubDocStatus)){
            if($recSubDocStatus[0] == "NO"){
                //echo "NOT Sub doument";    
                if(sizeof($arr_doc) <= 1){
                    //echo "P - Resive";
                    $updateAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00';";
		            $sql_updateAvelsub =  mysqli_query($conn,$updateAvelsub) or die(mysqli_error($conn));
                    //$checkStatus = 0;
                    
                    $updateFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
					$sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                    FileMovementLogger_USER($conn,$FileNumber,'User partially received',$LogUser);
                    //$checkStatus = 0;
                }else{
                    for($i = 0; $i<(sizeof($arr_doc)-1) ; $i++){
                        if($arr_doc[$i] != ""){
                           // echo $arr_doc[$i]."<br/>";
                            $updateAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `documentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$FileNumber."';";
							$sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));
                            if($recSubDocStatus[1] != ""){
                                $updatePAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `documentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$recSubDocStatus[1]."';";
							    $sql_updatePAvel =  mysqli_query($conn,$updatePAvel) or die(mysqli_error($conn));
                            }
                        }else{
                            //echo 0 . "<br/>";
                            //$checkStatus = 0;
                        }
                    }
                    
                    $sql_docNotRiceve = "SELECT COUNT(*) FROM courier_document AS cd WHERE cd.fileNumber = '".$FileNumber."' AND cd.receiveDateTime = '0000-00-00 00:00:00';";
                    $que_docNotRiceve = mysqli_query($conn,$sql_docNotRiceve) or die(mysqli_error($conn));
                    while($rec_docNotRiceve = mysqli_fetch_array($que_docNotRiceve)){
                        if($rec_docNotRiceve[0] != 0){
                            $updateAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00';";
				            $sql_updateAvelsub =  mysqli_query($conn,$updateAvelsub) or die(mysqli_error($conn));
                            //$checkStatus = 0;
                            
                            $updateFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
							$sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                            FileMovementLogger_USER($conn,$FileNumber,'User partially received',$LogUser);
                        }else{
                            //$checkStatus = 1;
                           	$updateFile1="UPDATE courier_files SET `stats`='FDR',`receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
							$sql_updateFile1= mysqli_query($conn,$updateFile1) or die(mysqli_error($conn));
                            FileMovementLogger_USER($conn,$FileNumber,'User fully received',$LogUser);
                        }
                    }
                    
                    if($recSubDocStatus[1] != ""){
                        $sql_sub_docNotRiceve = "SELECT COUNT(*) FROM courier_document AS cd WHERE cd.fileNumber = '".$recSubDocStatus[1]."' AND cd.receiveDateTime = '0000-00-00 00:00:00';";
                        $que_sub_docNotRiceve = mysqli_query($conn,$sql_sub_docNotRiceve) or die(mysqli_error($conn));
                        while($rec_sub_docNotRiceve = mysqli_fetch_array($que_sub_docNotRiceve)){
                            if($rec_sub_docNotRiceve[0] != 0){
                                $updateSubAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$recSubDocStatus[1]."' AND `receiveDateTime`='0000-00-00 00:00:00';";
    				            $sql_updateSubAvelsub =  mysqli_query($conn,$updateSubAvelsub) or die(mysqli_error($conn));
                                //$checkStatus = 0;
                                
                                $updateSubFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$recSubDocStatus[1]."';";
    							$sql_updateSubFile2= mysqli_query($conn,$updateSubFile2) or die(mysqli_error($conn));
                                FileMovementLogger_USER($conn,$recSubDocStatus[1],'User partially received',$LogUser);
                            }else{
                                //$checkStatus = 1;
                               	$updateSubFile1="UPDATE courier_files SET `stats`='FDR',`receiveDateTime` = now() WHERE `fileNumber`='".$recSubDocStatus[1]."';";
    							$sql_updateSubFile1= mysqli_query($conn,$updateSubFile1) or die(mysqli_error($conn));
                                FileMovementLogger_USER($conn,$recSubDocStatus[1],'User fully received',$LogUser);
                            }
                        }
                    }
                    
                } 
                //--------------------------------------------- 2016-11-11 - Madushan - Updare Partially Recive Discription ------------------------------------
                for($x = 0; $x<(sizeof($arr_PDRString)) ; $x++){
                        if($arr_PDRString[$x] != ""){
                           // echo $arr_doc[$i]."<br/>";
                            $updateAvel ="UPDATE `courier_document` SET `partiallyNote` = '".$arr_PDRDis[$x]."' WHERE `documentNumber`='".$arr_PDRString[$x]."' AND `fileNumber`='".$FileNumber."' AND `receiveAvailable`='NO';";
            				$sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));
                            
                            /*$updateAvel ="UPDATE `courier_document_sub` SET `partiallyNote` = '".$arr_PDRDis[$x]."' WHERE `documentNumber`='".$arr_doc[$x]."' AND `fileNumber`='".$FileNumber."' AND `receiveAvailable`='NO';";
            				$sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));*/
                            
                        }else{
                            //echo 0 . "<br/>";
                            //$checkStatus = 0;
                        }
                    }
                //----------------------------------------------------- END ----------------------------------------------------------------------------------------
                echo "OK"; 
            }else{
               //echo "have Sub doument"; 
               
               if(sizeof($arr_doc) <= 1){
                    //echo "P - Resive";
                    $updateAvelsub03 ="UPDATE `courier_document_sub` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00'";
					$sql_updateAvelsub03 =  mysqli_query($conn,$updateAvelsub03) or die(mysqli_error($conn));
                    
                    $updateAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00';";
		            $sql_updateAvelsub =  mysqli_query($conn,$updateAvelsub) or die(mysqli_error($conn));
                    
                    
                    //$checkStatus = 0;
                    
                    $updateFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
					$sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                    FileMovementLogger_USER($conn,$FileNumber,'User partially received',$LogUser);
                    //$checkStatus = 0;
                }else{
                    for($i = 0; $i<(sizeof($arr_doc)-1) ; $i++){
                        if($arr_doc[$i] != ""){
                            //echo $arr_doc[$i]."<br/>";
                           $updateAvelsub04 ="UPDATE `courier_document_sub` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `subDocumentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$FileNumber."';";
					       $sql_updateAvel4 =  mysqli_query($conn,$updateAvelsub04) or die(mysqli_error($conn));
                            
                            // -- madushan 2017-07-21 ------
                            $sql_select_docNumber = "SELECT cd.documentNumber FROM courier_document AS cd WHERE cd.fileNumber = '".$FileNumber."';";
                            $query_select_docNumber = mysqli_query($conn,$sql_select_docNumber) or die(mysqli_error($conn));
                            $select_docNumberCount = mysqli_num_rows($query_select_docNumber);
                            //if($select_docNumberCount == 1){
                                while($resaltdocNumberCount = mysqli_fetch_array($query_select_docNumber)){
                                    if($resaltdocNumberCount[0] == "CM0242"){ 
                                        CaredCenterManagementSystemReciveDebitcardbranch($conn, $arr_doc[$i], $LogUser);
                                    }
                                }
                            //}
            
                          
                           /* $updateAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `documentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$FileNumber."';";
							$sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));*/
                            
                            
                            if($recSubDocStatus[1] != ""){
                                $updateAvelsub04 ="UPDATE `courier_document_sub` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `subDocumentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$recSubDocStatus[1]."';";
					            $sql_updateAvel4 =  mysqli_query($conn,$updateAvelsub04) or die(mysqli_error($conn));
                           
                                /*$updatePAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `documentNumber`='".$arr_doc[$i]."' AND `fileNumber`='".$recSubDocStatus[1]."';";
							    $sql_updatePAvel =  mysqli_query($conn,$updatePAvel) or die(mysqli_error($conn));*/
                            }
                        }else{
                            //echo 0 . "<br/>";
                            //$checkStatus = 0;
                        }
                    }
                    
                    $sql_docNotRiceve = "SELECT COUNT(*) FROM courier_document_sub AS cd WHERE cd.fileNumber = '".$FileNumber."' AND cd.receiveDateTime = '0000-00-00 00:00:00';";
                    $que_docNotRiceve = mysqli_query($conn,$sql_docNotRiceve) or die(mysqli_error($conn));
                    while($rec_docNotRiceve = mysqli_fetch_array($que_docNotRiceve)){
                        if($rec_docNotRiceve[0] != 0){
                            $updateAvelsub03 ="UPDATE `courier_document_sub` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00'";
					        $sql_updateAvelsub03 =  mysqli_query($conn,$updateAvelsub03) or die(mysqli_error($conn));
                            
                            $updateAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$FileNumber."' AND `receiveDateTime`='0000-00-00 00:00:00';";
				            $sql_updateAvelsub =  mysqli_query($conn,$updateAvelsub) or die(mysqli_error($conn));
                            //$checkStatus = 0;
                            
                            $updateFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
							$sql_updateFile2= mysqli_query($conn,$updateFile2) or die(mysqli_error($conn));
                            FileMovementLogger_USER($conn,$FileNumber,'User partially received',$LogUser);
                        }else{
                            //$checkStatus = 1;
                            $updatePAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `fileNumber`='".$FileNumber."';";
                            $sql_updatePAvel =  mysqli_query($conn,$updatePAvel) or die(mysqli_error($conn));
                            
                           	$updateFile1="UPDATE courier_files SET `stats`='FDR',`receiveDateTime` = now() WHERE `fileNumber`='".$FileNumber."';";
							$sql_updateFile1= mysqli_query($conn,$updateFile1) or die(mysqli_error($conn));
                            FileMovementLogger_USER($conn,$FileNumber,'User fully received',$LogUser);
                        }
                    }
                    
                    if($recSubDocStatus[1] != ""){
                        $sql_sub_docNotRiceve = "SELECT COUNT(*) FROM courier_document AS cd WHERE cd.fileNumber = '".$recSubDocStatus[1]."' AND cd.receiveDateTime = '0000-00-00 00:00:00';";
                        $que_sub_docNotRiceve = mysqli_query($conn,$sql_sub_docNotRiceve) or die(mysqli_error($conn));
                        while($rec_sub_docNotRiceve = mysqli_fetch_array($que_sub_docNotRiceve)){
                            if($rec_sub_docNotRiceve[0] != 0){
                                $updateSubAvelsub ="UPDATE `courier_document` SET `receiveAvailable`='NO' WHERE `fileNumber`='".$recSubDocStatus[1]."' AND `receiveDateTime`='0000-00-00 00:00:00';";
    				            $sql_updateSubAvelsub =  mysqli_query($conn,$updateSubAvelsub) or die(mysqli_error($conn));
                                //$checkStatus = 0;
                                
                                $updateSubFile2="UPDATE courier_files SET `stats`='PDR' , `receiveDateTime` = now() WHERE `fileNumber`='".$recSubDocStatus[1]."';";
    							$sql_updateSubFile2= mysqli_query($conn,$updateSubFile2) or die(mysqli_error($conn));
                                FileMovementLogger_USER($conn,$recSubDocStatus[1],'User partially received',$LogUser);
                            }else{
                                //$checkStatus = 1;
                                $updatePAvel ="UPDATE `courier_document` SET `receiveAvailable`='YES',`receiveDateTime`= now() WHERE `fileNumber`='".$recSubDocStatus[1]."';";
							    $sql_updatePAvel =  mysqli_query($conn,$updatePAvel) or die(mysqli_error($conn));
                                
                               	$updateSubFile1="UPDATE courier_files SET `stats`='FDR',`receiveDateTime` = now() WHERE `fileNumber`='".$recSubDocStatus[1]."';";
    							$sql_updateSubFile1= mysqli_query($conn,$updateSubFile1) or die(mysqli_error($conn));
                                FileMovementLogger_USER($conn,$recSubDocStatus[1],'User fully received',$LogUser);
                            }
                        }
                    }
                    
                } 
                
                
                //--------------------------------------------- 2016-11-11 - Madushan - Updare Partially Recive Discription ------------------------------------
                for($x = 0; $x<(sizeof($arr_PDRString)) ; $x++){
                        if($arr_PDRString[$x] != ""){
                           // echo $arr_doc[$i]."<br/>";
                            /*$updateAvel ="UPDATE `courier_document` SET `partiallyNote` = '".$arr_PDRDis[$x]."' WHERE `documentNumber`='".$arr_doc[$x]."' AND `fileNumber`='".$FileNumber."' AND `receiveAvailable`='NO';";
            				$sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));*/
                            
                            $updateAvel ="UPDATE `courier_document_sub` SET `partiallyNote` = '".$arr_PDRDis[$x]."' WHERE `subDocumentNumber`='".$arr_PDRString[$x]."' AND `fileNumber`='".$FileNumber."' AND `receiveAvailable`='NO';";
                            $sql_updateAvel =  mysqli_query($conn,$updateAvel) or die(mysqli_error($conn));
                            
                        }else{
                            //echo 0 . "<br/>";
                            //$checkStatus = 0;
                        }
                    }
                //----------------------------------------------------- END ----------------------------------------------------------------------------------------
               
                echo "OK";
               
            } 
       }
       
        
        //echo $LogUser."<br/>";
        
       
     mysqli_commit($conn);
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
}

function FileMovementLogger_USER($conn,$FileNumber,$status,$LogUser){
    $sql_his = "INSERT INTO filemovement(fileNumber, createDateTime, action, doneby) VALUES ('".$FileNumber."',NOW(),'".$status."','".$LogUser."');";
    $que_his = mysqli_query($conn,$sql_his) or die(mysqli_error($conn));
}

function CaredCenterManagementSystemReciveDebitcardbranch($conn, $ACC1, $enryBy){
    date_default_timezone_set('Asia/Colombo'); 
    $sql_select_heard = "SELECT ch.HEADER_ID 
                           FROM card_header AS ch 
                          WHERE ch.ACCOUNT_NO_1 = '".$ACC1."'
                            AND ch.BRANCH_SENT_BY != '' 
                            AND ch.BRANCH_RECEIVE_BY = '' 
                            AND ch.CARD_STATE != 'Data Migrate' 
                            AND ch.BRANCH_RECEIVE_ON = '0000-00-00 00:00:00';";
    $query_select_heard = mysqli_query($conn,$sql_select_heard) or die(mysqli_error($conn));
    $rowcount = mysqli_num_rows($query_select_heard);
   // if ($rowcount == 1){
        while($resalt_select_heard = mysqli_fetch_array($query_select_heard)){
           
                $sql_update_header = "UPDATE card_header AS c 
                                        SET c.CARD_STATE = 'Receive Card - Branch' ,
                                            c.BRANCH_RECEIVE_BY = '".$enryBy."',
                                            c.BRANCH_RECEIVE_ON = NOW()
                                        WHERE c.ACCOUNT_NO_1 = '".$ACC1."' AND c.BRANCH_SENT_BY != '' AND c.CARD_STATE != 'Data Migrate' AND  c.BRANCH_RECEIVE_BY = '' AND c.BRANCH_RECEIVE_ON = '0000-00-00 00:00:00';";
                $query_update_header = mysqli_query($conn,$sql_update_header) or die(mysqli_error($conn));
                
                $sql_insert_note = "INSERT INTO card_note(`HEADER_ID`,`DESCRIPTION`,`ENTRY_BY`,`ENTRY_ON`)
                                         VALUES('".$resalt_select_heard[0]."','Receive Card - Branch','".$enryBy."',NOW());";
                $query_insert_note = mysqli_query($conn,$sql_insert_note) or die(mysqli_error($conn));
        }
  //  }
}
?>