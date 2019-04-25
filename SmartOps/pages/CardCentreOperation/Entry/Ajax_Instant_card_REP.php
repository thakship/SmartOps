<?php

include('../../../php_con/includes/db.ini.php'); // Conection fo DB

    if(isset($_POST['getRepID']) && isset($_POST['fromDate']) && isset($_POST['toDate'])){
       // echo $_POST['getRepID'];
        if($_POST['getRepID'] == 1){
            Instant_Card_Fee_Deduction_Customer_list($conn ,$_POST['fromDate'],$_POST['toDate']);
        }else if($_POST['getRepID'] == 2){
            Details_of_Debit_card_instant_commercial_report($conn,$_POST['fromDate'],$_POST['toDate']);
        }else{
            echo "<h3 style='color: #CC0000'> Undefined Report </h3>";
        }
    }

    function Instant_Card_Fee_Deduction_Customer_list($conn ,$fromDate,$toDate){
        //echo "Instant_Card_Fee_Deduction_Customer_list";
        /*
         Name
        A/C Number
        Amount (Rs.)
        Narration
        Card_Type
         */

        echo "<br/><br/>
                <table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                    <tr>
                        <td>Name</td>
                        <td>A/C Number</td>
                        <td>Amount (Rs.)</td>
                        <td>Narration</td>
                        <td>Card Type</td>
                    </tr>";

        $sql = "SELECT s.CLIENT_NAME , 
                                s.ACCOUNT_NO_1 , 
                                '400.00' , 
                                'Debit Card Issuance Fee'  ,
                                 (select d.scat_discr_3 
                                from scat_03 AS d 
                                where d.cat_code = c.cat_code 
                                  AND d.scat_code_1 = c.scat_code_1 
                                  AND d.scat_code_2 = c.scat_code_2 
                                  AND d.scat_code_3 = c.scat_code_3) 
                    FROM  cdb_helpdesk AS c , card_header_ins AS s 
                    WHERE c.cat_code = 1021
                      AND c.scat_code_1 = 102102
                      AND c.scat_code_2 = 10210208
                     AND (c.decision_discription IS NULL OR  c.decision_discription = 'APPROVED')
                      AND c.enterDateTime BETWEEN '".$fromDate."' AND '".$toDate."'
                    AND c.cmb_code NOT IN (5005)
                      AND c.helpid = s.help_ID ;";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        while($resalt = mysqli_fetch_array($query)){
            echo "
              <tr>
                        <td>".$resalt[0]."</td>
                        <td>'".$resalt[1]."</td>
                        <td>'".$resalt[2]."</td>
                        <td>".$resalt[3]."</td>
                        <td>".$resalt[4]."</td>
                    </tr>";
        }



        echo "</table>";
    }

    function Details_of_Debit_card_instant_commercial_report($conn ,$fromDate,$toDate){
        // echo "Details_of_Debit_card_instant_commercial_report";
        /*
            0 App_sending_Branch  0
            1 Home_Branch
            2 Card_number
            3 Customer_name
            4 Citizen_ID
            5 Address_1
            6 Address_2
            7 Address_3
            8 Address_4
            9 Address_5
            10 City
            11 Account_No_1
            12 Account_No_2
            13 Account_No_3
            14 Account_No_4
            15 Date_of_Birth
            16 Mothers_Maiden_Name
            17 Withdrawal_Limit _Rs
            18 Purchasing_Limit_Rs
            19 Mobile
            20 Previous_Card_Number
            21 Card_Type
            23 Remark
        */
        echo "<br/><br/>
                <table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                    <tr>
                        <td>App_sending_Branch</td>
                        <td>Home_Branch</td>
                        <td>Card_number</td>
                        <td>Customer_name</td>
                        <td>Citizen_ID</td>
                        <td>Address_1</td>
                        <td>Address_2</td>
                        <td>Address_3</td>
                        <td>Address_4</td>
                        <td>Address_5</td>
                        <td>City</td>
                        <td>Account_No_1</td>
                        <td>Account_No_2</td>
                        <td>Account_No_3</td>
                        <td>Account_No_4</td>
                        <td>Date_of_Birth</td>
                        <td>Mothers_Maiden_Name</td>
                        <td>Withdrawal_Limit _Rs</td>
                        <td>Purchasing_Limit_Rs</td>
                        <td>Mobile</td>
                        <td>Previous_Card_Number</td>
                        <td>Card_Type</td>
                        <td>Remark </td>
                    </tr>";

        $sql = "SELECT h.entry_branch ,
                           i.HOME_BRANCH ,
                           i.DEBIT_CARD_NUMBER ,
                           i.CLIENT_NAME ,
                           i.NIC ,
                           i.ADDRESS_1 ,
                           i.ADDRESS_2 ,
                           i.ADDRESS_3 ,
                           i.ADDRESS_4 ,
                           i.ADDRESS_5 ,
                           i.CITY ,
                           i.ACCOUNT_NO_1 ,
                           i.ACCOUNT_NO_2 ,
                           i.ACCOUNT_NO_3 ,
                           i.ACCOUNT_NO_4 ,
                           i.DOB ,
                           i.MOTHER_MAIDEN_NAME ,
                           i.WITHDRAWAL_LIMIT ,
                           i.PURCHASING_LIMIT ,
                           i.GSM ,
                           i.PREVIOUS_ACCOUNT_NO ,
                            (select d.scat_discr_3 
                                from scat_03 AS d 
                                where d.cat_code = h.cat_code 
                                  AND d.scat_code_1 = h.scat_code_1 
                                  AND d.scat_code_2 = h.scat_code_2 
                                  AND d.scat_code_3 = h.scat_code_3) AS Card_Type,
                           '' AS Remark
                    FROM cdb_helpdesk AS h , card_header_ins AS i 
                    WHERE h.helpid = i.help_ID
                     AND h.cat_code = 1021
                      AND h.scat_code_1 = 102102
                      AND h.scat_code_2 = 10210208
                    AND (h.decision_discription IS NULL OR  h.decision_discription = 'APPROVED')
                      AND h.enterDateTime BETWEEN '".$fromDate."' AND '".$toDate."';";
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        while($resalt = mysqli_fetch_array($query)){
            echo "
              <tr>
                    <td>".$resalt[0]."</td>
                    <td>".$resalt[1]."</td>
                    <td>'".$resalt[2]."</td>
                    <td>".$resalt[3]."</td>
                    <td>".$resalt[4]."</td>
                    <td>".$resalt[5]."</td>
                    <td>".$resalt[6]."</td>
                    <td>".$resalt[7]."</td>
                    <td>".$resalt[8]."</td>
                    <td>".$resalt[9]."</td>
                    <td>".$resalt[10]."</td>
                    <td>'".$resalt[11]."</td>
                    <td>'".$resalt[12]."</td>
                    <td>'".$resalt[13]."</td>
                    <td>'".$resalt[14]."</td>
                    <td>".$resalt[15]."</td>
                    <td>".$resalt[16]."</td>
                    <td>'".$resalt[17]."</td>
                    <td>'".$resalt[18]."</td>
                    <td>'".$resalt[19]."</td>
                    <td>".$resalt[20]."</td>
                    <td>".$resalt[21]."</td>
                    <td>".$resalt[22]." </td>
                </tr>";
        }



        echo "</table>";
    }

?>