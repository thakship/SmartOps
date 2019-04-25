<?php

include('../../../php_con/includes/db.ini.php'); // connection databace;

if(isset($_REQUEST['selectBranch'])){
    //echo "selectBranch";
    getCardDtl($conn,trim($_REQUEST['selectBranch']));
    
}

function getCardDtl($conn,$selectBranch){
      echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>NIC</span></td>
                <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Card Number</span></td>
                <td style='width:50px;'></td>
            </tr>";
    $v_sql_select = "SELECT ch.HEADER_ID , ch.EMBOSSING_NAME , ch.NIC , ch.DEBIT_CARD_NUMBER
                       FROM card_header AS ch 
                       WHERE ch.COM_DISPATCH_ON != '0000-00-00 00:00:00' AND
                                    ch.BRANCH_SENT_ON = '0000-00-00 00:00:00' AND
                                    ch.COLLECTING_BRANCH = '".$selectBranch."';";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
        echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
         echo "<td style='width:150px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['DEBIT_CARD_NUMBER']."</span></td>";
        echo "<td style='width:50px;'>";
       echo "<input style='display: none;' type='text' id='txtheade".$index."' name='txtheade".$index."' value='".$res_Select['HEADER_ID']."' onkeypress='return disableEnterKey(event);'/>";
       	echo "<input type='checkbox' name='chka".$index."' id='chka".$index."' title='".$index."' onclick='ischeck(title);'/>";
        echo "</td>";
        echo "</tr>";
    }
    echo "<table/><br/>";
    echo "<input class='buttonManage' style='width: 100px;margin-left: 10px;' type='button' name='btnRequest' id='btnRequest' value='Send' title='".$selectBranch."' onclick='isBatchCreation(title);'/>";
    
}


?>