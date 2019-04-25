<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param2 = $_GET['param2']; 
if (strlen($param2) > 0){
    
    
	$result2 = mysqli_query($conn,"SELECT `customerCode`, `facilityNo`, `customerName`, `customerMobile`, `customerTelephone`, `productType`, `facilityType`, `period`, `startDate`, `facilityStatus`, `facilityAmount`, `expiryDate`, `acctivationDate`, `actualLossAmount`,
	ifnull((select lrn.totalPayable from lr_followup_note lrn where lrn.facilityNo = `lr_followup`.`facilityNo` and lrn.repayDate = (select max(lr_followup_note.repayDate) from lr_followup_note where lr_followup_note.facilityNo = `lr_followup`.`facilityNo` and lr_followup_note.repayDate <= date(now()) )),0) AS GROSS_RENTAL ,
	ifnull((select sum(lr_followup_note.totalPayable - lr_followup_note.totalPaid ) from lr_followup_note where lr_followup_note.facilityNo = lr_followup. `facilityNo` and lr_followup_note.repayDate <= date(now())),0) AS DUE_OUTSTANDING ,
	ifnull((select sum(lr_followup_note.totalPayable - lr_followup_note.totalPaid ) from lr_followup_note where lr_followup_note.facilityNo = lr_followup. `facilityNo`),0) AS TOTAL_AMOUNT_TO_BE_RECOVERED ,
	ifnull((select count(*) from lr_followup_note where lr_followup_note.facilityNo = lr_followup. `facilityNo` and lr_followup_note.repayDate <= date(now())),0) AS NO_OF_RENTAL_MATURED,
	ifnull((select  sum(lr_followup_note.totalPaid / lr_followup_note.totalPayable) from lr_followup_note  where lr_followup_note.facilityNo = `lr_followup`.`facilityNo` and lr_followup_note.totalPaid  > 0   and lr_followup_note.repayDate <= date(now())),0) AS NO_OF_RENTAL_PAID ,
   (ifnull((select count(*) from lr_followup_note where lr_followup_note.facilityNo = lr_followup. `facilityNo` and lr_followup_note.repayDate <= date(now())),0) - ifnull((select  sum(lr_followup_note.totalPaid / lr_followup_note.totalPayable) from lr_followup_note  where lr_followup_note.facilityNo = `lr_followup`.`facilityNo` and lr_followup_note.totalPaid  > 0   and lr_followup_note.repayDate <= date(now())),0))  AS NO_OF_RENTAL_IN_ARREARS,
 	ifnull((select sum(lr_followup_note.totalPayable - lr_followup_note.totalPaid ) from lr_followup_note where lr_followup_note.facilityNo = lr_followup. `facilityNo` and lr_followup_note.repayDate <= date(now())),0) as PAID_IN_ADVANCE 
     FROM `lr_followup` WHERE `facilityNo` ='".$param2."'");
    if(mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)) {
            $textout2 .= $myrow2["customerCode"]."|".$myrow2["facilityNo"]. "|" .$myrow2["customerName"]. "|" .$myrow2["customerMobile"]. "|" .$myrow2["customerTelephone"]. "|" .$myrow2["productType"]. "|" .$myrow2["facilityType"]. "|" .$myrow2["period"]. "|" .$myrow2["startDate"]. "|" .$myrow2["facilityStatus"]. "|" .$myrow2["facilityAmount"]. "|" .$myrow2["expiryDate"]. "|" .$myrow2["acctivationDate"]. "|" .$myrow2["actualLossAmount"]. "|" .$myrow2["GROSS_RENTAL"]. "|" .$myrow2["DUE_OUTSTANDING"]. "|" .$myrow2["TOTAL_AMOUNT_TO_BE_RECOVERED"]. "|" .$myrow2["NO_OF_RENTAL_MATURED"]. "|" .$myrow2["NO_OF_RENTAL_PAID"]. "|" .$myrow2["NO_OF_RENTAL_IN_ARREARS"]. "|".$myrow2["PAID_IN_ADVANCE"];
        }
    }else{
        $textout2 = "|";
    }
}
echo $textout2;

?>