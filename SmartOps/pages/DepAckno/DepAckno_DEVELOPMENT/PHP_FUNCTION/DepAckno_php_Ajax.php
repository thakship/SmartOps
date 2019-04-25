<?php
    //.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
// ............................................ Get Data for Ajax Function............................................................
    if(isset($_REQUEST['FrompritackDate']) && isset($_REQUEST['TopritackDate'])){
        getGried_cetificat_Acknowledgement($_REQUEST['FrompritackDate'],$_REQUEST['TopritackDate']);
    }
    
     if(isset($_REQUEST['FromBranchackDate']) && isset($_REQUEST['ToBranchackDate']) && isset($_REQUEST['sqlSel']) && isset($_REQUEST['getuserName'])){
        //echo "b - ".$_REQUEST['getBranchsel'];
        getGried_branch_Acknowledgement($_REQUEST['FromBranchackDate'],$_REQUEST['ToBranchackDate'],$_REQUEST['getBranchsel'],$_REQUEST['sqlSel'] ,$_REQUEST['getuserName']);
    }
    
//..............................................Create Function............................................................................
    function  getGried_cetificat_Acknowledgement($fromDate,$toDate){
        $conn = DatabaseConnection();
        $sql_act = "SELECT `dep_num`, `cont_num`, `prnt_serial`, `prnt_by`, `prnt_on`
                        FROM `print_gen` 
                        WHERE DATE(`prnt_on`) BETWEEN '".$fromDate."' AND '".$toDate."' 
                        ORDER BY `prnt_on`;";
        $que_act = mysqli_query($conn,$sql_act);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Deposit Num</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>Cont. Num</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>Print Serial</span></td>
                    <td style='width:400px;text-align: left;'><span style='margin-left: 5px;'>Print By</span></td>
                    <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Print On</span></td>
                </tr>";
        $i = 0;
        while($RES_act = mysqli_fetch_assoc($que_act)){
            $i++;
            if($i % 2 == 0){
                $col = "#FFFFFF";
            }else{
                 $col = "#FAFAFA";
            }
            echo "<tr style='background-color: ".$col.";'>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
            echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['dep_num']."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['cont_num']."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['prnt_serial']."</span></td>";
            echo "<td style='width:400px;text-align: left;'><span style='margin-left: 5px;'>".getUserName($RES_act['prnt_by'])."</span></td>";
            echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['prnt_on']."</span></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    function getGried_branch_Acknowledgement($fromDate,$toDate,$Barch,$sql_count,$user){
        $conn = DatabaseConnection();
         $sql_act = "SELECT `print_gen`.`dep_num`,`Client_Name`,`print_gen`.`cont_num`,`print_gen`.`prnt_serial`,`branch`.`branchName`,`print_gen`.`prnt_by`,`print_gen`.`prnt_on`,`print_gen`.`cert_type`,`print_gen`.`cert_Number`,`print_gen`.`remarks`
                        FROM `print_gen` , `branch`
                        WHERE `print_gen`.`print_branch` = `branch`.`branchNumber` AND  DATE(`prnt_on`) BETWEEN '".$fromDate."' AND '".$toDate."' ";
        if($sql_count == 1){
                $sql_act .= "AND (trim('".$Barch."') = '' OR `print_branch` = '".$Barch."') ";
        }
        if($sql_count == 2){
           $sql_act .= "AND `print_branch` = '".$Barch."' AND `prnt_by` = '".$user."'";
        }
        
        $sql_act .= "ORDER BY `prnt_on`;";
       //echo $sql_act;
        $que_act = mysqli_query($conn,$sql_act);
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='width:40px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                    <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Deposit Num</span></td>
                    <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                    <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>Print Serial</span></td>
                    <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
                    <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Print By</span></td>
                    <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Print On</span></td>
                    <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Print Text</span></td>
                    <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Remark</span></td>
                </tr>";
        $i = 0;
        while($RES_act = mysqli_fetch_assoc($que_act)){
            $i++;
            if($i % 2 == 0){
                $col = "#FFFFFF";
            }else{
                 $col = "#FAFAFA";
            }
            echo "<tr style='background-color: ".$col.";'>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$i."</span></td>";
            echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['dep_num']."-".$RES_act['cont_num']."</span></td>";
            echo "<td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$RES_act['Client_Name']."</span></td>";
            echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['prnt_serial']."</span></td>";
            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$RES_act['branchName']."</span></td>";
            echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".getUserName($RES_act['prnt_by'])."</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_act['prnt_on']."</span></td>";
            echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$RES_act['cert_type']."-".$RES_act['cert_Number']."</span></td>";
            echo "<td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>".$RES_act['remarks']."</span></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
//................................................Comment Function .........................................................................
    function getUserName($userID){
        $conn = DatabaseConnection();
        $sql_user = "SELECT `userID` FROM `user` WHERE `userName` = '".$userID."';";
        $que_user = mysqli_query($conn,$sql_user);
        while($res_user = mysqli_fetch_assoc($que_user)){
            return $res_user['userID'];
        }
    }
?>