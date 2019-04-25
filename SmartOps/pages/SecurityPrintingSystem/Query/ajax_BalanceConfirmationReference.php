<?php
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
//-----------------------------------------------------------------------------------------------------------------------------

if(isset($_REQUEST['get_referenceNumber'])){
    isBalanceConfiemationLetterQurey(trim($_REQUEST['get_referenceNumber']));
}

function isBalanceConfiemationLetterQurey($referenceNumber){
    $conn = DatabaseConnection();
    //echo $referenceNumber;
     $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $sql_select_Mortgage = "SELECT `V_INDEX`, `CLIENT_CODE`, `V_NAME`, `V_ADD`, `V_NIC`, `V_NAME_INIT`, `V_JDATE`, 
                        `V_BALSUM`,`V_DEPTBL`, `V_SVTBL`, `V_LIENSTAT`, `print_stats`, `AUTH_1_BY`, `AUTH_1_DATE`, `AUTH_2_BY`, `AUTH_2_DATE`, `embassy_id`, `jointPartyDetails`, `cashBackedLoanOutstanding`, `redemptionCapability`, `nomineeDetails`, `cdb`, `requestUser`, `printUser`, `V_NUMOFDEPS`, `V_JNAMESLIST`, `V_JNICLIST`, `V_NOMLIST`, `V_NOMNICLIST`, `V_DEPLINKCOUNT`, `V_CBOUTSUM`, `V_BASEDATE` ,`V_DEPLINKS`
                        FROM `sps_balance_confirmation`
                        WHERE `V_INDEX` = '".$referenceNumber."' AND
                               `AUTH_1_BY` != '' AND
                               `AUTH_2_BY` != '' AND
                               `print_stats` = 2;";
    //echo $sql_select_Mortgage;
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
       
        
echo "<div style='page-break-after: always'>
<div style='font-family:  sans; font-size: 14px; text-align: left;'>
   <label style='font-weight: bold;' >Ref No. : ".date("Y/m",strtotime($rec_select['cdb']))."/".$referenceNumber." </label><br />
</div><br />
<div style='text-align: center;'>
<label style='font-family:  sans; font-size: 14px; font-weight: bold;text-decoration: underline;' >Private &amp; Confidential</label>
</div>
<br />
<div style='font-family: sans; font-size: 14px;'>
     <label>".date("d-m-Y")."</label><br />
</div><br />
<table style='width: 100%;font-family: sans; font-size: 14px; '>
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
            
    
    echo "</td>
    </tr>
</table>
<div style='font-family: sans; font-size: 14px;'>
<br/>
<label>Dear Sir/Madam,</label><br /><br />

<table style='font-size: 14px;'>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>Depositor&apos;s Name</td>
        <td>: ".$rec_select['V_NAME']."</td>
    </tr>
    <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>Given Address</td>
        <td>: ".$rec_select['V_ADD']."</td>
    </tr>
     <tr style='width: 100%;'>
        <td style='font-weight: bold;width: 30%;'>NIC No.</td>
        <td>: ".$rec_select['V_NIC']."</td>
    </tr>
</table>
<hr />
<p style='text-align: justify; font-size: 14px;'>
We wish to inform that ".$rec_select['V_NAME_INIT']." is a/are valued depositor/s of our institution and continuously conducting business with us very satisfactorily since ".$rec_select['V_JDATE'].". We hereby confirm the deposits placed with us for LKR ".$rec_select['V_BALSUM']." on the following basis.
</p>";

$arr_1 = explode("<tr style=\"text-align: center; vertical-align: top;\">",$rec_select['V_DEPTBL']);
//echo sizeof($arr_1);

echo "<table style='font-size: 14px;'>
    <tr style='text-align: center; vertical-align: top; font-weight: bold;text-decoration: underline;'>
        <td style='width: 20%;'>Deposit Account No.</td>
        <td style='width: 20%;'>Amount (LKR)</td>
        <td style='width: 20%;'>Deposit/Renewed Date</td>
        <td style='width: 20%;'>Maturity Date</td>
        <td style='width: 20%;'>Originated Date</td>
    </tr>";
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
   if($rec_select['jointPartyDetails'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0  || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
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
                                
                                if(convetDecimal($rec_select['V_CBOUTSUM']) > 0  ){
                                    
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
                   /* header("Content-Type: image/jpeg");
                    echo "<div class='container'><img style='height: 50px;' src='data:image/jpeg;base64,".base64_encode($img_02)."'/></div>";
                      
                    echo " <label>.......................................................</label><br />
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />";*/
                    echo "</td>
                </tr>
            </table>
            <br />
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>This document is a computer generated document, for further reference please contact on 0117388 388.</p>
            </div>";

}else if($arr_count <= 23 && $arr_count >= 20){
    echo "</div>"; 
    echo "<div style='page-break-after: always;'>";
    if($rec_select['jointPartyDetails'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0  || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
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
<p style='text-align: justify; font-size: 14px;font-weight: bold;'>This document is a computer generated document, for further reference please contact on 0117388 388.</p>
</div>";
    
}else{
    if($arr_count < 20 && $arr_count > 15){
         echo "</div>"; 
                    
                if($rec_select['jointPartyDetails'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0  || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
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
                                
                                if(convetDecimal($rec_select['V_CBOUTSUM']) > 0  ){
                                    
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
            echo "<div style='page-break-after: always;'>";
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
                        <label style='font-size: 14px;font-weight: bold;'>Authorized Officer</label><br />*/
                    echo "</td>
                </tr>
            </table>
            <br />
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>This document is a computer generated document, for further reference please contact on 0117388 388.</p>
            </div>";
    }else{      
                if($rec_select['jointPartyDetails'] == 1 || convetDecimal($rec_select['V_CBOUTSUM']) > 0  || $rec_select['redemptionCapability'] == 1 || $rec_select['nomineeDetails'] == 1) {
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
            </p><br/>
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
            <p style='text-align: justify; font-size: 14px;font-weight: bold;'>This document is a computer generated document, for further reference please contact on 0117388 388.</p>
            </div>";
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    
}

function convetDecimal($string) {
   $string = str_replace(',', '', $string); // Replaces all spaces with hyphens.
   
   return floatval($string);
   //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>