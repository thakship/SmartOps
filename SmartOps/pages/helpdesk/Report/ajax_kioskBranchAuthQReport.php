<?php
include('../../../php_con/includes/db.ini.php');

if(isset($_REQUEST['getBranchAuthQ'])){
   // echo $_REQUEST['getBranchAuthQ'];
    getdtl($conn,$_REQUEST['getBranchAuthQ']);
}


function getdtl($conn,$getBranch){
    
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable1'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;'>
       <tr style='background-color: #BEBABA;'>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>HELP ID</span></td>
            <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>ISSUE</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>ENTRY BY</span></td>
            <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>ENTRY ON</span></td>
        </tr>";
    $sql = "select c.helpid , c.issue , c.enterBy , c.enterDateTime
            FROM cdb_helpdesk AS c 
            WHERE c.cmb_code = '5000' AND 
              c.cat_code = '1014' AND 
            	c.entry_branch = '".$getBranch."';";
                
    $query = mysqli_query($conn,$sql);
    $x = 1;
    while($rec = mysqli_fetch_array($query)){
        echo "<tr>";
        echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$rec[0]."</span></td>";
        echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$rec[1]."</span></td>";
        echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$rec[2]."</span></td>";
        echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$rec[3]."</span></td>";
        echo "</tr>";
        $x++;
    }
        
}
?>