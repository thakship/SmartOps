<?php
include('../../../php_con/includes/db.ini.php'); // Databace Connection.
if(isset($_REQUEST['getGriedVeriHID'])){
    getNoteGried($conn,trim($_REQUEST['getGriedVeriHID']));
}

function getNoteGried($conn,$getGriedVeriHID){
    echo "<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 30px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:50px;'>#</td>
                <td style='width:600px;'>Notes</td>
                <td style='width:100px;'>Enterd User</td>
                <td style='width:200px;'>Enterd On</td>
            </tr>   ";
    $sql_load_note = "SELECT `note_code`, `note_discr`, `enterBy`, `enterDateTime` FROM `cdb_help_note` WHERE `helpid` = '".$getGriedVeriHID."';";
    $que_load_note = mysqli_query($conn,$sql_load_note) or die(mysqli_error($conn));
    $x = 1;
    $cou_load_note = mysqli_num_rows($que_load_note);
    if($cou_load_note != 0){
        while($rec_load_note = mysqli_fetch_assoc($que_load_note)){
            echo "<tr style='text-align:left;'>
                    <td style='width:50px;'>".$x."</td>
                    <td style='width:600px;'>".$rec_load_note['note_discr']."</td>
                    <td style='width:100px;'>".$rec_load_note['enterBy']."</td>
                    <td style='width:200px;'>".$rec_load_note['enterDateTime']."</td>
                </tr>";  
            $x++;  
        }
    }else{
        echo "<tr>
                    <td style='width:50px;'>&nbsp;</td>
                    <td style='width:600px;'>&nbsp;</td>
                    <td style='width:100px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                </tr>"; 
    }
   
    
echo "</table>";
}
?>