<?php
//*************************** Start Oracle databese Connecton **************************************************************************
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'Off');

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('cdberp','cdberp',$dbstr1); 
if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	//echo "Successfully connected to Oracle.\n";
}

//************************** End Oracal Database Connection*************************************************************************************
//**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 
 //*************************** End Mysql Database Connection **************************************************************************


    if(isset($_POST['get_LetterTypeCode']) && isset($_POST['get_date']) && isset($_POST['get_User']) && isset($_POST['d_date']) && $_POST['get_LetterTypeCode'] != "" && $_POST['get_date'] != "" && $_POST['get_User'] != "" && $_POST['d_date'] != "" && $_POST['txt_u_defiend'] && $_POST['U_type']){
       // echo $_POST['get_LetterTypeCode']."--".$_POST['get_date']."--".$_POST['get_User'];
       // echo $_POST['txt_u_defiend']."--".$_POST['U_type'];
       //isFunctionOK();
        isSelect_Prossess_Letter_Generation(trim($_POST['get_LetterTypeCode']),trim($_POST['get_date']),trim($_POST['get_User']),$dbConn,trim($_POST['d_date']),trim($_POST['txt_u_defiend']),trim($_POST['U_type']));
    }
    
    if(isset($_POST['get_LetterTypeCode_cbl']) && isset($_POST['get_User_cbl']) && isset($_POST['U_type_cbl']) && isset($_POST['txt_u_defiend_cbl'])){
        //get_LetterTypeCode_cbl get_User_cbl U_type_cbl txt_u_defiend_cbl 
       //  echo "OK | ".$_POST['get_LetterTypeCode_cbl']."--".$_POST['get_User_cbl']."--".$_POST['U_type_cbl']."--".$_POST['txt_u_defiend_cbl'];
        cbl05Letter_Generation(trim($_POST['get_LetterTypeCode_cbl']),trim($_POST['get_User_cbl']),trim($_POST['U_type_cbl']),trim($_POST['txt_u_defiend_cbl']),$dbConn);
        
    }
       
  
    
    if(isset($_REQUEST['isrequestDate_DDPO'])){
        //echo $_REQUEST['isrequestDate_DDPO'];
        getPage_DDPO(trim($_REQUEST['isrequestDate_DDPO']),$dbConn);
    }
    
    if(isset($_REQUEST['isrequestDate_DDPO_Printted'])){
        getPage_PrintedDDPO(trim($_REQUEST['isrequestDate_DDPO_Printted']),$dbConn);
    }
    
    if(isset($_POST['isloguserCBL']) && isset($_POST['isV_JOB_DATE']) && isset($_POST['isV_LOAD_JOB']) && isset($_POST['isV_PRINT_JOB'])){
        //echo $_POST['isloguserCBL'] ." - ".$_POST['isV_JOB_DATE']." - ".$_POST['isV_LOAD_JOB']." - ".$_POST['isV_PRINT_JOB'];
        getPrint_DDPO($_POST['isloguserCBL'],$_POST['isV_JOB_DATE'],$_POST['isV_LOAD_JOB'],$_POST['isV_PRINT_JOB'],$dbConn);
    }
    
    if(isset($_POST['isloguserRP']) && isset($_POST['isV_JOB_DATERP']) && isset($_POST['isV_LOAD_JOBRP']) && isset($_POST['isV_PRINT_JOBRP'])){
        //echo $_POST['isloguserRP'] ." - ".$_POST['isV_JOB_DATERP']." - ".$_POST['isV_LOAD_JOBRP']." - ".$_POST['isV_PRINT_JOBRP'];
       getPrint_DDPO_RePrited($_POST['isloguserRP'],$_POST['isV_JOB_DATERP'],$_POST['isV_LOAD_JOBRP'],$_POST['isV_PRINT_JOBRP'],$dbConn);
    }


  
   if(isset($_POST['get_fac_number']) && isset($_POST['get_loguser']) && isset($_POST['setTitle']) && isset($_POST['isget_date'])){
        //echo $_POST['setTitle'];
        if ($_POST['setTitle'] == 'leaseAgreement'){
           //echo 'Done.';
           getPrintLeaseAgreement($dbConn,$_POST['get_fac_number'],$_POST['get_loguser'],$_POST['isget_date']);
        }else if($_POST['setTitle'] == 'leaseStructure'){
            //echo "leaseStructure OK";
            getPrintLeaseAgreementStructure($dbConn,$_POST['get_fac_number'],$_POST['get_loguser'],$_POST['isget_date']);
        }else if($_POST['setTitle'] == 'leaseCorporate'){
           // echo "leaseCorporate OK";
            getPrintLeaseAgreementCorporate($dbConn,$_POST['get_fac_number'],$_POST['get_loguser'],$_POST['isget_date']);
        }else{
            echo '0';
        }
    }
     //echo "OK";
    if(isset($_POST['get_fac_numberCB']) && isset($_POST['get_ContractNo']) && isset($_POST['get_CashBackAmount']) && isset($_POST['get_loguser']) && isset($_POST['setTitle'])){
        if ($_POST['setTitle'] == 'cashbackloan_APP'){
            //echo "OK";
            getCashBackedLoans_SpecialMarginApproval($dbConn,$_POST['get_fac_numberCB'],$_POST['get_ContractNo'],$_POST['get_CashBackAmount'],$_POST['get_loguser']);
        }else{
            echo '0';
        }
    }
    
    function isFunctionOK(){
        echo "OK Function";
    }
    
    
    function getCashBackedLoans_SpecialMarginApproval($dbConn,$get_Dep_number,$ContractNo,$CashBackAmount,$get_loguser){
         $conn = DatabaseConnection();
        //echo $get_Dep_number;
        //echo "<h1>Cash Backed Loans - Special Margin Approval</h1>";
        //----- Inert Into Table
         date_default_timezone_set('Asia/Colombo');
         
         //$stid = oci_parse($dbConn, "SELECT pkg_CBL_Marginapproval.get_cashbackMargin_Data('003800380905340001',6) FROM DUAL;");
         $stid = oci_parse($dbConn, "select * from table(cdbproddb.pkg_CBL_Marginapproval.get_cashbackMargin_Data('".$get_Dep_number."',".$ContractNo."))");
         oci_execute($stid);
        ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
        $x = 1;
        $STD_WALR = "";
        $ACT_WALR = "";
        $num = 0.00;
    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
          /*
             $row[0]    PCLCODE	        244283
             $row[1]    PCLNAME	        Mr. F.W.E.C. CANSI
             $row[2]    SCLCODE	
             $row[3]    SCLNAME	 
             $row[4]    TCLCODE	
             $row[5]    TCLNAME	 
             $row[6]    DEP_NUMBER	     001400244283340101-29
             $row[7]    DEP_AMOUNT	     252,100.00
             $row[8]    CERTFNUMBER	    SNC\/112533
             $row[9]    EPBRANCH	   JAELA
             $row[10]   EXIST_FACS	
             $row[11]   CB_LR	
             $row[12]   STD_WALR	   16.36
             $row[13]   ACT_WALR	   16.36
             $row[14]   DEF_WALR	   0
             $row[15]   LIEN_ACC	   004400244283151102
             $row[16]   CBL_AMOUNT	   252100

          */
          
          
          $num = floatval(str_replace(",","", $row[7]));
          $request_branch = "";
          $request_user_name = "";
          $request_on = "";
          $sql_get_user_dtl = "select getBranchName(u.branchNumber) ,
                                       u.userID  ,
                                       NOW()
                                from user as u 
                                where u.userName = '".$get_loguser."'";
          $query_get_user_dtl = mysqli_query($conn,$sql_get_user_dtl) or die(mysqli_error($conn));
          while($rec_get_user_dtl = mysqli_fetch_array($query_get_user_dtl)){
                $request_branch = $rec_get_user_dtl[0];
                $request_user_name = $rec_get_user_dtl[1];
                $request_on = $rec_get_user_dtl[2];
          }
          
          $diss = "";
            if($row[14] > 0.5){
               $diss =  "Reject";
            }else{
               $diss = "Approval";
                
            }
            $STD_WALR = round($row[12], 2);
            $ACT_WALR = round($row[13],2);
           mysqli_autocommit($conn,FALSE);
           try{
            
            $input_para = $get_Dep_number;
                $serial_no = "";
                $sql_insert = "INSERT INTO `sps_general_letter_gen_print`(`let_id`, `input_para`, `serial_no`, `print_by`) 
                                                        VALUES (3,'".$input_para."','".$serial_no."','".$get_loguser."');";
                //echo $sql_insert;                                        
                $que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());
                
                $SQL_PRINT_INSERT =  "INSERT INTO `sps_cashbackMargin_dtl` (`PCLCODE`, `PCLNAME`,`SCLCODE`,`SCLNAME`,`TCLCODE`,`TCLNAME`,`DEP_NUMBER`,`DEP_AMOUNT`,`CERTFNUMBER`,`EPBRANCH` ,`EXIST_FACS`,`CB_LR`,`STD_WALR`,`ACT_WALR`,`DEF_WALR`,`LIEN_ACC`,`CBL_AMOUNT`,`decision`,`entry_by`)
                                        VALUES('".$row[0]."', '".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."' ,'".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$diss."','".$get_loguser."');";
                $query__PRINT_INSERT = mysqli_query($conn,$SQL_PRINT_INSERT)  or die(mysqli_error());
                mysqli_commit($conn);
             }catch(Exception $e){
                        // Rollback transaction
                        mysqli_rollback($conn);
                        echo 'Message: ' .$e->getMessage();
                        
             }
            echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover1'> 
                        <table style='font-family: sans;font-size: 14px; width: 100%;' border='1' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='vertical-align: top;text-align: center; font-weight: bold; text-decoration: underline; height: 30px;' colspan='2'>Cash Backed Loans - Special Margin Approval</td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: left; width: 25%;'><label style='margin: 5px;'>Requested Branch</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 75%;'><label style='margin: 5px;'>: ".$request_branch."</label></td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: left; width: 25%;'><label style='margin: 5px;'>Requested Date / Time</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 75%;'><label style='margin: 5px;'>: ".$request_on."</label></td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: left; width: 25%;'><label style='margin: 5px;'>Requested User Name / ID</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 75%;'><label style='margin: 5px;'>: ".$request_user_name."</label></td> 
                            </tr>
                            <!--<tr>
                                <td style='vertical-align: top;text-align: left; width: 25%;'><label style='margin: 5px;'>Loan Processing Date</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 75%;'><label style='margin: 5px;'>: </label></td> 
                            </tr>-->
                            <tr>
                                <td style='vertical-align: top;' colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;' colspan='2'>
                                     <label style='margin: 5px;font-weight: bold;'>1.	Details of Borrowers</label>
                                    <table>
                                        <tr>
                                            <td><label style='margin: 20px;'>1.1 Main Holder&apos;s Code</td>
                                            <td>: ".$row[0]."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>1.2 Main Holder&apos;s Name</td>
                                            <td>: ".$row[1]."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>1.3 Joint Holder&apos;s Code</td>
                                            <td>: ".$row[2]."</td>
                                        </tr>
                                        <tr>
                                            <td><label style='margin: 20px;'>1.4 Joint Holder&apos;s Name</td>
                                            <td>: ".$row[3]."</td>
                                        </tr>
                                        <tr>
                                            <td><label style='margin: 20px;'>1.5 Joint Holder&apos;s Code</td>
                                            <td>: ".$row[4]."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>1.6 Joint Holder&apos;s Name</td>
                                            <td>: ".$row[5]."</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;' colspan='2'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;' colspan='2'>
                                     <label style='margin: 5px;font-weight: bold;'>2.   Deposit Details</label>
                                    <table>
                                        <tr>
                                            <td><label style='margin: 20px;'>2.1 Deposit No</td>
                                            <td>: ".$row[6]."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>2.2 Deposit Amount</td>
                                            <td>: ".$row[7]."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>2.3 Certificate No</td>
                                            <td>: ".$row[8]."</td>
                                        </tr>
                                        <tr>
                                            <td><label style='margin: 20px;'>2.4 Existing Facilities for the Deposit Contract</td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: center; width: 40%; font-weight: bold;'><label style='margin: 5px;'>Lien Marked A/C</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 60%; font-weight: bold;'><label style='margin: 5px;'>: ".$row[15]."</label></td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: center; width: 40%;'><label style='margin: 5px;'>Existing CBL / Lien for the above deposit</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 60%;'><label style='margin: 5px;'>: ".$row[16]."</label></td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;' colspan='2'>&nbsp;</td>
                            </tr>
                             <tr>
                                <td style='vertical-align: top;' colspan='2'>
                                     <label style='margin: 5px;font-weight: bold;'>3.   Cash Backed Loan Details</label>
                                    <table>
                                        <tr>
                                            <td><label style='margin: 20px;'>3.1 CBL Amount</td>
                                            <td>: ".$CashBackAmount."</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>3.2 Exposure</td>
                                            <td>: ".round((($CashBackAmount/$num)*100),2)."%</td>
                                        </tr>
                                         <tr>
                                            <td><label style='margin: 20px;'>3.3 Branch WALR for CBL</td>
                                            <td>: ".$ACT_WALR."%</td>
                                        </tr>
                                        <tr>
                                            <td><label style='margin: 20px;'>3.4 Standard WALR for CBL</td>
                                            <td>: ".$STD_WALR."%</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: center; width: 40%; font-weight: bold;'>&nbsp;</td> 
                                <td style='vertical-align: top;text-align: center; width: 60%; font-weight: bold;'>&nbsp;</td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: left; width: 40%;'><label style='margin: 5px;'>Decision Based On</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 60%;'><label style='margin: 5px;'>Branch Margin Maintenance</label></td> 
                            </tr>
                            <tr>
                                <td style='vertical-align: top;text-align: left; width: 40%;'><label style='margin: 5px;'>Decision</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 60%;'><label style='margin: 5px;'>: ".$diss."</label></td> 
                            </tr>
                              <tr>
                                <td style='vertical-align: top;text-align: left; width: 40%;'><label style='margin: 5px;'>Decision given on</label></td> 
                                <td style='vertical-align: top;text-align: left; width: 60%;'><label style='margin: 5px;'>: ".$request_on."</label></td> 
                            </tr>
                        </table>
                        <br />
                        <table style='font-family: sans;font-size: 14px; width: 100%;' border='1' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td style='vertical-align: top;text-align: left; height: 30px;' colspan='2'>
                                     <label style='margin: 5px;'>Approval Conditions:</label>
                                        <ul>
                                            <li>Subject to open and process with the Special Margin A/C as prescribed in the &quot;Cash Backed Loans Policy and Procedure Manual&quot;</li>
                                        </ul>
                                </td>
                            </tr>
                        </table>
                    </div>";
    }
    
}
    
  
function getPrintLeaseAgreement($dbConn,$fac_number,$PrintUser,$get_date){
    $conn = DatabaseConnection();
        //----- Inert Into Table
    date_default_timezone_set('Asia/Colombo');
     //echo $fac_number ." - " . $PrintUser;
    //----- Start Update DB
    mysqli_autocommit($conn,FALSE);
    try{
            $input_para = $fac_number;
            $serial_no = "";
            $sql_insert = "INSERT INTO `sps_general_letter_gen_print`(`let_id`, `input_para`, `serial_no`, `print_by`) 
                                                    VALUES (1,'".$input_para."','".$serial_no."','".$PrintUser."');";
            //echo $sql_insert;                                        
            //$que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());

           
           mysqli_commit($conn);
     }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
     }
     //echo "I OK";
     
     $date   =  date_create($get_date);
     $sql_oci_select_db = oci_parse($dbConn, "SELECT *  FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_lseAGR_data('".$input_para."'))");
     
     oci_execute($sql_oci_select_db);
     $i = 1;
     ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    
     while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
        /*
            $row[0]   CLCODE	         532853
            $row[1]   FACNO	         '006500532853050102
            $row[2]   CLNAME	         Mr. RUPASINGHA ARACHCHIGE DON VIRAJ  LAKSHITHA
            $row[3]   CLNIC	         981441893V
            $row[4]   CLADRESS	     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[5]   VMAKE	         BAJAJ
            $row[6]   VMODEL	         RE 4S
            $row[7]   VENO	         275IDI05JTZ543645
            $row[8]   VCHNO	         MAT4450106RR42998
            $row[9]   SUPCODE	         61290
            $row[10]  MFYEAR	         2006
            $row[11]  SUPNAME	
            $row[12]  GUARNAME1	     Mr.G.S.A.K. AWANTHA
            $row[13]  GUARNAME2	     Ms.M.V.P.T. RASANGIKA
            $row[14]  GUARADDRESS1     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[15]  GUARADDRESS2     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[16]  GUAR1_NIC	     911920590V
            $row[17]  GUAR2_NIC	     988350532V
            $row[18]  LEASETENOR	     48
            $row[19]  LUMPSUM	         197,348.00
            $row[20]  MONTHLYRENTAL	 7,397.00
            $row[21]  OD_INT	         6%  
            $row[22]  SUPPLIERDETAIL	 DAVID PIERIS MOTOR COMPANY (LANKA) LIMITED OF ITTAGALAWATTA,KAHANDAWA SOUTH,,,, RANNA
            $row[23]  BRANCH	         AVISSAWELLA
            $row[24]  COVERING	     1        
            $row[25]  JCLNIC
            $row[26]  JCLADDR
            $row[27]  LOCATION
            $row[28]  CHARGESREC_DATE
            $row[29]  SCHEME_CODE
            $row[30]  SCHEME_DESC
            $row[31]  COVERING

        */
        
            $CLCODE = $row[0];
            $FACNO = $row[1];
            $CLNAME	= $row[2];
            $CLNIC = $row[3];
            $CLADRESS = $row[4];
            $VMAKE = $row[5];
            $VMODEL = $row[6];
            $VENO = $row[7];
            $VCHNO = $row[8];
            $SUPCODE = $row[9];
            $MFYEAR = $row[10];
            $SUPNAME = $row[11];
            $GUARNAME1 = $row[12];
            $GUARNAME2 = $row[13];
            $GUARADDRESS1 = $row[14];
            $GUARADDRESS2 = $row[15];
            $GUAR1_NIC = $row[16];
            $GUAR2_NIC = $row[17];
            $LEASETENOR = $row[18];
            $LUMPSUM = $row[19];
            $MONTHLYRENTAL = $row[20];
            $OD_INT = $row[21];
            $SUPPLIERDETAIL	= $row[22];
            $BRANCH = $row[23];
            $JCLNAME = $row[24];
            $JCLNIC = $row[25];
            $JCLADDR = $row[26];
            $LOCATION = $row[27];
            $CHARGESREC_DATE = $row[28];
            $SCHEME_CODE = $row[29];
            $SCHEME_DESC = $row[30];
            $COVERING = $row[31];
            
        echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover1'> 
                <label style='position: relative;left: 350px; top: -11px; font-size: 13px;'>".$FACNO."</label>
                    </div>
                    <!-- End - 1 Page -->
                    <!-- Start - 2 Page -->
                    <div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover5'>
                    
                        
                        <label style='position: relative;left: 150px; top: 875px; font-size: 12px;'>".$CLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 880px; font-size: 12px;'>".$CLNIC."</label>
                        <label style='position: relative;left: 240px; top: 880px; font-size: 12px;'>".$CLADRESS."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 885px; font-size: 12px;'>".$JCLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 890px; font-size: 12px;'>".$JCLNIC."</label>
                        <label style='position: relative;left: 240px; top: 890px; font-size: 12px;'>".$JCLADDR."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 935px; font-size: 12px;'>".$GUARNAME1."</label><br />
                        <label style='position: relative;left: 150px; top: 940px; font-size: 12px;'>".$GUAR1_NIC."</label>
                        <label style='position: relative;left: 240px; top: 940px; font-size: 12px;'>".$GUARADDRESS1."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 995px; font-size: 12px;'>".$GUARNAME2."</label><br />
                        <label style='position: relative;left: 150px; top: 1000px; font-size: 12px;'>".$GUAR2_NIC."</label>
                        <label style='position: relative;left: 240px; top: 1000px; font-size: 12px;'>".$GUARADDRESS2."</label><br />";
                        
              $sql_oci_select_db_2 = oci_parse($dbConn,  "SELECT * FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_VEHICLE_DETAILS('".$input_para."'))");
     
                oci_execute($sql_oci_select_db_2);
               ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
               $x = 5;
               $a = 1110;
               echo "<table>";
               while (($row_2 = oci_fetch_array($sql_oci_select_db_2, OCI_BOTH)) != false) {	//Read Oracle Source table
                /*
                 $VMAKEMODEL	   HONDA DAA-RU4 VEZEL 2014
                 $CHASI_SERIAL	   RU4-1000561
                 $ENGINE_NO	       LEB-H1-3600563
                 
                 */
                 $VMAKEMODEL = $row_2[0];
                 $CHASI_SERIAL = $row_2[1];
                 $ENGINE_NO	 = $row_2[2];
                 echo "<tr>
                            <td>
                                <label style='position: relative;left: 15px; top: ".$a."px; font-size: 12px;'>".$VMAKEMODEL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 400px; top: ".$a."px; font-size: 12px;'>".$CHASI_SERIAL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 475px; top: ".$a."px; font-size: 12px;'>".$ENGINE_NO."</label>
                            </td>
                 </tr>";
                           
                  $a += $x;

              }
              echo "</table>";
                        
                        
              echo" <label style='position: relative;left: 15px; top: 1190px; font-size: 12px;'>Manufacturer / Year of Manufacture : Refer Above ITEM (4)</label><br />
                        <label style='position: relative;left: 50px; top: 1195px; font-size: 12px;'>ITEM (5) Seller : ".$SUPPLIERDETAIL."</label><br />
                    </div>";
                    
              $sql_DO = "select MAX(DATE(s.PRNT_DATE))
                                from sps_let_batch_prnt AS s 
                                where s.BATCH_NUM = '".$input_para."';";
              $query_DO = mysqli_query($conn,$sql_DO) or die(mysqli_error($conn));
              $DO_PRINT_DATE = "";
              while($rec_DO = mysqli_fetch_array($query_DO)){
                $DO_PRINT_DATE = $rec_DO[0];
              } 
              $$MONTHLYRENTAL_FINAL = "0.00"; 
              if($COVERING == 0){
                $$MONTHLYRENTAL_FINAL = "0.00";    
              }else{
                $$MONTHLYRENTAL_FINAL = $MONTHLYRENTAL;    
              }    
              echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover6'> 
                        <label style='position: relative;left: 300px; top: -1px; font-size: 13px;'>".$CLADRESS."</label><br />
                        <label style='position: relative;left: 300px; top: 5px; font-size: 13px;'>".$DO_PRINT_DATE."</label><br />
                        <label style='position: relative;left: 110px; top: 60px; font-size: 13px;'>".$LEASETENOR."</label><br />
                        
                        <label style='position: relative;left: 75px; top: 85px; font-size: 13px;'>".$$MONTHLYRENTAL_FINAL."</label>
                        <label style='position: relative;left: 190px; top: 85px; font-size: 13px;'>".$COVERING."</label><br />
                        <label style='position: relative;left: -6px; top: 95px; font-size: 13px;'>".$LUMPSUM."</label><br />
                        <label style='position: relative;left: 55px; top: 105px; font-size: 13px;'>".$LEASETENOR."</label>
                        <label style='position: relative;left: 220px; top: 105px; font-size: 13px;'>".$MONTHLYRENTAL."</label><br />
                        
                        <label style='position: relative;left: 390px; top: 170px; font-size: 13px;'>".$OD_INT."</label><br />
                        
                        <label style='position: relative;left: 710px; top: 280px; font-size: 13px;'>".$LOCATION."</label><br />
                        <label style='position: relative;left: 400px; top: 285px; font-size: 13px;'>". date_format($date,"dS")." day of ".date_format($date,"F Y")."</label><br />";
                      
                       
                       $SQL_MKR = "SELECT ch.enterBy AS MKR_OFFICER_HRIS ,
                                          u.userID AS MKR_OFFICER_NAME,
                                          u.NIC AS MKR_OFFICER_NIC
                                    FROM cdb_helpdesk AS ch , user AS u
                                    WHERE ch.cat_code = 1014
                                       AND ch.facno = '".$input_para."'
                                       AND ch.enterBy = u.userName ;"; 
                       $MKR_OFFICER_HRIS = " - ";
                       $MKR_OFFICER_NAME = " - ";
                       $MKR_OFFICER_NIC = " - ";
                       $MKR_ADDRESS = " - ";
                       $QUERY_MKR = mysqli_query($conn,$SQL_MKR) or die(mysqli_error($conn));
                       while ($RESALT_MKR = mysqli_fetch_array($QUERY_MKR)){
                            $MKR_OFFICER_HRIS = $RESALT_MKR[0];
                            $MKR_OFFICER_NAME = $RESALT_MKR[1];
                            $MKR_OFFICER_NIC = $RESALT_MKR[2];
                       }
                       
                       $SQL_PRINT_DTL = "SELECT u.userID AS PRINT_USER_NAME,
                                               u.NIC AS PRINT_USER_NIC
                                        FROM  user AS u
                                        WHERE u.userName = '".$PrintUser."';";
                       $PRINT_BY_NAME = " - ";
                       $PRINT_BY_HRIS = " - ";
                       $PRINT_BY_ADDRESS = " - ";
                       $QUERY_PRINT_DTL = mysqli_query($conn,$SQL_PRINT_DTL) or die(mysqli_error($conn));
                       while ($RESALT_PRINT_DTL = mysqli_fetch_array($QUERY_PRINT_DTL)){
                            $PRINT_BY_HRIS = $PrintUser;
                            $PRINT_BY_NAME = $RESALT_PRINT_DTL[0];
                            $PRINT_BY_NIC = $RESALT_PRINT_DTL[1];
                       }
                      
                      
                    echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 380px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 380px; font-size: 13px;'>".$CLNAME."</label>
                                </td>
                             </tr>
                             <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 385px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 385px; font-size: 13px;'>".$CLNIC."</label>
                                </td>
                             </tr>
                        </table>";
                        echo "<table>
                                <tr>
                                <td>                 
                                    <label style='position: relative;left: -3px; top: 390px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 390px; font-size: 13px;'>".$CLADRESS."</label>
                                </td>
                             </tr>
                            </table>";
                            
                         echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 430px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 430px; font-size: 13px;'>".$JCLNAME."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 435px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 435px; font-size: 13px;'>".$JCLNIC."</label>
                                </td>
                            </tr>
                           </table>";
                         echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 440px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 440px; font-size: 13px;'>".$JCLADDR."</label>
                                </td>
                            </tr>
                            </table>";
                                           
              
                      echo "<table>
                            <tr>
                                <td>    
                                    <label style='position: relative;left: -3px; top: 500px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 500px; font-size: 13px;'>".$GUARNAME1."</label>
                                </td>
                                <td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 505px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 505px; font-size: 13px;'>".$GUAR1_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                            echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 510px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 510px; font-size: 13px;'>".$GUARADDRESS1."</label>
                                </td>
                            </tr>
                        </table> ";
                        
                     echo " <table>
                            <tr>
                                <td>                
                                    <label style='position: relative;left: -3px; top: 550px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 550px; font-size: 13px;'>".$GUARNAME2."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 555px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 555px; font-size: 13px;'>".$GUAR2_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                     echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 560px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 450px; top: 560px; font-size: 13px;'>".$GUARADDRESS2."</label>
                                 </td>
                            </tr>
                        </table>";
                       
                       $date_CHARGESREC_DATE = date_create($CHARGESREC_DATE);
                    echo " <label style='position: relative;left: 200px; top: 610px; font-size: 13px;'>". date_format($date_CHARGESREC_DATE,"dS")." day of ".date_format($date_CHARGESREC_DATE,"F Y")."</label><br />
                    </div>
                 ";
        }
  }


function getPrintLeaseAgreementStructure($dbConn,$fac_number,$PrintUser,$get_date){
    //echo  "Structure";
    $conn = DatabaseConnection();
        //----- Inert Into Table
    date_default_timezone_set('Asia/Colombo');
     //echo $fac_number ." - " . $PrintUser;
    //----- Start Update DB
    mysqli_autocommit($conn,FALSE);
    try{
            $input_para = $fac_number;
            $serial_no = "";
            $sql_insert = "INSERT INTO `sps_general_letter_gen_print`(`let_id`, `input_para`, `serial_no`, `print_by`) 
                                                    VALUES (1,'".$input_para."','".$serial_no."','".$PrintUser."');";
            //echo $sql_insert;                                        
            //$que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());

           
           mysqli_commit($conn);
     }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
     }
     //echo "I OK";
     
     $date   =  date_create($get_date);
     $sql_oci_select_db = oci_parse($dbConn, "SELECT *  FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_lseAGR_data('".$input_para."'))");
     
     oci_execute($sql_oci_select_db);
     $i = 1;
     ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    
     while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
        /*
            $row[0]   CLCODE	         532853
            $row[1]   FACNO	         '006500532853050102
            $row[2]   CLNAME	         Mr. RUPASINGHA ARACHCHIGE DON VIRAJ  LAKSHITHA
            $row[3]   CLNIC	         981441893V
            $row[4]   CLADRESS	     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[5]   VMAKE	         BAJAJ
            $row[6]   VMODEL	         RE 4S
            $row[7]   VENO	         275IDI05JTZ543645
            $row[8]   VCHNO	         MAT4450106RR42998
            $row[9]   SUPCODE	         61290
            $row[10]  MFYEAR	         2006
            $row[11]  SUPNAME	
            $row[12]  GUARNAME1	     Mr.G.S.A.K. AWANTHA
            $row[13]  GUARNAME2	     Ms.M.V.P.T. RASANGIKA
            $row[14]  GUARADDRESS1     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[15]  GUARADDRESS2     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[16]  GUAR1_NIC	     911920590V
            $row[17]  GUAR2_NIC	     988350532V
            $row[18]  LEASETENOR	     48
            $row[19]  LUMPSUM	         197,348.00
            $row[20]  MONTHLYRENTAL	 7,397.00
            $row[21]  OD_INT	         6%  
            $row[22]  SUPPLIERDETAIL	 DAVID PIERIS MOTOR COMPANY (LANKA) LIMITED OF ITTAGALAWATTA,KAHANDAWA SOUTH,,,, RANNA
            $row[23]  BRANCH	         AVISSAWELLA
            $row[24]  COVERING	     1        
            $row[25]  JCLNIC
            $row[26]  JCLADDR
            $row[27]  LOCATION
            $row[28]  CHARGESREC_DATE
            $row[29]  SCHEME_CODE
            $row[30]  SCHEME_DESC
            $row[31]  COVERING

        */
        
            $CLCODE = $row[0];
            $FACNO = $row[1];
            $CLNAME	= $row[2];
            $CLNIC = $row[3];
            $CLADRESS = $row[4];
            $VMAKE = $row[5];
            $VMODEL = $row[6];
            $VENO = $row[7];
            $VCHNO = $row[8];
            $SUPCODE = $row[9];
            $MFYEAR = $row[10];
            $SUPNAME = $row[11];
            $GUARNAME1 = $row[12];
            $GUARNAME2 = $row[13];
            $GUARADDRESS1 = $row[14];
            $GUARADDRESS2 = $row[15];
            $GUAR1_NIC = $row[16];
            $GUAR2_NIC = $row[17];
            $LEASETENOR = $row[18];
            $LUMPSUM = $row[19];
            $MONTHLYRENTAL = $row[20];
            $OD_INT = $row[21];
            $SUPPLIERDETAIL	= $row[22];
            $BRANCH = $row[23];
            $JCLNAME = $row[24];
            $JCLNIC = $row[25];
            $JCLADDR = $row[26];
            $LOCATION = $row[27];
            $CHARGESREC_DATE = $row[28];
            $SCHEME_CODE = $row[29];
            $SCHEME_DESC = $row[30];
            $COVERING = $row[31];
            
        echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover1'> 
                <label style='position: relative;left: 350px; top: -11px; font-size: 13px;'>".$FACNO."</label>
                    </div>
                    <!-- End - 1 Page -->
                    <!-- Start - 2 Page -->
                    <div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover5'>
                    
                        
                        <label style='position: relative;left: 150px; top: 875px; font-size: 12px;'>".$CLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 880px; font-size: 12px;'>".$CLNIC."</label>
                        <label style='position: relative;left: 240px; top: 880px; font-size: 12px;'>".$CLADRESS."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 885px; font-size: 12px;'>".$JCLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 890px; font-size: 12px;'>".$JCLNIC."</label>
                        <label style='position: relative;left: 240px; top: 890px; font-size: 12px;'>".$JCLADDR."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 935px; font-size: 12px;'>".$GUARNAME1."</label><br />
                        <label style='position: relative;left: 150px; top: 940px; font-size: 12px;'>".$GUAR1_NIC."</label>
                        <label style='position: relative;left: 240px; top: 940px; font-size: 12px;'>".$GUARADDRESS1."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 995px; font-size: 12px;'>".$GUARNAME2."</label><br />
                        <label style='position: relative;left: 150px; top: 1000px; font-size: 12px;'>".$GUAR2_NIC."</label>
                        <label style='position: relative;left: 240px; top: 1000px; font-size: 12px;'>".$GUARADDRESS2."</label><br />";
                        
              $sql_oci_select_db_2 = oci_parse($dbConn,  "SELECT * FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_VEHICLE_DETAILS('".$input_para."'))");
     
                oci_execute($sql_oci_select_db_2);
               ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
               $x = 5;
               $a = 1110;
               echo "<table>";
               while (($row_2 = oci_fetch_array($sql_oci_select_db_2, OCI_BOTH)) != false) {	//Read Oracle Source table
                /*
                 $VMAKEMODEL	   HONDA DAA-RU4 VEZEL 2014
                 $CHASI_SERIAL	   RU4-1000561
                 $ENGINE_NO	       LEB-H1-3600563
                 
                 */
                 $VMAKEMODEL = $row_2[0];
                 $CHASI_SERIAL = $row_2[1];
                 $ENGINE_NO	 = $row_2[2];
                 echo "<tr>
                            <td>
                                <label style='position: relative;left: 15px; top: ".$a."px; font-size: 12px;'>".$VMAKEMODEL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 400px; top: ".$a."px; font-size: 12px;'>".$CHASI_SERIAL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 475px; top: ".$a."px; font-size: 12px;'>".$ENGINE_NO."</label>
                            </td>
                 </tr>";
                           
                  $a += $x;

              }
              echo "</table>";
                        
                        
              echo" <label style='position: relative;left: 15px; top: 1190px; font-size: 12px;'>Manufacturer / Year of Manufacture : Refer Above ITEM (4)</label><br />
                        <label style='position: relative;left: 50px; top: 1195px; font-size: 12px;'>ITEM (5) Seller : ".$SUPPLIERDETAIL."</label><br />
                    </div>";
                    
              $sql_DO = "select MAX(DATE(s.PRNT_DATE))
                                from sps_let_batch_prnt AS s 
                                where s.BATCH_NUM = '".$input_para."';";
              $query_DO = mysqli_query($conn,$sql_DO) or die(mysqli_error($conn));
              $DO_PRINT_DATE = "";
              while($rec_DO = mysqli_fetch_array($query_DO)){
                $DO_PRINT_DATE = $rec_DO[0];
              } 
              $$MONTHLYRENTAL_FINAL = "0.00"; 
              if($COVERING == 0){
                $$MONTHLYRENTAL_FINAL = "0.00";    
              }else{
                $$MONTHLYRENTAL_FINAL = $MONTHLYRENTAL;    
              }    
              echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover6'> 
                        <label style='position: relative;left: 300px; top: -1px; font-size: 13px;'>".$CLADRESS."</label><br />
                        <label style='position: relative;left: 300px; top: 5px; font-size: 13px;'>".$DO_PRINT_DATE."</label><br />
                        <label style='position: relative;left: 110px; top: 60px; font-size: 13px;'>".$LEASETENOR."</label><br />
                        
                        <label style='position: relative;left: 75px; top: 85px; font-size: 13px;'>".$$MONTHLYRENTAL_FINAL."</label>
                        <label style='position: relative;left: 190px; top: 85px; font-size: 13px;'>".$COVERING."</label><br />
                        <label style='position: relative;left: -6px; top: 95px; font-size: 13px;'>".$LUMPSUM."</label><br />";
                        
                      /*  <label style='position: relative;left: 55px; top: 105px; font-size: 13px;'>".$LEASETENOR."</label>
                        <label style='position: relative;left: 220px; top: 105px; font-size: 13px;'>".$MONTHLYRENTAL."</label><br />*/
                        $sql_oci_select_db_3 = oci_parse($dbConn,  "SELECT * FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.GET_RENTAL_SHEDULE('".$input_para."'))DUAL");
     
                        oci_execute($sql_oci_select_db_3);
                       ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
                       $y = 5;
                       $b = 140;
                       echo "<table>";
                       while (($row_3 = oci_fetch_array($sql_oci_select_db_3, OCI_BOTH)) != false) {	//Read Oracle Source table
                       
                            /*
                                V_SERIAL_NO	    1
                                V_FROM_DATE	    07/03/2019
                                V_TO_DATE	    07/01/2020
                                V_NO_OF_RNT	    11
                                V_RNT_VALUE	    75433

                            */
                             $V_SERIAL_NO = $row_3[0];
                             $V_FROM_DATE = $row_3[1];
                             $V_TO_DATE	= $row_3[2];
                             $V_NO_OF_RNT = $row_3[3];
                             $V_RNT_VALUE = $row_3[4];
                             echo "<tr>
                                        <td>
                                            <label style='position: relative;left: 10px; top: ".$b."px; font-size: 12px;'>".$V_SERIAL_NO."</label>
                                        </td>
                                        <td>
                                            <label style='position: relative;left: 100px; top: ".$b."px; font-size: 12px;'>".$V_FROM_DATE."</label>
                                        </td>
                                        <td>
                                            <label style='position: relative;left: 250px; top: ".$b."px; font-size: 12px;'>".$V_TO_DATE."</label>
                                        </td>
                                        <td>
                                            <label style='position: relative;left: 400px; top: ".$b."px; font-size: 12px;'>".$V_NO_OF_RNT."</label>
                                        </td>
                                        <td>
                                            <label style='position: relative;left: 550px; top: ".$b."px; font-size: 12px;'>".$V_RNT_VALUE."</label>
                                        </td>
                             </tr>";
                                       
                              $b += $y;
                       }
                       echo "</table>";
                       echo "<label style='position: relative;left: 390px; top: 270px; font-size: 13px;'>".$OD_INT."</label><br />
                        
                        <label style='position: relative;left: 710px; top: 380px; font-size: 13px;'>".$LOCATION."</label><br />
                        <label style='position: relative;left: 400px; top: 385px; font-size: 13px;'>". date_format($date,"dS")." day of ".date_format($date,"F Y")."</label><br />";
                      
                       
                       $SQL_MKR = "SELECT ch.enterBy AS MKR_OFFICER_HRIS ,
                                          u.userID AS MKR_OFFICER_NAME,
                                          u.NIC AS MKR_OFFICER_NIC
                                    FROM cdb_helpdesk AS ch , user AS u
                                    WHERE ch.cat_code = 1014
                                       AND ch.facno = '".$input_para."'
                                       AND ch.enterBy = u.userName ;"; 
                       $MKR_OFFICER_HRIS = " - ";
                       $MKR_OFFICER_NAME = " - ";
                       $MKR_OFFICER_NIC = " - ";
                       $MKR_ADDRESS = " - ";
                       $QUERY_MKR = mysqli_query($conn,$SQL_MKR) or die(mysqli_error($conn));
                       while ($RESALT_MKR = mysqli_fetch_array($QUERY_MKR)){
                            $MKR_OFFICER_HRIS = $RESALT_MKR[0];
                            $MKR_OFFICER_NAME = $RESALT_MKR[1];
                            $MKR_OFFICER_NIC = $RESALT_MKR[2];
                       }
                       
                       $SQL_PRINT_DTL = "SELECT u.userID AS PRINT_USER_NAME,
                                               u.NIC AS PRINT_USER_NIC
                                        FROM  user AS u
                                        WHERE u.userName = '".$PrintUser."';";
                       $PRINT_BY_NAME = " - ";
                       $PRINT_BY_HRIS = " - ";
                       $PRINT_BY_ADDRESS = " - ";
                       $QUERY_PRINT_DTL = mysqli_query($conn,$SQL_PRINT_DTL) or die(mysqli_error($conn));
                       while ($RESALT_PRINT_DTL = mysqli_fetch_array($QUERY_PRINT_DTL)){
                            $PRINT_BY_HRIS = $PrintUser;
                            $PRINT_BY_NAME = $RESALT_PRINT_DTL[0];
                            $PRINT_BY_NIC = $RESALT_PRINT_DTL[1];
                       }
                      
                      
                    echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 480px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 480px; font-size: 13px;'>".$CLNAME."</label>
                                </td>
                             </tr>
                             <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 485px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 485px; font-size: 13px;'>".$CLNIC."</label>
                                </td>
                             </tr>
                        </table>";
                        echo "<table>
                                <tr>
                                <td>                 
                                    <label style='position: relative;left: -3px; top: 490px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 490px; font-size: 13px;'>".$CLADRESS."</label>
                                </td>
                             </tr>
                            </table>";
                            
                         echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 530px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 530px; font-size: 13px;'>".$JCLNAME."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 535px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 535px; font-size: 13px;'>".$JCLNIC."</label>
                                </td>
                            </tr>
                           </table>";
                         echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 540px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 540px; font-size: 13px;'>".$JCLADDR."</label>
                                </td>
                            </tr>
                            </table>";
                                           
              
                      echo "<table>
                            <tr>
                                <td>    
                                    <label style='position: relative;left: -3px; top: 600px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 600px; font-size: 13px;'>".$GUARNAME1."</label>
                                </td>
                                <td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 605px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 605px; font-size: 13px;'>".$GUAR1_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                            echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 610px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 610px; font-size: 13px;'>".$GUARADDRESS1."</label>
                                </td>
                            </tr>
                        </table> ";
                        
                     echo " <table>
                            <tr>
                                <td>                
                                    <label style='position: relative;left: -3px; top: 650px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 650px; font-size: 13px;'>".$GUARNAME2."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 655px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 655px; font-size: 13px;'>".$GUAR2_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                     echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 660px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 450px; top: 660px; font-size: 13px;'>".$GUARADDRESS2."</label>
                                 </td>
                            </tr>
                        </table>";
                       
                       $date_CHARGESREC_DATE = date_create($CHARGESREC_DATE);
                    echo " <label style='position: relative;left: 200px; top: 710px; font-size: 13px;'>". date_format($date_CHARGESREC_DATE,"dS")." day of ".date_format($date_CHARGESREC_DATE,"F Y")."</label><br />
                    </div>
                 ";
        }
  }
  
  function getPrintLeaseAgreementCorporate($dbConn,$fac_number,$PrintUser,$get_date){
    $conn = DatabaseConnection();
    //echo  "Corporate";
        //----- Inert Into Table
    date_default_timezone_set('Asia/Colombo');
     //echo $fac_number ." - " . $PrintUser;
    //----- Start Update DB
    mysqli_autocommit($conn,FALSE);
    try{
            $input_para = $fac_number;
            $serial_no = "";
            $sql_insert = "INSERT INTO `sps_general_letter_gen_print`(`let_id`, `input_para`, `serial_no`, `print_by`) 
                                                    VALUES (1,'".$input_para."','".$serial_no."','".$PrintUser."');";
            //echo $sql_insert;                                        
            //$que_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error());

           
           mysqli_commit($conn);
     }catch(Exception $e){
                // Rollback transaction
                mysqli_rollback($conn);
                echo 'Message: ' .$e->getMessage();
                
     }
     //echo "I OK";
     
     $date   =  date_create($get_date);
     $sql_oci_select_db = oci_parse($dbConn, "SELECT *  FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_lseAGR_data('".$input_para."'))");
     
     oci_execute($sql_oci_select_db);
     $i = 1;
     ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    
     while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
        /*
            $row[0]   CLCODE	         532853
            $row[1]   FACNO	         '006500532853050102
            $row[2]   CLNAME	         Mr. RUPASINGHA ARACHCHIGE DON VIRAJ  LAKSHITHA
            $row[3]   CLNIC	         981441893V
            $row[4]   CLADRESS	     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[5]   VMAKE	         BAJAJ
            $row[6]   VMODEL	         RE 4S
            $row[7]   VENO	         275IDI05JTZ543645
            $row[8]   VCHNO	         MAT4450106RR42998
            $row[9]   SUPCODE	         61290
            $row[10]  MFYEAR	         2006
            $row[11]  SUPNAME	
            $row[12]  GUARNAME1	     Mr.G.S.A.K. AWANTHA
            $row[13]  GUARNAME2	     Ms.M.V.P.T. RASANGIKA
            $row[14]  GUARADDRESS1     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[15]  GUARADDRESS2     NO 295/C,AMBEMULLA,,,, GETAHETTA
            $row[16]  GUAR1_NIC	     911920590V
            $row[17]  GUAR2_NIC	     988350532V
            $row[18]  LEASETENOR	     48
            $row[19]  LUMPSUM	         197,348.00
            $row[20]  MONTHLYRENTAL	 7,397.00
            $row[21]  OD_INT	         6%  
            $row[22]  SUPPLIERDETAIL	 DAVID PIERIS MOTOR COMPANY (LANKA) LIMITED OF ITTAGALAWATTA,KAHANDAWA SOUTH,,,, RANNA
            $row[23]  BRANCH	         AVISSAWELLA
            $row[24]  COVERING	     1        
            $row[25]  JCLNIC
            $row[26]  JCLADDR
            $row[27]  LOCATION
            $row[28]  CHARGESREC_DATE
            $row[29]  SCHEME_CODE
            $row[30]  SCHEME_DESC
            $row[31]  COVERING

        */
        
            $CLCODE = $row[0];
            $FACNO = $row[1];
            $CLNAME	= $row[2];
            $CLNIC = $row[3];
            $CLADRESS = $row[4];
            $VMAKE = $row[5];
            $VMODEL = $row[6];
            $VENO = $row[7];
            $VCHNO = $row[8];
            $SUPCODE = $row[9];
            $MFYEAR = $row[10];
            $SUPNAME = $row[11];
            $GUARNAME1 = $row[12];
            $GUARNAME2 = $row[13];
            $GUARADDRESS1 = $row[14];
            $GUARADDRESS2 = $row[15];
            $GUAR1_NIC = $row[16];
            $GUAR2_NIC = $row[17];
            $LEASETENOR = $row[18];
            $LUMPSUM = $row[19];
            $MONTHLYRENTAL = $row[20];
            $OD_INT = $row[21];
            $SUPPLIERDETAIL	= $row[22];
            $BRANCH = $row[23];
            $JCLNAME = $row[24];
            $JCLNIC = $row[25];
            $JCLADDR = $row[26];
            $LOCATION = $row[27];
            $CHARGESREC_DATE = $row[28];
            $SCHEME_CODE = $row[29];
            $SCHEME_DESC = $row[30];
            $COVERING = $row[31];
            
        echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover1'> 
                <label style='position: relative;left: 350px; top: -11px; font-size: 13px;'>".$FACNO."</label>
                    </div>
                    <!-- End - 1 Page -->
                    <!-- Start - 2 Page -->
                    <div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover5'>
                    
                        
                        <label style='position: relative;left: 150px; top: 875px; font-size: 12px;'>".$CLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 880px; font-size: 12px;'>".$CLNIC."</label>
                        <label style='position: relative;left: 240px; top: 880px; font-size: 12px;'>".$CLADRESS."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 885px; font-size: 12px;'>".$JCLNAME."</label><br />
                        <label style='position: relative;left: 150px; top: 890px; font-size: 12px;'>".$JCLNIC."</label>
                        <label style='position: relative;left: 240px; top: 890px; font-size: 12px;'>".$JCLADDR."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 935px; font-size: 12px;'>".$GUARNAME1."</label><br />
                        <label style='position: relative;left: 150px; top: 940px; font-size: 12px;'>".$GUAR1_NIC."</label>
                        <label style='position: relative;left: 240px; top: 940px; font-size: 12px;'>".$GUARADDRESS1."</label><br />
                        
                        <label style='position: relative;left: 150px; top: 995px; font-size: 12px;'>".$GUARNAME2."</label><br />
                        <label style='position: relative;left: 150px; top: 1000px; font-size: 12px;'>".$GUAR2_NIC."</label>
                        <label style='position: relative;left: 240px; top: 1000px; font-size: 12px;'>".$GUARADDRESS2."</label><br />";
                        
              $sql_oci_select_db_2 = oci_parse($dbConn,  "SELECT * FROM TABLE(cdbproddb.CDB_PKG_LEASE_AGREEMENT.get_VEHICLE_DETAILS('".$input_para."'))");
     
                oci_execute($sql_oci_select_db_2);
               ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
               $x = 5;
               $a = 1110;
               echo "<table>";
               while (($row_2 = oci_fetch_array($sql_oci_select_db_2, OCI_BOTH)) != false) {	//Read Oracle Source table
                /*
                 $VMAKEMODEL	   HONDA DAA-RU4 VEZEL 2014
                 $CHASI_SERIAL	   RU4-1000561
                 $ENGINE_NO	       LEB-H1-3600563
                 
                 */
                 $VMAKEMODEL = $row_2[0];
                 $CHASI_SERIAL = $row_2[1];
                 $ENGINE_NO	 = $row_2[2];
                 echo "<tr>
                            <td>
                                <label style='position: relative;left: 15px; top: ".$a."px; font-size: 12px;'>".$VMAKEMODEL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 400px; top: ".$a."px; font-size: 12px;'>".$CHASI_SERIAL."</label>
                            </td>
                            <td>
                                <label style='position: relative;left: 475px; top: ".$a."px; font-size: 12px;'>".$ENGINE_NO."</label>
                            </td>
                 </tr>";
                           
                  $a += $x;

              }
              echo "</table>";
                        
                        
              echo" <label style='position: relative;left: 15px; top: 1190px; font-size: 12px;'>Manufacturer / Year of Manufacture : Refer Above ITEM (4)</label><br />
                        <label style='position: relative;left: 50px; top: 1195px; font-size: 12px;'>ITEM (5) Seller : ".$SUPPLIERDETAIL."</label><br />
                    </div>";
                    
              $sql_DO = "select MAX(DATE(s.PRNT_DATE))
                                from sps_let_batch_prnt AS s 
                                where s.BATCH_NUM = '".$input_para."';";
              $query_DO = mysqli_query($conn,$sql_DO) or die(mysqli_error($conn));
              $DO_PRINT_DATE = "";
              while($rec_DO = mysqli_fetch_array($query_DO)){
                $DO_PRINT_DATE = $rec_DO[0];
              } 
              $$MONTHLYRENTAL_FINAL = "0.00"; 
              if($COVERING == 0){
                $$MONTHLYRENTAL_FINAL = "0.00";    
              }else{
                $$MONTHLYRENTAL_FINAL = $MONTHLYRENTAL;    
              }    
              echo "<div style='page-break-after: always;font-family: sans; font-size: 12px;' id='cover6'> 
                        <label style='position: relative;left: 300px; top: -1px; font-size: 13px;'>".$CLADRESS."</label><br />
                        <label style='position: relative;left: 300px; top: 5px; font-size: 13px;'>".$DO_PRINT_DATE."</label><br />
                        <label style='position: relative;left: 110px; top: 60px; font-size: 13px;'>".$LEASETENOR."</label><br />
                        
                        <label style='position: relative;left: 75px; top: 85px; font-size: 13px;'>".$$MONTHLYRENTAL_FINAL."</label>
                        <label style='position: relative;left: 190px; top: 85px; font-size: 13px;'>".$COVERING."</label><br />
                        <label style='position: relative;left: -6px; top: 95px; font-size: 13px;'>".$LUMPSUM."</label><br />
                        <label style='position: relative;left: 55px; top: 105px; font-size: 13px;'>".$LEASETENOR."</label>
                        <label style='position: relative;left: 220px; top: 105px; font-size: 13px;'>".$MONTHLYRENTAL."</label><br />
                        
                        <label style='position: relative;left: 390px; top: 170px; font-size: 13px;'>".$OD_INT."</label><br />
                        
                        <label style='position: relative;left: 710px; top: 280px; font-size: 13px;'>".$LOCATION."</label><br />
                        <label style='position: relative;left: 400px; top: 285px; font-size: 13px;'>". date_format($date,"dS")." day of ".date_format($date,"F Y")."</label><br />";
                      
                       
                       $SQL_MKR = "SELECT ch.enterBy AS MKR_OFFICER_HRIS ,
                                          u.userID AS MKR_OFFICER_NAME,
                                          u.NIC AS MKR_OFFICER_NIC
                                    FROM cdb_helpdesk AS ch , user AS u
                                    WHERE ch.cat_code = 1014
                                       AND ch.facno = '".$input_para."'
                                       AND ch.enterBy = u.userName ;"; 
                       $MKR_OFFICER_HRIS = " - ";
                       $MKR_OFFICER_NAME = " - ";
                       $MKR_OFFICER_NIC = " - ";
                       $MKR_ADDRESS = " - ";
                       $QUERY_MKR = mysqli_query($conn,$SQL_MKR) or die(mysqli_error($conn));
                       while ($RESALT_MKR = mysqli_fetch_array($QUERY_MKR)){
                            $MKR_OFFICER_HRIS = $RESALT_MKR[0];
                            $MKR_OFFICER_NAME = $RESALT_MKR[1];
                            $MKR_OFFICER_NIC = $RESALT_MKR[2];
                       }
                       
                       $SQL_PRINT_DTL = "SELECT u.userID AS PRINT_USER_NAME,
                                               u.NIC AS PRINT_USER_NIC
                                        FROM  user AS u
                                        WHERE u.userName = '".$PrintUser."';";
                       $PRINT_BY_NAME = " - ";
                       $PRINT_BY_HRIS = " - ";
                       $PRINT_BY_ADDRESS = " - ";
                       $QUERY_PRINT_DTL = mysqli_query($conn,$SQL_PRINT_DTL) or die(mysqli_error($conn));
                       while ($RESALT_PRINT_DTL = mysqli_fetch_array($QUERY_PRINT_DTL)){
                            $PRINT_BY_HRIS = $PrintUser;
                            $PRINT_BY_NAME = $RESALT_PRINT_DTL[0];
                            $PRINT_BY_NIC = $RESALT_PRINT_DTL[1];
                       }
                      
                      
                    echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 380px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 380px; font-size: 13px;'>".$CLNAME."</label>
                                </td>
                             </tr>
                             <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 385px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 385px; font-size: 13px;'>".$CLNIC."</label>
                                </td>
                             </tr>
                        </table>";
                        echo "<table>
                                <tr>
                                <td>                 
                                    <label style='position: relative;left: -3px; top: 390px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 390px; font-size: 13px;'>".$CLADRESS."</label>
                                </td>
                             </tr>
                            </table>";
                            
                         echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 430px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 430px; font-size: 13px;'>".$JCLNAME."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 435px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 435px; font-size: 13px;'>".$JCLNIC."</label>
                                </td>
                            </tr>
                           </table>";
                         echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 440px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 440px; font-size: 13px;'>".$JCLADDR."</label>
                                </td>
                            </tr>
                            </table>";
                                           
              
                      echo "<table>
                            <tr>
                                <td>    
                                    <label style='position: relative;left: -3px; top: 500px; font-size: 13px;'>".$MKR_OFFICER_NAME." - ".$MKR_OFFICER_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 500px; font-size: 13px;'>".$GUARNAME1."</label>
                                </td>
                                <td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 505px; font-size: 13px;'>".$MKR_OFFICER_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 350px; top: 505px; font-size: 13px;'>".$GUAR1_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                            echo "<table>
                            <tr>
                                <td>      
                                    <label style='position: relative;left: -3px; top: 510px; font-size: 13px;'>".$MKR_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 390px; top: 510px; font-size: 13px;'>".$GUARADDRESS1."</label>
                                </td>
                            </tr>
                        </table> ";
                        
                     echo " <table>
                            <tr>
                                <td>                
                                    <label style='position: relative;left: -3px; top: 550px; font-size: 13px;'>".$PRINT_BY_NAME." - ".$PRINT_BY_HRIS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 550px; font-size: 13px;'>".$GUARNAME2."</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 555px; font-size: 13px;'>".$PRINT_BY_NIC."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 420px; top: 555px; font-size: 13px;'>".$GUAR2_NIC."</label>
                                 </td>
                            </tr>
                            </table>";
                     echo "<table>
                            <tr>
                                <td>
                                    <label style='position: relative;left: -3px; top: 560px; font-size: 13px;'>".$PRINT_BY_ADDRESS."</label>
                                </td>
                                <td>
                                    <label style='position: relative;left: 450px; top: 560px; font-size: 13px;'>".$GUARADDRESS2."</label>
                                 </td>
                            </tr>
                        </table>";
                       
                       $date_CHARGESREC_DATE = date_create($CHARGESREC_DATE);
                    echo " <label style='position: relative;left: 200px; top: 610px; font-size: 13px;'>". date_format($date_CHARGESREC_DATE,"dS")." day of ".date_format($date_CHARGESREC_DATE,"F Y")."</label><br />
                    </div>
                 ";
        }
  }



//********************************************** Funtion DDPO *******************************
function getPrint_DDPO_RePrited($loguser,$JOB_DATE,$LOAD_JOB,$PRINT_JOB,$dbConn){
    //echo "BEGIN cdbproddb.pkg_mycdb_ddpo.DDPO_PRINT_UNION_CANCEL('".$JOB_DATE."',".$LOAD_JOB.",".$PRINT_JOB."); END;";
    
    $v_sql = oci_parse($dbConn, "BEGIN cdbproddb.pkg_mycdb_ddpo.DDPO_PRINT_UNION_CANCEL('".$JOB_DATE."',".$LOAD_JOB.",".$PRINT_JOB."); END;");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);  
    //$i = 1;
    //ini_set('max_execution_time', 72000); //300 seconds = 5 minutes 
    
    $sql_oci_select_db = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.show_DDPO_gen_head('".$JOB_DATE."'))");
    /*
        V_JOB_DATE	     18-JUL-18
        V_LOAD_JOB	     1
        V_PRINT_JOB	     1
        V_PRINT_STAT	 A
        V_PRINT_BY	     SSYS
        V_PRINT_DATE	 17-AUG-18
    */
    oci_execute($sql_oci_select_db);
    $i = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    echo "
     <span style='margin-left: 50px;'>DDPO Generated</span><br/><br/>
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>JOB DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>LOAD JOB</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>PRINT JOB</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT STAT</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT BY</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT DATE</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'></span></td>
                </tr>";
    while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
            
           echo "<tr id='tr".$i."' title='".$i."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row[0]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[1]."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row[2]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[3]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[4]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[5]."</span></td> 
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;' id='sp_load_link_main'>
                        <a class='isLinkApprove' href='#' title='".$JOB_DATE."|".$row[1]."|".$row[2]."' onclick='isPrint(title);'>Print</a>
                    </span></td>
                </tr>";
            
        $i++; 
    }
    echo "</table><br/><hr/>";
    
   
     echo "<div id='perited_head'>";
     $sql_oci_select_recall = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.show_DDPO_prn_head('".$JOB_DATE."'))");
    /*
        V_JOB_DATE	     18-JUL-18
        V_LOAD_JOB	     1
        V_PRINT_JOB	     1
        V_PRINT_STAT	 A
        V_PRINT_BY	     SSYS
        V_PRINT_DATE	 17-AUG-18
    */
    oci_execute($sql_oci_select_recall);
    $x = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
     echo "<span style='margin-left: 50px;'>DDPO Printted<span/><br/><br/>
     <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>JOB DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>LOAD JOB</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>PRINT JOB</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT STAT</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT BY</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
                </tr>";
    while (($row1 = oci_fetch_array($sql_oci_select_recall, OCI_BOTH)) != false) {	//Read Oracle Source table
         
           echo "<tr id='tr".$x."' title='".$x."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[0]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[1]."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[2]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[3]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[4]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[5]."</span></td> 
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnPrint' id='btnPrint' value='Print Cancel' title='".$JOB_DATE."|".$row1[1]."|".$row1[2]."' onclick='isPrintCancel(title);'/>
                    </span></td>
                </tr>";
            
        $x++; 
    }
    echo "</table>";
    echo "</div>";
}
function getPrint_DDPO($loguser,$JOB_DATE,$LOAD_JOB,$PRINT_JOB,$dbConn){
    $v_sql = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.DDPO_PRINT_UNION('".$JOB_DATE."',".$LOAD_JOB.",".$PRINT_JOB."))");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);  
    $i = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes 
     $txtName = uniqid();
     $myfile = fopen("../../../../temp/".$txtName.".txt", "wb") or die("Unable to open file!"); // Craete the file handle
     while (($row = oci_fetch_array($v_sql, OCI_BOTH)) != false) {	//Read Oracle Source table
        //echo $row[0]."<br/>";
        $txt = $row[0].PHP_EOL;
        fwrite($myfile, $txt);
       
     }
     fclose($myfile); // Closing Text file
 
    // - Downloader force to user
    /*header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/newfile.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/newfile.txt'));
    readfile('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/newfile.txt');*/
    //exit;
   // echo "<a href='http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/newfile.txt' target='_blank'> get Text File</a>";
   //echo "<a href='data:text/plain;charset=UTF-8,Hello%20World!' download='newfile.txt'>Download (static)</a>";
   echo "Printed | <a id='programatically' href='../../../temp/".$txtName.".txt' download='".$txtName.".txt'>Download</a>";
    //exit;
    
}

function getPage_DDPO($requestDate,$dbConn){
    //echo $requestDate." OK"
    
    $sql_oci_select_db = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.show_DDPO_gen_head('".$requestDate."'))");
    /*
        V_JOB_DATE	     18-JUL-18
        V_LOAD_JOB	     1
        V_PRINT_JOB	     1
        V_PRINT_STAT	 A
        V_PRINT_BY	     SSYS
        V_PRINT_DATE	 17-AUG-18
    */
    oci_execute($sql_oci_select_db);
    $i = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    echo "
     <span style='margin-left: 50px;'>DDPO Generated</span><br/><br/>
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>JOB DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>LOAD JOB</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>PRINT JOB</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT STAT</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT BY</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT DATE</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'></span></td>
                </tr>";
    while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
            
           echo "<tr id='tr".$i."' title='".$i."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row[0]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[1]."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row[2]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[3]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[4]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row[5]."</span></td> 
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;' id='sp_load_link_main'>
                        <a class='isLinkApprove' href='#' title='".$requestDate."|".$row[1]."|".$row[2]."' onclick='isPrint(title);'>Print</a>
                    </span></td>
                </tr>";
            
        $i++; 
    }
    echo "</table><br/><hr/>";
    
   
     echo "<div id='perited_head'>";
     $sql_oci_select_recall = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.show_DDPO_prn_head('".$requestDate."'))");
    /*
        V_JOB_DATE	     18-JUL-18
        V_LOAD_JOB	     1
        V_PRINT_JOB	     1
        V_PRINT_STAT	 A
        V_PRINT_BY	     SSYS
        V_PRINT_DATE	 17-AUG-18
    */
    oci_execute($sql_oci_select_recall);
    $x = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
     echo "<span style='margin-left: 50px;'>DDPO Printted<span/><br/><br/>
     <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>JOB DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>LOAD JOB</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>PRINT JOB</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT STAT</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT BY</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
                </tr>";
    while (($row1 = oci_fetch_array($sql_oci_select_recall, OCI_BOTH)) != false) {	//Read Oracle Source table
         
           echo "<tr id='tr".$x."' title='".$x."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[0]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[1]."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[2]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[3]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[4]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[5]."</span></td> 
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnPrint' id='btnPrint' value='Print Cancel' title='".$requestDate."|".$row1[1]."|".$row1[2]."' onclick='isPrintCancel(title);'/>
                    </span></td>
                </tr>";
            
        $x++; 
    }
    echo "</table>";
    echo "</div>";
    
}

function getPage_PrintedDDPO($requestDate,$dbConn){
    $sql_oci_select_recall = oci_parse($dbConn, "select * from table(cdbproddb.pkg_mycdb_ddpo.show_DDPO_prn_head('".$requestDate."'))");
    /*
        V_JOB_DATE	     18-JUL-18
        V_LOAD_JOB	     1
        V_PRINT_JOB	     1
        V_PRINT_STAT	 A
        V_PRINT_BY	     SSYS
        V_PRINT_DATE	 17-AUG-18
    */
    oci_execute($sql_oci_select_recall);
    $x = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
     echo "<span style='margin-left: 50px;'>DDPO Printted<span/><br/><br/>
     <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>JOB DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>LOAD JOB</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>PRINT JOB</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT STAT</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT BY</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>PRINT DATE</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
                </tr>";
    while (($row1 = oci_fetch_array($sql_oci_select_recall, OCI_BOTH)) != false) {	//Read Oracle Source table
         
           echo "<tr id='tr".$x."' title='".$x."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:50px; text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[0]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[1]."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$row1[2]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[3]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[4]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$row1[5]."</span></td> 
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>
                        <input class='buttonManage' style='width: 100px;' type='button' name='btnPrint' id='btnPrint' value='Print Cancel' title='".$requestDate."|".$row1[1]."|".$row1[2]."' onclick='isPrintCancel(title);'/>
                    </span></td>
                </tr>";
            
        $x++; 
    }
    echo "</table>";
}

//********************************************** Function Prossess_Letter_Generation ************************************************************
function cbl05Letter_Generation($get_LetterTypeCode_cbl,$get_User_cbl,$U_type_cbl,$txt_u_defiend_cbl,$dbConn){
  //  echo $get_LetterTypeCode_cbl."--".$get_User_cbl."--".$U_type_cbl."--".$txt_u_defiend_cbl;
    //------------------------------------------------------------------------------------------------------
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        
              
                $sql_oci_select_db = oci_parse($dbConn, "select * FROM TABLE(CDBPRODDB.pkg_mycdb_cashback.get_cbl_5yearexeeded_data())");
             /* 0 CB_NUMBER	        KG11T0010730
                1 CLIENT_NO	        27472
                2 CLIENT_NAME	    Mrs.M.K. PRIYADARSHIKA
                3 ACC_OPEN_DATE	    2011-11-08
                4 ADDR1
                5  ADDR2	
                6  ADDR3
                7  ADDR4	
                8  ADDR5	        E5/35 LOLGODA       MAHAPALLEGAMA
                9 LOAN_BALANCE	    -219120.56
                10 DEP_ACC_NO_1	    KGFDFD1103179603-27
                11 DEP_ACC_NO_2	
                12 DEP_AMOUNT	     1057037.5
                */
                
                oci_execute($sql_oci_select_db);
                $i = 0;
                ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
                
                $sql_int_sps_let_batch = "INSERT INTO `sps_cbl05_let_batch`(`LET_TYPE`, `BATCH_STAT`,`GEN_BY`, `GEN_DATE`, `ENTERED_BY`, `ENTERED_DATE`, `u_type`, `u_source`) 
                                                VALUES ('".$get_LetterTypeCode_cbl."','N','".$get_User_cbl."',now(),'".$get_User_cbl."',now(),'".$U_type_cbl."','".$txt_u_defiend_cbl."');";
                //echo $sql_int_sps_let_batch."<br/>";
                
                $que_int_sps_let_batch = mysqli_query($conn,$sql_int_sps_let_batch) or die(mysqli_error($conn));
                 $sql_sps_max_batch = "select max(BATCH_NUM) from sps_cbl05_let_batch;";
                 $que_sps_max_batch = mysqli_query($conn,$sql_sps_max_batch) or die(mysqli_error($conn));
                 $batchnumber = 0;
                 while ($row1 = mysqli_fetch_array($que_sps_max_batch)){
                   $batchnumber =  $row1[0];
                    
                 }
                // echo "<br/><br/><br/>".$batchnumber."<br/><br/><br/>";
                if($batchnumber != 0){
                    while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
                    $i++;
                    
                 //   echo $row[0]. " - " . $row[1]. " - ". $row[2]. " - " . $row[3]. " - ". $row[4]. " - ". $row[4]. " - ". $row[5]. " - ". $row[6]. " - ". $row[7]." - ". $row[8]."<br/>";
                   
                  
                       $sql_insert_sps_cbl05_gen = "INSERT INTO `sps_cbl05_gen`(`LET_TYPE`, `BATCH_NUM`, `ENTRY_SER`, `CB_NUMBER`, `CLIENT_NO`, `CLIENT_NAME`, `ACC_OPEN_DATE`,`ADDR1`,`ADDR2`,`ADDR3`,`ADDR4`,`ADDR5`,`LOAN_BALANCE`,`DEP_ACC_NO_1`,`DEP_ACC_NO_2`,`DEP_AMOUNT`,`ENTERED_BY`,`ENTERED_DATE`,`print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`) 
                                                                     VALUES ('".$get_LetterTypeCode_cbl."','".$batchnumber."','".$i."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".TRIM($row[4])."','".TRIM($row[5])."','".TRIM($row[6])."','".TRIM($row[7])."','".TRIM($row[8])."','".ABS($row[9])."','".$row[10]."','".$row[11]."','".$row[12]."','".$get_User_cbl."',now(),'0','SYSTEM', NOW() ,'', '0000-00-00 00:00:00');";
                       //echo  $sql_insert_sps_cbl05_gen."<br/>";
                       $que_insert_sps_let_gen = mysqli_query($conn,$sql_insert_sps_cbl05_gen) or die(mysqli_error($conn));
                    }
                    
                    $sql_update_batch = "update sps_cbl05_let_batch c
                                            set c.No_of_entries = ".$i."
                                            where c.BATCH_NUM = ".$batchnumber.";";
                    $que_update_batch = mysqli_query($conn,$sql_update_batch) or die(mysqli_error($conn));
                    
                } else{
                    echo "B Error";
                }

               
                
                echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Num. of Entries</span></td>
                </tr>
                <tr id='tr".$i."' title='".$i."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$get_LetterTypeCode_cbl."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$batchnumber."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$get_User_cbl."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$i."</span></td>
                </tr>
            </table>";
            // mysqli_commit($conn);
            //echo "Record Saved Success."
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
         mysqli_commit($conn);
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
    //---------------------------------------------------------------------------------------------------------------------
    
}






//****************************************** Renewal Letter Generation ********************************************************************************

function isSelect_Prossess_Letter_Generation($get_LetterTypeCode,$get_date,$get_User,$dbConn,$d_date,$txt_u_defiend,$U_type){
    
    // echo $get_LetterTypeCode."--".$get_date."--".$get_User."--".$d_date;
    // Set autocommit to off
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        $sql_get_det = "SELECT COUNT(*) FROM `sps_let_batch` WHERE `LET_TYPE` = '".$get_LetterTypeCode."' AND `MAT_DATE` = '".$d_date."';";
        //echo $sql_get_det;
        $que_get_det = mysqli_query($conn,$sql_get_det) or die(mysqli_error());
        while($rec_get_det = mysqli_fetch_array($que_get_det)){
            $cou_get_det = $rec_get_det[0];
        }
        if($cou_get_det == 0){
            $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
            $add = mysqli_query($conn,$sql);
            while ($rec = mysqli_fetch_array($add)){
                $_SESSION['CURRENT_DATE'] = $rec[0];
            }
            $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
            $sqlFunction ="SELECT GetNextSerial('m7',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
            $quary_Function = mysqli_query($conn,$sqlFunction);
            while ($rec_Function = mysqli_fetch_array($quary_Function)){
                $batch_num = $rec_Function[0]; 
            }
            $getYe =  substr($Current_Year,2);
            $batchNum = $getYe.str_pad($batch_num, 6, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
            $sql_oci_select_db = oci_parse($dbConn, "SELECT mis.*,to_char(mis.NES_DEP_MATDATE,'YYYY-MM-DD') FROM TABLE(CDBPRODDB.PKG_CDB_COMMON_INTERNAL.FN_GETMATURITYLIST(1,'".$get_date."')) mis");
                /*
                0	FACNUM_NUM
                1	DEPACC_NUM
                2	CONTNUM
                3	MAT_DATE
                4	DDATE
                5	CL_NAME_1
                6	CL_NIC_1
                7	LET_ADD
                8	CL_NAME_2
                9	CL_NIC_2
                10	CERT_NUM
                11	DEP_AMT 
                12	INT_RATE
                13	TOT_INT_AMT 
                14	INT_ALREADY_PAID 
                15	WHT_DEDUCTED 
                16	INT_ADDED_TO_DEP 
                17	OTHER_AJD 
                18	NEW_DEP_NUM
                19	NEW_DEP_AMT NEW_DEP_AMT
                20	NEW_DEP_RATE
                21	NEW_DEP_PERIOD
                22	NES_DEP_MATDATE
                */
                
                //$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
            oci_execute($sql_oci_select_db);
            $i = 0;
                //echo "Staring to echo";
                // echo $sql_oci_select_db;
            ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
            while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
                $i++;
                $sql_select_sig = "SELECT `SIG_GRPCODE` FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = 'RLET' AND `AMT_FROM` <= ".$row[11]." AND `AMT_TO` >= ".$row[11].";";
                //echo $sql_select_sig."<br/>";
                $que_select_sig = mysqli_query($conn,$sql_select_sig) or die(mysqli_error());
                if(mysqli_num_rows($que_select_sig) == 0){
                    throw new Exception("No Signature group/members defined for value of " .$row[11]); 
                }
                  
                while($res_select_sig = mysqli_fetch_array($que_select_sig)){
                    $select_sig = $res_select_sig[0];
                    //echo $select_sig."<BR/>";
                }
                   
                //echo $i." ".$row[1]." ".$row[2]." ".$row[11]."<br/>";
                $var1 = $row[22];
                $date1 = str_replace('/', '-', $var1);
                //$get_date_01 = date('Y-m-d', strtotime($date));
                $get_date_01 = date('Y-m-d', strtotime($date1));
                   //----- MAdushan 2017-07-07
                  /*if(!iseet($row[9])){
                    $row[9] = "";
                   }
                   if(!iseet($row[8])){
                    $row[8] = "";
                   }
                   if(!iseet($row[10])){
                    $row[10] = "";
                   }
                   if(!iseet($row[15])){
                    $row[15] = 0.000;
                   }
                   if(!iseet($row[17])){
                    $row[17] = 0.000;
                   }*/
                   //echo $i." ".$row[1]." ".$row[2]." ".$row[11]." ".$batchNum." ".$row[9]." ".$row[8]." ".$row[10]." ".$row[15]." ".$select_sig."<br/>";
                 $sql_insert_sps_let_gen = "INSERT INTO `sps_let_gen`(`LET_TYPE`, `BATCH_NUM`, `ENTRY_SER`, `DEPOSIT_NUM`, `CONT_NUM`, `MAT_DATE`, `SIG_GRPCODE`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`, `ENTERED_BY`, `ENTERED_DATE`,`dep_amt`,`DEPACC_NUM`, `DDATE`, `CL_NAME_1`, `CL_NIC_1`, `LET_ADD`, `CL_NAME_2`, `CL_NIC_2`, `CERT_NUM`, `INT_RATE`, `TOT_INT_AMT`, `INT_ALREADY_PAID`, `WHT_DEDUCTED`, `INT_ADDED_TO_DEP`, `OTHER_AJD`, `NEW_DEP_NUM`, `NEW_DEP_AMT`, `NEW_DEP_RATE`, `NEW_DEP_PERIOD`, `NES_DEP_MATDATE`, `client_code`) 
                                                                 VALUES ('".$get_LetterTypeCode."','".$batchNum."','".$i."','".$row[0]."','".$row[2]."','".$d_date."','".$select_sig."','','0000-00-00 00:00:00','','0000-00-00 00:00:00','".$get_User."',now(),".$row[11].",'".$row[1]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."', '".$row[12]."', ".$row[13].", ".$row[14].", ".$row[15].", ".$row[16].", ".$row[17].", '".$row[18]."', ".$row[19].", '".$row[20]."', '".$row[21]."', '".$row[24]."', '".$row[23]."');";
                   //echo  $sql_insert_sps_let_gen."<br/>";
                 $que_insert_sps_let_gen = mysqli_query($conn,$sql_insert_sps_let_gen) or die(mysqli_error());
            }
            $sql_int_sps_let_batch = "INSERT INTO `sps_let_batch`(`LET_TYPE`, `BATCH_NUM`, `BATCH_STAT`, `MAT_DATE` ,`GEN_BY`, `GEN_DATE`, `ENTERED_BY`, `ENTERED_DATE`, `u_type`, `u_source`) 
                                                VALUES ('".$get_LetterTypeCode."','".$batchNum."','N','".$d_date."','".$get_User."',now(),'".$get_User."',now(),'".$U_type."','".$txt_u_defiend."');";
                //echo $sql_int_sps_let_batch."<br/>";
            $que_int_sps_let_batch = mysqli_query($conn,$sql_int_sps_let_batch) or die(mysqli_error());
            $sql_get_type = "SELECT `TYPE_DESC` FROM `sps_let_types` WHERE `TYPE_CODE` = '".$get_LetterTypeCode."';";
            $que_get_type = mysqli_query($conn,$sql_get_type);
            while($res_get_type = mysqli_fetch_array($que_get_type)){
                    $typeSig = $res_get_type[0];
            }
                echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
           	    <tr style='background-color: #BEBABA;'>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated (Date)</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Num. of Entries</span></td>
                </tr>
                <tr id='tr".$i."' title='".$i."' onmouseover='isChangeRowColoerOver(title);' onmouseout='isChangeRowColoerDown(title);'>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$typeSig."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$batchNum."</span></td>
                    <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$get_User."</span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$_SESSION['CURRENT_DATE']."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$i."</span></td>
                </tr>
               </table>"; 
            // mysqli_commit($conn);
            //echo "Record Saved Success."
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $sql_mail_gen = "SELECT urs.email,
                                   (SELECT COUNT(*)
                                    FROM `sps_let_gen` t1, `sps_let_batch` st2
                                    where st2.`LET_TYPE` = t1.`LET_TYPE`
                            							 and st2.`BATCH_NUM` = t1.`BATCH_NUM`
                            							 and st2.`BATCH_STAT` = 'N'
                            							 and t1.`BATCH_NUM` = '".$batchNum."'
                            							 and (t1.`AUTH_1_DATE` = '0000-00-00 00:00:00' OR t1.`AUTH_2_DATE` = '0000-00-00 00:00:00' ) AND t1.`dep_amt` >= slb.`AMT_FROM` AND t1.`dep_amt` <= slb.`AMT_TO`) AS Num_letters
                            										 FROM `sps_let_amt_slabs` AS slb ,`sps_sig_groups_users` AS t3 , `user` AS urs
                            										 WHERE slb.`SIG_GRPCODE` = t3.`SIG_GRPCODE`  
                            										 AND t3.`TYPE_CODE` = slb.`TYPE_CODE`
                                                                     AND t3.`TYPE_CODE` = 'RLET' 
                            										 AND t3.USER_ID = urs.userName";
            //echo $sql_mail_gen;
            $que_mail_gen = mysqli_query($conn , $sql_mail_gen);
            $getmail = "";
            while($res_mail_gen = mysqli_fetch_array($que_mail_gen)){
                if($res_mail_gen[1] != 0){
                    $getmail .= trim($res_mail_gen[0]).";";
                    //$getmail = 'wimukthi.madushan@cdb.lk';
                    echo $getmail."<br/>";
                  
                }else{
                    //echo "Can not send Mail";
                }
                
            }
            if($getmail != ""){
                
                //$getmail = "suneth.lankapura@cdb.lk;rizvi.kareem@cdb.lk;wimukthi.madushan@cdb.lk;";
                echo "<br/>sub - ".$getmail;
                $title = "Security Printing System: Authorization Notification.";
                                    //echo $title."<br/>";
                $mail = "
                Security printing entries are on hold at your authorization. 
                    
                Batch Number :  ".$batchNum."
                Maturity Date : ".$d_date;
                
                $sqli_mail_address = "SELECT esp.para_value FROM erp_sys_param AS esp WHERE esp.para_code = '4'";
                $que_mail_address = mysqli_query($conn,$sqli_mail_address);
                
                    while($res_mail_address = mysqli_fetch_array($que_mail_address)){
                        $getMail_address = $res_mail_address[0];
                    }
                    
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                		
                						// More headers
                $headers .= "From: <cdberp@cdbnet.lk>" . "\r\n";
                                //sendMail($getmail,$title,$mail,$headers);    
                //sendMailNuw($getmail,$title,$mail,$headers);
                
                $headers .= "Cc:".$getMail_address. "\r\n";
                mail(trim($getmail),$title,$mail,$headers);
            
            }else{
                echo "NOT Email";
            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }else{
            echo "<span style='margin-left: 5px;color:#E94747;'>This Date already processed.</span>";
        }
         mysqli_commit($conn);
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
}
?>