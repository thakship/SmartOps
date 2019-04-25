<?php
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
//****************************************************************

if(isset($_POST['get_fname']) && isset($_POST['get_selFileType']) && isset($_POST['get_selBranchNumber']) && isset($_POST['get_txtResiveOfficer']) && isset($_POST['get_txtareSN']) && isset($_POST['get_txtPreFNum']) && isset($_POST['get_txtrow']) && isset($_POST['get_txtUser']) && isset($_POST['get_txtubranch']) && isset($_POST['get_txtuDepartment']) && isset($_POST['get_selectDocument'])){
        //echo $_POST['get_fname']."<br/>".$_POST['get_selFileType']."<br/>".$_POST['get_selBranchNumber']."<br/>".$_POST['get_selDepartmentNumber']."<br/>".$_POST['get_txtResiveOfficer']."<br/>".$_POST['get_txtareSN']."<br/>".$_POST['get_txtPreFNum']."<br/>".$_POST['get_txtrow']."<br/>".$_POST['get_txtUser']."<br/>".$_POST['get_txtubranch']."<br/>".$_POST['get_txtuDepartment']."<br/>".$_POST['get_selectDocument'];
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
       //echo $_POST['get_fname']."<br/>";
       //echo $_POST['get_selFileType']."<br/>"; 
       date_default_timezone_set('Asia/Colombo');
       $arr_file      = explode("|",$_POST['get_fname']);
       $arr_branch    = explode("|",$_POST['get_selBranchNumber']);
       //$arr_Deparment = explode("|",$_POST['get_selDepartmentNumber']);
       $arr_document  = explode("|",$_POST['get_selectDocument']);
       
       
       /************************************/
      /* for each $arr_branch{
               $arr_Deparment ='Default Departm,enty';
               $arr_file = 'File number generation';
               $addsq1   = "INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) VALUES('".$fileNumber."','".$file_name."','".$_POST['get_txtUser']."' ,'".$_POST['get_txtResiveOfficer']."','".$arr_Deparment[$i]."',  '".$arr_branch[$i]."' ,'JC','".$_POST['get_txtrow']."','".$_POST['get_selFileType']."','".$_POST['get_txtubranch']."','".$_POST['get_txtuDepartment']."','".$_POST['get_txtareSN']."','".$_POST['get_txtUser']."',now(),'".$_POST['get_txtPreFNum']."','NO')";
               $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',now(),'File Created','".$_POST['get_txtUser']."')";
               
               for each $arr_document{
                   $sql_doc= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`) VALUES('".$rec_doc_name['documentNumber']."','".$rec_doc_name['documentName']."','".$fileNumber."',now(),'YES','YES');";
               }
               
               serial updation .....      
       }*/
       /************************************/
       
       
      // echo $_POST['get_selectDocument'];
       for($i = 0; $i<sizeof($arr_file) ; $i++){
        //echo $i." ".$arr_file[$i]."<br/>";
        if($arr_file[$i] != ""){
            //echo $i." ".$arr_file[$i]."<br/>";
            if($arr_branch[$i] != ""){
                // if($arr_Deparment[$i] != ""){
                    $file_name = $arr_file[$i] ; 
                    $statCount1 ="SELECT count ,year FROM filesnumbergenaret where branch = '".$_POST['get_txtubranch']."' AND serial = 'file' AND department = '".$_POST['get_txtuDepartment']."' AND year = year(now())";
   					$sql_statCount1=mysqli_query($conn,$statCount1);
                    // Start While ...............................
   					while($add_statCount1=mysqli_fetch_array($sql_statCount1)){
    				    	if($add_statCount1[0]==0){
						 	$fileNumber = $_POST['get_txtubranch'].$_POST['get_txtuDepartment'].$add_statCount1[1]."000001";
							$cou = $add_statCount1[0] + 1;
						}else{
						 	$fileNumber = $_POST['get_txtubranch'].$_POST['get_txtuDepartment'].$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT);
							$cou = $add_statCount1[0] + 1;
						}
   					} 
                    $sql_department = "SELECT `deparmentNumber` FROM `deparment` WHERE `branchNumber` = '".$arr_branch[$i]."';";
                    $que_department = mysqli_query($conn,$sql_department);
                    while($rec_depatment = mysqli_fetch_assoc($que_department)){
                         $addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) 
                                                    VALUES('".$fileNumber."','".$file_name."','".$_POST['get_txtUser']."' ,'".$_POST['get_txtResiveOfficer']."','".$rec_depatment['deparmentNumber']."',  '".$arr_branch[$i]."' ,'JC','".$_POST['get_txtrow']."','".$_POST['get_selFileType']."','".$_POST['get_txtubranch']."','".$_POST['get_txtuDepartment']."','".$_POST['get_txtareSN']."','".$_POST['get_txtUser']."',now(),'".$_POST['get_txtPreFNum']."','NO');";
                        // echo $addsq1."<br/><br/>";
                         $query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
                    }
                     //End While ................................
                   
                        
       	            $statUpdate ="SELECT serial FROM filesNumberGenaret  where branch ='".$_POST['get_txtubranch']."' AND department = '".$_POST['get_txtuDepartment']."' AND year = year(now())";
		            $sql_statUpdate=mysqli_query($conn,$statUpdate);
                        
   					while($add_statUpdate=mysqli_fetch_array($sql_statUpdate)){
				        $fileCount ="UPDATE `filesnumbergenaret`  SET `count` = '".$cou."'  WHERE `branch` = '".$_POST['get_txtubranch']."' AND `department` = '".$_POST['get_txtuDepartment']."' AND `year` = year(now()) AND `serial`='".$add_statUpdate[0]."';";
  						//echo $fileCount."<br/>";
                        $updateFileCount = mysqli_query($conn,$fileCount) or die(mysqli_error($conn));
   					}
                    $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',now(),'File Created','".$_POST['get_txtUser']."');";
                    //echo $fileMove."<br/><br/>";
                    $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
                    //////////////////////////////////////////////////////////////////////////////////////////////
                    for($x = 0; $x<sizeof($arr_document) ; $x++){
                        if($arr_document[$x] != ""){
                            $sql_doc_name = "SELECT  `documentNumber`,`documentName` FROM `courier_masters_document` WHERE `documentNumber` = '".$arr_document[$x]."';";
                           //echo $x." ".$sql_doc_name;
                            $que_doc_name = mysqli_query($conn,$sql_doc_name) or die(mysqli_error($conn));
                            while($rec_doc_name = mysqli_fetch_assoc($que_doc_name)){
                                $sql_doc= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
                                                                VALUES('".$rec_doc_name['documentNumber']."','".$rec_doc_name['documentName']."','".$fileNumber."',now(),'YES','YES');";
                                //echo $x." ".$sql_doc."<br/><br/>";
                                $resul_doc= mysqli_query($conn,$sql_doc)  or die(mysqli_error($conn));
                            }
                        }
                     }
                     ///////////////////////////////////////////////////////////////////////////////////////////////////////////
                    
                 }
           // }
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