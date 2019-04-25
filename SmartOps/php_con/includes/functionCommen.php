<?php
//session_start();
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_POST['isEntryUserHelpdesk']) && isset($_POST['iscatagory']) && isset($_POST['isscat_1']) && isset($_POST['isscat_2']) && isset($_POST['isscat_3']) && isset($_POST['isiss']) && isset($_POST['isdis'])  ){
   //echo $_POST['isEntryUserHelpdesk'] ." - ".$_POST['iscatagory']  ." - ". $_POST['isscat_1']  ." - ".$_POST['isscat_2']  ." - ".$_POST['isscat_3']  ." - ". $_POST['isiss']  ." - ". $_POST['isdis']  ;
    isCreateHelpDeskRequest($_POST['isEntryUserHelpdesk'],$_POST['iscatagory'],$_POST['isscat_1'],$_POST['isscat_2'],$_POST['isscat_3'],trim($_POST['isiss']) ,trim($_POST['isdis']));
}


function  isCreateHelpDeskRequest($entryUser,$catagory,$scat_1,$scat_2,$scat_3,$iss,$iss_dis){
    $conn = DatabaseConnection();
  //  echo $entryUser;
    // $catagory  - Catagory
    // $scat_1 - Sub catagary 1  
    // $scat_2 - Sub catagary 2
    // $scat_3 - Sub catagary 3
    // $iss    - Issur
    // $iss_dis - Issuer Discreption
    // $entryUser - Entry User
    $validateCount = 0;
    $sql_Auth_Very = "SELECT `auth_verified`,`scat_code_2`,`DefuserID` 
                        FROM `scat_02` 
                       WHERE `cat_code` = '".$catagory."' 
                         AND  `scat_code_1` = '".$scat_1."' 
                         AND `scat_code_2` = '".$scat_2."';";
   // echo $sql_Auth_Very;
    $query_Auth_Very = mysqli_query($conn ,$sql_Auth_Very) or die(mysqli_error($conn));
    $rowcount = mysqli_num_rows($query_Auth_Very);
    if($rowcount != 0){
        // ---- Create Table ID ---------------------------------------
        $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
        $add = mysqli_query($conn,$sql);
        while ($rec = mysqli_fetch_array($add)){
        	$dateNow = $rec[0];
        	
        }
        $Current_Year = date("Y" , strtotime($dateNow));
        $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
        $quary_Function = mysqli_query($conn,$sqlFunction);
        while ($rec_Function = mysqli_fetch_array($quary_Function)){
            $batch_num = $rec_Function[0]; 
        }
        $TableID = $Current_Year.str_pad($batch_num, 6, '0', STR_PAD_LEFT); //This will return 2014000001 as first number for 2014 and 20150001 in 2015
       //-------------------------------------------------------
        $txt_issue = mysqli_real_escape_string($conn,trim($iss));
        $txt_Description = mysqli_real_escape_string($conn,trim($iss_dis));
        while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
            $scat_code_2 = $rec_Auth_Very[1]; // Sub catagary 2
            $usrDf = $rec_Auth_Very[2]; //Defalt asing user
            // Get User Barnch Number and Department Number 
            //$userBranch
            //$userDepartment
            //$userIP
             $sql_user_dtl = "select u.branchNumber , u.deparmentNumber , u.ip 
                              from user u
                              WHERE u.userName = '".$entryUser."';";
            $query_user_dtl = mysqli_query($conn ,$sql_user_dtl) or die(mysqli_error($conn));
           
            while($rec_user_dtl = mysqli_fetch_array($query_user_dtl)){
                $userBranch = $rec_user_dtl[0];
                $userDepartment = $rec_user_dtl[1];
                $userIP = $rec_user_dtl[2];
             }
            
            if($rec_Auth_Very[0] == 1){
                $validateCount = 1;
            
                $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`) 
                                                       VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','','".$entryUser."',NOW(),'','0000-00-00 00:00:00');";
                	//echo $v_getSQL_insert."<br/>";
			    $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
				$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                        VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','".$entryUser."',NOW(),'','0000-00-00 00:00:00');";
				//echo $v_getSQL_insert_1."<br/>";
			   $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                

            }else{
                $validateCount = 0;
                $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                            VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','');";
               	//$v_getSQL_insert."<br/>";
                $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                             VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','');";
                //echo $v_getSQL_insert_1."<br/>";
                $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
            
            }
            echo "HelpId : ".$TableID."";
           // $TableID++;
        }  
    }else{
        echo " Invalied Dtl<br/>";
        
    }      
                                    
}
    
    


?>