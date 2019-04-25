<?php

include('../../../php_con/includes/db.ini.php'); // connection databace;

function oracleDatabaseConnection(){
        $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
                    (CONNECT_DATA =
                      (SERVER = DEDICATED)
                      (SERVICE_NAME = cdbprod)))";
      $dbConn = oci_connect('cdberp','cdberp',$dbstr1);
      return $dbConn;
}

if(isset($_REQUEST['getAcc_01']) && isset($_REQUEST['parpasType'])){
    //echo trim($_REQUEST['getAcc_01'])
    checkUserDtl($conn,trim($_REQUEST['getAcc_01']),trim($_REQUEST['parpasType']));
}


//---------- Function check user Dtl normal or joint ------------------------------------
function checkUserDtl($conn,$getAcc_01,$parpasType){
    $oracleConn = oracleDatabaseConnection();
    if(!$oracleConn){
    	//$err = OCIError();
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else {
    	//print "Connected to Oracle!";
    	//echo "Successfully connected to Oracle.<br/>";
        //$OracleSelect = oci_parse($oracleConn,"SELECT * FROM cdbproddb.rizvi_01");
        //003800000023000501
        
        $sqlCountACC = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND (ch.ACCOUNT_NO_1 = '".$getAcc_01."' OR 
                                  ch.ACCOUNT_NO_2 = '".$getAcc_01."' OR
                                  ch.ACCOUNT_NO_3 = '".$getAcc_01."' OR
                                  ch.ACCOUNT_NO_4 = '".$getAcc_01."') ;";
                                  
        $jointSring = "J|";
        $getAccType = "J";
        $queryCountACC = mysqli_query($conn,$sqlCountACC) or die (mysqli_error($conn));
        while($resaltCountACC = mysqli_fetch_array($queryCountACC)){
            if($resaltCountACC[0] == 0){
                $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_cardcen.get_cardcc_data('".$getAcc_01."'))");
                oci_execute($OracleSelect);
                $i = 0;
                ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
           
                //echo "A";
                while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
                    $i++;
                        //echo "0 ".$rowSelect [0]."<br/>";
                       	/*
                          0 - ACCNUM            varchar2(35) ,
                          1 - AC_OPNDATE        varchar2(10),
                          2 - CLTYPE            varchar2(1),
                          3 - AC_CLCODE         number(12),
                          4 - CL_SERIAL         number(3),
                          5 - CL_CODE           number(12)  ,
                          6 - CL_TITLE          varchar2(15),
                          7 - CL_NAME           varchar2(270),
                          8 - CL_NAME_INIT      varchar2(500),
                          9 - CL_ID             varchar2(15),
                         10 - CL_DOB            varchar2(10),
                         11 - CL_COM_ADD_1      varchar2(50),
                         12 - CL_COM_ADD_2      varchar2(50),
                         13 - CL_COM_ADD_3      varchar2(50),
                         14 - CL_COM_ADD_4      varchar2(50),
                         15 - CL_COM_ADD_5      varchar2(50),
                         16 - CL_COM_LOCATION   varchar2(50),
                         17 - CL_PRM_ADD_1      varchar2(50),
                         18 - CL_PRM_ADD_2      varchar2(50),
                         19 - CL_PRM_ADD_3      varchar2(50),
                         20 - CL_PRM_ADD_4      varchar2(50),
                         21 - CL_PRM_ADD_5      varchar2(50),
                         22 - CL_PRM_LOCATION   varchar2(50),
                         23 - CL_GSM            varchar2(15),
                         24 - CL_HOMETEL        varchar2(15)
                        */
                        $p_numbre = "";
                        $sql_p_c_number1 = "SELECT a1.ENTRY_ON , a1.PREVIOUS_CARD_NUMBER
                                              FROM  card_header AS a1 
                                             WHERE a1.ACCOUNT_NO_1 = '".$getAcc_01."' OR 
                                                   a1.ACCOUNT_NO_2 = '".$getAcc_01."' OR 
                                                   a1.ACCOUNT_NO_3 = '".$getAcc_01."' OR
                                                   a1.ACCOUNT_NO_4 = '".$getAcc_01."'
                                             ORDER BY a1.ENTRY_ON DESC
                                             LIMIT 1;";
                        $query_p_c_number1 = mysqli_query($conn,$sql_p_c_number1) or die (mysqli_error($conn));
                        while($rec_1 = mysqli_fetch_array($query_p_c_number1)){
                            $p_numbre = $rec_1[1];
                        }
                        //$p_numbre = "4840720000030576";
                        
                        if($parpasType = "I" && $rowSelect[2] == "I"){
                            $AC_OPNDATE = date("Y-m-d",strtotime(date($rowSelect[1])));
                            $PRIMCL_DOB = date("Y-m-d",strtotime(date($rowSelect[10])));
                            $getAccType = $rowSelect[2];
                            $rowSelect[23] = isset($rowSelect[23]) ? $rowSelect[23] : "" ;
                            
                            $dataString = $rowSelect[0]."|".$rowSelect[1]."|".$rowSelect[2]."|".$rowSelect[3]."|".$rowSelect[4]."|".$rowSelect[5]."|".$rowSelect[6]."|".$rowSelect[7]."|".$rowSelect[8]."|".$rowSelect[9]."|".$rowSelect[10]."|".$rowSelect[11]."|".$rowSelect[12]."|".$rowSelect[13]."|".$rowSelect[14]."|".$rowSelect[15]."|".$rowSelect[16]."|".$rowSelect[17]."|".$rowSelect[18]."|".$rowSelect[19]."|".$rowSelect[20]."|".$rowSelect[21]."|".$rowSelect[22]."|".$rowSelect[23]."|".$rowSelect[24]."|".$p_numbre;
                            
                        }else if($rowSelect[2] == "J"){
                            $AC_OPNDATE = date("Y-m-d",strtotime(date($rowSelect[1])));
                            $PRIMCL_DOB = date("Y-m-d",strtotime(date($rowSelect[10])));
                            $getAccType = $rowSelect[2];
                            $rowSelect[23] = isset($rowSelect[23]) ? $rowSelect[23] : "" ;
                            $jointSring .=  $rowSelect[0]."|".$rowSelect[1]."|".$rowSelect[2]."|".$rowSelect[3]."|".$rowSelect[4]."|".$rowSelect[5]."|".$rowSelect[6]."|".$rowSelect[7]."|".$rowSelect[8]."|".$rowSelect[9]."|".$rowSelect[10]."|".$rowSelect[11]."|".$rowSelect[12]."|".$rowSelect[13]."|".$rowSelect[14]."|".$rowSelect[15]."|".$rowSelect[16]."|".$rowSelect[17]."|".$rowSelect[18]."|".$rowSelect[19]."|".$rowSelect[20]."|".$rowSelect[21]."|".$rowSelect[22]."|".$rowSelect[23]."|".$rowSelect[24]."|".$p_numbre."@";
                        }else{
                             
                            /*if($i == 1){
                               $dataString = $rowSelect[0]."|".$rowSelect[1]."|".$rowSelect[2]."|".$rowSelect[3]."|".$rowSelect[4]."|".$rowSelect[5]."|".$rowSelect[6]."|".$rowSelect[7]."|".$rowSelect[8]."|".$rowSelect[9]."|".$rowSelect[10]."|".$rowSelect[11]."|".$rowSelect[12]."|".$rowSelect[13]."|".$rowSelect[14]."|".$rowSelect[15]."|".$rowSelect[16]."|".$rowSelect[17]."|".$rowSelect[18]."|".$rowSelect[19]."|".$rowSelect[20]."|".$rowSelect[21]."|".$rowSelect[22]."|".$rowSelect[23]."|".$rowSelect[24]."|".$p_numbre; 
                            }*/
                            
                        }
                }   
                if($getAccType == "I"){
                    echo $dataString; 
                }else{
                   echo  $jointSring;
                }
                   
                 
            }else{
                echo "NOT";
            }
        }
   }
}
?>