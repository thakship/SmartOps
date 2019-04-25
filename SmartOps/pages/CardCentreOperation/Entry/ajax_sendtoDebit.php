<?php

include('../../../php_con/includes/db.ini.php'); // connection databace;

if(isset($_REQUEST['getBatchNumber']) && isset($_REQUEST['genUser'])){
    generateDebitTable($conn,($_REQUEST['getBatchNumber']),trim($_REQUEST['genUser']));
}

function generateDebitTable($conn,$batchNumber,$genUser){
    ///echo $batchNumber." - ".$genUser;
    echo "<br/><br/>
    <table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:80px; text-align: center;'><span style='margin-right: 5px;'>SRL</span></td>
                <td style='width:400px; text-align: center;'><span style='margin-left: 5px;'>Name</span></td>
                <td style='width:200px; text-align: center;'><span style='margin-left: 5px;'>A/C Number</span></td>
                <td style='width:100px; text-align: center;'><span style='margin-left: 5px;'>Amount (Rs.)</span></td>
                <td style='width:200px; text-align: center;'><span style='margin-left: 5px;'>Narration</span></td>
                <td style='width:200px; text-align: center;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            </tr>";
            
    $v_sys_para = "SELECT es.para_value , 
                          es.para_desc 
                     FROM erp_sys_param AS es 
                    WHERE es.para_code = 14;";
    $q_sys_para = mysqli_query($conn,$v_sys_para) or die(mysqli_error($conn));
    $amount = 0.00;
    while($r_sys_para = mysqli_fetch_array($q_sys_para)){
        $amount = $r_sys_para[0];
        $narration = $r_sys_para[1];
        
    }
    $v_sql_select = "SELECT ch.EMBOSSING_NAME , 
                            ch.ACCOUNT_NO_1 , 
                            ch.ACC_FREES , 
                            ch.ACC_INOPERATIVE , 
                            ch.ACC_AVLBLE ,
                            ch.HEADER_ID
                       FROM card_header AS ch 
                      WHERE ch.BATCH_NO = ".$batchNumber." AND ch.isCharge != 0;";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$index."</span></td>";
        echo "<td style='width:400px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
        echo "<td style='width:200px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>'".$res_Select['ACCOUNT_NO_1']."</span></td>";
        echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$amount."</span></td>";
        echo "<td style='width:200px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$narration."</span></td>";
        echo "<td style='width:150px;'>";
        if($res_Select['ACC_FREES'] != 0 || $res_Select['ACC_INOPERATIVE'] != 0 || $res_Select['ACC_AVLBLE'] < 400.00){
            echo "<a class='isLinkReject' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isReject(title);'>Reject</a> | ";
            echo "<a class='isLinkPending' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isPending(title);'>Back</a>";
       }
        
        echo "</tr>";
    }
    
}

?>