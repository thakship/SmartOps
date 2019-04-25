<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['get_Approve']) && isset($_REQUEST['get_function'])){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_Approve($_REQUEST['get_function']);
}

if(isset($_REQUEST['get_ApproveCE']) && isset($_REQUEST['get_functionCE'])){
   // echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_ApproveCE($_REQUEST['get_functionCE']);
}

if(isset($_REQUEST['get_Reject']) && isset($_REQUEST['get_function'])){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_Reject($_REQUEST['get_function']);
}

if(isset($_REQUEST['get_Back_AUTH']) && isset($_REQUEST['get_function'])){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    set_Back_AUTH($_REQUEST['get_function']);
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
     echo "<div style='display: none;'>
            <input type='text' name='txt_helpdeskCredit' id='txt_helpdeskCredit' value='".$classes[1]."' />
    </div>";
     echo $classes[2];
     echo "<br/>";
     echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtCommentCredit' name='txtCommentCredit' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";    
    if($classes[0] == "R"){
        echo "<input type='submit' style='margin-left: 100px;'  class='buttonManage' id='btn_Recomented' name='btn_Recomented' value='Recommended'/>";     
    }
   /* if($classes[0] == "R"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "P"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";     
    }*/
   echo "<input type='button' style='margin-right: 10px;' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0,title)'/>";
          
    echo "</div>";
    echo "<div style='width: 100%;'></div>
    </div>";
}

function get_ApproveCE($get_function){
    $conn = DatabaseConnection();
    $classes = explode("|",$get_function);

    echo "<div id='outer'></div>";
    echo "<div id='conten' style='padding: 10px;'><br/>";
    echo "<div style='width: 100%; height: 30px;text-align: right;margin-right: 10px;'></div>";
    echo "<div style='display: none;'>
            <input type='text' name='txt_helpdeskCredit' id='txt_helpdeskCredit' value='".$classes[1]."' />
    </div>";
    //echo "A";
    echo $classes[2];
    echo "<br/>";
    echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtCommentCredit' name='txtCommentCredit' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            <tr>
                <td>
                    Card Type : 
                </td>
                <td>
                       <select class='box_decaretion'  style='width: 150px;' name='sel_scat02' id='sel_scat02' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                            <option value='A'>--Select States --</option>";

                            $v_sql_cat_2 = "SELECT `scat_code_2` , `scat_discr_2` 
                                                                  FROM `scat_02` 
                                                                 WHERE `cat_code` = '1038' AND `scat_code_1` = '103801';";

                            //echo $v_sql_cat_2;
                            $quecat_2 = mysqli_query($conn,$v_sql_cat_2);
                            while($RES_getcat_2 = mysqli_fetch_array($quecat_2)){
                                echo "<option value='".$RES_getcat_2[0]."'>".$RES_getcat_2[1]."</option>";
                            }



                echo "
                    </select>
                   
                </td>
            </tr>
             <tr>
                <td>
                    Card Amount : 
                </td>
                <td>
                     <input class='box_decaretion' type='text' style='width:200px;' name='txt_Card_Amount' id='txt_Card_Amount' value='' onKeyPress='return disableEnterKey(event)' required = 'required'/>
                </td>
            </tr>
            <tr>
                <td>
                    Credit Score : 
                </td>
                <td>
                     <input class='box_decaretion' type='text' style='width:200px;' name='txt_Credit_Score' id='txt_Credit_Score' value='0' onKeyPress='return disableEnterKey(event)' required = 'required'/>
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";
    if($classes[0] == "R"){
        echo "<input type='submit' style='margin-left: 100px;'  class='buttonManage' id='btn_Recomented' name='btn_Recomented' value='Recommended'/>";
    }
    /* if($classes[0] == "R"){
         echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";
     }
     if($classes[0] == "P"){
         echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";
     }*/
    echo "<input type='button' style='margin-right: 10px;' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0,title)'/>";

    echo "</div>";
    echo "<div style='width: 100%;'></div>
    </div>";
}

function get_Reject($get_function){
    
    $classes = explode("|",$get_function);
    
    echo "<div id='outer'></div>";
    echo "<div id='conten' style='padding: 10px;'><br/>";
     echo "<div style='width: 100%; height: 30px;text-align: right;margin-right: 10px;'></div>";
     echo "<div style='display: none;'>
            <input type='text' name='txt_helpdeskCredit' id='txt_helpdeskCredit' value='".$classes[1]."' />
    </div>";
     echo $classes[2];
     echo "<br/>";
     echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtCommentCredit' name='txtCommentCredit' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";    
    if($classes[0] == "R"){
        echo "<input type='submit' style='margin-left: 100px;'  class='buttonManage' id='btn_Reject' name='btn_Reject' value='Reject'/>";     
    }
   /* if($classes[0] == "R"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "P"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";     
    }*/
   echo "<input type='button' style='margin-right: 10px;' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0,title)'/>";
          
    echo "</div>";
    echo "<div style='width: 100%;'></div>
    </div>";
}

function set_Back_AUTH($get_function){

    $classes = explode("|",$get_function);

    echo "<div id='outer'></div>";
    echo "<div id='conten' style='padding: 10px;'><br/>";
    echo "<div style='width: 100%; height: 30px;text-align: right;margin-right: 10px;'></div>";
    echo "<div style='display: none;'>
            <input type='text' name='txt_helpdeskCredit' id='txt_helpdeskCredit' value='".$classes[1]."' />
    </div>";
    echo $classes[2];
    echo "<br/>";
    echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtCommentCredit' name='txtCommentCredit' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";
    if($classes[0] == "R"){
        echo "<input type='submit' style='margin-left: 100px;'  class='buttonManage' id='btn_Back' name='btn_Back' value='Back'/>";
    }
    /* if($classes[0] == "R"){
         echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";
     }
     if($classes[0] == "P"){
         echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";
     }*/
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


function mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender){
    $message = "<html>
                    <head>
                      <title>OPERATION</title>
                    </head>
                    <body>";
    $message .= $messageBodyIn;
    $message .="</body>
                </html>";
    $message_body = mysqli_real_escape_string($conn,$message);
    $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), '".$sender."', '".$to."', '".$subject."', '".$message_body."', '".$to_cc."', '0000-00-00 00:00:00');";
    //echo $inseet_mailBox;
    $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));
}
?>