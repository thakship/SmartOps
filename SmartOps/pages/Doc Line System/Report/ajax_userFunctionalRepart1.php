<?php
    $V_fromDate = $_REQUEST['date1'];
    $V_toDate = $_REQUEST['date2'];
    //echo $V_fromDate."---".$V_toDate;
    include('../../../php_con/includes/db.ini.php');
    $sql_select_function ="select temp.act as user,temp.LD_COUNT as LOADED,temp.ST_COUNT as DISPATCHED,temp.RQ_COUNT as REQUESTED,temp.RC_COUNT as RECEIVED,temp.RF_COUNT as FORWORD 
from(select sh.action_user as act,
(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$V_fromDate' and '$V_toDate' and dlsh.action_stat = 'LD' and  dlsh.action_user = sh.action_user ) AS LD_COUNT,
(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$V_fromDate' and '$V_toDate' and dlsh.action_stat = 'ST' and  dlsh.action_user = sh.action_user ) AS ST_COUNT,
(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$V_fromDate' and '$V_toDate' and dlsh.action_stat = 'RQ' and  dlsh.action_user = sh.action_user ) AS RQ_COUNT,
(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$V_fromDate' and '$V_toDate' and dlsh.action_stat = 'RC' and  dlsh.action_user = sh.action_user ) AS RC_COUNT,
(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$V_fromDate' and '$V_toDate' and dlsh.action_stat = 'RF' and  dlsh.action_user = sh.action_user ) AS RF_COUNT
from doc_line_stat_history sh
group by sh.action_user) temp";
    $query_select_function = mysqli_query($conn,$sql_select_function);
?>
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:50px;">Index</td>
            <td style="width:100px;">User</td>
            <td style="width:100px;">Loaded</td>
            <td style="width:100px;">Dispatched</td>
            <td style="width:100px;">Requested</td>
            <td style="width:100px;">Received</td>
            <td style="width:100px;">Forword</td>
        </tr>
<?php
        $index = 0;
       	while ($rec_select_function = mysqli_fetch_array($query_select_function)){
            $index++;
            if($index%2==0){
                $col = "#DFDDDD";
            }else{
                $col = "#FFFFFF";
            }
?>
            <tr style="background:<?php echo $col; ?>">
                <td style="width:50px; text-align:right; padding-right:5px;"><?php echo $index; ?></td>
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[0]; ?></td> 
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[1]; ?></td>
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[2]; ?></td>
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[3]; ?></td>
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[4]; ?></td>
                <td style="width:100px; text-align:right; padding-right:5px;"><?php echo $rec_select_function[5]; ?></td>
            </tr>	
<?php } ?>
</table>