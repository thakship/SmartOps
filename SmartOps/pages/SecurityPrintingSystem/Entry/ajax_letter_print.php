<?php
if(isset($_REQUEST['get_letter_type_code']) && isset($_REQUEST['get_batch_number']) && isset($_REQUEST['get_Remarks']) && isset($_REQUEST['get_user'])){
    //echo $_REQUEST['get_letter_type_code']."--".$_REQUEST['get_batch_number']."--".$_REQUEST['get_Remarks'];
    get_print_letter(trim($_REQUEST['get_letter_type_code']),trim($_REQUEST['get_batch_number']),trim($_REQUEST['get_Remarks']),trim($_REQUEST['get_user']));
    
}

function DatabaseConnection(){ // Function For Datebase Connection .................................................
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

function get_print_letter($get_letter_type_code,$get_batch_number,$get_Remarks,$get_user){
    $conn = DatabaseConnection();
    //echo $get_letter_type_code."--".$get_batch_number."--".$get_Remarks;
    $sql_date = "SELECT `currentDate` FROM `systemdate`;";
    $que_date = mysqli_query($conn,$sql_date) or die(mysqli_error());
    while($res_date = mysqli_fetch_array($que_date)){
        $getDate = $res_date[0];
    }
    $sql_select_gen = "SELECT * FROM `sps_let_gen` WHERE `BATCH_NUM` = '".$get_batch_number."';";
    $que_select_gen = mysqli_query($conn , $sql_select_gen) or die(mysqli_error());
    while($res_select_gen = mysqli_fetch_assoc($que_select_gen)){ 
        //$id=1;  
	   $sql_ath1 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$res_select_gen['AUTH_1_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath1 = mysqli_query($conn,$sql_ath1) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath1 = mysqli_fetch_array($result_ath1)){
            //header("Content-Type: image/jpeg");
            $img_01 = $row_ath1[0];
            $des_01 = $row_ath1[1];
            $sig_name_01 = $row_ath1[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
        }
        $sql_ath2 = "SELECT `SIG_IMG`,`designation`,`sig_name` FROM `sps_sig_mast` WHERE `USER_ID` = '".$res_select_gen['AUTH_2_BY']."' AND `EXP_DATE` = '0000-00-00';";
       $result_ath2 = mysqli_query($conn,$sql_ath2) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error());
       while($row_ath2 = mysqli_fetch_array($result_ath2)){
            //header("Content-Type: image/jpeg");
            $img_02 = $row_ath2[0];
            $des_02 = $row_ath2[1];
            $sig_name_02 = $row_ath2[2];
            //echo "<img src='data:image/jpeg;base64,".base64_encode( $row["SIG_IMG"])."'/>";
            //echo <img src="imageView.php?image_id= $row["SIG_IMG"];
       }
        echo "<div id='getLetter' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; page-break-after: always'>
                <br/><br/><br/><br/><br/><br/>
                <div style='width: 100%; float: left;'>
                    <div style='width: 40%; float: left;'>
                        <br /><br /><br />
                        <span style='margin-left: 50px;'>Date : ".$getDate." </span><br/><br/>
                        <span style='margin-left: 50px;'>".$res_select_gen['CL_NAME_1']." </span><br/>
                        <div style='margin-left: 50px;'>
                        <span>".$res_select_gen['LET_ADD']." </span>
                        </div>
                    </div>
                    <div style='width: 30%; float: left; text-align: center;'>
                        <br /><br /><br />
                        <label style='font-size: 18px'>RENEWAL LETTER</label>
                        
                    </div>
                </div>
                <div style='width: 100%; float: left;'>
                    <label style='margin-left: 300px;'>Joint Holder : ".$res_select_gen['CL_NAME_2']."</label><br/>
                    <label style='margin-left: 300px;'>NIC / P.P No : ".$res_select_gen['CL_NIC_2']."</label>
                </div>
                <div style='width: 90%; float: left; margin-left: 50px;margin-right: 50px;'>
                    <label>Dear Sir / Madam,</label><br/><br />
                    <label style='font-size: 14px; font-weight: bold;'>RENEWAL OF FIXED DEPOSIT NO : ".$res_select_gen['DEPOSIT_NUM']." &nbsp;&nbsp;&nbsp; ".$res_select_gen['client_code']."</label><br/>
                    <p style='text-align: justify;'>
                        We are pleased to inform you that above Fixed Deposit has been renewed from ".$res_select_gen['MAT_DATE']." under the same conditions of the original Fixed Deposit with prevailing interest rate as per the details given in the Section B. 
                    </p>
                    <label style='font-weight: bold;'>Section A : Details of the Matured Deposit</label><br/>
                    <table style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Holder Name</td>
                            <td>: ".$res_select_gen['CL_NAME_1']."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>NIC No.</td>
                            <td>: ".$res_select_gen['CL_NIC_1']."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Certificate No.</td>
                            <td>:</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Deposit Amount</td>
                            <td>: ". number_format($res_select_gen['dep_amt'],2)."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Rate of interest</td>
                            <td>: ".$res_select_gen['INT_RATE']."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Total interest</td>
                            <td>: Rs. ".number_format($res_select_gen['TOT_INT_AMT'],2)."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Interest already paid as per your instructions</td>
                            <td>: Rs. ".number_format($res_select_gen['INT_ALREADY_PAID'],2)."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Withholding tax deducted</td>
                            <td>: Rs. ".number_format($res_select_gen['WHT_DEDUCTED'],2)."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Interest added to the deposit</td>
                            <td>: Rs. ".number_format($res_select_gen['INT_ADDED_TO_DEP'],2)."</td>
                        </tr>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>Any other addition or deductions</td>
                            <td>: Rs. ".number_format($res_select_gen['OTHER_AJD'],2)."</td>
                        </tr>
                    </table>
                    <label style='font-weight: bold;'>Section B : Details of the Renewed Deposit</label><br/>
                    <table style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>
                        <tr style='height: 18px;'>
                            <td style='width: 300px;'>New Deposit Number</td>
                            <td>: ".$res_select_gen['NEW_DEP_NUM']."</td>
                        </tr>
                        <tr style='height: 18px; width: 400px;'>
                            <td style='width: 300px;'>New Deposit Amount</td>
                            <td>: Rs. ".number_format($res_select_gen['NEW_DEP_AMT'],2)."</td>
                        </tr>
                        <tr style='height: 18px; width: 400px;'>
                            <td style='width: 300px;'>Rate of interest for the new deposit</td>
                            <td>: ".$res_select_gen['NEW_DEP_RATE']."</td>
                        </tr>
                        <tr style='height: 18px; width: 400px;'>
                            <td style='width: 300px;'>Period of new deposit</td>
                            <td>: ".$res_select_gen['NEW_DEP_PERIOD']."</td>
                        </tr>
                        <tr style='height: 18px; width: 400px;'>
                            <td style='width: 300px;'>Date of maturity</td>
                            <td>: ".$res_select_gen['NES_DEP_MATDATE']."</td>
                        </tr>
                    </table>
                    <p style='text-align: justify;'>
                        This letter of renewal is an integral part of the original fixed deposit certificate issued to you and should be produced along with the original certificate at the time of withdrawal of the deposit. Validity of this letter will be null and void, in the event you have already redeemed the fixed deposit at the time you receive this notice or redeemed without producing this notice due to any circumstances. 
                    </p><br/>
                    <table style='width: 100%;'>
                        <tr >
                            <td style='width: 50%; text-align: center;'>";
                            header("Content-Type: image/jpeg");
                            echo "<img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_01)."'/>";
                            echo "....................................... <br />
                            <label style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>".$sig_name_01."</label><br/>
                            <label style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>".$des_01."</label>
                            </td>
                            <td style='width: 50%; text-align: center; hight'>";
                                 header("Content-Type: image/jpeg");
                                 echo "<img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/>";
                                echo "..................................... <br />
                                <label style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>".$sig_name_02."</label><br/>
                            <label style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>".$des_02."</label>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>";
        
    }
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_select_print = "SELECT COUNT(*) FROM `sps_let_batch_prnt` WHERE `BATCH_NUM` = '".$get_batch_number."';";
        $que_select_print = mysqli_query($conn, $sql_select_print) or die(mysqli_error());
        $ans_s = 0;
        while($res_select_print = mysqli_fetch_array($que_select_print)){
            $ans_s = $res_select_print[0]+1;
        }
        $sql_insert = "INSERT INTO `sps_let_batch_prnt`(`LET_TYPE`, `BATCH_NUM`, `PRNT_SERIAL`, `PRINT_BY`, `PRNT_DATE`, `PRNT_REMARK`, `ENTERED_BY`, `ENTERED_DATE`) 
                                                VALUES ('".$get_letter_type_code."','".$get_batch_number."','".$ans_s."','".$get_user."',now(),'".$get_Remarks."','".$get_user."',now());";
        echo $sql_insert;                                        
        $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
        $sql_update = "UPDATE `sps_let_batch` SET `BATCH_STAT`= 'P' WHERE `BATCH_NUM` = '".$get_batch_number."';";
        $que_update = mysqli_query($conn, $sql_update) or die(mysqli_error());
        mysqli_commit($conn);
    }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
            
    }
}
?>