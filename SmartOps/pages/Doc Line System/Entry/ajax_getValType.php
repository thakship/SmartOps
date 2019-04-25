<?php
   $v_getidValue = $_REQUEST['getidValue'];
   $v_getidtype = $_REQUEST['getidtype'];
   include('../../../php_con/includes/db.ini.php');
   $que = "SELECT `seq_in_out`,`seq_branch` FROM `doc_line_file_stack` WHERE `doc_number` = '".$v_getidValue."' AND `doc_type`= '".$v_getidtype."' AND `action_stat` = 'ST';";
   //echo $que;
   $sql = mysqli_query($conn,$que);
   
   while($rec = mysqli_fetch_array($sql)){
        echo "<input type='text' name='txt_sqy_typ' id='txt_sqy_typ' value='".$rec[0]."'  onkeypress='return disableEnterKey(event)' readonly='readonly' />";
        echo "<input type='text' name='txt_sqy_branch' id='txt_sqy_branc' value='".$rec[1]."'  onkeypress='return disableEnterKey(event)' readonly='readonly' />";
   }
?>