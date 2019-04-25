<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried']) && isset($_REQUEST['sr_tit'])){
        serviceRequsestMaual_Gried_POPUP_1($_REQUEST['sr_tit']);
}
function serviceRequsestMaual_Gried_POPUP_1($sss){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='clickBranch(0,0);' /></div>";
    echo "<div style='width: 100%;'>";
    $viewDoc = "SELECT `branchNumber`,`branchName` FROM `branch`";
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
                                          <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                                    echo "<td style='width:200px;'>
                                          <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:100px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title , ".$sss.");clickBranch(0,0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div></div>";
}
    
?>