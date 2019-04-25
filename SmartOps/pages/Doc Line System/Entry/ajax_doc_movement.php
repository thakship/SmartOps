<?php
include('../../../php_con/includes/db.ini.php'); // db connection

if(isset($_REQUEST['get_docnumber'])){
    //echo  $_REQUEST['get_docnumber'];
    loadMovmentDtl($conn , trim($_REQUEST['get_docnumber']));
}

if(isset($_POST['get_doc_number']) && isset($_POST['get_EnrtyUser']) && isset($_POST['get_userBranch']) && isset($_POST['get_userDepartment'])){
   // echo $_POST['get_doc_number']." - ".$_POST['get_EnrtyUser']." - ".$_POST['get_userBranch']." - ".$_POST['get_userDepartment'];
   
   submitData($conn,trim($_POST['get_doc_number']),$_POST['get_EnrtyUser'],$_POST['get_userBranch'],$_POST['get_userDepartment']);
    
}


function loadMovmentDtl($conn,$docnumber){
  //  echo $docnumber;
   $v_sql_det_detelsCNT = "select d.doc_name from doc_line_doc_mast as d where d.doc_number = '".$docnumber."';";
   $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT) or die(mysqli_error($conn));
   
   
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	   echo "<h4>Facility : ".$docnumber." (". $rec_det_detelsCNT[0]. ")</h4>";
    }
    
    if (mysqli_num_rows($v_que_det_detelsCNT) != 0){
        
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                    <tr style='background-color: #BEBABA;'>
                        <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
                        <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Department</span></td>
                        <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Movement Type</span></td>
                        <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Enter By</span></td>
                        <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Entry On</span></td>
                       
                    </tr>";
                    
        $get_details = "select * from doc_movement as dm where  dm.doc_number = '".$docnumber."' order by dm.index_id desc";
        
        $v_que_det_detels = mysqli_query($conn,$get_details) or die(mysqli_error($conn));
        $x = 1;
        while($result_det_detels = mysqli_fetch_assoc($v_que_det_detels)){
            echo " <tr>
                        <td style='width:60px;text-align: right;' title='".$result_det_detels['remark']."'><span style='margin-right: 5px;'>".$x."</span></td>
                        <td style='width:150px;text-align: left;' title='".$result_det_detels['remark']."'><span style='margin-left: 5px;'>".getBranchName($conn,$result_det_detels['branch_number'])."</span></td>
                        <td style='width:150px;text-align: left;' title='".$result_det_detels['remark']."'><span style='margin-left: 5px;'>".getDepartmentName($conn,$result_det_detels['department_number'])."</span></td>
                        <td style='width:100px;text-align: left;' title='".$result_det_detels['remark']."'><span style='margin-left: 5px;'>";
                            if($result_det_detels['movement_type'] == "I"){
                                echo "IN";
                            }else if($result_det_detels['movement_type'] == "O"){
                                echo "OUT";
                            }else{
                                echo "-";
                            }
            echo "</span></td>
                        <td style='width:100px;text-align: left;' title = '".getUserName($conn,$result_det_detels['entry_by'])."'><span style='margin-left: 5px;'>".$result_det_detels['entry_by']."</span></td>
                        <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$result_det_detels['entry_on']."</span></td>
    
                    </tr>";
                    $x++;
            
        }
        echo "</table>";
    }else{
        echo "Facility Number Invalid";
    }
    
    
}

function submitData($conn,$doc_number,$EnrtyUser,$userBranch,$userDepartment){
     date_default_timezone_set("Asia/Calcutta");
      mysqli_autocommit($conn,FALSE);
      try{
          $insertDATA = "INSERT INTO doc_movement(doc_number,entry_by,branch_number,department_number,remark,movement_type)
                                           VALUES('".$doc_number."','".$EnrtyUser."','".$userBranch."','".$userDepartment."','IN','I');";
          $query_insert = mysqli_query($conn,$insertDATA) or die(mysqli_error($conn));  
          if($query_insert){
                echo "Record Updated.";
          }else{
                echo "Record Not Update - Data Error.";
          }                           
      }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
      }
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
    $result = $conn->query("select U.userID from user AS U WHERE U.userName = '".$entry_by."'");
    $row = $result->fetch_row();
    return $row[0];
}
?>