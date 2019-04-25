<?php
    
    if(isset($_REQUEST['logUser'])){
        /*echo "get User : ".$_REQUEST['logUser'];
        echo "LoanAmount : ".$_REQUEST['LoanAmount'];
        echo "LoanPeriod: ".$_REQUEST['LoanPeriod'];
        echo "InterestRate: ".$_REQUEST['InterestRate'];
        echo "VatRate : ".$_REQUEST['VatRate'];
        echo "RentalParam : ".$_REQUEST['RentalParam'];*/
        
        
        CalculateRental(trim($_REQUEST['LoanAmount']),
                        trim($_REQUEST['InterestRate']),
                        trim($_REQUEST['VatRate']),
                        trim($_REQUEST['LoanPeriod']),
                        trim($_REQUEST['RentalParam']),                       
                        trim($_REQUEST['NumDownPmt']),
                        trim($_REQUEST['IP_txt_CapChg'])
                        );
        
    }


    function CalculateRental($LOANAMOUNT,$INTEREST_RATE,$VAT_RATE,$PERIOD,$CALC_PARAMS,$DOWNPAYMENT,$CAPITALIZED_CHARGES){
        // Connect to Oracle
        $MsubType = 'P';
        if($CALC_PARAMS!="1|||")
            $MsubType = 'C';
        
        $CURRENTMON = 0;            
        $DONWP_START = 0;
        $DONWP_END = 0;    
        if($DOWNPAYMENT>0){
            $CURRENTMON = 1;
            $DONWP_START = 1;
            if($DOWNPAYMENT>1){
                $DONWP_END = $DOWNPAYMENT - 1;
            }
        }
		//echo "<BR>DONWP_START 	: ".$DONWP_START;
		//echo "<BR>DONWP_END : ".$DONWP_END;
        //echo "<BR>CURRENTMON : " .$CURRENTMON;
		//echo "<BR>CALC_PARAMS : ".$CALC_PARAMS;
		//echo "CAPITALIZED_CHARGES :". $CAPITALIZED_CHARGES;
		
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', 'Off');
        $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = cdbprod)))"; // Connect to an Oracle SERVER .
        $OracleConn = oci_connect('cdberp','cdberp',$dbstr1);  // Connect to an Oracle database.
        date_default_timezone_set("Asia/Calcutta"); // get the time Zone.
        if(!$OracleConn){
        	$err = ocierror();
        	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
         	echo "Connection failed.".$err['message'];
        	exit;
        }else {
            //Calculate the rentla   // PKG_EMI_CALC_NEW.FN_GET_FINAL_CLBAL_NEW    
            $SQL = "SELECT ROWNUM         AS RENTAL_NO,
                           v_repaydt      AS DUE_DATE, 
                           V_PRINCIPAL    AS PRINCIPAL, 
                           V_INTEREST     AS INTEREST, 
                           V_INSTALL      AS NET_RENTAL,       
                           V_VAT_ON_RENT  AS VAT, 
                           V_CHG_AMT      AS CHARGE_AMT,  
                           V_INST_WITHVAT AS GROSS_RENTAL,       
                           V_CL_BAL       AS CLOSING_BAL 
                    FROM TABLE (CDBPRODDB.PKG_CDB_ERPEMI.CREATE_RENTAL_SCHEDULE('LKR' ," 					/*P_CURR				*/
																				.$LOANAMOUNT.				/*P_LOAN_AMT			*/
																				",0,".						/*P_BK_VAT_AMT 			*/
																				"0,"						/*P_RESIDUAL_VAL		*/
																				.$INTEREST_RATE.			/*P_INT_RATE 			*/
																				",0,".						/*P_INT_QUANTUM 		*/
																				"0,"						/*P_SRVC_TAX_RATE 		*/
																				.$VAT_RATE.					/*P_VAT_RATE 			*/
																				",".$PERIOD.","  			/*P_TENOR 				*/
																			    .$DONWP_START.				/*P_DOWN_PAYMENT_FRONT	*/
																				",1,".						/*P_CALC_OPT 			*/
																				"1,".						/*P_INT_BASIS 			*/
																				"TO_CHAR(sysdate ,'DD/MM/YYYY'),". /*P_DISBDT 		*/
                                                                                $CURRENTMON.				/*P_REPAY_CURR_NEXT_MON */
																				",'F',".					/*P_REPAYDT_OPT 		*/
																				"TO_CHAR(sysdate,'DD'),".	/*P_REPAY_DAY 			*/			
																				"'D',".						/*P_DIMN_FLAT 			*/
																				"'L',".						/*P_EMI_BASED_ON    	*/
																				"'".$MsubType."',".			/*P_REPAY_METHOD    	*/
																				"'M',".						/*P_REPAY_FREQ			*/
																				"'M',"						/*P_INT_COMPOUND_FRQ	*/
																				.$CAPITALIZED_CHARGES.		/*P_CHARGE_AMT_CAP 		*/
																				",0,".						/*P_STEP_FREQ 			*/
																				"'M',".						/*P_STEP_FREQ_CAT		*/
																				"0,".						/*P_STEP_PERC			*/
																				"0,'"						/*P_HOLIDAY_MONTHS		*/
																				.$CALC_PARAMS.				/*P_CUSTOM_SCHED		*/
																				"',0,"						/*P_GROSS_RNT			*/
																				.$DONWP_END."))";			/*P_DOWN_PAY_END		*/
            // echo $SQL;                                                                        
            $stid = oci_parse($OracleConn, $SQL);
            oci_execute($stid);
            ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
            echo "<table border='1' cellpadding='0' cellspacing='0' style='margin-left: 50px;' border-collapse='collapse' >";
            echo "<tr style='background-color: #BEBABA;'>";
            echo "<td style='width:50px;text-align: left;'>#</td>".
                "<td style='width:100px;text-align: left;'>DUE DATE</td>".
                 "<td style='width:100px;text-align: right;'>CAPITAL</td>".
                 "<td style='width:100px;text-align: right;'>INTEREST</td>".
                 "<td style='width:100px;text-align: right;'>RENTAL</td>".
                 "<td style='width:100px;text-align: right;'>VAT ON RENTAL</td>".
                 "<td style='width:100px;text-align: right;'>CHARGES AMT</td>".
                 "<td style='width:100px;text-align: right;'>GROSS RENTAL</td>".
                 "<td style='width:100px;text-align: right;'>CLOSING BAL</td>";
            echo "</tr>";                     
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
                echo "<tr>";
                echo "<td style='width:50px;text-align: left;'>".$row[0]. "</td>".
                     "<td style='width:100px;text-align: left;'>".$row[1]. "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[2], 2). "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[3], 2). "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[4], 2). "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[5], 2). "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[6], 2). "</td>".
                     "<td style='width:100px;text-align: right;'>".number_format($row[7], 2). "</td>".   
                     "<td style='width:100px;text-align: right;'>".number_format($row[8], 2). "</td>";
                echo "</tr>";                     
            }
            echo "</table>";                                                                                    
        }
    }
 
?>