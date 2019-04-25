<?php
    if(isset($_REQUEST['getSRReoptDate1']) && isset($_REQUEST['getSRReoptDate2']) && isset($_REQUEST['getUserGroupEner']) && isset($_REQUEST['getUserBranch']) && isset($_REQUEST['getUser'])){
        //echo    $_REQUEST['getSRReoptDate1']." ".$_REQUEST['getSRReoptDate2']." ".$_REQUEST['getUserGroupEner']." ".$_REQUEST['getUserBranch']." ".$_REQUEST['getUser'];
        getlistTbl($_REQUEST['getSRReoptDate1'],$_REQUEST['getSRReoptDate2'],$_REQUEST['getUserGroupEner'],$_REQUEST['getUserBranch'],$_REQUEST['getUser']);
    }
    //**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 function getlistTbl($getSRReoptDate1,$getSRReoptDate2,$getUserGroupEner,$getUserBranch,$getUser){
    $conn =  DatabaseConnection();
?>
<table id="myTable" class="table table-striped table-bordered table-hover" style="font-size: 11px;">
    <thead>
        <tr>
            <!--
            <th>From Date</th>
            <th>To Date</th>
            -->
            <th>Deposit N0</th>
            <th>Client Name</th>
            <th>Deposit Date</th>
            <th>Maturity Date</th>
            <th>Current Branch CD</th>
            <th>Current Branch Name</th>
            <th>Introducer Code</th>
            <th>Introducer Name</th>
            <th>Channel</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // echo "Session User : ".$_SESSION['user'];
        if($getUserGroupEner == 'ug00026' || $getUserGroupEner == 'ug00015'){ //IF USER GROUP IS CSO(ug00026) OR HOB(ug00015)
            $select_list = "SELECT * 
                            FROM fd_mat_list FDM, fd_mat_list_head FDMH 
                            WHERE FDM.FROM_DATE = FDMH.FROM_DATE
                              AND FDM.TO_DATE = FDMH.TO_DATE   
                              AND FDM.CURRENT_BRANCH_CD = (SELECT BR.br_code FROM branch BR WHERE BR.branchNumber = '".$getUserBranch."') 
                              AND FDM.FROM_DATE = '".$getSRReoptDate1."'
                              AND FDM.TO_DATE = '".$getSRReoptDate2."'";
                             
            if($getUserGroupEner == 'ug00026'){ 
               // echo "test";
                $select_list = $select_list. " AND (TRIM(FDM.INTRO_CD) IS NULL OR TRIM(FDM.INTRO_CD) = 'RESIGNED')";
            }
                              
                                   //".$_SESSION['user']."
            $quary_list = mysqli_query($conn , $select_list);
            $x = 1;
            while($result_list = mysqli_fetch_assoc($quary_list)){
                echo "<tr>";
                // echo "<td>".$result_list['FROM_DATE']."</td>"; 
                // echo "<td>".$result_list['TO_DATE']."</td>";
                echo "<td>".$result_list['DEP_NO']."</td>";
                echo "<td>".$result_list['CLIENT_NAME']."</td>";
                echo "<td>".$result_list['DEP_DT']."</td>";
                echo "<td>".$result_list['MAT_DATE']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_CD']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_DESCR']."</td>";
                echo "<td>".$result_list['INTRO_CD']."</td>";
                echo "<td>".$result_list['INTRO_NAME']."</td>";
                echo "<td>".$result_list['CHANNEL']."</td>";
                echo "</tr>";
                $x++;
            }
            if($x==1) echo "<tr><td colspan='9'> No record(s) to print</td></tr>";
        }else { ////if($_SESSION['userGroupEner'] == 'ug00026')
            $select_list = "SELECT * FROM fd_mat_list FDM, fd_mat_list_head FDMH
                            WHERE FDM.FROM_DATE = FDMH.FROM_DATE
                              AND FDM.TO_DATE   = FDMH.TO_DATE
                              AND FDM.INTRO_CD  = '".$getUser."'
                              AND FDM.INTRO_CD <> ''
                              AND FDM.FROM_DATE = '".$getSRReoptDate1."'
                              AND FDM.TO_DATE = '".$getSRReoptDate2."';";
                                  //".$_SESSION['user']."
            $quary_list = mysqli_query($conn , $select_list);
            $x = 1;
            while($result_list = mysqli_fetch_assoc($quary_list)){
                echo "<tr>";
                // echo "<td>".$result_list['FROM_DATE']."</td>"; 
                // echo "<td>".$result_list['TO_DATE']."</td>";
                echo "<td>".$result_list['DEP_NO']."</td>";
                echo "<td>".$result_list['CLIENT_NAME']."</td>";
                echo "<td>".$result_list['DEP_DT']."</td>";
                echo "<td>".$result_list['MAT_DATE']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_CD']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_DESCR']."</td>";
                echo "<td>".$result_list['INTRO_CD']."</td>";
                echo "<td>".$result_list['INTRO_NAME']."</td>";
                echo "<td>".$result_list['CHANNEL']."</td>";
                echo "</tr>";
                $x++;
            }
            if($x==1) echo "<tr><td colspan='9' style='font-size: 11px;'> No record(s) to print</td></tr>";
        }
    ?>  
    
    </tbody>
</table>

<?php
 }
    
?>

