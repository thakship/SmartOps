<?php
include('../../../php_con/includes/db.ini.php'); // db connection


if(isset($_REQUEST['get_helpid']) && isset($_REQUEST['get_facNumber']) && isset($_REQUEST['get_cif'])){
    //echo  $_REQUEST['get_helpid'] ." - ". $_REQUEST['get_facNumber'] ." - ". $_REQUEST['get_cif'] ;
    //get_helpid="+helpid+"&get_facNumber="+facNumber+"&get_cif="+cif
    if($_REQUEST['get_helpid'] == "" && $_REQUEST['get_facNumber'] == "" && $_REQUEST['get_cif'] == ""){
        echo "Atleast one field should be filled.";
    }else{
        loadMovmentDtl($conn,$_REQUEST['get_helpid'],$_REQUEST['get_facNumber'],$_REQUEST['get_cif']);     
    }
    
}



function loadMovmentDtl($conn,$helpid,$facNumber,$get_cif){
  //  echo $helpid; 
   //$v_sql_det_detelsCNT = "select d.doc_name from doc_line_doc_mast as d where d.doc_number = '".$helpid."';";
   echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                    <tr style='background-color: #BEBABA;'>
                       
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Help Id</span></td>
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Call Answered</span></td>
                        <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Call feedback</span></td>
                        <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Call Completed</span></td>
                        <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Enter By</span></td>
                        <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Entry On</span></td>
                       
                    </tr>";
   if($helpid != ""){
        $get_details = "SELECT * FROM callcenterinquiry AS c WHERE  c.helpid = '".$helpid."';";
        $v_que_det_detels = mysqli_query($conn,$get_details) or die(mysqli_error($conn));
        $x = 1;
        while($result_det_detels = mysqli_fetch_assoc($v_que_det_detels)){
            echo "<tr>
                       
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['helpid']."</span></td>
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['call_answered']."</span></td>";
                        if($result_det_detels['call_answered'] == "YES"){
                            if($result_det_detels['call_feedback'] == 1){
                                echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Verified</span></td>";
                            }else{
                                 echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Descrepency - ".$result_det_detels['callFeedback']."</span></td>";
                            }
                            
                        }else{
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['callFeedback']."</span></td>";
                        }
                        
                        if($result_det_detels['callstatus'] == 1){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>YES</span></td>";
                            
                        }else if($result_det_detels['callstatus'] == 0){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>NO</span></td>";
                            
                        }else{
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>-</span></td>";
                        }
                        
                       echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['enrtyby']."</span></td>
                        <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$result_det_detels['enryon']."</span></td>
                    </tr>";
                 
            
        }
       
   }else if($facNumber != "" && $get_cif == ""){
        $sql_f = "SELECT h.helpid FROM cdb_helpdesk AS h WHERE h.facno = '".$facNumber."';";
        $query_f = mysqli_query($conn,$sql_f) or die(mysqli_error($conn));
         while($result_f = mysqli_fetch_array($query_f)){
            $get_details = "SELECT * FROM callcenterinquiry AS c WHERE  c.helpid = '".$result_f[0]."';";
            $v_que_det_detels = mysqli_query($conn,$get_details) or die(mysqli_error($conn));
            $x = 1;
            while($result_det_detels = mysqli_fetch_assoc($v_que_det_detels)){
                echo "<tr>
                           
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['helpid']."</span></td>
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['call_answered']."</span></td>";
                            if($result_det_detels['call_answered'] == "YES"){
                                if($result_det_detels['call_feedback'] == 1){
                                    echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Verified</span></td>";
                                }else{
                                     echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Descrepency - ".$result_det_detels['callFeedback']."</span></td>";
                                }
                                
                            }else{
                                echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['callFeedback']."</span></td>";
                            }
                        if($result_det_detels['callstatus'] == 1){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>YES</span></td>";
                            
                        }else if($result_det_detels['callstatus'] == 0){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>NO</span></td>";
                            
                        }else{
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>-</span></td>";
                        }
                           echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['enrtyby']."</span></td>
                            <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$result_det_detels['enryon']."</span></td>
                        </tr>";
                     
                
            }
            
         }
        
        
   }else if($facNumber == "" && $get_cif != ""){
        $sql_f = "SELECT h.helpid FROM cdb_helpdesk AS h WHERE h.cif = '".$get_cif."';";
        $query_f = mysqli_query($conn,$sql_f) or die(mysqli_error($conn));
         while($result_f = mysqli_fetch_array($query_f)){
            $get_details = "SELECT * FROM callcenterinquiry AS c WHERE  c.helpid = '".$result_f[0]."';";
            $v_que_det_detels = mysqli_query($conn,$get_details) or die(mysqli_error($conn));
            $x = 1;
            while($result_det_detels = mysqli_fetch_assoc($v_que_det_detels)){
                echo "<tr>
                           
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['helpid']."</span></td>
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['call_answered']."</span></td>";
                            if($result_det_detels['call_answered'] == "YES"){
                                if($result_det_detels['call_feedback'] == 1){
                                    echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Verified</span></td>";
                                }else{
                                     echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Descrepency - ".$result_det_detels['callFeedback']."</span></td>";
                                }
                                
                            }else{
                                echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['callFeedback']."</span></td>";
                            }
                         if($result_det_detels['callstatus'] == 1){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>YES</span></td>";
                            
                        }else if($result_det_detels['callstatus'] == 0){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>NO</span></td>";
                            
                        }else{
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>-</span></td>";
                        }
                           echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['enrtyby']."</span></td>
                            <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$result_det_detels['enryon']."</span></td>
                        </tr>";
                     
                
            }
           
         }
   }else if($facNumber != "" && $get_cif != ""){
        $sql_f = "SELECT h.helpid FROM cdb_helpdesk AS h WHERE h.facno = '".$facNumber."' AND h.cif = '".$get_cif."';";
        $query_f = mysqli_query($conn,$sql_f) or die(mysqli_error($conn));
         while($result_f = mysqli_fetch_array($query_f)){
            $get_details = "SELECT * FROM callcenterinquiry AS c WHERE  c.helpid = '".$result_f[0]."';";
            $v_que_det_detels = mysqli_query($conn,$get_details) or die(mysqli_error($conn));
            $x = 1;
            while($result_det_detels = mysqli_fetch_assoc($v_que_det_detels)){
                echo "<tr>
                           
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['helpid']."</span></td>
                            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['call_answered']."</span></td>";
                            if($result_det_detels['call_answered'] == "YES"){
                                if($result_det_detels['call_feedback'] == 1){
                                    echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Verified</span></td>";
                                }else{
                                     echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Descrepency - ".$result_det_detels['callFeedback']."</span></td>";
                                }
                                
                            }else{
                                echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['callFeedback']."</span></td>";
                            }
                           
                        if($result_det_detels['callstatus'] == 1){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>YES</span></td>";
                            
                        }else if($result_det_detels['callstatus'] == 0){
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>NO</span></td>";
                            
                        }else{
                            echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>-</span></td>";
                        }
                           
                           echo "<td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>".$result_det_detels['enrtyby']."</span></td>
                            <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$result_det_detels['enryon']."</span></td>
                        </tr>";
                     
                
            }
            
         }
   }else{
    
   }

     echo "</table>";
 
    
}



function getBranchName($conn,$branch_number){
    $result = $conn->query("SELECT b.branchName FROM branch AS b WHERE b.branchNumber = '".$branch_number."';");
    $row = $result->fetch_row();
    return $row[0];
}

function getDepartmentName($conn,$department_number){
    $result = $conn->query("SELECT d.deparmentName FROM deparment AS d WHERE d.deparmentNumber = '".$department_number."';");
    $row = $result->fetch_row();
    return $row[0];
}

function getUserName($conn,$entry_by){
    $result = $conn->query("select U.userID from user AS U WHERE U.userID = '".$entry_by."'");
    $row = $result->fetch_row();
    return $row[0];
}
?>