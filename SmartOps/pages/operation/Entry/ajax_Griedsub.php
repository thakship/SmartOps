<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        serviceRequsestMaual_Gried_POPUP_1();
}
function serviceRequsestMaual_Gried_POPUP_1(){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popup(0);' /></div>";
    echo "<div style='width: 100%;'>";
    echo "Search User Branch : <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            $viewDoc = "SELECT b.branchNumber,b.branchName,b.br_code FROM branch b where b.br_code > 0 AND b.branchNumber != '1212' AND  b.branchNumber != '9522' AND b.branchNumber != '0001'
                                        union all
                                        select d.deparmentNumber,d.deparmentName,d.br_code FROM deparment d where d.br_code > 0 AND d.deparmentName != 'GENARAL' AND d.deparmentNumber != '01003' AND d.deparmentNumber != '40301' ";
                            $sql_viewDoc = mysqli_query($conn,$viewDoc);
                            echo "<table class='tbl1' border='1'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>Branch Number</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Branch Name</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td>
                                      </tr>";
                            $a = 1 ;
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'>
                                          <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[2]."' readonly='readonly'/></td>";
                                    echo "<td style='width:200px;'>
                                          <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:100px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div></div>";
}
    
?>