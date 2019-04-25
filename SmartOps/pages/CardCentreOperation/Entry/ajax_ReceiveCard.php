<?php
include('../../../php_con/includes/db.ini.php'); // connection databace;

if(isset($_REQUEST['sendCBranch'])){
   //echo $_REQUEST['sendCBranch'];
   loadTableresiveCard($conn,trim($_REQUEST['sendCBranch']));
}

function  loadTableresiveCard($conn,$sendCBranch){
  echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                 <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                 <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                 <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>NIC</span></td>
                 <td style='width:75px;'></td>
                 <td style='width:200px;'>Card Number</td>
            </tr>  ";
  /*$v_sql_select = "SELECT DISTINCT ch.HOME_BRANCH , b.branchName
                         FROM card_header AS ch , branch AS b
                         WHERE ch.HOME_BRANCH = b.branchNumber AND
                               ch.COM_DISPATCH_ON = '0000-00-00 00:00:00' AND
                               ch.COM_SENT_ON != '0000-00-00 00:00:00' AND
                               ch.HOME_BRANCH = '".$sendCBranch."';";*/
                        //echo $v_sql_select;
   $v_sql_select = "SELECT ch.HEADER_ID , ch.EMBOSSING_NAME , ch.NIC  
                        FROM card_header AS ch 
                        WHERE ch.COM_DISPATCH_ON = '0000-00-00 00:00:00' AND
                              ch.COM_SENT_ON != '0000-00-00 00:00:00' AND
                              ch.HOME_BRANCH = '".$sendCBranch."';";
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        
        /*if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }*/
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
         echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
        echo "<td style='width:75px;' id = 'idTd".$index."'>";
        echo "<input style='display: none;' type='text' id='txtheade".$index."' name='txtheade".$index."' value='".$res_Select['HEADER_ID']."' onkeypress='return disableEnterKey(event);'/>";
        echo "<input type='checkbox' name='chka".$index."' id='chka".$index."' title='".$index."' onclick='ischeck(title);'/>";
        echo "</td>";
        echo "<td style='width:200px;'>";
        echo "<input style='width:200px;' type='text' id='txtCardNumber".$index."' name='txtCardNumber".$index."' value='' onkeypress='return isNumber(event);'   disabled='disabled'/>";
        echo "</td>";
        echo "</tr>";
    }
  
  
}
?>