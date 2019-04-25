<?php
include('../../../php_con/includes/db.ini.php');
if(isset($_REQUEST['getDateFrom']) && isset($_REQUEST['getDateTo'])){
    //echo $_REQUEST['getDateFrom'] . " -- " .$_REQUEST['getDateTo'];
    getReopt($conn,$_REQUEST['getDateFrom'],$_REQUEST['getDateTo']);
    
}

function getReopt($conn,$getDateFrom,$getDateTo){
    $sql_CountOFSr = "select MIS.HELPID,
                            MIS.FILE_RECEIVED_ON,
                            MIS.ZONE,
                            MIS.BRANCH_CODE,
                            MIS.BRANCH_NAME,
                            MIS.LAST_PENDING_ON,
                            MIS.LAST_VERIFICATION_ON,
                            MIS.AGENT_ID,
                            GetUserName(MIS.AGENT_ID) AS AGENT_NAME,
                            MIS.AGENT_ASSIGN_TIME,
                            ROUND(time_to_sec((TIMEDIFF(now(),MIS.AGENT_ASSIGN_TIME))) / 60) AS ELAPSED_TIME
                            FROM (
                            select ch.helpid AS HELPID,
                            (select cdbzone.zone_descr from cdbzone where cdbzone.zone_code = br.CDBZONE)  AS ZONE,
                            ch.entry_branch AS BRANCH_CODE, getBranchName(ch.entry_branch) AS BRANCH_NAME,
                            ch.enterDateTime as FILE_RECEIVED_ON,
                            (select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('P')) AS LAST_PENDING_ON,
                            (select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('V')) AS LAST_VERIFICATION_ON,
                            (select cnm.enterBy from cdb_help_note cnm where cnm.helpid = ch.helpid  and cnm.enterDateTime = (select max(cn.enterDateTime)  from cdb_help_note cn where cn.helpid = ch.helpid)) AS AGENT_ID,
                            (select cnm.enterDateTime from cdb_help_note cnm where cnm.helpid = ch.helpid  and cnm.enterDateTime = (select max(cn.enterDateTime)  from cdb_help_note cn where cn.helpid = ch.helpid)) AS AGENT_ASSIGN_TIME
                            FROM `cdb_helpdesk` ch,branch br
                            where ch.`cat_code` = '1014'
                            and ch.cmb_code = 5001
                            and br.branchNumber = ch.entry_branch
                            and date(ch.enterDateTime) between '".$getDateFrom." 00:00:00' AND '".$getDateTo." 00:00:00'
                            and (select cnm.note_discr from cdb_help_note cnm where cnm.helpid = ch.helpid  and cnm.enterDateTime = (select max(cn.enterDateTime)  from cdb_help_note cn where cn.helpid = ch.helpid and cn.note_discr like 'Agent Assigned to file%')) like 'Agent Assigned to file%'
                            ) mis
                            order by 11 desc";
    $qer_CountOFSr = mysqli_query($conn,$sql_CountOFSr);
   // echo $sql_CountOFSr;
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>HELPID</span></td>
            <td style='width:180px; text-align: right;word-wrap:break-word;'><span style='margin-right: 5px;'>FILE RECEIVED ON</span></td>
            <td style='width:100px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>ZONE</span></td>";
           // <td style='width:100px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>BRANCH_CODE</span></td>
    echo "<td style='width:150px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>BRANCH_NAME</span></td>
            <td style='width:180px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>LAST PENDING ON</span></td>
            <td style='width:180px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>LAST VERIFICATION ON</span></td>
            <td style='width:100px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>AGENT ID</span></td>
    		<td style='width:150px;  text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>AGENT NAME</span></td>
            <td style='width:180px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>AGENT ASSIGN TIME</span></td>
            <td style='width:80px; text-align: left;word-wrap:break-word;'><span style='margin-left: 5px;'>ELAPSED TIME</span></td>
        </tr>";
   
        while($RES_CountOFSr = mysqli_fetch_array($qer_CountOFSr)){
            echo "<tr>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[0]."</span></td>";
            echo "<td style='width:180px; text-align: right;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[2]."</span></td>";
            // echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[3]."</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[4]."</span></td>";
            echo "<td style='width:180px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[5]."</span></td>";
            echo "<td style='width:180px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[6]."</span></td>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[7]."</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[8]."</span></td>";
            echo "<td style='width:180px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[9]."</span></td>";
            echo "<td style='width:80px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[10]."</span></td>";
            echo "<tr/>";
        }
 echo "</table>";
}

?>