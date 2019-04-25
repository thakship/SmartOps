<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['getPeriod']) && isset($_REQUEST['getFacilityAmount']) && isset($_REQUEST['getStartDate'])){
    //echo $_REQUEST['getPeriod']. " -- " . $_REQUEST['getFacilityAmount'];
    genCalculatorGried(trim($_REQUEST['getPeriod']),trim($_REQUEST['getFacilityAmount']),trim($_REQUEST['getStartDate']));
}

if(isset($_POST['isCustomerCode']) && isset($_POST['isFacilityNo']) && isset($_POST['isCustomerName']) && isset($_POST['isCustomerMobile']) && isset($_POST['isCustomerTelephone']) && isset($_POST['isProductType']) && isset($_POST['isFacilityType']) && isset($_POST['isPeriod']) && isset($_POST['isStartDate']) && isset($_POST['isFacilityStatus']) && isset($_POST['isFacilityAmount']) && isset($_POST['isExpiryDate']) && isset($_POST['isAcctivationDate']) && isset($_POST['isActualLossAmount']) && isset($_POST['isNoteString'])){
    //isCustomerCode : customerCode , isFacilityNo : facilityNo , isCustomerName : customerName , isCustomerMobile : customerMobile , isCustomerTelephone : customerTelephone , isProductType : productType , isFacilityType : facilityType , isPeriod : period , isStartDate : startDate , isFacilityStatus : facilityStatus , isFacilityAmount : facilityAmount , isExpiryDate : expiryDate , isAcctivationDate : acctivationDate , isActualLossAmount : actualLossAmount
    //echo trim($_POST['isCustomerCode'])." - ".trim($_POST['isFacilityNo'])." - ".trim($_POST['isCustomerName'])." - ".trim($_POST['isCustomerMobile'])." - ".trim($_POST['isCustomerTelephone'])." - ".trim($_POST['isProductType'])." - ".trim($_POST['isFacilityType'])." - ".trim($_POST['isPeriod'])." - ".trim($_POST['isStartDate'])." - ".trim($_POST['isFacilityStatus'])." - ".trim($_POST['isFacilityAmount'])." - ".trim($_POST['isExpiryDate'])." - ".trim($_POST['isAcctivationDate'])." - ".trim($_POST['isActualLossAmount'])." - ".trim($_POST['isNoteString']);
    
    submitEntryManagement(trim($_POST['isCustomerCode']),trim($_POST['isFacilityNo']),trim($_POST['isCustomerName']),trim($_POST['isCustomerMobile']),trim($_POST['isCustomerTelephone']),trim($_POST['isProductType']),trim($_POST['isFacilityType']),trim($_POST['isPeriod']),trim($_POST['isStartDate']),trim($_POST['isFacilityStatus']),trim($_POST['isFacilityAmount']),trim($_POST['isExpiryDate']),trim($_POST['isAcctivationDate']),trim($_POST['isActualLossAmount']),trim($_POST['isNoteString']) , trim($_POST['isDesition']));
}

if(isset($_REQUEST['getFacilityNo'])){
    //echo $_REQUEST['getPeriod']. " -- " . $_REQUEST['getFacilityAmount'];
    genUpdateGried(trim($_REQUEST['getFacilityNo']));
}
// ------------------------------- GenatGenerate table in  Calculator Period -----------------------------------------------------------
function genCalculatorGried($getPeriod,$getFacilityAmount,$getStartDate){
    //echo $getFacilityAmount;
    $monthAmount = $getFacilityAmount/$getPeriod;
    echo "<table class='table table-striped table-bordered table-hover'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Repay Date</th>
                    <th>Total Payable</th>
                    <th>Total Paid</th>
                </tr>
            </thead>
            <tbody>";
            $petMonthO = "";
            $petMonthf = "";
            $NewDate = "";
            $getD = "";
            for($i = 1 ; $i <= $getPeriod ; $i++){
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtRepayDate".$i."' name='txtRepayDate".$i."' value='".$getStartDate."' onkeypress='return disableEnterKey(event)' required='required' readonly='readonly'/></td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtTotalPayable".$i."'  name='txtTotalPayable".$i."' maxlength='15' value='".$monthAmount."' onkeypress='return disableEnterKey(event)' required='required' placeholder='0.00' /></td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtMonthlyAmount".$i."' name='txtMonthlyAmount".$i."' maxlength='15' value='' onkeypress='return disableEnterKey(event)' required='required' placeholder='0.00' /></td>";
                echo "</tr>";
                
                $getStartDateNew = date('Y-m-d', strtotime("+1 months", strtotime($getStartDate))); //2017-03-01
                $YearNew = date('Y',strtotime($getStartDateNew)); // 03
                $monthNew = date('m',strtotime($getStartDateNew)); // 01
                
                $Year = date('Y',strtotime($getStartDate)); // 03
                $month = date('m',strtotime($getStartDate)); // 01
                $date = date('d',strtotime($getStartDate)); // 01
                 if($month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10"){
                    if($date != "31"){
                        $getStartDate = $getStartDateNew;
                    }else{
                        if($month == "07" && $date == "31"){
                             $getStartDate = $getStartDateNew;
                        }else{
                            $NewDate = date('Y-m-d', strtotime('+1 days', strtotime($getStartDate)));
                            $getStartDate = $Year."-".date('m',strtotime($NewDate))."-30";
                            $NewDate = "";
                            $getD = $date;
                        }
                    }
                 }else{
                    if($month == "01" && $monthNew == "03"){
                        if($Year%4==0){
                            $getStartDate = $Year."-02-29";
                        }else{
                            $getStartDate = $Year."-02-28";
                        }
                        
                        $perDate = $date;
                        $petMonthO = $month;
                        $petMonthf = $monthNew;
                    }else{
                        if($petMonthO == "01" && $petMonthf == "03"){
                             $getStartDate = $Year."-03-".$perDate;
                             $petMonthO = "";
                             $petMonthf = "";
                        }else{
                            if($getD == "31"){
                                $NewNewDate = date('Y-m-d', strtotime('+3 days', strtotime($getStartDate)));
                                $getStartDate = $Year."-".date('m',strtotime($NewNewDate))."-31";
                                $getD = "";
                            }else{
                                $getStartDate = date('Y-m-d', strtotime("+1 months", strtotime($getStartDate)));
                            }
                            
                        }
                    }
                 }
            }                     
    echo "</tbody>
          </table>";
}

function submitEntryManagement($isCustomerCode,$isFacilityNo,$isCustomerName,$isCustomerMobile,$isCustomerTelephone,$isProductType,$isFacilityType,$isPeriod,$isStartDate,$isFacilityStatus,$isFacilityAmount,$isExpiryDate,$isAcctivationDate,$isActualLossAmount,$isNoteString,$isDesition){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_insert = "INSERT INTO `lr_followup`(`customerCode`, `facilityNo`, `customerName`, `customerMobile`, `customerTelephone`, `productType`, `facilityType`, `period`, `startDate`, `facilityStatus`, `facilityAmount`, `expiryDate`, `acctivationDate`, `actualLossAmount` ,  `profitLostStatus`) 
                                         VALUES ('".$isCustomerCode."','".$isFacilityNo."','".$isCustomerName."','".$isCustomerMobile."','".$isCustomerTelephone."','".$isProductType."','".$isFacilityType."','".$isPeriod."','".$isStartDate."','".$isFacilityStatus."','".$isFacilityAmount."','".$isExpiryDate."','".$isAcctivationDate."','".$isActualLossAmount."' , '".$isDesition."');";
        //echo $sql_insert."<br/>";
        $query_insert = mysqli_query($conn, $sql_insert) or die(mysqli_error($conn));
        $array_row = explode("@",$isNoteString);
        $row = sizeof($array_row)-1;
        //echo $row."<br/>";
        for($x = 0 ; $x < $row ; $x++){
            $array_col = explode("|",$array_row[$x]);
            $sql_note_inset = "INSERT INTO `lr_followup_note`(`facilityNo`, `repayDate`, `totalPayable`, `totalPaid`) VALUES ('".$isFacilityNo."','".$array_col[1]."','".$array_col[2]."','".$array_col[3]."');";
            $querynote_inset = mysqli_query($conn, $sql_note_inset) or die(mysqli_error($conn));
            //echo $sql_note_inset."<br/>";
        }
        if($query_insert){
            echo "OK";
        }else{
            echo "NOT";
        }
        mysqli_commit($conn);
   	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
    
}

function genUpdateGried($getFacilityNo){
    //echo $getFacilityNo;
    $conn = DatabaseConnection();
    echo "<table class='table table-striped table-bordered table-hover'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Repay Date</th>
                    <th>Total Payable</th>
                    <th>Total Paid</th>
                </tr>
            </thead>
            <tbody>";
            $sql_noteTbl = "SELECT `si_no`, `facilityNo`, `repayDate`, `totalPayable`, `totalPaid` FROM `lr_followup_note` WHERE `facilityNo` = '".$getFacilityNo."';";
            $query_noteTbl = mysqli_query($conn, $sql_noteTbl) or die(mysqli_error($conn));
            $i = 1;
            while($rec_noteTbl = mysqli_fetch_array($query_noteTbl)){
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtRepayDate".$i."' name='txtRepayDate".$i."' value='".$rec_noteTbl[2]."' onkeypress='return disableEnterKey(event)' required='required' readonly='readonly'/></td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtTotalPayable".$i."'  name='txtTotalPayable".$i."' maxlength='15' value='".$rec_noteTbl[3]."' onkeypress='return disableEnterKey(event)' required='required' placeholder='0.00' /></td>";
                echo "<td style='padding: 0px;'><input type='text'  class='form-control' id='txtMonthlyAmount".$i."' name='txtMonthlyAmount".$i."' maxlength='15' value='".$rec_noteTbl[4]."' onkeypress='return disableEnterKey(event)' required='required' placeholder='0.00' /></td>";
                echo "</tr>";
                $i++;
            }                        
    echo "</tbody>
          </table>";
}

?>