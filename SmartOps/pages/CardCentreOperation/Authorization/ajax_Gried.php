<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['get_Approve']) && isset($_REQUEST['get_function'])){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_Approve($_REQUEST['get_function']);
}

if(isset($_REQUEST['AUTH_GRIED'])){
    //echo $_REQUEST['AUTH_GRIED'];
    getAuthGriedTbl($_REQUEST['AUTH_GRIED']);
}
function get_Approve($get_function){
    $classes = explode("|",$get_function);
     
    echo "<div id='outer'></div>";
    echo "<div id='conten' style='padding: 10px;'><br/>";
     echo "<div style='width: 100%; height: 30px;text-align: right;margin-right: 10px;'></div>";
     echo $classes[2];
     echo "<br/>";
     echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtComment' name='txtComment' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";    
    if($classes[0] == "A"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Approve' title='A|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "R"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "P"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
   echo "<input type='button' style='margin-right: 10px;' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0,title)'/>";
          
    echo "</div>";
    echo "<div style='width: 100%;'></div>
    </div>";
}

function getAuthGriedTbl($AUTH_GRIED){
    $conn = DatabaseConnection();
    echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>NIC</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>ACC FREES</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>ACC INOPE.</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>ACC AVLBLE</span></td>
                <td style='width:150px;'></td>
            </tr>";
    $v_sql_select = "SELECT u.HEADER_ID , 
                            u.EMBOSSING_NAME , 
                            u.NIC , 
                            u.ACC_FREES , 
                            u.ACC_INOPERATIVE , 
                            u.ACC_AVLBLE , 
                            u.ACCOUNT_NO_1
                       FROM  card_header AS u 
                      WHERE u.AUTH_ON = '0000-00-00 00:00:00' AND (u.AUTH_STATUS = 0 OR u.AUTH_STATUS = 3);";
    
    
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        
        
        /*if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }*/
        $code = substr($res_Select['ACCOUNT_NO_1'],-3);
        if($code == 501 && $AUTH_GRIED == 1){
            $index++;
            $col = "#FFFFFF";
            echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
            
            if($res_Select['ACC_FREES'] == 0){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else if($res_Select['ACC_FREES'] == 1){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
            }
            
            if($res_Select['ACC_INOPERATIVE'] == 0){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else if($res_Select['ACC_INOPERATIVE'] == 1){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
            }
            
            if($res_Select['ACC_AVLBLE'] >= 400.000){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }
            
            echo "<td style='width:150px;'>";
            if($res_Select['ACC_FREES'] == 0 && $res_Select['ACC_INOPERATIVE'] == 0 && $res_Select['ACC_AVLBLE'] >= 400.00){
                echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isApprove(title);'>Approve</a> | ";
            }
            echo "<a class='isLinkPending' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isPending(title);'>Pending</a> | <a class='isLinkReject' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isReject(title);'>Reject</a> ";
            echo "</td>";
            echo "</tr>";
        }
        
        if($code != 501 && $AUTH_GRIED == 2){
            $index++;
            $col = "#FFFFFF";
            echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
            
            if($res_Select['ACC_FREES'] == 0){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else if($res_Select['ACC_FREES'] == 1){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
            }
            
            if($res_Select['ACC_INOPERATIVE'] == 0){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else if($res_Select['ACC_INOPERATIVE'] == 1){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
            }
            
            if($res_Select['ACC_AVLBLE'] >= 400.000){
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
            }else{
                echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
            }
            
            echo "<td style='width:150px;'>";
            if($res_Select['ACC_FREES'] == 0 && $res_Select['ACC_INOPERATIVE'] == 0 && $res_Select['ACC_AVLBLE'] >= 400.00){
                echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isApprove(title);'>Approve</a> | ";
            }
            echo "<a class='isLinkPending' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isPending(title);'>Pending</a> | <a class='isLinkReject' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isReject(title);'>Reject</a> ";
            echo "</td>";
            echo "</tr>";
        }
        
       
    }
    echo "<tr style='background-color: #BEBABA;'>
                <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>&nbsp;</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
                <td style='width:50px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
                <td style='width:150px;'></td>
            </tr>";
    echo "</table>";
}

?>