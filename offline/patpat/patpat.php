<?php

$conn = mysqli_connect("localhost","root","1234","cdberp"); // connection for the MYSQL Databace
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
date_default_timezone_set('Asia/Colombo');

$sql_selectScat02 = "SELECT s2.cat_code, s2.scat_code_1 , s2.scat_code_2,s2.scat_discr_2
                       FROM scat_02 AS s2 
                       WHERE s2.cat_code = '1024' 
                         AND s2.scat_state_2 = '1';";
$query_selectScat02 = mysqli_query($conn,$sql_selectScat02) or die(mysqli_error($conn));
while($resalt_selectSact02 = mysqli_fetch_array($query_selectScat02)){
    $sql_selectUser = "SELECT s2.scat_discr_2 , u.userName , u.userID 
                         FROM scat_02 AS s2,`user` u , branch br 
                        WHERE s2.cat_code = '1024' 
                          and br.branchName = s2.scat_discr_2
                          and br.branchNumber = u.branchNumber
                          and s2.scat_discr_2  = '".trim($resalt_selectSact02[3])."'
                          and u.usergroupNumber in ('ug00016')
                          and u.isLending = 1
                          and u.userStat = 'A';";
    $query_selectUser = mysqli_query($conn , $sql_selectUser) or die(mysqli_error($conn));
    while($resalt_selectUser = mysqli_fetch_array($query_selectUser)){
        $sql_count_scat03 = "SELECT COUNT(*) FROM scat_03 AS s WHERE s.cat_code = '1024' AND s.scat_code_1 = '".trim($resalt_selectSact02[1])."' AND s.scat_code_2 = '".trim($resalt_selectSact02[2])."';";
        $query_count_scat03 = mysqli_query($conn, $sql_count_scat03) or die(mysqli_error($conn));
        while($resalt_count_scat03 = mysqli_fetch_array($query_count_scat03)){
            $batch_num = $resalt_count_scat03[0]+1;
        }
        
        $Scat03_code = trim($resalt_selectSact02[2]).str_pad($batch_num, 2, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
        
        $sql_sub_scat03 = "SELECT COUNT(*) FROM scat_03 AS s WHERE s.cat_code = '1024' AND s.scat_code_1 = '".trim($resalt_selectSact02[1])."' AND s.DefuserID = '".trim($resalt_selectUser[1])."' AND scat_state_3 = '1';";
        echo $sql_sub_scat03."<br/>";
        $query_sub_scat03 = mysqli_query($conn, $sql_sub_scat03) or die(mysqli_error($conn));
        while($resalt_sub_scat03 = mysqli_fetch_array($query_sub_scat03)){
           $count_stat = $resalt_sub_scat03[0];
        }
        
        echo $count_stat."<br/>";
        if($count_stat  == 0){
             $sql_inseteScat03 = "INSERT INTO scat_03(cat_code, scat_code_1, scat_code_2, scat_code_3, scat_discr_3, scat_state_3, templet_issue, issue_lbl, decision_state, decision_discription, DefuserID) 
                                  VALUES ('1024','".trim($resalt_selectSact02[1])."','".trim($resalt_selectSact02[2])."','".$Scat03_code."','".trim($resalt_selectUser[2])."','1','','','','','".trim($resalt_selectUser[1])."');";
            echo $sql_inseteScat03."<br/>";
            mysqli_query($conn,$sql_inseteScat03) or die(mysqli_error($conn));
        }
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // resing officer
    $sql_selectNOTAUser = "SELECT s2.scat_discr_2 , u.userName , u.userID 
                         FROM scat_02 AS s2,`user` u , branch br 
                        WHERE s2.cat_code = '1024' 
                          and br.branchName = s2.scat_discr_2
                          and br.branchNumber = u.branchNumber
                          and s2.scat_discr_2  = '".trim($resalt_selectSact02[3])."'
                          and u.usergroupNumber in ('ug00016')
                          and u.userStat != 'A';";
    $query_selectNOTAUser = mysqli_query($conn , $sql_selectNOTAUser) or die(mysqli_error($conn));
    while($resalt_selectNOTAUser = mysqli_fetch_array($query_selectNOTAUser)){
             $sql_UpdateScat03 = "UPDATE scat_03 AS su SET su.scat_state_3 = '0' WHERE su.`cat_code` = '1024' AND su.`scat_code_1` = '".trim($resalt_selectSact02[1])."' AND su.`scat_code_2` = '".trim($resalt_selectSact02[2])."' AND `DefuserID` = '".trim($resalt_selectNOTAUser[1])."';";
            echo $sql_UpdateScat03."<br/>";
             mysqli_query($conn,$sql_UpdateScat03) or die(mysqli_error($conn));
    }   
    echo "<br/><hr/><br/>";
    
    // NOT lending officer 
     $sql_selectNOTAUser = "SELECT s2.scat_discr_2 , u.userName , u.userID 
                         FROM scat_02 AS s2,`user` u , branch br 
                        WHERE s2.cat_code = '1024' 
                          and br.branchName = s2.scat_discr_2
                          and br.branchNumber = u.branchNumber
                          and s2.scat_discr_2  = '".trim($resalt_selectSact02[3])."'
                          and u.usergroupNumber in ('ug00016')
                          and u.isLending <> 1
                          and u.userStat = 'A';";
    $query_selectNOTAUser = mysqli_query($conn , $sql_selectNOTAUser) or die(mysqli_error($conn));
    while($resalt_selectNOTAUser = mysqli_fetch_array($query_selectNOTAUser)){
             $sql_UpdateScat03 = "UPDATE scat_03 AS su SET su.scat_state_3 = '0' WHERE su.`cat_code` = '1024' AND su.`scat_code_1` = '".trim($resalt_selectSact02[1])."' AND su.`scat_code_2` = '".trim($resalt_selectSact02[2])."' AND `DefuserID` = '".trim($resalt_selectNOTAUser[1])."';";
            echo $sql_UpdateScat03."<br/>";
             mysqli_query($conn,$sql_UpdateScat03) or die(mysqli_error($conn));
    }   
    echo "<br/><hr/><br/>";
    
}
echo "-------------------------------------------------------------------------------------------------------------------------------------------------<br/>";
$sql_dtlUser = "SELECT  u.userName , u.userID , u.branchNumber , b.branchName
                     FROM user u , branch b
                     WHERE u.usergroupNumber in ('ug00016')
                    	and u.userStat = 'A'
                      and u.branchNumber = b.branchNumber;";
    $query_dtlUser = mysqli_query($conn , $sql_dtlUser) or die(mysqli_error($conn));
    while($resalt_dtlUser = mysqli_fetch_array($query_dtlUser)){
         $sql_selectUser = "SELECT s3.scat_code_2 , s2.scat_discr_2
                              FROM scat_03 AS s3 , scat_02 AS s2
                             WHERE s3.cat_code = '1024'
                               and s3.scat_code_2 = s2.scat_code_2  
                              and s3.DefuserID = '".trim($resalt_dtlUser[0])."' 
                              and s3.scat_state_3 = '1';";
         //echo $sql_selectUser."<br/>";
         $query_selectUser = mysqli_query($conn,$sql_selectUser) or die(mysqli_error($conn));
         while($resalt_selectUser = mysqli_fetch_array($query_selectUser)){
           //echo "-".trim($resalt_selectUser[1])."-".trim($resalt_dtlUser[3])."<br/>";
            if(trim($resalt_selectUser[1]) != trim($resalt_dtlUser[3])){
                $sql_UpdateSdtl = "UPDATE scat_03 AS su SET su.scat_state_3 = '0' WHERE su.`cat_code` = '1024' AND su.`DefuserID` = '".trim($resalt_dtlUser[0])."';";
                echo $sql_UpdateSdtl."<br/>";
                mysqli_query($conn,$sql_UpdateSdtl) or die(mysqli_error($conn));
            }
         }
    }
?>