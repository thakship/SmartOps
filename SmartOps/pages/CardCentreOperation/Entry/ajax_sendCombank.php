<?php

include('../../../php_con/includes/db.ini.php'); // connection databace;

if(isset($_REQUEST['getBatchNumber']) && isset($_REQUEST['genUser'])){
    generateDebitTable($conn,($_REQUEST['getBatchNumber']),trim($_REQUEST['genUser']));
}

function generateDebitTable($conn,$batchNumber,$genUser){
    //echo $batchNumber." - ".$genUser;
    echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Collecting Branch</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>Home Branch</span></td>
                <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Embossing Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Citizen ID</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Address 1</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Address 2</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Address 3</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Address 4</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Address 5</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>City</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Account No 1</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Account No 2</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Account No 3</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Date of Birth</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Mothers Maiden Name</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Withdrawal Limit (Rs.)</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Purchasing Limit (Rs.)</span></td>
                <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Mobile</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Previous Card Number</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Remark</span></td>
                
            </tr>";
    $v_sql_select = "SELECT br.br_code , 
       ch.EMBOSSING_NAME , 
		 ch.NIC ,
		 ch.ADDRESS_1 ,
		 ch.ADDRESS_2 ,
		 ch.ADDRESS_3 ,
		 ch.ADDRESS_4 ,
		 ch.ADDRESS_5 ,
		 ch.CITY ,
		 ch.ACCOUNT_NO_1 ,
		 ch.ACCOUNT_NO_2 ,
		 ch.ACCOUNT_NO_3 ,
		 ch.DOB ,
		 ch.MOTHER_MAIDEN_NAME,
		 ch.WITHDRAWAL_LIMIT ,
		 ch.PURCHASING_LIMIT ,
		 ch.PREVIOUS_CARD_NUMBER ,
         (SELECT b.br_code FROM branch AS b WHERE b.branchNumber = ch.COLLECTING_BRANCH) AS Collecting_br ,
         ch.GSM
FROM card_header AS ch , branch AS br
WHERE ch.HOME_BRANCH = br.branchNumber AND
     	ch.BATCH_NO = ".$batchNumber." 
ORDER BY br.br_code;";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_array($v_que_select)){
        $index++;
        
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[17]."</span></td>";
        echo "<td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[0]."</span></td>";
        echo "<td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[1]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[2]."</span></td>";
       // echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[3]." ".$res_Select[4]." ".$res_Select[5]."</span></td>";
        echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[3]."</span></td>";
        echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[4]."</span></td>";
        echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[5]."</span></td>";
       // echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[6]." ".$res_Select[7]."</span></td>";
        echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[6]."</span></td>";
        echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[7]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[8]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>'".$res_Select[9]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>'".$res_Select[10]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>'".$res_Select[11]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[12]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[13]."</span></td>";
        echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[14]."</span></td>";
        echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[15]."</span></td>";
        echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[18]."</span></td>";
        echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$res_Select[16]."</span></td>";
        echo "<td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
        echo "</tr>";
    }
    
}

?>