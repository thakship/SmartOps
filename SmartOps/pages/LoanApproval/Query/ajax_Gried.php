<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        serviceRequsestMaual_Gried_POPUP_1($_REQUEST['sr_gried']);
}
function serviceRequsestMaual_Gried_POPUP_1($helpID){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'>
            <input type='button' class='buttonManage' style='width:100px; margin-top: 5px; margin-left: 5px;' name='btnColse' id='btnColse' value='Close' onclick='popup(0);' />
            <input type='button' class='buttonManage' style='width:100px; margin-top: 5px; margin-left: 5px;' name='btnPrint' id='btnprint' value='Print' onclick='isPrint();' />
            </div><hr/><br/>";
    echo "<div style='width: 100%;' id='viewsl_gried'>";
            $viewDoc = "SELECT `cdb_helpdesk`.`issue`, `cdb_helpdesk`.`help_discr`, `cdb_helpdesk`.`resulution`, `cdb_helpdesk`.`solution`,`solved_by`, `cdb_helpdesk`.`solved_on` 
FROM `cdb_helpdesk`
WHERE  `cdb_helpdesk`.`helpid` = '".$helpID."'";
            
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
            echo "<table class='tbl1' border='1' cellpadding='0' cellspacing='0'>";
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    $viewDoc1 = "SELECT `userID` FROM `user` WHERE `userName` = '".$add[4]."'";
                                    $sql_viewDoc1 = mysqli_query($conn,$viewDoc1);
                                    $user = '-';
                                    while($add1 = mysqli_fetch_array($sql_viewDoc1)){
                                        $user = $add1[0];
                                    }
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Help ID :</label></td>";
                                    echo "<td style='width:400px;'>".$helpID."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Issue :</label></td>";
                                    echo "<td style='width:200px;'>".$add[0]."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Issue Description:</label></td>";
                                    echo "<td style='width:200px;'>".$add[1]."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Caused by :</label></td>";
                                    echo "<td style='width:200px;'>".$add[2]."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Solution :</label></td>";
                                    echo "<td style='width:200px;'>".$add[3]."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Solved By :</label></td>";
                                    echo "<td style='width:200px;'>".$add[4]." -- ".$user."</td>";
                                    echo "</tr>";
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'><label class='linetop'>Solved On :</label></td>";
                                    echo "<td style='width:200px;'>".$add[5]."</td>";
                                    echo "</tr>";
                            }
               echo "</table></div>";
}
?>