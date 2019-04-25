<?php
	
	//echo $w;
	include('../../../php_con/includes/db.ini.php');
	//include('../../../php_con/includes/CommonGrid.php');
    if(isset($_REQUEST['g2'])){
       // $w = $_REQUEST['g2'];
        getDepartment($conn,$_REQUEST['g2']);
    }
    
    if(isset($_REQUEST['getSUserID'])){
        isScatUserPatpat($conn,$_REQUEST['getSUserID']);
    }
    
    if(isset($_POST['isUserID'])){
        isInsertScat03($conn,$_POST['isUserID']);
    }
    
    function getDepartment($conn,$w){
        $addDepartment = "SELECT `deparmentNumber`, `deparmentName` FROM `deparment` WHERE `deparmentNumber` = '".$w."'";
        $quary1 = mysqli_query($conn,$addDepartment);
        while ($rec = mysqli_fetch_array($quary1)){
            echo "<input type='text' class='form-control' id='txtDepartmentNumber' name='txtDepartmentNumber' value='".$rec[1]."'  onkeypress='return disableEnterKey(event)' onclick='popup(1)' placeholder='Department Name' disabled='disable' />";
        }
    }
    
    function isScatUserPatpat($conn,$getSUserID){
        //echo "A - ".$getSUserID;
        $sqlScat3 = "SELECT COUNT(*) 
                        FROM scat_03 AS s3
                        WHERE s3.cat_code = '1024' AND
                              s3.scat_state_3 = 1 AND
                              s3.DefuserID = '".$getSUserID."';";
         $queryScat3 = mysqli_query($conn, $sqlScat3) or die(mysqli_error($conn));
         while($resaltScat3 = mysqli_fetch_array($queryScat3)){
           // echo $resaltScat3[0];
            if($resaltScat3[0] == 0){
                echo 0;
            }else if($resaltScat3[0] == 1){
                echo 1;
            }else{
                echo 2;
            }
         }
    }
    
    function isInsertScat03($conn,$isUserID){
        //echo $isUserID;
       	mysqli_autocommit($conn,FALSE);
		try{
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE scat_03 AS sc3
                            SET sc3.scat_state_3 = 0
                            WHERE sc3.DefuserID = '".$isUserID."';";
            //echo $sql_update;
            $queryupdate = mysqli_query($conn, $sql_update) or die(mysqli_error($conn)); 
        
            /*$sql_selectUser = "SELECT s2.scat_discr_2 , u.userName , u.userID , s2.scat_code_2
                                FROM scat_02 AS s2,`user` u , branch b
                                WHERE b.branchName = s2.scat_discr_2
                                    and b.branchNumber = u.branchNumber
                                    and s2.cat_code = '1024' 
                            		and u.userID = '".$isUserID."'
                            		and u.usergroupNumber = 'ug00016'
                            		-- and u.isLending = 1
                            		and u.userStat = 'A';";*/
             $sql_selectUser = "SELECT s2.scat_discr_2 , u.userName , u.userID , s2.scat_code_2
FROM `user` AS u ,branch  AS b , scat_02 AS s2
WHERE u.userName = '".$isUserID."' AND 
b.branchNumber = u.branchNumber 	
AND b.branchName = s2.scat_discr_2
and s2.cat_code = '1024' 
and s2.scat_code_1 = '102401'
and (u.usergroupNumber = 'ug00016' OR u.usergroupNumber = 'ug00015')
and u.userStat = 'A'
 UNION ALL 
SELECT s8.scat_discr_2 , u1.userName , u1.userID , s8.scat_code_2
FROM `user` AS u1 , deparment  AS d , scat_02 AS s8
WHERE u1.userName = '".$isUserID."' 
AND d.deparmentNumber = u1.deparmentNumber 	
AND d.deparmentName = s8.scat_discr_2
and s8.cat_code = '1024' 
and s8.scat_code_1 = '102401'
and (u1.usergroupNumber = 'ug00016' OR u1.usergroupNumber = 'ug00015')
and u1.userStat = 'A';";

/*$sql_selectUser = "SELECT s2.scat_discr_2 , u.userName , u.userID , s2.scat_code_2
FROM `user` AS u ,branch  AS b , scat_02 AS s2
WHERE u.userName = '".$isUserID."' AND 
b.branchNumber = u.branchNumber 	
AND b.branchName = s2.scat_discr_2
and s2.cat_code = '1024' 
and (u.usergroupNumber = 'ug00016' OR u.usergroupNumber = 'ug00015')
and u.userStat = 'A'";*/
//echo $sql_selectUser;
            $query_selectUser = mysqli_query($conn , $sql_selectUser) or die(mysqli_error($conn));
            while($resalt_selectUser = mysqli_fetch_array($query_selectUser)){
                $sql_count_scat03 = "SELECT MAX(s.scat_code_3) FROM scat_03 AS s WHERE s.cat_code = '1024' AND  s.scat_code_1 = '102401' AND s.scat_code_2 = '".$resalt_selectUser[3]."';";
                $query_count_scat03 = mysqli_query($conn, $sql_count_scat03) or die(mysqli_error($conn));
                while($resalt_count_scat03 = mysqli_fetch_array($query_count_scat03)){
                    $batch_num = $resalt_count_scat03[0]+1;
                }
        
                //$Scat03_code = trim($resalt_selectSact02[2]).str_pad($batch_num, 2, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
        
  
                $sql_inseteScat03 = "INSERT INTO scat_03(cat_code, scat_code_1, scat_code_2, scat_code_3, scat_discr_3, scat_state_3, templet_issue, issue_lbl, decision_state, decision_discription, DefuserID) 
                                  VALUES ('1024','102401','".trim($resalt_selectUser[3])."','".$batch_num."','".trim($resalt_selectUser[2])."','1','','','','','".trim($resalt_selectUser[1])."');";
                //echo $sql_inseteScat03."<br/>";
                $suery_insert = mysqli_query($conn,$sql_inseteScat03) or die(mysqli_error($conn));
                if($suery_insert && $query_selectUser){
                    echo "OK";
                }else{
                    echo "NOT";
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