<?php
include('../../../php_con/includes/db.ini.php'); // DB Connection
if(isset($_REQUEST['getPerantHelpID'])){
    //echo $_REQUEST['getPerantHelpID'];
    getLinkIssure($conn,$_REQUEST['getPerantHelpID']);
}

function getLinkIssure($conn,$HelpID){
    //echo $isPerantHelpID;
    echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>Help ID</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Entry Date</span></td>
                <td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>Issue</span></td>
                <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>Category 2</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Branch</span></td>
                <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Req. Department</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Assing By</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Status</span></td>
                <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Solved BY</span></td>
                <td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>Solved On</span></td>
                <td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>Decision</span></td>
                <td style='width:50px;'></td>
            </tr>";
            
    $Str_HelpID = "";
    $Str_HelpID = getHelpIDPerant($conn,$HelpID,$Str_HelpID);
    //echo $Str_HelpID."--------------- P<br/>";
    $Str_HelpID .= $HelpID;
    $Str_HelpID = getHelpIDChild($conn,$HelpID,$Str_HelpID);
    //echo $Str_HelpID."--------------- C<br/>";
    $array_HelpID = explode('|',$Str_HelpID);
    for($i=0; $i<sizeof($array_HelpID);$i++){
        //echo $array_HelpID[$i]."<BR/>";
        $sql_getDTL = "SELECT ch.helpid ,  
                              ch.enterDateTime ,
                               ch.issue ,
                               s2.scat_discr_2 ,
                               (SELECT b.branchName FROM branch AS b WHERE b.branchNumber = ch.entry_branch) AS BranchName ,
                               (SELECT d.deparmentName FROM deparment AS d WHERE d.deparmentNumber = ch.entry_department) AS DepartmnetName ,
                               ch.asing_by ,
                               c.cmb_discr ,
                               ch.caloser_by ,
                               ch.caloser_dateTime ,
                               ch.decision_discription
                        FROM cdb_helpdesk AS ch , scat_02 AS s2 , cmb_states AS c
                        WHERE ch.helpid = '".$array_HelpID[$i]."' AND
                              ch.scat_code_2 = s2.scat_code_2 AND
                              ch.cmb_code = c.cmb_code;";
        //echo $sql_getDTL;
        $query_getDTL = mysqli_query($conn,$sql_getDTL) or die(mysqli_error($conn));
        while($rec_getDTL = mysqli_fetch_array($query_getDTL)){
            $asing_by = getUserName($conn,$rec_getDTL[6]);
            echo "<tr>";
            echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$rec_getDTL[0]."</span></td>";
            echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$rec_getDTL[1]."</span></td>";
            echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$rec_getDTL[2]."</span></td>";
            echo "<td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>".$rec_getDTL[3]."</span></td>";
            echo "<td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$rec_getDTL[4]."</span></td>";
            echo "<td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$rec_getDTL[5]."</span></td>";
            echo "<td style='width:80px;text-align: right;' title='".getUserName($conn,$rec_getDTL[6])."'><span style='margin-right: 5px;'>".$rec_getDTL[6]."</span></td>";
            echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$rec_getDTL[7]."</span></td>";
            echo "<td style='width:100px;text-align: left;' title='".getUserName($conn,$rec_getDTL[8])."'><span style='margin-left: 5px;'>".$rec_getDTL[8]."</span></td>";
            echo "<td style='width:80px;text-align: left;'><span style='margin-left: 5px;'>".$rec_getDTL[9]."</span></td>";
            echo "<td style='width:80px;text-align: right;'><span style='margin-right: 5px;'>".$rec_getDTL[10]."</span></td>";
            echo "<td style='width:50px;'>
                    <input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='".$rec_getDTL[0]."' onclick='selcect_helpID_delels(title);'/>
                 </td>";
            echo "</tr>";
        }
        
    }
    
     echo "</table>";
    
}

function getHelpIDPerant($conn,$HelpIDP,$Str_HelpID){
    $sql_getPerantHelpID = "SELECT ch.Linked_helpid FROM cdb_helpdesk AS ch WHERE ch.helpid = '".$HelpIDP."';";
    $query_getPerantHelpID = mysqli_query($conn,$sql_getPerantHelpID) or die(mysqli_error($conn));
    while($rec_getPerantHelpID = mysqli_fetch_array($query_getPerantHelpID)){
        if($rec_getPerantHelpID[0] != ""){
            $Str_HelpID = $rec_getPerantHelpID[0]."|".$Str_HelpID;
            $Str_HelpID = getHelpIDPerant($conn,$rec_getPerantHelpID[0],$Str_HelpID);
        }
    }
    return $Str_HelpID ;
}

function getHelpIDChild($conn,$HelpIDC,$Str_HelpID){
    $sql_getPerantHelpID = "SELECT ch.helpid FROM cdb_helpdesk AS ch WHERE ch.Linked_helpid = '".$HelpIDC."';";
    $query_getPerantHelpID = mysqli_query($conn,$sql_getPerantHelpID) or die(mysqli_errno($conn));
    
    while($rec_getPerantHelpID = mysqli_fetch_array($query_getPerantHelpID)){
        if($rec_getPerantHelpID[0] != ""){
            $Str_HelpID = $Str_HelpID."|".$rec_getPerantHelpID[0];
            $Str_HelpID = getHelpIDChild($conn,$rec_getPerantHelpID[0],$Str_HelpID);
        }
    }
    return $Str_HelpID;
}

function getUserName($conn,$userID){
        $getSql = "SELECT u.userID , b.branchName , d.deparmentName
                     FROM user AS u , branch AS b , deparment As d
                    WHERE u.userName = '".$userID."' AND
                          u.branchNumber = b.branchNumber AND 
                          u.deparmentNumber = d.deparmentNumber;";
        $getQuery = mysqli_query($conn,$getSql) or die(mysqli_error($conn));
        while($getResalt = mysqli_fetch_array($getQuery)){
            return $getResalt[0]."\n Branch : ".$getResalt[1]."\n Department : ".$getResalt[2];
        }
        
}
?>