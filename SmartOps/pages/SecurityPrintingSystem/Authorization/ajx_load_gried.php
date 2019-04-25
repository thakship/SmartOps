<?php
    if(isset($_REQUEST['var_spa_batch']) && isset($_REQUEST['var_spa_gen_by']) && isset($_REQUEST['var_spa_gen_on']) && isset($_REQUEST['var_spa_user_Id'])){
        security_printing_authorization(trim($_REQUEST['var_spa_batch']),trim($_REQUEST['var_spa_gen_by']),trim($_REQUEST['var_spa_gen_on']),trim($_REQUEST['var_spa_user_Id']));
    }
     if(isset($_REQUEST['get_var_aa']) && isset($_REQUEST['get_var_bb']) && isset($_REQUEST['get_var_ee']) && isset($_REQUEST['get_var_ff']) && isset($_REQUEST['get_var_user'])){
        security_printing_authorization_gried(trim($_REQUEST['get_var_aa']),trim($_REQUEST['get_var_bb']),trim($_REQUEST['get_var_ee']),trim($_REQUEST['get_var_ff']),trim($_REQUEST['get_var_user']));
    }
    
    if(isset($_REQUEST['get_var_bb_po']) && isset($_REQUEST['get_var_ee_po']) && isset($_REQUEST['get_var_ff_po']) && isset($_REQUEST['get_var_user_po']) && isset($_REQUEST['get_var_aa_po'])){
        //echo $_REQUEST['get_var_bb_po']."--".$_REQUEST['get_var_ee_po']."--".$_REQUEST['get_var_ff_po']."--".$_REQUEST['get_var_user_po']."--".$_REQUEST['get_var_aa_po'] ;
        
        security_printing_authorization_gried_PO(trim($_REQUEST['get_var_bb_po']),trim($_REQUEST['get_var_ee_po']),trim($_REQUEST['get_var_ff_po']),trim($_REQUEST['get_var_user_po']),trim($_REQUEST['get_var_aa_po']));
        
        
    }
    
    if(isset($_REQUEST['var_BC_DATE']) && isset($_REQUEST['var_AUTHBY']) ){
       // echo $_REQUEST['var_BC_DATE']."--".$_REQUEST['var_AUTHBY']."BC";
        Balance_Confirmation_Auth_viwe($_REQUEST['var_BC_DATE'],$_REQUEST['var_AUTHBY']);
        
        
    }
    
    if(isset($_REQUEST['var_spa_batchcbl05_approve']) && isset($_REQUEST['var_spa_gen_by_cbl05']) ){
      // echo $_REQUEST['var_spa_batchcbl05_approve']."--".$_REQUEST['var_spa_gen_by_cbl05']."A";
       getAuthData_CBL05($_REQUEST['var_spa_batchcbl05_approve'],$_REQUEST['var_spa_gen_by_cbl05']);
        
        
        
    }
    // --------------- 2018-01-24 Madushan Confarmetion of nominee -----------------

    if(isset($_REQUEST['var_request_date']) && isset($_REQUEST['var_auth_by']) && isset($_REQUEST['varTypeCoe'])){
        //echo $_REQUEST['var_request_date']."--".$_REQUEST['var_auth_by']." -- ".$_REQUEST['varTypeCoe']."NOM";
        if($_REQUEST['varTypeCoe'] == "COND"){
             Nominee_Confirmation_Auth_viwe($_REQUEST['var_request_date'],$_REQUEST['var_auth_by']);
        }
        elseif($_REQUEST['varTypeCoe'] == "COND2"){
             Nominee_Confirmation_Auth_viwe_bulk($_REQUEST['var_request_date'],$_REQUEST['var_auth_by']);
             }
        
        else{
            echo "Un-defind Letter Type";
        }
       
        
        
    }
    
     if(isset($_REQUEST['get_txttypea'])){
        //echo $_REQUEST['get_txttypea'];
        if(trim($_REQUEST['get_txttypea']) == "RLET"){
            //echo "RLET-OK";
            get_Renewal_Letter(trim($_REQUEST['get_txttypea']));
        }else if(trim($_REQUEST['get_txttypea']) == "SAGR"){
            echo "SAGR - OK";
        }else if(trim($_REQUEST['get_txttypea']) == "BALCON"){
            //echo "BALCON - OK";
            get_Balance_Confirmation_Auth_cat(trim($_REQUEST['get_txttypea']));
            
        }else if(trim($_REQUEST['get_txttypea']) == "COND"){
            //echo "BALCON - OK";
            get_ConfimationOfNominee_Auth_cat(trim($_REQUEST['get_txttypea']));
            
        }
        else if(trim($_REQUEST['get_txttypea']) == "COND2"){
            //echo "BALCON - OK";
            get_ConfimationOfNominee_Auth_catBULK(trim($_REQUEST['get_txttypea']));
            
        }else if(trim($_REQUEST['get_txttypea']) == "CBL05"){
            get_CBL05_Letter(trim($_REQUEST['get_txttypea']));
            
        }else{
            echo "Un-defind Letter Type";
        }
    } 
     if(isset($_REQUEST['get_txttypeapo']) && isset($_REQUEST['gettxtMyUserID'])){
          //echo "PORD - in";
        if(trim($_REQUEST['get_txttypeapo']) == "PORD" || trim($_REQUEST['get_txttypeapo']) == "LEPO3W" || trim($_REQUEST['get_txttypeapo']) == "LEPOGE" || trim($_REQUEST['get_txttypeapo']) == "HPPO3W" || trim($_REQUEST['get_txttypeapo']) == "HPPOGE" || trim($_REQUEST['get_txttypeapo']) == "MOPOLE" || trim($_REQUEST['get_txttypeapo']) == "MPOMB"){
            //echo "PORD - OK";
            //echo $_REQUEST['get_txttypeapo'];
            security_printing_authorization_PO(trim($_REQUEST['get_txttypeapo']),trim($_REQUEST['gettxtMyUserID']));
        }else if(trim($_REQUEST['get_txttypeapo']) == "UCLEPO"){
            //echo "PORD - OK";
            //echo $_REQUEST['get_txttypeapo'];
            ucl_security_printing_authorization_PO(trim($_REQUEST['get_txttypeapo']),trim($_REQUEST['gettxtMyUserID']));
        }else{
            echo "Lettere Type is Invailed.";
        }   
        
        
     }
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}


function getAuthData_CBL05($batch,$authUsre){
      //  echo $batch."--".$authUsre; ------- we can pront echo command and can identify data passing or not passing
          $conn = DatabaseConnection();
   
        $que_sel_det = mysqli_query($conn,"SELECT `LET_TYPE`,`BATCH_NUM`,`GEN_BY`,`GEN_DATE` FROM `sps_cbl05_let_batch` WHERE `BATCH_NUM`='".$batch."';") or die(mysqli_error());
        while($res_sel_det = mysqli_fetch_assoc($que_sel_det)){
            echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
            echo "Letter Type : ".$res_sel_det['LET_TYPE']."<br/><br/>";
            echo "Batch Number : ".$res_sel_det['BATCH_NUM']."<br/><br/>";
            echo "Generated Date / Time : ".$res_sel_det['GEN_DATE']."<br/><br/>";
            echo "Generated By : ".$res_sel_det['GEN_BY']."<br/><br/>";
                     echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Authorize' onclick='isGetRecordGriedCBL05();'/> ";
            
            echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/><br/><br/>";
            echo "</div>";
        }
        
         echo "<div style='display: none;'> 
           <input type='text' name='is_var_ff' id='is_var_ff' value='".$batch."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
            <input type='text' name='is_var_user' id='is_var_user' value='".$authUsre   ."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        </div>";
        echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
       	    <tr style='background-color: #BEBABA;'>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Contract Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Deposit Amount</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
                
            </tr>";
        $sql_load_g = "SELECT `CB_NUMBER`, `CLIENT_NAME`,`DEP_AMOUNT`, `AUTH_1_BY`, `AUTH_2_BY`
                        FROM `sps_cbl05_gen` AS c
                        WHERE c.`BATCH_NUM` = '".$batch."';";
                        
        $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
        $d = 0;
        while($res_load_g = mysqli_fetch_assoc($que_load_g)){
           $d++;
           echo "<tr>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['CB_NUMBER']."</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['CLIENT_NAME']."</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['DEP_AMOUNT']."</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
                
            </tr>";
        }
        echo "</table>";
}

function get_CBL05_Letter($get_txttypea){
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated On</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>No of Entries</span></td>
            
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>";
   $sql_select_sps_let_batch = "SELECT `sps_let_types`.`TYPE_DESC` , 
                                       `sps_cbl05_let_batch`.`GEN_BY`, 
                                       DATE(`sps_cbl05_let_batch`.`GEN_DATE`), 
                                       `sps_cbl05_let_batch`.`BATCH_NUM`,
                                       `sps_cbl05_let_batch`.`No_of_entries`
                                FROM `sps_cbl05_let_batch` , `sps_let_types`
                                WHERE `sps_cbl05_let_batch`.`LET_TYPE` = `sps_let_types`.`TYPE_CODE` AND
                                      `BATCH_STAT` = 'N';";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
   echo "<tr id='tr1' title='1' onclick=''>
        <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txta1' id='txta1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtb1' id='txtb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtc1' id='txtc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtd1' id='txtd1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txte1' id='txte1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>";
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            $sql_user = "SELECT `userID` FROM `user` WHERE `userName` = '".$RES_select_sps_let_batch[1]."';";
            $que_user = mysqli_query($conn, $sql_user)or die(mysqli_error());
            while($res_ussr = mysqli_fetch_array($que_user)){
                $get_user = $res_ussr[0];
            }
            echo "<tr id='tr".$a."' title='".$a."' onclick='loadNewTableCBL05(title);'>
                    <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;' title='".$get_user."'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[2]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[3]."</span><span style='display: none;'><input type='text' name='txtd".$a."' id='txtd".$a."' value='".$RES_select_sps_let_batch[3]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[4]."</span><span style='display: none;'><input type='text' name='txte".$a."' id='txte".$a."' value='".$RES_select_sps_let_batch[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' onclick='loadNewTableCBL05(title);'/></span></td>
                </tr>";   
        }
   }

    echo "</table>";
}



function get_Balance_Confirmation_Auth_cat($get_txttypea){
     $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Request Date</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Count of Request</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>";
   $sql_select_sps_let_batch = "SELECT DATE(bc.cdb) , COUNT(*)
                                    FROM sps_balance_confirmation AS bc 
                                    WHERE bc.AUTH_2_BY = ''
                                    GROUP BY DATE(bc.cdb) ;";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
   echo "<tr id='tr1' title='1' onclick=''>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtb1' id='txtb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtc1' id='txtc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>";
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            echo "<tr id='tr".$a."' title='".$a."' onclick='loadNewTableBC(title);'>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' title='".$a."' onclick='loadNewTableBC(title);'/></span></td>
                </tr>";   
        }
   }

    echo "</table>";
}


//------ 2018-01-24 Madushan - Confimation Of Nominee 
function get_ConfimationOfNominee_Auth_cat($get_txttypea){
     $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Request Date</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Count of Request</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>";
   $sql_select_sps_let_batch = "SELECT DATE(bc.REQUEST_ON) , COUNT(*)
                                   FROM sps_conf_nominee_dtl AS bc 
                                   WHERE bc.AUTH_2_BY = ''
                                   GROUP BY DATE(bc.REQUEST_ON);";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
   echo "<tr id='tr1' title='1' onclick=''>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtb1' id='txtb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtc1' id='txtc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>";
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            echo "<tr id='tr".$a."' title='".$a."'>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' title='".$a."|COND' onclick='loadNewTableVive(title);'/></span></td>
                </tr>";   
        }
   }

    echo "</table>";
}



function get_ConfimationOfNominee_Auth_catBULK($get_txttypea){
     $conn = DatabaseConnection();
//     echo "OK";
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Request Date</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Count of Request</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>";
   $sql_select_sps_let_batch = "SELECT DATE(bc.REQUEST_ON) , COUNT(*)
                                   FROM sps_conf_nominee_dtl_bulk AS bc 
                                   WHERE bc.AUTH_2_BY = ''
                                   GROUP BY DATE(bc.REQUEST_ON);";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
   echo "<tr id='tr1' title='1' onclick=''>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtb1' id='txtb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtc1' id='txtc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
         <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>";
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            echo "<tr id='tr".$a."' title='".$a."'>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' title='".$a."|COND2' onclick='loadNewTableVive(title);'/></span></td>
                </tr>";   
        }
   }

    echo "</table>";
}


function get_Renewal_Letter($get_txttypea){
    $conn = DatabaseConnection();
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>MAT Date</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated On</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>";
   $sql_select_sps_let_batch = "SELECT `sps_let_types`.`TYPE_DESC` , 
                                       `sps_let_batch`.`MAT_DATE` , 
                                       `sps_let_batch`.`GEN_BY`, 
                                       DATE(`sps_let_batch`.`GEN_DATE`), 
                                       `sps_let_batch`.`BATCH_NUM`
                                FROM `sps_let_batch` , `sps_let_types`
                                WHERE `sps_let_batch`.`LET_TYPE` = `sps_let_types`.`TYPE_CODE` AND
                                      `BATCH_STAT` = 'N';";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
   echo "<tr id='tr1' title='1' onclick=''>
        <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txta1' id='txta1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtb1' id='txtb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtc1' id='txtc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtd1' id='txtd1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txte1' id='txte1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>";
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            $sql_user = "SELECT `userID` FROM `user` WHERE `userName` = '".$RES_select_sps_let_batch[2]."';";
            $que_user = mysqli_query($conn, $sql_user)or die(mysqli_error());
            while($res_ussr = mysqli_fetch_array($que_user)){
                $get_user = $res_ussr[0];
            }
            echo "<tr id='tr".$a."' title='".$a."' onclick='loadNewTable(title);'>
                    <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;' title='".$get_user."'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[2]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[3]."</span><span style='display: none;'><input type='text' name='txtd".$a."' id='txtd".$a."' value='".$RES_select_sps_let_batch[3]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[4]."</span><span style='display: none;'><input type='text' name='txte".$a."' id='txte".$a."' value='".$RES_select_sps_let_batch[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' onclick='loadNewTable(title);'/></span></td>
                </tr>";   
        }
   }

    echo "</table>";
}
function security_printing_authorization($var_spa_batch,$var_spa_gen_by,$var_spa_gen_on,$userID){
    $conn = DatabaseConnection();
    echo "<div style='margin-left: 50px;'>
            <input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/>
</div><br/>";
    $sql_load_table = "SELECT slb.`TYPE_CODE`,
                                 slb.`AMT_FROM`,
                                 slb.`AMT_TO` ,
                                (SELECT COUNT(*)
                                 FROM `sps_let_gen` t1, `sps_let_batch` st2
                                 where st2.`LET_TYPE` = t1.`LET_TYPE`
								   and st2.`BATCH_NUM` = t1.`BATCH_NUM`
								   and st2.`BATCH_STAT` = 'N'
								   and t1.`BATCH_NUM` = '".$var_spa_batch."'
								   and (t1.`AUTH_1_DATE` = '0000-00-00 00:00:00' OR t1.`AUTH_2_DATE` = '0000-00-00 00:00:00' ) AND t1.`dep_amt` >= slb.`AMT_FROM` AND t1.`dep_amt` <= slb.`AMT_TO`) AS Num_letters
                         FROM `sps_let_amt_slabs` slb ,`sps_sig_groups_users` t3
                         WHERE slb.`SIG_GRPCODE` = t3.`SIG_GRPCODE`  
                         AND t3.`TYPE_CODE` = slb.`TYPE_CODE` 
                         AND slb.TYPE_CODE = 'RLET'
                         AND t3.`USER_ID` = '".$userID."';";
    $que_load_table = mysqli_query($conn,$sql_load_table) or die(mysqli_error());
    $rowcount = 0;
    $rowcount = mysqli_num_rows($que_load_table);
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Generated Date</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount Slab</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Entries to Be Auth</span></td>
            
        </tr>";
    if($rowcount == 0){
        echo "<tr id='trsub1' title='1' onclick='' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtaa1' id='txtaa1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtbb1' id='txtbb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtcc1' id='txtcc1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtdd1' id='txtdd1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtee1' id='txtee1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff1' id='txtff1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtgg1' id='txtgg1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            </tr>";
    }else{
        $x = 0;
        while($res_load_table = mysqli_fetch_array($que_load_table)){
            $x++;
            if($res_load_table[3] != 0){
            echo "<tr id='trsub".$x."' title='".$x."' onclick='getAthGried(title);' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[0]."</span><span style='display: none;'><input type='text' name='txtaa".$x."' id='txtaa".$x."' value='".$res_load_table[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$var_spa_batch."</span><span style='display: none;'><input type='text' name='txtbb".$x."' id='txtbb".$x."' value='".$var_spa_batch."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$var_spa_gen_on."</span><span style='display: none;'><input type='text' name='txtcc".$x."' id='txtcc".$x."' value='".$var_spa_gen_on."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$var_spa_gen_by."</span><span style='display: none;'><input type='text' name='txtdd".$x."' id='txtdd".$x."' value='".$var_spa_gen_by."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[1]." - ".$res_load_table[2]."</span><span style='display: none;'><input type='text' name='txtee".$x."' id='txtee".$x."' value='".$res_load_table[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff".$x."' id='txtff".$x."' value='".$res_load_table[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[3]."</span><span style='display: none;'><input type='text' name='txtgg".$x."' id='txtgg".$x."' value='".$res_load_table[3]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                        </tr>";
            }
        }
    }
    echo "</table>";
}       

function security_printing_authorization_PO($get_txttypea,$gettxtMyUserID){
    $conn = DatabaseConnection();
    //echo $get_txttypea."OK";
   echo "<div style='margin-left: 50px;'>
            <input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/>
</div><br/>";
    $sql_load_table = "SELECT slb.TYPE_CODE,
                               po.cbd,
                               slb.SLAB_SER,
                               (select concat(slbs.AMT_FROM , ' - ' , slbs.AMT_TO) from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO,
                               (select count(*) from sps_po_gen pos where pos.cbd = po.cbd and pos.asset_price >= slb.AMT_FROM and pos.asset_price <= slb.AMT_TO and pos.`TYPE_CODE`  = '".$get_txttypea."' and pos.AUTH_2_BY = '') AS Num_letters,
                               (select slbs.AMT_FROM from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO1,
                               (select slbs.AMT_TO from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO2
                        FROM sps_let_amt_slabs AS slb ,
                             sps_sig_groups_users AS t3,
                             sps_po_gen AS po
                        WHERE slb.`SIG_GRPCODE` = t3.`SIG_GRPCODE`  
                          AND t3.`TYPE_CODE` = slb.`TYPE_CODE` 
                          AND slb.TYPE_CODE = '".$get_txttypea."'
                   	      AND t3.`USER_ID` = '".$gettxtMyUserID."'  
                          AND po.`TYPE_CODE`  = '".$get_txttypea."'
                          AND po.AUTH_2_BY = ''
                          AND date(po.cbd) >= (CURRENT_DATE - INTERVAL 7 DAY)
                        group by po.cbd,slb.TYPE_CODE,slb.SLAB_SER ;";
    //echo $sql_load_table;
    $que_load_table = mysqli_query($conn,$sql_load_table) or die(mysqli_error());
    $rowcount = 0;
    $rowcount = mysqli_num_rows($que_load_table);
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Curr. bus. Day</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount Slab</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Entries to Be Auth</span></td>
            
        </tr>";
    if($rowcount == 0){
        echo "<tr id='trsub1' title='1' onclick='' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtaa1' id='txtaa1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtbb1' id='txtbb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtee1' id='txtee1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff1' id='txtff1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtgg1' id='txtgg1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            </tr>";
    }else{
        $x = 0;
        while($res_load_table = mysqli_fetch_array($que_load_table)){
            if($res_load_table[4] != 0){
                $x++;
                echo "<tr id='trsub".$x."' title='".$x."' onclick='getAthGriedPO(title);' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[0]."</span><span style='display: none;'><input type='text' name='txtaa".$x."' id='txtaa".$x."' value='".$res_load_table[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[1]."</span><span style='display: none;'><input type='text' name='txtbb".$x."' id='txtbb".$x."' value='".$res_load_table[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[3]."</span><span style='display: none;'><input type='text' name='txtee".$x."' id='txtee".$x."' value='".$res_load_table[5]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff".$x."' id='txtff".$x."' value='".$res_load_table[6]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[4]."</span><span style='display: none;'><input type='text' name='txtgg".$x."' id='txtgg".$x."' value='".$res_load_table[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            </tr>";
            }
           
        }
    }
    echo "</table>";
}       

//-------------------------- Madushan 2018-04-18 UCL -------------------


function ucl_security_printing_authorization_PO($get_txttypea,$gettxtMyUserID){
    $conn = DatabaseConnection();
    //echo $get_txttypea."OK";
   echo "<div style='margin-left: 50px;'>
            <input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/>
</div><br/>";
    $sql_load_table = "SELECT slb.TYPE_CODE,
                               po.cbd,
                               slb.SLAB_SER,
                               (select concat(slbs.AMT_FROM , ' - ' , slbs.AMT_TO) from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO,
                               (select count(*) from ucl_sps_po_gen pos where pos.cbd = po.cbd and pos.asset_price >= slb.AMT_FROM and pos.asset_price <= slb.AMT_TO and pos.`TYPE_CODE`  = '".$get_txttypea."' and pos.AUTH_2_BY = '') AS Num_letters,
                               (select slbs.AMT_FROM from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO1,
                               (select slbs.AMT_TO from sps_let_amt_slabs slbs WHERE slbs.TYPE_CODE = '".$get_txttypea."' AND slbs.SLAB_SER = slb.SLAB_SER) AS SLABINFO2
                        FROM sps_let_amt_slabs AS slb ,
                             sps_sig_groups_users AS t3,
                             ucl_sps_po_gen AS po
                        WHERE slb.`SIG_GRPCODE` = t3.`SIG_GRPCODE`  
                          AND t3.`TYPE_CODE` = slb.`TYPE_CODE` 
                          AND slb.TYPE_CODE = '".$get_txttypea."'
                   	      AND t3.`USER_ID` = '".$gettxtMyUserID."'  
                          AND po.`TYPE_CODE`  = '".$get_txttypea."'
                          AND po.AUTH_2_BY = ''
                        group by po.cbd,slb.TYPE_CODE,slb.SLAB_SER ;";
    //echo $sql_load_table;
    $que_load_table = mysqli_query($conn,$sql_load_table) or die(mysqli_error());
    $rowcount = 0;
    $rowcount = mysqli_num_rows($que_load_table);
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Curr. bus. Day</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount Slab</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Entries to Be Auth</span></td>
            
        </tr>";
    if($rowcount == 0){
        echo "<tr id='trsub1' title='1' onclick='' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtaa1' id='txtaa1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtbb1' id='txtbb1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtee1' id='txtee1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff1' id='txtff1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style='display: none;'><input type='text' name='txtgg1' id='txtgg1' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            </tr>";
    }else{
        $x = 0;
        while($res_load_table = mysqli_fetch_array($que_load_table)){
            if($res_load_table[4] != 0){
                $x++;
                echo "<tr id='trsub".$x."' title='".$x."' onclick='getAthGriedPO(title);' onmouseover='isChangeRowColoerOverSub(title);' onmouseout='isChangeRowColoerDownSub(title);'>
                                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[0]."</span><span style='display: none;'><input type='text' name='txtaa".$x."' id='txtaa".$x."' value='".$res_load_table[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[1]."</span><span style='display: none;'><input type='text' name='txtbb".$x."' id='txtbb".$x."' value='".$res_load_table[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[3]."</span><span style='display: none;'><input type='text' name='txtee".$x."' id='txtee".$x."' value='".$res_load_table[5]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /><input type='text' name='txtff".$x."' id='txtff".$x."' value='".$res_load_table[6]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_table[4]."</span><span style='display: none;'><input type='text' name='txtgg".$x."' id='txtgg".$x."' value='".$res_load_table[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                            </tr>";
            }
           
        }
    }
    echo "</table>";
}       

//------------------------------------------------------------------------- END -------------------------------------------------------
function security_printing_authorization_gried($get_var_aa,$get_var_bb,$get_var_ee,$get_var_ff,$get_var_user){
    $conn = DatabaseConnection();
   
    $que_sel_det = mysqli_query($conn,"SELECT `LET_TYPE`,`BATCH_NUM`,`GEN_BY`,`GEN_DATE` FROM `sps_let_batch` WHERE `BATCH_NUM`='".$get_var_bb."';") or die(mysqli_error());
    while($res_sel_det = mysqli_fetch_assoc($que_sel_det)){
        echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
        echo "Letter Type : ".$res_sel_det['LET_TYPE']."<br/><br/>";
        echo "Batch Number : ".$res_sel_det['BATCH_NUM']."<br/><br/>";
        echo "Generated Date / Time : ".$res_sel_det['GEN_DATE']."<br/><br/>";
        echo "Generated By : ".$res_sel_det['GEN_BY']."<br/><br/>";
        $qu_sel_1 = mysqli_query($conn, "SELECT  DISTINCT`AUTH_1_BY` FROM `sps_let_gen` AS t1 WHERE t1.`BATCH_NUM` = '".$get_var_bb."' AND (t1.`dep_amt` BETWEEN '".$get_var_ee."' AND '".$get_var_ff."');") or die(mysqli_error());
        while($res_sel_1 = mysqli_fetch_array($qu_sel_1)){
            if($res_sel_1[0] != $get_var_user){
                 echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Authorize' onclick='isGetRecordGried();'/> ";
            }
        }
       
        echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/><br/><br/>";
        echo "</div>";
    }
    
     echo "<div style='display: none;'> 
        <input type='text' name='is_var_aa' id='is_var_aa' value='".$get_var_aa."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_bb' id='is_var_bb' value='".$get_var_bb."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_ee' id='is_var_ee' value='".$get_var_ee."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_ff' id='is_var_ff' value='".$get_var_ff."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_user' id='is_var_user' value='".$get_var_user."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
    </div>";
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Deposit /Contract Number</span></td>
            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Deposit /Contract Name</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Deposit Amount</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Maturity Date</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
            
        </tr>";
    $sql_load_g = "SELECT `DEPOSIT_NUM`, `CL_NAME_1`,`dep_amt`, `MAT_DATE`, `AUTH_1_BY`, `AUTH_2_BY`
                    FROM `sps_let_gen` AS t1
                    WHERE t1.`BATCH_NUM` = '".$get_var_bb."' AND (t1.`dep_amt` BETWEEN '".$get_var_ee."' AND '".$get_var_ff."');";
    $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
    $d = 0;
    while($res_load_g = mysqli_fetch_assoc($que_load_g)){
       $d++;
       echo "<tr>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['DEPOSIT_NUM']."</span></td>
            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['CL_NAME_1']."</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['dep_amt']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['MAT_DATE']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
            
        </tr>";
    }
    echo "</table>";
}

function Balance_Confirmation_Auth_viwe($var_BC_DATE,$var_AUTHBY){
    $conn = DatabaseConnection();
    $sql_s = "SELECT COUNT(*) FROM sps_sig_groups_users AS su WHERE su.TYPE_CODE = 'BALCON' AND su.USER_ID = '".$var_AUTHBY."';";
    //echo $sql_s;
    $que_sel_det = mysqli_query($conn,$sql_s) or die(mysqli_error());
    
    while($res_sel_det = mysqli_fetch_array($que_sel_det)){
        if($res_sel_det[0] != 0){
             echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
           /* $qu_sel_1 = mysqli_query($conn, "SELECT  DISTINCT`AUTH_1_BY` FROM `sps_let_gen` AS t1 WHERE t1.`BATCH_NUM` = '".$get_var_bb."' AND (t1.`dep_amt` BETWEEN '".$get_var_ee."' AND '".$get_var_ff."');") or die(mysqli_error());
            while($res_sel_1 = mysqli_fetch_array($qu_sel_1)){
                if($res_sel_1[0] != $get_var_user){
                     echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Authorize' onclick='isGetRecordGried();'/> ";
                }
            }*/
            echo "<div style='display: none;'> 
               <input type='text' name='is_var_user' id='is_var_user' value='".$var_AUTHBY."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
            </div>";
           echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/><br/><br/>";
           echo "</div>";
           echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
               	    <tr style='background-color: #BEBABA;'>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Client Code</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                        
                    </tr>";
                $sql_load_g = "SELECT bc.V_INDEX , bc.CLIENT_CODE , bc.V_NAME_INIT , bc.AUTH_1_BY , bc.AUTH_2_BY
                                FROM sps_balance_confirmation AS  bc  WHERE DATE(bc.cdb) = '".$var_BC_DATE."' AND bc.AUTH_2_BY = '';";
                                    //echo $sql_load_g;
                $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
                $d = 0;
                $rr = 0;
                while($res_load_g = mysqli_fetch_assoc($que_load_g)){
                   $d++;
                   if($res_load_g['AUTH_1_BY'] != $var_AUTHBY){
                    $rr++;
                       echo "<tr>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
                            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>
                                                                         <div  style='display:none;'>
                                                                         <input class='txt' type='text' name='txtV_INDEX".$d."' id='txtV_INDEX".$d."' value='".$res_load_g['V_INDEX']."'/>
                                                                         </div>".$res_load_g['CLIENT_CODE']."
                                                                       </span>
                                                                       </td>
                            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['V_NAME_INIT']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'><input type='checkbox' name='chka".$d."' id='chka".$d."'/></span></td>
                        </tr>";
                    }
                }
                echo "</table>";
                if($rr != 0){
                    echo "<br/><input class='buttonManage' style='width: 100px;' type='button' name='btnClose2' id='btnClose2' value='Authorize' title = '".$d."' onclick='isGetauthBC(title);'/> ";
                }
                
        }
       
    }
   
    
}



/// ----------------- 2018-01-24 Madushan  Nomini Comfrmation 

function Nominee_Confirmation_Auth_viwe($var_request_date,$var_auth_by){
    $conn = DatabaseConnection();
    $sql_s = "SELECT COUNT(*) FROM sps_sig_groups_users AS su WHERE su.TYPE_CODE = 'BALCON' AND su.USER_ID = '".$var_auth_by."';";
    //echo $sql_s;
    $que_sel_det = mysqli_query($conn,$sql_s) or die(mysqli_error());
    
    while($res_sel_det = mysqli_fetch_array($que_sel_det)){
        if($res_sel_det[0] != 0){
            echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
            echo "<div style='display: none;'> 
                    <input type='text' name='is_var_user' id='is_var_user' value='".$var_auth_by."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
                 </div>";
           echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/><br/><br/>";
           echo "</div>";
           echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
               	    <tr style='background-color: #BEBABA;'>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Account No</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Nominee Name</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                        
                    </tr>";
                $sql_load_g = "SELECT bc.V_INDEX , bc.ACC_NO , bc.NOMINEE_NAME , bc.AUTH_1_BY , bc.AUTH_2_BY
                                FROM sps_conf_nominee_dtl AS  bc  WHERE DATE(bc.REQUEST_ON) = '".$var_request_date."' AND bc.AUTH_2_BY = '';";
                                    //echo $sql_load_g;
                $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
                $d = 0;
                $rr = 0;
                while($res_load_g = mysqli_fetch_assoc($que_load_g)){
                   $d++;
                   if($res_load_g['AUTH_1_BY'] != $var_auth_by){
                    $rr++;
                       echo "<tr>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
                            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>
                                                                         <div  style='display:none;'>
                                                                         <input class='txt' type='text' name='txtV_INDEX".$d."' id='txtV_INDEX".$d."' value='".$res_load_g['V_INDEX']."'/>
                                                                         </div>".$res_load_g['ACC_NO']."
                                                                       </span>
                                                                       </td>
                            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['NOMINEE_NAME']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'><input type='checkbox' name='chka".$d."' id='chka".$d."'/></span></td>
                        </tr>";
                    }
                }
                echo "</table>";
                if($rr != 0){
                    echo "<br/><input class='buttonManage' style='width: 100px;' type='button' name='btnClose2' id='btnClose2' value='Authorize' title = '".$d."|COND' onclick='isGetauthCommon(title);'/> ";
                }
                
        }
       
    }
   
    
    
}

function Nominee_Confirmation_Auth_viwe_bulk($var_request_date,$var_auth_by){
    $conn = DatabaseConnection();
    //$sql_s = "SELECT COUNT(*) FROM sps_sig_groups_users AS su WHERE su.TYPE_CODE = 'BALCON' AND su.USER_ID = '".$var_auth_by."';";
    //echo $sql_s;
    //$que_sel_det = mysqli_query($conn,$sql_s) or die(mysqli_error());
    
    //while($res_sel_det = mysqli_fetch_array($que_sel_det)){
        //if($res_sel_det[0] != 0){
            echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
            echo "<div style='display: none;'> 
                    <input type='text' name='is_var_user' id='is_var_user' value='".$var_auth_by."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
                 </div>";
           echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/><br/><br/>";
           echo "</div>";
           echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
               	    <tr style='background-color: #BEBABA;'>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Ref No</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Code</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
                        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
                        <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                        
                    </tr>";
                $sql_load_g = "SELECT bc.V_INDEX ,
                                      bc.REF_ID,
                                      bc.CLIENT_CO , 
                                      bc.AUTH_1_BY , 
                                      bc.AUTH_2_BY
                                FROM sps_conf_nominee_dtl_bulk AS  bc  WHERE DATE(bc.REQUEST_ON) = '".$var_request_date."' AND bc.AUTH_2_BY = '';";
                                    //echo $sql_load_g;
                $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
                $d = 0;
                $rr = 0;
                while($res_load_g = mysqli_fetch_assoc($que_load_g)){
                   $d++;
                   if($res_load_g['AUTH_1_BY'] != $var_auth_by){
                    $rr++;
                       echo "<tr>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
                            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>
                                                                         <div  style='display:none;'>
                                                                         <input class='txt' type='text' name='txtV_INDEX".$d."' id='txtV_INDEX".$d."' value='".$res_load_g['V_INDEX']."'/>
                                                                         </div>".$res_load_g['REF_ID']."
                                                                       </span>
                                                                       </td>
                            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['CLIENT_CO']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
                            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
                            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'><input type='checkbox' name='chka".$d."' id='chka".$d."'/></span></td>
                        </tr>";
                    }
                }
                echo "</table>";
                if($rr != 0){
                    echo "<br/><input class='buttonManage' style='width: 100px;' type='button' name='btnClose2' id='btnClose2' value='Authorize' title = '".$d."|COND2' onclick='isGetauthCommon(title);'/> ";
                }
                
        //}
       
    //}
   
    
    
}



function security_printing_authorization_gried_PO($get_var_cbd_po,$get_var_l_amount_po,$get_var_h_amount_po,$get_athu_user_po,$get_var_aa_po){
   //echo $get_var_cbd_po.$get_var_l_amount_po.$get_var_h_amount_po.$get_athu_user_po.$get_var_aa_po."OK";
   $conn = DatabaseConnection();
   
        echo "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 50px;'>";
        echo "Letter Type : ".$get_var_aa_po."<br/><br/>";
        echo "Curr. bus. Day : ".$get_var_cbd_po."<br/><br/>";
        echo "Amount Slab : ".$get_var_l_amount_po." - ".$get_var_h_amount_po."<br/><br/>";
        
        // Button Creation  Authorize 
        /*
        $qu_sel_1 = mysqli_query($conn, "SELECT  DISTINCT`AUTH_1_BY` FROM `sps_po_gen` AS t1 WHERE t1.`cbd` = '".$get_var_cbd_po."' AND t1.`TYPE_CODE` = '".$get_var_aa_po."' AND (t1.`asset_price` BETWEEN '".$get_var_l_amount_po."' AND '".$get_var_h_amount_po."');") or die(mysqli_error());
        while($res_sel_1 = mysqli_fetch_array($qu_sel_1)){
            if($res_sel_1[0] != $get_athu_user_po){
                 echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Authorize' onclick='isGetRecordGriedpo();'/> ";
            }
        }
        */
        //echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose1' id='btnClose1' value='Authorize' onclick='isGetRecordGriedpo();'/> ";
        echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose3' id='btnClose3' value='Close' onclick='pageClose();'/><br/><br/>";
        echo "</div>";
    
     echo "<div style='display: none;'> 
        <input type='text' name='is_var_aa' id='is_var_aa' value='".$get_var_cbd_po."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_bb' id='is_var_bb' value='".$get_var_l_amount_po."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_ee' id='is_var_ee' value='".$get_var_h_amount_po."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_ff' id='is_var_ff' value='".$get_athu_user_po."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        <input type='text' name='is_var_ff' id='is_var_gg' value='".$get_var_aa_po."' onkeypress='return disableEnterKey(event)' readonly='readonly' />
    </div>";
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Seq.</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Facility Number</span></td>
            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Asset Amount</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Curr. busi. day</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 1</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Authorized 2</span></td>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
            
        </tr>";
    $sql_load_g = "SELECT spg.fac_no AS fac_no , spg.client_name AS client_name, spg.asset_price AS asset_price , spg.cbd AS cbd ,spg.AUTH_1_BY AS AUTH_1_BY ,  spg.AUTH_2_BY AS AUTH_2_BY ";
    if($get_var_aa_po == "UCLEPO"){
        $sql_load_g .= "FROM ucl_sps_po_gen AS spg ";
    }else{
        $sql_load_g .= "FROM sps_po_gen AS spg ";
    }
    
    $sql_load_g .=  "WHERE spg.cbd = '".$get_var_cbd_po."'  AND spg.`TYPE_CODE` = '".$get_var_aa_po."' AND spg.AUTH_2_BY = '' AND (spg.asset_price BETWEEN '".$get_var_l_amount_po."' AND '".$get_var_h_amount_po."');";
                        //echo $sql_load_g;
    $que_load_g = mysqli_query($conn, $sql_load_g) or die(mysqli_error());
    $d = 0;
    while($res_load_g = mysqli_fetch_assoc($que_load_g)){
       $d++;
       echo "<tr>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$d."</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>
                                                         <div  style='display:none;'>
                                                         <input class='txt' type='text' name='txtFacNo".$d."' id='txtFacNo".$d."' value='".$res_load_g['fac_no']."'/>
                                                         </div>".$res_load_g['fac_no']."
                                                       </span>
                                                       </td>
            <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['client_name']."</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['asset_price']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['cbd']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_1_BY']."</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_load_g['AUTH_2_BY']."</span></td>
            <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'><input type='checkbox' name='chka".$d."' id='chka".$d."'/></span></td>
            
        </tr>";
    }
    echo "</table>";
    echo "<br/><input class='buttonManage' style='width: 100px;' type='button' name='btnClose2' id='btnClose2' value='Authorize' title = '".$d."' onclick='isGetRecordGriedNewpo(title);'/> ";
}
?>
    
        