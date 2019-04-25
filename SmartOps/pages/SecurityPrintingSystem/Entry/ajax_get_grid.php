<?php
	session_start();
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }  
    
//........................................ Function Calling.........................................................
if(isset($_REQUEST['get_vae_txtMyUserID']) && isset($_REQUEST['get_vae_txtMyUserGroup'])){
   //echo $_REQUEST['get_vae_txtMyUserID']."--".$_REQUEST['get_vae_txtMyUserGroup'];
   get_print_RLET(trim($_REQUEST['get_vae_txtMyUserID']),trim($_REQUEST['get_vae_txtMyUserGroup']));
}

if(isset($_REQUEST['get_txttypeapo']) && isset($_REQUEST['gettxtMyUserID']) && isset($_REQUEST['getvar_txttypea'])){
  // echo $_REQUEST['get_txttypeapo']. " -- ".$_REQUEST['gettxtMyUserID']."--".$_REQUEST['getvar_txttypea'];
   get_print_PORD(trim($_REQUEST['get_txttypeapo']),trim($_REQUEST['gettxtMyUserID']),trim($_REQUEST['getvar_txttypea']));
}

if(isset($_REQUEST['get_txttypeaBC']) && isset($_REQUEST['gettxtMyUserBC'])){
   get_print_BC(trim($_REQUEST['get_txttypeaBC']),trim($_REQUEST['gettxtMyUserBC']));
}

if(isset($_REQUEST['getLetType']) && isset($_REQUEST['getEntryUser'])){
    if($_REQUEST['getLetType'] == "COND"){
        get_print_Table_COND(trim($_REQUEST['getLetType']),trim($_REQUEST['getEntryUser']));
    }else if($_REQUEST['getLetType'] == "CBL05"){
       // echo $_REQUEST['getLetType'];
       get_print_Table_CBL05(trim($_REQUEST['getLetType']),trim($_REQUEST['getEntryUser']));
    }
    else if($_REQUEST['getLetType'] == "COND2"){
       // echo $_REQUEST['getLetType'];
       get_print_Table_COND_BULK(trim($_REQUEST['getLetType']),trim($_REQUEST['getEntryUser']));
       }
    
    else{
        
    }
   
}

if(isset($_REQUEST['get_fac_num_print_OP']) && isset($_REQUEST['get_Sys_num_po']) && isset($_REQUEST['get_v_user_print']) && isset($_REQUEST['get_v_type'])){
   //echo $_REQUEST['get_fac_num_print_OP']."--".$_REQUEST['get_Sys_num_po']."--".$_REQUEST['get_v_type'];
    print_PO_letter(trim($_REQUEST['get_fac_num_print_OP']),trim($_REQUEST['get_Sys_num_po']),trim($_REQUEST['get_v_user_print']),trim($_REQUEST['get_v_type']));
}
if(isset($_REQUEST['get_fac_num_print_supAger']) && isset($_REQUEST['get_Sys_num_supAger']) && isset($_REQUEST['get_v_user_print_supAger']) && isset($_REQUEST['get_v_type_supAger'])){
   //echo $_REQUEST['get_fac_num_print_OP']."--".$_REQUEST['get_Sys_num_po']."--".$_REQUEST['get_v_type'];
   
   if($_REQUEST['get_v_type_supAger'] == "UCLEPO") {
        //echo "OK";
        ucl_print_supAger_letter(trim($_REQUEST['get_fac_num_print_supAger']),trim($_REQUEST['get_Sys_num_supAger']),trim($_REQUEST['get_v_user_print_supAger']),trim($_REQUEST['get_v_type_supAger'])); 
   }else{
       print_supAger_letter(trim($_REQUEST['get_fac_num_print_supAger']),trim($_REQUEST['get_Sys_num_supAger']),trim($_REQUEST['get_v_user_print_supAger']),trim($_REQUEST['get_v_type_supAger']));
   }
    
}
if(isset($_REQUEST['get_fac_num_print_Mortgage']) && isset($_REQUEST['get_Sys_num_Mortgage']) && isset($_REQUEST['get_v_user_print_Mortgage']) && isset($_REQUEST['get_v_type_Mortgage'])){
 
   //echo $_REQUEST['get_fac_num_print_Mortgage']."--".$_REQUEST['get_Sys_num_Mortgage']."--".$_REQUEST['get_v_user_print_Mortgage']."--".$_REQUEST['get_v_type_Mortgage'];
   print_Mortgage_letter(trim($_REQUEST['get_fac_num_print_Mortgage']),trim($_REQUEST['get_Sys_num_Mortgage']),trim($_REQUEST['get_v_user_print_Mortgage']),trim($_REQUEST['get_v_type_Mortgage']));
}

if(isset($_REQUEST['get_fac_num_print_MURA_Mortgage']) && isset($_REQUEST['get_Sys_num_MURA_Mortgage']) && isset($_REQUEST['get_v_user_print_MURA_Mortgage']) && isset($_REQUEST['get_v_type_MURA_Mortgage'])){
 
   //echo $_REQUEST['get_fac_num_print_MURA_Mortgage']."--".$_REQUEST['get_Sys_num_MURA_Mortgage']."--".$_REQUEST['get_v_user_print_MURA_Mortgage']."--".$_REQUEST['get_v_type_MURA_Mortgage'];
   print_Mortgage_MURA_letter(trim($_REQUEST['get_fac_num_print_MURA_Mortgage']),trim($_REQUEST['get_Sys_num_MURA_Mortgage']),trim($_REQUEST['get_v_user_print_MURA_Mortgage']),trim($_REQUEST['get_v_type_MURA_Mortgage']));
}

if(isset($_REQUEST['get_index_BC']) && isset($_REQUEST['get_clint_code_bc']) && isset($_REQUEST['get_v_user_print_BC']) && isset($_REQUEST['get_v_type_BC'])){
    //echo   $_REQUEST['get_index_BC'];
   print_balanceCompermetion(trim($_REQUEST['get_index_BC']),trim($_REQUEST['get_clint_code_bc']),trim($_REQUEST['get_v_user_print_BC']),trim($_REQUEST['get_v_type_BC']));
}

//------ 2018-01-26 Madushan - Common Calling Print Function ------------------- 
if(isset($_REQUEST['get_LetterType_Print']) && isset($_REQUEST['get_Index_Print']) && isset($_REQUEST['get_Print_User'])){
   // echo   $_REQUEST['get_LetterType_Print'] ." - ". $_REQUEST['get_Index_Print'] ." - ". $_REQUEST['get_Print_User'];
    if($_REQUEST['get_LetterType_Print'] == "COND"){
         print_ConfirmationOfNomineeDatails(trim($_REQUEST['get_Index_Print']),trim($_REQUEST['get_Print_User']));
    } elseif($_REQUEST['get_LetterType_Print'] == "COND2"){
      //  echo   $_REQUEST['get_LetterType_Print'] ." - ". $_REQUEST['get_Index_Print'] ." - ". $_REQUEST['get_Print_User'];
         print_ConfirmationOfNomineeDatails_Bulk(trim($_REQUEST['get_Index_Print']),trim($_REQUEST['get_Print_User']));
    }
    
    else if($_REQUEST['get_LetterType_Print'] == "CBL05"){
      //  echo   $_REQUEST['get_LetterType_Print'] ." - ". $_REQUEST['get_Index_Print'] ." - ". $_REQUEST['get_Print_User'];
        print_CBL05_letter(trim($_REQUEST['get_Index_Print']),trim($_REQUEST['get_Print_User']));
    }else{
        echo "Un-Definded Letter";
    }
  
}
function get_print_RLET($get_vae_txtMyUserID,$get_vae_txtMyUserGroup){
    $conn = DatabaseConnection();
    //echo $get_vae_txtMyUserID." -- ".$get_vae_txtMyUserGroup."OK";
    
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Maturity Date</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>No. of Entries</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Print Serial</span></td>
            </tr>";
        
        
        /*$sql_get_tbl_01 = "SELECT slb.`LET_TYPE` , 
                                  slb.`BATCH_NUM`, 
                                  slb.`MAT_DATE`, 
                                  (SELECT COUNT(*) FROM `sps_let_gen` AS slg WHERE slg.`LET_TYPE` = slb.`LET_TYPE` AND slg.`BATCH_NUM` = slb.`BATCH_NUM`)
                            FROM `sps_let_batch` AS slb 
                            WHERE slb.`BATCH_STAT` = 'A' AND slb.`GEN_BY` = '".$_SESSION['user']."';";*/
      $sql_get_tbl_01 = "SELECT slb.`LET_TYPE` , 
                                  slb.`BATCH_NUM`, 
                                  slb.`MAT_DATE`, 
                                  (SELECT COUNT(*) FROM `sps_let_gen` AS slg WHERE slg.`LET_TYPE` = slb.`LET_TYPE` AND slg.`BATCH_NUM` = slb.`BATCH_NUM`)
                            FROM `sps_let_batch` AS slb 
                            WHERE slb.`BATCH_STAT` = 'A' AND 
                                  slb.`u_type` = 'U' AND
                                  slb.`u_source` = '".$get_vae_txtMyUserID."'
                            UNION ALL
                            SELECT slb.`LET_TYPE` , 
                                  slb.`BATCH_NUM`, 
                                  slb.`MAT_DATE`, 
                                  (SELECT COUNT(*) FROM `sps_let_gen` AS slg WHERE slg.`LET_TYPE` = slb.`LET_TYPE` AND slg.`BATCH_NUM` = slb.`BATCH_NUM`)
                            FROM `sps_let_batch` AS slb 
                            WHERE slb.`BATCH_STAT` = 'A' AND 
                                  slb.`u_type` = 'G' AND
                                  slb.`u_source` = '".$get_vae_txtMyUserGroup."';";
        //echo "sql_get_tbl_01 : ".$sql_get_tbl_01;                    
        $que_get_tbl_01= mysqli_query($conn, $sql_get_tbl_01) or die(mysqli_error());
        $cou_slect_grid =  mysqli_num_rows($que_get_tbl_01);
        $a = 0;
        while($rec_get_tbl_01 = mysqli_fetch_array($que_get_tbl_01)){
            $a++;
            echo "<tr id='tr".$a."' title='".$a."' onclick='loadNewTable(title);' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_tbl_01[0]."</span><span style='display: none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$rec_get_tbl_01[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_tbl_01[1]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec_get_tbl_01[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_tbl_01[2]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$rec_get_tbl_01[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_tbl_01[3]."</span><span style='display: none;'><input type='text' name='txtd".$a."' id='txtd".$a."' value='".$rec_get_tbl_01[3]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>1</span></td>
                </tr>" ;   
        }
        echo "</table>
                <br />
                <table>
                    <tr>
                        <td style='width: 150px; text-align: right;'><label class='linetop'>Letter Type Code :</label><span id='dis_ltc' style='color: #FF0606; display: none;'>*</span></td>
                        <td>
                        	<input type='text' class='box_decaretion' style='background-color: #F0F0F0;' name='txt_Letter_Type_Code' id='txt_Letter_Type_Code' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' />
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 150px; text-align: right;'><label class='linetop'>Batch Number :</label><span id='dis_bn' style='color: #FF0606; display: none;'>*</span></td>
                        <td>
        	               <input type='text' class='box_decaretion' style='background-color: #F0F0F0;' name='txt_Batch_Number' id='txt_Batch_Number' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' />
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 150px; text-align: right; vertical-align: top;'><label class='linetop'>Remarks :</label><span id='dis_Remarks' style='color: #FF0606; display: none;'>*</span></td>
                        <td>
                            <textarea class='box_decaretion' name='txt_Remarks' id='txt_Remarks' onkeypress='return disableEnterKey(event)' maxlength='100' cols='40' rows='5' required='required' ></textarea>
                        </td>
                    </tr>
                </table><br />
                <div style='margin-left: 100px;'>";
                    if($cou_slect_grid == 0){
                        echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnPrint' id='btnPrint' value='Print' onclick='getPrint();' disabled='disabled'/>";
                    }else{
                        echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnPrint' id='btnPrint' value='Print' onclick='getPrint();'/>";
                    }
                   echo "<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/>
                </div>
                <div id='display_letter' style='display: none;'></div>";

}

function get_print_BC($get_txttypeaBC,$gettxtMyUserBC){
    $conn = DatabaseConnection();
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$gettxtMyUserBC."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Client Code</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>System Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT bc.V_INDEX , bc.CLIENT_CODE , bc.V_NAME_INIT
                                        FROM sps_balance_confirmation AS  bc  
                                        WHERE bc.print_stats = 1 AND
                                              bc.AUTH_1_BY != '' AND
                                              bc.AUTH_2_BY != '';";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userGroup == "ug00001" || $userGroup == "ug00014" || $userGroup == "ug00027" || $userGroup == "ug00014" || $userGroup == "ug00086" || $userGroup == "HO_BOIC" || $userGroup == "ug00031" || $userGroup == "ug00029"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$rec_load_data_print[1]."|".$rec_load_data_print[0]."|".$get_txttypeaBC."' onclick='get_BC_print(title);'/>
                        </td>
                    </tr>";
                    $q++;
              }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'>a</div>"; //style='display: none;'
}

//-------------------------CBL05-----------------------------------

function get_print_Table_CBL05($LetType,$entryUserID){
     $conn = DatabaseConnection();

     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Genarated by</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Genarated date</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>No Of Entries </span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "select b.BATCH_NUM, 
                                           b.GEN_BY, 
                                           b.GEN_DATE, 
                                           b.No_of_entries
                                    from sps_cbl05_let_batch as b
                                    where  b.BATCH_STAT = 'A';";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
              
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[3]."</span></td>
                        <td style='width:100px; text-align: left;'>
                            <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$LetType."|".$rec_load_data_print[0]."|".$entryUserID."' onclick='getLetterPrint(title);'/>
                        </td>
                    </tr>";
                    $q++;
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
}


//------------ Madushan - 2018-26-01 ---- 	Confirmation of Nominee Detail

function get_print_Table_COND($LetType,$entryUserID){
     $conn = DatabaseConnection();
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$entryUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
    
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Account No</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Nominee Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT bc.V_INDEX , bc.ACC_NO , bc.NOMINEE_NAME
                                     FROM sps_conf_nominee_dtl AS  bc  
                                     WHERE bc.PRINT_STATUS = 'A' AND
                                           bc.AUTH_1_BY != '' AND
                                           bc.AUTH_2_BY != '';";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userGroup == "ug00001" || $userGroup == "ug00014" || $userGroup == "ug00027" || $userGroup == "ug00014" || $userGroup == "ug00086" || $userGroup == "HO_BOIC" || $userGroup == "ug00031" || $userGroup == "ug00029"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                            <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$LetType."|".$rec_load_data_print[0]."|".$entryUserID."' onclick='getLetterPrint(title);'/>
                        </td>
                    </tr>";
                    $q++;
              }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'>a</div>"; //style='display: none;'
}

function get_print_Table_COND_BULK($LetType,$entryUserID){
     $conn = DatabaseConnection();
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$entryUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
    
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Ref ID</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Code</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "select bc.V_INDEX, bc.REF_ID , bc.CLIENT_CO
                                    from sps_conf_nominee_dtl_bulk bc 
                                     WHERE bc.PRINT_STATUS = 'A' AND
                                           bc.AUTH_1_BY != '' AND
                                           bc.AUTH_2_BY != '';";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                            <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$LetType."|".$rec_load_data_print[0]."|".$entryUserID."' onclick='getLetterPrint(title);'/>
                        </td>
                    </tr>";
                    $q++;
              
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
}



function get_print_PORD($get_txttypeapo,$gettxtMyUserID,$getvar_txttypea){
  // echo $get_txttypeapo." -- ".$gettxtMyUserID."OK".$getvar_txttypea;
    //echo $gettxtMyUserID;
     $conn = DatabaseConnection();
if($get_txttypeapo == "HPPO3W" || $get_txttypeapo == "HPPOGE"){
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$gettxtMyUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
		$userBranch = $_SESSION['userBranch']; // Override for unit operation 4:59 PM 12/04/2017
    }
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Facility Number</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>System Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT `fac_no`,`system_no`,`client_name`
                                        FROM `sps_po_gen`
                                        WHERE `AUTH_1_BY` != ''
                                        	AND `AUTH_2_BY`!= ''
                                            AND `TYPE_CODE` = '".$get_txttypeapo."'
                                                AND `print_stats` = 1;";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userBranch == substr($rec_load_data_print[0],0,4) || $userGroup == "ug00001" || $userGroup == "ug00042" || $userGroup == "ug00043" || $userGroup == "ug00044" || $userGroup == "ITADM"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$rec_load_data_print[0]."|".$rec_load_data_print[1]."|".$getvar_txttypea."' onclick='get_PO_print(title);'/>
                        </td>
                    </tr>";
                    $q++;
               }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
}else if($get_txttypeapo == "LEPO3W" || $get_txttypeapo == "LEPOGE" || $get_txttypeapo == "UCLEPO" ){
    //echo "L";
    $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$gettxtMyUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
	$userBranch = $_SESSION['userBranch']; // Override for unit operation 4:59 PM 12/04/2017
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Facility Number</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>System Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT `fac_no`,`system_no`,`client_name`";
            if($get_txttypeapo == "UCLEPO"){
                $sql_load_data_print .= "FROM `ucl_sps_po_gen`";
            }else{
                $sql_load_data_print .= "FROM `sps_po_gen`";
            }
                                        
                $sql_load_data_print .= "WHERE `AUTH_1_BY` != ''
                                        	AND `AUTH_2_BY`!= ''
                                            AND `TYPE_CODE` = '".$get_txttypeapo."'
                                                AND `print_stats` = 1;";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userBranch == substr($rec_load_data_print[0],0,4) || $userGroup == "ug00001" || $userGroup == "ug00042" || $userGroup == "ug00043" || $userGroup == "ug00044" || $userGroup ==  "ug00106"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$rec_load_data_print[0]."|".$rec_load_data_print[1]."|".$getvar_txttypea."' onclick='get_supAger_print(title);'/>
                        </td>
                    </tr>";
                    $q++;
              }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
    
}else if($get_txttypeapo == "MOPOLE"){
     //echo "MOPOLE";
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$gettxtMyUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Facility Number</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>System Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT `fac_no`,`system_no`,`client_name`
                                        FROM `sps_po_gen`
                                        WHERE `AUTH_1_BY` != ''
                                        	AND `AUTH_2_BY`!= ''
                                            AND `TYPE_CODE` = '".$get_txttypeapo."'
                                                AND `print_stats` = 1;";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userGroup == "ug00001" || $userGroup == "ug00042" || $userGroup == "ug00043" || $userGroup == "ug00044" || $userGroup == "ug00014" || $userGroup == "ug00020" || $userGroup == "ug00019"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$rec_load_data_print[0]."|".$rec_load_data_print[1]."|".$getvar_txttypea."' onclick='get_Mortgage_print(title);'/>
                        </td>
                    </tr>";
                    $q++;
              }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
}else if($get_txttypeapo == "MPOMB"){
     //echo "MPOMB";
     $sql_u_branch = "SELECT u.branchNumber , u.usergroupNumber
                        FROM user AS u
                        WHERE u.userName = '".$gettxtMyUserID."';";
    $que_u_branch = mysqli_query($conn,$sql_u_branch) or die(mysqli_error());
    while($rec_u_branch = mysqli_fetch_array($que_u_branch)){
        $userBranch = $rec_u_branch[0];
        $userGroup =  $rec_u_branch[1];
        //echo $userBranch;
    }
     echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>#</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Facility Number</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>System Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            $sql_load_data_print = "SELECT `fac_no`,`system_no`,`client_name`
                                        FROM `sps_po_gen`
                                        WHERE `AUTH_1_BY` != ''
                                        	AND `AUTH_2_BY`!= ''
                                            AND `TYPE_CODE` = '".$get_txttypeapo."'
                                                AND `print_stats` = 1;";
            $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
            $q = 1;
            while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
               if($userGroup == "ug00001" || $userGroup == "ug00042" || $userGroup == "ug00043" || $userGroup == "ug00044" || $userGroup == "ug00014" || $userGroup == "ug00020" || $userGroup == "ug00019"){
                    echo "<tr>
                        <td style='width:20px; text-align: left;'><span style='margin-left: 5px;'>".$q."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[0]."</span></td>
                        <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[1]."</span></td>
                        <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$rec_load_data_print[2]."</span></td>
                        <td style='width:100px; text-align: left;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnatc' id='btnatc' value='Print' title='".$rec_load_data_print[0]."|".$rec_load_data_print[1]."|".$getvar_txttypea."' onclick='get_Murabahah_Mortgage_print(title);'/>
                        </td>
                    </tr>";
                    $q++;
              }else{
                
               }
                
            }
            
     echo "<table/>
     <div id='display_letter'></div>"; //style='display: none;'
}else{
    echo "N";
}
    
}

function  print_PO_letter($get_fac_num_print_OP,$get_Sys_num_po,$get_v_user_print,$get_v_type){
    //echo $get_fac_num_print_OP."--".$get_Sys_num_po."OK";
     $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_OP = "SELECT `fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`,`EQUIP_CAT`
                        FROM `sps_po_gen` 
                        WHERE `fac_no` = '".$get_fac_num_print_OP."' AND
                               `system_no` = '".$get_Sys_num_po."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    $que_select_OP = mysqli_query($conn,$sql_select_OP)or die(mysqli_error());
    while($rec_select = mysqli_fetch_assoc($que_select_OP)){
        //echo $rec_select['fac_no']."--".$rec_select['client_name'];
        $date = date("h:i:sa");
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*30);
        $formatDate = date("H:i:s", $futureDate);
       $sql_ath1 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
       
       $SQL_s_gen = "SELECT * FROM sps_po_serial_gen AS s WHERE s.year = YEAR(DATE(NOW())) AND s.month = MONTH(DATE(NOW()));";
       $query_s_gen = mysqli_query($conn,$SQL_s_gen) or die(mysqli_error($conn));
       while($row_s_gen = mysqli_fetch_array($query_s_gen)){
           $batch_num = $row_s_gen[2]+1;
           $TableID = $row_s_gen[0].'-'.$row_s_gen[1].'-'.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 2014-12-0001 as first number for 2014 and 20150001 in 2015
       }
       
       
       
    mysqli_autocommit($conn,FALSE);
    try{
        
        $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_fac_num_print_OP."' AND `LET_TYPE` = '".$get_v_type."';";
        $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
        $ans_s = 0;
        while($res_select_print = mysqli_fetch_array($que_select_print)){
            $ans_s = $res_select_print[0]+1;
        }
        $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                VALUES ('".$get_v_type."','".$get_fac_num_print_OP."','".$ans_s."','".$get_v_user_print."',now(),'PO Print.','".$get_v_user_print."',now());";
        //echo $sql_insert;                                        
        $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
        $sql_update = "UPDATE `sps_po_gen` 
                            SET `print_stats`= 2 ,
                                serial_no = '".$TableID."'
                            WHERE `fac_no` = '".$get_fac_num_print_OP."' AND
                                    `system_no` = '".$get_Sys_num_po."' AND
                                    `AUTH_1_BY` != '' AND
                                    `AUTH_2_BY` != '' AND
                                    `print_stats` = 1;";
        $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
        
        $sql_update_s = "UPDATE `sps_po_serial_gen` 
                            SET `v_count`= '".$batch_num."'
                            WHERE `year` = YEAR(DATE(NOW())) AND `month` = MONTH(DATE(NOW()));";
        $que_update_s = mysqli_query($conn, $sql_update_s) or die(mysqli_error());
        mysqli_commit($conn);
    }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
            
    }
       
        echo "<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv='content-type' content='text/html' />
	<meta name='author' content='lolkittens' />
	<title>Untitled 1</title>
</head>
<body>
<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print."</td>
        </tr> 
    </table><br /><br />
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >ORIGINAL </label><br />
</div><br /><br/>
<div style='text-align: center;'>
<label style='font-size: 13px; font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif;' >PURCHASE ORDER</label><br />
</div>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 60%;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].", </label><br />";
            if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Our Ref : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID." </label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br />
<label style='text-decoration: underline;' >DESCRIPTION OF VEHICLE/ARTICLE</label><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']."-".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p>
We write to inform you that we have approved a Hire Purchase facility of Rs.".number_format($rec_select['asset_price'],2)." for the above Vehicle. Please release the vehicle to the under mentioned person, after you are satisfied with his/her identity.
</p>
<p style='font-weight: bold;'>
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
</p>
<p>
Kindly ensure that the vehicle is registered in the name of the aforesaid party as \"Registered Owner\" and ourselves as the \"Absolute Owner\" and forward us an extract of the Registration from the R.M.V. and the duplicate key, along with the attached copy duly completed.You shall undertake to indemnify Citizens Development Business Finance PLC. of any losses/damages arising from your failure to fulfill any of the above conditions.
</p>
<p>
We confirm that our Cheque for Rs. ".number_format($rec_select['asset_price'],2)." will be forwarded to you after receipt of the items mentioned above.
</p>
<p>
Please return the second copy(Duplicate) of this Purchase Order duly signed in confirmation of your acceptance of the terms and conditions mentioned therein.
</p>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Specimen Signature of Hirer</label><br />
        </td>
    </tr>
</table>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<div>
  <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print."</td>
        </tr> 
    </table><br />
   <label style='font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>DUPLICATE PLEASE RETURN TO CDB </label>
</div><br />
<div style='text-align: center;'>
<label style='font-size: 13px; font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif;' >PURCHASE ORDER</label><br />
</div>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 60%;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;'>
            <label>MESS ".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].", </label><br />";
            if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02'].", </label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Our Ref : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID." </label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br />
<label style='text-decoration: underline;' >DESCRIPTION OF VEHICLE/ARTICLE</label><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']."-".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p>
We write to inform you that we have approved a Hire Purchase facility of Rs.".number_format($rec_select['asset_price'],2)." for the above Vehicle. Please release the vehicle to the under mentioned person, after you are satisfied with his/her identity.
</p>
<p style='font-weight: bold;'>
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
</p>
<p>
Kindly ensure that the vehicle is registered in the name of the aforesaid party as \"Registered Owner\" and ourselves as the \"Absolute Owner\" and forward us an extract of the Registration from the R.M.V. and the duplicate key.
</p>
<p>
We confirm that our Cheque for Rs. ".number_format($rec_select['asset_price'],2)." will be forwarded to you after receipt of the items mentioned above.
</p>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Specimen Signature of Hirer</label><br />
        </td>
    </tr>
</table>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
          echo "<label>.......................................................</label></label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
          echo "<label>.......................................................</label></label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<br />
<p>
I confirm having taken possession of the Article described above is in good working order on .............
</p><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Dealer</label><br />
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Hirer</label><br />
        </td>
    </tr>
</table><br />
<p>
I hereby certify that all relevant documents have been lodged with R.M.V. as advised, and I undertake to indemnify Citizens Development Business Finance PLC of any losses/damages arising from my failure to fulfill any of the above conditions.
</p>
<p>
Please forward your cheque for Rs. ".number_format($rec_select['asset_price'],2)." favouring MESS ".$rec_select['supplier_name']."
</p><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Dealer</label><br />
        </td>
        <td style='width: 50%;'>
           &nbsp;
        </td>
    </tr>
</table>
</div>
</div>
<div style='page-break-after: always;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<div>
   <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print."</td>
        </tr> 
    </table><br />
   <label style='font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>File Copy </label><br />
</div><br />
<div style='text-align: center;'>
<label style='font-size: 13px; font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif;' >PURCHASE ORDER</label>
</div>
<br />
<table style='width: 100%;'>
   <tr>
        <td style='width: 60%;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>MESS ".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01']."</label><br />";
            if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']."</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Our Ref : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID." </label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br />
<label style='text-decoration: underline;' >DESCRIPTION OF VEHICLE/ARTICLE</label><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']."-".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p>
We write to inform you that we have approved a Hire Purchase facility of Rs.".number_format($rec_select['asset_price'],2)." for the above Vehicle. Please release the vehicle to the under mentioned person, after you are satisfied with his/her identity.
</p>
<p style='font-weight: bold;'>
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
</p>
<p>
Kindly ensure that the vehicle is registered in the name of the aforesaid party as \"Registered Owner\" and ourselves as the \"Absolute Owner\" and forward us an extract of the Registration from the R.M.V. and the duplicate key, along with the attached copy duly completed.
</p>
<p>
We confirm that our Cheque for Rs.".number_format($rec_select['asset_price'],2)." will be forwarded to you after receipt of the items mentioned above.
</p>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Specimen Signature of Hirer</label><br />
        </td>
    </tr>
</table>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
          echo "<label>.......................................................</label></label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
          echo "<label>.......................................................</label></label><br />
           <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<br />
<p>
I confirm having taken possession of the Article described above is in good working order on ...................
</p><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Dealer</label><br />
        </td>
        <td style='width: 50%;font-family:  Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Hirer</label><br />
        </td>
    </tr>
</table><br />
<p>
I hereby certify that all relevant documents have been lodged with R.M.V. as advised, and I undertake to indemnify Citizens Development Business Finance PLC of any losses/damages arising from my failure to fulfill any of the above conditions.
</p>
<p>
Please forward your cheque for Rs. ".number_format($rec_select['asset_price'],2)." favouring MESS ".$rec_select['supplier_name']."
</p><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family:  Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>.......................................................</label></label><br />
            <label>Signature of Dealer</label><br />
        </td>
        <td style='width: 50%;'>
           &nbsp;
        </td>
    </tr>
</table>
</div>
</div>";

if(($rec_select['EQUIP_CAT'] == "01" && $rec_select['product_code'] == "501") || $rec_select['EQUIP_CAT'] == "02" || $rec_select['EQUIP_CAT'] == "03" || $rec_select['EQUIP_CAT'] == "05" || $rec_select['EQUIP_CAT'] == "06" || $rec_select['EQUIP_CAT'] == "08" || $rec_select['EQUIP_CAT'] == "10" || $rec_select['EQUIP_CAT'] == "11" || $rec_select['EQUIP_CAT'] == "12"){
echo "<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print."</td>
        </tr> 
    </table><br /><br />
    
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']."-".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Citizens Development Business Finance PLC of No. 123, Orabipasha Mawatha Colombo-10 which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Citizens Development Business Finance PLC.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print."</td>
        </tr> 
    </table><br /><br />
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='text-align: right;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>File copy</label>
</div>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Citizens Development Business Finance PLC of No. 123, Orabipasha Mawatha Colombo-10 which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Citizens Development Business Finance PLC.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>";
}
echo "</body>
</html>";
    }
   
}

function print_supAger_letter($get_fac_num_print_supAger,$get_Sys_num_supAger,$get_v_user_print_supAger,$get_v_type_supAger){
    //echo $get_fac_num_print_supAger." - ".$get_Sys_num_supAger." - ".$get_v_user_print_supAger." - ".$get_v_type_supAger;
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_OP = "SELECT `fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`,`EQUIP_CAT`
                        FROM `sps_po_gen` 
                        WHERE `fac_no` = '".$get_fac_num_print_supAger."' AND
                               `system_no` = '".$get_Sys_num_supAger."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    $que_select_OP = mysqli_query($conn,$sql_select_OP)or die(mysqli_error());
    while($rec_select = mysqli_fetch_assoc($que_select_OP)){
        //echo $rec_select['fac_no']."--".$rec_select['client_name'];
        $date = date("h:i:sa");
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*30);
        $formatDate = date("H:i:s", $futureDate);
       $sql_ath1 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
       
       $SQL_s_gen = "SELECT * FROM sps_po_serial_gen AS s WHERE s.year = YEAR(DATE(NOW())) AND s.month = MONTH(DATE(NOW()));";
       $query_s_gen = mysqli_query($conn,$SQL_s_gen) or die(mysqli_error($conn));
       while($row_s_gen = mysqli_fetch_array($query_s_gen)){
           $batch_num = $row_s_gen[2]+1;
           $TableID = $row_s_gen[0].'-'.$row_s_gen[1].'-'.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 2014-12-0001 as first number for 2014 and 20150001 in 2015
       }
    
    mysqli_autocommit($conn,FALSE);
    try{
        $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_fac_num_print_supAger."' AND `LET_TYPE` = '".$get_v_type_supAger."';";
        $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
        $ans_s = 0;
        while($res_select_print = mysqli_fetch_array($que_select_print)){
            $ans_s = $res_select_print[0]+1;
        }
        $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                VALUES ('".$get_v_type_supAger."','".$get_fac_num_print_supAger."','".$ans_s."','".$get_v_user_print_supAger."',now(),'Supply Agreement Print.','".$get_v_user_print_supAger."',now());";
        //echo $sql_insert;                                        
        $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
        $sql_update = "UPDATE `sps_po_gen` 
                            SET `print_stats`= 2 ,
                                serial_no = '".$TableID."'
                            WHERE `fac_no` = '".$get_fac_num_print_supAger."' AND
                                    `system_no` = '".$get_Sys_num_supAger."' AND
                                    `AUTH_1_BY` != '' AND
                                    `AUTH_2_BY` != '' AND
                                    `print_stats` = 1;";
        $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
        
          $sql_update_s = "UPDATE `sps_po_serial_gen` 
                            SET `v_count`= '".$batch_num."'
                            WHERE `year` = YEAR(DATE(NOW())) AND `month` = MONTH(DATE(NOW()));";
        $que_update_s = mysqli_query($conn, $sql_update_s) or die(mysqli_error());
        mysqli_commit($conn);
    }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
            
    }

       
        echo "<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv='content-type' content='text/html' />
	<meta name='author' content='lolkittens' />

	<title>Untitled 1</title>
</head>

<body>

<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br /><br />
   <label style='font-weight: bold;' >ORIGINAL </label><br />
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<br />
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Ref. No : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID."</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee/s) subject to the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'CDB' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'CDB' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'CDB' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'CDB' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'CDB' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'CDB' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'CDB'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, CDB is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of CDB and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of CDB and the Lessee as the Registered User and other relevant documents to 'CDB', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
/*echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Serial No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>:</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Period for Installation</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Warranty (if any)</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>";*/
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> &nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
</div>
</div>



<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br />
   <label style='font-weight: bold;'>PLEASE RETURN TO THE COMPANY</label>
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Ref. No : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID."</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee) SUBJECT To the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'CDB' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'CDB' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'CDB' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'CDB' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'CDB' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'CDB' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'CDB'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, CDB is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of CDB and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of CDB and the Lessee as the Registered User and other relevant documents to 'CDB', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
<hr />
<label>LESSEE/S CERTIFICATION</label><br />
<label>TO BE FILLED IN BY THE LESSEE/S</label><br />
<label>I/We do hereby agree to the terms, conditions and warranties and specifications specified in this Supply Agreement and have received the property mentioned above in satisfactory condition and request CDB to make payments to the supplier.</label>
<br />
<label>Name of Lessee : ".$rec_select['client_full_name']."</label><br />
<label>Date : </label><br/>
<label>Signature : .....................................................</label><br/>
<label>for and on behalf of Lessee/s.</label>
</div>
</div>



<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br />
   <label style='font-weight: bold;'>FILE COPY</label>
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Our Ref : ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID."</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee) SUBJECT To the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'CDB' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'CDB' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'CDB' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'CDB' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'CDB' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'CDB' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'CDB'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, CDB is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of CDB and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of CDB and the Lessee as the Registered User and other relevant documents to 'CDB', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
<hr />
<label>LESSEE/S CERTIFICATION</label><br />
<label>TO BE FILLED IN BY THE LESSEE/S</label><br />
<label>I/We do hereby agree to the terms, conditions and warranties and specifications specified in this Supply Agreement and have received the property mentioned above in satisfactory condition and request CDB to make payments to the supplier.</label>
<br />
<label>Name of Lessee : ".$rec_select['client_full_name']."</label><br />
<label>Date : </label><br/>
<label>Signature : .....................................................</label><br/>
<label>for and on behalf of Lessee/s.</label>
</div>
</div>";
if(($rec_select['EQUIP_CAT'] == "01" && $rec_select['product_code'] == "501") || $rec_select['EQUIP_CAT'] == "02" || $rec_select['EQUIP_CAT'] == "03" || $rec_select['EQUIP_CAT'] == "05" || $rec_select['EQUIP_CAT'] == "06" || $rec_select['EQUIP_CAT'] == "08" || $rec_select['EQUIP_CAT'] == "10" || $rec_select['EQUIP_CAT'] == "11" || $rec_select['EQUIP_CAT'] == "12"){

echo "<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print_supAger."</td>
        </tr> 
    </table><br /><br />
    
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Citizens Development Business Finance PLC of No. 123, Orabipasha Mawatha Colombo-10 which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Citizens Development Business Finance PLC.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print_supAger."</td>
        </tr> 
    </table><br /><br />
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='text-align: right;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>File copy</label>
</div>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Citizens Development Business Finance PLC of No. 123, Orabipasha Mawatha Colombo-10 which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Citizens Development Business Finance PLC.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>";
}
echo "</body>
</html>";
    }
        
}

function  print_Mortgage_letter($get_fac_num_print_Mortgage,$get_Sys_num_Mortgage,$get_v_user_print_Mortgage,$get_v_type_Mortgage){
    //echo $get_fac_num_print_Mortgage." - ".$get_Sys_num_Mortgage." - ".$get_v_user_print_Mortgage." - ".$get_v_type_Mortgage;
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_Mortgage = "SELECT `fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`,`EQUIP_CAT`,`INS_COM_NAME`,`INT_RATE`
                        FROM `sps_po_gen` 
                        WHERE `fac_no` = '".$get_fac_num_print_Mortgage."' AND
                               `system_no` = '".$get_Sys_num_Mortgage."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    $que_select_Mortgage = mysqli_query($conn,$sql_select_Mortgage)or die(mysqli_error());
    while($rec_select = mysqli_fetch_assoc($que_select_Mortgage)){
        //echo $rec_select['fac_no']."--".$rec_select['client_name'];
        $date = date("h:i:sa");
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*30);
        $formatDate = date("H:i:s", $futureDate);
       $sql_ath1 = "SELECT s.`SIG_IMG`,s.`designation`,s.`sig_name` , b.`branchName`
                    FROM `sps_sig_mast` AS s , `branch` AS b , `user` AS u
                    WHERE s.`USER_ID` = u.userName AND u.branchNumber = b.branchNumber AND  `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            $branch_01 = $row_ath1[3];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
       
       $SQL_s_gen = "SELECT * FROM sps_po_serial_gen AS s WHERE s.year = YEAR(DATE(NOW())) AND s.month = MONTH(DATE(NOW()));";
       $query_s_gen = mysqli_query($conn,$SQL_s_gen) or die(mysqli_error($conn));
       while($row_s_gen = mysqli_fetch_array($query_s_gen)){
           $batch_num = $row_s_gen[2]+1;
           $TableID = $row_s_gen[0].'-'.$row_s_gen[1].'-'.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 2014-12-0001 as first number for 2014 and 20150001 in 2015
       }
    
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_fac_num_print_Mortgage."' AND `LET_TYPE` = '".$get_v_type_Mortgage."';";
        $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
        $ans_s = 0;
        while($res_select_print = mysqli_fetch_array($que_select_print)){
            $ans_s = $res_select_print[0]+1;
        }
        $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                VALUES ('".$get_v_type_Mortgage."','".$get_fac_num_print_Mortgage."','".$ans_s."','".$get_v_user_print_Mortgage."',now(),'Mortgage Letter Print.','".$get_v_user_print_Mortgage."',now());";
        //echo $sql_insert;                                        
        $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
        $sql_update = "UPDATE `sps_po_gen` 
                            SET `print_stats`= 2 ,
                                serial_no = '".$TableID."'
                            WHERE `fac_no` = '".$get_fac_num_print_Mortgage."' AND
                                    `system_no` = '".$get_Sys_num_Mortgage."' AND
                                    `AUTH_1_BY` != '' AND
                                    `AUTH_2_BY` != '' AND
                                    `print_stats` = 1;";
        $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
        
        $sql_update_s = "UPDATE `sps_po_serial_gen` 
                            SET `v_count`= '".$batch_num."'
                            WHERE `year` = YEAR(DATE(NOW())) AND `month` = MONTH(DATE(NOW()));";
        $que_update_s = mysqli_query($conn, $sql_update_s) or die(mysqli_error());
        
        
        mysqli_commit($conn);
    }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
            
    }
       //------------------------------------------------ Start Format for Mortgage Letter --------------------------------------------------------------------------------------
        echo "<div style='page-break-after: always'>
<br /><br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
   <label>Date : ".date("Y-m-d")."</label><br />
   <!--<label style='font-weight: bold;' >ORIGINAL </label><br /> -->
</div><br />

<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>The Commissioner</label><br />
            <label>Department of Motor Traffic</label><br />
            <label>Colombo 05.</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div style='font-family: sans; font-size: 12px;'>
<label>Dear Sir/Madam,</label><br /><br />
<label style='font-weight: bold;font-size: 13px;' >MORTGAGE BOND NO. ".$rec_select['fac_no']." DATED ".$rec_select['cbd']." FOR Rs.".number_format($rec_select['lease_amount'],2)." COVERING FOLLOWING VEHICLE.</label><br /><br />
<table style='font-weight: bold; bold;font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." / ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
     <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
</table>
<p style='text-align: justify;'>
We enclose a copy of the above numbered bond signed by the owner ".$rec_select['client_full_name']." in favour of Citizens Development Business Finance PLC covering the vehicle referred to, along with the relevant Certificate of Registration. 
Kindly Make arrangement to register the mortgage in your books and return the original certificate of the vehicle under reference.</p>
<br />
<p style='text-align: justify;'>
Thanking you in advance for you kindly co-operation in this matter.
</p>
<br />
<p style='text-align: justify;'>
Further, we have no objection to handover the Original Certificate of registration of the above vehicle to <label style='font-weight: bold;'>".$rec_select['supplier_name']." of ".$rec_select['supplier_address_01']." ".$rec_select['supplier_address_02']." ".$rec_select['supplier_address_03'].".</label>
</p>
<br />
<table style='font-size: 12px; '>
    <tr>
        <td>
             <label>Thank You.</label><br /><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>

</div>
</div>


<div style='page-break-after: always;'>
<br /><br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
   <label style='font-weight: bold;' >File Copy </label><br />
     <label>Date : ".date("Y-m-d")."</label><br />
   <!--<label style='font-weight: bold;' >ORIGINAL </label><br /> -->
</div><br />

<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>The Commissioner</label><br />
            <label>Department of Motor Traffic</label><br />
            <label>Colombo 05.</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div style='font-family: sans; font-size: 12px;'>
<label>Dear Sir/Madam,</label><br /><br />
<label style='font-weight: bold;font-size: 13px;' >MORTGAGE BOND NO. ".$rec_select['fac_no']." DATED ".$rec_select['cbd']." FOR Rs.".number_format($rec_select['lease_amount'],2)." COVERING FOLLOWING VEHICLE.</label><br /><br />
<table style='font-weight: bold; bold;font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." / ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
     <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
</table>
<p style='text-align: justify;'>
We enclose a copy of the above numbered bond signed by the owner ".$rec_select['client_full_name']." in favour of Citizens Development Business Finance PLC covering the vehicle referred to, along with the relevant Certificate of Registration. 
Kindly Make arrangement to register the mortgage in your books and return the original certificate of the vehicle under reference.</p>
<br />
<p style='text-align: justify;'>
Thanking you in advance for you kindly co-operation in this matter.
</p>
<br />
<p style='text-align: justify;'>
Further, we have no objection to handover the Original Certificate of registration of the above vehicle to <label style='font-weight: bold;'>".$rec_select['supplier_name']." of ".$rec_select['supplier_address_01']." ".$rec_select['supplier_address_02']." ".$rec_select['supplier_address_03'].".</label>
</p>
<br />
<table style='font-size: 12px; '>
    <tr>
        <td>
             <label>Thank You.</label><br /><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
            echo "<label>.......................................................</label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>

</div>
</div>
<!----------------------------------------------------- End Cover Letter -RMV ----------------------------------------------------------------------------------->
<!----------------------------------------------------- Start Cover Letter -Land Registry ----------------------------------------------------------------------------------->
<div style='page-break-after: always;'>
<br /><br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
   <label style='font-weight: bold;' >PRIVATE &amp; CONFIDENTIAL</label><br />
     <label>Date : ".date("Y-m-d")."</label><br />
   <!--<label style='font-weight: bold;' >ORIGINAL </label><br /> -->
</div><br />
<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>REGISTRAR GENERAL DEPARTMENT.</label><br />
            <label>LAND REGISTRY</label><br />
            <label>COLOMBO.</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div style='font-family: sans; font-size: 12px;'>
<label>Dear Sir/Madam,</label><br /><br />

<label style='font-weight: bold;font-size: 13px; text-decoration: underline; text-align: justify;' >MORTGAGE BOND NO ".$rec_select['fac_no']." DATED ".$rec_select['cbd']." FOR Rs.".number_format($rec_select['lease_amount'],2)." OVER FOLLOWING MOVABLE PROPERTY</label><br /><br />
<table style='font-weight: bold; bold;font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." / ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
     <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
</table>
<br />
<label>Dear Sir/Madam,</label><br /><br />

<p style='text-align: justify;'>
We forward herewith for registration in your movable registers the original of a primary Mortgage bond for Rs.".number_format($rec_select['lease_amount'],2)." executed by ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].".</p>
<p style='text-align: justify;'>
Further Movable property situated in your district and referred to in the schedule to the above bond.
</p>
<p style='text-align: justify;'>
Please acknowledge the receipt.
</p>
<br />
<table style='font-size: 12px; '>
    <tr>
        <td>
             <label>Thank You.</label><br /><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>


<div style='page-break-after: always;'>
<br /><br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
    <label style='font-weight: bold;' >File Copy</label><br /><br />
   <label style='font-weight: bold;' >PRIVATE &amp; CONFIDENTIAL</label><br />
     <label>Date : ".date("Y-m-d")."</label><br />
   <!--<label style='font-weight: bold;' >ORIGINAL </label><br /> -->
</div><br />
<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>REGISTRAR GENERAL DEPARTMENT.</label><br />
            <label>LAND REGISTRY</label><br />
            <label>COLOMBO.</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div style='font-family: sans; font-size: 12px;'>
<label>Dear Sir/Madam,</label><br /><br />

<label style='font-weight: bold;font-size: 13px; text-decoration: underline; text-align: justify;' >MORTGAGE BOND NO ".$rec_select['fac_no']." DATED ".$rec_select['cbd']." FOR Rs.".number_format($rec_select['lease_amount'],2)." OVER FOLLOWING MOVABLE PROPERTY</label><br /><br />
<table style='font-weight: bold; bold;font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." / ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
     <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
</table>
<br />
<label>Dear Sir/Madam,</label><br /><br />

<p style='text-align: justify;'>
We forward herewith for registration in your movable registers the original of a primary Mortgage bond for Rs.".number_format($rec_select['lease_amount'],2)." executed by ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].".</p>
<p style='text-align: justify;'>
Further Movable property situated in your district and referred to in the schedule to the above bond.
</p>
<p style='text-align: justify;'>
Please acknowledge the receipt.
</p>
<br />
<table style='font-size: 12px; '>
    <tr>
        <td>
             <label>Thank You.</label><br /><br />
            <label>Yours faithfully,</label><br />
            <label>Citizens Development Business Finance PLC</label><br />";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<!----------------------------------------------------- End Cover Letter -Land Registry ----------------------------------------------------------------------------------->
<!----------------------------------------------------- Start Client No Objection Letter-RMV Reg ----------------------------------------------------------------------------------->
<div style='page-break-after: always;'>
<br /><br /><br /><br />
<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>".$rec_select['client_name']."</label><br />
            <label>".$rec_select['cc_address_01']."</label><br />";
            if(trim($rec_select['cc_address_02']) != ""){
                echo "<label>".$rec_select['cc_address_02']."</label><br />";
            }
            if(trim($rec_select['cc_address_03']) != ""){
                echo "<label>".$rec_select['cc_address_03']."</label><br />";
            }
            echo "<label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: sans; font-size: 12px;'>
     <label>Date : ".date("Y-m-d")."</label><br />
   <!--<label style='font-weight: bold;' >ORIGINAL </label><br /> -->
</div><br />
<table style='width: 100%;font-family: sans; font-size: 12px; '>
    <tr>
        <td>
            <label>The Commissioner</label><br />
            <label>Department of Motor Traffic</label><br />
            <label>Colombo 05.</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<br />
<div style='font-family: sans; font-size: 12px;'>
<label>Dear Sir/Madam,</label><br /><br />

<label style='font-weight: bold;font-size: 13px; text-decoration: underline; text-align: justify;' >Motor Vehicle</label><br /><br />
<table style='font-weight: bold; font-size: 12px;'>
    <tr>
        <td>Vehicle No.</td>
        <td>: ".$rec_select['vehicle_number']."</td>
    </tr>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." / ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
     <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
</table>
<br />
<p style='text-align: justify;'>
I wish to advise that I have executed a primary Mortgage in favour of Citizens Development Business Finance PLC., In respect of the above motor vehicle of which I am the registered owner and I hereby request to register the instrument of the Mortgage.</p>
<p style='text-align: justify; font-weight: bold;'>
I enclose herewith for this purpose:
</p>
<ol style='font-size: 12px;'>
    <li>Mortgage Bond No. ".$rec_select['fac_no']."</li>
    <li>Certificate of registration of the vehicle enable you to make an endorsement thereon to the effect that the motor vehicle has been mortgaged to the Citizens Development Business Finance PLC referred to above.</li>
</ol>

<p style='text-align: justify;'>
Kindly handover the following documents to <label style='font-weight: bold;'>".$rec_select['supplier_name']." of ".$rec_select['supplier_address_01']." ".$rec_select['supplier_address_02']." ".$rec_select['supplier_address_03'].".</label>
</p>
<ol style='font-size: 12px;'>
    <li>Mortgage Bond</li>
    <li>The Certificate of registration.</li>
</ol>
<br />
<table style='font-size: 12px; '>
    <tr>
        <td>
             <label>Thank You.</label><br /><br />
            <label>Yours faithfully,</label><br /><br /><br />
            <label>.......................................................</label></label><br />
            <label>".$rec_select['client_name']."</label><br />
            <label>(NIC - ".$rec_select['client_nic'].")</label><br />
        </td>
    </tr>
</table>
</div>
</div>

<!----------------------------------------------------- End Client No Objection Letter-RMV Reg ----------------------------------------------------------------------------------->
<!----------------------------------------------------- Start Supply Agreement- Vehicle Mortgage loan ----------------------------------------------------------------------------------->
<div style='page-break-after: always'>
<div style='font-family:  sans-serif; font-size: 10px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_Mortgage."</label><br /><br />
   <label style='font-weight: bold;' >ORIGINAL </label>
</div><br />
<div style='text-align: center;'>
<label style='font-family:  sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<br />
<table style='width: 100%;font-family:  sans-serif; font-size: 10px; '>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01']." </label><br />";
            if(trim($rec_select['supplier_address_02']) != ""){
                echo " <label>".$rec_select['supplier_address_02']." </label><br />";
            }
            if(trim($rec_select['supplier_address_03']) != ""){
                echo " <label>".$rec_select['supplier_address_03']." </label><br />";
            }
        echo "</td>
        <td style='width: 60%;'>
            <label>Ref No: ".$rec_select['fac_no']."</label><br />
            <label>Serial No : ".$TableID."</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: sans-serif; font-size: 10px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Proper described hereunder in connection with our loan arrangement with 
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
(Hereinafter known as the Borrower/s) subject to the following terms and Conditions:
</p>
<table style='font-size: 10px;'>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>1. Description Of Property</td>
        <td style='width: 35%;'>: 01. ".$rec_select['make_desc']." 02. ".$rec_select['model_desc']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>&nbsp;</td>
        <td style='width: 35%;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 35%;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>2. Purchase Price</td>
        <td style='width: 35%;'>: Rs.".number_format($rec_select['asset_price'],2)."</td> 
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>3. Property Delivered to</td>
        <td style='width: 35%;'>: ".$rec_select['client_full_name']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%; text-align: right;'>3.1 Place to be Delivered</td>
        <td style='width: 35%;'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>4. Other Terms and Conditions</td>
        <td style='width: 35%;'>&nbsp;</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
</table>
<table style='font-size: 10px;'>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;'>4.1</td>
        <td style='padding-left: 10px;'>''CDB'' shall receive, in writing from the Borrower/s ,Borrower's acceptance of the property and approval of your invoice for the
same, and (b) the Borrower's instruction to ''CDB'' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.2</td>
        <td style='padding-left: 10px;'>You shall deliver to ''CDB'' and Borrower/s your written warranties, in substance and in form as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both ''CDB'' and Borrower/s or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.3</td>
        <td style='padding-left: 10px;'>a). The said Loan arrangement shall be properly conducted between Borrower/s and ''CDB''. <br />
          b). The Borrower/s, namely, <label style='font-weight: bold;'>".$rec_select['client_full_name']." </label>  is the ''mortgagor'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties. CDB is the ''mortgagee'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties.
        </td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.4</td>
        <td style='padding-left: 10px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Mortgage over such vehicle should be registered in favour of CDB and the Borrower should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.5</td>
        <td style='padding-left: 10px;'>You shall deliver the vehicle to the Borrower/s with a comprehensive insurance policy assigned in favour of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.6</td>
        <td style='padding-left: 10px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.7</td>
        <td style='padding-left: 10px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction
</label>
<ol>
    <li>The second copy of this Supply Agreement duly completed and signed together with the duly filled Borrowers Certification</li>
    <li>The original certificate of registration issued by RMV with the mortgage registered in favour of CDB and the Borrower/s as the Registered User and other relevant documents to ''CDB'', respectively.</li>
</ol>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label><br />
<table style='width: 100%; font-size: 10px;'>
    <tr>
        <td style='width: 50%;'>";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label> 
        </td>
        <td style='width: 50%;'>";
             header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<p>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</p>
<table style='font-size: 10px;'>
    <tr>
        <td>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Serial No</label>
        </td>
        <td>:</td>
    </tr>
    <tr>
        <td>
            <label>Period for Installation</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Engine No</label>
        </td>
        <td> : ".$rec_select['engine_number']." </td>
    </tr>
    <tr>
        <td>
            <label>Warranty (if any)</label>
        </td>
        <td style='width: 200px;'> :
        </td>
        <td>
            <label>Chassis No</label>
        </td>
        <td>: ".$rec_select['chassis_number']." </td>
    </tr>
    <tr>
        <td>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;'> : ".$rec_select['yom']." 
        </td>
        <td>
            <label>Duplicate Key</label>
        </td>
        <td> :</td>
    </tr>
    <tr>
        <td>
            <label>Model No</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
<table style='width: 100%; font-size: 10px;'>
    <tr>
        <td style='width: 50%;'>
            &nbsp;
        </td>
        <td style='width: 50%;'>
            <label style='font-weight: bold; text-decoration: underline;'>SUPPLIER</label><br />
            <label>Signature........................................................</label><br />
            <label>Date.............................................................</label><br />
            <label>Signed by........................................................</label><br />
            <label>For and on behalf of Supplier....................................</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<!-------------------------------------------------------------------------------------------------------------->
<div style='page-break-after: always'>
<div style='font-family:  sans-serif; font-size: 10px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_Mortgage."</label><br /><br />
   <label style='font-weight: bold;' >THE SECOND COPY </label>
</div><br />
<div style='text-align: center;'>
<label style='font-family:  sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<br />
<table style='width: 100%;font-family:  sans-serif; font-size: 9px; '>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01']." </label><br />";
            if(trim($rec_select['supplier_address_02']) != ""){
               echo " <label>".$rec_select['supplier_address_02']." </label><br />";
            }
            if(trim($rec_select['supplier_address_03']) != ""){
                echo "<label>".$rec_select['supplier_address_03']." </label><br />";
            }
            
        echo "</td>
        <td style='width: 60%;'>
            <label>Ref No: ".$rec_select['fac_no']."</label><br />
            <label>Serial No :</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our Loan arrangement with 
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
(Hereinafter known as the Borrower/s) subject to the following terms and Conditions:
</p>
<table style='font-size: 9px;'>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>1. Description Of Property</td>
        <td style='width: 35%;'>: 01.".$rec_select['make_desc']." 02. ".$rec_select['model_desc']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>&nbsp;</td>
        <td style='width: 35%;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 35%;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>2. Purchase Price</td>
        <td style='width: 35%;'>: Rs.".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>3. Property Delivered to</td>
        <td style='width: 35%;'>: ".$rec_select['client_full_name']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%; text-align: right;'>3.1 Place to be Delivered</td>
        <td style='width: 35%;'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>4. Other Terms and Conditions</td>
        <td style='width: 35%;'>&nbsp;</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
</table>
<table style='font-size: 9px;'>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;'>4.1</td>
        <td style='padding-left: 9px;'>''CDB'' shall receive, in writing from the Borrower/s ,Borrower's acceptance of the property and approval of your invoice for the
same, and (b) the Borrower's instruction to ''CDB'' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.2</td>
        <td style='padding-left: 9px;'>You shall deliver to ''CDB'' and Borrower/s your written warranties, in substance and in form as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both ''CDB'' and Borrower/s or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.3</td>
        <td style='padding-left: 9px;'>a). The said Loan arrangement shall be properly conducted between Borrower/s and ''CDB''. <br />
          b). The Borrower/s, namely, <label style='font-weight: bold;'>".$rec_select['client_full_name']." </label>  is the ''mortgagor'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties. CDB is the ''mortgagee'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties.
        </td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.4</td>
        <td style='padding-left: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Mortgage over such vehicle should be registered in favour of CDB and the Borrower should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.5</td>
        <td style='padding-left: 9px;'>You shall deliver the vehicle to the Borrower/s with a comprehensive insurance policy assigned in favour of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.6</td>
        <td style='padding-left: 9px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.7</td>
        <td style='padding-left: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction
</label>
<ol>
    <li>The second copy of this Supply Agreement duly completed and signed together with the duly filled Borrowers Certification</li>
    <li>The original certificate of registration issued by RMV with the mortgage registered in favour of CDB and the Borrower/s as the Registered User and other relevant documents to ''CDB'', respectively.</li>
</ol>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label>
<table style='width: 100%; font-size: 10px;'>
    <tr>
        <td style='width: 50%;'>";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label>
        </td>
        <td style='width: 50%;'>";
             header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label>
        </td>
    </tr>
</table>
<hr />
<p>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</p>
<table style='font-size: 9px;'>
    <tr>
        <td>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Serial No</label>
        </td>
        <td>:</td>
    </tr>
    <tr>
        <td>
            <label>Period for Installation</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Engine No</label>
        </td>
        <td> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>
            <label>Warranty (if any)</label>
        </td>
        <td style='width: 200px;'> :
        </td>
        <td>
            <label>Chassis No</label>
        </td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;'> : ".$rec_select['yom']."
        </td>
        <td>
            <label>Duplicate Key</label>
        </td>
        <td> :</td>
    </tr>
    <tr>
        <td>
            <label>Model No</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
<table style='width: 100%; font-size: 9px;'>
    <tr>
        <td style='width: 50%;'>
            &nbsp;
        </td>
        <td style='width: 50%;'>
            <label style='font-weight: bold; text-decoration: underline;'>SUPPLIER</label><br />
            <label>Signature........................................................</label><br />
            <label>Date.............................................................</label><br />
            <label>Signed by........................................................</label><br />
            <label>For and on behalf of Supplier....................................</label><br />
        </td>
    </tr>
</table>
<hr />
<label style='font-weight: bold; text-decoration: underline;'>BORROWERS CERTIFICATION</label>
<p>
TO BE FILLED IN BY THE BORROWER/S -<br />
I/We do hereby agree to the terms,conditions and warranties and specifications specified in this Supply Agreement and
have received the property mentioned above in satisfactory condition and request CDB to make payments to the supplier.
<br /><br />
Name of Borrower/s : ".$rec_select['client_full_name']."<br />
Date :</p>
<p>Signature : .....................................................<br/>
for and on behalf of Borrower/s.</p>
</div>
</div>

<!-------------------------------------------------------------------------------------------------------------->
<div style='page-break-after: always'>
<div style='font-family:  sans-serif; font-size: 10px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : 01001526</label><br /><br />
   <label style='font-weight: bold;' >FILE COPY </label>
</div><br />
<div style='text-align: center;'>
<label style='font-family:  sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<br />
<table style='width: 100%;font-family:  sans-serif; font-size: 9px; '>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01']." </label><br />";
            if(trim($rec_select['supplier_address_02']) != ""){
                echo " <label>".$rec_select['supplier_address_02']." </label><br />";
            }
            if(trim($rec_select['supplier_address_03']) != ""){
                echo "<label>".$rec_select['supplier_address_03']." </label><br />";
            }
        echo "</td>
        <td style='width: 60%;'>
            <label>Ref No: ".$rec_select['fac_no']."</label><br />
            <label>Serial No :</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Citizens Development Business Finance PLC('CDB'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our loan arrangement with 
".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
(Hereinafter known as the Borrower/s) subject to the following terms and Conditions:
</p>
<table style='font-size: 9px;'>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>1. Description Of Property</td>
        <td style='width: 35%;'>: 01. ".$rec_select['make_desc']." 02. ".$rec_select['model_desc']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>&nbsp;</td>
        <td style='width: 35%;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 35%;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>2. Purchase Price</td>
        <td style='width: 35%;'>: Rs.".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>3. Property Delivered to</td>
        <td style='width: 35%;'>: ".$rec_select['client_full_name']." </td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%; text-align: right;'>3.1 Place to be Delivered</td>
        <td style='width: 35%;'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>4. Other Terms and Conditions</td>
        <td style='width: 35%;'>&nbsp;</td>
        <td style='width: 35%;'>&nbsp;</td>
    </tr>
</table>
<table style='font-size: 9px;'>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;'>4.1</td>
        <td style='padding-left: 9px;'>''CDB'' shall receive, in writing from the Borrower/s ,Borrower's acceptance of the property and approval of your invoice for the
same, and (b) the Borrower's instruction to ''CDB'' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.2</td>
        <td style='padding-left: 9px;'>You shall deliver to ''CDB'' and Borrower/s your written warranties, in substance and in form as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both ''CDB'' and Borrower/s or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.3</td>
        <td style='padding-left: 9px;'>a). The said Loan arrangement shall be properly conducted between Borrower/s and ''CDB''. <br />
          b). The Borrower/s, namely, <label style='font-weight: bold;'>".$rec_select['client_full_name']." </label>  is the ''mortgagor'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties. CDB is the ''mortgagee'' in terms of the Loan Agreement and the Mortgage Bond already entered in to between parties.
        </td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.4</td>
        <td style='padding-left: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Mortgage over such vehicle should be registered in favour of CDB and the Borrower should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.5</td>
        <td style='padding-left: 9px;'>You shall deliver the vehicle to the Borrower/s with a comprehensive insurance policy assigned in favour of CDB.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.6</td>
        <td style='padding-left: 9px;'>If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;'>4.7</td>
        <td style='padding-left: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction
</label>
<ol>
    <li>The second copy of this Supply Agreement duly completed and signed together with the duly filled Borrowers Certification</li>
    <li>The original certificate of registration issued by RMV with the mortgage registered in favour of CDB and the Borrower/s as the Registered User and other relevant documents to ''CDB'', respectively.</li>
</ol>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Citizens Development Business Finance PLC.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Citizens Development Business Finance PLC</label>
<table style='width: 100%; font-size: 10px;'>
    <tr>
        <td style='width: 50%;'>";
            header("Content-Type: image/jpeg");
            echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
            echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label>
        </td>
        <td style='width: 50%;'>";
             header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 35px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label>
        </td>
    </tr>
</table>
<hr />
<p>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</p>
<table style='font-size: 9px;'>
    <tr>
        <td>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Serial No</label>
        </td>
        <td>:</td>
    </tr>
    <tr>
        <td>
            <label>Period for Installation</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>
            <label>Engine No</label>
        </td>
        <td> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>
            <label>Warranty (if any)</label>
        </td>
        <td style='width: 200px;'> :
        </td>
        <td>
            <label>Chassis No</label>
        </td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;'> : ".$rec_select['yom']."
        </td>
        <td>
            <label>Duplicate Key</label>
        </td>
        <td> :</td>
    </tr>
    <tr>
        <td>
            <label>Model No</label>
        </td>
        <td style='width: 200px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
<table style='width: 100%; font-size: 9px;'>
    <tr>
        <td style='width: 50%;'>
            &nbsp;
        </td>
        <td style='width: 50%;'>
            <label style='font-weight: bold; text-decoration: underline;'>SUPPLIER</label><br />
            <label>Signature........................................................</label><br />
            <label>Date.............................................................</label><br />
            <label>Signed by........................................................</label><br />
            <label>For and on behalf of.............................................</label><br />
        </td>
    </tr>
</table>
<hr />
<label style='font-weight: bold; text-decoration: underline;'>BORROWERS CERTIFICATION</label>
<p>
TO BE FILLED IN BY THE BORROWER/S -<br />
I/We do hereby agree to the terms,conditions and warranties and specifications specified in this Supply Agreement and
have received the property mentioned above in satisfactory condition and request CDB to make payments to the supplier.
<br /><br />
Name of Borrower/s : ".$rec_select['client_full_name']."<br />
Date :</p>
<p>Signature : .....................................................<br/>
for and on behalf of Borrower/s.</p>
</div>
</div>
<!----------------------------------------------------- End  Supply Agreement- Vehicle Mortgage loan----------------------------------------------------------------------------------->
<!----------------------------------------------------- Start Mortgage Bond ----------------------------------------------------------------------------------->


<!----------------------------------------------------- End  Mortgage Bond ----------------------------------------------------------------------------------->
<div style='page-break-after: always;'>
<br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
<div style='font-weight: bold;font-size: 13px; text-align: center;'><label >Mortgage Bond (Vehicle)</label><br />
<label>No.".$rec_select['fac_no']."</label><br /><br />
</div>
<label style='font-weight: bold;font-size: 13px; text-align: justify;' >TO ALL TO WHOM THESE PRESENTS SHALL COME</label><br /><br />
<p style='text-align: justify;'>
The Obligor/Mortgagor named in the Schedule hereto (hereinafter called and referred to as the <label style='font-weight: bold;'>''Obligor/Mortgagor''</label> which term or expression as herein used shall where the context so requires or admits
mean and include his/her/their heirs, executors, administrators and assigns)
</p>

<p style='text-align: center; font-weight: bold;'>
-: S e n d   G r e e t i n g s:-
</p>
<p style='text-align: justify;line-height: 18px;'>
<label style='font-weight: bold;'>WHEREAS</label> the Obligor/Mortgagor has requested <label style='font-weight: bold;'> Citizens Development Business Finance PLC,</label> a company
duly incorporated under the Companies Act No. 7 of 2007 bearing Company Registration No PB 232 PQ and
having its registered office at No. 123, OrabipashaMawatha, Colombo 10 in the said Republic (hereinafter
referred to as the 'Company' which term or expression as herein used shall where the context so requires or
admits mean and include the said <label style='font-weight: bold;'>Citizens Development Business Finance PLC </label> its successors and assigns)
carrying on business in Sri Lanka as an <label style='font-weight: bold;'>Approved Credit Agency </label> under and for the purpose of the Mortgage
Act to grant loan facilities to the Obligor/Mortgagor and the Obligor/Mortgagor has agreed with the Company
in consideration thereof to enter into and execute these presents and to give as collateral security the vehicle
fully described in the schedule hereto in addition to any other security or guarantee the Obligor/Mortgagor
may have offered to the Company in respect of the said loan facilities of whatsoever kind or nature granted
and to be granted to the Obligor/Mortgagor, and
</p>
<p style='text-align: justify;line-height: 18px;'>
<label style='font-weight: bold;'>NOW KNOW YE AND THESE PRESENTS WITNESS </label> that the Obligor/Mortgagor both hereby covenant
and agree with and bind and oblige the Obligor/Mortgagor itself, his/her/their heirs executors, administrators
and assigns/ its successors and assigns to the Company that the Obligor/Mortgagor shall and will on demand
well and truly pay or cause to be paid at Colombo aforesaid to the Company;
</p>
<ol type='a' style='font-size: 12px;'>
    <li style='text-align: justify;line-height: 18px;'>all and every the sums and sum of money which now are or is or which shall may at any time and from
time to time and at all times hereafter be or become due owing and payable to the Company by the
Obligor/Mortgagor upon or in respect of said loan facilities with interest at the rate mentioned in the
schedule hereto or such other rate or rates as may from time to time be fixed or charged by the Company
to be computed as per the prevailing lending rates at the time and together with business Turn Over TAX
(BTT)/ Value Added Tax and/or any other taxes or levies as may be statutorily imposed payable as per the
prevailing rates imposed by the state.<br/></li>

<li style='text-align: justify;line-height: 18px;margin-top: 15px;'>any balance of account which may be found due by the Obligor/Mortgagor to the Company and of which
said balance a statement of account in writing made out of the books of the Company and signed and
certified by the Accountant of the Company or by any other person who may be specially appointed for
that purpose by the Company or by the Accountant thereof shall be sufficient at law and conclusive proof
without any other documents of vouchers to support the same.</li>
</ol>
<p style='text-align: justify;line-height: 18px;'>
<label style='font-weight: bold;'>AND </label> as security for such payment as aforesaid, the Obligor/Mortgagor as the owner of the vehicle/s fully
described in the schedule hereto do hereby specially mortgage and hypothecate to and with the Company as a
primary mortgage free from all seizures charges liens and encumbrance whatsoever the vehicle/smorefully
described in the schedule hereto and all the estate right title interest property claim and demand whatsoever of
the Obligor/Mortgagor into out of or upon the same.
</p>
<p style='text-align: justify;line-height: 18px;'>
AND the Obligor/Mortgagor do hereby covenant and agree with the Company as follows;
</p>
<ol type='a' style='font-size: 12px;'>
    <li style='text-align: justify;line-height: 18px;'>
that the Obligor/Mortgagor has good and legal right and full power and authority to mortgage,
hypothecate and assign the mortgaged vehicle/s hereto fully described in the manner aforesaid and that
the same are not subject to any lien seizure, charge, encumbrance or claim whatsoever kind or nature.<br/>
    </li>
     <li style='text-align: justify;line-height: 18px;margin-top: 15px;'>
that the Obligor/Mortgagor shall and will regularly and punctually pay all license fees, taxes, charges,
premia duties and insurance premiums, levies, impositions, outgoings and expenses whatsoever
whether under any written law for the time being in force or otherwise in respect of the mortgaged
vehicle/s and procure official receipts therefor and shall and will deliver unto the Company the said
official receipts or any other documents relative to or as proof of any such payments aforesaid.
<br/>
    </li>
</ol>
</div></div>


<div style='page-break-after: always;'>
<br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
<ol type='a' start='3' style='font-size: 12px;'>
<li style='text-align: justify;line-height: 18px;'>
that the Obligor/Mortgagor shall and will at all times during the continuance of the mortgage and
hypothecation effected by these presents insure and keep insured under a full and comprehensive
insurance cover in the joint names of the Obligor/Mortgagor as the owner and the Company as the
mortgagee against accident, loss, fire, civil commotion, riots or other risks and contingencies as the
Company may from time to time require the vehicle/s hereby mortgaged to the full insurable value
thereof with the ".$rec_select['INS_COM_NAME']." or any other Insurance Company Authorized by CDB
and shall and will regularly and punctually pay all and every the insurance premia and premium or
sums of money for the time being necessary for keeping in force the policy or polices and the receipts
for premia payable as aforesaid and also ensure that such insurance is assigned to the Company.<br/>
    </li>
    <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
that the Obligor/Mortgagor shall not and will not suffer or permit the mortgaged vehicle/s or any part
or portion thereof to be seized or taken in execution of any judgment or judgments against the
Obligor/Mortgagor under or in respect of any other claims or proceedings and shall not and will not
during the continuance of the mortgage and hypothecation hereby created and so long as any moneys
are due to the Company under these presents or under any decree to be entered in any action instituted
on these presents donate, sell, mortgage lease or otherwise however alienate encumber sell convey or
dispose of or deal with the mortgaged vehicle/s.<br/>
    </li>
    <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
that these presents shall be a continuing security to the Company for all and every the sums and sum
of money which now are or is or which shall or may at any time and from time to time and at all times
hereafter be or become due owing and payable by the Obligor/Mortgagor whether solely or jointly
with any other person or persons, company or companies to the Company under by virtue or in respect
of or secured by these presents notwithstanding that the amount of such sums and sum of money may
from time to time vary or be reduced or fluctuate or be repaid of in full and that fresh liabilities shall
be incurred after the Obligor/Mortgagor has ceased to be indebted to the Company it being intended
that the total amount of the moneys hereby secured shall not exceed the sum of lawful money of Sri
Lanka mentioned in the Schedule hereto, the security hereby created being intended to cover the final
balance of account between the Obligor/Mortgagor of the one part and the Company of the other part
in respect of all transactions and dealings between the Obligor/Mortgagor and the Company and that
such final balance to not exceed in the whole the sum of lawful money of Sri Lanka mentioned in the
schedule hereto with interest on default or delays as herein before stated.<br/>
    </li>
    <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
that all moneys including interest costs expenses and charges secured by or payable under these
presents shall be payable on demand at Colombo notwithstanding anything to the contrary contained
in writing or in any contract now or hereafter to be signed made or executed by or on behalf of the
Obligor/Mortgagor or the Company notwithstanding any rule of law or equity to the contrary.<br/>
    </li>
      <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
The obligor/mortgagor hereby agree that so long as the monies herein mentioned or any part thereof is
owing by the obligor/mortgagor to the Company or has not already been paid to the Company by the
obligor/mortgagor the liability of the obligor/mortgagor to pay the same shall subsist and the monies
herein mentioned shall be recoverable from and be the liability of the obligor/mortgagor jointly and
severally notwithstanding anything to the contrary herein or in any rule of law or equity or the
Prescription Ordinance or any statute contained and the obligor/mortgagor hereby further agree that
the obligor/mortgagor shall not plead the Prescription Ordinance or any of its provisions or any rule of
statute or other law as a bar to the Company suing the obligor/mortgagor for the recovery of the
monies herein mentioned or any part thereof or any sum of money that shall have become due from
the obligor/mortgagor to the Company.<br/>
    </li>
     <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
that the security hereby created shall continue to be valid binding and effectual for all purposes
notwithstanding any change by amalgamation consolidation or otherwise any other change in the
Company.<br/>
    </li>
     <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
it is further agreed that <label style='font-weight: bold;'>the Company being an Approved Credit Agency shall be entitled to act under
section 85 of the Mortgage Act to sell the mortgaged property and the Company as agent is
empowered to exercise the power of sale conferred there by subject to the provisions of the
Mortgage Act.</label><br/>
    </li>
    <li style='text-align: justify;line-height: 18px;margin-top: 20px;'>
that every demand under these present may be effectually made sending notice of demand in writing
under section 86 (1) of the Mortgage Act to the address of the Obligor/Mortgagor as stated
hereinbefore unless the Obligor/Mortgagor have notified in writing a change of address and such being
sent by the post under registered cover.<br/>
    </li>
</ol>
</div>
</div>
<div style='page-break-after: always;'>
<br /><br /><br />
<div style='font-family: sans; font-size: 12px;'>
    <p style='text-align: justify;'>
       <label style='font-weight: bold;'>IN WITNESS WHEREOF </label> the Obligor has set his/her/their hand/s at Colombo on the date herein after mentioned.  
    </p> 
    <p style='text-align: justify;'>
       <label style='font-weight: bold; margin-left: 20px;'>THE SCHEDULE ABOVE REFERRED TO </label> 
    </p>  
    <div style='border: #000000 solid 1px; width: 90%;'>
        <p>
            <label style='margin-left: 10px;'>Mortgage Bond No ".$rec_select['fac_no']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date of Mortgage Bond: ".$rec_select['cbd']."</label> 
        </p>
        <ul type='1' style='font-size: 12px;'>
            <li>Name, Address and Description of Mortgagor ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</li>
            <li>Value of Mortgage Bond : Rs.".number_format($rec_select['lease_amount'],2)."</li>
            <li>Rate : ".number_format($rec_select['INT_RATE'],2)."%</li>
            <li>Description of Vehicle mortgaged
                <table style='width: 100%; font-size: 12px; margin-left: 10px;'>
                    <tr>
                        <td style='width: 30%;font-weight: bold;'>
                         Vehicle Registration No
                        </td>
                        <td style='width: 70%;'>
                          : ".$rec_select['vehicle_number']."
                        </td>
                    </tr>
                    <tr>
                        <td style='width: 30%;font-weight: bold;'>
                         Make
                        </td>
                        <td style='width: 70%;'>
                          : ".$rec_select['make_desc']."
                        </td>
                    </tr>
                     <tr>
                        <td style='width: 30%;font-weight: bold;'>
                         Model
                        </td>
                        <td style='width: 50%;'>
                          : ".$rec_select['model_desc']."
                        </td>
                    </tr>
                     <tr>
                        <td style='width: 30%;font-weight: bold;'>
                         Chassis No
                        </td>
                        <td style='width: 70%;'>
                          : ".$rec_select['chassis_number']."
                        </td>
                    </tr>
                     <tr>
                        <td style='width: 30%;font-weight: bold;'>
                         Engine No
                        </td>
                        <td style='width: 70%;'>
                          : ".$rec_select['engine_number']."
                        </td>
                    </tr>
                </table>
            </li>
        </ul>
         <table style='width: 100%; font-size: 12px; margin-left: 10px;'>
                    <tr>
                        <td style='width: 50%;font-weight: bold;'>
                         Year of Manufacture
                        </td>
                        <td style='width: 50%;'>
                          : ".$rec_select['yom']."
                        </td>
                    </tr>
                     <tr>
                        <td style='width: 50%;font-weight: bold;'>
                         Location Of Vehicle
                        </td>
                        <td style='width: 50%;'>
                          : ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
                        </td>
                    </tr>
         </table>
    </div>
    <p style='text-align: justify;'>
        Signed by Mortgagor
    </p>
      <table style='width: 100%; font-size: 12px; margin-left: 10px;'>
            <tr>
                <td style='width: 50%;'>
                 <label> Name. ".$rec_select['client_full_name']."</label><br />
                 <label> NIC No. ".$rec_select['client_nic']."</label><br /><br /><br />
                </td>
                <td style='width: 50%;'>
                    <br /><br /><br />
                   <label> Signature</label>
                </td>
            </tr>
            <tr>
                <td style='width: 50%;'>
                 <label> Name Joint Client.</label><br />
                 <label> NIC No. </label><br /><br /><br />
                </td>
                <td style='width: 50%;'>
                    <br /><br /><br />
                   <label> Signature</label>
                </td>
            </tr>
      </table>
      <p style='text-align: justify;'>We the subscribing witnesses hereto do declare that we are well acquainted with the said Mortgagor/Obligor
and know his/their proper name, occupation and residence.</p>
        <p style='text-align: justify;'>In the presence of : </p>
        <table style='width: 100%; font-size: 12px; margin-left: 10px;'>
            <tr>
                <td style='width: 50%;'>
                 <label> Witnesses 1</label><br />
                </td>
                <td style='width: 50%;'>
                   <label> Witnesses 2</label>
                </td>
            </tr>
            <tr>
                <td style='width: 50%;'>
                 <label> Name :.</label><br /><br />
                 <label> Address : </label><br /><br />
                 <label> Signature :</label><br /><br />
                </td>
                <td style='width: 50%;'>
                     <label> Name :.</label><br /><br />
                     <label> Address : </label><br /><br />
                     <label> Signature :</label><br /><br />
                </td>
            </tr>
      </table>
      <p style='text-align: justify;'>Declaration</p>
      <p style='text-align: justify;'>I .................................................................... Being the Branch Manager /Operations In-charge /Authored Officer CDB
finance PLC ................................ branch / Head Office herewith certify that this instrument was signed by the said mortgagor/s
and witnesses before me and in my presence.</p>
<br /><br />
<table style='width: 100%; font-size: 12px;'>
    <tr>
        <td style='width: 50%;'>";
            //header("Content-Type: image/jpeg"); ".$sig_name_01." ".$branch_01." ".$sig_name_01."".$des_01."
            //echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>"; ".$rec_select['cbd']."
            echo "<label>.......................................................</label><br />
            <label>Signature</label><br />
        </td>
        <td style='width: 50%;'>
            <label>................................................</label><br />
            <label>Date</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;'>
            <label></label><br />
            <label></label><br />
        </td>
        <td style='width: 50%;'>
           <br />
            
        </td>
    </tr>
</table>
        

</div>
</div>";
    
       //------------------------------------------------ End Format for Mortgage Letter --------------------------------------------------------------------------------------
    
    }
}


function print_balanceCompermetion($get_index_BC,$get_clint_code_bc,$get_v_user_print_BC,$get_v_type_BC){
    //echo "B"; 
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_Mortgage = "SELECT `V_INDEX`, `CLIENT_CODE`, `V_NAME`, `V_ADD`, `V_NIC`, `V_NAME_INIT`, `V_JDATE`, 
                        `V_BALSUM`,`V_DEPTBL`, `V_SVTBL`, `V_LIENSTAT`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`, `embassy_id`, `jointPartyDetails`, `cashBackedLoanOutstanding`, `redemptionCapability`, `nomineeDetails`, `cdb`, `requestUser`, `printUser`, `V_NUMOFDEPS`, `V_JNAMESLIST`, `V_JNICLIST`, `V_NOMLIST`, `V_NOMNICLIST`, `V_DEPLINKCOUNT`, `V_CBOUTSUM`, `V_BASEDATE` , `V_DEPLINKS` , `CusName`,`Custom_Address1`,`Custom_Address2`,`Custom_Address3`,`Custom_Address4`,`docType`
                        FROM `sps_balance_confirmation`
                        WHERE `V_INDEX` = '".$get_index_BC."' AND
                               `CLIENT_CODE` = '".$get_clint_code_bc."' AND 
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    //echo $sql_select_Mortgage; $rec_select['V_DEPLINKS']
    $que_select_Mortgage = mysqli_query($conn,$sql_select_Mortgage)or die(mysqli_error());
    while($rec_select = mysqli_fetch_assoc($que_select_Mortgage)){
        //echo $rec_select['fac_no']."--".$rec_select['client_name']
        
        $date = date("h:i:sa");
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*30);
        $formatDate = date("H:i:s", $futureDate);
       /*$sql_ath1 = "SELECT s.`SIG_IMG`,s.`designation`,s.`sig_name` , b.`branchName`
                    FROM `sps_sig_mast` AS s , `branch` AS b , `user` AS u
                    WHERE s.`USER_ID` = u.userName AND u.branchNumber = b.branchNumber AND  `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            $branch_01 = $row_ath1[3];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }*/
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
       
       
       
        $sql_embassy = "SELECT e.embassy_name , e.embassy_add1 , e.embassy_add2 , e.embassy_add3 , e.embassy_add4 , e.embassy_add5
                         FROM sps_embassy AS e 
                         WHERE e.embassy_id = '".$rec_select['embassy_id']."';";
        $query_embassy = mysqli_query($conn,$sql_embassy) or die(mysqli_error($conn));
        while($rec_embassy = mysqli_fetch_assoc($query_embassy)){
            $embassy_name = $rec_embassy['embassy_name'];
            $embassy_add1 = $rec_embassy['embassy_add1'];
            $embassy_add2 = $rec_embassy['embassy_add2'];
            $embassy_add3 = $rec_embassy['embassy_add3'];
            $embassy_add4 = $rec_embassy['embassy_add4'];
            $embassy_add5 = $rec_embassy['embassy_add5'];
        }
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_index_BC."' AND `LET_TYPE` = '".$get_v_type_BC."';";
            $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
            $ans_s = 0;
            while($res_select_print = mysqli_fetch_array($que_select_print)){
                $ans_s = $res_select_print[0]+1;
            }
            $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                    VALUES ('".$get_v_type_BC."','".$get_index_BC."','".$ans_s."','".$get_v_user_print_BC."',now(),'Balance Confirmation Letter Print.','".$get_v_user_print_BC."',now());";
            //echo $sql_insert;                                        
            $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
            $sql_update = "UPDATE `sps_balance_confirmation` 
                                SET `print_stats`= 2 ,
                                    `printUser` = '".$get_v_user_print_BC."'
                                WHERE `V_INDEX` = '".$get_index_BC."' AND
                                       `CLIENT_CODE` = '".$get_clint_code_bc."' AND
                                       `AUTH_1_BY` != '' AND
                                       `AUTH_2_BY` != '' AND
                                       `print_stats` = 1;";
           //echo $sql_update;
           $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
            mysqli_commit($conn);
        }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
        }
        
echo "<div style='page-break-after: always'>
<div style='font-family:  sans; font-size: 14px; text-align: left;'>
   <label style='font-weight: bold;' >Ref No. : ".date("Y/m")."/".$get_index_BC." </label><br />
</div><br />
<div style='text-align: center;'>
<label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Private &amp; Confidential</label>
</div>
<br />
<div style='font-family: sans; font-size: 14px;'>
     <label>".date("d-m-Y")."</label><br />
</div><br />";

if($rec_select['docType'] == 1){
    echo "<table style='width: 100%;font-family: sans; font-size: 14px; '>
    <tr>
        <td>
            <label>".$embassy_name."</label><br />
            <label>".$embassy_add1."</label><br />";
            if($embassy_add2 != ""){
                echo "<label>".$embassy_add2."</label><br />";
            }
            if($embassy_add3 != ""){
                echo "<label>".$embassy_add3."</label><br />";
            }
            if($embassy_add4 != ""){
                echo "<label>".$embassy_add4."</label><br />";
            }
            if($embassy_add5 != ""){
                echo "<label>".$embassy_add5."</label><br />";
            }
            
    
    echo "</td></tr></table>";
}else if($rec_select['docType'] == 2){
    echo "<table style='width: 100%;font-family: sans; font-size: 14px; '>
            <tr>
                <td>
                    <label>".$rec_select['V_NAME_INIT']."</label><br />";
    $arr = explode(',',$rec_select['V_ADD']);
    for($r = 0 ; $r < sizeof($arr) ; $r++){
        if($arr[$r] != ""){
                echo "<label>".$arr[$r]."</label><br />";
        }
    }
    
    echo "</td></tr></table>";
}else if($rec_select['docType'] == 3){
     echo "<table style='width: 100%;font-family: sans; font-size: 14px; '>
            <tr>
                <td>
                    <label>".$rec_select['CusName']."</label><br />";
                 if($rec_select['Custom_Address1'] != ""){
                    echo "<label>".$rec_select['Custom_Address1']."</label><br />";
                 }  
                 if($rec_select['Custom_Address2'] != ""){
                    echo "<label>".$rec_select['Custom_Address2']."</label><br />";
                 }  
                 if($rec_select['Custom_Address3'] != ""){
                    echo "<label>".$rec_select['Custom_Address3']."</label><br />";
                 }  
                 if($rec_select['Custom_Address4'] != ""){
                    echo "<label>".$rec_select['Custom_Address4']."</label><br />";
                 }   
     echo "</td></tr></table>";
}else{
    echo "Leeter Error";
}


echo "<div style='font-family: sans; font-size: 14px;'>
<br/>
<label>Dear Sir/Madam,</label><br /><br />

<table style='font-size: 14px;'>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>Depositor&apos;s Name</td>
        <td>: <span style='margin-left: 2px;'> ".$rec_select['V_NAME']."</span></td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>Given Address</td>
        <td>: <span style='margin-left: 2px;'>".$rec_select['V_ADD']."</span></td>
    </tr>
     <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>NIC No.</td>
        <td>: <span style='margin-left: 2px;'>".$rec_select['V_JNICLIST']."</span></td>
    </tr>
</table>
<hr />";

if($rec_select['docType'] == 1 || $rec_select['docType'] == 3){
    echo "<p style='text-align: justify; font-size: 14px;'>
        We wish to inform that ".$rec_select['V_NAME_INIT']." is a/are valued depositor/s of our institution and continuously conducting business with us very satisfactorily since ".$rec_select['V_JDATE'].". We hereby confirm the deposits placed with us for LKR ".$rec_select['V_BALSUM']." on the following basis.
    </p>";
    
}else if($rec_select['docType'] == 2){
     echo "<p style='text-align: justify; font-size: 14px;'>
        At your request, we hereby confirm the deposit details as follows.
     </p>";
}else{
    echo "Leeter Error";
}

$arr_1 = explode("<tr style=\"text-align: center; vertical-align: top;\">",$rec_select['V_DEPTBL']);
//echo sizeof($arr_1);
if($rec_select['docType'] == 1 || $rec_select['docType'] == 3){
echo "<table style='font-size: 14px;'>
    <tr style='text-align: center; vertical-align: top; font-weight: bold;text-decoration: underline;'>
        <td style='width: 20%;'>Deposit Account No.</td>
        <td style='width: 20%;'>Amount (LKR)</td>
        <td style='width: 20%;'>Deposit/Renewed Date</td>
        <td style='width: 20%;'>Maturity Date</td>
        <td style='width: 20%;'>Originated Date</td>
    </tr>";
}else if($rec_select['docType'] == 2){
     echo "<table style='font-size: 14px;'>
    <tr style='text-align: center; vertical-align: top; font-weight: bold;text-decoration: underline;'>
        <td style='width: 20%;'>Deposit Account No.</td>
        <td style='width: 20%;'>Amount (LKR)</td>
        <td style='width: 15%;'>Deposit/Renewed Date</td>
        <td style='width: 15%;'>Maturity Date</td>
        <td style='width: 15%;'>Interest Rate (p.a) %</td>
        <td style='width: 15%;'>Interest Payment Frequency</td>
    </tr>";
}else{
    echo "Leeter Error";
}
    //header("Content-Type: text/html");
    //header("Content-type: text/xml");
    //header("Content-Disposition: attachment");
    
    
    echo $rec_select['V_DEPTBL'];           
echo "</table>
<br />";
$arr_2 = explode("<tr style=\"text-align: center; vertical-align: top;\">",$rec_select['V_SVTBL']);
//echo sizeof($arr_2);
echo "<table style='font-size: 14px;'>
    <tr style='text-align: center; vertical-align: top; font-weight: bold;text-decoration: underline;'>
        <td style='width: 20%;'>Savings Account No.</td>
        <td style='width: 20%;'>Initial Deposit Date</td>
        <td style='width: 20%;'>Account Balance as at<br /> ".date("d/m/Y")." (LKR)</td>
    </tr>";
  echo $rec_select['V_SVTBL'];
echo "</table>
</div>
";
$arr_count = sizeof($arr_1)+sizeof($arr_2);
//echo $arr_count;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($arr_count > 23){
   if($rec_select['jointPartyDetails'] == 1 || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
                    echo "<div>
                            <label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Notes</label><br />
                            <ul style='text-align: justify; font-size: 14px;font-family: sans;'>";
                                if($rec_select['jointPartyDetails'] == 1){
                                    
                                    echo "<li>";
                                    if($rec_select['V_NUMOFDEPS'] <= 1){
                                        echo "This is a joint deposit";
                                    }else{
                                        echo "These are joint deposits";
                                    }
                                    echo  " with ".$rec_select['V_JNAMESLIST']." bearing NIC No.".$rec_select['V_JNICLIST'].".</li>";
                                }  
                                
                                if($rec_select['nomineeDetails'] == 1){
                                    echo "<li>".$rec_select['V_NOMLIST']." bearing NIC No. ".$rec_select['V_NOMNICLIST']." has been appointed as the nominee for the above deposits. </li>";
                                }
                                
                                if(convetDecimal($rec_select['V_CBOUTSUM']) > 0){
                                    
                                    echo " <li>";
                                    if($rec_select['V_DEPLINKCOUNT'] <= 1){
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." is";
                                    }else{
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." are";
                                    }
                                    echo " held under lien to the company for a credit facility and outstanding balance available is LKR ".$rec_select['V_CBOUTSUM']." as at ".date("d/m/Y").".</li>";
                                }
                                
                                if($rec_select['redemptionCapability'] == 1){
                                    echo "<li>On request of the depositor, these deposits can be considered for redemption before the maturity subject to reduced rate of interest.</li>";
                                }
                                
                            echo "</ul>
                        </div>";
                }
                echo "
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            The above information is communicated at the request of our constituent in the strictest confidence and without responsibility or guarantee on the part of this company or any of its  officers.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            It is a condition of this letter that the name of this company should not be disclosed in the event of our report being passed on by you.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            Licensed by the Monetary board of the Central Bank of Sri Lanka under the Finance Business Act, No.42 of 2011 (Registration No. RFC/035).
            </p>
            <label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Yours Faithfully,</label><br />
            <label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Citizens Development Business Finance PLC</label><br />
            <table style='width: 100%; font-size: 14px;'>
                <tr>
                    <td style='width: 50%; text-align: center;'>";
                    header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo "<label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />
                    </td>
                    <td style='width: 50%;text-align: center;'>";
                    /*header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo " <label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />";*/
                    echo "</td>
                </tr>
            </table>
            <br />
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for any further references regarding this computer generated letter.</p>
            </div>";

}else if($arr_count <= 23 && $arr_count >= 20){
    echo "</div>"; 
    echo "<div style='page-break-after: always;'>";
    if($rec_select['jointPartyDetails'] == 1  || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
        echo "<div>
                <label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Notes</label><br />
                <ul style='text-align: justify; font-size: 14px;font-family: sans;'>";
                    if($rec_select['jointPartyDetails'] == 1){
                        
                        echo "<li>";
                        if($rec_select['V_NUMOFDEPS'] <= 1){
                            echo "This is a joint deposit";
                        }else{
                            echo "These are joint deposits";
                        }
                        echo  " with ".$rec_select['V_JNAMESLIST']." bearing NIC No.".$rec_select['V_JNICLIST'].".</li>";
                    }  
                    
                    if($rec_select['nomineeDetails'] == 1){
                        echo "<li>".$rec_select['V_NOMLIST']." bearing NIC No. ".$rec_select['V_NOMNICLIST']." has been appointed as the nominee for the above deposits. </li>";
                    }
                    
                    if(convetDecimal($rec_select['V_CBOUTSUM']) > 0 ){
                        
                        echo " <li>";
                        if($rec_select['V_DEPLINKCOUNT'] <= 1){
                            echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." is";
                        }else{
                            echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." are";
                        }
                        echo " held under lien to the company for a credit facility and outstanding balance available is LKR ".$rec_select['V_CBOUTSUM']." as at ".$rec_select['V_BASEDATE'].".</li>";
                    }
                    
                    if($rec_select['redemptionCapability'] == 1){
                        echo "<li>On request of the depositor, these deposits can be considered for redemption before the maturity subject to reduced rate of interest.</li>";
                    }
                    
                echo "</ul>
            </div>";
    } 
if($rec_select['docType'] == 1 || $rec_select['docType'] == 3){
    echo "
<p style='text-align: justify; font-size: 14px;font-weight: bold;'>
The above information is communicated at the request of our constituent in the strictest confidence and without responsibility or guarantee on the part of this company or any of its  officers.
</p>
<p style='text-align: justify; font-size: 14px;font-weight: bold;'>
It is a condition of this letter that the name of this company should not be disclosed in the event of our report being passed on by you.
</p>
<p style='text-align: justify; font-size: 14px;font-weight: bold;'>
Licensed by the Monetary board of the Central Bank of Sri Lanka under the Finance Business Act, No.42 of 2011 (Registration No. RFC/035).
</p>";
}
echo "<label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Yours Faithfully,</label><br />
<label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Citizens Development Business Finance PLC</label><br />
<table style='width: 100%; font-size: 14px;'>
    <tr>
        <td style='width: 50%; text-align: center;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          
        echo "<label>.......................................................</label><br />
            <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />
        </td>
        <td style='width: 50%;text-align: center;'>";
        /*header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          
        echo " <label>.......................................................</label><br />
            <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />";*/
        echo "</td>
    </tr>
</table>
<br />
<p style='text-align: justify; font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for any further references regarding this computer generated letter.</p>
</div>";
    
}else{
    if($arr_count < 20 && $arr_count > 15){
         echo "</div>"; 
                    
                if($rec_select['jointPartyDetails'] == 1 || $rec_select['redemptionCapability'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0 || $rec_select['nomineeDetails'] == 1) {
                    echo "<div>
                            <label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Notes</label><br />
                            <ul style='text-align: justify; font-size: 14px;font-family: sans;'>";
                                if($rec_select['jointPartyDetails'] == 1){
                                    
                                    echo "<li>";
                                    if($rec_select['V_NUMOFDEPS'] <= 1){
                                        echo "This is a joint deposit";
                                    }else{
                                        echo "These are joint deposits";
                                    }
                                    echo  " with ".$rec_select['V_JNAMESLIST']." bearing NIC No.".$rec_select['V_JNICLIST'].".</li>";
                                }  
                                
                                if($rec_select['nomineeDetails'] == 1){
                                    echo "<li>".$rec_select['V_NOMLIST']." bearing NIC No. ".$rec_select['V_NOMNICLIST']." has been appointed as the nominee for the above deposits. </li>";
                                }
                                
                                if(convetDecimal($rec_select['V_CBOUTSUM']) > 0 ){
                                    
                                    echo " <li>";
                                    if($rec_select['V_DEPLINKCOUNT'] <= 1){
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." is";
                                    }else{
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." are";
                                    }
                                    echo " held under lien to the company for a credit facility and outstanding balance available is LKR ".$rec_select['V_CBOUTSUM']." as at ".$rec_select['V_BASEDATE'].".</li>";
                                }
                                
                                if($rec_select['redemptionCapability'] == 1){
                                    echo "<li>On request of the depositor, these deposits can be considered for redemption before the maturity subject to reduced rate of interest.</li>";
                                }
                                
                            echo "</ul>
                        </div>";
                } 
            echo "<div style='page-break-after: always;'>";
            if($rec_select['docType'] == 1 || $rec_select['docType'] == 3){
                echo "
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            The above information is communicated at the request of our constituent in the strictest confidence and without responsibility or guarantee on the part of this company or any of its  officers.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            It is a condition of this letter that the name of this company should not be disclosed in the event of our report being passed on by you.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            Licensed by the Monetary board of the Central Bank of Sri Lanka under the Finance Business Act, No.42 of 2011 (Registration No. RFC/035).
            </p>";
            }
            echo "<label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Yours Faithfully,</label><br />
            <label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Citizens Development Business Finance PLC</label><br />
            <table style='width: 100%; font-size: 14px;'>
                <tr>
                    <td style='width: 50%; text-align: center;'>";
                    header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo "<label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />
                    </td>
                    <td style='width: 50%;text-align: center;'>";
                    /*header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo " <label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />";*/
                    echo "</td>
                </tr>
            </table>
            <br />
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for any further references regarding this computer generated letter.</p>
            </div>";
    }else{      
                if($rec_select['jointPartyDetails'] == 1 ||  $rec_select['redemptionCapability'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0 || $rec_select['nomineeDetails'] == 1) {
                    echo "<div>
                            <label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Notes</label><br />
                            <ul style='text-align: justify; font-size: 14px;font-family: sans;'>";
                                if($rec_select['jointPartyDetails'] == 1){
                                    
                                    echo "<li>";
                                    if($rec_select['V_NUMOFDEPS'] <= 1){
                                        echo "This is a joint deposit";
                                    }else{
                                        echo "These are joint deposits";
                                    }
                                    echo  " with ".$rec_select['V_JNAMESLIST']." bearing NIC No.".$rec_select['V_JNICLIST'].".</li>";
                                }  
                                
                                if($rec_select['nomineeDetails'] == 1){
                                    echo "<li>".$rec_select['V_NOMLIST']." bearing NIC No. ".$rec_select['V_NOMNICLIST']." has been appointed as the nominee for the above deposits. </li>";
                                }
                                
                                if(convetDecimal($rec_select['V_CBOUTSUM']) > 0 ){
                                    
                                    echo " <li>";
                                    if($rec_select['V_DEPLINKCOUNT'] <= 1){
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." is";
                                    }else{
                                        echo "The Deposit Account No. ".$rec_select['V_DEPLINKS']." are";
                                    }
                                    echo " held under lien to the company for a credit facility and outstanding balance available is LKR ".$rec_select['V_CBOUTSUM']." as at ".$rec_select['V_BASEDATE'].".</li>";
                                }
                                
                                if($rec_select['redemptionCapability'] == 1){
                                    echo "<li>On request of the depositor, these deposits can be considered for redemption before the maturity subject to reduced rate of interest.</li>";
                                }
                                
                            echo "</ul>
                        </div>";
                }
             if($rec_select['docType'] == 1 || $rec_select['docType'] == 3){
                echo "
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            The above information is communicated at the request of our constituent in the strictest confidence and without responsibility or guarantee on the part of this company or any of its  officers.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            It is a condition of this letter that the name of this company should not be disclosed in the event of our report being passed on by you.
            </p>
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>
            Licensed by the Monetary board of the Central Bank of Sri Lanka under the Finance Business Act, No.42 of 2011 (Registration No. RFC/035).
            </p>";
            }
            echo "<br/>
            <label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Yours Faithfully,</label><br />
            <label  style='text-align: justify; font-size: 14px;font-weight: bold;'>Citizens Development Business Finance PLC</label><br />
            <table style='width: 100%; font-size: 14px;'>
                <tr>
                    <td style='width: 50%;'>";
                    header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo "<label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />
                    </td>
                    <td style='width: 50%;text-align: center;'>";
                    /*header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo " <label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />"*/
                    echo "</td>
                </tr>
            </table>
            <br />
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for any further references regarding this computer generated letter.</p>
            </div>";
    }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}


//------------------- Nilanka 2018-08-23 - CBL05---------------------------------
function print_CBL05_letter($Index_Print,$Print_User){
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$Index_Print."' AND `LET_TYPE` = 'CBL05';";
            $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
            $ans_s = 0;
            while($res_select_print = mysqli_fetch_array($que_select_print)){
                $ans_s = $res_select_print[0]+1;
            }
            $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                    VALUES ('CBL05','".$Index_Print."','".$ans_s."','".$Print_User."',now(),'CBL exceeding 05 Years Letter.','".$Print_User."',now());";
            //echo $sql_insert;                                        
            $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
            $sql_update = "UPDATE `sps_cbl05_let_batch` 
                                SET `BATCH_STAT`= 'P' 
                                WHERE `BATCH_NUM` = '".$Index_Print."'";
           //echo $sql_update;
           $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));
           mysqli_commit($conn);
        }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
        }
    
    
    
    $sql_get_cbl05_tbl_data = "select * from sps_cbl05_gen s where s.BATCH_NUM = ".$Index_Print.";";
    $query_get_tbl_data = mysqli_query($conn,$sql_get_cbl05_tbl_data) or die(mysqli_error($conn));
    
    while($result_tbl_data = mysqli_fetch_assoc($query_get_tbl_data)){
    //------Start Main While    
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$result_tbl_data['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
    
    //-------- END OF MAIN WHILE
echo " <div style='page-break-after: always' id='cover'>
            <br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div style='font-family: sans; font-size: 14px;'>
               <label style='font-family: sans; font-size: 14px;'>".date('F j, Y')."</label><br />
            </div>
            <br />
            <table style='width: 100%;font-family: sans; font-size: 14px;'>
        <tr>
            <td>
                <label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['CLIENT_NAME']."</label><br />
                <label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['ADDR1']."</label><br />";
                if ($result_tbl_data['ADDR2'] != "") {
                   echo  "<label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['ADDR2']."</label><br />"; 
                }
                if ($result_tbl_data['ADDR3'] != "") {
                   echo  "<label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['ADDR3']."</label><br />"; 
                }
                if ($result_tbl_data['ADDR4'] != "") {
                   echo  "<label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['ADDR4']."</label><br />"; 
                }
                if ($result_tbl_data['ADDR5'] != "") {
                   echo  "<label style='font-family: sans; font-size: 14px; '>".$result_tbl_data['ADDR5']."</label><br />"; 
                }
             echo " </td>
        </tr>
    </table>
    <div style='font-family: sans; font-size: 14px;'><br />
        <label style='font-family: sans; font-size: 14px;'>Dear Sir/Madam,</label><br /><br /><br />
        <p style='text-align: justify;font-family: sans; font-size: 14px;'>
        <u>Loan A/C No: ".$result_tbl_data['CB_NUMBER']." </u> </p>
		<p style='text-align: justify;font-family: sans; font-size: 14px;'>
        Pledged Fixed Deposit No: ".$result_tbl_data['DEP_ACC_NO_1'].",Amount LKR - ".number_format($result_tbl_data['DEP_AMOUNT'],2)." 
        </p>
		<p style='text-align: justify;font-family: sans; font-size: 14px;'>
		With reference to the above loan obtained by you on ".date('j F, Y',strtotime($result_tbl_data['ACC_OPEN_DATE']))." we wish to inform you that the loan period will exceed the 5 years and details are as follows.
		</p><br /><br />
        <table style='font-weight: bold;font-family: sans; font-size: 14px;'  border='1' cellpadding='0' cellspacing='0' id='myTable'> 
                    <tr>
                        <td style='width: 300px;font-family: sans; font-size: 14px;'>   Loan Account No </td>
                       <td style='width: 300px;;font-family: sans; font-size: 14px;'>Loan Outstanding as at ".date('j F, Y', strtotime('last day of previous month'))." </td>
                    </tr>
                    <tr >
                        <td style='width: 300px;;font-family: sans; font-size: 14px;'>".$result_tbl_data['CB_NUMBER']."</td>
                        <td style='width: 300px;font-family: sans; font-size: 14px;'>LKR ".number_format((float)$result_tbl_data['LOAN_BALANCE'],2,'.','')."</td>
                    </tr>
                    
                </table>
                <br />
                  <p style='text-align: justify;font-family: sans; font-size: 14px;'>
                    If you wish to continue the deposit and the loan, please make arrangements to provide a consent letter to any of our branch requesting to extend the loan before ".date('j F, Y', strtotime('+14 days')).".
                </p>
            
            
                <p style='text-align: justify;font-family: sans; font-size: 14px;'>
                    If you are unable to provide the consent letter, we will uplift the deposit and settle the loan in full. Any balance available after settling the loan will be credited to your savings account accordingly.
                </p>
            
            
                <p style='text-align: justify;font-family: sans; font-size: 14px;'>
                  Please contact us on 011-7-388388 for further clarification. You may also visit our nearest branch for further assistance in this regard.
                </p>
               <br />
               <table style='font-family: sans; font-size: 14px;'>
            <tr>
                <td>
                    <label style='font-family: sans; font-size: 14px;'>Yours faithfully,</label><br /><br />
                    <label style='font-family: sans; font-size: 14px;'>Citizens Development Business Finance PLC</label><br />";
                    header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                    echo "<label>.......................................................</label><br />
                    <label>".$sig_name_02."</label><br /> 
                    <label>".$des_02."</label><br />
					
            
             
                </td>

            </tr>
        </table>
           
  
       
    </div>
</div>";
    }
    
    
}
//-------------Madushan 2018-01-26 - Confirmation Of NomineeDatails

function print_ConfirmationOfNomineeDatails($Index_Print,$Print_User){
    
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    //echo $Index_Print ." -- ".$Print_User;
    //----- Start Update DB
    mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$Index_Print."' AND `LET_TYPE` = 'COND';";
            $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
            $ans_s = 0;
            while($res_select_print = mysqli_fetch_array($que_select_print)){
                $ans_s = $res_select_print[0]+1;
            }
            $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                    VALUES ('COND','".$Index_Print."','".$ans_s."','".$Print_User."',now(),'Confirmation of Nominee Details.','".$Print_User."',now());";
            //echo $sql_insert;                                        
            $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
            $sql_update = "UPDATE `sps_conf_nominee_dtl` 
                                SET `PRINT_STATUS`= 'P' ,
                                    `PRINT_BY` = '".$Print_User."' ,
                                    `PRINT_ON` = NOW()
                                WHERE `V_INDEX` = '".$Index_Print."' AND
                                      `PRINT_STATUS` = 'A';";
           //echo $sql_update;
           $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
           mysqli_commit($conn);
        }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
        }
    
    
    
    //----- END Update DB
    //---- Start Print Letter------------------------------
    $sql_get_tbl_data = "SELECT * FROM sps_conf_nominee_dtl AS sc WHERE sc.V_INDEX = ".$Index_Print.";";
       /*--------------------------------
       V_INDEX		    INT(12) Autonumber
       ACC_NO 		    Varchar 22
       CONT_NO 		    int 4
       DEP_AMOUNT     	Decimal (10,3) 
       NOMINEE_NAME   	varchar 100
       OWN_PERCENT 		Decimal (4,4)
       NOMINEE_NIC 		Varchar 15
       NOMINEE_DOB 		Varchar 50
       NOMINEE_ADD1 	Varchar 100
       NOMINEE_ADD2 	Varchar 100
       NOMINEE_ADD3   	Varchar 100
       NOMINEE_ADD4   	Varchar 100
       NOMINEE_ADD5   	Varchar 100
       CLIENT_NAME    	Varchar 100
       CLIENT_ADD1    	Varchar 100
       CLIENT_ADD2    	Varchar 100
       CLIENT_ADD3    	Varchar 100
       CLIENT_ADD4    	Varchar 100
       CLIENT_ADD5    	Varchar 100
       CLIENT_LOCATION 	Varchar 100
       REQUEST_BY		Varchar 10
       REQUEST_ON		DATE AND TIME
       PRINT_STATUS		char 1
       AUTH_1_BY 		Varchar 10
       AUTH_1_DATE		DATE AND TIME
       AUTH_2_BY		Varchar 10
       AUTH_2_DATE		DATE AND TIME
       PRINT_BY		    Varchar 10
       PRINT_ON 		DATE AND TIME
       --------------------------------------------------------*/
    $query_get_tbl_data = mysqli_query($conn,$sql_get_tbl_data) or die(mysqli_error($conn));
    while($result_tbl_data = mysqli_fetch_assoc($query_get_tbl_data)){
    //------Start Main While    
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$result_tbl_data['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
      echo "<div id='printablediv'>
            <div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
            <br /><br /><br /><br /><br /><br />";
      echo "<h3 style='font-family: sans;'>Ref No. : ".date("Y/m")."/".$Index_Print."</h3><br /><br />";
      echo "<label style='font-family: sans;font-size: 14px;'>".date("d-m-Y")."</label> <br />";
      echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_NAME']." </label> <br />";   
      if($result_tbl_data['CLIENT_ADD1'] != ""){
        echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_ADD1']."</label><br />";
      }
      if($result_tbl_data['CLIENT_ADD2'] != ""){
        echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_ADD2']."</label><br />";
      }
       if($result_tbl_data['CLIENT_ADD3'] != ""){
        echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_ADD3']."</label><br />";
      }
       if($result_tbl_data['CLIENT_ADD4'] != ""){
        echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_ADD4']."</label><br />";
      }
       if($result_tbl_data['CLIENT_ADD5'] != ""){
        echo "<label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['CLIENT_ADD5']."</label><br />";
      }
            
            
            
            
      echo  "<label style='font-family: sans;font-size: 14px;'>Dear Sir/Madam,</label>
            <h3 style='font-family: sans;'>Confirmation of Nominee Details </h3> <br />";
      echo  "<table style='font-family: sans;font-size: 14px;'>
            <tr>
            <td>Fixed deposit Ref : </td>
            <td>No. ".$result_tbl_data['ACC_NO']."/".$result_tbl_data['CONT_NO']." </td>
            <td>for Rs. ".number_format($result_tbl_data['DEP_AMOUNT'],2)."</td>
            </tr>
            </table>";
      echo  "<hr />";
      echo "<p style='text-align: justify;font-family: sans;font-size: 14px;'>At your request, we hereby confirm the nominee details for the captioned fixed deposit as follows.</p> ";
            
      echo "<table style='font-family: sans;font-size: 14px;'>
            <tr>
            <td>Nominee&apos;s Name </td>
            <td>: ".$result_tbl_data['NOMINEE_NAME']."</td>
            </tr> 
            <tr>
            <td>Ownership percentage</td>
            <td>: ".$result_tbl_data['OWN_PERCENT']."% </td>
            </tr>
            
            <tr>
            <td>NIC No.</td>
            <td>: ".$result_tbl_data['NOMINEE_NIC']." </td>
            </tr>
            
            <tr>
            <td>Date of Birth</td>
            <td>: ".$result_tbl_data['NOMINEE_DOB']." </td>
            </tr>
            
            <tr>
            <td>Address  </td>
            <td>: ";
           if($result_tbl_data['NOMINEE_ADD1'] != ""){
              echo $result_tbl_data['NOMINEE_ADD1']." ";
           }
            if($result_tbl_data['NOMINEE_ADD2'] != ""){
              echo $result_tbl_data['NOMINEE_ADD2']." ";
           }
             if($result_tbl_data['NOMINEE_ADD3'] != ""){
              echo $result_tbl_data['NOMINEE_ADD3']." ";
           }
             if($result_tbl_data['NOMINEE_ADD4'] != ""){
              echo $result_tbl_data['NOMINEE_ADD4']." ";
           }
             if($result_tbl_data['NOMINEE_ADD5'] != ""){
              echo $result_tbl_data['NOMINEE_ADD5']; 
           } 
            
      echo "</td>
            </tr>
            
            </table>
             <br /><br />
            
            <span style='font-family: sans;font-size: 14px;font-weight: bold;'>Yours Faithfully,</span><br />
            <span style='font-family: sans;font-size: 14px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</span> <br /><br />";
             header("Content-Type: image/jpeg");
             echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                    
           echo "<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
            <span style='font-family: sans;font-size: 14px;font-weight: bold;'> Authorized Officer</span>
              
              <p style='font-family: sans;font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for further references on this computer generated letter.</p>
            </div>
            </div>";  
    // ----- End Mail While
    }
}

//--------------------------------------confermation nominee bulk 2019-01-07---------------------------------

function print_ConfirmationOfNomineeDatails_Bulk($Index_Print,$Print_User){
    
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    //echo $Index_Print ." -- ".$Print_User;
    //----- Start Update DB
    mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$Index_Print."' AND `LET_TYPE` = 'COND2';";
            $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
            $ans_s = 0;
            while($res_select_print = mysqli_fetch_array($que_select_print)){
                $ans_s = $res_select_print[0]+1;
            }
            $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                    VALUES ('COND2','".$Index_Print."','".$ans_s."','".$Print_User."',now(),'Confirmation of Nominee Details bulk.','".$Print_User."',now());";
            //echo $sql_insert;                                        
            $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
            $sql_update = "UPDATE `sps_conf_nominee_dtl_bulk` 
                                SET `PRINT_STATUS`= 'P' ,
                                    `PRINT_BY` = '".$Print_User."' ,
                                    `PRINT_ON` = NOW()
                                WHERE `V_INDEX` = '".$Index_Print."' AND
                                      `PRINT_STATUS` = 'A';";
           //echo $sql_update;
           $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
           mysqli_commit($conn);
        }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
        }
    
    
    
    //----- END Update DB
    //---- Start Print Letter------------------------------
    $sql_get_tbl_data = "SELECT * FROM sps_conf_nominee_dtl_bulk AS sc WHERE sc.V_INDEX = ".$Index_Print.";";
       /*--------------------------------
       V_INDEX		    INT(12) Autonumber
       ACC_NO 		    Varchar 22
       CONT_NO 		    int 4
       DEP_AMOUNT     	Decimal (10,3) 
       NOMINEE_NAME   	varchar 100
       OWN_PERCENT 		Decimal (4,4)
       NOMINEE_NIC 		Varchar 15
       NOMINEE_DOB 		Varchar 50
       NOMINEE_ADD1 	Varchar 100
       NOMINEE_ADD2 	Varchar 100
       NOMINEE_ADD3   	Varchar 100
       NOMINEE_ADD4   	Varchar 100
       NOMINEE_ADD5   	Varchar 100
       CLIENT_NAME    	Varchar 100
       CLIENT_ADD1    	Varchar 100
       CLIENT_ADD2    	Varchar 100
       CLIENT_ADD3    	Varchar 100
       CLIENT_ADD4    	Varchar 100
       CLIENT_ADD5    	Varchar 100
       CLIENT_LOCATION 	Varchar 100
       REQUEST_BY		Varchar 10
       REQUEST_ON		DATE AND TIME
       PRINT_STATUS		char 1
       AUTH_1_BY 		Varchar 10
       AUTH_1_DATE		DATE AND TIME
       AUTH_2_BY		Varchar 10
       AUTH_2_DATE		DATE AND TIME
       PRINT_BY		    Varchar 10
       PRINT_ON 		DATE AND TIME
       --------------------------------------------------------*/
    $query_get_tbl_data = mysqli_query($conn,$sql_get_tbl_data) or die(mysqli_error($conn));
    while($result_tbl_data = mysqli_fetch_assoc($query_get_tbl_data)){
    //------Start Main While    
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$result_tbl_data['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
 echo "<div id='printablediv'>
            <div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
            <br /><br /><br /><br />";
      echo " <label style='font-family: sans; font-size: 14px;'>Ref No. :".$result_tbl_data['REF_ID']." </label><br /><br />";
      echo " <label style='font-family: sans;font-size: 14px;'>".date("d-m-Y")."</label> <br />";
	  
		if($result_tbl_data['V_ADDRESS'] != ""){
      echo " <label style='font-family: sans;font-size: 14px;'>".$result_tbl_data['V_ADDRESS']." </label> <br /> ";  
	  }
 
      
            
            
            
            
       echo "<label style='font-family: sans;font-size: 14px;'>Dear Sir/Madam,</label>
      <h3 style='font-family: sans;'><u>Confirmation of Nominee Details </u>  </h3> ";
    echo "   <p style='text-align: justify;font-family: sans;font-size: 14px;'>At your request, We hereby confirm the Nominee Details for the Requested Client code, as follow.</p>";
   
   if($result_tbl_data['V_BODY'] != ""){
    echo $result_tbl_data['V_BODY'];        
      }
     echo "<br /><br />
            
          <span style='font-family: sans;font-size: 14px;font-weight: bold;'>Yours Faithfully,</span><br />
          <span style='font-family: sans;font-size: 14px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</span> <br /><br />";
             header("Content-Type: image/jpeg");
             echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                    
           echo "<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
            <span style='font-family: sans;font-size: 14px;font-weight: bold;'> Authorized Officer</span>
              
              <p style='font-family: sans;font-size: 14px;font-weight: bold;'>You may contact our hotline on 011 7 388 388 for further references on this computer generated letter.</p>
            </div>
            </div>";  
    // ----- End Main While
    }
}

//---------------------------------------------- UCL PO Genaret - 2018-04-18 Madushan---------------------------------


function ucl_print_supAger_letter($get_fac_num_print_supAger,$get_Sys_num_supAger,$get_v_user_print_supAger,$get_v_type_supAger){
    //echo $get_fac_num_print_supAger." - ".$get_Sys_num_supAger." - ".$get_v_user_print_supAger." - ".$get_v_type_supAger;
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_OP = "SELECT `fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`,`EQUIP_CAT`
                        FROM `ucl_sps_po_gen` 
                        WHERE `fac_no` = '".$get_fac_num_print_supAger."' AND
                               `system_no` = '".$get_Sys_num_supAger."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    $que_select_OP = mysqli_query($conn,$sql_select_OP)or die(mysqli_error());
    while($rec_select = mysqli_fetch_assoc($que_select_OP)){
        //echo $rec_select['fac_no']."--".$rec_select['client_name'];
        $date = date("h:i:sa");
        $currentDate = strtotime($date);
        $futureDate = $currentDate+(60*30);
        $formatDate = date("H:i:s", $futureDate);
       $sql_ath1 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
       $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
        echo "<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv='content-type' content='text/html' />
	<meta name='author' content='lolkittens' />

	<title>Untitled 1</title>
</head>

<body>

<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br /><br />
   <label style='font-weight: bold;' >ORIGINAL </label><br />
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<br />
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Ref. No : ".$rec_select['fac_no']."</label><br />
            <label>Serial No :</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Unisons Capital Leasing Ltd('UCL'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee/s) subject to the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'UCL' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'UCL' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'UCL' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'UCL' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'UCL' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'UCL' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'UCL'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, UCL is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of UCL and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of UCL.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, UCL shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of UCL and the Lessee as the Registered User and other relevant documents to 'UCL', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Unisons Capital Leasing Ltd.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Unisons Capital Leasing Ltd</label><br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
/*echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Serial No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>:</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Period for Installation</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Warranty (if any)</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>";*/
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> &nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
</div>
</div>



<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br />
   <label style='font-weight: bold;'>PLEASE RETURN TO THE COMPANY</label>
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Ref. No : ".$rec_select['fac_no']."</label><br />
            <label>Serial No :</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Unisons Capital Leasing Ltd('UCL'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee) SUBJECT To the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'UCL' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'UCL' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'UCL' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'UCL' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'UCL' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'UCL' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'UCL'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, UCL is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of UCL and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of UCL.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, UCL shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of UCL and the Lessee as the Registered User and other relevant documents to 'UCL', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Unisons Capital Leasing Ltd.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Unisons Capital Leasing Ltd</label>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
<hr />
<label>LESSEE/S CERTIFICATION</label><br />
<label>TO BE FILLED IN BY THE LESSEE/S</label><br />
<label>I/We do hereby agree to the terms, conditions and warranties and specifications specified in this Supply Agreement and have received the property mentioned above in satisfactory condition and request UCL to make payments to the supplier.</label>
<br />
<label>Name of Lessee : ".$rec_select['client_full_name']."</label><br />
<label>Date : </label><br/>
<label>Signature : .....................................................</label><br/>
<label>for and on behalf of Lessee/s.</label>
</div>
</div>



<div style='page-break-after: always'>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
   <label>Print Date : ".date("Y-m-d")."</label><br />
   <label>Print Time : ".$formatDate."</label><br />
   <label>User ID : ".$get_v_user_print_supAger."</label><br />
   <label style='font-weight: bold;'>FILE COPY</label>
</div>
<div style='text-align: center;'>
<label style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;' >SUPPLY AGREEMENT</label>
</div>
<table style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
    <tr>
        <td style='width: 40%;font-weight: bold;'>
            <label>".$rec_select['supplier_name']."</label><br />
            <label>".$rec_select['supplier_address_01'].",</label><br />";
           if($rec_select['supplier_address_02'] == ""){
                echo "<label>".$rec_select['supplier_address_02']." ,</label><br />";
            }
            echo "<label>".$rec_select['supplier_address_03'].".</label><br />
        </td>
        <td style='width: 60%;'>
            <label>Our Ref : ".$rec_select['fac_no']."</label><br />
            <label>Serial No :</label><br />
            <label>Date : ".$rec_select['cbd']."</label><br />
            <label>&nbsp;</label><br />
        </td>
    </tr>
</table>
<div style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
<label>Dear Sir/Madam,</label><br />
<p style='text-align: justify;'>
We,Unisons Capital Leasing Ltd('UCL'),do hereby place our official Supply Agreement to you for the Property described hereunder in connection with our leasing arrangement with 
".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."
(Hereinafter known as the Lessee) SUBJECT To the following terms and Conditions:
</p>
<table>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1. Description Of Property</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: 01.".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Engine No : ".$rec_select['engine_number']."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Chassis No : ".$rec_select['chassis_number']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2. Purchase Price</td>
        <td style='width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".number_format($rec_select['asset_price'],2)."</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>3. Property Delivered to</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['client_name']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 30%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;padding-left: 10px;'>3.1 Place to be Deliver</td>
        <td style='width: 70%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>: ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</td>
    </tr>
    <tr style='width: 100%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
        <td style='font-weight: bold;width: 60%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;' colspan='2'>4. Other Terms and Conditions</td>
        <td style='width: 40%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.1</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Title to said Property shall be vested in 'UCL' free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by 'UCL' of the Property</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.2</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>'UCL' shall receive, in writing from the Lessee/s (a) the Lessee's acceptance of the Property and approval of your invoice for the same, and (b) the Lessee's instruction to 'UCL' to pay your invoice for the Property; and</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.3</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver to 'UCL' and Lessee your written warranties, in substance and inform as required and by acceptance hereof you agree that all warranties, written or oral, express or implied, are for the benefit of and may be enforced by both 'UCL' and Lessee or either of them.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.4</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>a) The said Leasing arrangement shall be properly conducted between Lessee and 'UCL'.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>b) The Lessee/s, namely, ".$rec_select['client_full_name']." is/are the 'Lessee' in terms of the Leasing Agreement already entered in to between parties, UCL is the 'Lessor' in terms of the Leasing Agreement already entered in to between parties.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.5</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The property described in 1, being a vehicle, registration of the vehicle should be undertaken by you, unless otherwise stated in writing. Absolute Ownership over such vehicle should be registered in favor of UCL and the Lessee should be the registered user.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.6</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>You shall deliver the Property to the Lessee with a comprehensive insurance policy assigned in favor of UCL.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.7</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>If the importer and the supplier are not the same people/entity, UCL shall release the payment subject to receiving   signed documents of indemnity, consent letter, copy of the permit or export Document and ID copy of the importer.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>4.8</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>Validity period of this Supply Agreement shall be 14 days.</td>
    </tr>
</table>
<label>
Please return the following documentation in order for us to proceed further in the matter and complete the transaction,
</label><br />
<table>
    <tr>
        <td style='width: 25px; text-align: right; vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>1.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The second copy of this Supply Agreement duly completed and signed together with the duly filled Lessees Certification.</td>
    </tr>
    <tr>
        <td style='width: 25px; text-align: right;vertical-align: top;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>2.)</td>
        <td style='padding-left: 9px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>The original certificate of registration issued by RMV with the Absolute Owner registered in favour of UCL and the Lessee as the Registered User and other relevant documents to 'UCL', respectively.</td>
    </tr>
</table/>
<label>
Please note that this Supply Agreement is only valid if it is signed by two authorized signatories of Unisons Capital Leasing Ltd.
</label>
<br /><br />
<label>Yours faithfully,</label><br />
<label>Unisons Capital Leasing Ltd</label>
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div>";
        echo "<label>.......................................................</label><br />
            <label>".$sig_name_01."</label><br />
            <label>".$des_01."</label><br />  
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>";
        header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
          echo "<label>.......................................................</label><br />
            <label>".$sig_name_02."</label><br />   
            <label>".$des_02."</label><br />
        </td>
    </tr>
</table>
<hr />
<label>
I / We the above named supplier, hereby confirm my/our acceptance of the terms and conditions of the above Supply Agreement and further confirm the following.
</label>";
echo "<table>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Expected date of Delivery</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Serial No</label>-->
            <label>Engine No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Period for Installation</label>-->
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."</td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Engine No</label>-->
            <label>Chassis No</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>: ".$rec_select['chassis_number']."</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Warranty (if any)</label>-->
            <label>Duplicate Key</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <!--<label>Chassis No</label>-->
            &nbsp;
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>&nbsp;</td>
    </tr>
    <!--<tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Year of Manufacture</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> : ".$rec_select['yom']."
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Duplicate Key</label>
        </td>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
    </tr>
    <tr>
        <td style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Model No</label>
        </td>
        <td style='width: 200px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'> :</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>-->
</table>";
echo "<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            &nbsp;
        </td>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px;'>
            <label>Signature............................</label><br />
            <label>Date.................................</label><br />
            <label>Signed by............................</label><br />
            <label>For and on behalf of Supplier.................</label>
        </td>
    </tr>
</table>
<hr />
<label>LESSEE/S CERTIFICATION</label><br />
<label>TO BE FILLED IN BY THE LESSEE/S</label><br />
<label>I/We do hereby agree to the terms, conditions and warranties and specifications specified in this Supply Agreement and have received the property mentioned above in satisfactory condition and request UCL to make payments to the supplier.</label>
<br />
<label>Name of Lessee : ".$rec_select['client_full_name']."</label><br />
<label>Date : </label><br/>
<label>Signature : .....................................................</label><br/>
<label>for and on behalf of Lessee/s.</label>
</div>
</div>";
if(($rec_select['EQUIP_CAT'] == "01" && $rec_select['product_code'] == "501") || $rec_select['EQUIP_CAT'] == "02" || $rec_select['EQUIP_CAT'] == "03" || $rec_select['EQUIP_CAT'] == "05" || $rec_select['EQUIP_CAT'] == "06" || $rec_select['EQUIP_CAT'] == "08" || $rec_select['EQUIP_CAT'] == "10" || $rec_select['EQUIP_CAT'] == "11" || $rec_select['EQUIP_CAT'] == "12"){

echo "<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print_supAger."</td>
        </tr> 
    </table><br /><br />
    
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Unisons Capital Leasing Ltd of No. 99, Dharmapala Mawatha , Colombo 07. which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Unisons Capital Leasing Ltd.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Unisons Capital Leasing Ltd</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>
<div style='page-break-after: always; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<br/>
<br />
<br />
<br/>
<br />
<br />
<br/>
<br />
<div>
    <table>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>Print Date</td>
            <td>: ".date("Y-m-d")."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'> 
            <td>Print Time</td>
            <td>: ".$formatDate."</td>
        </tr>
        <tr style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <td>User ID</td>
            <td>: ".$get_v_user_print_supAger."</td>
        </tr> 
    </table><br /><br />
   <label style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;' >".$rec_select['cbd']." </label><br />
</div><br /><br/>
<div style='text-align: right;font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>File copy</label>
</div>
<div style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
<label>The Commissioner</label><br />
<label>RMV</label><br />
<label>Colombo</label><br />
</div>
<br />
<br />
<div>
<label>Dear Sir/Madam,</label><br /><br /><br />
<table style='font-weight: bold;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
    <tr>
        <td>Make &amp; Model</td>
        <td>: ".$rec_select['make_desc']." - ".$rec_select['model_desc']."</td>
    </tr>
    <tr>
        <td>Engine No.</td>
        <td>: ".$rec_select['engine_number']."</td>
    </tr>
    <tr>
        <td>Chassis No.</td>
        <td>: ".$rec_select['chassis_number']."</td>
    </tr>
</table>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Please be good enough to register the above vehicle in favor of ".$rec_select['client_full_name']." of  ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']." &amp; Absolute Ownership with Unisons Capital Leasing Ltd of No. 99, Dharmapala mawatha, Colombo 07 which was leased by.
</p>
<p style='text-align: justify;text-height: 18px;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
Further we have no objection to handover the original Certificate of registration of the above vehicle to ".$rec_select['supplier_name']." with the absolute ownership in favor of Unisons Capital Leasing Ltd.
</p>
<br />
<table style='width: 100%;'>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <label>Thank You</label><br />
            <label>Yours faithfully,</label><br />
            <label>Unisons Capital Leasing Ltd</label><br />
        </td>
    </tr>
    <tr>
        <td style='width: 50%;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;'>
            <br />
            <br />
            <br />
            <br />";
            header("Content-Type: image/jpeg");
        echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
           echo "<label>.......................................................</label></label><br />
            <label>Authorized Signatory</label><br />
        </td>
    </tr>
</table>
</div>
</div>";
}
echo "</body>
</html>";
    }
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_select_print = "SELECT COUNT(*) FROM `ucl_sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_fac_num_print_supAger."' AND `LET_TYPE` = '".$get_v_type_supAger."';";
        $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
        $ans_s = 0;
        while($res_select_print = mysqli_fetch_array($que_select_print)){
            $ans_s = $res_select_print[0]+1;
        }
        $sql_insert = "INSERT INTO `ucl_sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                VALUES ('".$get_v_type_supAger."','".$get_fac_num_print_supAger."','".$ans_s."','".$get_v_user_print_supAger."',now(),'Supply Agreement Print.','".$get_v_user_print_supAger."',now());";
        //echo $sql_insert;                                        
        $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
        $sql_update = "UPDATE `ucl_sps_po_gen` 
                            SET `print_stats`= 2
                            WHERE `fac_no` = '".$get_fac_num_print_supAger."' AND
                                    `system_no` = '".$get_Sys_num_supAger."' AND
                                    `AUTH_1_BY` != '' AND
                                    `AUTH_2_BY` != '' AND
                                    `print_stats` = 1;";
        $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
        mysqli_commit($conn);
    }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
            
    }
    
}

//----------------------------------- 
function  print_Mortgage_MURA_letter($get_fac_num_print_Mortgage,$get_Sys_num_Mortgage,$get_v_user_print_Mortgage,$get_v_type_Mortgage){
    //echo $get_fac_num_print_Mortgage." - ".$get_Sys_num_Mortgage." - ".$get_v_user_print_Mortgage." - ".$get_v_type_Mortgage;
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_Mortgage = "SELECT `fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`,`EQUIP_CAT`,`INS_COM_NAME`,`INT_RATE`,`RCVBLE`
                        FROM `sps_po_gen` 
                        WHERE `fac_no` = '".$get_fac_num_print_Mortgage."' AND
                               `system_no` = '".$get_Sys_num_Mortgage."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 1;";
    $que_select_Mortgage = mysqli_query($conn,$sql_select_Mortgage)or die(mysqli_error());
     // 1 ---------------------------------- Start Main While --------------------------------------------       
    while($rec_select = mysqli_fetch_assoc($que_select_Mortgage)){
                //echo $rec_select['fac_no']."--".$rec_select['client_name'];
         $startTime = date("Y-m-d H:i:s");
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($startTime)));
        
        $sql_ath1 = "SELECT s.`SIG_IMG`,s.`designation`,s.`sig_name` , b.`branchName`
                    FROM `sps_sig_mast` AS s , `branch` AS b , `user` AS u
                    WHERE s.`USER_ID` = u.userName AND u.branchNumber = b.branchNumber AND  `USER_ID` = '".$rec_select['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
        $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
        while($row_ath1 = mysqli_fetch_array($result_ath1)){
                    //header("Content-Type: image/jpeg");
                    $img_01 = $row_ath1[0];
                    $des_01 = $row_ath1[1];
                    $sig_name_01 = $row_ath1[2];
                    $branch_01 = $row_ath1[3];
                    //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
                    //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
        $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$rec_select['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
        $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
        while($row_ath2 = mysqli_fetch_array($result_ath2)){
                    //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
                    //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
                    //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
            
               mysqli_autocommit($conn,FALSE);
                try{
                    date_default_timezone_set('Asia/Colombo');
                    $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_fac_num_print_Mortgage."' AND `LET_TYPE` = '".$get_v_type_Mortgage."';";
                    $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
                    $ans_s = 0;
                    while($res_select_print = mysqli_fetch_array($que_select_print)){
                        $ans_s = $res_select_print[0]+1;
                    }
                    $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                            VALUES ('".$get_v_type_Mortgage."','".$get_fac_num_print_Mortgage."','".$ans_s."','".$get_v_user_print_Mortgage."',now(),'Mortgage Letter Print.','".$get_v_user_print_Mortgage."',now());";
                    //echo $sql_insert;                                        
                    $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
                    $sql_update = "UPDATE `sps_po_gen` 
                                        SET `print_stats`= 2
                                        WHERE `fac_no` = '".$get_fac_num_print_Mortgage."' AND
                                                `system_no` = '".$get_Sys_num_Mortgage."' AND
                                                `AUTH_1_BY` != '' AND
                                                `AUTH_2_BY` != '' AND
                                                `print_stats` = 1;";
                    $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
                    mysqli_commit($conn);
                }catch(Exception $e){
                        // Rollback transaction
                        mysqli_rollback($conn);
                        echo 'Message: ' .$e->getMessage();
                        
                }
                
echo "<div style='page-break-after: always' id='cover'>
        <h4 style='font-family: sans;top:-50px;'>Original copy</h4>
        <h4 style='text-align: center;font-family: sans;'>Confirmed Purchase Order</h4>
        <div style='font-family: sans; font-size: 12px;'>
            <label style='font-family: sans; font-size: 12px;'>Date : ".date("Y-m-d")."</label><br />
        </div>
        <table style='width: 100%;font-family: sans; font-size: 12px;'>
            <tr>
                <td>
                    <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_name']."</label><br />
                    <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_01']."</label><br />";
                     if(trim($rec_select['supplier_address_02']) != "") {
                        echo "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_02']."</label><br />";
                     }
                   if(trim($rec_select['supplier_address_03']) != "") {
                     echo  "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_03']."</label><br />";
                   }
                 
                  
              echo " </td>
            </tr>
        </table>
        <div style='text-align: right;'>
            <label style='font-family: sans; font-size: 12px;'>Ref No:".$rec_select['fac_no']."</label>
        </div>
        <div style='font-family: sans; font-size: 12px;'>
            <label style='font-family: sans; font-size: 12px;'>Dear Sir/Madam,</label><br />
            <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            We, Citizens Development Business Finance PLC, hereby place our official purchase order to you for the goods described hereunder in 
            connection with the Murabahah to the Purchase Orderer Agreement by and between Citizens Development Business Finance PLC and 
            ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
            (here in after sometimes called and referred to as the \"Client\") subject to the following terms and conditions:
            </p>
            <ol>
                <li>
                    <label style='font-family: sans; font-size: 12px;'>Description of Goods      :</label><br />
                    <table style='font-weight: bold;font-family: sans; font-size: 12px;'  border='1' cellpadding='0' cellspacing='0' id='myTable'> 
                        <tr>
                            <td style='width: 100px;font-family: sans; font-size: 12px;'>MAKE </td>
                            <td style='font-family: sans; font-size: 12px;'>: ".$rec_select['make_desc']."</td>
                        </tr>
                        <tr >
                            <td style='width: 100px;font-family: sans; font-size: 12px;'>Model </td>
                            <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['model_desc']."</td>
                        </tr>
                        <tr>
                            <td style='width: 100px;font-family: sans; font-size: 12px;'>REG NO </td>
                            <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['vehicle_number']." </td>
                        </tr>
                        <tr>
                            <td style='width: 100px;font-family: sans; font-size: 12px;'>Engine </td>
                            <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['engine_number']."</td>
                        </tr>
                        <tr>
                            <td style='width: 100px;font-family: sans; font-size: 12px;'>Chassis </td>
                            <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['chassis_number']."</td>
                        </tr>
                    </table>
                </li>
                <li>
                    <label style='font-family: sans; font-size: 12px;'>Purchase Price : ".number_format($rec_select['asset_price'],2)."</label><br /><br />
                </li>
                <li>
                    <label style='font-family: sans; font-size: 12px;'>Place to be delivered : ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</label>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        Title to the said goods shall be vested in Citizens Development Business Finance PLC free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by Citizens Development Business Finance PLC of the goods.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        Citizens Development Business Finance PLC shall make payment of the purchase price to you only on your delivery of the said goods to Citizens Development Business Finance PLC or to the agent appointed by Citizens Development Business Finance PLC. The second copy of the Confirmed Purchase Order should be signed by the agent of Citizens Development Business Finance PLC or the Client confirming the receipt of the goods in good order.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        You should deliver to Citizens Development Business Finance PLC and the Client your written warranties in substance and in form as required by this Confirmed Purchase Order. On acceptance of this order, you hereby agree that all warranties written or oral, express or implied are for the benefit of Citizens Development Business Finance PLC and the Client and may be enforced by both Citizens Development Business Finance PLC and the Client or either of them.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        If the said goods are a vehicle, registration of the vehicle shall be undertaken by you. The vehicle is proposed to be sold to the Client and you are, therefore, hereby requested to register the vehicle in the name of the Client with the Absolute Ownership to Citizens Development Business Finance PLC upon a notification made by Citizens Development Business Finance PLC in due course requiring you to do so.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        This Confirmed Purchase Order is valid for a period of 14 days from the date of issue.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        If the said goods are a vehicle, payment would be made on receipt of the Vehicle Registration Book, Vehicle Identity Card if applicable and duplicate key and upon vehicle inspection carried out by the representative of Citizens Development Business Finance PLC.
                    </p>
                </li>
                <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        You shall deliver the vehicle to the agent appointed by Citizens Development Business Finance PLC or the client with a comprehensive insurance policy assigned in favour of CDB.
                    </p>
                </li>
                 <li>
                    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                        If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.
                    </p>
                </li>
            </ol>
    
            <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            If you accept our above Confirmed Purchase Order, please return the second copy signed by you as the supplier and the Client in order to confirm the acceptance of the above Confirmed Purchase Order.
            </p>
            <br />
            <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            Kindly forward a fresh sales invoice to Citizens Development Business Finance PLC. 
            </p>
            <br />
            <table style='width: 125%;font-family: sans; font-size: 12px;'>
                <tr>
                    <td>
                        <label style='font-family: sans; font-size: 12px;'>Yours faithfully,</label><br />
                        <label style='font-family: sans; font-size: 12px;'>Citizens Development Business Finance PLC</label><br />";
                         header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                        <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label><br />
                    </td>
                    <td>
                    <label></label>
                        <label></label><br />
                        <label></label><br />";
                        header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
                        
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                        <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label><br />
                    </td>
                </tr>
            </table>
    
    </div>
</div>

<!-------------------------------------------------------------------------------------------------------------------->
<div style='page-break-after: always' id='cover'>
    <h3 style='font-family: sans;top:-50px;'>Second copy</h3>
    <h4 style='text-align: center;font-family: sans;'>Confirmed Purchase Order</h4>
    <div style='font-family: sans; font-size: 12px;'>
       <label style='font-family: sans; font-size: 12px;'>Date : ".date("Y-m-d")."</label><br />
    </div>
    <table style='width: 100%;font-family: sans; font-size: 12px; '>
        <tr>
            <td>
                <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_name']."</label><br />
                <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_01']."</label><br />";
                if(trim($rec_select['supplier_address_02']) != "") {
                        echo "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_02']."</label><br />";
                     }
                if(trim($rec_select['supplier_address_03']) != "") {
                     echo  "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_03']."</label><br />";
                   }
           echo " </td>
        </tr>
    </table>
    <div style='text-align: right;font-family: sans; font-size: 12px;'>
        <label style='font-family: sans; font-size: 12px;'>Ref No:".$rec_select['fac_no']."</label>
    </div>
    <div style='font-family: sans; font-size: 12px;'>
        <label style='font-family: sans; font-size: 12px;'>Dear Sir/Madam,</label><br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        We, Citizens Development Business Finance PLC, hereby place our official purchase order to you for the goods described hereunder in 
        connection with the Murabahah to the Purchase Orderer Agreement by and between Citizens Development Business Finance PLC and 
        ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
        (hereinafter sometimes called and referred to as the \"Client\") subject to the following terms and conditions:
        </p>
        <ol>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Description of Goods      :</label><br />
                <table style='font-weight: bold; bold;font-family: sans; font-size: 12px;'  border='1' cellpadding='0' cellspacing='0' id='myTable'> 
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>MAKE </td>
                        <td style='font-family: sans; font-size: 12px;'>: ".$rec_select['make_desc']."</td>
                    </tr>
                    <tr >
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Model </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['model_desc']."</td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>REG NO </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['vehicle_number']."</td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Engine </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['engine_number']."</td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Chassis </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['chassis_number']."</td>
                    </tr>
                </table>
            </li>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Purchase Price : ".number_format($rec_select['asset_price'],2)."</label><br /><br />
            </li>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Place to be delivered : ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</label>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    Title to the said goods shall be vested in Citizens Development Business Finance PLC free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by Citizens Development Business Finance PLC of the goods.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    Citizens Development Business Finance PLC shall make payment of the purchase price to you only on your delivery of the said goods to Citizens Development Business Finance PLC or to the agent appointed by Citizens Development Business Finance PLC. The second copy of the Confirmed Purchase Order should be signed by the agent of Citizens Development Business Finance PLC or the Client confirming the receipt of the goods in good order.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    You should deliver to Citizens Development Business Finance PLC and the Client your written warranties in substance and in form as required by this Confirmed Purchase Order. On acceptance of this order, you hereby agree that all warranties written or oral, express or implied are for the benefit of Citizens Development Business Finance PLC and the Client and may be enforced by both Citizens Development Business Finance PLC and the Client or either of them.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    If the said goods are a vehicle, registration of the vehicle shall be undertaken by you. The vehicle is proposed to be sold to the Client and you are, therefore, hereby requested to register the vehicle in the name of the Client with the Absolute Ownership to Citizens Development Business Finance PLC upon a notification made by Citizens Development Business Finance PLC in due course requiring you to do so.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    This Confirmed Purchase Order is valid for a period of 14 days from the date of issue.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    If the said goods are a vehicle, payment would be made on receipt of the Vehicle Registration Book, Vehicle Identity Card if applicable and duplicate key and upon vehicle inspection carried out by the representative of Citizens Development Business Finance PLC.
                </p>
            </li>
            <li>
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                    You shall deliver the vehicle to the agent appointed by Citizens Development Business Finance PLC or the client with a comprehensive insurance policy assigned in favour of CDB.
                </p>
            </li>
            <li>
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                    If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.
                </p>
            </li>
        </ol>

        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        If you accept our above Confirmed Purchase Order, please return the second copy signed by you as the supplier and the Client in order to confirm the acceptance of the above Confirmed Purchase Order.
        </p>
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        Kindly forward a fresh sales invoice to Citizens Development Business Finance PLC. 
        </p>
        <table style='width: 125%; font-family: sans; font-size: 12px;'>
            <tr>
                <td>
                    <label style='font-family: sans; font-size: 12px;'>Yours faithfully,</label><br />
                        <label style='font-family: sans; font-size: 12px;'>Citizens Development Business Finance PLC</label><br />";
                         header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                        <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label>
                </td>
                <td>
                <label></label>
                    <label></label><br />
                    <label></label><br />";
                    header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
                        
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                    <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                   <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label>
                </td>
            </tr>
        </table>
        <hr/>
        <label style='font-weight: bold;font-family: sans; font-size: 12px;'>To : Citizen Development Business Finance PLC</label>
        <br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
            I / We, below named and undersigned, hereby confirm my / our acceptance of your above Confirmed Purchase Order and further confirm that the said goods would be delivered on or before .................. with / without warranty. 
        </p>
        <br />

        <label style='font-family: sans; font-size: 12px;'>Signature : ..............................</label> <br /> <br />
        <label style='font-family: sans; font-size: 12px;'>Name of Supplier : ".$rec_select['supplier_name']."</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time:  </label>
        <hr />
        <label style='font-weight: bold;font-family: sans; font-size: 12px;'>To : Citizen Development Business Finance PLC</label>
        <br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
            I / We, below named and undersigned, hereby confirm the reciept of the said goods as per the terms, Conditions, Warrenties and specificatons stated in the above Confirmed Purchase Order and to my/our satisfaction. 
        </p>
        <br />
        <label style='font-family: sans; font-size: 12px;'>Signature : ............................</label> <br /> <br />
        <label style='font-family: sans; font-size: 12px;'>Name of Client : ".$rec_select['client_name']."</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time: </label>
</div>
</div>

<div style='page-break-after: always' id='cover'>
    <h3 style='font-family: sans;top:-50px;'>File copy</h3>
    <h4 style='text-align: center;font-family: sans;'>Confirmed Purchase Order</h4>
    <div style='font-family: sans; font-size: 12px;'>
       <label style='font-family: sans; font-size: 12px;'>Date : ".date("Y-m-d")."</label><br />
    </div>
    <table style='width: 100%;font-family: sans; font-size: 12px; '>
        <tr>
            <td>
                <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_name']."</label><br />
                <label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_01']."</label><br />";
                if(trim($rec_select['supplier_address_02']) != "") {
                echo "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_02']."</label><br />";
                }
                   if(trim($rec_select['supplier_address_03']) != "") {
                     echo  "<label style='font-family: sans; font-size: 12px;'>".$rec_select['supplier_address_03']."</label><br />";
                   }
                 
                  
              echo "
            </td>
        </tr>
    </table>
    <div style='text-align: right;font-family: sans; font-size: 12px;'>
        <label style='font-family: sans; font-size: 12px;'>Ref No:".$rec_select['fac_no']."</label>
    </div>
    <div style='font-family: sans; font-size: 12px;'>
        <label style='font-family: sans; font-size: 12px;'>Dear Sir/Madam,</label><br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        We, Citizens Development Business Finance PLC, hereby place our official purchase order to you for the goods described hereunder in 
        connection with the Murabahah to the Purchase Orderer Agreement by and between Citizens Development Business Finance PLC and 
        ".$rec_select['client_full_name']." of ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". 
        (hereinafter sometimes called and referred to as the \"Client\") subject to the following terms and conditions:
        </p>
        <ol>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Description of Goods      :</label><br />
                <table style='font-weight: bold; bold;font-family: sans; font-size: 12px;'  border='1' cellpadding='0' cellspacing='0' id='myTable'> 
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>MAKE </td>
                        <td style='font-family: sans; font-size: 12px;'>: ".$rec_select['make_desc']."</td>
                    </tr>
                    <tr >
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Model </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['model_desc']."</td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>REG NO </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['vehicle_number']."</td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Engine </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>:".$rec_select['engine_number']." </td>
                    </tr>
                    <tr>
                        <td style='width: 100px;font-family: sans; font-size: 12px;'>Chassis </td>
                        <td style='width: 300px;font-family: sans; font-size: 12px;'>: ".$rec_select['chassis_number']."</td>
                    </tr>
                </table>
            </li>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Purchase Price : ".number_format($rec_select['asset_price'],2)."</label><br /><br />
            </li>
            <li>
                <label style='font-family: sans; font-size: 12px;'>Place to be delivered : ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03']."</label>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    Title to the said goods shall be vested in Citizens Development Business Finance PLC free from any liens and encumbrances of anyone claiming by, through or under you with effect from the date of purchase by Citizens Development Business Finance PLC of the goods.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    Citizens Development Business Finance PLC shall make payment of the purchase price to you only on your delivery of the said goods to Citizens Development Business Finance PLC or to the agent appointed by Citizens Development Business Finance PLC. The second copy of the Confirmed Purchase Order should be signed by the agent of Citizens Development Business Finance PLC or the Client confirming the receipt of the goods in good order.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    You should deliver to Citizens Development Business Finance PLC and the Client your written warranties in substance and in form as required by this Confirmed Purchase Order. On acceptance of this order, you hereby agree that all warranties written or oral, express or implied are for the benefit of Citizens Development Business Finance PLC and the Client and may be enforced by both Citizens Development Business Finance PLC and the Client or either of them.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    If the said goods are a vehicle, registration of the vehicle shall be undertaken by you. The vehicle is proposed to be sold to the Client and you are, therefore, hereby requested to register the vehicle in the name of the Client with the Absolute Ownership to Citizens Development Business Finance PLC upon a notification made by Citizens Development Business Finance PLC in due course requiring you to do so.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    This Confirmed Purchase Order is valid for a period of 14 days from the date of issue.
                </p>
            </li>
            <li>
                <p style='font-family: sans; font-size: 12px;text-align: justify;'>
                    If the said goods are a vehicle, payment would be made on receipt of the Vehicle Registration Book, Vehicle Identity Card if applicable and duplicate key and upon vehicle inspection carried out by the representative of Citizens Development Business Finance PLC.
                </p>
            </li>
            <li>
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                    You shall deliver the vehicle to the agent appointed by Citizens Development Business Finance PLC or the client with a comprehensive insurance policy assigned in favour of CDB.
                </p>
            </li>
            <li>
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                    If the importer and the supplier are not the same people/entity, CDB shall release the payment subject to receiving signed documents of indemnity, consent letter, copy of the permit and ID copy of the importer.
                </p>
            </li>
        </ol>

        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        If you accept our above Confirmed Purchase Order, please return the second copy signed by you as the supplier and the Client in order to confirm the acceptance of the above Confirmed Purchase Order.
        </p>
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
        Kindly forward a fresh sales invoice to Citizens Development Business Finance PLC. 
        </p>
        <table style='width: 125%; font-family: sans; font-size: 12px;'>
            <tr>
                <td>
                    <label style='font-family: sans; font-size: 12px;'>Yours faithfully,</label><br />
                  <label style='font-family: sans; font-size: 12px;'>Citizens Development Business Finance PLC</label><br />";
                         header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/></div><br/>";
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                    <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                    <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label>
                </td>
                <td>
                <label></label>
                    <label></label><br />
                    <label></label><br />";
                        header("Content-Type: image/jpeg");
                         echo "<div class='container'><img style='height: 70px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div><br/>";
                        
                        echo "<label style='font-family: sans; font-size: 12px;'>.......................................................</label></label><br />
                    <label style='font-family: sans; font-size: 12px;'>Authorized Signatory</label><br />
                   <label style='font-family: sans; font-size: 12px;'>Date &amp; Time  : &nbsp; ".$cenvertedTime." </label>
                </td>
            </tr>
        </table>
        <hr/>
        <label style='font-weight: bold;font-family: sans; font-size: 12px;'>To : Citizen Development Business Finance PLC</label>
        <br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
            I / We, below named and undersigned, hereby confirm my / our acceptance of your above Confirmed Purchase Order and further confirm that the said goods would be delivered on or before .................................. with / without warranty. 
        </p>
        <br />

        <label style='font-family: sans; font-size: 12px;'>Signature : ..............................</label> <br /> <br />
        <label style='font-family: sans; font-size: 12px;'>Name of Supplier : ".$rec_select['supplier_name']."</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time :</label>
        <hr />
        <label style='font-weight: bold;font-family: sans; font-size: 12px;'>To : Citizen Development Business Finance PLC</label>
        <br />
        <p style='font-family: sans; font-size: 12px;text-align: justify;'>
            I / We, below named and undersigned, hereby confirm the reciept of the said goods as per the terms, Conditions, Warrenties and specificatons stated in the above Confirmed Purchase Order and to my/our satisfaction. 
        </p>
        <br />
        <label style='font-family: sans; font-size: 12px;'>Signature : ............................</label> <br /> <br />
        <label style='font-family: sans; font-size: 12px;'>Name of Client : ".$rec_select['client_name']."</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label style='font-family: sans; font-size: 12px;'>Date &amp; Time :  </label>
</div>
</div>";
//".$cenvertedTime."
/*echo "
<!-----------------------------Start Of Mortgadge Bond-------------------------------->

<div style='page-break-after: always;'>
    <br />
        <h3 style='text-align: center; font-weight: bold;font-family: sans;'>MURABAHAH TO THE PURCHASE ORDERER 
            <br />Mortgage Bond
        </h3>
        <p style='text-align: center; font-weight: bold;font-family: sans; font-size: 14px;'>Contract No (Facility No).</p> 
    
        <p style='text-align: justify; font-family: sans; font-size: 12px;'>
            To all to whom these presents shall come that ".$rec_select['client_full_name']." (Holder of National Identity Card / DL / Passport  / 
            a company duly incorporated under the law of Sri Lanka bearing business registration No.: ".$rec_select['client_nic'].") of 
            ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].".(hereinafter sometimes called and referred to as the \"Obligor / Mortgagor\" which term or 
            expression as herein used shall, as and when the context so requires or admits, mean and include the said 
            ".$rec_select['client_full_name']." and his / her heirs, executors, administrators and assigns / its successors and assigns) has requested 
            Citizens Development Business Finance PLC, a company duly incorporated in Sri Lanka (bearing business 
            registration No.: PB 232 PQ) under the Companies Act No.: 07 of 2007 and registered by the Monetary Board of the 
            Central Bank of Sri Lanka under the Finance Business Act No.: 42 of 2011 and having its registered office at No.: 
            123, Orabipasha Mawatha, Colombo-10, Sri Lanka (hereinafter sometimes called and referred to as the �CDB Meezan� 
            which term or expression as herein used shall, as and when the context so requires or admits, mean and include the 
            said Citizens Development Business Finance PLC, as aforesaid and its successors and assigns) under and for the purpose 
            of the Mortgage Act to obtain from the CDB Meezan a Murabahah to the Purchase Orderer facility whereby the Obligor / 
            Mortgagor pays the CDB Meezan for the purchase of (".$rec_select['make_desc']." ".$rec_select['model_desc'].") more fully described in the Schedule hereto the Murabahah 
            To The Purchase Orderer facility receivable of Rupees ".$rec_select['RCVBLE']." � In words "; 
               $num = 1500000.050;
                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                echo ($f->format($num));
                echo  (" rupees "); 
                echo ".      
            in ".$rec_select['period']." 
            monthly installments as per the Schedule hereto without delay or default on or before the date mentioned therein.
        </p> 
    
        <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            NOW KNOW YE AND THESE PRESENTS WITNESS that the Obligor / Mortgagor both hereby covenant and agree 
            with and bind and oblige the Obligor / Mortgagor himself / herself, his / her heirs executors administrators and assigns 
            to the CDB Meezan
        </p>
        <br />
    
        <ol type ='a'>
            <li>
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>	
                    That the Obligor / Mortgagor shall and will on demand well and truly pay or cause to be paid at Colombo aforesaid to the CDB Meezan the Investment by CDB Meezan of Rupees ".$rec_select['lease_amount']." � In words (�����.) together with the Murabahah Profit of Rupees �(Total Interest + Capitalized Amount) � In words (.....................) amounting to and totaling Rupees ".$rec_select['RCVBLE']." � In words.
                </p> 
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>	
                    That in case the Obligor / Mortgagor fails to pay the Murabahah to the Purchase Orderer installment on its due date for no good or valid reason, he / she shall pay a donation directly to the Charity Fund constituted and maintained by the CDB Meezan � a sum calculated @ 0.13% per day of the entire period of default, calculated on the total amount of the obligation remaining unpaid. The Charity Fund shall be used at the absolute discretion of the CDB Meezan under the guidance of its Shari�ah Supervisory Board exclusively for charitable causes permitted in Shari�ah.
                </p> 
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>	
                    That the Obligor / Mortgagor shall pay all statutory dues payable imposed by the state
                </p> 
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>	
                    That as security for such payment as aforesaid, the Obligor / Mortgagor doth hereby specially as a primary mortgage, mortgage and hypothecate to and with the CDB Meezan as a mortgage free from any encumbrance whatsoever � (".$rec_select['make_desc']." ".$rec_select['model_desc'].") more fully described in the Schedule hereto. 
                </p> 
            </li> 
        </ol> 
    <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            And the Obligor / Mortgagor do hereby covenant and agree with the CDB Meezan as follows: 
        </p>  
        
        <ol type ='a'>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That the Obligor / Mortgagor has good and legal right and full power and authority to mortgage, hypothecate and assign the mortgaged... (".$rec_select['make_desc']." ".$rec_select['model_desc'].")... Hereto more fully described in the Schedule hereto in a manner aforesaid not subject to any lien, seizure, charge, encumbrance or claim whatsoever kind or nature.
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That the Obligor / Mortgagor shall and will regularly and punctually pay all license fees, taxes, charges, premia, duties, levies, impositions, outgoings and expenses whatsoever whether under any written law for the time being in force or otherwise in respect of the mortgaged ..(".$rec_select['make_desc']." ".$rec_select['model_desc'].").. and procure official receipts therefore and shall and will deliver unto the CDB Meezan the said official acts or any other documents relative to or as proof of any such payments aforesaid
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That the Obligor / Mortgagor shall and will at all times during the continuance of the mortgage and hypothecation effected by these presents insure and keep insured..(".$rec_select['make_desc']." ".$rec_select['model_desc'].").. hereby mortgaged under a full insurance cover in the name of the Obligor / Mortgagor as the owner and the CDB Meezan as the mortgagee against accident, loss, fire, civil commotion, riot or other risks and contingencies to the full insurable value thereof with any recognized Shari�ah compliant insurer and shall and will regularly and punctually pay all and every the premia and premium or sums of money for the time being necessary for maintaining the policy or policies and the receipts for premia payable as aforesaid and also ensure that such insurance policies are assigned to the CDB Meezan.
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That for the better and more effectually enabling the CDB Meezan to exercise and enforce the right of recovery of all moneys which shall become payable under the insurance hereinbefore mentioned, the Obligor / Mortgagor do hereby irrevocably appoint the CDB Meezan and its accountant for the time being at Colombo aforesaid jointly and each of them severally to be the lawful attorneys and attorney of the Obligor / Mortgagor for and in the names of the Obligor / Mortgagor or of the said attorneys or attorney to demand, sue for, recover, receive and give effectual receipt and discharges for all moneys which shall become payable under the said insurance and to receive, exercise and enjoy all benefits, advantages, rights and privileges thereof and to do and perform all acts, matters and things. 
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That the Obligor / Mortgagor shall not and will not suffer or permit the mortgaged (".$rec_select['make_desc']." ".$rec_select['model_desc'].").. or any part or portion thereof to be seized or taken in execution of any judgment or judgments against the Obligor / Mortgagor under or in respect of any other claims or proceedings and shall not and will not during the continuance of the mortgage and hypothecation hereby created and so long as any moneys are due to the CDB Meezan under these presents or under any decree to be entered in any action instituted on these presents donate, sell, mortgage lease or otherwise however alienate, encumber, sell, convey or dispose of or deal with the mortgaged... (Make / Model)...
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
                    That all moneys including costs, expenses and charges secured by or payable under these presents shall be payable on demand at Colombo aforesaid notwithstanding anything to the contrary contained in writing or contract now or hereafter to be signed, made or executed by or on behalf of the Obligor / Mortgagor or the CDB Meezan notwithstanding any rule of law or equity to the contrary.
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That the security hereby created shall continue to be valid, binding and effectual for all purposes notwithstanding any change by amalgamation, consolidation or otherwise any other changes in the CDB Meezan.
                </p>
            </li>
            <li>	 
                <p style='text-align: justify;font-family: sans; font-size: 12px;'>
    	           That every demand under these presents may be effectually made sending notice of demand in writing under Section 86 (1) of the Mortgage Act to the address of the Obligor / Mortgagor as stated hereinbefore unless the Obligor / Mortgagor has notified in writing a change of address and such being sent by the post under registered cover.  
                </p>
            </li>
        </ol>
    
        <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            IN WITNESS WHEREOF the Obligor / Mortgagor has set his / her hand at Colombo on this ";
              $sdate = date("Y-m-d");
              echo date('jS of F Y', strtotime($sdate)); 
        echo ".</p>
        <!------>
        <p style='text-align: center; font: bold;font-family: sans; font-size: 14px; font-weight: bold; text-decoration: underline;'>
            Schedule Above Referred To
        </p>
        <table style='width: 100%;font-family: sans; font-size: 12px;'>
                <tr>
                    <td style='font-family: sans; font-size: 12px;width: 50%'>Contract No :".$rec_select['fac_no']." </td>
                    <td style='font-family: sans; font-size: 12px;width: 50%'>Date of Mortgage Bond : ".date("Y-m-d")."</td>
                </tr>
        </table>
        <ol style='font-family: sans; font-size: 12px;'>
            <li style='font-family: sans; font-size: 12px;'>Name, Address and Description of Mortgagor<br /> ".$rec_select['client_full_name']." & ".$rec_select['cc_address_01']." ".$rec_select['cc_address_02']." ".$rec_select['cc_address_03'].". </li><br />
            <li style='font-family: sans; font-size: 12px;'>Value of the Mortgage Bond:".number_format($rec_select['asset_price'],2)." </li><br />
            <li style='font-family: sans; font-size: 12px;'>Description of Mortgaged ..(".$rec_select['make_desc']." ".$rec_select['model_desc'].")..<br />
                <table style='width: 75%;font-family: sans; font-size: 12px;'>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Make</td>
                        <td style='font-family: sans; font-size: 12px;'>Make</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Model</td>
                        <td style='font-family: sans; font-size: 12px;'>Model</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Engine No.</td>
                        <td style='font-family: sans; font-size: 12px;'>Engine No.</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Chassis No.</td>
                        <td style='font-family: sans; font-size: 12px;'>Chassis No.</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Year of Make</td>
                        <td style='font-family: sans; font-size: 12px;'>Year of Make</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>No. of Units</td>
                        <td style='font-family: sans; font-size: 12px;'>No. of Units</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Usually Kept at</td>
                        <td style='font-family: sans; font-size: 12px;'>Client Address�</td>
                    </tr>
                </table>
            </li><br />
            <li style='font-family: sans; font-size: 12px;'> Repayment Schedule
                <table style='width:75%;font-family: sans; font-size: 12px;' border='1' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>No. of Installments</td>
                        <td style='font-family: sans; font-size: 12px;'>Example</td>
                        <td style='font-family: sans; font-size: 12px;'>Monthly Installments</td>
                    </tr>
                    <tr>
                        <td style='font-family: sans; font-size: 12px;'>Tenor : ".$rec_select['period']." </td>
                        <td style='font-family: sans; font-size: 12px;'>Example</td>
                        <td style='font-family: sans; font-size: 12px;'>Rental</td>
                    </tr>
                </table>
            </li>
        </ol>
        <br />
        <label style='font-family: sans; font-size: 12px;'>Signed by mortgagor</label>
        <br /><br />
        <table style='font-family: sans; font-size: 12px;'>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Signature </td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Name </td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>NIC No </td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
        </table> 
        <br/> <br />
        <table style='font-family: sans; font-size: 12px;'>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Signature</td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Joint Client Name</td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>NIC No</td>
                <td style='font-family: sans; font-size: 12px;'>:..................................</td>
            </tr>
        </table> 
        <br />
        <p style='text-align: justify;font-family: sans; font-size: 12px;'>
            We, the subscribing witnesses hereto, do declare that we are well acquainted with the said Obligor / Mortgagor 
            and know his / her proper name, occupation and residence.
        </p> 
        <br />
        <label style='font-family: sans; font-size: 12px;'>Witnesses</label> 
        <br />
        <table style='width: 100%;font-family: sans; font-size: 12px;'>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>1:..........................................................<br />
                    <label style='font-family: sans; font-size: 12px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</label>
                </td>
                <td style='font-family: sans; font-size: 12px;'>2:..........................................................<br />
                    <label style='font-family: sans; font-size: 12px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</label>
                </td>
            </tr>
            <tr>
                <td><label style='font-family: sans; font-size: 12px;'>Name:&nbsp;&nbsp;&nbsp;&nbsp; .............................................</label></td>
                <td><label style='font-family: sans; font-size: 12px;'>Name:&nbsp;&nbsp;&nbsp;&nbsp; .............................................</label></td>
            </tr>
            <tr>
                <td><label style='font-family: sans; font-size: 12px;'>Address:&nbsp;&nbsp; .............................................</label></td>
                <td><label style='font-family: sans; font-size: 12px;'>Address:&nbsp;&nbsp; .............................................</label></td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>................................................................</td>
                <td style='font-family: sans; font-size: 12px;'>................................................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>................................................................</td>
                <td style='font-family: sans; font-size: 12px;'>................................................................</td>
            </tr>
        </table> 
        <br />
        <label style='font-family: sans; font-size: 12px;'>Declaration </label>
        <br />
        <p style= 'text-align: justify;font-family: sans; font-size: 12px;'>
            I ........................................................ being the branch Manager/ Operations 
            In-charges CDB FINANCE PLC ............ branch herewith certify that this instrument was signed by the 
            said mortgagor/s and witnesses before me and in my presence
        </p>
        <table style='font-family: sans; font-size: 12px;'>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Signature</td>
                <td style='font-family: sans; font-size: 12px;'>-</td>
                <td style='font-family: sans; font-size: 12px;'>..................................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Name</td>
                <td style='font-family: sans; font-size: 12px;'>-</td>
                <td style='font-family: sans; font-size: 12px;'>..................................................</td>
            </tr>
            <tr>
                <td style='font-family: sans; font-size: 12px;'>Date</td>
                <td style='font-family: sans; font-size: 12px;'>-</td>
                <td style='font-family: sans; font-size: 12px;'>..................................................</td>
            </tr>
        </table>
        

</div> 

"  ;    */
 // 1---------------------------------- End Main While --------------------------------------------               
     }   
}
    



//-------------------------------------------------------------------------------------------------------------------

function convetDecimal($string) {
   $string = str_replace(',', '', $string); // Replaces all spaces with hyphens.
   
   return floatval($string);
   //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>