<?php

$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$TableID = "";
$dateNow = "";
$user = "01000071";
$branch = "0001";
$deparment = "01003";
$userIP = "192.168.3.13";

$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
$add = mysqli_query($conn,$sql);
while ($rec = mysqli_fetch_array($add)){
	$dateNow = $rec[0];	
}

$Current_Year = date("Y" , strtotime($dateNow));

$sql_select_scal1 = "SELECT s1.scat_code_1 , s1.scat_discr_1 FROM scat_01 AS s1 WHERE s1.cat_code = 1020";
$que_select_scal1 = mysqli_query($conn,$sql_select_scal1) or die(mysqli_error($conn));
while($rec_select_scal1 = mysqli_fetch_array($que_select_scal1)){
    
    //echo $rec_select_scal1[0]."<br/>";
    
    $sql_select_scal2 = "SELECT s2.scat_code_2 , s2.scat_discr_2 FROM scat_02 AS s2 WHERE s2.cat_code = 1020 AND s2.scat_code_1 = '".$rec_select_scal1[0]."'";
    $que_select_scal2 = mysqli_query($conn,$sql_select_scal2) or die(mysqli_error($conn));
    while($rec_select_scal2 = mysqli_fetch_array($que_select_scal2)){
        
        $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
        $quary_Function = mysqli_query($conn,$sqlFunction);
        while ($rec_Function = mysqli_fetch_array($quary_Function)){
            $batch_num = $rec_Function[0]; 
  
            $TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015

            echo $rec_select_scal1[0]." - ".$rec_select_scal2[0]."<br/>";
            $iss = "Security alarm routine check - ".$rec_select_scal1[1];
            $SQL_insertHelpdesk = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`entry_branch`,`entry_department`,`s_type`,`ipAddress`) 
                                                    VALUES ('".$TableID."', '1020', '".$rec_select_scal1[0]."', '".$rec_select_scal2[0]."', '5001', '6001', '7001', '".$iss."', '".$iss."', '".$user."', now(),'".$branch."','".$deparment."','8004','".$userIP."');";
            echo $SQL_insertHelpdesk."<br/>";
            $QUERY_insertHelpdesk = mysqli_query($conn,$SQL_insertHelpdesk) or die(mysqli_error($conn));
            
            $SQL_insertHIS = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `entry_branch`,`entry_department`,`s_type`,`ipAddress`)
                                 VALUES ('".$TableID."', '1020', '".$rec_select_scal1[0]."', '".$rec_select_scal2[0]."', '5001', '6001', '7001', '".$iss."', '".$iss."', '".$user."', now(),'".$branch."','".$deparment."','8004','".$userIP."');";
            echo $SQL_insertHIS."<br/>";
            $QUERY_insertHIS = mysqli_query($conn,$SQL_insertHIS) or die(mysqli_error($conn));
        }           
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sql_select_scal1sub = "SELECT s1.scat_code_1 , s1.scat_discr_1 FROM scat_01 AS s1 WHERE s1.cat_code = 1022";
$que_select_scal1sub = mysqli_query($conn,$sql_select_scal1sub) or die(mysqli_error($conn));
while($rec_select_scal1sub = mysqli_fetch_array($que_select_scal1sub)){
    
    //echo $rec_select_scal1[0]."<br/>";
    
    $sql_select_scal2sub = "SELECT s2.scat_code_2 , s2.scat_discr_2 FROM scat_02 AS s2 WHERE s2.cat_code = 1022 AND s2.scat_code_1 = '".$rec_select_scal1sub[0]."'";
    $que_select_scal2sub = mysqli_query($conn,$sql_select_scal2sub) or die(mysqli_error($conn));
    while($rec_select_scal2sub = mysqli_fetch_array($que_select_scal2sub)){
        
        $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
        $quary_Function = mysqli_query($conn,$sqlFunction);
        while ($rec_Function = mysqli_fetch_array($quary_Function)){
            $batch_num = $rec_Function[0]; 
  
            $TableIDsub = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015

            echo $rec_select_scal1sub[0]." - ".$rec_select_scal2sub[0]."<br/>";
            $isssub = "CCTV routine check - ".$rec_select_scal1sub[1];
            $SQL_insertHelpdesk = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`entry_branch`,`entry_department`,`s_type`,`ipAddress`) 
                                                    VALUES ('".$TableIDsub."', '1022', '".$rec_select_scal1sub[0]."', '".$rec_select_scal2sub[0]."', '5001', '6001', '7001', '".$isssub."', '".$isssub."', '".$user."', now(),'".$branch."','".$deparment."','8004','".$userIP."');";
            echo $SQL_insertHelpdesk."<br/>";
            $QUERY_insertHelpdesk = mysqli_query($conn,$SQL_insertHelpdesk) or die(mysqli_error($conn));
            
            $SQL_insertHIS = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `entry_branch`,`entry_department`,`s_type`,`ipAddress`)
                                 VALUES ('".$TableIDsub."', '1022', '".$rec_select_scal1sub[0]."', '".$rec_select_scal2sub[0]."', '5001', '6001', '7001', '".$isssub."', '".$isssub."', '".$user."', now(),'".$branch."','".$deparment."','8004','".$userIP."');";
            echo $SQL_insertHIS."<br/>";
            $QUERY_insertHIS = mysqli_query($conn,$SQL_insertHIS) or die(mysqli_error($conn));
        }           
    }
}
                            
?>